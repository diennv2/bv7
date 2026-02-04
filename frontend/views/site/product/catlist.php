<?php
/**
 * Created by PhpStorm.
 * User: anlai
 * Date: 03-Oct-17
 * Time: 1:37 PM
 */
$this->title = $title;
$this->context->og_type='website';
$config = \common\models\Configure::getConfig();
\johnitvn\ajaxcrud\CrudAsset::register($this);
?>
<div class="container back-white">
    <ol class="breadcrumb breadcrumb-arrow border-bot">
        <li><a href="<?php echo Yii::$app->urlManager->baseUrl ?>/" target="_self">Trang chủ</a></li>
        <li><i class="fa fa-angle-right"></i></li>
        <li>
            <a href="javascript:;"><?php echo $title ?></a>
        </li>
    </ol>
    <div class="contain">
        <h2 class="title"><?= $title ?></h2>
        <?php
        if ($type == "subcat"):
            ?>

            <?php
            if (!empty($data)):
                foreach ($data as $indexing => $chitietsp):
                    ?>
                    <?php if ($indexing % 4 == 0) echo "<div class='row'>"; ?>
                    <div class="col-md-3 col-sm-6 col-xs-12 margin-top-10">
                        <div class="itemlist">
                            <a class="itemname style-03 lineheight-50"
                               href="<?= $chitietsp->decription ?>"><?= $chitietsp->name ?></a>
                            <div class="contain15">
                                <?php $code = explode("/", $chitietsp->code);
                                if (count($code) == 2):
                                    ?>
                                    <p class="special-info-t">Băng thông: <?= $code[0] ?></p>
                                <?php else: ?>
                                    <p class="special-info-t"><?= $chitietsp->code ?></p>
                                <?php endif; ?>

                                <?php if ($chitietsp->sale < $chitietsp->retail) echo "<p class='pricetag'><del>" . $config['money_prefix'] . " " . number_format($chitietsp->retail, 0, '', '.') . " " . $config['money_suffix'] . " / " . $chitietsp->tag . "</del></p>"; ?>
                                <?php echo "<p class='pricetag'>" . $config['money_prefix'] . " " . number_format($chitietsp->sale, 0, '', '.') . " " . $config['money_suffix'] . " / " . $chitietsp->tag . "</p>" ?>
                                <?php if ($chitietsp->sale < $chitietsp->retail): ?>
                                    <div class="pricetags">
                                                    <span class="pricetext">- <?php echo round(($chitietsp->retail - $chitietsp->sale) * 100 / $chitietsp->retail) ?>
                                                        %</span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($chitietsp->hot == 1): ?>
                                    <div class="hot">
                                        <span class="hottext">HOT</span>
                                    </div>
                                <?php endif; ?>
                                <p class="pricetag margin-top-40 text-align-center"><span
                                            class="anymore">
                                                        <?php
                                                        if ($chitietsp->kieudangky == '1'){}
                                                        else {
                                                            $temp = explode(' gửi ', $chitietsp->cuphap);
                                                            echo "<span class='cuphap'><a rel='nofollow' title='Nhắn tin' href='sms://" . $temp[1] . "?body=" . urlencode($temp[0]) . "'>" . $chitietsp->cuphap . "</a></span>";
                                                        }
                                                        ?>
                                                            </span><br><?php echo \yii\helpers\Html::a('Chi tiết', $chitietsp->decription, ['class' => 'btn btn-datmua nomargin']) ?></p>
                            </div>
                        </div>
                    </div>
                    <?php if ($indexing % 4 == 3) echo "</div>" ?>
                    <?php
                endforeach;
                if (count($data) % 4 != 0) echo "</div>";
            endif; ?>
        <?php else: ?>
            <?php foreach ($data as $subcat): if(!empty($subcat['product'])):?>
                <div style="background: url(<?=Yii::$app->urlManager->baseUrl.$subcat['subcat']->image?>)" class="text-align-center namespacecontant"><a class="namespace" title="<?=$subcat['subcat']->name?>"
                                          href="<?= Yii::$app->urlManager->createUrl(['site/catlist', 'id' => $subcat['subcat']->id, 'path' => $subcat['subcat']->url]) ?>">
                        <?=$subcat['subcat']->name?>
                    </a></div>
                <?php
                if (!empty($subcat['product'])):
                    foreach ($subcat['product'] as $indexing => $chitietsp):
                        ?>
                        <?php if ($indexing % 4 == 0) echo "<div class='row'>"; ?>
                        <div class="col-md-3 col-sm-6 col-xs-12 margin-top-10">
                            <div class="itemlist">
                                <a class="itemname style-03 lineheight-50"
                                   href="<?= $chitietsp->decription ?>"><?= $chitietsp->name ?></a>
                                <div class="contain15">
                                    <?php $code = explode("/", $chitietsp->code);
                                    if (count($code) == 2):
                                        ?>
                                        <p class="special-info-t">Băng thông: <?= $code[0] ?></p>
                                    <?php else: ?>
                                        <p class="special-info-t"><?= $chitietsp->code ?></p>
                                    <?php endif; ?>

                                    <?php if ($chitietsp->sale < $chitietsp->retail) echo "<p class='pricetag'><del>" . $config['money_prefix'] . " " . number_format($chitietsp->retail, 0, '', '.') . " " . $config['money_suffix'] . " / " . $chitietsp->tag . "</del></p>"; ?>
                                    <?php echo "<p class='pricetag'>" . $config['money_prefix'] . " " . number_format($chitietsp->sale, 0, '', '.') . " " . $config['money_suffix'] . " / " . $chitietsp->tag . "</p>" ?>
                                    <?php if ($chitietsp->sale < $chitietsp->retail): ?>
                                        <div class="pricetags">
                                                    <span class="pricetext">- <?php echo round(($chitietsp->retail - $chitietsp->sale) * 100 / $chitietsp->retail) ?>
                                                        %</span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($chitietsp->hot == 1): ?>
                                        <div class="hot">
                                            <span class="hottext">HOT</span>
                                        </div>
                                    <?php endif; ?>
                                    <p class="pricetag margin-top-40 text-align-center"><span
                                                class="anymore">
                                                        <?php
                                                        if ($chitietsp->kieudangky == '1'){}
                                                        else {
                                                            $temp = explode(' gửi ', $chitietsp->cuphap);
                                                            echo "<span class='cuphap'><a rel='nofollow' title='Nhắn tin' href='sms://" . $temp[1] . "?body=" . urlencode($temp[0]) . "'>" . $chitietsp->cuphap . "</a></span>";
                                                        }
                                                        ?>
                                                            </span><br><?php echo \yii\helpers\Html::a('Chi tiết', $chitietsp->decription, ['class' => 'btn btn-datmua nomargin'])." ".\yii\helpers\Html::a('Chi tiết', $chitietsp->decription, ['class' => 'btn btn-datmua nomargin btn-revert']) ?></p>
                                </div>
                            </div>
                        </div>
                        <?php if ($indexing % 4 == 3) echo "</div>" ?>
                        <?php
                    endforeach;
                    if (count($subcat['product']) % 4 != 0) echo "</div>";
                endif; ?>
            <?php endif; endforeach;?>
        <?php endif; ?>
    </div>
</div>

