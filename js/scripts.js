//début : ajax
jQuery(document).ready(function($) {
    let currentPage = 1;
    $(".load-posts").click(function(){ 
        currentPage++;
        const ajaxurl = $(this).attr('action');
        $("#post-container").html("loading...");
        $.ajax({
            url: frontend_ajax_object.ajaxurl,
            type: 'post',
            data: {
                action: 'post_cart_clb',
                paged: currentPage,
            },
            success: function(data) {
                $("#post-container").html(data);
            },
            fail: {
                
            }
            
        });
        
        return false;
    });
});
//fin : ajax