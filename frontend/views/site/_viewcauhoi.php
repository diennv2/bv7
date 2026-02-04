<?php
/** @var \common\models\Listnhanqua $listnhanqua */
use yii\widgets\DetailView;
if(empty($cauhoi)):
    echo "Không tìm thấy câu hỏi nào!";
else:

    if($listnhanqua->isdatraloi==0):
    ?>
    <?php

    /* @var $this yii\web\View */
    /* @var $model common\models\Billmobile */
    $config=\common\models\Configure::getConfig();
    ?>
    <div class="billmobile-view">
        <div class="row">
            <div class="col-xs-12 clearfix table-responsive">
                <?= \yii\helpers\Html::beginForm('','',['id'=>'forms']);?>
                <table class="table table-bordered table-striped table-hover">
                    <tr style="border-top: 2px solid black"><th style="background: #daefa3">STT</th><th style="background: #daefa3">Câu hỏi</th><th style="background: #daefa3">Đáp án A</th><th style="background: #daefa3">Đáp án B</th><th style="background: #daefa3">Đáp án C</th></tr>

                    <?php foreach ($cauhoi as $index=>$value):/** @var \common\models\Traloicauhoi $value */?>
                        <?php if($value->cauhoi!=-1):?>
                            <?php $cauhois = \common\models\Cauhoi::findOne($value->cauhoi);if(!is_null($cauhois)):?>
                                <tr><th><?=($index+1)?></th><th><?=$cauhois->cauhoi?></th>
                                    <td>
                                        <label class="control-label" style="display: block;font-weight:lighter">
                                            <input type="radio" name="<?=$value->id?>" value="A"> <?=$cauhois->cautraloia?>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="control-label" style="display: block;font-weight:lighter">
                                            <input type="radio" name="<?=$value->id?>" value="B"> <?=$cauhois->cautraloib?>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="control-label" style="display: block;font-weight:lighter">
                                            <input type="radio" name="<?=$value->id?>" value="C"> <?=$cauhois->cautraloic?>
                                        </label>
                                    </td>
                                </tr>
                            <?php else:?>
                                <tr><th><?=($index+1)?></th><td colspan="4">Không tìm thấy câu hỏi này! vui lòng liên hệ quản trị viên</td></tr>
                            <?php endif;?>
                        <?php else:?>
                            <?php $cauhois = \common\models\Cauhoi::findOne(['product_id'=>-1]);if(!is_null($cauhois)):?>
                                <tr><th><?=($index+1)?></th><th><?=$cauhois->cauhoi?></th><td colspan="3"><textarea id="cau5" name="cau5-<?=$value->id?>" class="form-control"></textarea></td></tr>
                            <?php endif;?>
                        <?php endif;?>
                    <?php endforeach;?>

                </table>
                <?= \yii\helpers\Html::endForm()?>
                <button class="btn btn-default submits" data-target="<?=$listnhanqua->billid?>"> <i class="fa fa-sticky-note"></i> Gửi câu trả lời</button>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <?php else:?>
        <div class="billmobile-view">
            <div class="row">
                <div class="col-xs-12 clearfix table-responsive">

                    <table class="table table-bordered table-striped table-hover">
                        <tr style="border-top: 2px solid black"><th style="background: #daefa3">STT</th><th style="background: #daefa3;width: 50%">Câu hỏi</th><th style="background: #daefa3">Đáp án A</th><th style="background: #daefa3">Đáp án B</th><th style="background: #daefa3">Đáp án C</th><th style="background: #daefa3">Đáp án bạn chọn</th><th style="background: #daefa3">Kết quả</th></tr>

                        <?php $dem=0; foreach ($cauhoi as $index=>$value):/** @var \common\models\Traloicauhoi $value */ if($value->status==1){$dem++;}?>
                            <?php if($value->cauhoi!=-1):?>
                                <?php $cauhois = \common\models\Cauhoi::findOne($value->cauhoi);if(!is_null($cauhois)):?>
                                    <tr><th><?=($index+1)?></th><th><?=$cauhois->cauhoi?></th>
                                        <td style="text-align: left">
                                            <label class="control-label dapan<?=$value->id?>A" style="display: block;font-weight:lighter">
                                                <?=$cauhois->cautraloia?>
                                            </label>
                                        </td>
                                        <td style="text-align: left">
                                            <label class="control-label dapan<?=$value->id?>B" style="display: block;font-weight:lighter">
                                                <?=$cauhois->cautraloib?>
                                            </label>
                                        </td>
                                        <td style="text-align: left">
                                            <label class="control-label dapan<?=$value->id?>C" style="display: block;font-weight:lighter">
                                                <?=$cauhois->cautraloic?>
                                            </label>
                                        </td>
                                        <td style="text-align: right"><?=$value->dapancuakhach?></td>
                                        <td style="text-align: right"><?=($value->status==0)?"<i class='fa fa-remove text-danger'></i>":"<i class='fa fa-check-circle text-success'></i>"?></td>
                                    </tr>
                                <style>
                                    .dapan<?=$value->id.$value->cautraloi?>{
                                        font-weight: bold!important;
                                        color: red!important;
                                    }
                                </style>
                                <?php else:?>
                                    <tr><th><?=($index+1)?></th><td colspan="4">Không tìm thấy câu hỏi này! vui lòng liên hệ quản trị viên</td></tr>
                                <?php endif;?>
                            <?php else:?>
                                <?php $cauhois = \common\models\Cauhoi::findOne(['product_id'=>-1]);if(!is_null($cauhois)):?>
                                    <tr><th><?=($index+1)?></th><th><?=$cauhois->cauhoi?></th><td colspan="5"><textarea class="form-control" disabled rows="5"><?=$value->dapancuakhach?></textarea></td></tr>
                                <?php endif;?>
                            <?php endif;?>
                        <?php endforeach;?>
                        <tr style="border-top: 2px solid black;">
                            <th style="text-align: right" colspan="5">Số câu đúng/tổng số câu:</th>
                            <th style="text-align: right" colspan="2"><span class="text-success" style="font-weight: bold"><?=$dem?></span>/<b class="text-danger">5</b></th></tr>
                        <tr style="border-top: 2px solid black;">
                            <th style="text-align: right" colspan="5">Tổng thưởng:</th>
                            <th style="text-align: right" colspan="2"><span class="text-success" style="font-weight: bold"><img src="/images/coin.png" style="width: 30px"><?=number_format($dem*20000,0,"",".")?></span></th></tr>
                        <tr style="border-top: 2px solid black;">
                            <th style="text-align: right" colspan="5"></th>
                            <th style="text-align: right" colspan="2"><?php if($listnhanqua->isdanhanqua==0):?> <span class="label label-info">Điểm thưởng đã được ghi nhận, sẽ được cập nhật sau khi quản trị viên phê duyệt</span> <?php else:?> <span class="label label-info">Điểm thưởng đã được chuyển</span> <?php endif;?></th></tr>
                    </table>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    <?php endif;?>
<?php endif;?>
