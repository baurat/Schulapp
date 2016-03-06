$(document).ready(function () {
    if ($(document).height() > $(window).height()) {
        // We need to duplicate the whole body of the website so if you scroll down you can see both the bottom and the top at the same time. Before we do this we need to know the original height of the website.
        var origDocHeight = document.body.offsetHeight;
        // now we know the height we can duplicate the body    
        $("#vertr_container").contents().clone().appendTo("#vertr_container");
        $(document).scroll(function () { // detect scrolling                   
            var scrollWindowPos = $(document).scrollTop(); // store how far we have scrolled

            if (scrollWindowPos >= origDocHeight) { // if we scrolled further then the original doc height
                $(document).scrollTop(0); // then scroll to the top
                scrollDown(); // Fahre fort mit herunterscrollen
            }
        });
    }

    $('table').floatThead({
        position: 'absolute'
    });

    makeslider();
    startTime();
    setDate();
    scrollDown();

});

function scrollDown() {
    if ($(window).width() >= 1200) {
        // http://stackoverflow.com/questions/8858994/let-user-scrolling-stop-jquery-animation-of-scrolltop
        // Assign the HTML, Body as a variable...
        var $viewport = $('html,body');

        var pixels_per_second = 75;
        var distance = $(document).height();
        var scroll_duration = (distance / pixels_per_second) * 1000;

        $viewport.stop().unbind('click scroll mousedown DOMMouseScroll mousewheel keyup');
        $viewport.animate({
            scrollTop: $(document).height()
        }, scroll_duration, 'linear');

        // Stop the animation if the user scrolls. Defaults on .stop() should be fine
        $viewport.bind("click scroll mousedown DOMMouseScroll mousewheel keyup", function (e) {
            if (e.which > 0 || e.type === "mousedown" || e.type === "mousewheel") {
                $viewport.stop().unbind('scroll mousedown DOMMouseScroll mousewheel keyup'); // This identifies the scroll as a user action, stops the animation, then unbinds the event straight after (optional)
                setTimeout(function () {
                    scrollDown();
                }, 10000);

            }
        });
    }
}

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    $('#clock').html(h + ":" + m + ":" + s);
    setTimeout(startTime, 500);
}

function setDate() {
    var today = new Date();
    var s = today.getDay();
    var d = checkTime(today.getDate());
    var m = checkTime(today.getMonth() + 1);
    var y = today.getFullYear();
    var tag = '';
    switch (s) {
        case 1:
            tag = 'Montag';
            break;
        case 2:
            tag = 'Dienstag';
            break;
        case 3:
            tag = 'Mittwoch';
            break;
        case 4:
            tag = 'Donnerstag';
            break;
        case 5:
            tag = 'Freitag';
            break;
        case 6:
            tag = 'Samstag';
            break;
        case 0:
            tag = 'Sonntag';
            break;
    }
    $('#date').html(tag + ', ' + d + '.' + m + '.' + y);
}

function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    // add zero in front of numbers < 10
    return i;
}

function toggleLeftColumn() {
    if ($('#leftColumn').hasClass('hidden-xs')) {
        $('#leftColumn').removeClass('hidden-xs');
    } else {
        $('#leftColumn').addClass('hidden-xs');
    }
    if ($('#leftColumn').hasClass('hidden-sm')) {
        $('#leftColumn').removeClass('hidden-sm');
    } else {
        $('#leftColumn').addClass('hidden-sm');
    }
    $('#meldungen').slick('unslick');
    makeslider();
}

function makeslider() {
    $('#meldungen').slick({
        dots: true,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        arrows: false,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000
    });
}