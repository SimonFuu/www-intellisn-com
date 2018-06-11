@extends('layouts.common')
@section('main')
    <div class="container">
        <ul class="nav nav-tabs nav-top-border mt-40" role="tablist">
            <li class="nav-item"><a class="nav-link active show" href="#help" data-toggle="tab">帮助</a></li>
            {{--<li class="nav-item"><a class="nav-link" href="#faqs" data-toggle="tab">FAQs</a></li>--}}
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active show" id="help">
                <div id="help-manual" class="pt-60">
                    <h2>产品概要</h2>
                    <div class="row">
                        <div class="col-md-8">
                            <img class="domilamp-manual-image" data-toggle="modal" data-target="#manual-img-modal" src="{{ CDN_SERVER }}/images/introduce/domilamp/domilamp-manual-zh.png" alt="" width="100%">
                        </div>

                        <div class="col-md-4">
                            <div class="domilamp-manual-content">
                                <div>
                                    <h4>“Domi” 开关：</h4>
                                    按下 - “Domi” 模式（接收和发送同步信号）<br>
                                    弹起 - 独立模式（“Domi” 功能关闭）
                                </div>
                                <div class="mt-35">
                                    <h4>状态指示灯：</h4>
                                    快速闪烁 - 同步中<br>
                                    缓慢闪烁 - 电量低<br>
                                    呼吸 - 充电中<br>
                                </div>
                                <div class="mt-35">
                                    <h4>储存开关：</h4>
                                    “Storage” - 切断电池供电 (用于长途运输、长期储存)，连接电源适配器时不适<br>
                                    向下 -  使用电池供电<br>
                                    无论 “Storage” 或向下，不影响 DomiLamp 电池充电
                                </div>
                                <div class="mt-35">
                                    <h4>电源/扩展坞：</h4>
                                    提供连接到电源适配器的 USB 端口<br>
                                    将 DomiLamp 作为 USB 设备连接至 PC 并进行配置
                                </div>
                                <div class="mt-35">
                                    <h4>组群键：</h4>
                                    见 “<a class="scrollTo" href="#help-groups">私有组群</a>” 详细说明
                                </div>
                                <div class="mt-35">
                                    <h4>挂载孔：</h4>
                                    为将来的配件预留
                                </div>
                                <div class="mt-35">
                                    <h4>橡胶垫：</h4>
                                    支撑和防滑
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="help-groups" class="pt-60">
                    <h2>
                        私有组群
                    </h2>
                    <p>出厂初始状态下，任何一盏DomiLamp无需任何配置即可与周围（有效通信距离内）的一盏或多盏DomiLamp实现联动。</p>
                    <p>如果您有多盏DomiLamp，并且有意让不同房间或区域的灯组独立工作，则必须配置私有组群，以确保任何一组和其他DomiLamp不产生联动。注意：如果您在每个房间或区域仅有一盏DomiLamp，则只需通过释放各自的Domi按键来解除联动功能。Domi按键说明参见<a class="scrollTo" href="#help-manual">"Domi功能说明"。</a></p>

                    <h3>新建私有组群</h3>
                    <p>该操作用于多盏DomiLamp的首次分组。</p>

                    <p>步骤：</p>
                    <ol>
                        <li>将需要成组的DomiLamp就近放置并开启至任一档位；</li>
                        <li>翻转以上任何一盏DomiLamp，将附带的顶针插入其底面小孔内（字母L拐角处），短压组群键并释放；</li>
                        <span style="margin-left: -1.2em">然后：</span>
                        <li>就近的、已开启的DomiLamp将自动加入成组；</li>
                        <li>已成组的所有DomiLamp将自动进入白光高亮模式，并以此提示新建组群操作成功。</li>
                    </ol>

                    <p>注意：</p>
                    <p>私有组群建立过程持续时间仅为3秒，请务必提前打开待入群的DomiLamp。</p>

                    <h3>加入私有组群</h3>
                    <p>该操作用于将一盏或多盏DomiLamp加入一个已经存在的组群。</p>

                    <p>步骤：</p>
                    <ol>
                        <li>开启已有组群内的任何一盏DomiLamp至任一档位；</li>
                        <li>将待加入组群的DomiLamp就近放置于已有组群并开启至任一档位；</li>
                        <li>翻转待加入组群的DomiLamp，将附带的顶针插入其底面小孔内（字母L拐角处），短压组群键并释放；</li>
                        <span style="margin-left: -1.2em">然后：</span>

                        <li>待加入组群的DomiLamp将自动加入就近的组群；</li>
                        <li>已加入组群的DomiLamp将自动调整档位，光效与该组群保持一致，并以此提示加入已有组群操作成功。</li>
                    </ol>

                    <p>注意：</p>
                    <p>如果待加入私有组群的DomiLamp本身位于另外一个组群内，则短压组群键不会导致其加入新的其他组群，除非其先从已有的组群内脱离。</p>

                    <h3>脱离私有组群</h3>
                    <p>该操作用于将一盏或多盏DomiLamp从一个私有组群内移除。</p>

                    <p>步骤：</p>
                    <ol>
                        <li>开启待脱离组群的一盏或多盏DomiLamp至任一档位；</li>
                        <li>翻转待脱离组群的DomiLamp，将附带的顶针插入其底面小孔内（字母L拐角处），长压（2秒以上）组群键并释放；</li>
                        <span style="margin-left: -1.2em">然后：</span>

                        <li>待脱离组群的DomiLamp将自动脱离组群；</li>
                        <li>已脱离组群的DomiLamp将在短暂震动后自动熄灭，并以此提示脱离组群操作成功。</li>
                    </ol>

                    <p>注意：</p>
                    <p>脱离私有组群的DomiLamp将恢复到出厂初始状态，可以与任何不在私有群组内的一盏或多盏DomiLamp联动。</p>
                </div>
            </div>

            <!-- FAQs -->
            {{--<div role="tabpanel" class="tab-pane fade" id="faqs">--}}
                {{--<div class="table-responsive">--}}
                    {{--<table class="table table-hover">--}}
                        {{--<thead>--}}
                        {{--<tr>--}}
                            {{--<th>Column name</th>--}}
                            {{--<th>Column name</th>--}}
                        {{--</tr>--}}
                        {{--</thead>--}}
                        {{--<tbody>--}}
                        {{--<tr>--}}
                            {{--<td>Size</td>--}}
                            {{--<td>2XL</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td>Color</td>--}}
                            {{--<td>Red</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td>Weight</td>--}}
                            {{--<td>132lbs</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td>Height</td>--}}
                            {{--<td>74cm</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td>Bluetooth</td>--}}
                            {{--<td><i class="fa fa-check text-success"></i> YES</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td>Wi-Fi</td>--}}
                            {{--<td><i class="fa fa-remove text-danger"></i> NO</td>--}}
                        {{--</tr>--}}
                        {{--</tbody>--}}
                    {{--</table>--}}
                {{--</div>--}}
            {{--</div>--}}

        </div>
    </div>
@endsection