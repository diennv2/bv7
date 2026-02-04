<?php

namespace backend\controllers;

use Yii;
use common\models\Catnew;
use common\models\search\CatnewSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * CatnewController implements the CRUD actions for Catnew model.
 */
class CatnewController extends Controller
{
    /**
     * @inheritdoc
     */



    /**
     * Lists all Catnew models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new CatnewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Catnew model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Catnew #".$id,
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

    /**
     * Creates a new Catnew model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Catnew();  

        if($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Tạo mới chuyên mục",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else {

                if ($model->load($request->post()) && $model->save()) {
                    Catnew::updateAll(['url'=>\func::taoduongdan($model->name)],'id=:id',[':id'=>$model->id]);
                    if (is_null($model->parent) || $model->parent=='')
                        Catnew::updateAll(['parent'=>-1],'id=:id',[':id'=>$model->id]);
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Tạo mới chuyên mục",
                    'content' => '<span class="text-success">Create Catnew success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                ];
            } else {
                return [
                    'title' => "Tạo mới chuyên mục",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                if (is_null($model->parent) || $model->parent=='')
                    Catnew::updateAll(['parent'=>-1],'id=:id',[':id'=>$model->id]);
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing Catnew model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Cập nhật Chuyên mục #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else{

                if($model->load($request->post()) && $model->save()){
                    Catnew::updateAll(['url'=>\func::taoduongdan($model->name)],'id=:id',[':id'=>$model->id]);
                    if (is_null($model->parent) || $model->parent=='')
                        Catnew::updateAll(['parent'=>-1],'id=:id',[':id'=>$model->id]);
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Chuyên mục #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Cập nhật Chuyên mục #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }}
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                Catnew::updateAll(['url'=>\func::taoduongdan($model->name)],'id=:id',[':id'=>$model->id]);
                if (is_null($model->parent) || $model->parent=='')
                    Catnew::updateAll(['parent'=>'-1'],'id=:id',[':id'=>$model->id]);
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Catnew model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing Catnew model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            if($model->id!=3 && $model->id!=4)
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the Catnew model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Catnew the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Catnew::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionUpdatehome()
    {
        $catnew = Catnew::find()->where(['id'=>$_POST['id']])->one();
        Catnew::updateAll(['home'=>(1-$catnew->home)],['id'=>$catnew->id]);
    }
    public function actionUpdateactive()
    {
        $catnew = Catnew::find()->where(['id'=>$_POST['id']])->one();
        Catnew::updateAll(['active'=>(1-$catnew->active)],['id'=>$catnew->id]);
    }
    public function actionUpdateparent()
    {
        $catnew = Catnew::find()->where(['id'=>$_POST['id']])->one();
        Catnew::updateAll(['parent'=>$_POST['value']],['id'=>$catnew->id]);
    }
    public function actionUpdateposition()
    {
        $catnew = Catnew::find()->where(['id'=>$_POST['id']])->one();
        Catnew::updateAll(['position'=>$_POST['value']],['id'=>$catnew->id]);
    }
    public function actionUpdateord()
    {
        $catnew = Catnew::find()->where(['id'=>$_POST['id']])->one();
        Catnew::updateAll(['ord'=>$_POST['value']],['id'=>$catnew->id]);
    }
}
