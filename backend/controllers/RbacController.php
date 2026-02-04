<?php

namespace backend\controllers;

use backend\models\SignupAdminForm;
use common\models\Admin;
use common\models\Album;
use common\models\Country;
use common\modules\auth\models\AuthAssignment;
use common\modules\auth\models\AuthItemChild;
use Yii;
use common\modules\auth\models\AuthItem;
use common\modules\auth\models\Search\RbacSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Inflector;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use frontend\models\SignupForm;


/**
 * RbacController implements the CRUD actions for AuthItem model.
 */
class RbacController extends Controller
{

    public function getAllControllerActions(){
        $actions = [];
        $controllers = \yii\helpers\FileHelper::findFiles(Yii::getAlias('@app/controllers'), ['recursive' => true]);
        foreach ($controllers as $controller) {
            $files = basename(basename($controller),'.php');
            $methods =  get_class_methods('backend\\controllers\\'.$files);
            $files = strtolower($files);
            $control = basename($files,'controller');
                foreach ($methods as $method) {
                    if(preg_match('/action(.+)/',$method)&&!(preg_match('/actions/',$method))&&($control!='site')){
                        $actions[$control][] = strtolower(preg_replace('/action/','',$method));
                    }
                }
        }
        return $actions;
    }


    public function actionAuthorization(){
        $auth = Yii::$app->authManager;

        if(isset($_POST['updateAction'])){
            $items = $this->getAllControllerActions();
            $admin = $auth->getRole('superadmin');
            $permissions = $auth->getPermissions();
            foreach ($permissions as $permission){
                if(!$auth->hasChild($admin,$permission))
                {
                    $auth->addChild($admin,$permission);
                }
            }

            $availablePermissions = [];
            foreach ($items as $index => $value){
                foreach ($value as $action){
                    $availablePermissions[] = $index.'/'.$action;
                    $permission = $auth->createPermission($index.'/'.$action);
                    if(!$auth->hasChild($admin,$permission)){
                        $permission->description = 'new auth';
                        $auth->add($permission);
                        $auth->addChild($admin,$permission);
                    }
                }
            }

            foreach ($permissions as $permission){
                $xoa = true;
                foreach ($availablePermissions as $availablePermission){
                    if($permission->name == $availablePermission){
                        $xoa = false;
                        break;
                    }
                }
                if($xoa){
                    $auth->remove($permission);
                }
            }

            $permissions = $auth->getPermissions();
            $roles = $auth->getRoles();

            $yyy = [];
            foreach ($permissions as $permission) {
                foreach ($roles as $role) {
                    $yyy[$permission->name][$role->name] = 0;
                }
            }

            foreach ($roles as $role) {
                $tempPers = $auth->getPermissionsByRole($role->name);
                foreach ($tempPers as $tempPer) {
                    $yyy[$tempPer->name][$role->name] = 1;
                }
            }

            return $this->render('phanquyen', [
                'roles' => $roles,
                'permissions' => $permissions,
                'yyy' => $yyy,
            ]);

/*            return $this->renderPartial('form_pq', [
                'roles' => $roles,
                'permissions' => $permissions,
                'yyy' => $yyy,
            ]);*/
        }
        else {
            $permissions = $auth->getPermissions();
            $roles = $auth->getRoles();

            $yyy = [];
            foreach ($permissions as $permission) {
                foreach ($roles as $role) {
                    $yyy[$permission->name][$role->name] = 0;
                }
            }

            foreach ($roles as $role) {
                $tempPers = $auth->getPermissionsByRole($role->name);
                foreach ($tempPers as $tempPer) {
                    $yyy[$tempPer->name][$role->name] = 1;
                }
            }
            return $this->render('phanquyen', [
                'roles' => $roles,
                'permissions' => $permissions,
                'yyy' => $yyy,
            ]);
        }

    }

