var animate_time = 500;
var video_genislik,videoSayisi,listeGenisligi,listeBoy,page_ms_video_list,page_ms_video_list_h,chooser_width,ms_videos_count = 1;

function set_videos_size( $ ) {
    video_genislik      = $('#videos_inner').width();
    videoSayisi         = $('#video_list_slider li').length;

    $('#video_list_slider li').width(video_genislik);

    listeGenisligi      = $('#video_list_slider li').width();

    listeBoy = (listeGenisligi / 100) * 57;
    $('#video_list_slider li').height(listeBoy);

    $('#video_list_slider').width(listeGenisligi * videoSayisi);


    /*
     Sayfa Görünümünde ki JS ölçü ayarları buradan yapılacak.
     */

    page_ms_video_list      = $( "#page_ms_video_list");
    page_ms_video_list_h    = ( page_ms_video_list.find("li").width() / 100 ) * 57;
    page_ms_video_list.find( "li" ).height(page_ms_video_list_h);
    page_ms_video_list.find( "li").fadeIn(1000);

}

function videolar( $ ) {
    $('#videos_right').click(function() {
        if ( ms_videos_count < videoSayisi ) {
            $('#video_list_slider').animate({marginLeft: '-=' + listeGenisligi },animate_time);
            ms_videos_count++;
        }
    })

    $('#videos_left').click(function() {
        if ( ms_videos_count != 1 ) {
            $('#video_list_slider').animate({ marginLeft: '+=' + listeGenisligi },animate_time);
            ms_videos_count--;
        }
    })
}
function LoadYoutubeVidOnPreviewClick(img_id,youtube_id,title_id) {
    var code='<iframe width="420" height="315" src="//www.youtube.com/embed/' + youtube_id + '?autoplay=1" frameborder="0" allowfullscreen></iframe>';
    jQuery("#" + img_id).after(code);
    jQuery("#" + img_id).remove();
    jQuery("." + title_id).remove();
}


// Slider'ın ikinci görünümü için kullanılır.
// Slider'ın altında bir seçim alanı oluşturulur ve tıklanan video açılır.

function ms_main_videos_list( $ ){

    var count = 0;
    chooser_width   = $( "#video_list_chooser").children( "li").outerWidth( true );
    $( "#video_list_chooser").width( chooser_width * videoSayisi );


    $('#chooser_right').click(function() {

        if( videoSayisi > 5 ) {
            if( ( count + 5 ) < videoSayisi ){
                $( "#video_list_chooser").animate({
                    marginLeft: '-=' + chooser_width
                });
                count++;
            }
        }

    });

    $('#chooser_left').click(function() {
        if( count != 0 ) {
            $( "#video_list_chooser").animate({
                marginLeft: '+=' + chooser_width
            });
            count--;
        }
    });

    $( "#video_list_chooser").children( "li").click( function(){

        var this_index      = $( this).index();
        $( "#video_list_slider").animate({
            marginLeft: "-" + ( this_index * listeGenisligi )
        })

    } )

}

jQuery(document).ready(function(){
    set_videos_size(jQuery);
    videolar(jQuery);
    ms_main_videos_list( jQuery )
});
jQuery(window).resize(function(){
    set_videos_size(jQuery);
})