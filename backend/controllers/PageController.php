<?php

namespace backend\controllers;

use Yii;
use common\models\Page;
use common\models\search\PageSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;


/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends Controller
{
    /**
     * @inheritdoc
     */


    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Page model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Trang #".$id,
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
     * Creates a new Page model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Page();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tạo mới Trang",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){

                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tạo mới Trang",
                    'content'=>'<span class="text-success">Create Page success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Tạo mới Trang",
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
                $file = UploadedFile::getInstanceByName('image');
                var_dump($file);
                exit();
                if(!is_null($file))
                {
                    $model->image = '/images/menu/'.\func::taoduongdan(time() ."-" .$file->name);
                    $path = dirname(dirname(__DIR__)) .$model->image;
                    $file->saveAs($path);

                    $model->save();

                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing Page model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $image = $model->image;
        if($request->isAjax){

            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Cập nhật Trang #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Trang #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Cập nhật trang #".$id,
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
                if($model->image==""){
                    $model->image=$image;
                    $model->save();
                }
                $file = UploadedFile::getInstanceByName('image');

                if(!is_null($file))
                {
                    $model->image = '/file/lienhe/'.\func::taoduongdan(time() ."-" .$file->name);
                    $path = dirname(dirname(__DIR__)) .$model->image;
                    $file->saveAs($path);


                    $model->save();

                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Page model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model=$this->findModel($id);
        if(strtolower(Yii::$app->user->identity->username)!='superadmin' && $model->lang_id!=Yii::$app->user->identity->id){
            return $this->redirect(['news/index']);
        }
            $model->delete();

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
     * Delete multiple existing Page model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {
        if(strtolower(Yii::$app->user->identity->username)!='superadmin'){
            return $this->redirect(['news/index']);
        }
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
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionNewpage()
    {
        return $this->render('newpage');
    }

    public function actionNew_page(){
//        $file = UploadedFile::getInstanceByName('fileupload');
//        $now = new \DateTime();
//        $filename= "\\images\\news\\".$now->getTimestamp().$file->name;
//        $path = Yii::getAlias('@root').$filename;
//        $file->saveAs($path);
        $new = new Page();
        $new->load(Yii::$app->request->post());
        $new->url=\func::taoduongdan($new->title);
//        $now = getdate();
//        $new->posted_date=  $now["mday"] . "/" . $now["mon"] . "/" . $now["year"];
        if($new->seo_title=='' || is_null($new->seo_title))
            $new->seo_title=$new->title;
        if($new->seo_desc=='' || is_null($new->seo_desc))
            $new->seo_desc=strip_tags(nl2br(substr(strip_tags(($new->content)), 0, 156)));
        if($new->save())
            $this->redirect(Yii::$app->urlManager->createUrl(['page','']));
    }

    public function actionUpdateactive()
    {

        $model = Page::find()->where(['id'=>$_POST['id']])->one();
        if(strtolower(Yii::$app->user->identity->username)!='superadmin' && $model->lang_id!=Yii::$app->user->identity->id){
            return $this->redirect(['news/index']);
        }
        Page::updateAll(['active'=>(1-$model->active)],['id'=>$model->id]);
    }

    public function actionUpdateord()
    {
        $model = Page::find()->where(['id'=>$_POST['id']])->one();
        if(strtolower(Yii::$app->user->identity->username)!='superadmin' && $model->lang_id!=Yii::$app->user->identity->id){
            return $this->redirect(['news/index']);
        }
        Page::updateAll(['ord'=>$_POST['value']],['id'=>$model->id]);
    }
    public function actionNewform(){
        $model= new Page();
        $request = Yii::$app->request;

        if ($model->load($request->post()) && $model->save()){
            $file = UploadedFile::getInstanceByName('image');

            if(!is_null($file))
            {
                $model->image = '/images/menu/'.\func::taoduongdan(time() ."-" .$file->name);
                $path = dirname(dirname(__DIR__)) .$model->image;
                $file->saveAs($path);
                $model->save();

            }
            return $this->redirect(['index']);
        }
        return $this->render('newpage',['model'=>$model]);
    }
}
