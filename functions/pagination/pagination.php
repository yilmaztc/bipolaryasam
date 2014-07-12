<?php
add_action("init","pagination_style");
function pagination_style(){
    if(is_admin()) return;
    wp_register_style("pagination_style", get_bloginfo("template_url") . "/functions/pagination/pagination.css");
    wp_enqueue_style("pagination_style");
}

function pagination($pages = '', $range = 2)
{
    $showitems = ($range * 2)+1;

    global $paged;
    if(empty($paged)) $paged = 1;

    if($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }

    if(1 != $pages)
    {
        echo "<div class=\"pagination\">";
//        if($paged > 2 && $paged > $range+1 ) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
        if($paged > 1 ) echo "<a class=\"pages_page inactive\" href='".get_pagenum_link($paged - 1)."'>&lsaquo; Önce Ki Sayfa</a>";

        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo ($paged == $i)? "<span id=\"current\" class=\"pages_page\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"pages_page  inactive\">".$i."</a>";
            }
        }

        if ($paged < $pages ) echo "<a class=\"pages_page inactive\" href=\"".get_pagenum_link($paged + 1)."\">Sonra ki Sayfa &rsaquo;</a>";
//        if ($paged < $pages-1 &&  $paged+$range-1 < $pages ) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
        echo "</div>\n";
    }
}
?>
