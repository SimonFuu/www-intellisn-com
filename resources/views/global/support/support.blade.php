@extends('layouts.common')
@section('main')
    <!-- -->
    <section>
        <div class="container">
            <h2>Manual</h2>
            <div class="row">
                <div class="col-md-8">
                    <img class="domilamp-manual-image" data-toggle="modal" data-target="#manual-img-modal" src="{{ CDN_SERVER }}/images/introduce/domilamp/domilamp-manual.png" alt="" width="100%">

                    <div class="text-center mt-50">
                        <p class="domilamp-manual-image-intro" data-toggle="modal" data-target="#manual-img-modal">Click to enlarge</p>
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="domilamp-manual-content">
                        <div>
                            <h4>“Domi” Switch:</h4>
                            Toggled - “Domi” mode (Receives and sends synchronization signals); <br>
                            Released - standalone mode (The “Domi” functionality is off).
                        </div>
                        <div>
                            <h4>State Indicator:</h4>
                            Flashes Quickly - in synchronization; Flashes Slowly - low battery;  <br>
                            Breathes - being recharged.
                        </div>
                        <div>
                            <h4>Storage Switch:</h4>
                            Up - Cuts off the power supply from batteries (for long-distance shipment, long-term storage purposes); Does not apply when the power adapter is connected;<br>
                            Down - Enables the power supply from batteries; <br>
                            The lamp is always rechargeable regardless of the up/down status.
                        </div>
                        <div>
                            <h4>Power/Extension Dock:</h4>
                            Provides a USB port to be connected to a power adapter;<br>
                            Reuses the USB port to work as a USB device which can be connected and configured with a PC.
                        </div>
                        <div>
                            <h4>Reset Holes:</h4>
                            Reserved for further firmware updates.
                        </div>
                        <div>
                            <h4>Mounting Holes:</h4>
                            Reserved for further accessories.
                        </div>
                    </div>
                </div>
            </div>
            <h2>FAQs</h2>
            <!-- FILTER -->
            <ul class="nav nav-pills mix-filter mb-30">
                <li data-filter="all" class="filter active"><a href="#">All</a></li>
                <li data-filter="product" class="filter"><a href="#">Product</a></li>
                <li data-filter="design" class="filter"><a href="#">Design</a></li>
                <li data-filter="others" class="filter"><a href="#">Others</a></li>
            </ul>
            <!-- /FILTER -->

            <div class="row mix-grid">

                <!-- LEFT COLUMNS -->
                <div class="col-md-9">

                    <!-- TOGGLES -->
                    <div class="toggle toggle-transparent toggle-bordered-simple">

                        <div class="toggle mix design"><!-- toggle -->
                            <label>1. Why is the lamp called DomiLamp?</label>
                            <div class="toggle-content">
                                <p class="clearfix">
                                    Dominoes is a family of games played with rectangular "domino" tiles. We've all seen those amazing displays of a multitude of dominoes toppling over one by one.
                                </p>
                                <p class="clearfix">
                                    At the beginning of this project, we decided to assign a unique ability to our lamps to make them interact like dominoes. So we defined a feature named "Domi" and finally we made it. That's exactly why the lamp is called DomiLamp.
                                </p>
                            </div>
                        </div><!-- /toggle -->

                        <div class="toggle mix design"><!-- toggle -->
                            <label>2. What is the most special feature of DomiLamp compared with other lamps?</label>
                            <div class="toggle-content">
                                <p class="clearfix">
                                    The feature is called "Domi". With it enabled, when two or more lamps are within a certain distance(about 13ft/4m), a light change of one lamp could be easily transmitted to others around it. Then, those lamps which received the change would adjust their light color and intensity to match the first lamp's. This effect would then spread from those lamps to outer lamps if existed. The amazing thing is that "Domi" could work with any number of DomiLamps, without any configurations.
                                </p>
                            </div>
                        </div><!-- /toggle -->

                        <div class="toggle mix product"><!-- toggle -->
                            <label>3. What type of plug and voltage does the DomiLamp adapter have?</label>
                            <div class="toggle-content">
                                <p class="clearfix">
                                    DomiLamp is compatible with 110V and 220V. We can provide you with a US or CN plug. Since the plug and voltage conditions vary per country, we recommend that purchasers from other countries make sure they have the right plug adapter and converter needed in their country.
                                </p>
                            </div>
                        </div><!-- /toggle -->

                        <div class="toggle mix product"><!-- toggle -->
                            <label>4. How long do I need to charge my DomiLamp?</label>
                            <div class="toggle-content">
                                <p class="clearfix">
                                    You need about 5 hours to fully charge it.
                                </p>
                            </div>
                        </div><!-- /toggle -->

                        <div class="toggle mix product"><!-- toggle -->
                            <label>5. What kind of batteries does DomiLamp have?</label>
                            <div class="toggle-content">
                                <p class="clearfix">
                                    There're 2 bulit-in Li-ion battery packs. Each pack has 2 cells inside, providing an output of 7.4V DC. The total capacity is 1600mAh.
                                </p>
                            </div>
                        </div><!-- /toggle -->

                        <div class="toggle mix design"><!-- toggle -->
                            <label>6. How many light colors does DomiLamp have?</label>
                            <div class="toggle-content">
                                <p class="clearfix">
                                    There're 3 types of light with adjustable intensity: candle light, warm white and cool white light.
                                </p>
                            </div>
                        </div><!-- /toggle -->

                        <div class="toggle mix product"><!-- toggle -->
                            <label>7. Is DomiLamp available in my country?</label>
                            <div class="toggle-content">
                                <p class="clearfix">
                                    Yes, we deliver to all countries in which Kickstarter is available, unless your country is an embargoed nation.
                                </p>

                            </div>
                        </div><!-- /toggle -->

                        <div class="toggle mix product"><!-- toggle -->
                            <label>8. Is there a warranty on DomiLamp?</label>
                            <div class="toggle-content">
                                <p class="clearfix">
                                    Yes, we provide a 1-year warranty. Under normal usage, if malfunction or damage occurs, you can send your DomiLamp back to us and we'll fix it. Please don't try to fix the DomiLamp yourself. Opening the lamp would void your warranty.
                                </p>
                            </div>
                        </div><!-- /toggle -->

                        <div class="toggle mix others"><!-- toggle -->
                            <label>9. How can I contact Intellisn?</label>
                            <div class="toggle-content">
                                <p class="clearfix">
                                    You could contact us by submitting your message via the contact form at the bottom of this page.
                                </p>
                                <p class="clearfix">
                                    Social media is also important place for us to publish project progress, future plans and promotional activities. Follow us on
                                    <a href="https://www.facebook.com/intellisn" target="_blank">Facebook</a> or <a href="https://twitter.com/intellisn" target="_blank">Twitter</a> to make sure you don't miss out on any valuable information.
                                </p>
                            </div>
                        </div><!-- /toggle -->
                    </div>

                </div>
            </div>
        </div>
    </section>


    {{--domilamp modal--}}
    <div class="modal fade manual-img-modal" id="manual-img-modal" tabindex="-1" role="dialog" aria-labelledby="manual-img-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg manual-img-modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <img src="{{ CDN_SERVER }}/images/introduce/domilamp/domilamp-manual.png" alt="" width="100%">
                </div>
            </div>
        </div>
    </div>
@endsection