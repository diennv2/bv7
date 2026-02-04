<?php $this->context->og_type = 'website';

use yii\widgets\ActiveForm;

\johnitvn\ajaxcrud\CrudAsset::register($this);
/** @var \common\models\Congviec $model */

$listdiadiem = \common\models\Diadiem::find()->all();
$nganhnghes = \common\models\Nganhnghe::find()->all();
$config = \common\models\Configure::getConfig(); ?>
<div class="container">
    <div class="box_file">
        <div class="left_danhmuc">
            <div class="content-listt">
                <h3 class="title_danhmuc">
                    Tuyển Dụng </h3>
                <p>
                    <a class="active" href="javascript:void(0)">
                        <?= $model->ten ?>
                    </a>
                </p>
                <p>
                    <a href="/">
                        Trở về trang chủ
                    </a>
                </p>
            </div>
            <div class="content-listt">
                <h3 class="title_danhmuc">
                    Dịch vụ
                </h3>
                <?php foreach (\common\models\Menu::find()->where(['active' => 1, 'type' => 'bottom'])->orderBy('ord asc')->all() as $valueMenu): /** @var \common\models\Menu $valueMenu */ ?>

                    <p class=" transition ">
                        <a class="transition" href="<?= $valueMenu->link ?>"
                           title="<?= $valueMenu->name ?>"><i class="fa fa-globe"
                                                              aria-hidden="true"></i>
                            <?= $valueMenu->name ?></a>

                    </p>
                <?php endforeach; ?>


            </div>
        </div>
        <div class="right_content contentcsc">
            <div class="title_cviec">
                <h3><?= $model->ten ?></h3>
                <?php  $listnganhnghe = \yii\helpers\Json::decode($model->nganhnghe);
                $result = "";
                foreach ($listnganhnghe as $value){
                    foreach ($nganhnghes as $valuenganh){
                        if($value==$valuenganh->id){
                            $result.="<span class='label label-success' style='font-size: 85%;font-weight: 100'>".$valuenganh->ten."</span>  ";
                            break;
                        }
                    }
                }?>
                <div style="margin-bottom: 15px"><?=$result?></div>
            </div>
            <?php $doanhnghiep = \common\models\Donvi::findOne(['id' => $model->donvi]) ?>
            <div class="contentactile">
                <div class="visk">
                    <h4 class="titlecon"><?= $doanhnghiep->companyname ?></h4>
                </div>
                <div class="nolist">
                    <?= \yii\helpers\HtmlPurifier::process($doanhnghiep->aboutcompany) ?>
                </div>
            </div>
            <div class="contentactile">
                <div class="visk">
                    <h4 class="titlecon">Mô tả công việc</h4>
                </div>
                <div class="nolist">
                    <?= \yii\helpers\HtmlPurifier::process($model->mota) ?>
                </div>
            </div>

            <div class="contentactile">
                <div class="visk">
                    <h4 class="titlecon">Yêu cầu chung</h4>
                </div>
                <div class="nolist cpyc">
                    <div class="left-cpyc">
                        <?= \yii\helpers\HtmlPurifier::process($model->yeucauchung) ?>
                    </div>
                    <div class="right-cpyc">
                        <div class="scroll_info">
                            <div class="big_job">
                                <h6>Thông tin chung</h6>
                                <p><b>Vị trí ứng tuyển</b><br>
                                    <?= \yii\helpers\HtmlPurifier::process($model->vitriungtuyen) ?>
                                </p>
                                <p><b>Cấp bậc</b><br>
                                    <?=\yii\helpers\HtmlPurifier::process($model->capbac)?></p>
                                <p><b>Thời gian làm việc</b><br>
                                    <?=\yii\helpers\HtmlPurifier::process($model->thoigianlamviec)?></p>
                                <p><b>Mức lương</b><br>
                                    <?=\yii\helpers\HtmlPurifier::process($model->mucluong)?></p>
                                <p><b>Nơi làm việc</b><br>
                                    <?php  $listnoilamviec = \yii\helpers\Json::decode($model->noilamviec);
                                    $result = "";
                                    foreach ($listnoilamviec as $value){
                                        foreach ($listdiadiem as $valueDiadiem){
                                            if($value==$valueDiadiem->id){
                                                $result.="<span class='label label-success' style='font-size: 85%;font-weight: 100'>".$valueDiadiem->ten."</span>  ";
                                                break;
                                            }
                                        }
                                    }?>
                                <?=$result?></p>
                                <div class="contact-person">
                                    <h6>Tư vấn viên</h6>
                                    <div style="padding: 0 15px">
                                        <?=\yii\helpers\HtmlPurifier::process($model->tuvanvien)?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="contentactile">
                <div class="visk">
                    <h4 class="titlecon">Chính sách/Phúc lợi</h4>
                </div>
                <div class="nolist">
                    <?=\yii\helpers\HtmlPurifier::process($model->chinhsachphucloi)?>
                </div>
            </div>
            <div class="contentactile">
                <div class="visk">
                    <h4 class="titlecon">Liên hệ</h4>
                </div>
                <div class="nolist">
                    <?=\yii\helpers\HtmlPurifier::process($model->lienhe)?>
                </div>
            </div>
            <div class="fb-like"
                 data-href="<?php echo (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"
                 data-layout="standard" data-action="like" data-size="large" data-show-faces="true"
                 data-share="true"></div>
            <div class="fb-comments"
                 data-href="<?php echo (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"
                 data-numposts="5"></div>
        </div>
    </div>
</div>
