<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <?php foreach ($thuoctinhsanpham as $index=>$value):/** @var \common\models\Thuoctinhproduct $value */?>
            <tr style="border-top: 2px solid black"><th style="background: #daefa3">Phiên bản: </th><td  style="background: #daefa3; font-weight: bold"><label class="label label-danger"><?php
                    $dulieuthuoctinh = \yii\helpers\Json::decode($value->thuoctinh_id);
                    foreach ($dulieuthuoctinh as $value2){
                        foreach ($listthuoctinh as $valuett){
                            if($valuett->id==$value2){
                                echo $valuett->tenthuoctinh.", ";
                                break;
                            }
                        }
                    }
                    ?></label></td></tr>
            <tr><th>Giá gốc: </th><td><?=number_format($value->giagoc,0,"",".")?> VNĐ</td></tr>
            <tr><th>Giá bán: </th><td><?=number_format($value->gia,0,"",".")?> VNĐ</td></tr>
            <tr><th>Tình trạng: </th><td><?=($value->conhang)?"<span class='text-success'>Còn hàng</span>":"<span class='text-danger'>Hết hàng</span>"?></td></tr>

        <?php endforeach;?>
    </table>
</div>