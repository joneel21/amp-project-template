jQuery(document).ready(function($) {
    'use strict';

 
    var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
    var set_to_post_id = 0 // Set this

    
    $('.upload_logo').each(function(index, element) {      
        

        // If the media frame already exists, reopen it.
       /* if ( file_frame ) {
            // Set the post ID to what we want
            file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
            
            // Open frame            
            file_frame.open();
            return;
        } else {
            // Set the wp.media post id so the uploader grabs the ID we want when initialised
            wp.media.model.settings.post.id = set_to_post_id;            
        }  */         
       
        // Create the media frame.
        var file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select an image to upload',
            button: {
                text: 'Use this image',
            },        
            multiple: false	// Set to true to allow multiple files to be selected
        });    
        //console.log(wp.media.frames.file_frame);

        // When an image is selected, run a callback.
        file_frame.on( 'select', function() {
            
            var targetId = $(element).attr('id').split('-')[1];

            // We set multiple to false so only get one image from the uploader
            var attachment = file_frame.state().get('selection').first().toJSON();    

            // Do something with attachment.id and/or attachment.url here
            //$( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
            
            $( '#' + targetId ).val( attachment.url );
            // Restore the main post ID
            wp.media.model.settings.post.id = wp_media_post_id;
            
        });

        $(element).click(function(e){
            e.preventDefault();
            //console.log($(element).attr('id'))
            // Finally, open the modal
		    file_frame.open();
        });
        
    });

    // Restore the main ID when the add media button is pressed
    $( 'a.add_media' ).on( 'click', function() {
        wp.media.model.settings.post.id = wp_media_post_id;
    });
 

    //old method
    /*$('#upload_logo_button').click(function() {
        tb_show('Upload a logo', 'media-upload.php?referer=ext-amp-setting&type=image&TB_iframe=true&post_id=0', false);
        return false;
    });*/
    /*window.send_to_editor = function(html) {
        var image_url = $('img',html).attr('src');
        $('#site_logo').val(image_url);
        tb_remove();
    }*/
});

