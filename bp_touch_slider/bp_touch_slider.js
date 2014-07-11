var biposliderclass = {
    bp_right: function(){

    },
    bp_left : function(){}
}




$(function() {
    $(".sayfa a:first").addClass("aktif");
    $("ul.slider li:first").show();
    var toplamli = $("ul.slider li").length;
    var toplamgenislik = toplamli * 800;
    $("ul.slider").css("width", toplamgenislik + "px");
    var deger = 0;
    $(".sayfa a").hover(function() {
        var indis = $(this).index();
        yenideger = indis * 800;
        $("ul.slider").animate({marginLeft: "-" + yenideger + "px"}, 250);
        $(".sayfa a").removeClass("aktif");
        $(this).addClass("aktif");
        deger = indis;
    });
    $("a#sonraki").click(function() {
        $(".sayfa a").removeClass("aktif");
        if (deger < toplamli - 1) {
            deger++;
            yenideger = deger * 800;
            $("ul.slider").animate({marginLeft: "-" + yenideger + "px"}, 250);
            $(".sayfa a:eq(" + deger + ")").addClass("aktif");
        }
        else
        {
            deger = 0;
            $("ul.slider").animate({marginLeft: "-" + yenideger + "px"}, 250);
            $(".sayfa a:first").addClass("aktif");
        }
        return false
    });
    $("a#onceki").click(function() {
        $(".sayfa a").removeClass("aktif");
        if (deger > 0) {
            deger--;
            yenideger = deger * 800;
            $("ul.slider").animate({marginLeft: "-" + yenideger + "px"}, 250);
            $(".sayfa a:eq(" + deger + ")").addClass("aktif");
        }
        else
        {
            deger = toplamli - 1;
            yenideger = deger * 800;
            $("ul.slider").animate({marginLeft: "-" + yenideger + "px"}, 250);
            $(".sayfa a:last").addClass("aktif");
        }
        return false
    });
    $.dondur = function() {
        $(".sayfa a").removeClass("aktif");
        if (deger < toplamli - 1) {
            deger++;
            yenideger = deger * 800;
            $("ul.slider").animate({marginLeft: "-" + yenideger + "px"}, 250);
            $(".sayfa a:eq(" + deger + ")").addClass("aktif");
        }
        else
        {
            deger = 0;
            $("ul.slider").animate({marginLeft: 0}, 250);
            $(".sayfa a:first").addClass("aktif");
        }
        return false
    }
    var sliderdondur = setInterval('$.dondur()', 50000000);
    $("#slider").hover(function() {
        clearInterval(sliderdondur);
    }, function() {
        sliderdondur = setInterval('$.dondur()', 50000000);
    });
});
