<tr>
    <td class="cart_product">
        <a style="font-weight: bold" href="/site/viewbill.html?id=<?=$bill->id?>" onclick="return false" title="View" data-pjax="0" role="modal-remote" data-toggle="tooltip"> <?="# ".$bill->id?> <span class="fa fa-eye"></span></a>
    </td>
    <td>
        <?=$bill->ngaylap?>
    </td>
    <td>
        <?=number_format($bill->tongsauvat,0,',','.').$config['money_suffix']?>
    </td>
    <td>TULATO USER<?=Yii::$app->user->id?> <?=$bill->id?></td>
    <td><?php
        if($bill->status==-1){
            echo "<span style='padding: 5px' class='text-danger' style='color: red'>Chưa thanh toán</span>";
        }else if($bill->status==0){
            echo "<span style='padding: 5px' class='label label-warning' style='color: red'>Thanh toán thành công, chờ xử lý</span>";
        }else if($bill->status==1){
            echo "<span style='padding: 5px' class='label label-success'>Đã hoàn thành</span>";
        }else if($bill->status==2){
            echo "<span style='padding: 5px' class='label label-danger'>Đã hủy</span>";
        }else if($bill->status==3){
            echo "<span style='padding: 5px' class='label label-warning'>Đang chuẩn bị</span>";
        }else{
            echo "<span style='padding: 5px' class='label label-info'>Đang vận chuyển</span>";
        }
        ?></td>
    <td>

            <?php if($bill->nhanquastatus==0):?>
                <a class="btn btn-success" href="<?=Yii::$app->urlManager->createUrl(['site/nhanqua','id'=>$bill->id])?>"> <i class="fa fa-gift"></i> Nhận quà</a>
            <?php else:?>
                <table class="table">
                    <tr><td colspan="2"><span class="label label-info" style="padding: 5px"><i class="fa fa-gift"></i> Đã nhận quà, đang xử lý</span><br><i> Chúng tôi đã nhận được lựa chọn của bạn và đang trong quá trình xử lý!</i></td></tr>
                    <?php $listnhanquas = \common\models\Listnhanqua::findAll(['billid'=>$bill->id]);?>
                    <?php if(empty($listnhanquas)):?>
                        <tr><td class="text-danger">Không tìm thấy quà bạn lựa chọn, vui lòng liên hệ hỗ trợ!</td></tr>
                    <?php else:?>
                        <?php foreach ($listnhanquas as $listnhanqua):?>
                            <?php $product = \common\models\Product::findOne(['id'=>$listnhanqua->productid]);?>
                            <?php if(is_null($product)):?>
                                <tr><td class="text-danger">Không tìm thấy sách bạn lựa chọn, vui lòng liên hệ hỗ trợ!</td></tr>
                            <?php else:?>
                                <tr><td style="width: 150px" ><img style="width: 150px" src="<?=$product->getDefaultImage()?>"></td><td>
                                        <p><b><?=$product->name?></b></p>
                                        <p> (<?=$listnhanqua->ngaynhan?>)</p>
                                        <p class="label-success label" style="display:block;margin-top: 5px;padding: 5px">Trong thời gian chờ bạn có thể:</p>
                                        <p style="margin-top: 5px"><a href="<?=$product->ebook?>" target="_blank" style="display: block" class="ebook btn btn-info"> <i class="fa fa-eye"></i> Đọc sách ebook online</a></p>
                                        <?php if($listnhanqua->isdatraloi==0):?>
                                            <p style="margin-top: 5px"><?=\yii\helpers\Html::a(' <i class="fa fa-check"></i> Trả lời câu hỏi để nhận điểm thưởng', ['getviewcauhoi','id'=>$bill->id],
                                                    ['role'=>'modal-remote','onClick'=>'return false','title'=> 'Xem câu hỏi','class'=>' btn btn-warning','id'=>'traloi'.$bill->id,'style'=>'display:block']);?></p>
                                            <p style="margin-top: 5px"><?=\yii\helpers\Html::a(' <i class="fa fa-check"></i> Xem kết quả và nhận thưởng ('.count(\common\models\Traloicauhoi::find()->where('listnhanquaid='.$listnhanqua->id." and status=1")->all()).'/5)', ['getviewcauhoi','id'=>$bill->id],
                                                    ['role'=>'modal-remote','onClick'=>'return false','title'=> 'Xem câu hỏi','class'=>' btn btn-warning hidden','id'=>'xemkq'.$bill->id,'style'=>'display:block']);?></p>
                                        <?php else:?>
                                            <p style="margin-top: 5px"><?=\yii\helpers\Html::a(' <i class="fa fa-check"></i> Xem kết quả và nhận thưởng ('.count(\common\models\Traloicauhoi::find()->where('listnhanquaid='.$listnhanqua->id." and status=1")->all()).'/5)', ['getviewcauhoi','id'=>$bill->id],
                                                    ['role'=>'modal-remote','onClick'=>'return false','title'=> 'Xem câu hỏi','class'=>' btn btn-warning','id'=>'xemkq'.$bill->id,'style'=>'display:block']);?></p>
                                        <?php endif;?>

                                    </td></tr>
                            <?php endif;?>
                        <?php endforeach;?>
                    <?php endif;?>
                </table>
            <?php endif;?>

    </td>
</tr>