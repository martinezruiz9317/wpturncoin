<?php
/*
* Template name: Vision
*/
// include head
get_header();
?>
<div id="fullpage">
    <div id="visionSectionHeader" class="section fp-auto-height">
        <div class="d-flex flex-column justify-content-end vision-cnt">
            <div class="container text-center">
                <h3 class="c-gold">People are passionate beings, made to create and achieve greatness. </h3>
                <h1 class="light-col" style="margin-bottom: 20px;">A VISION DRIVEN BY PEOPLE</h1>
                <div style="width: 720px; max-width: 100%; margin: 0 auto;">
                    <p class="light-col" style="margin-bottom: 20px;">TheXchange™ is a people-driven platform that helps individuals achieve their dreams, while giving their fans a vehicle to support them and share in their success.</p>

                    <p class="light-col" style="margin-bottom: 20px;">Our strength lies in our united and whole-hearted belief that TheXchange™ will
                        be a phenomenal success, as it will empower people worldwide to pursue their aspirations and achieve their dreams.</p>

                    <p class="light-col" style="margin-bottom: 20px;">In challenging times people need hope. People need the opportunity to pursue their heart’s desire. If they have talent, passion and the will to fight for their dreams, TheXchange™ will give them that opportunity!</p>
                </div>
                <div class="vision-coin">
                    <img width="550" src="<?php echo get_stylesheet_directory_uri(); ?>/images/half-coin.png" alt="">
                </div>
            </div>
            <div class="vision-bot-header">Innovation.<span style="font-weight: 700;" class="c-gold">Passion</span>.Heart.<span style="font-weight: 700;" class="c-gold">Success</span></div>
        </div>
    </div>
    <div id="iphonesSec" class="section">
        <div class="container h-100">
            <div class="my-row align-items-center h-100">
                <div class="my-col-7">
                    <!-- <img width="400" src="assets/images/phone-top.png" alt=""><img width="400" src="assets/images/phone-bottom.png" alt=""> -->
                    <div id="iphones3d" class="iphones-wrapper" data-offset="0">
                        <div class="layer-bg parallax" data-offset="0">
                            <div class="layer-1 clerfix parallax" data-offset="20">
                                <div class="layer-2 parallax" data-offset="15">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="my-col-5 vison-phones-x-logo"><?php echo file_get_contents( get_stylesheet_directory_uri().'/images/vision-xchange-logo.svg') ?>
                    <p>Our platform will have the ability to generate specialized sub-exchanges worldwide, in any language and in any currency.</p>

                    <p>It will follow the same unique and insanely-simple business model that can be duplicated regionally internationally, nationally, and even for event-specific exchanges.</p>
                    <button class="my-btn"><span>Buy turncoin</span></button>
                </div>
            </div>
        </div>
    </div>
    <div id="simplyPowerful" class="section fp-auto-height">
        <div class="container">
            <div class="my-row">
                <div class="my-col-12 text-center sp-pfp">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/pfp.png" alt="">
                </div>
                <div class="my-col-12 text-center sp-btn">
                    <button class="my-btn light-col" style="margin-top:-30px;margin-bottom:30px;"><span>Buy turncoin</span></button>
                </div>
                <div class="my-col-md-6 text-right sp-paragraph">
                    <h1 style="font-weight: 800; text-transform: uppercase; margin-bottom: 20px;"><span class="c-gold" style="font-family: rajdhani; font-weight: 700;">Turn</span><span class="light-col" style="font-family: rajdhani; font-weight: 400;">Coin™</span></h1>
                    <p class="light-col" style="margin-bottom: 20px;">TurnCoin™ is the Security Token of TheXchange™, it is a Mega-Token that has the potential to yield significant monthly turnover yields from sub-exchanges worldwide and therefore appreciate in value.</p>
                    <p class="light-col" style="margin-bottom: 20px;">“Sub-exchanges” will range from: SportXchanges™, CelebrityXchanges™, PoliticianXchanges™, MusicianXchanges™, ActorXchanges™, and various BusinessXchanges™</p>
                    <p class="light-col">On our open-source platform, people’s imagination will be the only limitation to the type of sub-exchanges they can create.</p>
                    <p class="light-col">TheXchange’s success will be potentially driven by thousands of sub-exchanges worldwide that will generate returns for TurnCoin™ holders.</p>
                </div>
                <div class="my-col-md-6 text-center sp-img">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/simply-powerful-img.jpg" alt="">
                </div>
                <div class="my-col-12 text-center sp-text" style="margin-top:50px;">
                    <h3>Simply Powerful</h3>
                </div>
            </div>
        </div>
    </div>
    <div id="ourVision" class="section">
        <div class="container h-100">
            <div class="my-row align-items-center h-100">
                <div class="my-col-6 text-center ov-col-1">
                    <img width="450" src="<?php echo get_stylesheet_directory_uri(); ?>/images/cards.png" alt="">
                    <a href="<?php echo get_site_url().'/summary/'; ?>"><button  class="my-btn"><span>Why this time?</span></button></a>
                </div>
                <div class="my-col-6 ov-col-2">
                    <h3 class="c-gold">Simply Powerful</h3>
                    <h2>Our Vision</h2>
                    <p>To make TheXchange™ the most useful, life-changing and most powerful online platform in the world!</p>

                    <p>TheXchange™ creates unity of purpose through passion. A new way of “living life to the fullest.” A new way of monetizing anything in the world; any concept, any business and especially people and their dreams…</p>

                    <p>Sounds complicated? No! It’s insanely simple: Allow people to dream and showcase their vision, and give supporters with fortitude and insight the opportunity to make a generous return by investing in people.</p>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
// include footer
get_footer();