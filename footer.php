<footer id="footer-wrap">
    <div class="container footer_in">
        <div class="bp_footer_about col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <h4>Bipolar Yaşam Derneği</h4>

            <p>erneğimiz, bipolar bozukluk (manik-depresif) tanısıyla ilgilenen hasta, hasta yakını ve uzmanları bir araya getiriyor. Öncelikli işlevimiz üyelerimizi ve toplumu bipolar bozukluk konusunda bilgilendirmek ve hastaları doğru yönlendirerek sağlık kuruluşları ve hastalar arasında köprü olmaktır.</p>
        </div>
        <div class="bp_footer_contact col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <h4>İletişim</h4>

            <p>
                <?php
                echo "E-posta: " . set_parameters("customer_email_address") . "<br/>";
                echo "Tel: " . set_parameters("customer_telephone_number_one") . "<br/>";
                echo "Tel: " . set_parameters("customer_telephone_number_two") . "<br/>";
                ?>
            </p>
        </div>
        <div class="bp_footer_mail col-lg-5 col-md-5 col-sm-12 col-xs-12">
            <fieldset>
                <h4 id="member_bul_title">Bültene abone olun</h4>
                <div id="member_div">
                    <?php if (function_exists("ms_form_mail_register")) ms_form_mail_register(); ?>
                </div>
            </fieldset>
            <figure>
                <a href="/iletisim"><img class="img-responsive" src="<?php echo get_bloginfo("template_url") ?>/inc/img/map.jpg"/></a>
            </figure>
        </div>
    </div>
</footer>
<div class="footer_bottom">
    <div class="container footer_bottom_in">
        <p class="row bp_footer_copright">copyright all rights reserved 2014 | Bipolar Yaşam Derneği</p>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>