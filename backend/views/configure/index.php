<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\Configure */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cấu hình Website';
$this->params['breadcrumbs'][] = ['name' => $this->title, 'link' => 'javascript:void(0)'];
$configlist = \common\models\Configure::getConfig();
CrudAsset::register($this);

?>

<?php echo \yii\helpers\Html::beginForm('', '', ['id' => 'form-config']);
$list = Yii::$app->db->createCommand('select DISTINCT nhom from configure where nhom <> "Local" and nhom<>"giaodien"')->queryAll();

?>
<div id='div-config'><?php echo \yii\helpers\Html::button('Lưu lại cài đặt', ['class' => 'btn blue', 'id' => 'btn-luu']); ?>
    <?php
    foreach ($list as $value):
        ?>
        <div class="col-xs-12" style=" border-radius: 4px; padding: 15px; margin-bottom: 15px">

            <h3 class="caption-subject font-blue-steel bold uppercase"
                style="font-size: 22px;background: #f5f5f5; padding: 15px">Thiết lập <?php echo $value['nhom'] ?></h3>

            <div class="clearfix"></div>
            <?php $config = \common\models\Configure::find()->where('nhom=:nhom', [':nhom' => $value['nhom']])->all();
            foreach ($config as $configs):/** @var \common\models\Configure $configs */ if($configs->name!="index_topbar"):
                ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <?php echo \yii\helpers\Html::label('<span class="caption-subject font-blue-steel bold uppercase" title="' . $configs->name . '">' . $configs->label . ':</span>', '', ['class' => 'form-label']); ?>
                        <?php

                        if (strtolower($configs->label) != "password")
                            echo \yii\helpers\Html::textInput('config[' . $configs->name . ']', $configs->value, ['class' => 'form-control', 'placeholder' => $configs->label]);
                        if (strtolower($configs->label) == "password")
                            echo \yii\helpers\Html::passwordInput('config[' . $configs->name . ']', $configs->value, ['class' => 'form-control', 'placeholder' => $configs->label]);


                        ?>
                    </div>
                </div>
            <?php endif; endforeach; ?>
            <?php if ($value['nhom'] == "Cấu hình trang chủ"): ?>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <?php echo \yii\helpers\Html::label('<span class="caption-subject font-blue-steel bold uppercase" title="favicon">Ảnh Topbar:</span>', '', ['class' => 'form-label']);
                        $fav = \common\models\Configure::find()->where('name=:name', [':name' => "index_topbar"])->one();
                        ?><br>
                        <img id="topbar"
                             src="<?php echo str_replace("/admin", "", Yii::$app->request->getBaseUrl()) . $fav->value ?>"
                             style="width: 100%; height: auto; margin-bottom: 10px">
                        <?php
                        echo Html::fileInput('index_topbar', "", ['data-target' => "#topbar", 'onChange' => "uploadImage2(this)"]);
                        ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($value['nhom'] == "Cấu hình hiển thị"): ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <?php echo \yii\helpers\Html::label('<span class="caption-subject font-blue-steel bold uppercase" title="favicon">Icon trang:</span>', '', ['class' => 'form-label']);
                        $fav = \common\models\Configure::find()->where('name=:name', [':name' => "favicon"])->one();
                        ?><br>
                        <img id="fav"
                             src="<?php echo str_replace("/admin", "", Yii::$app->request->getBaseUrl()) . $fav->value ?>"
                             style="width: 50px; height: auto; margin-bottom: 10px">
                        <?php
                        echo Html::fileInput('icon', "", ['data-target' => "#fav", 'onChange' => "uploadImage2(this)"]);
                        ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($value['nhom'] == "Cấu hình liên hệ"): ?>
                <div class="col-xs-12" style="padding: 0">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <?php echo \yii\helpers\Html::label('<span class="caption-subject font-blue-steel bold uppercase" title="contact_logo">Logo:</span>', '', ['class' => 'form-label']);
                            $fav = \common\models\Configure::find()->where('name=:name', [':name' => "contact_logo"])->one();
                            ?><br>
                            <img id="fav2"
                                 src="<?php echo str_replace("/admin", "", Yii::$app->request->getBaseUrl()) . $fav->value ?>"
                                 style="width: 100%; height: auto; margin-bottom: 10px">
                            <?php
                            echo Html::fileInput('logo', "", ['data-target' => "#fav2", 'onChange' => "uploadImage2(this)"]);
                            ?>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <?php echo \yii\helpers\Html::label('<span class="caption-subject font-blue-steel bold uppercase" title="contact_logo">Logo Footer:</span>', '', ['class' => 'form-label']);
                            $fav = \common\models\Configure::find()->where('name=:name', [':name' => "contact_logo_footer"])->one();
                            ?><br>
                            <img id="fav3"
                                 src="<?php echo str_replace("/admin", "", Yii::$app->request->getBaseUrl()) . $fav->value ?>"
                                 style="width: 100%; height: auto; margin-bottom: 10px">
                            <?php
                            echo Html::fileInput('logofooter', "", ['data-target' => "#fav3", 'onChange' => "uploadImage2(this)"]);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <?php echo \yii\helpers\Html::label('<span class="caption-subject font-blue-steel bold uppercase" title="contact_logo">Slogan header:</span>', '', ['class' => 'form-label']);
                            $fav = \common\models\Configure::find()->where('name=:name', [':name' => "contact_slogan_header"])->one();
                            ?><br>
                            <img id="fav4"
                                 src="<?php echo str_replace("/admin", "", Yii::$app->request->getBaseUrl()) . $fav->value ?>"
                                 style="width: 100%; height: auto; margin-bottom: 10px">
                            <?php
                            echo Html::fileInput('sloganheader', "", ['data-target' => "#fav4", 'onChange' => "uploadImage2(this)"]);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <?php echo \yii\helpers\Html::label('<span class="caption-subject font-blue-steel bold uppercase" title="contact_logo">Slogan header mobile:</span>', '', ['class' => 'form-label']);
                            $fav = \common\models\Configure::find()->where('name=:name', [':name' => "contact_slogan_header_mobile"])->one();
                            ?><br>
                            <img id="fav5"
                                 src="<?php echo str_replace("/admin", "", Yii::$app->request->getBaseUrl()) . $fav->value ?>"
                                 style="width: 100%; height: auto; margin-bottom: 10px">
                            <?php
                            echo Html::fileInput('sloganheadermobile', "", ['data-target' => "#fav5", 'onChange' => "uploadImage2(this)"]);
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    <div class="col-xs-12" style=" border-radius: 4px; padding: 15px; margin-bottom: 15px">

        <h3 class="caption-subject font-blue-steel bold uppercase"
            style="font-size: 22px;background: #f5f5f5; padding: 15px">Thiết lập vị trí</h3>

        <div class="clearfix"></div>
        <div class="col-sm-12 col-xs-12">
            <div class="form-group" id="set_map">
                <?php echo \yii\helpers\Html::label('<span class="caption-subject font-blue-steel bold uppercase" title="local_position">Tọa độ (Kéo thả con trỏ màu đỏ tới vị trí của bạn):</span>', '', ['class' => 'form-label']); ?>
                <?php $configs = \common\models\Configure::find()->where('name=:name', [':name' => "local_position"])->one();
                echo \yii\helpers\Html::textInput('config[local_position]', $configs->value, ['class' => 'form-control', "onkeydown" => "return false;", 'id' => 'map-zone', 'placeholder' => $configs->label]);
                ?>
                <div id="map" style="margin-top: 10px; width: 100%; height: 350px;"></div>
                <script type="text/javascript"
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnO5uniEZZlEvY7gSDb4f7YBYrvYS0CF4"></script>
                <script type="text/javascript">
                    function initialize() {
                        var coor = new google.maps.LatLng(<?php echo $configs->value?>);
                        var my_options = {
                            center: coor,
                            zoom: 16,
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            mapTypeControl: true,
                            navigationControl: true,
                            navigationControlOptions: {
                                style: google.maps.NavigationControlStyle.SMALL
                            }
                        };

                        var map = new google.maps.Map(document.getElementById("map"), my_options);
                        var marker = new google.maps.Marker({
                            position: coor,
                            map: map,
                            draggable: true,
                        });

                        google.maps.event.addListener(marker, "dragend", function () {
                            vt_point = marker.getPosition();
                            str_vt = vt_point.lat() + ', ' + vt_point.lng();
                            $('#set_map input[type="text"]').val(str_vt);
                        });

                    }


                    google.maps.event.addDomListener(window, 'load', initialize);
                </script>
            </div>
        </div>
    </div>
    <?php echo \yii\helpers\Html::endForm(); ?>
    <div class="clearfix"></div>
    <div class="col-xs-12">
        <h3 class="caption-subject font-blue-steel bold uppercase"
            style="font-size: 22px;background: #f5f5f5; padding: 15px">Thiết lập banner quảng cáo</h3>
        <div class="clearfix"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <?php echo \yii\helpers\Html::label('<span class="caption-subject font-blue-steel bold uppercase" title="ad_news">Banner quảng cáo trang tin tức:</span>', '', ['class' => 'form-label']); ?>
                <img id="adnew"
                     src="<?php echo str_replace("/admin", "", Yii::$app->request->getBaseUrl()) . $configlist['ad_news'] ?>"
                     style="width: 100%; height: auto; margin-bottom: 10px">
                <?php
                echo Html::fileInput('adnew', "", ['data-target' => "#adnew", 'onChange' => "uploadImage2(this)"]);
                ?>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <?php echo \yii\helpers\Html::label('<span class="caption-subject font-blue-steel bold uppercase" title="ad_news_link">Liên kết Banner quảng cáo trang tin tức:</span>', '', ['class' => 'form-label']); ?>
                <?php
                    echo \yii\helpers\Html::textInput('config[ad_news_link]', $configlist['ad_news_link'], ['class' => 'form-control', 'placeholder' => "Liên kết Banner quảng cáo trang tin tức"]);
                ?>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <?php echo \yii\helpers\Html::label('<span class="caption-subject font-blue-steel bold uppercase" title="page_banner">Banner quảng cáo trang page:</span>', '', ['class' => 'form-label']); ?>
                <img id="page_banner"
                     src="<?php echo str_replace("/admin", "", Yii::$app->request->getBaseUrl()) . $configlist['page_banner'] ?>"
                     style="width: 100%; height: auto; margin-bottom: 10px">
                <?php
                echo Html::fileInput('page_banner', "", ['data-target' => "#page_banner", 'onChange' => "uploadImage2(this)"]);
                ?>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <?php echo \yii\helpers\Html::label('<span class="caption-subject font-blue-steel bold uppercase" title="page_banner_link">Liên kết Banner quảng cáo trang page:</span>', '', ['class' => 'form-label']); ?>
                <?php
                echo \yii\helpers\Html::textInput('config[page_banner_link]', $configlist['page_banner_link'], ['class' => 'form-control', 'placeholder' => "Liên kết Banner quảng cáo trang page"]);
                ?>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<script>
    $(document).ready(function () {
        $(document).on('click', '#btn-luu', function () {
            if (confirm("Cập nhật cấu hình?")) {
                $("#form-config").ajaxSubmit({
                    url: "<?php echo Yii::$app->urlManager->createUrl('configure/luuconfig')?>",

                    type: 'post',
                    beforeSend: function () {
                        block({target: "#div-config"});
                    },
                    success: function () {
                        alert("Success!");
                    },
                    complete: function () {
                        unblock("#div-config")
                    }
                })
            }
        })
    })
</script>