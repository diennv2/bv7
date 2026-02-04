<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = ['name'=>$this->title,'link'=>'javascript:void(0)'];

CrudAsset::register($this);

?>
<?php var_dump($noidung) ?>

<button onclick="saveContents()">Run</button>

<script type="text/javascript">
    $.ajaxPrefilter( function (options) {
        if (options.crossDomain && jQuery.support.cors) {
            var http = (window.location.protocol === 'http:' ? 'http:' : 'https:');
            options.url = http + '//cors-anywhere.herokuapp.com/' + options.url;
            //options.url = "http://cors.corsproxy.io/url=" + options.url;
        }
    });
//
//    $.get('https://www.babybrandsdirect.co.uk/tommee-tippee-closer-to-nature-night-time-soother-6-18m-2pk-wholesaler', function (data) {
//        description = $(data).xpath('//*[@id="tab-typ1"]/div/div[1]/div/div[2]').html();
//        brief = $(data).xpath('//*[@id="tab-typ1"]/div/div[1]/div/div[2]/p[1]').html()+$(data).xpath('//*[@id="tab-typ1"]/div/div[1]/div/div[2]/p[2]').html();
//        // data contains your html
//    });

    var contents = <?= json_encode($noidung) ?>;

    function getCont(cont) {
        var des = [];
        var bri = [];
        var chiso = [];
        for(var key in cont){
            chiso.push(key)
            $.get(cont[key], function (data) {
                description = $(data).xpath('//*[@id="tab-typ1"]/div/div[1]/div/div[2]').html();
                brief = $(data).xpath('//*[@id="tab-typ1"]/div/div[1]/div/div[2]/p[1]').html()+$(data).xpath('//*[@id="tab-typ1"]/div/div[1]/div/div[2]/p[2]').html();
                des.push(description);
                bri.push(brief);
            });
        }
        var ketqua = {};
        ketqua['0'] = chiso;
        ketqua['1'] = bri;
        ketqua['2'] = des;

        return ketqua;
    }

    var kq = getCont(contents);
    console.log(kq)
    function saveContents() {
        $.ajax({

            // The URL for the request
            url: "<?=Yii::$app->urlManager->createUrl(['product/contents'])?>",

            // The data to send (will be converted to a query string)
            data: {
                dulieu:kq
            },

            // Whether this is a POST or GET request
            type: "POST",

            dataType : "json",

            success: function (data) {
                alert(data)
            }

        })
    }
</script>
