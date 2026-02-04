<i>Giá bán (để giá trị 0 nếu muốn hiển thị "liên hệ để biết giá")</i>
<table id="ketqua" class="table table-hover table-bordered table-striped">
    <tr><th colspan="5">Các phiên bản đã có</th></tr>
    <tr>
        <th>Giá gốc</th>
        <th>Giá bán</th>
        <th>Thuộc tính</th>
        <th>Còn hàng</th>
        <th></th>
    </tr>

    <?php foreach ($data as $index=>$value):/** @var \common\models\Thuoctinhproduct $value */?>
        <tr>
            <td><?=number_format($value->giagoc,0,"",".")?> VNĐ</td>
            <td><?=number_format($value->gia,0,"",".")?> VNĐ</td>

            <td><label class="label label-danger"><?php
                    $dulieuthuoctinh = \yii\helpers\Json::decode($value->thuoctinh_id);
                    foreach ($dulieuthuoctinh as $value2){
                        foreach ($listthuoctinh as $valuett){
                            if($valuett->id==$value2){
                                echo $valuett->tenthuoctinh.", ";
                                break;
                            }
                        }
                    }
                    ?></label></td>
            <td><?=($value->conhang)?"<span class='text-success'>Còn hàng</span>":"<span class='text-danger'>Hết hàng</span>"?></td>
            <td>
                <a class="deletethuoctinh glyphicon glyphicon-remove text-danger" data-target="<?=$value->id?>"></a>
                <a data-href="/admin/thuoctinhproduct/update?id=<?=$value->id?>" class="updatephienbanineditmode" data-target="#ajaxCrudModal2" title="Update" data-toggle="modal"><span class="glyphicon glyphicon-pencil"></span></a>
            </td>
        </tr>

    <?php endforeach;?>
    <tr><th colspan="5">Thêm mới</th></tr>
    <tr>
        <th>Giá gốc</th>
        <th>Giá bán</th>
        <th>Thuộc tính</th>
        <th>Còn hàng</th>
        <th></th>
    </tr>
    <tbody id="sstbody"></tbody>
</table>