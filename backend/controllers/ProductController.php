<?php

namespace backend\controllers;

use common\models\Anhsanpham;
use common\models\Catproduct;
use common\models\Cauhoi;
use common\models\Log;
use common\models\Properties;
use common\models\Propertiesvalueproduct;
use common\models\Thuoctinhproduct;
use Yii;
use common\models\Product;
use common\models\search\ProductSearch;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
     */


    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort =  [
            'defaultOrder' => [
                'cat_product_id' => SORT_ASC,
                'ord' => SORT_ASC,
            ]];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Product #".$id,
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
     * Creates a new Product model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Product();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new Product",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new Product",
                    'content'=>'<span class="text-success">Create Product success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                ];
            }else{
                return [
                    'title'=> "Create new Product",
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
     * Updates an existing Product model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
//        if(strtolower(Yii::$app->user->identity->username)!='superadmin' && $model->lang_id!=Yii::$app->user->identity->id){
//            return $this->redirect(['news/index']);
//        }
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){

                return [
                    'title'=> "Update Product #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){

                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Product #".$id,
                    'content'=>$this->renderAjax('index', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update Product #".$id,
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
                return $this->redirect(Yii::$app->urlManager->createUrl('product'));
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Product model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model=$this->findModel($id);
//            if(strtolower(Yii::$app->user->identity->username)!='superadmin' && $model->lang_id!=Yii::$app->user->identity->id){
//                return $this->redirect(['news/index']);
//            }
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
     * Delete multiple existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionNewform(){
        $model= new Product();
        $request = Yii::$app->request;

        if ($model->load($request->post()) && $model->save()){
            Product::updateAll(['ord'=>$model->id],['id'=>$model->id]);
            return $this->redirect(['index']);
        }else{

        }
        return $this->render('newform',['model'=>$model]);
    }
    public function actionXoaanh()
    {
        if (isset($_POST['id'])){
            $hinhAnh = Anhsanpham::findOne($_POST['id']);
            $path = dirname(dirname(__DIR__)) . "/images/product/" . $hinhAnh->image;
            if (is_file($path))
                unlink($path);
            $hinhAnh->delete();
            return 1;
        }
    }
    public function actionDefaultimg(){
        if (isset($_POST['id'])){
            $anh = Anhsanpham::findOne($_POST['id']);
            $ansps = Anhsanpham::find()->where(['product_id'=>$anh->product_id])->all();
            foreach ($ansps as $ansp){
                Anhsanpham::updateAll(['default'=>0],'id=:id',[':id'=>$ansp->id]);
            }
            Anhsanpham::updateAll(['default'=>1],'id=:id',[':id'=>$anh->id]);
        }
    }
    public function actionUpdatehome()
    {
        $catproduct = Product::find()->where(['id'=>$_POST['id']])->one();
        Product::updateAll(['home'=>(1-$catproduct->home)],['id'=>$catproduct->id]);
    }
    public function actionUpdatehot()
    {
        $catproduct = Product::find()->where(['id'=>$_POST['id']])->one();
        Product::updateAll(['hot'=>(1-$catproduct->hot)],['id'=>$catproduct->id]);
    }

    public function actionUpdateactive()
    {
        $catproduct = Product::find()->where(['id'=>$_POST['id']])->one();
        Product::updateAll(['active'=>(1-$catproduct->active)],['id'=>$catproduct->id]);
    }
    public function actionUpdateord()
    {
        $catproduct = Product::find()->where(['id'=>$_POST['id']])->one();
        Product::updateAll(['ord'=>$_POST['value']],['id'=>$catproduct->id]);
    }
    public function actionUpdatenew()
    {
        $catproduct = Product::find()->where(['id'=>$_POST['id']])->one();
        Product::updateAll(['new'=>(1-$catproduct->new)],['id'=>$catproduct->id]);
    }

    public function actionAddnewrow(){
        $indexsanpham= $_POST['indexsanpham'];
        $giatri= $_POST['giatri'];
        $propertiesProducts  = new Propertiesvalueproduct();

        echo  Json::encode([
            'newRow'=>$this->renderAjax('_newrow',['indexsanpham'=>$indexsanpham,'propertiesProducts'=>$propertiesProducts,'giatri'=>$giatri,'types'=>$_POST['types']])
        ]);
    }

    public function actionBindproperties(){
        if (isset($_POST['idcatproduct'])){
            $properties = Properties::getThongso($_POST['idcatproduct']);
            echo Json::encode([
               'property'=>$this->renderAjax('_property',['properties'=>$properties])
            ]);
        }
    }

    public function actionImport()
    {
        $file = UploadedFile::getInstanceByName('fileSanpham');

        if (!is_null($file)) {
            //upload file excel
            $namefile = \func::khongdau(time() .'-'. $file->name);
            $pathFile = dirname(dirname(__DIR__)) . '/file_import/' . $namefile;
            $file->saveAs($pathFile);

            // đọc file excel

            $inputFileType = \PHPExcel_IOFactory::identify($pathFile);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $data = $objReader->load($pathFile)->getSheet(0)->toArray(null, true, true, true);
            // lay du lieu tu dong 2 tro di

            $t = time();
            try {
                foreach ($data as $index => $item) {
                    if ($index == 0) continue;
                    $sanpham = new Product();
                    $sanpham->name = $item['A'];
                    $sanpham->brief = $item['C'];
                    $sanpham->decription = $item['D'];
                    $sanpham->retail = $item['E'];
                    $sanpham->sale = $item['F'];
                    $sanpham->status = (int)$item['G'];
                    $sanpham->ord = (int)$item['H'];
                    $sanpham->home = (int)$item['I'];
                    $sanpham->hot = (int)$item['J'];
                    $sanpham->active = (int)$item['K'];
                    $sanpham->cat_product_id = (int)$item['L'];
                    $sanpham->brand_id = (int)$item['M'];

                    if ($sanpham->save()) {
                        $hinhanh = new Anhsanpham();
                        $pat = '/[^\.]+$/';
                        preg_match($pat, $item['B'], $extension);
                        $fileName = $t . '-' . $index . '.' . $extension[0];
                        $streamContext = stream_context_create([
                            'ssl' => [
                                'verify_peer' => false,
                                'verify_peer_name' => false
                            ]
                        ]);
                        $contents = file_get_contents($item['B'], false, $streamContext);
                        $path = dirname(dirname(__DIR__)) . '/images/product/' . $fileName;
                        $handle = fopen($path, "w");
                        fwrite($handle, $contents);
                        echo "Success";
                        fclose($handle);
                        $hinhanh->product_id = $sanpham->id;
                        $hinhanh->image = '/images/product/' . $fileName;
                        $hinhanh->default = 1;
                        $hinhanh->save();
                    }
                }
            }catch (\Exception $ex){

            }finally{
                unlink($pathFile);
            }

        }
        
        return $this->redirect(['index']);
    }

    public function actionAddproperties($id){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = Product::find()->where(['id'=>$id])->one();
        $listthuoctinh = \common\models\Thuoctinh::find()->all();
        return [
            'title'=> "Cập nhật phiên bản sản phẩm #<a style=';font-size: 18px'>".Product::findOne(['id'=>$id])->name."</a>",
            'content'=>$this->renderPartial('addproperties',[
                'model'=>$model,
                'dataketqua'=>$this->renderPartial('tableketqua',[
                    'model'=>$model,
                    'data'=>Thuoctinhproduct::find()->where(['product_id'=>$model->id])->all(),
                    'listthuoctinh'=>$listthuoctinh
                ])
            ]),
            'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])
                .Html::button('Lưu lại',['class'=>'btn blue pull-right btn-luu-thuoctinh','data-target'=>$id])
        ];
    }


    public function actionAddsingleproperties($numpost){
        return $this->renderPartial('singleproperties',['num'=>$numpost]);
    }
    public function actionSavethuoctinh(){
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            $errors="";
            $status="success";
            foreach ($_POST['data'] as $index =>$value){
                $thuoctinhproduct= new Thuoctinhproduct();
                $thuoctinhproduct->product_id=$id;
                $thuoctinhproduct->giagoc=$value['giagoc'];
                $thuoctinhproduct->gia=$value['gia'];
                $thuoctinhproduct->conhang=$value['conhang'];
                $thuoctinhproduct->thuoctinh_id=Json::encode($value['listthuoctinh']);
                if(is_null(Thuoctinhproduct::findOne(['product_id'=>$id,'thuoctinh_id'=>$thuoctinhproduct->thuoctinh_id])))
                {
                    if(!$thuoctinhproduct->save()){
                        $errors.=$thuoctinhproduct->getFirstError();
                        $status="fail";
                    }
                }else{
                    $errors.="Có sự trùng lặp các thuộc tính";
                    $status="fail";
                }
            }
            return Json::encode(['status'=>$status,'errors'=>$errors]);
        }else{
            return Json::encode(['status'=>'fail','errors'=>"Thiếu tham số"]);
        }
    }
    public function actionDeletethuoctinh(){
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            $errors="";
            $status="success";
            $thuoctinh = Thuoctinhproduct::findOne(['id'=>$id]);
            if(!$thuoctinh->delete()){
                $status='fail';
                $errors=$thuoctinh->getFirstError();
            }
            return Json::encode(['status'=>$status,'errors'=>$errors]);
        }else{
            return Json::encode(['status'=>'fail','errors'=>"Thiếu tham số"]);
        }
    }
    public function actionDeleteanh($id){
        $anhsanpham = Anhsanpham::findOne(['id'=>$id]);
        if(is_file(Yii::getAlias('@root').$anhsanpham->image)){
            unlink(Yii::getAlias('@root').$anhsanpham->image);
        }
        if(is_file(Yii::getAlias('@root').$anhsanpham->thumb)){
            unlink(Yii::getAlias('@root').$anhsanpham->thumb);
        }
        return Anhsanpham::deleteAll(['id'=>$id]);
    }
    public function actionGetviewthuoctinh($id){
        $listthuoctinh = \common\models\Thuoctinh::find()->all();
        $thuoctinhsanpham = \common\models\Thuoctinhproduct::find()->where(['product_id' => $id])->all();
        Yii::$app->response->format = Response::FORMAT_JSON;

        return [
            'title'=> "Xem phiên bản sản phẩm #<a style=';font-size: 18px'>".Product::findOne(['id'=>$id])->name."</a>",
            'content'=>$this->renderPartial('viewphienban',[
                'listthuoctinh'=>$listthuoctinh,
                'thuoctinhsanpham'=>$thuoctinhsanpham
            ]),
            'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])
        ];
    }
    public function actionGetviewcauhoi($id){

        $cauhoi = \common\models\Cauhoi::find()->where(['product_id' => $id])->all();
        Yii::$app->response->format = Response::FORMAT_JSON;

        return [
            'title'=> "Xem câu hỏi #<a style=';font-size: 18px'>".Product::findOne(['id'=>$id])->name."</a>",
            'content'=>$this->renderPartial('viewcauhoi',[
                'cauhoi'=>$cauhoi
            ]),
            'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])
        ];
    }
    public function actionCopy($id){

        Yii::$app->response->format = Response::FORMAT_JSON;
        $product = Product::findOne(['id'=>$id]);
        if(!is_null($product)){
            $productnew= new Product();
            $productnew->attributes=$product->attributes;

            $productnew->save();
            $productnew->name=$productnew->name." (Copy ".$productnew->id.")";
            $productnew->url=\func::taoduongdan($productnew->name);
            $productnew->save();
            $thuoctinh = Thuoctinhproduct::find()->where(['product_id'=>$product->id])->all();
            foreach ($thuoctinh as $thuoctinhs){
                $thuoctinhnew =new Thuoctinhproduct();
                $thuoctinhnew->attributes=$thuoctinhs->attributes;
                $thuoctinhnew->product_id=$productnew->id;
                $thuoctinhnew->save();
            }

            $anhsanpham = Anhsanpham::find()->where(['product_id'=>$product->id])->all();
            foreach ($anhsanpham as $anhsanphams){
                $anhsanphamnew = new Anhsanpham();
                $anhsanphamnew->attributes=$anhsanphams->attributes;
                $anhsanphamnew->product_id=$productnew->id;
                $anhsanphamnew->image=str_replace("/images/product/","/images/product/".rand(0,100000),$anhsanphamnew->image);
                $anhsanphamnew->thumb=str_replace("/images/product/thumb/","/images/product/thumb/".rand(0,100000),$anhsanphamnew->thumb);
                if(copy(dirname(dirname(__DIR__)) .$anhsanphams->image,dirname(dirname(__DIR__)) .$anhsanphamnew->image) && copy(dirname(dirname(__DIR__)) .$anhsanphams->thumb,dirname(dirname(__DIR__)) .$anhsanphamnew->thumb)){
                    $anhsanphamnew->save();
                }
            }
            return[
                'forceReload'=>'#crud-datatable-pjax',
                'title'=> "Clone Product",
                'content'=>'<span class="text-success">Clone Product success</span>',
                'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])

            ];
        }else{
            return $this->redirect(['site/error']);
        }
    }
    private function getCatTreeString($catproduct,$str){
        /** @var Catproduct $catproduct */
        if($catproduct->parent==-1){
            return $catproduct->name." > ".$str;
        }else{
            return $this->getCatTreeString(Catproduct::findOne(['id'=>$catproduct->parent]),$catproduct->name." > ".$str);
        }
    }
    public function actionExporttoexcel(){


        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->getProperties()->setCreator("KarionTech")
            ->setLastModifiedBy("KarionTech")
            ->setTitle("Office 2007 XLSX")
            ->setSubject("Office 2007 XLSX")
            ->setDescription("generated by PHPExcel.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Result file");
        $objPHPExcel->getActiveSheet()->setTitle("Merchant");
        $default = array(
            'font' => array(
                'bold' => false,
                'color' => array('rgb' => '000000'),
                'size' => 11,
                'name' => 'Times new Roman'
            ),
        );
        $header = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000'),
                'size' => 11,
                'name' => 'Times new Roman'
            ),
        );

        $sheet = $objPHPExcel->setActiveSheetIndex(0);
        $sheet->getStyle('A1:M999')->applyFromArray($default);

        for ($i = "A"; $i <= "M"; $i++) {

            if($i!="fafasf"){
                $sheet->getColumnDimension($i)->setAutoSize(true);
            }

        }

        $sheet->getStyle('A1:M1')->applyFromArray($header);

        $sheet
            ->setCellValue('B1',"CODE")
            ->setCellValue('C1',"Số câu hỏi đã có trong hệ thống")
            ->setCellValue('A1',"Name");

        $row=2;
        foreach (Product::find()->where(['hot'=>1])->all() as $value){ /** @var Product $value */
            $tag = "";
            if(!is_null($value->tags) && !empty($value->tags)):
                                   foreach (explode(',',$value->tags) as $values):
                                        $tag.=$values.", ";
                                    endforeach;
                            endif;
            $sheet
                ->setCellValue('B'.$row,$value->id)
                ->setCellValue('C'.$row,count(Cauhoi::findAll(['product_id'=>$value->id])))
                ->setCellValue('A'.$row,$value->name);
//
            $row++;
        }
        $filename = "Merchant.xlsx";
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');


        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Transfer-Encoding: binary');
        ob_end_clean(); // this
        ob_start();
        $objWriter->save("php://output"); // Change filename to force download
    }

    public function actionExcel()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Nhap liệu excel",
                    'content' => $this->renderAjax('excel'),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Tải mẫu file nhập liệu',Yii::$app->urlManagerFrontend->baseUrl."/template/mauimport.xlsx", ['class' => 'btn btn-primary']) .
                        Html::button('Nhập liệu', ['class' => 'btn btn-primary','id'=>'nhaplieu']).
                        Html::button('Nhập liệu', ['class' => 'btn btn-primary hidden', 'type' => "submit",'id'=>'sub'])

                ];
            } else {

                $file = UploadedFile::getInstanceByName('upload');
                if (!is_null($file)) {

                    $filename = "/upload/".$file->name;
                    $file_path=Yii::getAlias('@root') . $filename;
                    $file->saveAs($file_path);

                    $valid = false;
                    $types = array('Excel2007', 'Excel5');
                    foreach ($types as $type) {
                        $reader = \PHPExcel_IOFactory::createReader($type);
                        if ($reader->canRead($file_path)) {
                            $valid = true;
                            break;
                        }
                    }

                    if ($valid) {

                        $objPHPExcel = new \PHPExcel();
                        $objPHPExcel->getProperties()->setCreator("KarionTech")
                            ->setLastModifiedBy("KarionTech")
                            ->setTitle("Office 2007 XLSX")
                            ->setSubject("Office 2007 XLSX")
                            ->setDescription("generated by PHPExcel.")
                            ->setKeywords("office 2007 openxml php")
                            ->setCategory("Result file");
                        $objPHPExcel->getActiveSheet()->setTitle("Merchant");
                        $default = array(
                            'font' => array(
                                'bold' => false,
                                'color' => array('rgb' => '000000'),
                                'size' => 11,
                                'name' => 'Times new Roman'
                            ),
                        );
                        $header = array(
                            'font' => array(
                                'bold' => true,
                                'color' => array('rgb' => '000000'),
                                'size' => 11,
                                'name' => 'Times new Roman'
                            ),
                        );

                        $sheet = $objPHPExcel->setActiveSheetIndex(0);
                        $sheet->getStyle('A1:M999')->applyFromArray($default);

                        for ($i = "A"; $i <= "M"; $i++) {

                            if($i!="fafasf"){
                                $sheet->getColumnDimension($i)->setAutoSize(true);
                            }

                        }

                        $sheet->getStyle('A1:M1')->applyFromArray($header);

                        $sheet
                            ->setCellValue('B1',"Kết quả")
                            ->setCellValue('C1',"Chi tiết")
                            ->setCellValue('A1',"Dòng");

                        $row=2;

                        $dataexcel = \Yexcel::readSheet($file_path, 0);

                        foreach ($dataexcel as $index => $import) {
                            if ($index != 1) {
                                $resultdong ="";
                                $ketqua="Thành công";

                                if(empty($import['A'])){
                                    $resultdong.="Thiếu mã số sách, ";
                                    $ketqua="Lỗi";
                                }
                                if(empty($import['B'])){
                                    $resultdong.="Thiếu tên sách, ";
                                    $ketqua="Lỗi";
                                }
                                if(empty($import['C'])){
                                    $resultdong.="Thiếu câu hỏi, ";
                                    $ketqua="Lỗi";
                                }
                                if(empty($import['D'])){
                                    $resultdong.="Thiếu đáp án A, ";
                                    $ketqua="Lỗi";
                                }
                                if(empty($import['E'])){
                                    $resultdong.="Thiếu đáp án B, ";
                                    $ketqua="Lỗi";
                                }
                                if(empty($import['F'])){
                                    $resultdong.="Thiếu đáp án C, ";
                                    $ketqua="Lỗi";
                                }
                                if(empty($import['G'])){
                                    $resultdong.="Thiếu đáp án đúng, ";
                                    $ketqua="Lỗi";
                                }elseif(strtolower(trim($import['G']))!="a" && strtolower(trim($import['G']))!="b" && strtolower(trim($import['G']))!='c'){
                                    $resultdong.="Sai định dạng đáp án đúng, phải là A B C, ";
                                    $ketqua="Lỗi";
                                }
                                if(empty($import['H'])){
                                    $resultdong.="Thiếu độ khó của câu hỏi, ";
                                    $ketqua="Lỗi";
                                }

                                if($ketqua=="Thành công"){
                                    $product = Product::findOne($import['A']);
                                    if(is_null($product)){
                                        $resultdong.="Không tìm thấy sách có id ".$import['A'].", ";
                                        $ketqua="Lỗi";
                                    }else{
                                        $cauhoi = Cauhoi::findOne(['product_id'=>$product->id,'cauhoi'=>trim($import['C'])]);
                                        if(is_null($cauhoi)){
                                            $resultdong="Thêm mới";
                                            $cauhoiinsert = new Cauhoi();
                                            $cauhoiinsert->product_id=$product->id;
                                            $cauhoiinsert->cauhoi=trim($import['C']);
                                            $cauhoiinsert->cautraloia=trim($import['D']);
                                            $cauhoiinsert->cautraloib=trim($import['E']);
                                            $cauhoiinsert->cautraloic=trim($import['F']);
                                            $cauhoiinsert->dapan=strtoupper(trim($import['G']));
                                            $cauhoiinsert->dokho=(int)(strtolower(trim($import['H'])));
                                            if(!$cauhoiinsert->save()){
                                                $resultdong=Json::encode($cauhoiinsert->errors);
                                                $ketqua="Lỗi hệ thống";
                                            }
                                        }else{
                                            $resultdong="Cập nhật";
                                            $cauhoi->cautraloia=trim($import['D']);
                                            $cauhoi->cautraloib=trim($import['E']);
                                            $cauhoi->cautraloic=trim($import['F']);
                                            $cauhoi->dapan=strtoupper(trim($import['G']));
                                            $cauhoi->dokho=(int)(strtolower(trim($import['H'])));
                                            if(!$cauhoi->update()){
                                                $resultdong=Json::encode($cauhoi->errors);
                                                $ketqua="Lỗi hệ thống";
                                            }
                                        }
                                    }

                                }
                                $sheet
                                    ->setCellValue('A'.$row,$row)
                                    ->setCellValue('B'.$row,$ketqua)
                                    ->setCellValue('C'.$row,$resultdong);
                                $row++;
                            }
                        }
                        $filename = "ketqua.xlsx";
                        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                        $objWriter->save($filename); // Change filename to force download
                        unlink($file_path);
                        $log = new Log();
                        $log->time = \func::getTimeNow();
                        $log->noidung = "Nhập lieu excel câu hỏi ".Yii::$app->user->identity->username;
                        $log->user = \Yii::$app->user->identity->username;
                        $log->loai = "Data";
                        $log->banghi = "-1";
                        $log->save();

                        return [
                            'forceReload' => '#crud-datatable-pjax',
                            'title' => "TNhập liệu Excel câu hỏi",
                            'content' => "<script>unblock('.modal-content')</script><a href='/backend/web/ketqua.xlsx' target='_blank'>Cập nhật hoàn thành! Bấm vào đây để tải kết quả</a>",
                            'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                                Html::a('Nhập file khác', ['excel'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                        ];
                    } else {
                        unlink($file_path);
                        return [
                            'forceReload' => '#crud-datatable-pjax',
                            'title' => "TNhập liệu Excel giấy khai tử",
                            'content' => '<p class="alert alert-success">File nhập phải là file excel .xls hoặc .xlsx</p><script>unblock(".modal-content")</script>',
                            'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                                Html::a('Nhập file khác', ['excel'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                        ];
                    }



                } else {

                    return [
                        'title' => "Nhap liệu excel",
                        'content' => $this->renderAjax('excel', [
                            'model' => $model
                        ]),
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::a('Tải mẫu file nhập liệu',Yii::$app->urlManagerFrontend->baseUrl."/upload/filemau/khaitu.xlsx", ['class' => 'btn btn-primary']) .
                            Html::button('Nhập liệu', ['class' => 'btn btn-primary', 'type' => "submit"])

                    ];
                }
            }
        } else {
            /*
            *   Process for non-ajax request
            */

            return $this->redirect(["giaybaotu/index"]);

        }
    }
}
