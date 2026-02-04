<?php
/**
 * Created by PhpStorm.
 * User: cilis
 * Date: 03-Jul-17
 * Time: 4:00 PM
 */
/** @var \common\models\News $data */

$this->context->og_type = "article";
$this->title = $data->loaivanban;

$config = \common\models\Configure::getConfig();
$nab = Yii::$app->controller->navbar;
\johnitvn\ajaxcrud\CrudAsset::register($this);
$value = $data;
?>
<section class="page-108">
    <div class="container">
        <div id="middle">
            <div class="headline cmsmasters_color_scheme_default">
                <div class="headline_outer">
                    <div class="headline_color"></div>
                    <div class="headline_inner align_left">
                        <div class="headline_aligner"></div>
                        <div class="headline_text"><h1 class="entry-title"><?= $this->title ?></h1>
                            <div class="cmsmasters_breadcrumbs">
                                <div class="cmsmasters_breadcrumbs_inner">
                                    <span><?= $nab ?></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="middle_inner">
                <div class="content_wrap r_sidebar">
                    <?php
                    echo \yii\widgets\ListView::widget([
                        'dataProvider' => $dataProvider,
                        'emptyText' => 'Chưa có văn bản nào được tạo!',
                        'layout' => "<div class='row'><div class='col-xs-12' style='margin: 10px 0'>{summary}</div></div><table class='table table-bordered table-striped table-hover'><tr>
                                <th>STT</th><th>Mã văn bản</th><th>Ngày ban hành</th><th>Trích yếu</th><th>File</th>
                              </tr>{items}</table></div><div class='row'><div class='col-xs-12' style='margin: 10px 0'>{pager}</div>",
                        'itemOptions' => [
                            'tag' => false
                        ],
                        'itemView' => function ($order, $key, $index, $widget) use ($config) {

                            return $this->render('_item', [
                                'key' => $key,
                                'model' => $order,
                                'config' => $config
                            ]);

                        },
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>