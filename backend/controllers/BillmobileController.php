<?php

namespace backend\controllers;

use common\models\Excalibur;
use common\models\Lichsutaikhoan;
use common\models\User;
use Yii;
use common\models\Billmobile;
use common\models\search\BillmobileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * BillmobileController implements the CRUD actions for Billmobile model.
 */
class BillmobileController extends Controller
{
    /**
     * @inheritdoc
     */


    /**
     * Lists all Billmobile models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new BillmobileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Billmobile model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Billmobile #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }
    public function actionUpdatestatus(){
        if(!isset($_POST['id']) || !isset($_POST['type'])){
            return 1;
        }else{
            if((int)$_POST['type']==1){
                $bill = Billmobile::findOne(['id'=>$_POST['id']]);
                $currentuser = User::findOne(['id'=>$bill->chuyendanhba]);
                if(!is_null($currentuser) && (empty($currentuser->vat_document)||is_null($currentuser->vat_document))&& !is_null($currentuser->supplier_invoice) && !empty($currentuser->supplier_invoice)){

                    $user = User::findOne(['phone'=>$currentuser->supplier_invoice]);
                    iF(!is_null($user)){
                        User::updateAll(['vat_document'=>"done"],["id"=>$currentuser->id]);
                        $vi = Excalibur::findOne(['userid'=>$user->id]);
                        if(!is_null($vi)){
                            $vi->amount= $vi->amount+12000;
                            if($vi->update()){
                                $lichsu=new Lichsutaikhoan();
                                $lichsu->amount=12000;
                                $lichsu->userid=$user->id;
                                $lichsu->noidung="Trao thưởng giới thiệu người dùng ".$currentuser->firstname;
                                $lichsu->save();
                            }
                        }else{
                            $newvi = new Excalibur();
                            $newvi->userid=$user->id;
                            $newvi->amount=12000;
                            if($newvi->save()){
                                $lichsu=new Lichsutaikhoan();
                                $lichsu->amount=12000;
                                $lichsu->userid=$user->id;
                                $lichsu->noidung="Trao thưởng giới thiệu người dùng ".$currentuser->firstname;
                                $lichsu->save();
                            }
                        }
                    }
                }
            }
                return Billmobile::updateAll(['status'=>$_POST['type']],['id'=>$_POST['id']]);
        }
    }
    /**
     * Creates a new Billmobile model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Billmobile();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new Billmobile",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new Billmobile",
                    'content'=>'<span class="text-success">Create Billmobile success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new Billmobile",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
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
     * Updates an existing Billmobile model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionUpdate($id)
//    {
//        $request = Yii::$app->request;
//        $model = $this->findModel($id);
//
//        if($request->isAjax){
//            /*
//            *   Process for ajax request
//            */
//            Yii::$app->response->format = Response::FORMAT_JSON;
//            if($request->isGet){
//                return [
//                    'title'=> "Update Billmobile #".$id,
//                    'content'=>$this->renderAjax('update', [
//                        'model' => $model,
//                    ]),
//                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
//                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
//                ];
//            }else if($model->load($request->post()) && $model->save()){
//                return [
//                    'forceReload'=>'#crud-datatable-pjax',
//                    'title'=> "Billmobile #".$id,
//                    'content'=>$this->renderAjax('view', [
//                        'model' => $model,
//                    ]),
//                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
//                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
//                ];
//            }else{
//                 return [
//                    'title'=> "Update Billmobile #".$id,
//                    'content'=>$this->renderAjax('update', [
//                        'model' => $model,
//                    ]),
//                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
//                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
//                ];
//            }
//        }else{
//            /*
//            *   Process for non-ajax request
//            */
//            if ($model->load($request->post()) && $model->save()) {
//                return $this->redirect(['view', 'id' => $model->id]);
//            } else {
//                return $this->render('update', [
//                    'model' => $model,
//                ]);
//            }
//        }
//    }

    /**
     * Delete an existing Billmobile model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */


     /**
     * Delete multiple existing Billmobile model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */


    /**
     * Finds the Billmobile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Billmobile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Billmobile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
