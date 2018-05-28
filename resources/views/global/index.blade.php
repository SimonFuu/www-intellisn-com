@extends('layouts.common')
@section('main')
    <div id="overview">
        <div>
            <div class="text-center intro-block text-white">
                <p class="domilamp-overview-title">超智趣·木作·氛围灯</p>
                <p class="domilamp-overview-second-title">化身骨牌的灯，随心编排，百转千回，一触即发</p>
            </div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/Intro.png' }}" width="100%" alt="">
        </div>
        <div class="domilamp-overview-light">
            <div class="text-center intro-block text-white">
                <p class="text-dark" style="">五种光效标题</p>
                <div class="intro-block-lights">
                    <span class="text-dark inline-block">珍珠白</span>
                    <span class="text-dark inline-block">象牙白</span>
                    <span class="text-dark inline-block">牛奶金</span>
                    <span class="text-dark inline-block">浅琥珀</span>
                    <span class="text-dark inline-block">烛光</span>
                </div>
            </div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/light.png' }}" width="100%" alt="">
        </div>
        <div>
            <div class="text-center intro-block text-white">
                <div class="text-right domilamp-overview-wood">
                    <p class="inline-block domilamp-overview-wood-title">精工木作</p>
                    <p class="mt-10 text-gray">精细雕刻，一体成型实木底座</p>
                    <p>美国胡桃|巴西花梨</p>
                </div>
                <div class="text-left inline-block bold text-gray domilamp-overview-wood-eg">
                    <p class="domilamp-overview-wood-eg-title">
                        美国胡桃木
                    </p>
                    <p>
                        原产地：北美洲
                    </p>
                </div>

            </div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/wood.png' }}" width="100%" alt="">
        </div>
        <div>

            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/Customcap.png' }}" width="100%" alt="">
        </div>
        <div>
            <div class="intro-block text-white">
                <div class="text-left inline-block domilamp-overview-cap">
                    <p class="domilamp-overview-cap-title"><strong>艺术灯罩 晶莹剔透</strong></p>
                    <p class="mt-10">聚碳酸酯(PC)灯罩含光扩散剂</p>
                    <p>360度旋转，仿老式调光器</p>
                    <p>双向24步操作</p>
                    <p>实木顶盖</p>
                    <p>通风槽</p>
                </div>
            </div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/shade.png' }}" width="100%" alt="">
        </div>
        <div>
            <div class="intro-block text-white">
                <div class="inline-block text-black domilamp-overview-rotation">
                    <p class="domilamp-overview-rotation-title"><strong>360度双向无极旋转</strong></p>
                    <p class="mt-10">复古优雅 致敬经典</p>
                    <p>指尖温柔 华彩尽显</p>
                </div>
            </div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/Rotation.png' }}" width="100%" alt="">
        </div>
        <div>
            <div class="intro-block text-white">
                <div class="inline-block domilamp-overview-vibration">
                    <p class="domilamp-overview-vibration-title">静音震动 及时反馈</p>
                    <p class="mt-10">最亮一刻 指尖告诉您</p>
                </div>
            </div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/Vibration.png' }}" width="100%" alt="">
        </div>
    </div>
    <hr>
    <div id="domi">
        <div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/Dom.png' }}" width="100%" alt="">
        </div>
    </div>
    <hr>
    <div id="tech">
        <div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/tech/1.png' }}" width="100%" alt="">
        </div>
        <div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/tech/2.png' }}" width="100%" alt="">
        </div>
        <div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/tech/3.png' }}" width="100%" alt="">
        </div>
        <div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/tech/4.png' }}" width="100%" alt="">
        </div>
    </div>
@endsection