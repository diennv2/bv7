<?php

namespace backend\controllers;

use Yii;
use common\models\Slides;
use common\models\search\SlidesSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * SlidesController implements the CRUD actions for Slides model.
 */
class SlidesController extends Controller
{
    /**
     * @inheritdoc
     */


    /**
     * Lists all Slides models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new SlidesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort =  [
            'defaultOrder' => [
                'position' => SORT_ASC,
                'id' => SORT_DESC,
            ]];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Slides model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Slides #".$id,
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
     * Creates a new Slides model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Slides();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tạo mới Slides",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())){
                $file = UploadedFile::getInstance($model,'image');
                if(!is_null($file))
                {
                    $model->image = '/images/slides/'.\func::taoduongdan(time() ."-" .$file->name);
                }


                if ($model->save()){

                    // upload anh
                    if (!is_null($file)) {

                        $path = dirname(dirname(__DIR__)) .$model->image;
                        $file->saveAs($path);
                        $exploded = explode('.',$path);
                        $ext = $exploded[count($exploded) - 1];
                        if(!preg_match('/jpg|jpeg/i',$ext)){
                            if(\func::convertImage($path,$path.".jpg",100)==1){
                                $model->image=$model->image.".jpg";
                                $model->save();
                                unlink($path);
                            }
                        }

                    }

                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => "Tạo mới Slide",
                        'content' => '<span class="text-success">Create Slide success</span>',
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                    ];
                }
            }else{           
                return [
                    'title'=> "Tạo mới Slides",
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
     * Updates an existing Slides model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $oldfile = $model->image;
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Cập nhập Slides #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post())){
                $file = UploadedFile::getInstance($model,'image');

                if(!is_null($file))
                {
                    $model->image = '/images/slides/'.\func::taoduongdan(time() ."-" .$file->name);
                }
                else
                    $model->image=$oldfile;

                if ($model->save()){

                    // upload anh
                    if (!is_null($file)) {

                        $path = dirname(dirname(__DIR__)) .$model->image;
                        $file->saveAs($path);
                        $exploded = explode('.',$path);
                        $ext = $exploded[count($exploded) - 1];
                        if(!preg_match('/jpg|jpeg/i',$ext)){
                            if(\func::convertImage($path,$path.".jpg",100)==1){
                                $model->image=$model->image.".jpg";
                                $model->save();
                                unlink($path);
                            }
                        }
                        $oldpath = dirname(dirname(__DIR__)) .$oldfile;
                        if (is_file($oldpath))
                            unlink($oldpath);
                    }
                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => "Slide #" . $id,
                        'content' => $this->renderAjax('view', [
                            'model' => $model,
                        ]),
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                    ];
                }
            }else{
                 return [
                    'title'=> "Cập nhập Slides #".$id,
                    'content'=>$this->renderAjax('update', [
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
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Slides model.
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
     * Delete multiple existing Slides model.
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
     * Finds the Slides model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Slides the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Slides::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionUpdateactive()
    {
        $data = Slides::find()->where(['id'=>$_POST['id']])->one();
        Slides::updateAll(['active'=>(1-$data->active)],['id'=>$data->id]);
    }
    public function actionUpdateord()
    {
        $data = Slides::find()->where(['id'=>$_POST['id']])->one();
        Slides::updateAll(['ord'=>$_POST['value']],['id'=>$data->id]);
    }
    public function actionUpdateposition()
    {
        $data = Slides::find()->where(['id'=>$_POST['id']])->one();
        Slides::updateAll(['position'=>$_POST['value']],['id'=>$data->id]);
    }
}
