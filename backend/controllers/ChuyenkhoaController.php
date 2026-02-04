<?php

namespace backend\controllers;

use common\models\Page;
use Yii;
use common\models\Chuyenkhoa;
use common\models\search\ChuyenkhoaSearch;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * ChuyenkhoaController implements the CRUD actions for Chuyenkhoa model.
 */
class ChuyenkhoaController extends Controller
{
    /**
     * @inheritdoc
     */

    /**
     * Lists all Chuyenkhoa models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new ChuyenkhoaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Chuyenkhoa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Chuyên khoa #".$id,
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
     * Creates a new Chuyenkhoa model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Chuyenkhoa();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tạo mới chuyên khoa",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];
            }else if($model->load($request->post())){
                $model->url=\func::taoduongdan($model->title);
                $file = UploadedFile::getInstance($model, 'image');
                if (!is_null($file)) {
                    $model->image = '/images/comment/' .\func::taoduongdan(time() ."-" .$file->name);
                }
                if ($model->save()) {
                    if (!is_null($file)) {
                        $path = dirname(dirname(__DIR__)) .  $model->image;
                        $file->saveAs($path);
                    }
                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => "Tạo mới chuyên khoa",
                        'content' => '<span class="text-success">Create Comment success</span>',
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                    ];
                }else return [
                    'title'=> "Tạo mới chuyên khoa",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }else{
                return [
                    'title'=> "Tạo mới chuyên khoa",
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
     * Updates an existing Chuyenkhoa model.
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

        if ($model->load($request->post())) {
            $file = UploadedFile::getInstance($model,'image');
            if(!is_null($file))
            {

                $model->image =  '/images/menu/' .\func::taoduongdan(time() ."-" .$file->name);
            }
            else
                $model->image=$oldfile;

            if ($model->save()) {
                // upload anh
                if (!is_null($file)) {
                    $path = dirname(dirname(__DIR__)) . $model->image;
                    $file->saveAs($path);

                    $oldpath = dirname(dirname(__DIR__)) . $oldfile;
                    if (is_file($oldpath))
                        unlink($oldpath);
                }
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Delete an existing Chuyenkhoa model.
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
     * Delete multiple existing Chuyenkhoa model.
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
     * Finds the Chuyenkhoa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Chuyenkhoa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Chuyenkhoa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionUpdateactive()
    {

        $model = Chuyenkhoa::find()->where(['id'=>$_POST['id']])->one();
        if(strtolower(Yii::$app->user->identity->username)!='superadmin' && $model->lang_id!=Yii::$app->user->identity->id){
            return $this->redirect(['chuyenkhoa/index']);
        }
        Page::updateAll(['active'=>(1-$model->active)],['id'=>$model->id]);
    }

    public function actionUpdateord()
    {
        $model = Chuyenkhoa::find()->where(['id'=>$_POST['id']])->one();
        if(strtolower(Yii::$app->user->identity->username)!='superadmin' && $model->lang_id!=Yii::$app->user->identity->id){
            return $this->redirect(['chuyenkhoa/index']);
        }
        Page::updateAll(['ord'=>$_POST['value']],['id'=>$model->id]);
    }
    public function actionNewchuyenkhoa()
    {
        return $this->render('newchuyenkhoa');
    }
    public function actionChuyenkhoaform(){
        $model= new Chuyenkhoa();
        $request = Yii::$app->request;

        if ($model->load($request->post())){
            $file = UploadedFile::getInstance($model, 'image');

            $model->image = '/images/menu/' . \func::taoduongdan(time() . "-" . $file->name);

            if ($model->save()) {
                if (!is_null($file)) {
                    $path = dirname(dirname(__DIR__)) . $model->image;

                    $file->saveAs($path);
                }
            }
            $model->save();
            return $this->redirect(['index']);
        }
        return $this->render('newchuyenkhoa',['model'=>$model]);
    }
    public function actionUpdatechuyenkhoa(){
        if(strtolower(Yii::$app->user->identity->username)!='superadmin' && Chuyenkhoa::findOne(['id'=>$_POST['id']])->lang_id!=Yii::$app->user->identity->id){
            return $this->redirect(['chuyenkhoa/index']);
        }

        $file = UploadedFile::getInstanceByName('image');
        if(!is_null($file)){
            if(is_file(Yii::getAlias('@root').Chuyenkhoa::find()->where(['id'=>$_POST['id']])->one()->image))
                unlink(Yii::getAlias('@root').Chuyenkhoa::find()->where(['id'=>$_POST['id']])->one()->image);
            $now = new \DateTime();
            $filename= "/images/news/".$now->getTimestamp().$file->name;
            $path = Yii::getAlias('@root').$filename;
            $file->saveAs($path);
            Chuyenkhoa::updateAll(['image'=>$filename],['id'=>$_POST['id']]);
            $exploded = explode('.', $path);
            $ext = $exploded[count($exploded) - 1];
            if (!preg_match('/jpg|jpeg/i', $ext)) {
                if (\func::convertImage($path, $path . ".jpg", 100) == 1) {
                    Chuyenkhoa::updateAll(['image'=>$filename.".jpg"],['id'=>$_POST['id']]);
                    unlink($path);
                }
            }
        }
        Chuyenkhoa::updateAll($_POST['Chuyenkhoa'],['id'=>$_POST['id']]);
        if(Yii::$app->urlManager->baseUrl=="/admin"){
            $action = Yii::$app->controller->action->id;
            $controller = Yii::$app->controller->id;
            $log = new \common\models\Log();
            $log->time=\func::getTimeNow();
            $log->noidung=$controller."/".$action;
            $log->user=Yii::$app->user->identity->username;
            $log->loai="Tracking Active Record (Type Update)";
            $log->banghi=$_POST['id'];
            if($controller!="default")
                $log->save();
        }
        Chuyenkhoa::updateAll(['url'=>\func::taoduongdan($_POST['Chuyenkhoa']['title'])],['id'=>$_POST['id']]);
        return $this->redirect(Yii::$app->urlManager->createUrl(['chuyenkhoa']));
    }
}
