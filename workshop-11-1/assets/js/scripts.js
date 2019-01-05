;(function ( $, window, document ) {


    $('body').on('click', 'a.rml_bttn', function() {
        
        // fire off an annoying alert
        alert('on click event triggered');

        // get value
        var post_id = $(this).data('post-id');

        alert('post id is: ' + post_id );

        // This does the ajax request
        $.ajax({
            type : "post",
            dataType : "json",
            url : workshop_additional_js_vars.ajaxurl,
            data: {
                'action'  : 'get_post_info',
                'post_id' : post_id,
                'security' : workshop_additional_js_vars.ajax_nonce
            },
            success: function(data) {
                // This outputs the result of the ajax request
                console.log(data);
                alert('success');
            },
            error: function(errorThrown){
                console.log(errorThrown);
                alert('error');
            }
        });

    });

})( jQuery , window, document );