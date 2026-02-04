<?php
/**
 * Created by PhpStorm.
 * User: Duong_IT
 * Date: 8/21/2017
 * Time: 9:36 PM
 * @var $bills  \common\models\Bill
 */
$config = \common\models\search\Configure::getConfig();
$nab = Yii::$app->controller->navbar;

use yii\helpers\Json; ?>
<div class="header-navigate">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ol class="breadcrumb breadcrumb-arrow">
                    <?= $nab ?>
                </ol>
            </div>
        </div>
    </div>
</div>
<div id="hotros" class="hidden" scroll="no"  style="position: fixed;background: #333333b8;top: 0;left: 0;width: 100vw;height: 100vh; z-index: 99">
    <div class="container" style="height: 100vh;position: relative">
        <div style="height:60%; width: calc(100% - 20px); margin: auto;border-radius: 4px;background: white;top:50%;transform: translateY(-50%);position: absolute">
            <div style="position: relative;height: 100%">
                <div class="robot robot2">
                    <a class="hotro2"><img src="/images/Untitled-3.png"></a>
                </div>
                <div class="hoi">
                    <h3>Tulato có thể giúp gì cho bạn?</h3>
                    <div class="resulttim">
                        <a href="<?=Yii::$app->urlManager->createUrl(['site/nhanqua','id'=>$bill->id,'nhieunguoichon'=>1])?>" class="findoptions">Tìm cho tôi 10 cuốn sách nhiều người chọn nhất!</a>
                        <?php $nhomsach = \common\models\Nhomsach::find()->all();
                            foreach ($nhomsach as $nhomsachs):
                        ?>
                        <a href="<?=Yii::$app->urlManager->createUrl(['site/nhanqua','id'=>$bill->id,'filter'=>$nhomsachs->id])?>" class="findoptions">Tìm cho tôi <?=$nhomsachs->tennhom?></a>
                        <?php endforeach;?>
                        <a href="<?=Yii::$app->urlManager->createUrl(['site/nhanqua','id'=>$bill->id,'filter'=>'popular'])?>" class="findoptions">Tôi muốn tìm theo tên sách</a>
                        <a class="dong btn btn-success" style="margin-top: 10px">Đóng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container" id="columns">

    <h2 class="page-heading no-line ">
        <span class="page-heading-title2v">Nhận quà </span>
    </h2>
    <!-- ../page heading-->
    <div class="page-content page-order">

        <div class="order-detail-content">

            <?php if($bill->nhanquastatus==0):?>
                <p>Cám ơn bạn đã tin tưởng đặt hàng tại Tulato, dưới đây là phần quà của bạn, hãy click để chọn <strong><?=$dem?> cuốn sách</strong> mà bạn
                    thích nhất, sau đó ấn nút Chọn ở bên cạnh: <button class="btn btn-success" id="btn-chon-sach">Tôi chọn những cuốn sách này</button></p>
                <ul class='homeproduct margin-top-bot-5' id="hiensach">

                </ul>
                <?php if(isset($_GET['filter'])): $nhom = \common\models\Nhomsach::findOne($_GET['filter']);if(!is_null($nhom)):?><p style="margin: 10px 0;font-size: 18px" class="alert alert-warning">Bạn đang xem mục : <?=$nhom->tennhom?> (Ngẫu nhiên) - <a class="btn btn-info" href="">Làm mới</a></p><?php endif;endif;?>
                <div class="row">
                    <div class="col-md-12 product-lists box-product-lists mt15 clearfix">
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $dataProvider,
                            'layout' => "{summary}\n<ul class='homeproduct margin-top-bot-5'>{items}</ul>\n{pager}",
                            'itemOptions' => [

                                'tag' => false

                            ],
                            'itemView' => function ($order, $key, $index, $widget) use ($config) {

                                return $this->render('_chonsach', [
                                    'value' => $order,
                                    'config' => $config
                                ]);

                            },
                        ]);
                        ?>
                    </div>

                </div>
                <div class="hidden">
                    <input type="number" id="is1" value="<?=$bill->id?>">
                    <input type="text" id="is2" value="">
                </div>
                <div class="robot">
                    <a class="hotro"><img src="/images/Untitled-1.png"></a>
                </div>
                <script>
                    $(document).ready(function () {
                        var dem=0;
                        $(document).on("click",'.choosesach:not(.choosesached)',function () {

                            if($(".choosesached").length==<?=$dem?>){
                                Swal.fire({
                                    title: 'Opps!',
                                    text: 'Bạn đã chọn đủ <?=$dem?> sách!',
                                    icon: 'info',
                                    confirmButtonText: 'Ok'
                                });
                            }else{
                                var self=$(this);
                                self.addClass('choosesached');
                                var t="";
                                $.each($(".choosesached"),function () {
                                    t+=$(this).attr("data-target")+"-";
                                });
                                $("#is2").val(t);
                                dem++;
                                var cloned = self.clone();
                                cloned.attr('id',self.attr('id')+"-cloned");
                                self.removeClass('choosesached').addClass('hidden');
                                $("#hiensach").append(cloned);
                            }
                        });
                        $(document).on("click",'.choosesached',function () {
                            var self=$(this);
                            self.removeClass("choosesached");
                            var t="";
                            $.each($(".choosesached"),function () {
                                t+=$(this).attr("data-target")+"-";
                            });
                            $("#is2").val(t);
                            dem--;
                            $("#"+self.attr('id').split("-")[0]).removeClass("hidden");
                            self.remove();
                        });
                        $(document).on('click','.hotro',function () {
                            var self=$(this);
                            self.addClass("hidden");
                            $("#hotros").removeClass("hidden");
                        });
                        $(document).on('click','.dong',function () {
                            $(".hotro").removeClass("hidden");
                            $("#hotros").addClass("hidden");
                        });
                        $(document).on('click','#btn-chon-sach',function () {
                            if($("#is2").val()==""){
                                Swal.fire({
                                    title: 'Opps!',
                                    text: 'Bạn chưa chọn sách!',
                                    icon: 'info',
                                    confirmButtonText: 'Ok'
                                });
                            }
                            else if(dem<<?=$dem?>){
                                Swal.fire({
                                    title: 'Opps!',
                                    text: 'Bạn chưa chọn đủ <?=$dem?> sách!',
                                    icon: 'info',
                                    confirmButtonText: 'Ok'
                                });
                            }
                            else{
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "Bạn chắc chắn muốn chọn cuốn sách này chứ?!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    cancelButtonText: 'Tôi muốn chọn lại!',
                                    confirmButtonText: 'Tôi đồng ý!'
                                }).then((result) => {
                                    if (result.value) {

                                        $.ajax({
                                            url: "<?=Yii::$app->urlManager->createUrl(['site/chonqua'])?>",
                                            type: "post",
                                            dataType: 'json',
                                            data: {
                                                datakey: $("#is2").val(),
                                                itemid: $("#is1").val(),
                                            },
                                            success:function(data){
                                                if(data.status){
                                                    Swal.fire({
                                                        title: 'Cám ơn bạn!',
                                                        text: data.message,
                                                        icon: 'success',
                                                        confirmButtonText: 'Ok'
                                                    }).then(()=>{
                                                        window.location.href="/site/history.html";
                                                    });
                                                }else{
                                                    Swal.fire({
                                                        title: 'Có lỗi xảy ra!',
                                                        text: data.message,
                                                        icon: 'warning',
                                                        confirmButtonText: 'Ok'
                                                    })
                                                }
                                            },
                                            complete: function () {

                                            }
                                        })

                                    }
                                })
                            }
                        });
                    });
                </script>
            <?php else:?>
                <p>Bạn đã nhận quà cho đơn hàng này rồi!</p>
            <?php endif;?>

        </div>
    </div>
