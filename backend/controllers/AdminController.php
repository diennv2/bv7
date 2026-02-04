<?php

namespace backend\controllers;
//636F707972696768742050681EA16D204B681EAF6320C26E202D204B6172696F6E2054656368204C696D69746564202D20303331303934303031313236

use common\models\Admin;
use common\models\Donvi;
use common\models\search\AdminSearch;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends Controller
{
    /**
     * @inheritdoc
     */

    /**
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Admin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Admin #" . $id,
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Cập nhật', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Admin model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Admin();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Thêm mới Admin",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Lưu', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Tạo mới Admin",
                    'content' => '<span class="text-success">Thêm mới thành công!</span>',
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Thêm mới', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                ];
            } else {
                return [
                    'title' => "Tạo mới Admin",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Lưu', ['class' => 'btn btn-primary', 'type' => "submit"])

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
     * Updates an existing Admin model.
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
                    'title' => "Cập nhật Admin #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Lưu', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else {

                if (isset($_POST['password'])) {
                    if ($_POST['password'] != '') {
                        $model->password_hash = Yii::$app->security->generatePasswordHash($_POST['password']);
                    }
                }
                $model->ten = $_POST['Admin']['ten'];
                $model->status = $_POST['Admin']['status'];

                if ($model->save()) {
                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => "Admin #" . $id,
                        'content' => $this->renderAjax('view', [
                            'model' => $model,
                        ]),
                        'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::a('Cập nhật', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                    ];
                } else {
                    return [
                        'title' => "Cập nhật Admin #" . $id,
                        'content' => $this->renderAjax('update', [
                            'model' => $model,
                        ]),
                        'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::button('Lưu', ['class' => 'btn btn-primary', 'type' => "submit"])
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
     * Delete an existing Admin model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

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
     * Delete multiple existing Admin model.
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
            $model->delete();
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
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpload()
    {
        return $this->render('excel');
    }

    public function actionExcel()
    {
        $file = UploadedFile::getInstanceByName('fileupload');

        if (!is_null($file)) {
            $thongbao = "";
            //upload file excel
            $namefile = \func::khongdau(time() . '-' . $file->name);
            $pathFile = dirname(dirname(__DIR__)) . '/upload/files/' . $namefile;
            $file->saveAs($pathFile);

            // đọc file excel

            $inputFileType = \PHPExcel_IOFactory::identify($pathFile);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $data = $objReader->load($pathFile)->getSheet(1)->toArray(null, true, true, true);
            $tam = '';
            $qh = '';
            try {
                foreach ($data as $index => $item) {
                    if ($index > 1) {
                        if (!is_null(trim((string)$item['B'])) && trim((string)$item['B']) != '') {
                            $quanhuyen = trim((string)$item['B']);
                            if (!is_null(Donvi::findOne(['name' => $quanhuyen]))) {
                                $qh = $quanhuyen;
                                $user = new Admin();
                                $user->username = strtolower(trim((string)$item['D']));
                                $user->email = trim((string)$item['D']) . "@viettel.com.vn";
                                $user->manv = trim((string)$item['D']);
                                $user->sdt = "1";
                                $user->trungtam = $quanhuyen;
                                $user->ten = trim((string)$item['C']);
                                $user->setPassword("123456aA@");
                                $user->status = 10;
                                $user->owner = \Yii::$app->user->identity->getId();
                                $user->generateAuthKey();
                                if ($user->save()) {
                                    $auth = \Yii::$app->authManager;
                                    $role = $auth->getRole("quanhuyen");
                                    $auth->assign($role, $user->id);
                                    $tam = $user->id;
                                }
                            }
                        } else {
                            if (!is_null(trim((string)$item['E'])) && trim((string)$item['E']) != '') {
                                $user = new Admin();
                                $user->username = strtolower(trim((string)$item['F']));
                                $user->email = trim((string)$item['F']) . "@viettel.com.vn";
                                $user->manv = trim((string)$item['F']);
                                $user->sdt = "1";
                                $user->trungtam = $qh;
                                $user->ten = trim((string)$item['E']);
                                $user->setPassword("123456aA@");
                                $user->status = 10;
                                $user->owner = $tam;
                                $user->generateAuthKey();
                                if ($user->save()) {
                                    $auth = \Yii::$app->authManager;
                                    $role = $auth->getRole("nhanvien");
                                    $auth->assign($role, $user->id);
                                }
                            }
                        }
                    }
                }
            } catch (\Exception $e) {

            }
        }
        return $this->redirect(['index']);
    }

    public function actionGetfilemanager()
    {
        Yii::$app->response->format = RESPONSE::FORMAT_JSON;
        return [
            'title' => "Anpham293 File manager",
            'content' => $this->renderPartial('filemanager'),
            'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])
        ];
    }

    public function actionGetfilemanagerforck()
    {
        return $this->renderPartial('filemanagerck');
    }

    public function actionTabletree()
    {
        $records = array();
        $records['nodes'] = array();

        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '0';
        $level = 1;
        if ($id != '0') {
            $id = explode(':', $id);
            $level = (int)$id[1] + 1;
            $dirs = glob(dirname(dirname(__DIR__)) . $id[0] . "/*", GLOB_ONLYDIR);
        } else {
            $dirs = glob(dirname(dirname(__DIR__)) . "/source/*", GLOB_ONLYDIR);
        }
        foreach ($dirs as $index => $dir) {
            $dirname = str_replace(dirname(dirname(__DIR__)), "", $dir);
            $id_ = $dirname . ':' . ($level);
            $t = explode("/", $dirname);
            $records['nodes'][] = array('id' => $id_, 'parent' => $id, 'name' => end($t), 'level' => $level, 'type' => 'folder');
        }
        return json_encode($records);
    }

    public function actionNodecreate()
    {
        if (!Yii::$app->request->isPost) {
            Yii::$app->response->statusCode = 500;
            $error = Yii::$app->getErrorHandler();
            return;
        }
        Yii::$app->response->format = RESPONSE::FORMAT_JSON;
        $dir = dirname(dirname(__DIR__));
        if ($_POST['parent'] == "0") {//root
            $dir .= "/source/" . \func::super_strip_tag_prevent_injection(\func::taoduongdan($_POST['name']));
        } else {
            $dir .= "/" . explode(":", $_POST['parent'])[0] . "/" . \func::super_strip_tag_prevent_injection(\func::taoduongdan($_POST['name']));
        }
        if (is_dir($dir)) {
            return ['status' => false, 'responseText' => "Thư mục đã tồn tại"];
        }
        return mkdir($dir, 0755)
            ? ['status' => true, 'responseText' => "Thành công"]
            : ['status' => false, 'responseText' => "Thất bại, bạn không có quyền"];

    }

    public function actionNodeupdate()
    {
        if (!Yii::$app->request->isPost) {
            Yii::$app->response->statusCode = 500;
            $error = Yii::$app->getErrorHandler();
            return;
        }
        Yii::$app->response->format = RESPONSE::FORMAT_JSON;
        $root_dir = dirname(dirname(__DIR__));
        $old_dir = $root_dir . "/" . explode(":", $_GET['id'])[0];
        $parent_dir = $root_dir . "/" . explode(":", $_POST['parent'])[0];
        if ((!is_dir($old_dir) || !is_dir($parent_dir)) && $_POST['parent'] != "0") {
            return ['status' => false, 'responseText' => "Thất bại, thư mục không tồn tại"];
        }
        if ($_POST['parent'] != "0") {
            $new_dir = $parent_dir . "/" . \func::super_strip_tag_prevent_injection(\func::taoduongdan($_POST['name']));
        } else {

            $new_dir = $root_dir . "/source/" . \func::super_strip_tag_prevent_injection(\func::taoduongdan($_POST['name']));
        }
        if (is_dir($new_dir)) {
            return ['status' => false, 'responseText' => "Thất bại, tên thư mục đổi đã tồn tại, vui lòng đặt tên khác"];
        }
        return rename($old_dir, $new_dir)
            ? ['status' => true, 'responseText' => "Thành công"]
            : ['status' => false, 'responseText' => "Thất bại, bạn không có quyền"];

    }

    public function actionNodedelete()
    {
        if (!Yii::$app->request->isPost) {
            Yii::$app->response->statusCode = 500;
            $error = Yii::$app->getErrorHandler();
            return;
        }
        Yii::$app->response->format = RESPONSE::FORMAT_JSON;
        $dir = dirname(dirname(__DIR__)) . explode(":", $_POST['node'])[0];

        try {
            return rmdir($dir)
                ? ['status' => true, 'responseText' => "Thành công"]
                : ['status' => false, 'responseText' => "Thất bại, bạn không có quyền"];
        }catch (\Exception $e){
            return ['status' => false, 'responseText' => "Thất bại, thư mục còn chứa file, không rỗng, không thể xóa"];
        }


    }

    protected $block_ext = [
        "php",
        "php2",
        "php3",
        "php4",
        "php5",
        "php6",
        "php7",
        "phps",
        "phps",
        "pht",
        "phtm",
        "phtml",
        "pgif",
        "shtml",
        "htaccess",
        "phar",
        "inc",
        "hphp",
        "ctp",
        "module"
    ];
    protected $allow_ext = [
        "csv",
        "xlsx",
        "xls",
        "doc",
        "docx",
        "jpg",
        "jpeg",
        "png",
        "webp",
        "pdf",
    ];

    protected $allowedType = [
        'image/gif',
        'image/jpeg',
        'image/png',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/pdf',
        'application/msword',
        'application/vnd.ms-excel',
    ];

    public function actionNodeselected()
    {
        if (!Yii::$app->request->isPost) {
            Yii::$app->response->statusCode = 500;
            $error = Yii::$app->getErrorHandler();
            return;
        }

        Yii::$app->response->format = RESPONSE::FORMAT_JSON;

        if ($_POST['parent'] == "0") {
            $dir = dirname(dirname(__DIR__)) . "/source/" . explode(":", $_POST['name'])[0];
            $url = "/source/" . explode(":", $_POST['name'])[0];
        } else {
            $dir = dirname(dirname(__DIR__)) . explode(":", $_POST['parent'])[0] . "/" . explode(":", $_POST['name'])[0];
            $url = explode(":", $_POST['parent'])[0] . "/" . explode(":", $_POST['name'])[0];
        }

        $indir = array_filter(scandir($dir), function ($item) use ($dir) {
            return !is_dir($dir . "/" . $item);
        });
        usort($indir, function ($a, $b) use ($dir) {
            return filemtime($dir . "/" . $a) < filemtime($dir . "/" . $b);
        });
        $listitem = [];
        foreach ($indir as $value) {
            $expl = explode(".", $value);
            if (in_array(end($expl), $this->block_ext)) {
                if (is_file($dir . "/" . $value))
                    unlink($dir . "/" . $value);
            } else {
                $listitem[] =
                    [
                        'name' => $value,
                        'path' => $dir . "/" . $value,
                        'url' => $url . "/" . $value,
                        'ext' => end($expl),
                    ];
            }

        }

        return ['status' => true, 'responseText' => $this->renderPartial('filelist', ['listitem' => $listitem])];
    }
    public function actionReloadlist()
    {
        if (!Yii::$app->request->isPost) {
            Yii::$app->response->statusCode = 500;
            $error = Yii::$app->getErrorHandler();
            return;
        }

        Yii::$app->response->format = RESPONSE::FORMAT_JSON;

        if (!isset($_POST['dir']) || strpos($_POST['dir'], "/source/") != 0) {
            Yii::$app->response->statusCode = 500;
            return false;
        }
        $dir=dirname(dirname(__DIR__)).$_POST['dir'];
        $url=$_POST['dir'];
        $indir = array_filter(scandir($dir), function ($item) use ($dir) {
            return !is_dir($dir . "/" . $item);
        });
        usort($indir, function ($a, $b) use ($dir) {
            return filemtime($dir . "/" . $a) < filemtime($dir . "/" . $b);
        });
        $listitem = [];
        foreach ($indir as $value) {
            $expl = explode(".", $value);
            if (in_array(end($expl), $this->block_ext)) {
                if (is_file($dir . "/" . $value))
                    unlink($dir . "/" . $value);
            } else {
                $listitem[] =
                    [
                        'name' => $value,
                        'path' => $dir . "/" . $value,
                        'url' => $url . "/" . $value,
                        'ext' => end($expl),
                    ];
            }

        }

        return ['status' => true, 'responseText' => $this->renderPartial('filelist', ['listitem' => $listitem])];
    }

    public function actionDeletefile()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (!isset($_POST['target'])) {
            return ['status' => false, 'mes' => 'Có lỗi xảy ra'];
        }
        $expl = explode('.', $_POST['target']);
        if (is_file($_POST['target']) && in_array(end($expl), $this->allow_ext)) {
            if (unlink($_POST['target'])) {
                return ['status' => true, 'mes' => 'Đã xóa!'];
            }
        }
        return ['status' => false, 'mes' => 'Có lỗi xảy ra'];
    }


    public function actionUploadfile()
    {
        if (!Yii::$app->request->isPost) {
            Yii::$app->response->statusCode = 500;
            return false;
        }
        if (!isset($_POST['tbr']) || strpos($_POST['tbr'], "/source/") != 0) {
            Yii::$app->response->statusCode = 500;
            return false;
        }
        Yii::$app->response->format=Response::FORMAT_JSON;
        $files = [];

        foreach (UploadedFile::getInstancesByName('files') as $value) {
            if(in_array($value->type,$this->allowedType)){
                $name = explode(".",$value->name);
                $extension = \func::super_strip_tag_prevent_injection(\func::taoduongdan(end($name)));
                if(in_array($extension,$this->allow_ext)){
                    $path = $_POST['tbr']."/".time().substr(\func::super_strip_tag_prevent_injection(\func::taoduongdan($value->name)),0,10).".".$extension;
                    if($value->saveAs(dirname(dirname(__DIR__)).$path)){
                        $files[]=[
                            "name" => $value->name,
                            'url'=>$path,
                            "size" => $value->size
                        ];
                    }
                }else{
                    $files[]=[
                        "name" => $value->name,
                        "error" => "File không hợp lệ"
                    ];
                }
            }else{
                $files[]=[
                    "name" => $value->name,
                    "error" => "File không hợp lệ"
                ];
            }
        }
        return [
            "files" => $files
        ];
    }
}
