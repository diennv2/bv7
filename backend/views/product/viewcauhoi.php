<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <tr style="border-top: 2px solid black"><th style="background: #daefa3">STT</th><th style="background: #daefa3">Câu hỏi</th><th style="background: #daefa3">Đáp án A</th><th style="background: #daefa3">Đáp án B</th><th style="background: #daefa3">Đáp án C</th><th style="background: #daefa3">Đáp án đúng</th><th style="background: #daefa3">Độ khó</th><th></th></tr>
        <?php foreach ($cauhoi as $index=>$value):/** @var \common\models\Thuoctinhproduct $value */?>

            <tr><td><?=($index+1)?></td><td><?=$value->cauhoi?></td><td class="td-<?=$value->id?>-A"><?=$value->cautraloia?></td><td class="td-<?=$value->id?>-B"><?=$value->cautraloib?></td><td class="td-<?=$value->id?>-C"><?=$value->cautraloic?></td><th><?=$value->dapan?></th><td><?=$value->dokho?></td>
                <td class="skip-export kv-align-center kv-align-middle" style="width:80px;" data-col-seq="7"><a href="/admin/cauhoi/view?id=<?=$value->id?>" title="View" data-pjax="0" role="modal-remote" data-toggle="tooltip" data-target="#ajaxCrudModal2"><span class="glyphicon glyphicon-eye-open"></span></a> <a href="/admin/cauhoi/update?id=<?=$value->id?>" title="Update" data-pjax="0" role="modal-remote" data-toggle="tooltip"><span class="glyphicon glyphicon-pencil"></span></a> <a class="crud-datatable-action-del" href="/admin/cauhoi/delete?id=<?=$value->id?>" title="Delete" data-pjax="false" data-pjax-container="crud-datatable-pjax" role="modal-remote" data-request-method="post" data-toggle="tooltip" data-confirm-title="Are you sure?" data-confirm-message="Are you sure want to delete this item"><span class="glyphicon glyphicon-trash"></span></a></td>
            </tr>
            <style>
                .td-<?=$value->id?>-<?=$value->dapan?>{
                    font-weight: bold;
                    color: red;
                }
            </style>
        <?php endforeach;?>
    </table>
</div>