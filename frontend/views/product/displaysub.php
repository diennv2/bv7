<?php $subcatfordelivery=\common\models\Catproduct::find()->where(['parent'=>$catProduct->id])->all();if(!empty($subcatfordelivery)):foreach ($subcatfordelivery as $subs):?>
    <a title="<?=$subs->name?>" href="<?=Yii::$app->urlManager->createUrl(['product/product', 'path' => $subs->url, 'id' => $subs->id])?>"><?=$subs->name?></a>
<?php endforeach;endif;?>