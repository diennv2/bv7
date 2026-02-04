<?php

namespace backend\controllers;

use common\models\Configure;
use common\models\Excalibur;
use common\models\Lichsutaikhoan;
use common\models\User;
use Yii;
use common\models\Coinexchange;
use common\models\search\CoinexchangeSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * CoinexchangeController implements the CRUD actions for Coinexchange model.
 */
class CoinexchangeController extends Controller
{
    /**
     * @inheritdoc
     */


    /**
     * Lists all Coinexchange models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CoinexchangeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Coinexchange model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Coinexchange #" . $id,
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Coinexchange model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Coinexchange();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new Coinexchange",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Create new Coinexchange",
                    'content' => '<span class="text-success">Create Coinexchange success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                ];
            } else {
                return [
                    'title' => "Create new Coinexchange",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

    }

    /**
     * Updates an existing Coinexchange model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update Coinexchange #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else {
                $transaction = Yii::$app->db->beginTransaction();
                if ($model->load($request->post()) && $model->save()) {
                    if ($model->status == 4) {
                        $result = $this->duyet($model);
                        if ($result['status']!=0) {
                            $transaction->rollBack();
                            return [
                                'forceReload' => '#crud-datatable-pjax',
                                'title' => "Đổi thưởng số #" . $id,
                                'content' => "<span class='text-danger'>".$result['message']."</span>",
                                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])
                            ];
                        }
//                        if (!$result->success) {
//                            $transaction->rollBack();
//                            return [
//                                'forceReload' => '#crud-datatable-pjax',
//                                'title' => "Đổi thưởng số #" . $id,
//                                'content' => "<span class='text-danger'>Thất bại: " . (is_string($result->message)) ? $result->message : $result->message[0][0] . "</span>",
//                                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])
//                            ];
//                        }
                        $model->mess = "Duyệt thành công! chờ kết quả";
                        $model->save();

                    } else if ($model->status == 3) {
                        $ex = Excalibur::findOne(['userid' => $model->userid]);
                        $ex->amount += $model->sodiem;
                        $ex->update();
                        $model->mess = "Đã hoàn lại " . $model->sodiem . "! " . $model->mess;
                        $model->update();
                        $lichsu = new Lichsutaikhoan();
                        $lichsu->amount = $model->sodiem;
                        $lichsu->userid = $model->userid;
                        $lichsu->noidung = "Hoàn trả điểm thưởng do đổi điểm lỗi giao dịch số #" . $model->transaction_id;
                        $lichsu->save();
                    } else if ($model->status == 2) {

                        $model->mess = "Không đủ điều kiện hoàn điểm ! " . $model->mess;
                        $model->update();
                    }
                    $transaction->commit();
                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => "Coinexchange #" . $id,
                        'content' => $this->renderAjax('view', [
                            'model' => $model,
                        ]),
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                    ];
                } else {
                    return [
                        'title' => "Update Coinexchange #" . $id,
                        'content' => $this->renderAjax('update', [
                            'model' => $model,
                        ]),
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                    ];
                }
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Coinexchange model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $t = $this->findModel($id);
        $t->status = 3;
        $t->save();
        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

    /**
     * Delete multiple existing Coinexchange model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $model->status = 3;
            $model->save();
        }

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }

    }

    /**
     * Finds the Coinexchange model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Coinexchange the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Coinexchange::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function duyet($topup)
    {
        $config = Configure::getConfig();
        /** @var Coinexchange $topup */

        $curl = curl_init();
        $type = "";
        if($topup->brand=="VTT"){
            iF($topup->type=="PRE_PAID"){
                $type="VTT_FAST";
            }else{
                $type="VTT_FAST2";
            }
        }else if($topup->brand=="VMS"){
            $type="Mobifone";
        }else{
            $type="VNP_FAST";
        }
        $api_key="f59a649b-fe50-4a0d-8dc4-e7d303761bbc";
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sb7acd751f005.banglangtim.club/api/rechargefast',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                "api_key" => $api_key,
                "callback" => "http://tulato.com.vn/topup-webhook.html",
                "telco" => $type,
                "phone" => $topup->phonenumber,
                "amount" => $topup->sodiem,
                "signature" => md5($api_key."DVT".$topup->phonenumber."DVT".$topup->sodiem."DVT"),
//                "card_option" => $topup->sodiem,
//                "priority_level" => 1,
//                "details" => urlencode($topup->phonenumber.",".$topup->sodiem)
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = \yii\helpers\Json::decode($response);

        if($data['status']==0){
            $topup->transaction_id=(string)$data['tran_id'];
            if(!$topup->save()){
                var_dump($topup->errors);
                exit;
            }

        }

        return $data;
    }


}
