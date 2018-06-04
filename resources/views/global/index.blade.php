@extends('layouts.common')
@section('main')
    <div id="overview">
        <div>
            <div class="text-center intro-block text-white">
                <p class="domilamp-overview-title">DomiLamp</p>
                <p class="domilamp-overview-second-title">
                    An artistic wooden lamp with simple look and feel <br />
                    A smart lamp with unique ability to interact with peers without any configurations
                    An interesting lamp, acting as dominoes
                </p>
            </div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/Intro.png' }}" width="100%" alt="">
        </div>
        <div class="domilamp-overview-light">
            <div class="text-center intro-block text-white">
                <p class="text-dark">5 colors, 8 directions, offering you a desirable atmosphere</p>
            </div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/light.png' }}" width="100%" alt="">
        </div>
        <div>
            <div class="text-center intro-block text-white">
                <div class="text-right domilamp-overview-wood">
                    <p class="inline-block domilamp-overview-wood-title">Wood Works</p>
                    <p style="margin-top: 1vh"><b>A wooden lamp with an exquisite base engraved from a complete solid wood, providing you with the best experience.</b></p>
                    <p style="margin-top: 1vh">American Walnut / Brazilian Rosewood</p>
                    <p>Natural Oil Finish</p>
                    <p>Handheld Design</p>
                </div>
                {{--<div class="text-left inline-block bold text-gray domilamp-overview-wood-eg">--}}
                    {{--<p class="domilamp-overview-wood-eg-title">--}}
                        {{--美国胡桃木--}}
                    {{--</p>--}}
                    {{--<p>--}}
                        {{--原产地：北美洲--}}
                    {{--</p>--}}
                {{--</div>--}}

            </div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/wood.png' }}" width="100%" alt="">
        </div>
        <div>
            <div class="intro-block text-white">
                <div class="text-left inline-block domilamp-overview-cap">
                    <p class="domilamp-overview-cap-title"><strong>Glass-like shade</strong></p>
                    <ul class="mt-10">
                        <li>Polycarbonate（PC）Shade w/ Light Diffuser</li>
                        <li>Solid Wood Cap</li>
                        <li>Ventilation Sink</li>
                    </ul>
                </div>
            </div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/shade.png' }}" width="100%" alt="">
        </div>
        <div>
            <div class="intro-block text-white">
                <div class="inline-block text-black domilamp-overview-rotation">
                    <p class="domilamp-overview-rotation-title"><strong>360° Rotation</strong></p>
                    <ul class="mt-10">
                        <li>Bi-directional 24-step Manipulation</li>
                        <li>Operating like an old-fashion dimmer</li>
                    </ul>
                </div>
            </div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/Rotation.png' }}" width="100%" alt="">
        </div>
        <div>
            <div class="intro-block text-white">
                <div class="inline-block domilamp-overview-vibration">
                    <p class="domilamp-overview-vibration-title">Comfortable Vibration Feedback</p>
                    <p class="mt-10">The internal vibration motor will get the fingers notified when each light is adjusted to the maximum level.</p>
                </div>
            </div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/Vibration.png' }}" width="100%" alt="">
        </div>
    </div>
    <hr>
    <div id="domi">
        <div>
            <div class="intro-block text-white">
                <div class="inline-block text-black domilamp-domi">
                    <p class="domilamp-domi-title"><strong>"Domi" Experience</strong></p>
                    <ul class="mt-10">
                        <li>Toggle Button for "Domi" Availablity</li>
                        <li>Light Synchronization between Lamps</li>
                        <li>Automatic Brightness Alignment</li>
                    </ul>
                </div>
            </div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/Dom.png' }}" width="100%" alt="">
        </div>
        <div class="mt-20 mb-20 container" style="font-size: 3vmin">
            With "Domi" enabled, when two or more lamps are within a certain distance(about <span class="text-red">26ft</span>),
            a light change of one lamp could be easily transmitted to others around it.
            Then, those lamps which received the change would adjust their light color and intensity to match the first lamp's.
            This effect would then spread from those lamps to outer lamps if existed.
            The amazing thing is that "Domi" could <strong>work with any number of DomiLamps, without any configurations.</strong>
        </div>
    </div>
    <div id="tech">
        <div>
            <div class="intro-block text-white">
                <div class="inline-block domilamp-tech-1 text-center">
                    <p class="domilamp-tech-1-title">
                        <b>WORLD'S FIRST</b>
                    </p>
                    <p><b>Led lamp</b></p>
                    <p><b>with 8 lighting boards</b></p>
                    <p><small><b>glowing from different angles</b></small></p>
                    <p><small><b>for a uniform lighting effect</b></small></p>
                    <p class="mt-15 text-gray">32 LEDs (1.3W Max)</p>
                    <p class="text-gray">for Candle Light</p>
                    <p class="domilamp-tech-1-math-symbol text-gray">+</p>
                    <p class="text-gray">96 LEDs (640lm / 7.2W Max)</p>
                    <p class="text-gray">for Warm White</p>
                    <p class="domilamp-tech-1-math-symbol text-gray">+</p>
                    <p class="text-gray">96 LEDs (810lm / 77W Max)</p>
                    <p class="text-gray">for Cool White</p>
                    <p class="domilamp-tech-1-math-symbol text-gray">=</p>
                    <p class="text-red">224 LEDs</p>
                </div>
            </div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/tech/1.png' }}" width="100%" alt="">
        </div>
        <div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/tech/2.jpeg' }}" width="100%" alt="">
        </div>
        <div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/tech/3.jpg' }}" width="100%" alt="">
        </div>
        <div>
            <img src="{{ CDN_SERVER . '/images/introduce/domilamp/tech/4.jpg' }}" width="100%" alt="">
        </div>
    </div>
    <hr>
@endsection