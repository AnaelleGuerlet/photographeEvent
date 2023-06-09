//début : ajax
jQuery(document).ready(function($) {
    // Code that uses jQuery's $ can follow here.

$(".load-posts").click(function(){ 
    const ajaxurl = $(this).attr('action');
    $("#post-container").html("loading...");
    $.ajax({
        url: frontend_ajax_object.ajaxurl,
        type: 'post',
        data: {
            action: 'post_cart_clb',
        },
        success: function(data) {
            $("#post-container").html(data);
        },
        fail: {
            // What I have to do...
        }
    });
    return false;
});
});
//fin : ajax