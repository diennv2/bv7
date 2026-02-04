<?php

use common\models\Product;

?>
<style>
    .config .tab>a.active {
        text-align: center;
        background: linear-gradient(180deg,rgba(200,123,116,1) 0,rgba(107,47,49,1) 100%);
        color: #fff;
    }
    .config .tab>a:first-child {
        margin-left: 0;
    }
    .config .tab>a {
        padding:5px;
        color: #333;
        margin-left: -4px;
        display: inline-block;
        vertical-align: middle;
        line-height: 35px;
        background-color: #ebebeb;
        font-size: 20px;
        text-align: center;
        border-left: 1px solid rgba(107,47,49,1);
        border-right: 1px solid rgba(107,47,49,1);
    }
    .tab{
        margin: 10px 0;
    }
</style>
<div class="row config"
     style="background: <?= (is_file(Yii::$app->urlManager->baseUrl . $landing->backgroundimage) ? "url(" . Yii::$app->urlManager->baseUrl . $landing->backgroundimage . ")" : $landing->backgroundimage) ?>">
    <div class="container">
        <?php $products = \yii\helpers\Json::decode($data);
        if (!empty($products)): ?>
            <div class="tab">
                <?php foreach ($products as $index=> $value): $t=Product::findOne(['id'=>$value]); if(!is_null($t)):?>
                    <a href="javascript:void(0)" vals="<?=$value?>" class="<?=($index==0)?"selects active":"selects"?>"> <?=$t->name?></a>
                <?php endif; endforeach;?>
            </div>
            <div class="row" id="display-zone">
                <?php
                $product = Product::find()->where('id = :id', [':id' => $products[0]])->one();
                if (is_null($product)) {
                    echo "";
                } else {
                    $thuoctinhs = $product->propertiesvalueProducts;
                    echo Yii::$app->controller->renderPartial('landing/detailproduct', [
                        'product' => $product,
                        'thuoctinhs' => $thuoctinhs,
                    ]);
                }
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(document).on('click','.selects',function () {
            var self=$(this);
            $(".selects").removeClass('active');
            self.addClass('active');
            $.ajax({
                url:"<?=Yii::$app->urlManager->createUrl(['site/getproductforlandingpage'])?>",
                data:{
                    id: self.attr('vals')
                },
                dataType:'json',
                type:'get',
                success: function (data) {

                    $("#display-zone").html(data.data);
                }
            })
        })
    })
</script>