    public function actionFrontendaccount()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            $file1 = \yii\web\UploadedFile::getInstance($model, 'file1');
            $file2 = \yii\web\UploadedFile::getInstance($model, 'file2');
            $file3 = \yii\web\UploadedFile::getInstance($model, 'file3');
            $file4 = \yii\web\UploadedFile::getInstance($model, 'file4');
            $model->file1 = $file1;
            $model->file2 = $file2;
            $model->file3 = $file3;
            $model->file4 = $file4;
            if ($user = $model->signupByAdmin()) {
                return $this->redirect(['user/index']);
            }
        }

        $country = Country::getCountry();

        return $this->render('frontacc', [
            'model' => $model,
            'country' => $country,
        ]);
    }

    public function actionSignup()
    {
        $model = new SignupAdminForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                Yii::$app->session->setFlash('taoacc','Tạo tài khoản mới thành công!');
                return $this->redirect(['rbac/thongbao']);
            }
        }

        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        $rolesname=[];
        foreach ($roles as $role){
            if($role->name=='admin' || $role->name=='superadmin')
                continue;
            $rolesname[$role->name]=$role->name;
        }

        return $this->render('signup', [
            'model' => $model,
            'roles' =>$rolesname,
        ]);
    }

    public function actionThongbao(){
        return $this->render('taoaccthanhcong');
    }

    public function actionUpdate_permission(){
        $auth = Yii::$app->authManager;

        if (isset($_POST['rolez']))
        {
            $role = $auth->getRole($_POST['rolez']);
            $permission = $auth->createPermission($_POST['permissionz']);

            if($auth->hasChild($role,$permission)){
                $auth->removeChild($role,$permission);
            }
            else{
                $auth->addChild($role,$permission);
            }
        }

        if(isset($_POST['roleall'])){
            $permissions = $auth->getPermissions();
            $xxx = [];
            foreach ($permissions as $permission){
                if(preg_match('/'.$_POST['controller'].'\/(.+)/',$permission->name)){
                    $xxx[] = $permission->name;
                }
            }

            if($_POST['checkall']=='true'){
                $role = $auth->getRole($_POST['roleall']);
                foreach ($xxx as $item){
                    $ppp = $auth->getPermission($item);
                    if(!$auth->hasChild($role,$ppp))
                        $auth->addChild($role,$ppp);
                }
                return 1;
            }
            else if($_POST['checkall']=='false'){
                $role = $auth->getRole($_POST['roleall']);
                foreach ($xxx as $item){
                    $ppp = $auth->getPermission($item);
                    if($auth->hasChild($role,$ppp))
                        $auth->removeChild($role,$ppp);
                }
                return 0;
            }
        }

    }

    public function actionUser_role(){
        $auth = Yii::$app->authManager;

        if(isset($_POST['rolez'])){
            $user = Admin::find()->where(['username'=>$_POST['user']])->one();
            if($auth->getAssignment($_POST['rolez'],$user->id)){
                $role = $auth->getRole($_POST['rolez']);
                $auth->revoke($role,$user->id);
            }
            else{
                $role = $auth->getRole($_POST['rolez']);
                $auth->assign($role,$user->id);
            }
        }
        else {
            $roles = $auth->getRoles();

            $users = Admin::find()->all();
            $xxx = [];
            foreach ($users as $user) {
                $userRoles = $auth->getRolesByUser($user->id);
                foreach ($roles as $role) {
                    $xxx[$user->username][$role->name] = 0;
                }
                foreach ($userRoles as $userRole) {
                    $xxx[$user->username][$userRole->name] = 1;
                }
            }
            return $this->render('vaitronguoidung', [
                'roles' => $roles,
                'users' => $users,
                'xxx' => $xxx,
            ]);
        }
    }

    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RbacSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//        $user = Admin::findIdentity(Yii::$app->user->identity);
//        $user->setPassword('123123');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "AuthItem #" . $id,
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
     * Creates a new AuthItem model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new AuthItem();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Tạo mới AuthItem",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else
                if ($model->load($request->post()) ) {

                    $auth = Yii::$app->authManager;
                    $author = $auth->createRole($request->post()['AuthItem']['name']);
                    $auth->add($author);
                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => "Tạo mới AuthItem",
                        'content' => '<span class="text-success">Create AuthItem success</span>',
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                    ];
                } else {
                    return [
                        'title' => "Tạo mới AuthItem",
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
                return $this->redirect(['view', 'id' => $model->name]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

    }

    /**
     * Updates an existing AuthItem model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
                    'title' => "Update AuthItem #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "AuthItem #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Update AuthItem #" . $id,
                    'content' => $this->renderAjax('update', [
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
                return $this->redirect(['view', 'id' => $model->name]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing AuthItem model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
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
     * Delete multiple existing AuthItem model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
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
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionNewrole(){
        $role = new AuthItem();
        $role->name = $_POST['name'];
        $role->type = 1;
        if(!$role->save()){
            return var_dump($role->errors);
        }else
            return 1;
    }
    public function actionDeleterole(){
        if(isset($_POST['name'])){
            $name = $_POST['name'];
            if(Yii::$app->user->can('rbac/deleterole')){
                if(!empty(AuthAssignment::find()->where(['item_name'=>$name])->all())){
                    return "Còn user được gán vai trò ".$name." trong hệ thồng";
                }else{
                    try{
                        AuthItemChild::deleteAll(['parent'=>$name]);
                        AuthItem::deleteAll(['name'=>$name,'type'=>1]);
                        return "Xóa vai trò thành công";
                    }catch(\Exception $e){
                        return "Lỗi hệ thống: ".json_encode($e);
                    }
                }
            }else{
                return "Bạn không có quyền truy cập chức năng này";
            }
        }else{
            return "Thiếu tham số";
        }
    }
}
