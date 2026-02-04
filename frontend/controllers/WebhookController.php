<?php


namespace frontend\controllers;

use common\models\Coinexchange;
use common\models\Log;
use yii\helpers\Json;
use yii\rest\ActiveController;
use yii\web\Response;

class WebhookController extends ActiveController
{
    public function actionTopupwebhook(){

        $request = Yii::$app->request;
        Yii::$app->response->format = Response::FORMAT_JSON;

        return Yii::$app->getRequest();
        $log = new Log();
        $log->time=\func::getTimeNow();;
        $log->noidung="aaa";
        $log->user="Webhook";
        $log->loai="Webhook";
        $log->banghi=1;
        $log->save();

        return true;
        $success=$_POST['success'];
        $amount=$_POST['amount'];
        $message=$_POST['message'];
        $transaction_id=$_POST['transaction_id'];
        $giaodich = Coinexchange::findOne(['transaction_id'=>$transaction_id]);
        if(!is_null($giaodich) && $success=="true"){
            $giaodich->successtime=time();
            $giaodich->sotienthanhcong=$amount;
            $giaodich->mess=$giaodich->mess." ".$message;
            $giaodich->save();
        }
        return Json::encode($_POST);
    }
}