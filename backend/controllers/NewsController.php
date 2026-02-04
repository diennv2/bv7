<?php

namespace backend\controllers;

use common\models\Billmobile;
use Faker\Provider\DateTime;
use Yii;
use common\models\News;
use common\models\search\NewsSearch;
use yii\base\BaseObject;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    /**
     * @inheritdoc
     */


    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   

    }

    /**
     * Creates a new News model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new News();
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tạo mới News",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button
                ('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tạo mới News",
                    'content'=>'<span class="text-success">Create News success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Tạo mới News",
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
     * Updates an existing News model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($_GET['id']);
        if(strtolower(Yii::$app->user->identity->username)!='superadmin' && $model->lang_id!=Yii::$app->user->identity->id) {
            return $this->redirect(['news/index']);
        }
        return $this->render('update',['model'=>$model]);
    }

    /**
     * Delete an existing News model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $t = $this->findModel($id);
        if(strtolower(Yii::$app->user->identity->username)!='superadmin' && $t->lang_id!=Yii::$app->user->identity->id){
            return $this->redirect(['news/index']);
        }
        $t->delete();
        try{
            if(is_file(Yii::getAlias('@root')).$t->image)
                unlink(Yii::getAlias('@root').$t->image);
        }catch (\Exception $exception){

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
     * Delete multiple existing News model.
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
            if(is_file(Yii::getAlias('@root').$model->image))
                unlink(Yii::getAlias('@root').$model->image);
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
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionNewpost()
    {
        return $this->render('newpost');
    }
    public function actionUpdatehome()
    {
        $News = News::find()->where(['id'=>$_POST['id']])->one();
        if(strtolower(Yii::$app->user->identity->username)!='superadmin' && $News->lang_id!=Yii::$app->user->identity->id){
            return $this->redirect(['news/index']);
        }
        News::updateAll(['home'=>(1-$News->home)],['id'=>$News->id]);
    }
    public function actionUpdateactive()
    {
        $News = News::find()->where(['id'=>$_POST['id']])->one();
        if(strtolower(Yii::$app->user->identity->username)!='superadmin' && $News->lang_id!=Yii::$app->user->identity->id){
            return $this->redirect(['news/index']);
        }
        News::updateAll(['active'=>(1-$News->active)],['id'=>$News->id]);
    }

    public function actionUpdatehot()
    {
        $News = News::find()->where(['id'=>$_POST['id']])->one();
        if(strtolower(Yii::$app->user->identity->username)!='superadmin' && $News->lang_id!=Yii::$app->user->identity->id){
            return $this->redirect(['news/index']);
        }
        News::updateAll(['hot'=>$_POST['value']],['id'=>$News->id]);
    }
    public function actionUpdateforeign(){
        $News = News::find()->where(['id'=>$_POST['id']])->one();
        if(strtolower(Yii::$app->user->identity->username)!='superadmin' && $News->lang_id!=Yii::$app->user->identity->id){
            return $this->redirect(['news/index']);
        }
        News::updateAll([$_POST['foreign']=>$_POST['value']],['id'=>$News->id]);
    }
    public function actionNews_post(){
        $file = UploadedFile::getInstanceByName('fileupload');
        if (is_null($file)){
            $now = new \DateTime();
            $new = new News();
            $new->pheduyet = -1;
            $new->load(Yii::$app->request->post());
            $new->url=\func::taoduongdan($new->title);
            $now = getdate();
            $new->posted_date=  $now["mday"] . "/" . $now["mon"] . "/" . $now["year"];
            if($new->seo_title=='' || is_null($new->seo_title))
                $new->seo_title=$new->title;
            if($new->seo_desc=='' || is_null($new->seo_desc))
                $new->seo_desc=strip_tags(nl2br(substr(strip_tags(($new->content)), 0, 156)));
            if($new->save())
                return $this->redirect(Yii::$app->urlManager->createUrl(['news','']));
            else
                var_dump($new->errors);
        } else {
            $now = new \DateTime();
            $filename= "/images/news/".$now->getTimestamp().$file->name;
            $path = Yii::getAlias('@root').$filename;
            $file->saveAs($path);
            $new = new News();
            $new->pheduyet = -1;
            $new->load(Yii::$app->request->post());
            $new->image=$filename;
            $exploded = explode('.', $path);
            $ext = $exploded[count($exploded) - 1];
            if (!preg_match('/jpg|jpeg/i', $ext)) {

                if (\func::convertImage($path, $path . ".jpg", 100) == 1) {
                    $new->image = $new->image . ".jpg";
                    $new->save();
                    unlink($path);
                }
            }
            $new->url=\func::taoduongdan($new->title);
            $now = getdate();
            $new->posted_date=  $now["mday"] . "/" . $now["mon"] . "/" . $now["year"];
            if($new->seo_title=='' || is_null($new->seo_title))
                $new->seo_title=$new->title;
            if($new->seo_desc=='' || is_null($new->seo_desc))
                $new->seo_desc=strip_tags(nl2br(substr(strip_tags(($new->content)), 0, 156)));
            if($new->save())
                return $this->redirect(Yii::$app->urlManager->createUrl(['news','']));
            else
                var_dump($new->errors);
        }
    }
    public function actionUpdatenews(){
        if(strtolower(Yii::$app->user->identity->username)!='superadmin' && News::findOne(['id'=>$_POST['id']])->lang_id!=Yii::$app->user->identity->id){
            return $this->redirect(['news/index']);
        }
        $file = UploadedFile::getInstanceByName('fileupload');
        if(!is_null($file)){
            if(is_file(Yii::getAlias('@root').News::find()->where(['id'=>$_POST['id']])->one()->image))
            unlink(Yii::getAlias('@root').News::find()->where(['id'=>$_POST['id']])->one()->image);
        $now = new \DateTime();
        $filename= "/images/news/".$now->getTimestamp().$file->name;
        $path = Yii::getAlias('@root').$filename;
        $file->saveAs($path);
            News::updateAll(['image'=>$filename],['id'=>$_POST['id']]);
            $exploded = explode('.', $path);
            $ext = $exploded[count($exploded) - 1];
            if (!preg_match('/jpg|jpeg/i', $ext)) {
                if (\func::convertImage($path, $path . ".jpg", 100) == 1) {
                    News::updateAll(['image'=>$filename.".jpg"],['id'=>$_POST['id']]);
                    unlink($path);
                }
            }
        }
        News::updateAll($_POST['News'],['id'=>$_POST['id']]);
        if(isset($_POST['News']['posted_date'])){
            unset($_POST['News']['posted_date']);
        }
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
        News::updateAll(['url'=>\func::taoduongdan($_POST['News']['title'])],['id'=>$_POST['id']]);
        if($_POST['News']['seo_title']=='' || is_null($_POST['News']['seo_title']))
            News::updateAll(['seo_title'=>$_POST['News']['title']],['id'=>$_POST['id']]);
        if($_POST['News']['seo_desc']=='' || is_null($_POST['News']['seo_desc']))
            News::updateAll(['seo_desc'=>strip_tags(nl2br(substr(strip_tags(($_POST['News']['content'])), 0, 156)))],['id'=>$_POST['id']]);
        return $this->redirect(Yii::$app->urlManager->createUrl(['news']));
    }
    public function actionUpdatepheduyet(){
        if(!isset($_POST['id']) || !isset($_POST['type'])){
            return 1;
        }else{
            return News::updateAll(['pheduyet'=>$_POST['type']],['id'=>$_POST['id']]);
        }
    }
}
