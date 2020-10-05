jQuery(document).ready(function ($) {

    // Home Product Carousel
    $('.gallery-car').slick({
        prevArrow: '<a type="button" class="slick-prev d-flex justify-content-center"><img src="http://turncoin.news/wp-content/themes/turncoin/images/angle-left.svg" width="12" /></a>',
        nextArrow: '<a type="button" class="slick-next d-flex justify-content-center"><img src="http://turncoin.news/wp-content/themes/turncoin/images/angle-right.svg" width="12" /></a>',
        dots: true,
        responsive: [{ breakpoint: 1025, settings: { slidesToShow: 1, slidesToScroll: 1 } }, { breakpoint: 769, settings: { slidesToShow: 1, slidesToScroll: 1 } }, { breakpoint: 481, settings: { slidesToShow: 1, slidesToScroll: 1 } }],
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
    });
    $(".close-popup-member").click(function (e) {
        e.preventDefault();
        $("#member-modal").removeClass('pop-is-open');
        $("html").removeClass('noscroll');
        $("body").removeClass('noscroll');
        // $("#member-modal").animate({
        //     width: '0',
        // }, 100, function() {

        // });
    });

    // Timeline Slider
    $('#timelineTop').slick({
        prevArrow: '',
        nextArrow: '',
        dots: false,
        variableWidth: true,
        autoplaySpeed: 0,
        responsive: [{ breakpoint: 1025, settings: { slidesToShow: 1, slidesToScroll: 1 } }, { breakpoint: 769, settings: { slidesToShow: 1, slidesToScroll: 1 } }, { breakpoint: 481, settings: { slidesToShow: 1, slidesToScroll: 1 } }],
        infinite: true,
        autoplay: true,
        speed: 5000,
        cssEase: 'linear',
        pauseOnFocus: false,
        slidesToShow: 3,
        slidesToScroll: 1,
    });

    // Dark Mode toggle
    $('#darkmode').bind('change', function () {
        console.log('Toogle Clicked');
        if ($(this).prop('checked') && $('body').hasClass('light-mode')) {
            console.log('Activating Dark Mode');
            $('body').removeClass('light-mode').addClass('dark-mode');
            var tid = 0;
        }
        else {
            console.log('Activating Light Mode');
            $('body').removeClass('dark-mode').addClass('light-mode');
            var tid = 1;
        }
        $.ajax({
            url: adurl,
            data: {
                settheme: tid,
                action: 'turncoin_set_thememode_cookie',
                security: dms
            },

            success: function (response) {
                if (jQuery("#member-modal").hasClass('pop-is-open')) {
                    jQuery("#member-modal").removeClass('pop-is-open');
                    // jQuery("#member-modal").animate({
                    //     width: '0',
                    // }, 0, function() {

                    // });
                }
                if (response['error'] == '1') {
                    console.log('There was an error setting the theme mode');
                }
                else {
                    console.log('Theme Mode: ' + response['mode_set']);
                }
            }
        });
    });
    // Dark Mode toggle end

    // Hero 3d effect
    $('#homeHeader3d').mousemove(function (e) {
        onheaderMove(e);
    });
    $('#myHero').mousemove(function (e) {
        onheaderMove(e);
    });
    function onheaderMove(e) {
        var winHeight = $(window).height();
        var winWidth = $(window).width();

        var dx = 0.5 - (e.pageX / winWidth);
        var dy = 0.5 - (e.pageY / winHeight);

        $('.parallax').each(function (index, el) {

            var $el = $(el);
            var offX = dx * $el.data('offset');
            var offY = dy * $el.data('offset');

            // console.log(offX, offY);

            TweenMax.to($el, 0.2, {
                x: offX,
                y: offY
            });
            TweenMax.to($el, 0.2, {
                rotationY: offX * 0.30,
                rotationX: offY * 0.30
            });
        });

        // TweenMax.to($('.layer-1'), 0.2, {rotationY: dx , rotationX: -dy});

        // console.log(dx, dy);
    }

    $('#homeHeader3d').on('mouseout', function (e) {
        onmouseOut(e);
    });
    $('#myHero').on('mouseout', function (e) {
        onmouseOut(e);
    });



    function onmouseOut(e) {
        $('.parallax').each(function (index, el) {

            TweenMax.to(el, 0.2, {
                x: 0,
                y: 0,
                ease: Quad.easeOut
            });
            TweenMax.to(el, 0.2, {
                rotationY: 0,
                rotationX: 0
            });
        });
    }
    // TweenMax.to($('.layer-1'), 0.2, {rotationY: 0, rotationX: 0});
    // Hero 3d effect end



    // Iphones 3d effect

    $('#iphones3d').mousemove(function (e) {
        var winHeight = $(window).height();
        var winWidth = $(window).width();

        var dx = 0.5 - (e.pageX / winWidth);
        var dy = 0.5 - (e.pageY / winHeight);

        $('.parallax').each(function (index, el) {

            var $el = $(el);
            var offX = dx * $el.data('offset');
            var offY = dy * $el.data('offset');

            // console.log(offX, offY);

            TweenMax.to($el, 0.2, {
                x: offX,
                y: offY
            });
            TweenMax.to($el, 0.2, {
                rotationY: offX * 0.30,
                rotationX: offY * 0.30
            });
        });

        // TweenMax.to($('.layer-1'), 0.2, {rotationY: dx , rotationX: -dy});

        // console.log(dx, dy);
    });

    $('#iphones3d').on('mouseout', function (e) {

        $('.parallax').each(function (index, el) {

            TweenMax.to(el, 0.2, {
                x: 0,
                y: 0,
                ease: Quad.easeOut
            });
            TweenMax.to(el, 0.2, {
                rotationY: 0,
                rotationX: 0
            });
        });

        // TweenMax.to($('.layer-1'), 0.2, {rotationY: 0, rotationX: 0});

    });

    // Iphones 3d effect end


    // Scrolling Init
    $('#fullpage').fullpage({
        //options here
        navigation: true,
        navigationPosition: 'right',
        showActiveTooltip: true,
        slidesNavigation: true,
        fitToSection: false,
        fadingEffect: true,
        autoScrolling: false,
        loopBottom: false,
        loopTop: false,
        easing: 'easeInOutCubic',
        verticalCentered: false,
    });
    // Scrolling Init end

});

// Rotating Coin
var largecoin = document.getElementById("largecoin");
if (largecoin) {
    window.addEventListener("scroll", function () {
        largecoin.style.transform = "rotate(" + window.pageYOffset / 4 + "deg)";
    });
}

// Toggle Phones
function switchPhone(evt, phTarget) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(phTarget).style.display = "block";
    evt.currentTarget.className += " active";
}
// Get the element with id="defaultOpen" and click on it
var dopen = document.getElementById("defaultOpen");
if (dopen) {
    dopen.click();
}