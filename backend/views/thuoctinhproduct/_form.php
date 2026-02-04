<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Thuoctinhproduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="thuoctinhproduct-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $array = \yii\helpers\Json::decode($model->thuoctinh_id)?>
    <tr class="tr-data-container">
        <td style="padding: 5px" class="table-responsive">
            <table class="table table-striped">
                <tr><th>Tên thuộc tính</th><th>Giá trị</th></tr>
                <?php foreach (\common\models\Loaithuoctinh::find()->all() as $value):/** @var \common\models\Loaithuoctinh $value */?>
                    <tr>
                        <td><?=$value->tenloai?></td>
                        <?php
                            $valuetemp = "";
                            foreach ($array as $valuess){
                                $valuethuoctinhforselect = \app\models\Thuoctinh::findOne(['id'=>$valuess]);
                                if($valuethuoctinhforselect->loaithuoctinh_id==$value->id)
                                {
                                    $valuetemp=$valuess;
                                }
                            }
                            ?>
                        <td><?=\yii\helpers\Html::dropDownList('select[]',$valuetemp,\yii\helpers\ArrayHelper::map(\common\models\Thuoctinh::find()->where(['loaithuoctinh_id'=>$value->id])->all(),'id','tenthuoctinh'),['prompt'=>'Không chọn','class'=>'form-control thuoctinh'])?></td>
                        <?php
                        ?>

                    </tr>

                <?php endforeach;?>

            </table>
        </td>
    </tr>
    <script>
        $(".thuoctinh").select2();
    </script>
    <?= $form->field($model, 'giagoc')->textInput() ?>
    <?= $form->field($model, 'gia')->textInput() ?>


    <?= $form->field($model, 'conhang')->checkbox() ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>

</div>