</div>
<?php \yii\bootstrap\Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "",// always need it for jquery plugin
    "size" => "modal-full"
]) ?>
<?php \yii\bootstrap\Modal::end(); ?>

<style>
    *{
        transition: 0.3s all;
    }
    .findoptions{
        width: 100%;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        background-size: 100% 100%;
        background-repeat: no-repeat;
        background-position: center center;
        display: block;
    }
    .textkm {
        color: black !important;
        text-align: justify;
    }
    .resulttim{
        /*border: 2px solid #ddd;*/
        border-radius: 4px;
        padding: 10px;

    }
    h3 {
        color: black !important !important;
        font-weight: bold !important;
        font-size: 1.5em !important;
    }
    .choosesached{
        border: 4px solid #e33135!important;
        position: relative;
    }
    .choosesached:before{
        background-image: url("/images/choose.png");
        content:"";
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
        display: inline-block;
        width: 50px;
        height: 50px;
        position: absolute;
        top: 0;
        right: 0;
    }
    .choosesached:after{

        content:"";
        background: #e33135;
        opacity: 10%;
        display: inline-block;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        right: 0;
    }
    .hotro{
        cursor: pointer;
    }
    .hotro2{
        cursor: pointer;
    }
    .robot{
        position: fixed;bottom: 10px;left: 10px;z-index: 999
    }
    .robot2{
        position: relative!important;display: inline-block;
        float: left;
        height: 100%;
    }
    .hotro2{
        position: absolute;
        bottom: 0;
        left: 0;
    }
    .hoi{
        display: inline-block;
        float: left;

    }
    @media screen and (min-width: 0px){
        .robot{
            width: 40%;
        }
        .hoi{
            width: 55%;
            padding: 0 2.5%;
        }
    }
    @media screen and (min-width: 990px){
        .robot{
            width: 30%;
        }
        .hoi{
            width: 65%;
            padding: 0 2.5%;
        }
    }
    @media screen and (min-width: 1280px){
        .robot{
            width: 15%;
        }
        .hoi{
            width: 80%;
            padding: 0 2.5%;
        }
    }
    @media screen and (max-width: 768px){
        .robot2{
            width: 20%!important;
        }
        .hoi{
           width: 75%;
            padding: 0 2.5%;
        }
    }
</style>

