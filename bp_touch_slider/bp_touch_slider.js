var biposliderclass = {
    bp_content_slider: null,
    bp_content_id : null,
    bp_content_li    : null,
    bp_var : 0,
    bp_animate_time : 500,
    bp_conf          : function ()
    {
        var get_list_li_width = this.bp_content_id.width();
        var get_list_li_length = this.bp_content_li.length;
        var get_list_total_width = get_list_li_width * get_list_li_length;
        this.bp_content_slider.width( get_list_total_width );
        this.bp_content_li.width( get_list_li_width );
    },
    bp_right         : function ()
    {
        this.bp_var++;
        if (this.bp_var == this.bp_content_li.length){
            this.bp_var = 0;
        }
        this.bp_content_slider.animate({
            marginLeft : this.bp_var * ( "-" + this.bp_content_li.width() )
        }, this.bp_animate_time)
    },
    bp_left          : function ()
    {
        if (this.bp_var == 0){
            this.bp_var = 0;
        } else {
            this.bp_var--;
        }
        this.bp_content_slider.animate({
            marginLeft : this.bp_var * ( "-" + this.bp_content_li.width() )
        }, this.bp_animate_time)
    }
}

jQuery( document ).ready( function ( $ )
{

    biposliderclass.bp_content_id = $( "#bp_content_slider" );
    biposliderclass.bp_content_slider = $( ".bp_content_slider" );
    biposliderclass.bp_content_li = biposliderclass.bp_content_slider.find( "li" );
    biposliderclass.bp_conf();

    $("#after_cs" ).click(function(){
        biposliderclass.bp_right();
    });
    $("#previous_cs" ).click(function(){
        biposliderclass.bp_left();
    });

    var bipo_interval_time = 5000;
    var bipolar_slider = setInterval(function(){
        biposliderclass.bp_right();
    },bipo_interval_time);
    $("#bp_content_slider" ).hover(
        function(){
            clearInterval(bipolar_slider);
        },
        function(){
            bipolar_slider = setInterval(function(){
                biposliderclass.bp_right();
            },bipo_interval_time);
        }
    )

    $( ".slider_title" ).swipe( {
        swipe: function ( event, direction, distance, duration, fingerCount )
        {
            if(direction == "right") {
                biposliderclass.bp_right();

            } else if(direction == "left") {
                biposliderclass.bp_left();

            }
        }
    } );

} )

jQuery( window ).resize(function($){

    biposliderclass.bp_conf();

})