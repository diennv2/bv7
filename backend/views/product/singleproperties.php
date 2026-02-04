<tr id="tr-<?=$num?>" data-target="<?=$num?>" class="tr-data-container">
    <td style="padding: 5px">
        <?=\yii\helpers\Html::numberInput('giagoc',0,['class'=>'form-control','id'=>'giagoc'.$num])?>
    </td>
    <td style="padding: 5px">
        <?=\yii\helpers\Html::numberInput('gia',0,['class'=>'form-control','id'=>'gia'.$num])?>
    </td>
    <td style="padding: 5px" class="table-responsive">
        <table class="table table-striped">
            <tr><th>Tên thuộc tính</th><th>Giá trị</th></tr>
            <?php foreach (\common\models\Loaithuoctinh::find()->all() as $value):/** @var \common\models\Loaithuoctinh $value */?>
                <tr>
                    <td><?=$value->tenloai?></td>
                    <td><?=\yii\helpers\Html::dropDownList('select','',\yii\helpers\ArrayHelper::map(\common\models\Thuoctinh::find()->where(['loaithuoctinh_id'=>$value->id])->all(),'id','tenthuoctinh'),['prompt'=>'Không chọn','class'=>'form-control thuoctinh'.$num])?></td>
                </tr>

            <?php endforeach;?>

        </table>
    </td>
    <td style="padding: 5px"><?=\yii\helpers\Html::checkbox('checkbox',true,['id'=>'conhang'.$num])?></td>
    <td><a class="deletecurrentrow glyphicon glyphicon-remove text-danger"></a></td>
</tr>
<script>
    $(".thuoctinh<?=$num?>").select2();
</script>