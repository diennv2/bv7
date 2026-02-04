<?php
function generateIcon($path, $ext)
{
    switch ($ext) {
        case "csv":
        case "xlsx":
        case "xls":
            return "<i style='color: darkgreen' class='fa fa-file-excel-o'></i>";
        case "doc":
        case "docx":
            return "<i style='color: #0a67b0' class='fa fa-file-word-o'></i>";
        case "jpg":
        case "jpeg":
        case "png":
        case "webp":
            return "<a class='fancy' href='". $path ."'><img style='width: 100%;height: auto' src='" . $path . "'></a>";
        case "pdf":
            return "<i style='color:firebrick;' class='fa fa-file-pdf-o'></i>";
    }
    return "<i class='fa fa-files-o'></i>";
}

if (empty($listitem)):
    echo "<p class='alert alert-warning'><i class='fa fa-info-circle'></i> Thư mục trống</p>";
else:
    ?>
    <style>
        .ext{
            text-align: center;
        }
        .ext i{
            font-size: 90px;
        }
        .toolbox a i{
            font-size: 20px;
        }
    </style>
    <div class="row" style="padding-top: 10px;padding-bottom: 10px;box-shadow: rgba(3, 102, 214, 0.3) 0px 0px 0px 3px;">
        <?php foreach ($listitem as $index => $value): ?>
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6"
                 style="height: 230px; overflow-y: clip;margin-bottom: 15px;">
                <div style="height: 210px;padding: 10px;box-shadow: rgba(136, 165, 191, 0.48) 6px 2px 16px 0px, rgba(255, 255, 255, 0.8) -6px -2px 16px 0px; border-radius: 14px!important;">
                    <div style="height: 100px;overflow-y: hidden;" class="ext">
                        <?= generateIcon($value['url'], $value['ext']) ?>
                    </div>
                    <p style="margin-top: 5px;margin-bottom:5px;overflow: hidden;width: 100%;height: 50px; text-overflow: ellipsis; "><?= $value['name'] ?></p>
                    <div style="height: 40px;padding: 5px" class="toolbox">
                        <a style="margin-right: 5px; color: darkgreen" data-target="<?=$value['url']?>" title="Chọn file này" class="chonfile"><i class="fa fa-check-circle"></i></a>
                        <a style="margin-right: 5px; color: midnightblue" href="<?=$value['url']?>" title="Tải xuống" target="_blank" download><i class="fa fa-cloud-download"></i></a>
                        <a style="margin-right: 5px; color: darkred" data-target="<?=$value['path']?>"  title="Xóa" class="delfile"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php
endif;
?>
<script>
    $(document).ready(function () {
        $(".fancy").fancybox();
        $(document).off("click",'.delfile').on("click",'.delfile',function () {
            var self=$(this);

            if(confirm("Xác nhận xóa, việc này không thể khôi phục?")){
                block({target:".portlet "});
                $.ajax(
                    {
                        type: 'POST',
                        url: '/admin/admin/deletefile',
                        data: {
                            target: self.data("target"),
                            "<?= Yii::$app->request->csrfParam; ?>":"<?=Yii::$app->request->csrfToken?>"
                        },
                        dataType: 'json',
                        success: function(t) {
                            unblock(".portlet ");
                            if(t.status){
                                self.parent().parent().parent().remove();
                                alert(t.mes)
                            }else{
                                alert(t.mes)
                            }

                        },
                    }
                )
            }
        })
        $(document).off("click",'.chonfile').on("click",'.chonfile',function () {
            var self=$(this);
            window.opener.CKEDITOR.tools.callFunction($(document).find("#funcnum").val(),self.data('target'));
            window.close();
        })
    })
</script>
