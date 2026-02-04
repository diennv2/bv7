<?php $bannerFooter = \common\models\Partner::getAds(4, 999);
foreach ($bannerFooter as $bannerfooter):/** @var \common\models\Partner $bannerfooter */
    ?>
    <div class="col-xs-12">
        <a title="<?= $config['contact_cname'] ?>" class="footerimage"
           href="<?php if (substr($bannerfooter->url, 0, 4) != "http") echo Yii::$app->urlManager->baseUrl . $bannerfooter->url; else echo $bannerfooter->url; ?>">
            <img src="<?= $bannerfooter->image ?>" title="Ảnh <?= $bannerfooter->id ?>"
                 alt="<?= $config['contact_cname'] ?>">
        </a>
    </div>
<?php endforeach; ?>
<div class="col-xs-12 contactnow">
    <div class="container">
        <div class="col-md-7">
            <i class="fa fa-envelope-o"></i> Bạn cần tư vấn, đừng ngần ngại  <a class="btn btn-warning btn-lien-he" href="/lien-he.html" title="lienhe"><i class="fa fa-paper-plane-o"></i> Liên hệ với chúng tôi ngay</a>
        </div>
        <div class="col-md-5">
            <span>Hotline tư vấn dịch vụ: <span class="hotlinespan"><?=$config['contact_hotline']?></span></span>
        </div>
    </div>
</div>