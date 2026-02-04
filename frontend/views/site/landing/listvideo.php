<div class="row">
    <?php foreach(\yii\helpers\Json::decode($data) as $value):?>
<div class="col-md-4">
    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/<?=$value?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
    <?php endforeach;?>
</div>
<div class="clearfix"></div>