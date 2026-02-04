<?php
$this->context->og_type = "article";
$this->title = $landing->name;
?>
<?php
header('Content-type: text/plain');
    echo file_get_contents((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]".$landing->templatefile)
?>
<div id="fb-like" class="hidden">
    <div class="fb-like"
         data-href="<?php echo (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"
         data-layout="standard" data-action="like" data-size="large" data-show-faces="true"
         data-share="true"></div>
</div>
<div id="fb-comment" class="hidden">
    <div class="fb-comments"
         data-href="<?php echo (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"
         data-numposts="5" data-width="100%"></div>
</div>
<script>
    $(document).ready(function () {
        $.ajax({
            url:"<?=Yii::$app->urlManager->createUrl(['site/getlanding','url'=>$landing->url,'id'=>$landing->id])?>",
            type:'post',
            dataType:'json',
            success:function(data){
                $.each(data,function(index,value){
                    $("#"+index).html(value);
                });
            }
        });
        $(".fbcomment").html($("#fb-comment").clone().removeAttr('class'));
        $(".fblike").html($("#fb-like").clone().removeAttr('class'));
    })
</script>
