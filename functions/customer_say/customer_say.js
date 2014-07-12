var customer_say_article,cs_list,interval_cs,intervalTime_cs,counter_cs,customer_say;

jQuery.customer_say = {
    fade_time: 1000,
    hidden      : function( list_obj ) {

        list_obj.hide();
        list_obj.first().show();

    },
    increase    : function( list_obj, choose_list, counter ) {

        list_obj.fadeOut( this.fade_time );
        list_obj.eq( counter ).fadeIn( this.fade_time );

        choose_list.eq( counter).addClass( "active_round").siblings().removeClass( "active_round" );

    }
}

function defaults_cs( $ ){

    counter_cs              = 3;
    intervalTime_cs         = 10000;
    customer_say_article    = $( ".customer_say_article" );
    cs_list                 = $( "#cs_list" );
    customer_say            = $( "#customer_say" );

}

function set_interval_cs( $ ){

    interval_cs     = setInterval(function(){

        counter_cs++;
        if( counter_cs >= cs_list.find("li").length ) {
            counter_cs = 0;
        }
        jQuery.customer_say.increase( customer_say_article.find("p"), cs_list.find( "li" ), counter_cs )

    },intervalTime_cs)

}

function move_cs( $ ) {

    jQuery.customer_say.hidden( customer_say_article.find( "p" ) );

    cs_list.find( "li" ).click( function(){

        var index_cs    = $( this).index();
        counter_cs      = index_cs;

        jQuery.customer_say.increase( customer_say_article.find("p"), cs_list.find( "li" ), counter_cs );

    } );
    set_interval_cs( $ );

    customer_say.hover(
        function(){
            clearInterval( interval_cs );
        },
        function(){
            set_interval_cs( $ );
        }
    );

}

jQuery( document).ready( function( $ ){

    defaults_cs( $ );
    move_cs( $ );

} );
