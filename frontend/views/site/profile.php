<?php

$config = \common\models\Configure::getConfig();
$this->context->og_type = 'website';
$this->context->og_image = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . $user->shop_picture;
$this->title = "Trang cá nhân " . $user->firstname;

use common\models\Configure;
use yii\widgets\ActiveForm;

\johnitvn\ajaxcrud\CrudAsset::register($this);
$is_friend = !is_null(\common\models\Friend::findOne(['userid' => Yii::$app->user->id, 'friendid' => $user->id]));
?>
<div class="container" style="height: 100vh; padding-top: 25px;padding-bottom: 25px;    margin-top: 30px;">
    <div class="row">
        <div class="col-xs-12 col-md-4"
             style="padding-top: 15px;padding-bottom: 15px;border-radius: 7px;border: 1px solid #ddd">
            <div class="row">
                <div class="col-xs-12">
                    <div style="border: 5px solid #ddd; border-radius: 50%; width: 160px;height: 160px;float: left"><img
                                src="<?= $user->shop_picture ?>"
                                style="width: 100%;border-radius: 50%; width: 150px;height: 150px"></div>
                    <div style="width: calc(100% - 160px);float: left;padding-left: 5px;margin-top: 35px">
                        <h2 style="font-weight: bold; font-size: 18px"><a href="<?=$user->getProfileUrl()?>"><?= $user->firstname ?></a></h2>
                        <p style=""><?= $user->city ?></p>



                        <?php if (!Yii::$app->user->isGuest): ?>
                            <?php if (Yii::$app->user->identity->id == $user->id):?>
                                <p style=""><a href="<?=Yii::$app->urlManager->createUrl(['site/friendlist'])?>"><b><?= count(\common\models\Friend::findAll(['userid'=>$user->id])) ?></b> bạn</a></p>
                            <?php else:?>
                                <p style=""><b><?= count(\common\models\Friend::findAll(['userid'=>$user->id])) ?></b> bạn</p>
                            <?php endif;?>
                            <?php if (Yii::$app->user->identity->id != $user->id): if (!$is_friend): ?>
                                <?php if(!is_null(\common\models\Friendrequest::findOne(['userid'=>Yii::$app->user->id,'friendid'=>$user->id]))):?>
                                    <button class="btn btn-default btn-huy-ketban btn-warning" data-target="<?=$user->id?>"><i class="fa fa-check"></i> Đã gửi lời mời</button>
                                <?php else:?>
                                    <?php if(!is_null(\common\models\Friendrequest::findOne(['userid'=>$user->id,'friendid'=>Yii::$app->user->id]))):?>
                                        <button class="btn btn-default btn-warning" data-target="<?=$user->id?>"><i class="fa fa-bell-o"></i> Đã gửi cho bạn lời mời</button>
                                        <button class="btn btn-default btn-chapnhan btn-info" data-target="<?=$user->id?>"><i class="fa fa-check"></i> Đồng ý</button>
                                        <button class="btn btn-default btn-huy-ketban btn-danger" data-target="<?=$user->id?>"><i class="fa fa-remove"></i> Từ chối</button>
                                    <?php else:?>
                                        <button class="btn btn-default btn-ketban" data-target="<?=$user->id?>"><i class="fa fa-user"></i> Kết bạn</button>
                                    <?php endif;?>
                                <?php endif;?>
                            <?php else: ?>
                                <button class="btn btn-info"><i class="fa fa-check"></i> Bạn bè</button>
                                <button class="btn btn-default btn-xoa-ketban btn-danger" title="Hủy kết bạn" data-target="<?=$user->id?>"><i class="fa fa-remove"></i></button>
                            <?php endif; ?>
                            <?php else: ?>
                                <button class="btn btn-default"><i class="fa fa-check"></i> Xin chào</button>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 15px">
                <div class="col-xs-12">
                    <p><i class="fa fa-star-o"></i> Các sách đã đọc:</p>
                    <table class="table">
                        <?php $bill = \common\models\Billmobile::find()->where(['chuyendanhba' => $user->id, 'nhanquastatus' => 1])->orderBy("id asc")->all();
                        $temp = [];
                        foreach ($bill as $value):

                            $listqua = \common\models\Listnhanqua::findOne(['billid' => $value->id]);
                            if (!is_null($listqua)):

                                if (!in_array($listqua->productid, $temp)):
                                    $temp[] = $listqua->productid;
                                    ?>
                                    <tr>
                                        <th style="width: 150px"><?php
                                            $product = \common\models\Product::findOne(['id' => $listqua->productid]);
                                            echo (!is_null($product)) ? "<img src='" . $product->getDefaultImage() . "' style='width:150px'/>" : "<img src='/images/noimg.jpg' style='width:150px'/>";
                                            ?></th>
                                        <td><a target="_blank" style="color: #0c0e1a"
                                               href="<?= $product->getTopic() ?>"><?= (!is_null($product)) ? "<h3 style='color: #00AF64;font-size: 18px'>" . $product->name . "</h3><div style='text-align: justify'>" . $product->decription . "</div>" : "Không tìm thấy sách"; ?></a>
                                        </td>
                                    </tr>
                                <?php
                                endif;
                            endif;
                        endforeach;
                        ?>
                    </table>
                    <div class="text-align-center">
                        <button class="btn btn-default">Xem thêm sách <br>người này đã đọc</button>
                    </div>
                    <div></div>
                </div>
            </div>
        </div>
        <?php if (!Yii::$app->user->isGuest): ?>
            <div class="col-xs-12 col-md-8" style="text-align: right">
                <?php if (Yii::$app->user->identity->id == $user->id): ?>
                    <div class="row" style="padding-left: 10px">
                        <div style="font-weight: bold;text-align: left">Đăng gì đó</div>
                        <form action="<?= Yii::$app->urlManager->createUrl(['site/post']) ?>" method="post">
                            <textarea id="text" name="text"></textarea>
                            <button style="margin-top: 5px" class="btn btn-info" type="submit">Đăng bài viết</button>
                        </form>
                    </div>
                    <script>
                        $(document).ready(function () {
                            CKEDITOR.replace('text', {
                                language: 'vi',
                                placeholder: "Viết gì đó!...",
                                toolbar: [
                                    {name: 'document', items: ['Preview', '-', 'Templates']},	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
                                    ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', '-', 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak',],			// Defines toolbar group without name.
                                    // Line break - next group will be placed in new line.
                                    {name: 'basicstyles', items: ['Bold', 'Italic']}
                                ]
                            });
                        })
                    </script>
                <?php endif; ?>
                <style>
                    .bubble-bottom-left:before {
                        content: "";
                        width: 0px;
                        height: 0px;
                        position: absolute;
                        border-right: 24px solid #ddd;
                        border-left: 12px solid transparent;

                        border-bottom: 13px solid transparent;
                        left: -37px;
                        top: 0px;
                    }

                    .liked {
                        font-weight: bold;
                        color: #5bc0de;
                    }
                </style>
                <?php
                echo \yii\widgets\ListView::widget([
                    'dataProvider' => $dataProvider,
                    'emptyText' => (Yii::$app->user->identity->id != $user->id) ? '<p class="alert alert-warning">Người này lười quá, chưa viết gì cả!</p>' : "",
                    'layout' => "<div class='row'><div class='col-xs-12' style='margin: 10px 0'>{summary}</div></div>{items}<div class='row'><div class='col-xs-12' style='margin: 10px 0'>{pager}</div></div>",
                    'itemOptions' => [
                        'tag' => false
                    ],
                    'summary'=>'Từ <b>{begin}-{end}</b> / Tổng <b>{totalCount}</b> bài viết',
                    'itemView' => function ($order, $key, $index, $widget) use ($config, $user) {
                        $comment = \common\models\Postcomment::find()->where(['postid' => $order->id])->orderBy('id desc')->all();

                        return $this->render('_postprofile', [
                            'model' => $order,
                            'user' => $user,
                            'config' => $config,
                            'comments' => $comment
                        ]);

                    },
                ]);
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        
        $(document).on('click', '.btn-like', function () {
            var self = $(this);
            var dataTarget = self.attr('data-target');
            var count = parseInt($("#count-like-" + dataTarget).html());
            if (self.hasClass('liked')) {
                self.removeClass("liked");
                $("#count-like-" + dataTarget).html((count - 1))
            } else {
                self.addClass("liked");
                $("#count-like-" + dataTarget).html((count + 1))
            }
            $.ajax({
                url: "<?=Yii::$app->urlManager->createUrl(['site/like'])?>",
                type: 'post',
                dataType: 'json',
                data: {
                    id: dataTarget,
                },
                success: function (data) {

                }
            })
        });
        $(document).on('click', '.btn-share', function () {
            var self = $(this);
            var dataTarget = self.attr('data-target');
            var count = parseInt($("#count-share-" + dataTarget).html());
            $("#count-share-" + dataTarget).html((count + 1));
            $.ajax({
                url: "<?=Yii::$app->urlManager->createUrl(['site/share'])?>",
                type: 'post',
                dataType: 'json',
                data: {
                    id: dataTarget,
                },
                success: function (data) {

                }
            })
        });
        $(document).on('click', '.btn-xoas', function () {
            var self = $(this);
            var dataTarget = self.attr('data-target');
            var count = parseInt($("#count-like-" + dataTarget).html());
            var s = self.attr("data-s");
            var targetxoa = $("#" + s);

            Swal.fire({
                title: 'Are you sure?',
                text: "Gỡ bỏ dòng này!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "<?=Yii::$app->urlManager->createUrl(['site/xoacomment'])?>",
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: dataTarget,
                        },
                        success: function (data) {

                        }
                    });
                    targetxoa.remove();
                }
            })

        });
        $(document).on('keypress', '.comment-input', function (e) {
            if (e.which == 13) {
                var self = $(this);
                var dataTarget = self.attr('data-target');
                var count = parseInt($("#count-comment-" + dataTarget).html());
                $("#count-comment-" + dataTarget).html((count + 1));
                $.ajax({
                    url: "<?=Yii::$app->urlManager->createUrl(['site/comment'])?>",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: dataTarget,
                        val: self.val().replace(/(\r\n|\n|\r)/gm, "")
                    },
                    success: function (data) {

                    },
                    complete: function () {
                        $.pjax.reload({container: '#comment-pjax-' + dataTarget, async: false});
                        self.val("");
                    }
                })
            }
        });
        $(document).on("click",'.btn-ketban',function () {
            var self = $(this);
            var dataTarget = self.attr('data-target');
            $.ajax({
                url: "<?=Yii::$app->urlManager->createUrl(['site/addfriend'])?>",
                type: 'post',
                dataType: 'json',
                data: {
                    id: dataTarget,
                },
                success: function (data) {

                },
                complete: function () {
                    self.html("<i class='fa fa-check'></i> Đã gửi lời mời");
                    self.removeClass("btn-ketban");
                    self.addClass("btn-huy-ketban btn-warning");
                }
            })
        })
        $(document).on("click",'.btn-huy-ketban',function () {
            var self = $(this);
            var dataTarget = self.attr('data-target');
            $.ajax({
                url: "<?=Yii::$app->urlManager->createUrl(['site/removefriendrequest'])?>",
                type: 'post',
                dataType: 'json',
                data: {
                    id: dataTarget,
                },
                success: function (data) {

                },
                complete: function () {
                    if(!self.hasClass("btn-danger")){
                        self.html("<i class='fa fa-user'></i> Kết bạn");
                        self.addClass("btn-ketban");
                        self.removeClass("btn-huy-ketban  btn-warning");
                    }else{
                        location.reload();
                    }
                }
            })
        })
        $(document).on("click",'.btn-chapnhan',function () {
            var self = $(this);
            var dataTarget = self.attr('data-target');
            $.ajax({
                url: "<?=Yii::$app->urlManager->createUrl(['site/acceptfriendrequest'])?>",
                type: 'post',
                dataType: 'json',
                data: {
                    id: dataTarget,
                },
                success: function (data) {

                },
                complete: function () {
                    if(self.hasClass("btn-info")){
                        location.reload();
                    }
                }
            })
        })
        $(document).on("click",'.btn-xoa-ketban',function () {
            var self = $(this);
            var dataTarget = self.attr('data-target');
            $.ajax({
                url: "<?=Yii::$app->urlManager->createUrl(['site/deletefriend'])?>",
                type: 'post',
                dataType: 'json',
                data: {
                    id: dataTarget,
                },
                success: function (data) {

                },
                complete: function () {

                        location.reload();

                }
            })
        })
    })
</script>