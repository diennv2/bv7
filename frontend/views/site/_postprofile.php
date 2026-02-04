<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
/** @var \common\models\Post $model */

?>
<?php $value=$model?>
<div class="row" style="padding: 5px 0">
    <div class="col-xs-2">
        <span style="float: left;margin-right: 5px;width: 50px;height: 50px;overflow: hidden; border-radius: 50%!important;border: 3px solid #ddd"><img title="account" style="width: 100%;" alt="taikhoan" src="<?php if(is_file(dirname(dirname(dirname(__DIR__))).$user->shop_picture)):?><?= Yii::$app->urlManager->baseUrl.$user->shop_picture ?><?php else:?><?= Yii::$app->urlManager->baseUrl ?>/images/taikhoann.png<?php endif;?>"></span>
    </div>
    <?php if (!Yii::$app->user->isGuest):?>
        <div class="col-xs-10 bubble-bottom-left" style="padding: 15px; border: 1px solid #ddd;border-radius: 4px ">
        <p><?=$value->created?></p>
        <div style="text-align: justify">

            <?php if(!is_null($value->shareid)):?>
                <div style="margin-bottom: 20px"><b><?=$user->firstname?> </b> Đã chia sẻ một bài viết:</div>
                <div style="padding: 10px">
                    <?php $postshare = \common\models\Post::findOne($value->shareid);
                    if(is_null($postshare)):
                        ?>
                        <p class="alert alert-default">Không tìm thấy bài viết hoặc bài viết đã bị xóa</p>
                    <?php else:?>
                        <div class="col-xs-12">
                            <?php $usershare = \common\models\User::findOne($value->userid);?>
                            <div><span style="float: left;margin-right: 5px;width: 50px;height: 50px;overflow: hidden; border-radius: 50%!important;border: 3px solid #ddd"><img title="account" style="width: 100%;" alt="taikhoan" src="<?php if(is_file(dirname(dirname(dirname(__DIR__))).$usershare->shop_picture)):?><?= Yii::$app->urlManager->baseUrl.$usershare->shop_picture ?><?php else:?><?= Yii::$app->urlManager->baseUrl ?>/images/taikhoann.png<?php endif;?>"></span><span> <b><?=$usershare->firstname?></b></span></div>
                            <div><?=$postshare->created?></div>
                            <div>
                                <?=$postshare->content?>
                            </div>

                        </div>
                    <?php endif;?>
                </div>
            <?php else:?>
                <?=$value->content?>
            <?php endif;?>
        </div>
        <div class="clearfix"></div>
        <div style="border-top: 1px solid #ddd; margin-top: 10px; padding-top: 10px">
            <a data-target="<?=$value->id?>" class="col-xs-4 btn-like <?php if(in_array(Yii::$app->user->id,\yii\helpers\Json::decode($value->likelist))){echo"liked";}?>" style="cursor: pointer;text-align:center;font-size: 16px"><i class="fa fa-thumbs-o-up"></i> <span id="count-like-<?=$value->id?>"><?=count(\yii\helpers\Json::decode($value->likelist))?></span> like</a>
            <a data-target="<?=$value->id?>" class="col-xs-4" style="cursor: pointer;text-align:center;font-size: 16px"><i class="fa fa-comment-o"></i> <span id="count-comment-<?=$value->id?>"><?=count(\common\models\Postcomment::findAll(['postid'=>$value->id]))?></span> Bình luận</a>
            <a data-target="<?=$value->id?>" class="col-xs-4 btn-share" style="cursor: pointer;text-align:center;font-size: 16px"><i class="fa fa-share-alt"></i> <span id="count-share-<?=$value->id?>"><?=count(\common\models\Post::findAll(['shareid'=>$value->id]))?></span> Share</a>
        </div>
        <div>
            <div class="col-xs-11"><textarea class=" form-control comment-input" data-target="<?=$value->id?>" style="resize: none;" placeholder="Viết gì đó...."></textarea></div>
            <button class="col-xs-1 btn btn-info" style="height: 53px"><i class="fa fa-envelope"></i></button>
        </div>
        <div class="clearfix"></div>
        <div>
            <div style="text-align: left;font-weight: bold;margin-top: 10px">
                Bình luận:
            </div>
            <?php \yii\widgets\Pjax::begin(['id' => 'comment-pjax-'.$value->id]) ?>
            <?php
                foreach ($comments as $index=> $value){
                    echo $this->render( '_comments', [
                        'model'=>$value,
                        'key'=>$index
                    ]);
                }
            ?>
            <?php if(count($comments)>5):?>
                <button class="btn btn-viewmore-<?=$value->id?>" style="width: 100%">Tải thêm bình luận <i class="fa fa-angle-down"></i></button>
            <?php endif;?>
            <?php \yii\widgets\Pjax::end() ?>
        </div>
    </div>
    <?php endif;?>
</div>
<script>
    var std<?=$value->id?>=1;
    for (var i = 0;i<std<?=$value->id?>*5;i++){
        $("#<?=$value->id.$value->id.$value->id?>"+i).removeClass("hidden");
    }
    $(document).on("click",'.btn-viewmore-<?=$value->id?>',function () {
        std<?=$value->id?>++;
        for (var i = 0;i<std<?=$value->id?>*5;i++){
            $("#<?=$value->id.$value->id.$value->id?>"+i).removeClass("hidden");
        }
    })
</script>
