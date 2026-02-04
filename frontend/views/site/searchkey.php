<div style="width: 100%; text-align: center; padding: 70px">
    <p style="color:forestgreen;font-size: 18px;margin-bottom: 10px">Đang tải dữ liệu, xin chờ.....</p>
    <img src="/loading-png-gif-5.gif">
</div>
<script>
    var redirect = "<?php if($type=='taobao') echo "https://s.taobao.com/search?q="; elseif ($type=="1688") echo "https://s.1688.com/selloffer/offer_search.htm?keywords=";elseif ($type=="tmall")echo "https://list.tmall.com/search_product.htm?q="?>";
    $(document).ready(function () {

        $.ajax({
            url:"https://translate.yandex.net/api/v1.5/tr.json/translate",
            type:"GET",
            dataType: "json",
            data:{
                key:"trnsl.1.1.20191118T200416Z.62afd3665b4ab5f7.1e0bb3430d70fbc30d933cacfba5a6fc4f646fd9",
                text:"<?=$keyword?>",
                lang:"vi-zh",
            },
            success:function (data) {
                <?php if($type=="taobao"):?>

                window.location.href=redirect+data.text[0];
                <?php else:?>
                $.ajax({
                    url:"<?=Yii::$app->urlManager->createUrl(['site/encode'])?>",
                    type:"POST",

                    data:{
                        key:data.text[0]
                    },
                    success:function (datas) {
                        console.log(datas);
                        window.location.href=redirect+datas;
                    }
                })
                <?php endif;?>
            }
        })
    })
</script>

