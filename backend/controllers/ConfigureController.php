<?php

namespace backend\controllers;

use common\models\Catproduct;
use common\models\Detailproperties;
use Yii;
use common\models\Configure;
use common\models\search\Configure as ConfigureSearch;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * ConfigureController implements the CRUD actions for Configure model.
 */
class ConfigureController extends Controller
{
    /**
     * @inheritdoc
     */

    /**
     * Lists all Configure models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionImageconfig(){
        return $this->render('image');
    }
    public function actionThemeconstructor(){
        $data = Configure::find()->where(["nhom"=>'giaodien'])->orderBy('CAST(label AS UNSIGNED) asc')->all();
        return $this->render('theme', [
            'data' => $data,
        ]);
    }
    public function actionLuuconfig(){
        $file = UploadedFile::getInstanceByName('icon');
        $config= Configure::getConfig();
        if(!is_null($file)){
            if($config['favicon']!="" && is_file(Yii::getAlias('@root').$config['favicon']))
                unlink(Yii::getAlias('@root').$config['favicon']);
            $filename= "/images/favicon/".$file->name;
            $path = Yii::getAlias('@root').$filename;
            $file->saveAs($path);
            Configure::updateAll(['value'=>$filename],['name'=>'favicon']);
        }

        $file = UploadedFile::getInstanceByName('logo');
        if(!is_null($file)){
            if($config['contact_logo']!="" && is_file(Yii::getAlias('@root').$config['contact_logo']))
                unlink(Yii::getAlias('@root').$config['contact_logo']);
            $filename= "/images/logo/".$file->name;
            $path = Yii::getAlias('@root').$filename;
            $file->saveAs($path);
            Configure::updateAll(['value'=>$filename],['name'=>'contact_logo']);
        }

        $file = UploadedFile::getInstanceByName('logofooter');
        if(!is_null($file)){
            if($config['contact_logo_footer']!="" && is_file(Yii::getAlias('@root').$config['contact_logo_footer']))
                unlink(Yii::getAlias('@root').$config['contact_logo_footer']);
            $filename= "/images/logo/".$file->name;
            $path = Yii::getAlias('@root').$filename;
            $file->saveAs($path);
            Configure::updateAll(['value'=>$filename],['name'=>'contact_logo_footer']);
        }

        $file = UploadedFile::getInstanceByName('sloganheader');
        if(!is_null($file)){
            if($config['contact_slogan_header']!="" && is_file(Yii::getAlias('@root').$config['contact_slogan_header']))
                unlink(Yii::getAlias('@root').$config['contact_slogan_header']);
            $filename= "/images/logo/".$file->name;
            $path = Yii::getAlias('@root').$filename;
            $file->saveAs($path);
            Configure::updateAll(['value'=>$filename],['name'=>'contact_slogan_header']);
        }

        $file = UploadedFile::getInstanceByName('sloganheadermobile');
        if(!is_null($file)){
            if($config['contact_slogan_header_mobile']!="" && is_file(Yii::getAlias('@root').$config['contact_slogan_header_mobile']))
                unlink(Yii::getAlias('@root').$config['contact_slogan_header_mobile']);
            $filename= "/images/logo/".$file->name;
            $path = Yii::getAlias('@root').$filename;
            $file->saveAs($path);
            Configure::updateAll(['value'=>$filename],['name'=>'contact_slogan_header_mobile']);
        }

        $file = UploadedFile::getInstanceByName('adnew');
        if(!is_null($file)){
            if($config['ad_news']!="" && is_file(Yii::getAlias('@root').$config['ad_news']))
                unlink(Yii::getAlias('@root').$config['ad_news']);
            $filename= "/images/advertisment/".$file->name;
            $path = Yii::getAlias('@root').$filename;
            $file->saveAs($path);
            Configure::updateAll(['value'=>$filename],['name'=>'ad_news']);
        }
        $file = UploadedFile::getInstanceByName('index_topbar');
        if(!is_null($file)){
            if($config['index_topbar']!="" && is_file(Yii::getAlias('@root').$config['index_topbar']))
                unlink(Yii::getAlias('@root').$config['index_topbar']);
            $filename= "/images/homepage/".$file->name;
            $path = Yii::getAlias('@root').$filename;
            $file->saveAs($path);
            Configure::updateAll(['value'=>$filename],['name'=>'index_topbar']);
        }

        $file = UploadedFile::getInstanceByName('page_banner');
        if(!is_null($file)){
            if($config['page_banner']!="" && is_file(Yii::getAlias('@root').$config['page_banner']))
                unlink(Yii::getAlias('@root').$config['page_banner']);
            $filename= "/images/advertisment/".$file->name;
            $path = Yii::getAlias('@root').$filename;
            $file->saveAs($path);
            Configure::updateAll(['value'=>$filename],['name'=>'page_banner']);
        }
        
        foreach ($_POST['config'] as $index=> $value){
            Configure::updateAll(['value'=>trim($value)],'name=:name',[':name'=>$index]);
        }
        return 1;
    }
    /**
     * Displays a single Configure model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Configure #".$id,
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
     * Creates a new Configure model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionGettype($type){
        return $this->renderPartial("type".$type);
    }
    public function actionUpdateimage(){
       if(!isset($_POST['id'])){
           return  $this->redirect(['configure/themeconstructor']);
       }
        $file = UploadedFile::getInstanceByName('fileupload');
        if(is_null($file)){
            return  $this->redirect(['configure/themeconstructor']);
        }
        $configure = Configure::findOne(['id'=>$_POST['id']]);
        if(is_null($configure)){
            return  $this->redirect(['configure/themeconstructor']);
        }
        $noidung = json_decode($configure->value);
        $filenames= '/images/configure/'.\func::taoduongdan(time() ."-" .$file->name);
        $path = dirname(dirname(__DIR__)) .$filenames;
        $file->saveAs($path);
        $noidung->background =$filenames;
        $configure->value=json_encode($noidung);
        $configure->save();
        return $this->redirect(['configure/themeconstructor']);
    }
    public function actionUpdateimagebackgroundnoibat(){

       if(!isset($_POST['id'])){
           return  $this->redirect(['configure/themeconstructor']);
       }
        $file = UploadedFile::getInstanceByName('fileuploadbackgroundnoibat');
        if(is_null($file)){
            return  $this->redirect(['configure/themeconstructor']);
        }
        $configure = Configure::findOne(['id'=>$_POST['id']]);
        if(is_null($configure)){
            return  $this->redirect(['configure/themeconstructor']);
        }
        $noidung = json_decode($configure->value);
        $filenames= '/images/configure/'.\func::taoduongdan(time() ."-" .$file->name);
        $path = dirname(dirname(__DIR__)) .$filenames;
        $file->saveAs($path);
        $noidung->backgroundnoibat =$filenames;
        $configure->value=json_encode($noidung);
        $configure->save();
        return  $this->redirect(['configure/themeconstructor']);
    }
    public function actionCreate()
    {
        $data = Configure::find()->where(["nhom"=>'giaodien'])->orderBy('CAST(label AS UNSIGNED) desc')->all();
        $request = Yii::$app->request;
        $model = new Configure();  
        $model->nhom="giaodien";
        if(empty($data)){
            $model->label="1";
        }else{
            $model->label=(string)((int)($data[0]->label+1));
        }
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tạo mới Configure",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) &&($model->name=$model->name."_".time()) && $model->save()){

                if(isset($_POST['listsanpham'])){
                    $file = UploadedFile::getInstanceByName('fileupload');
                    if(!is_null($file)){
                        $filenames= '/images/configure/'.\func::taoduongdan(time() ."-" .$file->name);
                        $path = dirname(dirname(__DIR__)) .$filenames;
                        $file->saveAs($path);
                        $_POST['listsanpham']['background'] =$filenames;
                    }

                    $file2 = UploadedFile::getInstanceByName('fileuploadbackgroundnoibat');
                    if(!is_null($file2)){
                        $filenames= '/images/configure/'.\func::taoduongdan(time() ."-" .$file2->name);
                        $path = dirname(dirname(__DIR__)) .$filenames;
                        $file2->saveAs($path);
                        $_POST['listsanpham']['backgroundnoibat'] =$filenames;
                    }
                    $_POST['listsanpham']['mauvien']="";
                    $_POST['listsanpham']['dodayvien']=0;
                    $model->value=Json::encode($_POST['listsanpham']);


                }
                $model->update();
                return [
                    'forceReload'=>'.catproduct-index',
                    'title'=> "Tạo mới Configure",
                    'content'=>'<span class="text-success">Create Configure success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Tạo mới Configure",
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
     * Updates an existing Configure model.
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
                    'title'=> "Update Configure #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Configure #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update Configure #".$id,
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
     * Delete an existing Configure model.
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
     * Delete multiple existing Configure model.
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
     * Finds the Configure model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Configure the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Configure::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionUpdateelement(){

    }

    public function actionUpdatethemeconfigure(){
        $configure = Configure::find()->where(['id'=>$_POST['pk']])->one();
        if(!is_null($configure))
        {
            $dulieu = Json::decode($configure->value);
            $dulieu[$_POST['name']]=$_POST['value'];
            $configure->value=Json::encode($dulieu);
            $configure->update();
        }else{
            throw new \yii\web\NotFoundHttpException("Có lỗi xảy ra");
        }
    }

    public function actionUpdateposition(){
        $configure = Configure::find()->where(['id'=>$_POST['id']])->one();
        if(!is_null($configure))
        {
            $dulieu = Json::decode($configure->value);
            $dulieusanpham = $dulieu['danhmucsanphamtudinhnghia'];
            $type= $_POST['type'];
            foreach ($dulieusanpham as $index=> $value){
                if($value==$_POST['item']){
                    if($type=='delete'){
                        unset($dulieusanpham[$index]);
                    }else if($type=='up'){
                        $temp = $dulieusanpham[$index];
                        $dulieusanpham[$index]=  $dulieusanpham[$index-1];
                        $dulieusanpham[$index-1]=$temp;

                    }else if($type=='down'){
                        $temp = $dulieusanpham[$index];
                        $dulieusanpham[$index]=  $dulieusanpham[$index+1];
                        $dulieusanpham[$index+1]=$temp;
                    }
                    $dulieu['danhmucsanphamtudinhnghia']=$dulieusanpham;
                    $configure->value = Json::encode($dulieu);
                    $configure->update();
                    break;
                }
            }




            $configure->value=Json::encode($dulieu);
            $configure->update();
        }else{
            throw new \yii\web\NotFoundHttpException("Có lỗi xảy ra");
        }
    }
    public function actionAdditem(){
        $configure = Configure::find()->where(['id'=>$_POST['id']])->one();
        if(!is_null($configure))
        {
            $dulieu = Json::decode($configure->value);
            $dulieu['danhmucsanphamtudinhnghia'][]=$_POST['item'];
            $configure->value=Json::encode($dulieu);
            $configure->update();
        }else{
            throw new \yii\web\NotFoundHttpException("Có lỗi xảy ra");
        }
    }
    public function actionChangecatproduct(){
        $configure = Configure::find()->where(['id'=>$_POST['id']])->one();
        if(!is_null($configure))
        {
            $dulieu = Json::decode($configure->value);
            $dulieu['danhmucsanpham']=$_POST['item'];
            $configure->value=Json::encode($dulieu);
            $configure->update();
        }else{
            throw new \yii\web\NotFoundHttpException("Có lỗi xảy ra");
        }
    }
    public function actionUpdateorder(){

        $configure = Configure::find()->where(['id'=>$_POST['id']])->one();

        if ($_POST['type']=='delete'){
            $configure->delete();
        }
        else{
            $configure2 = Configure::find()->where(['id'=>$_POST['swap']])->one();
            if(!is_null($configure) &&!is_null($configure2))
            {
                $label = $configure->label;
                $configure->label=$configure2->label;
                $configure2->label=$label;
                $configure2->update();
                $configure->update();
            }else{
                throw new \yii\web\NotFoundHttpException("Có lỗi xảy ra");
            }
        }
    }
    public function actionDeleteimage(){

        $configure = Configure::find()->where(['id'=>$_POST['id']])->one();
        $value = Json::decode($configure->value);
        $value['background']="";
        $configure->value=Json::encode($value);
        $configure->save();
        return 1;

    }
    public function actionDeleteimagebackgroundnoibat(){
        $configure = Configure::find()->where(['id'=>$_POST['id']])->one();
        $value = Json::decode($configure->value);
        $value['backgroundnoibat']="";
        $configure->value=Json::encode($value);
        $configure->save();
        return 1;
    }
}
