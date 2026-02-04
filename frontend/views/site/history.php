<?php
/**
 * Created by PhpStorm.
 * User: Duong_IT
 * Date: 8/21/2017
 * Time: 9:36 PM
 * @var $lienhetuvan  \common\models\Lienhetuvan
 */
$config = \common\models\search\Configure::getConfig();
$nab = Yii::$app->controller->navbar;
?>
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

<div class="container" id="columns">

    <h2 class="page-heading no-line">
        <span class="page-heading-title2">Đơn hàng</span>
    </h2>
    <!-- ../page heading-->
    <div class="page-content page-order">

        <div class="order-detail-content">
            <p>Dưới đây là thông tin tài khoản thanh toán của chúng tôi:</p>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    echo \yii\widgets\ListView::widget([
                        'dataProvider' => $dataProvider,
                        'layout' =>  "{summary}\n<div class='table-responsive '> <table class=\"table table-bordered cart_summary\"> <thead> <tr> <th class=\"cart_product\">Mã đơn hàng</th> <th>Ngày đặt</th> <th>Tổng thanh toán</th> <th>Cú pháp chuyển khoản</th> <th>Trạng thái</th>  </tr> </thead> <tbody>{items}</tbody></table></div>\n{pager}",
                        'itemOptions' => [

                            'tag' => false

                        ],
                        'itemView' =>function ($order, $key, $index, $widget) use($config){

                            return $this->render( '_donhang', [
                                'lienhetuvan'=>$order,
                                'config'=>$config
                            ]);

                        },
                    ]);
                    ?>

                </div>

            </div>

        </div>
    </div>
</div>
<?php \yii\bootstrap\Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
    "size"=>"modal-full"
])?>
<?php \yii\bootstrap\Modal::end(); ?>
<script>
    $(document).ready(function () {
        $(document).on("click","button[role='modal-remote']",function (e) {
            e.preventDefault();
        });
        $(document).on('click',".submits",function () {
            var dulieu = $("#forms").serializeArray();
            var id =$(this).attr("data-target");
            if(dulieu.length!==7){
                Swal.fire('Bạn chưa trả lời hết các câu hỏi!', 'Vui lòng chọn lại.', 'warning');
                return false;
            }
            if($("#cau5").val().length<50){
                Swal.fire('Bạn hãy nhập ít nhất 50 ký tự tại câu trả lời số 5!', 'Vui lòng nhập lại.', 'warning');
                return false;
            }
            $.ajax({
                url:"<?=Yii::$app->urlManager->createUrl(['site/updatetraloi'])?>",
                type:'post',
                data:$("#forms").serialize(),
                complete:function () {
                    $("#ajaxCrudModal").modal('toggle');
                    $("#traloi"+id).remove();
                    Swal.fire('Thành công, câu trả lời của bạn đã được ghi nhận, nhấn OK để xem kết quả!', 'Thành công!', 'success').then(()=>{
                        $("#xemkq"+id).removeClass('hidden').click();
                    });

                }
            });

        })
    })
</script>
