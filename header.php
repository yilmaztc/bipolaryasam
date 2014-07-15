<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo get_bloginfo( "blogname" ) ?> | <?php echo get_bloginfo( "blogdescription" ) ?>
    </title>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
    <div class="deneme">
        <div class="mobile_menu">

            <?php
                if ( function_exists( "nav_menu_ms" ) ) {
                    $mobile_menu_args = array( "top-menu", false, "ul-right mobile_menu_ul", "" );
                    nav_menu_ms( $mobile_menu_args );
                }
            ?>
            <div class="mobile_menu_bar left">
                <p class="left"><span class="right glyphicon glyphicon-align-justify"></span></p>
            </div>
        </div>
    </div>
    <div class="container">
        <ul class="bp_header_social bp_ul_default">
            <li id="bp_head_tel"><?php echo set_parameters( "customer_telephone_number_one" ); ?></li>
            <li id="bp_donations"><a id="bp_donations_ico" href="javascript:void(0)" title="facebook">BAĞIŞLARINIZ</a>
            </li>
            <li id="bp_facebook_ico"><a class="bp_social_ico_dimensons"
                                        href="<?php echo set_parameters( "facebook" ); ?>" title="facebook"></a></li>
            <li id="bp_twitter_ico"><a class="bp_social_ico_dimensons" href="<?php echo set_parameters( "twitter" ); ?>"
                                       title="twitter"></a></li>
            <li id="bp_youtube_ico"><a class="bp_social_ico_dimensons" href="<?php echo set_parameters( "youtube" ); ?>"
                                       title="youtube"></a></li>
            <li id="bp_mail_ico"><a class="bp_social_ico_dimensons"
                                    href="mailto:<?php echo set_parameters( "customer_email_address" ); ?>"
                                    title="mail"></a></li>
        </ul>
    </div>
    <div class="wrap">
        <div class="container bp_header">
            <figure id="bp_logo">
                <img class="logo" src="<?php echo get_bloginfo( "template_url" ) ?>/inc/img/logo.png"/>
                <img class="logo-text" src="<?php echo get_bloginfo( "template_url" ) ?>/inc/img/logo-text.png"/>
            </figure>
            <nav class="col-lg-9" id="header_menu">
                <?php
                    if ( function_exists( "nav_menu_ms" ) ) {
                        $top_menu_args = array( "top-menu", false, "ul-left", "menu" );
                        nav_menu_ms( $top_menu_args );
                    }
                ?>
            </nav>
        </div>
    </div>
</header>