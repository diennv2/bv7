<footer>
    <?php
        $menubottom = \common\models\Menu::getRootMenu('bottom');
    ?>
    <div class="container">
        <ul class="col-xs-12 col-sm-6 col-md-3 colfoot">
            <li><a href="/" title="<?=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]"?>">
                    <img src="<?=Yii::$app->urlManager->baseUrl.$config['contact_logo_footer']?>" alt="<?=$config['contact_cname']?>" class="img-responsive">
                </a></li>
            <li><div class="padding-top-10px"><?=$config['contact_slogan1']?></div></li>

        </ul>
        <ul class="col-xs-12 col-sm-6 col-md-3 colfoot collast">
            <li>

                <div class="group" id="facebk">
                    <?=$config['footer_facebook']?>
                </div>
            </li>
        </ul>
        <ul class="col-xs-12 col-sm-12 col-md-3 colfoot">
            <?php foreach ($menubottom as $menus):?>
                <li><a href="<?php if (substr($menus->link, 0, 4) != "http") echo Yii::$app->urlManager->baseUrl . $menus->link; else echo $menus->link; ?>" <?php if ($menus->new_tab) echo "target='_blank'" ?>
                       title="<?=$menus->name?>" rel="noopener"><?=$menus->name?></a></li>
            <?php endforeach;?>
        </ul>
        <ul class="col-xs-12 col-sm-12 col-md-3 colfoot">
            <li>


                <p><i class="fa fa-map-marker" aria-hidden="true"></i> Địa chỉ 1: <a href="<?=$config['google_link']?>" target="_blank" title="GoogleMap" rel="nofollow noopener noreferrer"><?=$config['contact_address']?></a></p>
                <p><i class="fa fa-map-marker" aria-hidden="true"></i> Địa chỉ 2: <a href="<?=$config['twitter_link']?>" target="_blank" title="GoogleMap" rel="nofollow noopener noreferrer"><?=$config['contact_address2']?></a></p>
                <p><i class="fa fa-phone" aria-hidden="true"></i> Phone: <a href="tel:<?=$config['contact_hotline']?>"><?=$config['contact_phone']?></a></p>
                <p><i class="fa fa-phone" aria-hidden="true"></i> Hotline: <a href="tel:<?=$config['contact_hotline']?>"><?=$config['contact_hotline']?></a></p>
                <p><i class="fa fa-phone" aria-hidden="true"></i> Fax: <a href="tel:<?=$config['contact_fax']?>"><?=$config['contact_fax']?></a></p>
                <a target="_blank" href="<?=$config['facebook_link']?>" class="linkfb"
                   rel="noopener">
                    <i class="icontgdd-share1"></i>
                </a>
                <a target="_blank" href="<?=$config['youtube_link']?>"
                   class="linkyt" rel="noopener">
                    <i class="icontgdd-share3"></i>
                </a>
                <a target="_blank" rel="nofollow noopener" class="bct"
                   href="http://online.gov.vn/HomePage/CustomWebsiteDisplay.aspx?DocId=20098"
                   aria-label="bộ công thương mwg"><i class="icontgdd-bct"></i></a>
                <a rel="nofollow noopener" class="bct" href="/tos#giai-quyet-khieu-nai"
                   aria-label="bộ công thương chống hàng giả"><i class="icontgdd-hg"></i></a>
                <a href="//www.dmca.com/Protection/Status.aspx?ID=5b62e759-2a0c-4d86-b972-af903bfbc89d&amp;refurl=http://www.thegioididong.com/"
                   title="DMCA.com Protection Status" class="dmca-badge"> <img
                            style="opacity:0.6;margin: 0px auto -8px;display: block;"
                            src="//images.dmca.com/Badges/dmca-badge-w100-5x1-11.png?ID=5b62e759-2a0c-4d86-b972-af903bfbc89d"
                            alt="DMCA.com Protection Status"></a>
            </li>
        </ul>

    </div>
    <div class="rowfoot2">
        <p><?=$config['footer_certificate']?></p>
    </div>
</footer>