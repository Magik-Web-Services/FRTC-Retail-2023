jQuery(document).ready(function () {
    $(window).scroll(function () {
        var sticky = $('.navbar-fixed'),
            scroll = $(window).scrollTop();
        if (scroll >= 100) sticky.addClass('fixed-headr');
        else sticky.removeClass('fixed-headr');
    });
    $(window).scroll(function () {
        var sticky = $('.bgsgsgcls'),
            scroll = $(window).scrollTop();
        if (scroll >= 100) sticky.addClass('fixed-headr');
        else sticky.removeClass('fixed-headr');
    });
});
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

$(document).ready(function() {
    $(".drop_manu").hide();
    $(".dropdown-toggle.hide_sec").click(function() {
        jQuery(".drop_manu").toggal('');
    });
});

window.addEventListener("load", function() {
    window.wpcc.init({
        "border": "thin",
        "corners": "small",
        "transparency": "5%",
        "colors": {
            "popup": {
                "background": "#111111",
                "text": "#ffffff",
                "border": "#222222"
            },
            "button": {
                "background": "#FFFFFF",
                "text": "#000000"
            }
        },
        "position": "bottom"
    })
});