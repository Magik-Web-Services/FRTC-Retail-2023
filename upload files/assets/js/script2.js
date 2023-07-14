var slideIndex = 1;

showDivs(slideIndex);



function plusDivs(n) {

    showDivs(slideIndex += n);

}



function showDivs(n) {

    var i;

    var x = document.getElementsByClassName("mySlides");

    if (n > x.length) {
        slideIndex = 1
    }

    if (n < 1) {
        slideIndex = x.length
    }

    for (i = 0; i < x.length; i++) {

        x[i].style.display = "none";

    }

    x[slideIndex - 1].style.display = "block";

}

function myFunction() {

    $('.header_sec_man').hide('slow')

}
$(document).ready(function () {





    $.ajax({

        type: "get",

        //url : "https://api.lovense.com/api/lan/getToys", //

        url: "<?php echo $lovenseApi ?>",

        dataType: "jsonp",

        success: function (data) {

            console.error(data);

        },

        error: function (e) {

            console.error(e);

        }

    });

    $(".windows_close_icon").click(function () {

        //alert('helllo');

        var input_data = "popshow_now";

        var post_data = {

            'chache_data': input_data

        };

        $.ajax({

            type: "POST",

            url: "<?php echo $siteurl ?>/cache.php",

            data: post_data,

            success: function (data) {

                // return success

                if (data.length > 0) {

                    //alert(data);

                }

            }

        });

    });

});