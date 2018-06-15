<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2018/5/14
 * Time: 6:55 PM
 * https://www.fushupeng.com
 * contact@fushupeng.com
 */

namespace App\Http\Controllers\Globals;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Omnipay\Omnipay;
use Stripe\Error\SignatureVerification;
use Stripe\Stripe;
use Stripe\Webhook;

class PaymentController extends GlobalController
{
    protected function getProductDiscount($pid = 0)
    {

    }

    public function checkoutSubmit(Request $request)
    {
        $years = $currentYear = date('Y');
        $months = '01,02,03,04,05,06,07,08,09,10,11,12';

        for($i = 0; $i < 10; $i++) {
            $currentYear += 1;
            $years .= ',' . $currentYear;
        }
        $rules = [
            'id' => 'required|exists:mysql_backend.orders,id',
            'name' => 'required|max:100|min:1',
            'email' => 'required|email|max:150|min:5',
            'phone' => 'required|max:20|min:5',
            'address1' => 'required|max:255',
            'address2' => 'max:255',
            'city' => 'required|max:100|min:2',
            'state' => 'required|max:100|min:2',
            'zip' => 'required|max:20|min:5',
            'country' => 'required|exists:mysql_backend.orders,car,id,' . $request -> id,
            'paymentCCName' => 'required|max:100|min:3',
            'paymentCCNumber' => 'required|max:20|min:12',
            'paymentCCExpMonth' => 'required|in:' . $months,
            'paymentCCExpYear' => 'required|in:' . $years,
            'paymentCCCVV' => 'required|max:5|min:3',
        ];
        $messages = [
            'id' => 'There is something wrong.',
            'name.required' => 'The recipient is required.',
            'name.max' => 'The length of recipient must be less than :max',
            'name.min' => 'The length of recipient must be greater than :min',
            'email.required' => 'The e-mail is required.',
            'email.email' => 'The e-mail is invalid.',
            'email.max' => 'The length of e-mail must be less than :max',
            'email.min' => 'The length of e-mail must be greater than :min',
            'phone.required' => 'The phone is required.',
            'phone.max' => 'The length of phone must be less than :max',
            'phone.min' => 'The length of phone must be greater than :min',
            'address1.required' => 'The address is required.',
            'address1.max' => 'The length of address 1 must be less than :max',
            'address2.max' => 'The length of address 2 must be less than :max',
            'city.required' => 'The city is required.',
            'city.max' => 'The length of city must be less than :max',
            'city.min' => 'The length of city must be greater than :min',
            'state.required' => 'The state is required.',
            'state.max' => 'The length of state must be less than :max',
            'state.min' => 'The length of state must be greater than :min',
            'zip.required' => 'The zip is required.',
            'zip.max' => 'The length of zip must be less than :max',
            'zip.min' => 'The length of zip must be greater than :min',
            'country.required' => 'The country is required.',
            'country.exists' => 'The country is mismatch with your selection.',
            'paymentCCName.required' => 'The credit card holder name is required.',
            'paymentCCName.max' => 'The length of credit card holder name must be less than :max.',
            'paymentCCName.min' => 'The length of credit card holder name must be greater than :min.',
            'paymentCCNumber.required' => 'The credit card number is required.',
            'paymentCCNumber.max' => 'The length of credit card number must be less than :max',
            'paymentCCNumber.min' => 'The length of credit card number must be greater than :min',
            'paymentCCExpMonth.required' => 'The card expiration is required.',
            'paymentCCExpMonth.in' => 'The card expiration is invalid.',
            'paymentCCExpYear.required' => 'The card expiration is required.',
            'paymentCCExpYear.in' => 'The card expiration is invalid.',
            'paymentCCCVV.required' => 'The CVV/CVV2 is required.',
            'paymentCCCVV.min' => 'The length of CVV/CVV2 must be greater than :min',
            'paymentCCCVV.max' => 'The length of CVV/CVV2 must be less than :min'
        ];

        $this -> validate($request, $rules, $messages);

        $ids = dk_get_next_ids(3);
        DB::setDefaultConnection('mysql_backend');

        // 先获取订单状态
        $order = DB::table('orders')
            -> select('id', 'car', 'currency', 'total', 'source')
            -> where('status', 0)
            -> where('is_delete', 0)
            -> where('id', $request -> id)
            -> first();
        if (is_null($order)) {
            // 订单已经支付
            return abort(404);
        }
        $customers = DB::table('customers')
            -> select('id')
            -> where('is_delete', 0)
            -> where('email', $request -> email)
            -> first();

        try {
            DB::beginTransaction();
            if (is_null($customers)) {
                DB::table('customers') -> insert([
                    'id' => $ids[0],
                    'name' => $request -> name,
                    'email' => $request -> email
                ]);
                $cid = $ids[0];
            } else {
                $cid = $customers -> id;
            }
            $address = [
                'id' => $ids[1],
                'c_id' => $cid,
                'country' => $this -> deliveryCountries[$order -> car],
                'name' => $request -> name,
                'phone' => $request -> phone,
                'address1' => $request -> address1,
                'address2' => $request -> address2 ? : '',
                'city' => $request -> city,
                'state' => $request -> state,
                'zip' => $request -> zip,
                'car' => $order -> car
            ];
            $addressString = sprintf('%s, %s, %s, %s, %s, %s, %s, %s',
                $address['name'], $address['phone'], $address['address1'], $address['address2'],
                $address['city'], $address['state'], $address['zip'], $address['country']
            );
            DB::table('customers_address') -> insert($address);
            DB::table('orders') -> where('id', $order -> id) -> update([
                'a_id' => $ids[1],
                'address' => $addressString,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            // 服务端保存数据失败
            DB::rollBack();
            Log::warning('保存订单收件地址失败 ' . $e -> getMessage());
            return abort(500);
        }

        $paymentInfo = [
            'amount' => $order -> total / 100,
            'currency' => 'USD',
            'description' => 'ITLS website order: ' . $order -> id,
            'card' => [
                'number' => $request -> paymentCCNumber,
                'expiryMonth' => $request -> paymentCCExpMonth,
                'expiryYear' => $request -> paymentCCExpYear,
                'cvv' => $request -> paymentCCCVV,
            ]
        ];

        $result = $this -> stripePay($paymentInfo, $order -> id);
        $result['id'] = $ids[2];
        if ($result['status'] == 1) {
            // 支付成功
            try {
                DB::beginTransaction();
                DB::table('payments') -> insert($result);
                DB::table('orders') -> where('id', $order -> id) -> update(['status' => $result['status']]);
                DB::commit();
            } catch (\Exception $e) {
                // TODO 支付成功， 但是保存数据失败 需要邮件通知管理员进行处理
                DB::rollBack();
                $error = sprintf('%s - 订单支付成功，支付结果信息：%s，但数据库保存失败，错误信息：', $order -> id, json_encode($result), $e -> getMessage());
                Log::warning($error);
                // 通过队列向管理员发送邮件信息
                $this -> sentMail($error);
            }
            // TODO 向用户发送邮件信息 $request -> email
            // 跳转到 success 结果

            $mail = (object) [
                'id' => $order -> id,
                'recipient' => $request -> name,
                'site' => SITE,
                'amount' => $paymentInfo['currency']  . ': ' . number_format($paymentInfo['amount'], 2),
                'email' => $request -> email,
                'detail' => $this -> getOrderDetail($order),
                'address' => $addressString
            ];
            $this -> sentMail($mail, 1);
            return redirect(route(SITE . 'CheckoutResult')) -> with('success', $request -> name);
        } elseif($result['status'] == 0) {
            // 支付失败
            Log::error(sprintf('【支付失败】订单：%s，错误信息：%s', $order -> id, $result['response']));
            return redirect(route(SITE . 'ReCheckoutForm', ['id' => $order -> id])) -> with('error', json_decode($result['response'], true)['failure_message']);
        } elseif($result['status'] == -1) {
            // redirect ?
            Log::error(sprintf('【支付失败】订单：%s，错误信息：%s', $order -> id, $result['response']));
            return ;
        } else {
            // -999 卡片信息错误
            Log::error(sprintf('【支付失败】订单：%s，错误信息：%s', $order -> id, $result['response']));
            return redirect(route(SITE . 'ReCheckoutForm', ['id' => $order -> id])) -> with('error', $result['response']);
        }
    }

    public function checkoutReSubmit(Request $request)
    {
        $years = $currentYear = date('Y');
        $months = '01,02,03,04,05,06,07,08,09,10,11,12';

        for($i = 0; $i < 10; $i++) {
            $currentYear += 1;
            $years .= ',' . $currentYear;
        }
        $rules = [
            'id' => 'required|exists:mysql_backend.orders,id',
            'name' => 'required|max:100|min:1',
            'email' => 'required|email|max:150|min:5',
            'phone' => 'required|max:20|min:5',
            'address1' => 'required|max:255',
            'address2' => 'max:255',
            'city' => 'required|max:100|min:2',
            'state' => 'required|max:100|min:2',
            'zip' => 'required|max:20|min:5',
            'country' => 'required|exists:mysql_backend.orders,car,id,' . $request -> id,
            'paymentCCName' => 'required|max:100|min:3',
            'paymentCCNumber' => 'required|max:20|min:12',
            'paymentCCExpMonth' => 'required|in:' . $months,
            'paymentCCExpYear' => 'required|in:' . $years,
            'paymentCCCVV' => 'required|max:5|min:3',
        ];
        $messages = [
            'id' => 'There is something wrong.',
            'name.required' => 'The recipient is required.',
            'name.max' => 'The length of recipient must be less than :max',
            'name.min' => 'The length of recipient must be greater than :min',
            'email.required' => 'The e-mail is required.',
            'email.email' => 'The e-mail is invalid.',
            'email.max' => 'The length of e-mail must be less than :max',
            'email.min' => 'The length of e-mail must be greater than :min',
            'phone.required' => 'The phone is required.',
            'phone.max' => 'The length of phone must be less than :max',
            'phone.min' => 'The length of phone must be greater than :min',
            'address1.required' => 'The address is required.',
            'address1.max' => 'The length of address 1 must be less than :max',
            'address2.max' => 'The length of address 2 must be less than :max',
            'city.required' => 'The city is required.',
            'city.max' => 'The length of city must be less than :max',
            'city.min' => 'The length of city must be greater than :min',
            'state.required' => 'The state is required.',
            'state.max' => 'The length of state must be less than :max',
            'state.min' => 'The length of state must be greater than :min',
            'zip.required' => 'The zip is required.',
            'zip.max' => 'The length of zip must be less than :max',
            'zip.min' => 'The length of zip must be greater than :min',
            'country.required' => 'The country is required.',
            'country.exists' => 'The country is mismatch with your selection.',
            'paymentCCName.required' => 'The credit card holder name is required.',
            'paymentCCName.max' => 'The length of credit card holder name must be less than :max.',
            'paymentCCName.min' => 'The length of credit card holder name must be greater than :min.',
            'paymentCCNumber.required' => 'The credit card number is required.',
            'paymentCCNumber.max' => 'The length of credit card number must be less than :max',
            'paymentCCNumber.min' => 'The length of credit card number must be greater than :min',
            'paymentCCExpMonth.required' => 'The card expiration is required.',
            'paymentCCExpMonth.in' => 'The card expiration is invalid.',
            'paymentCCExpYear.required' => 'The card expiration is required.',
            'paymentCCExpYear.in' => 'The card expiration is invalid.',
            'paymentCCCVV.required' => 'The CVV/CVV2 is required.',
            'paymentCCCVV.min' => 'The length of CVV/CVV2 must be greater than :min',
            'paymentCCCVV.max' => 'The length of CVV/CVV2 must be less than :min'
        ];

        $this -> validate($request, $rules, $messages);

        DB::setDefaultConnection('mysql_backend');

        // 先获取订单状态
        $order = DB::table('customers_address')
            -> select('orders.id', 'orders.car', 'orders.currency', 'orders.total', 'orders.source', 'customers_address.name', 'customers.email')
            -> leftJoin('orders', 'customers_address.id', '=','orders.a_id')
            -> leftJoin('customers', 'customers_address.c_id', '=','customers.id')
            -> where('orders.status', 0)
            -> where('orders.is_delete', 0)
            -> where('orders.id', $request -> id)
            -> first();
        if (is_null($order)) {
            // 订单已经支付
            return abort(404);
        }
        $customers = DB::table('customers')
            -> select('id')
            -> where('is_delete', 0)
            -> where('email', $request -> email)
            -> first();
        $ids = dk_get_next_ids(3);
        try {
            DB::beginTransaction();
            if (is_null($customers)) {
                DB::table('customers') -> insert([
                    'id' => $ids[0],
                    'name' => $request -> name,
                    'email' => $request -> email
                ]);
                $cid = $ids[0];
            } else {
                $cid = $customers -> id;
            }
            $address = [
                'id' => $ids[1],
                'c_id' => $cid,
                'country' => $this -> deliveryCountries[$order -> car],
                'name' => $request -> name,
                'phone' => $request -> phone,
                'address1' => $request -> address1,
                'address2' => $request -> address2 ? : '',
                'city' => $request -> city,
                'state' => $request -> state,
                'zip' => $request -> zip,
                'car' => $order -> car
            ];
            DB::table('customers_address') -> insert($address);
            $addressString = sprintf('%s, %s, %s, %s, %s, %s, %s, %s',
                $address['name'], $address['phone'], $address['address1'], $address['address2'],
                $address['city'], $address['state'], $address['zip'], $address['country']
            );
            DB::table('orders') -> where('id', $order -> id) -> update([
                'a_id' => $ids[1],
                'address' => $addressString,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            // 服务端保存数据失败
            DB::rollBack();
            Log::warning('保存订单收件地址失败 ' . $e -> getMessage());
            return abort(500);
        }

        $paymentInfo = [
            'amount' => $order -> total / 100,
            'currency' => 'USD',
            'description' => 'ITLS website order: ' . $order -> id,
            'card' => [
                'number' => $request -> paymentCCNumber,
                'expiryMonth' => $request -> paymentCCExpMonth,
                'expiryYear' => $request -> paymentCCExpYear,
                'cvv' => $request -> paymentCCCVV,
            ]
        ];
        $result = $this -> stripePay($paymentInfo, $order -> id);
        if ($result['status'] == 1) {
            $result['id'] = $ids[2];
            // 支付成功
            try {
                DB::beginTransaction();
                DB::table('payments') -> insert($result);
                DB::table('orders') -> where('id', $order -> id) -> update(['status' => $result['status']]);
                DB::commit();
            } catch (\Exception $e) {
                // TODO 支付成功， 但是保存数据失败 需要邮件通知管理员进行处理
                DB::rollBack();
                $error = sprintf('%s - 订单支付成功，支付结果信息：%s，但数据库保存失败，错误信息：', $order -> id, json_encode($result), $e -> getMessage());
                Log::warning($error);
                // 通过队列向管理员发送邮件信息
                $this -> sentMail($error);
            }
            // TODO 向用户发送邮件信息 $request -> email
            // 跳转到 success 结果
            $mail = (object) [
                'id' => $order -> id,
                'recipient' => $request -> name,
                'site' => SITE,
                'amount' => $paymentInfo['currency']  . ': ' . number_format($paymentInfo['amount'], 2),
                'email' => $request -> email,
                'detail' => $this -> getOrderDetail($order),
                'address' => $addressString
            ];
            $this -> sentMail($mail, 1);
            return redirect(route(SITE . 'CheckoutResult')) -> with('success', $order -> name);

        } elseif($result['status'] == 0) {
            // 支付失败
            Log::error(sprintf('【支付失败】订单：%s，错误信息：%s', $order -> id, $result['response']));
            return redirect(route(SITE . 'ReCheckoutForm', ['id' => $order -> id])) -> with('error', json_decode($result['response'], true)['failure_message']);
        } elseif($result['status'] == -1) {
            // redirect
            Log::error(sprintf('【支付失败】订单：%s，错误信息：%s', $order -> id, $result['response']));
            return ;
        } else {
            // -999 卡片信息错误
            Log::error(sprintf('【支付失败】订单：%s，错误信息：%s', $order -> id, $result['response']));
            return redirect(route(SITE . 'ReCheckoutForm', ['id' => $order -> id])) -> with('error', $result['response']);
        }
    }
    /**
     * 支付操作
     * @param array $paymentInfo
     * @param int $orderId
     * @return mixed|null|string
     */
    private function stripePay($paymentInfo = [], $orderId = 0)
    {
        $gateway = Omnipay::create('Stripe');
        $gateway-> setApiKey(config('app.strip.sk'));
        try {
            $response = $gateway->purchase($paymentInfo)->send();
            if ($response->isRedirect()) {
                // redirect to offsite payment gateway
                return ['status' => -1, 'response' => $response];
            } elseif ($response->isSuccessful()) {
                // payment was successful: update database
                if ($response -> getData()['paid'] && $response -> getData()['status'] == 'succeeded') {
                    // 支付成功
                    $payments = [
                        'o_id' => $orderId,
                        'status' => 1,  // 支付成功
                        'description' => $response -> getData()['description'],
                        'response' => '',
                        'method' => 0,  // stripe 标示
                        'card_id' => $response -> getData()['source']['id'],
                        'platform_time' => $response -> getData()['created'],
                        'charge_id' => $response -> getData()['id'],
                        'amount' => $response -> getData()['amount'],
                        'currency' => $response -> getData()['currency']
                    ];
                } else {
                    // 支付失败
                    $payments = [
                        'o_id' => $orderId,
                        'status' => 0, // 支付失败
                        'response' => json_encode([
                            'failure_code' => $response -> getData()['failure_code'],
                            'failure_message' => $response -> getData()['failure_message'],
                        ]),
                        'description' => $response -> getData()['description'],
                        'method' => 0,  // stripe 标示
                        'card_id' => $response -> getData()['source']['id'],
                        'platform_time' => $response -> getData()['created'],
                        'charge_id' => $response -> getData()['id'],
                        'amount' => $response -> getData()['amount'],
                        'currency' => $response -> getData()['currency']
                    ];
                }
            } else {
                // payment failed: display message to customer
                $payments = [
                    'o_id' => $orderId,
                    'status' => 0, // 支付失败
                    'response' => json_encode([
                        'failure_code' => $response -> getData()['error']['code'],
                        'failure_message' => $response -> getData()['error']['message'],
                    ]),
                    'description' => $response -> getData()['error']['doc_url'],
                    'method' => 0,  // stripe 标示
                    'card_id' => 'not exist because of error',
                    'platform_time' => 'not exist because of error',
                    'charge_id' => 'not exist because of error',
                    'amount' => 'not exist because of error',
                    'currency' => 'not exist because of error'
                ];
            }

        } catch (\Exception $e) {
            // 卡片信息错误
            $payments = ['status' => -999, 'response' => $e -> getMessage()];
        }
        return $payments;
    }

    public function checkoutSuccess()
    {
        return view('global.payment.result');
    }

    public function webHook(Request $request)
    {
        $inputJsonObj = @file_get_contents("php://input");
        Log::info(sprintf('【STRIPE_PAYMENT_WEBHOOK】Receive request from 【%s】, request body is "%s".',
            $request -> getClientIp(), json_encode(json_decode($inputJsonObj))));
        if ($request -> isJson()) {
            if ($request -> hasHeader('stripe-signature')) {
                $headerString = $request -> header('stripe-signature');
                Stripe::setApiKey(config('app.strip.sk'));
                try {
                    Webhook::constructEvent($inputJsonObj, $headerString, config('app.strip.sk'));

                    Log::info('【STRIPE_PAYMENT】web hook handle success:' . $inputJsonObj);
                    return response('success', 200);
                } catch (\UnexpectedValueException $e) {
                    Log::warning('【STRIPE_PAYMENT_WEBHOOK_ERROR】Exceptions @ L1: ' . $e -> getMessage());
                    return response($e -> getMessage(), 400);
                } catch (SignatureVerification $e) {
                    Log::warning('【STRIPE_PAYMENT_WEBHOOK_ERROR】Exceptions @ L2: ' . $e -> getMessage());
                    return response($e -> getMessage(), 400);
                } catch (\Exception $e) {
                    Log::warning('【STRIPE_PAYMENT_WEBHOOK_ERROR】Exceptions @ L3: ' . $e -> getMessage());
                    return response($e -> getMessage(), 400);
                }
            } else {
                Log::warning('【STRIPE_PAYMENT_WEBHOOK_ERROR】Request header "stripe-signature" not found.');
                return response('error', 400);
            }
        } else {
            Log::warning('【STRIPE_PAYMENT_WEBHOOK_ERROR】request body is not json.');
            return response('error, json request only', 400);
        }
    }
}