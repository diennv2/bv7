<?php
namespace backend\controllers;

use backend\models\ChangePasswordForm;
use common\models\Admin;
use backend\models\PasswordResetRequestAdminForm;
use backend\models\ResetPasswordAdminForm;
use common\models\Billmobile;
use common\models\Goicuoc;
use common\models\search\BillmobileSearch;
use common\models\search\LienhetuvanSearch;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\AdminLoginForm;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'confirm', 'changepassword', 'thongbao', 'request-password-reset', 'reset-password','baocao','inbill'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionBaocao(){
        $label = $_POST['from']." - ".$_POST['to'];
        return Json::encode(['status'=>'success','htmlContain'=>$this->renderPartial('baocao',['label'=>$label,'from'=>$_POST['from'],'to'=>$_POST['to']])]);
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BillmobileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel2 = new LienhetuvanSearch();
        $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModellh' => $searchModel2,
            'dataProviderlh' => $dataProvider2,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new AdminLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $model->username = \func::super_strip_tag_prevent_injection($model->username);
            $model->password = \func::super_strip_tag_prevent_injection($model->password);
            return $this->actionIndex();
        } else {
            return $this->renderPartial('login', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
    public function actionThongkedoanhthu()
    {
       return $this->render('thongkedoanhthu');
    }

    public function actionChangepassword()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new ChangePasswordForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if($model->changePassword()) {
                    Yii::$app->session->setFlash('doipass', 'Đổi mật khẩu thành công!');
                    return $this->redirect(['site/thongbao']);
                }
            }else{
                return $this->render('thaypass', [
                    'model' => $model,
                ]);
            }
        }
    }

    public function  actionThongbao(){
        return $this->render('thongbao');
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $request = Yii::$app->request;
        $model = new PasswordResetRequestAdminForm();

        if($request->isAjax)
        {
            if($request->isPost && isset($_POST['email']))
            {
                $model->email = $_POST['email'];

                if($model->sendEmail()){
                    echo '<h2>Hãy kiểm tra email của bạn để được hướng dẫn chi tiết!</h2>';
                }else{
                    echo '<h2>Email bạn cung cấp không hợp lệ!</h2>';
                }
            }
        }
    }

    public function actionResetPassword($token)
    {

        $this->layout = 'authcont';
        try {
            $model = new ResetPasswordAdminForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionConfirm($id, $key)
    {
        $this->layout = 'authcont';
        $user = Admin::find()->where([
            'id'=>$id,
        ])->one();

        $message=null;
        if($key===$user->auth_key){
            $message='Tài khoản của bạn đã được kích hoạt thành công!';
        }else{
            $message='Bạn không thể kích hoạt tài khoản nhiều lần!';
            if($user->status===0)
                $message='Tài khoản của bạn đã bị chặn!';
        }

        $user = Admin::find()->where([
            'id'=>$id,
            'auth_key'=>$key,
            'status'=>0,
        ])->one();

        if(!empty($user)){
            $user->status=10;
            $user->generateAuthKey();
            $user->save();
            Yii::$app->user->logout();
            $tempuser = Admin::findByUsername($user->username);
            Yii::$app->user->login($tempuser, 1800);
            Yii::$app->getSession()->setFlash('success','Congratulation! Your account has been activated successful!');
        }
        else{
            Yii::$app->getSession()->setFlash('warning','Your account has been suspended or activated!');
        }
        return $this->render('confirm',[
            'message' => $message,
        ]);
    }
    public function actionInbill($id){
        return $this->renderPartial("lastestbill",['id'=>$id]);
    }
}
