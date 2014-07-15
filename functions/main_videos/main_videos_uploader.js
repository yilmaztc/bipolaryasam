function main_videos_uploader( id ){
    tb_show('Bir resim yükle', 'media-upload.php?referer=wptuts-settings&amp;type=image&amp;TB_iframe=true&amp;post_id=0');

    window.send_to_editor = function(html) {
        // html returns a link like this:
        // <a href="{server_uploaded_image_url}"><img src="{server_uploaded_image_url}" alt="" title="" width="" height"" class="alignzone size-full wp-image-125" /></a>
        var image_url       = jQuery('img',html).attr('src');
        /*
         Yüklenen resmin, attachment id sini verir.
         */
        var attachmentID = html.match(/wp-image-([0-9]+)/)

        //alert(html);
        jQuery('#'+id).val(attachmentID[1]);
        jQuery("#" + id + "_img").attr("src",image_url);
        tb_remove();
        jQuery('#upload_logo_preview img').attr('src',image_url);

        jQuery('#submit_options_form').trigger('click');
        // jQuery('#uploaded_logo').val('uploaded');

    }
}
