<?php
use yii\helpers\Html;
?>
<div class="col-md-6" style="padding-left: 0">
    <div class="form-group">
        <label class="control-label">Tên hiển thị</label>
        <?=
        Html::textInput('listsanpham[tenhienthi]','',['class'=>'form-control'])
        ?>

    </div>
    <div class="form-group">
        <label class="control-label">Số sản phẩm</label>
        <?=
        Html::numberInput('listsanpham[sosanphamhienthi]',4,['class'=>'form-control'])
        ?>

    </div>
</div>
<div class="col-md-6" style="padding-right: 0">
    <div class="form-group">
        <label class="control-label">Dữ liệu</label>
        <?=
        Html::dropDownList('listsanpham[nguondulieu]','',[0=>'Danh mục sản phẩm',1=>'Danh mục sản phẩm tự định nghĩa'],['class'=>'form-control','id'=>'dulieu'])
        ?>

    </div>
    <div class="form-group" id="divdanhmucsanpham">
        <label class="control-label">Danh mục sản phẩm</label>
        <?=
        Html::dropDownList('listsanpham[danhmucsanpham]','',\common\models\Catproduct::getListCat(),['id'=>'drop-link','class'=>'form-control'])
        ?>
    </div>
    <div class="form-group hidden" id="divdanhmucsanphamtudinhnghia">
        <label class="control-label" for="lienkettinh">Danh mục sản phẩm tự định nghĩa (chọn sản phẩm để thêm)</label>
        <?=Html::dropDownList('sanphamlist','',\yii\helpers\ArrayHelper::map(func::getProductsByCat(),'value','text','group'),['id'=>'drop-product','prompt'=>'Chọn','class'=>'form-control'])?>
        <div id="dulieutudinhnghia" class="table-responsive">
            <table id="dulieutudinhnghia" class="table table-bordered table-hover table-striped">
                <tr><th>Mục</th><td></td></tr>
            </table>
        </div>

    </div>
</div>
<div class="clearfix"></div>
<script>
    $(document).ready(function () {
        $("#drop-product").select2({
            closeOnSelect: false
        });
    })
</script>