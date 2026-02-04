<?php

namespace frontend\controllers;

use common\models\Anhsanpham;
use common\models\Bill;
use common\models\Billmobile;
use common\models\Catnew;
use common\models\Catproduct;
use common\models\Cauhoi;
use common\models\Chitietnhomsach;
use common\models\Chuyenkhoa;
use common\models\Coinexchange;
use common\models\Comment;
use common\models\Configure;
use common\models\Congviec;
use common\models\Contact;
use common\models\Country;
use common\models\Danhmucvanban;
use common\models\Datcauhoi;
use common\models\Datlichkham;
use common\models\Deliveryaddress;
use common\models\Dienthoai;
use common\models\Excalibur;
use common\models\Friend;
use common\models\Friendrequest;
use common\models\Goicuoc;
use common\models\Landingpage;
use common\models\Landingpageoptions;
use common\models\Lichsutaikhoan;
use common\models\Lienhetuvan;
use common\models\Listnhanqua;
use common\models\Log;
use common\models\News;
use common\models\Nhomsachtheoloai;
use common\models\Page;
use common\models\Partner;
use common\models\Phuongxa;
use common\models\Poll;
use common\models\Post;
use common\models\Postcomment;
use common\models\Product;
use common\models\Quanhuyen;
use common\models\ReviewTable;
use common\models\Slides;
use common\models\TblPoll;
use common\models\Topic;
use common\models\Traloicauhoi;
use common\models\User;
use common\models\Userqua;
use common\models\Vanban;
use common\models\Video;
use Composer\Downloader\PearPackageExtractor;
use frontend\models\ChangeAccountDetailForm;
use frontend\models\ChangeCompanyVerificationForm;
use frontend\models\ChangePasswordForm;
use kartik\file\FileInput;
use phpDocumentor\Reflection\Types\This;
use Yii;
use yii\base\BaseObject;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\db\mssql\PDO;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\jui\Slider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Response;
use yii\web\UploadedFile;
use function foo\func;
use function GuzzleHttp\Psr7\str;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public $pageTitle;
    public $keyword;
    public $config;
    public $description;
    public $og_title;
    public $og_description;
    public $og_type = 'website';
    public $og_image;
    public $site_name;
    public $og_url;
    public $seoTitle = "";

    public $navbar = '';    //Thanh điều hướng cho trang con
    /**
     * @inheritdoc
     */
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup','dangkyngay'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                    [
                        'actions' => ['logout', "deliveryaddress", "nhanqua", "history", 'nhanqua',"sdtgioithieu"],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [

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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionGetquanhuyenbytinhthanh()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return Quanhuyen::getListQuanHuyenForDropdown($_POST['tinhthanh']);
    }

    public function actionGetphuongxabyquanhuyen()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return Phuongxa::getListPhuongXaForDropdown($_POST['tinhthanh']);
    }

    public function actionError()
    {
        Yii::$app->response->statusCode = 404;
        return false;
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $config = Configure::getConfig();
        $this->pageTitle = $config['homepage_page_title'];
        $this->seoTitle = $config['homepage_seo_title'];
        $this->view->title = $config['homepage_seo_title'];
        $this->description = $config['homepage_seo_description'];
        $slides = Slides::getSlideByPos('main');


        return $this->render('index', [
            'slide' => $slides,
        ]);

    }

    public function actionSuccess()
    {
        return $this->render('success');
    }
    public function actionDangkythanhcong()
    {
        return $this->render('dangkythanhcong');
    }

    public function beforeAction($action)
    {
        $this->navbar = '<a href="' . Yii::$app->urlManager->baseUrl . '/" target="_self">Trang chủ</a>';
        if(!Yii::$app->user->isGuest
            && Yii::$app->request->url!="/site/yeucaugiahan.html" //trang chui
            && Yii::$app->request->url!="/site/goicuoc.html" //trang dang ky
            && Yii::$app->request->url!="/" //trang chu
            && Yii::$app->request->url!="/san-pham.html"
            && Yii::$app->request->url!="/gioi-thieu-b29.html"
            && Yii::$app->request->url!="/tin-moi-nhat-l35.html"
            && Yii::$app->request->url!="/account.html"
            && Yii::$app->request->url!="/site/dangkythanhcong.html"
        ){
            $goi = Goicuoc::find()->where(['user_id'=>Yii::$app->user->identity->id])->orderBy("id desc")->one();
            if(is_null($goi) || date_create_from_format("Y-m-d H:i:s",$goi->ngayhethan)>date("Y-m-d H:i:s")){
                return $this->redirect(['site/yeucaugiahan']);
            }
        }
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }
    public function actionYeucaugiahan(){
        return $this->render('hethan');
    }
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            return $this->goBack();

        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionDangnhap()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        } else {
            $model = new LoginForm();
            $model->username = $_POST['username'];
            $model->password = $_POST['password'];

            if ($model->isBlocked()) {
                return json_encode(['type' => 'fail', 'message' => 'Tài khoản của bạn chưa được xác thực, vui lòng kiểm tra email đăng ký. Trong trường hợp không thấy email, vui lòng kiểm tra mục thư rác hoặc liên hệ quản trị viên website']);
            }

            if ($model->login()) {
                return Json::encode(["type" => 'success']);
            } else {
                return Json::encode(["type" => 'fail', 'message' => 'Sai tài khoản hoặc mật khẩu.']);
            }
        }

    }


    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionCatlist($id, $path)
    {
        $cat = Catproduct::find()->where(['id' => $id, 'url' => $path])->one();
        if (!is_null($cat)) {
            $subcat = Catproduct::getAllSubCat($id);
            if (count($subcat) == 1 && $subcat[0]->id == $id) {
                $type = "subcat";
                $data = Product::find()->where(['cat_product_id' => $id])->orderBy('ord ASC')->all();
            } else {
                $type = "root";
                $subcat = Catproduct::find()->where(['parent' => $id])->orderBy('ord asc')->all();
                $data = [];
                foreach ($subcat as $subcats) {
                    $data[] = [
                        'subcat' => $subcats,
                        'product' => Product::find()->where(['cat_product_id' => $subcats->id, 'active' => 1])->limit(8)->orderBy('hot DESC')->addOrderBy('ord ASC')->all()
                    ];
                }

            }
            return $this->render('product/catlist', ['title' => $cat->name, 'data' => $data, 'type' => $type]);
        } else
            return $this->redirect(['site/error']);
    }

    public function actionProduct($id, $path)
    {
        $product = Product::findOne(['id' => $id, 'url' => $path]);
        if (!is_null($product)) {
            if (!is_null($product->seo_title) || $product->seo_title != "")
                $this->seoTitle = $product->seo_title;
            else
                $this->seoTitle = $product->name;

            if (!is_null($product->seo_desc) || $product->seo_desc != "")
                $this->description = $product->seo_desc;
            else
                $this->description = "Chỉ với " . number_format($product->sale, 0, '', '.') . "đ Quý khách sẽ có " . $product->code . " tốc độ cao với giá thành cạnh tranh
                và nhiều ưu đãi hấp dẫn.";

            $breadcrumb = Catproduct::findOne(['id' => $product->cat_product_id]);
            $anhsanpham = Anhsanpham::findOne(['product_id' => $id]);
            if (!is_null($anhsanpham) && is_file(Yii::getAlias('@root') . $anhsanpham->image))
                $this->og_image = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . $anhsanpham->image;
            else
                $this->og_image = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . Yii::$app->urlManager->baseUrl . Configure::getConfig()['contact_logo'];
            return $this->render('product/product', ['data' => $product, 'anhsanpham' => $anhsanpham, 'breadcrumb' => $breadcrumb]);
        } else
            return $this->redirect(['site/index']);
    }

    public function actionContact()
    {
        $secret = "6LdzaIgfAAAAAH22os7b3XwBlqirqzzdhyl0uvEW";
        $reCaptcha = new \ReCaptcha($secret);
        $request = Yii::$app->request;
        $model = new Lienhetuvan();
        $model->load($request->post());
        if (!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
            if (isset($_POST['g-recaptcha-response'])) {
                Yii::$app->session->setFlash('gcaptcha', 'Chưa nhập captcha');
            }
            return $this->render('contact', [

                'model' => $model
            ]);
        } else {
            $response = $reCaptcha->verifyResponse(
                $_SERVER["REMOTE_ADDR"],
                $_POST["g-recaptcha-response"]
            );
        }
        if (!$response != null && !$response->success) {
            Yii::$app->session->setFlash('gcaptcha', 'Captcha không có giá trị hoặc Captcha không thuộc trang web này');
            return $this->render('contact', [
                'model' => $model
            ]);
        }
        if ($model->load($request->post()) && $model->save()) {
            $mail = Yii::$app->mailer->compose('layouts/html', ['content' => "Hệ thống thông báo: Quý khách " . $model->hoten . ", sdt: " . $model->dienthoai . ", email: " . $model->email . " vừa đăng ký tư vấn. Nội dung: " . $model->noidung])
                ->setFrom('karion.coltd@gmail.com')
                ->setTo(Configure::getConfig()['contact_email'])
                ->setSubject("Thông báo (no-reply)");
            try {
                $mail->send();
            } catch (\Exception $e) {

            }
            return $this->redirect(['site/success']);
        } else {
            return $this->render('contact', [
                'model' => $model
            ]);
        }

    }
    public function actionDatlichkham()
    {
        $secret = "6LfhHMoeAAAAAHlLyL3NUuRy8PBRlFk0lmR4JpzI";
        $reCaptcha = new \ReCaptcha($secret);
        $request = Yii::$app->request;
        $model = new Datlichkham();
        $model->status = -1;

        $model->load($request->post());
        if (!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
            if (isset($_POST['g-recaptcha-response'])) {
                Yii::$app->session->setFlash('gcaptcha', 'Chưa nhập captcha');
            }
            return $this->render('datlichkham', [

                'model' => $model
            ]);
        } else {
            $response = $reCaptcha->verifyResponse(
                $_SERVER["REMOTE_ADDR"],
                $_POST["g-recaptcha-response"]
            );
        }
        if (!$response != null && !$response->success) {
            Yii::$app->session->setFlash('gcaptcha', 'Captcha không có giá trị hoặc Captcha không thuộc trang web này');
            return $this->render('datlichkham', [
                'model' => $model
            ]);
        }
        if ($model->load($request->post()) && $model->save()) {

//            $file = UploadedFile::getInstance($model,"filedinhkem");
//            if(!is_null($file)){
//                $namefile = \func::khongdau(time() . '-' . $file->name);
//                $pathFile = dirname(dirname(__DIR__)) . '/upload/files/' . $namefile;
//                $file->saveAs($pathFile);
//                $model->filedinhkem='/upload/files/' . $namefile;
//                $model->update();
//            }
            $mail = Yii::$app->mailer->compose('layouts/html', ['content' => "Hệ thống thông báo: Quý khách " . $model->hoten . ", sdt: " . $model->dienthoai . ", email: " . $model->email . " vừa đăng ký tư vấn. Nội dung: " . $model->noidung])
                ->setFrom('karion.coltd@gmail.com')
                ->setTo(Configure::getConfig()['contact_email'])
                ->setSubject("Thông báo (no-reply)");
            try {
                $mail->send();
            } catch (\Exception $e) {

            }
            return $this->redirect(['site/datlichkhamthanhcong']);
        } else {

            return $this->render('datlichkham', [
                'model' => $model
            ]);
        }

    }

    public function actionGoicuoc()
    {

        $request = Yii::$app->request;

        $model = new Goicuoc();
        $model->status = -1;
        $model->loaidangky = 1;
        $model->user_id = (Yii::$app->user->isGuest)?-1:Yii::$app->user->identity->id;
        $model->ngaydangky = date("Y-m-d H:i:s");
        $model->ngayhethan = date("Y-m-d H:i:s");
        if ($model->load($request->post()) && $model->save()) {
            if ($model->loaidangky == 1){
                $model->ngayhethan = date('Y-m-d H:i:s', strtotime("+6 months", strtotime($model->ngaydangky)));
            } else {
                $model->ngayhethan = date('Y-m-d H:i:s', strtotime("+12 months", strtotime($model->ngaydangky)));
            }
            $model->save();
            return $this->redirect(['site/dangkythanhcong']);
        } else {
            return $this->render('goicuoc', [
                'model' => $model
            ]);
        }
    }
    public function actionNews($catname, $url, $id)
    {

        $new = News::find()->where(['url' => $url, 'id' => $id,'pheduyet'=>1])->one();
        $catnew = Catnew::find()->where(['url' => $catname])->one();
        /** @var $new News */
        $this->navbar .= ' / <a href="' . Yii::$app->urlManager->createUrl(['site/listnews', 'id' => $new->cat_new_id, 'catname' => \func::taoduongdan($new->catNew->name)]) . '">' . $new->catNew->name . '</a>';
        News::updateAll(['luotxem' => $new->luotxem + 1], ['id' => $new->id]);

        $recentpost = News::find()->where('pheduyet=1')->orderBy('id desc')->limit(Configure::getConfig()['news_lastest'])->all();
        $related = News::find()->where(['pheduyet' => 1, 'id' => $new->cat_new_id])->orderBy('id desc')->limit(6)->all();
        if (!is_null($new)) {
            if (is_null($new->seo_title) || $new->seo_title == "") {
                $this->og_title = $new->title;
                $this->seoTitle = $new->title;
            } else {
                $this->seoTitle = $new->seo_title;
                $this->og_title = $new->seo_title;
            }
            if (is_null($new->seo_desc) || $new->seo_desc == "") {
                $this->description = $new->brief;
                $this->og_description = $new->brief;
            } else {
                $this->description = $new->seo_desc;
                $this->og_description = $new->seo_desc;
            }

            $this->keyword = $new->seo_keyword;
            $tin = News::find()->where('pheduyet=1')->orderBy('hot DESC')->limit(3)->all();
            $product = Product::find()->where(['active' => 1, 'home' => 1])->orderBy('ord asc')->limit(10)->all();
            return $this->render('news/index', ['data' => $new, 'news' => $recentpost, 'tin' => $tin, 'productRelatives' => $product, 'related' => $related]);
        } else
            return $this->redirect(['site/error']);
    }

    public function actionListnews($catname, $id)
    {

        $catnew = Catnew::find()->where(['url' => $catname, 'id' => $id])->one();

        /** @var $catnew Catnew */
        if (!is_null($catnew)) {
            $this->navbar .= ' /'.' <a href="javascript:void(0)">' . $catnew->name . '</a>';

            $catproduct = Catproduct::find()->all();
            $query = News::find()->where(['cat_new_id' => $catnew->id,'active'=>1,'pheduyet'=>1])->orderBy('id desc')->all();
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => array('pageSize' => 10),
            ]);

            $recentpost = News::find()->where('pheduyet=1')->orderBy('id desc')->limit(Configure::getConfig()['news_lastest'])->all();
            $goi = Product::find()->where('name like :name', [':name' => "%4G%"])->orderBy('hot DESC')->limit(3)->all();
            return $this->render("news/listnew", ['news' => $recentpost, 'goi' => $goi, 'product' => $catproduct, 'data' => $query, 'cat' => $catnew->name]);
        } else
            return $this->redirect(['site/error']);
    }
    public function actionListchuyenkhoas($id)
    {
        $chuyenkhoa = Chuyenkhoa::find()->where('id=:id and active=1', [':id' => $id])->one();
        /** @var $chuyenkhoa Chuyenkhoa */

        if (!is_null($chuyenkhoa)) {
            $this->navbar .= ' /'.' <a href="javascript:void(0)">' . $chuyenkhoa->title . '</a>';

            $catproduct = Catproduct::find()->all();
            $query = Chuyenkhoa::find()->where('active=1', [':id' => $chuyenkhoa->id])->orderBy('id desc');
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => array('pageSize' => 10),
            ]);

            $recentpost = News::find()->where('pheduyet=1')->orderBy('id desc')->limit(Configure::getConfig()['news_lastest'])->all();
            $goi = Product::find()->where('name like :name', [':name' => "%4G%"])->orderBy('hot DESC')->limit(3)->all();
            return $this->render("chuyenkhoas/listnew", ['news' => $recentpost, 'goi' => $goi, 'product' => $catproduct, 'data' => $dataProvider, 'cat' => $chuyenkhoa->title]);
        } else
            return $this->redirect(['site/error']);
    }
    public function actionPage($title, $id)
    {

        $page = Page::findOne($id);
        $this->navbar .= ' / '.'<a href="javascript:void(0)">' . $page->title . '</a>';
        if (!is_null($page)) {
            if ($page->seo_title == "" || is_null($page->seo_title)) {
                $this->og_title = $page->title;
                $this->seoTitle = $page->title;
            } else {
                $this->seoTitle = $page->seo_title;
                $this->og_title = $page->seo_title;
            }
            $this->description = $page->seo_desc;
            $this->og_description = $page->seo_desc;

            $this->keyword = $page->seo_keyword;

            $related = News::find()->where('pheduyet=1')->orderBy('id desc')->limit(6)->all();
            $product = Product::find()->where(['active' => 1, 'home' => 1])->orderBy('ord asc')->limit(10)->all();
            $tin = News::find()->where('pheduyet=1')->orderBy('hot DESC')->limit(3)->all();
            return $this->render('page', ['data' => $page, 'tin' => $tin, 'productRelatives' => $product, 'related' => $related]);
        } else
            return $this->redirect(['site/error']);
    }

    public function actionChuyenkhoas($url, $id)
    {


        $chuyenkhoa = Chuyenkhoa::find()->where('url=:url and id=:id and active=1', [':url' => $url, ':id' => $id])->one();
        /** @var $chuyenkhoa Chuyenkhoa */
        $this->navbar .= ' ';
        $recentpost = Chuyenkhoa::find()->orderBy('id desc')->limit(Configure::getConfig()['news_lastest'])->all();
        $related = Chuyenkhoa::find()->where(['active'=>1] )->limit(6)->all();
        if (!is_null($chuyenkhoa)) {
            $tin = Chuyenkhoa::find()->orderBy('id DESC')->limit(3)->all();
            $product = Product::find()->where(['active' => 1, 'home' => 1])->orderBy('ord asc')->limit(10)->all();
            return $this->render('chuyenkhoas/index', ['data' => $chuyenkhoa, 'chuyenkhoas' => $recentpost, 'tin' => $tin, 'productRelatives' => $product, 'related' => $related]);
        } else
            return $this->redirect(['site/error']);
    }
    public function actionDienthoai()
    {
        $dienthoai = Dienthoai::find()->orderBy('hang asc')->all();
        $group = \common\models\Groupdienthoai::find()->all();
        $datagr = [];
        foreach ($group as $value) {
            $datagr[$value->hang] = $value->tong;
        }
        return $this->render('dienthoai', ['dienthoai' => $dienthoai, 'datagr' => $datagr]);
    }

    public function actionTag($type, $value)
    {
        $tag = urldecode($value);
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => 10),
        ]);
        $query->andFilterWhere(['like', 'tags', $tag]);

        $query2 = News::find()->where('pheduyet=1');

        $dataProvider2 = new ActiveDataProvider([
            'query' => $query2,
            'pagination' => array('pageSize' => 10),
        ]);
        $query2->andFilterWhere(['like', 'tags', $tag]);

        return $this->render('tags', ['dataProvider' => $dataProvider, 'dataProvider2' => $dataProvider2, 'tag' => $tag]);
    }

    public function actionSearch()
    {
        $this->og_title ="Tìm kiếm";
        $this->pageTitle ="Tìm kiếm";
        $this->seoTitle ="Tìm kiếm";
        $this->og_description ="Tìm kiếm";
        $this->description ="Tìm kiếm";
        if(!isset($_GET['finder']) || trim($_GET['finder'])==""){
            return $this->redirect(['site/index']);
        }
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => 10),
        ]);
        $query->andFilterWhere(['like', 'name',\func::super_strip_tag_prevent_injection($_GET['finder']) ]);

        $query2 = News::find()->where('pheduyet=1');

        $dataProvider2 = new ActiveDataProvider([
            'query' => $query2,
            'pagination' => array('pageSize' => 10),
        ]);
        $query2->andFilterWhere(['like', 'title',\func::super_strip_tag_prevent_injection($_GET['finder'])]);

        return $this->render('ketqua', ['dataProvider' => $dataProvider,'dataProvider2' => $dataProvider2,'keyword'=>\func::super_strip_tag_prevent_injection($_GET['finder'])]);
    }


    public function actionViewviec($title, $id)
    {
        $congviec = Congviec::findOne(['id' => $id]);
        if (is_null($congviec) || \func::taoduongdan($congviec->ten) != $title) {
            return $this->redirect(['site/error']);
        } else {
            return $this->render('viewcongviec', ['model' => $congviec]);
        }
    }

//    public function actionSignup()
//    {
//
//        if (Yii::$app->user->isGuest) {
//            $model = new SignupForm();
//            $model->phone = $model->username;
//            $model->websiteurl = "1";
//            $model->email_confirm = "1";
//            $model->surname = "1";
//            $model->company_registration_number = "123";
//            $model->postcode = "1";
//            $model->company = "1";
//            $model->status = "10";
//            if ($model->load(Yii::$app->request->post())) {
//
//                $file1 = \yii\web\UploadedFile::getInstance($model, 'file1');
//                $file2 = \yii\web\UploadedFile::getInstance($model, 'file2');
//                $file3 = \yii\web\UploadedFile::getInstance($model, 'file3');
//                $file4 = \yii\web\UploadedFile::getInstance($model, 'file4');
//                $model->file1 = $file1;
//                $model->file2 = $file2;
//                $model->file3 = $file3;
//                $model->file4 = $file4;
//                if ($user = $model->signup()) {
////                if (Yii::$app->getUser()->login($user)) {
////                    return $this->goHome();
////                }
//
//                    $mail = Yii::$app->mailer->compose('layouts/html', ['content' => $this->renderPartial('mail', ['data' => $user])])
//                        ->setFrom('karion.coltd@gmail.com')
////                        ->setTo($model->email)
//                        ->setSubject("Verification Email NOREPLY");
////                    $mail->send();
//                    return $this->redirect(['site/done']);
//                }
//            }
//
//            $country = Country::getCountry();
//
//            return $this->render('signup', [
//                'model' => $model,
//                'country' => $country,
//            ]);
//        } else
//            return $this->render('dadangky');
//    }

//    public function actionSignupdaily()
//    {
//        if (Yii::$app->user->isGuest) {
//            $model = new SignupForm();
//            $model->websiteurl = "1";
//            $model->email_confirm = "1";
//            $model->surname = "1";
//            $model->company_registration_number = "123";
//            $model->postcode = "1";
//            $model->company = "1";
//            if ($model->load(Yii::$app->request->post())) {
//
//                $model->file1 = "";
//                $model->file2 = "";
//                $model->file3 = "";
//                $model->file4 = "";
//                if ($user = $model->signupDaiLy()) {
//
////                    $mail = Yii::$app->mailer->compose('layouts/html', ['content' => $this->renderPartial('mail', ['data' => $user])])
////                        ->setFrom('karion.coltd@gmail.com')
////                        ->setTo($model->email)
////                        ->setSubject("Verification Email NOREPLY");
////                    $mail->send();
////                    if (Yii::$app->user->login($user)) {
////                        return $this->goHome();
////                    }
//                    return $this->redirect(['site/donedaily']);
//                }
//            }
//
//            $country = Country::getCountry();
//
//            return $this->render('signupdaily', [
//                'model' => $model,
//                'country' => $country,
//            ]);
//        } else
//            return $this->render('dadangky');
//    }

    public function actionUserverify($id)
    {
        if (!isset($id) || is_null($id)) {
            return $this->goHome();
        } else {
            $user = User::findOne(['auth_key' => $id]);
            if (!is_null($user)) {
                $user->status = 10;
                if ($user->save()) {
                    return $this->redirect(['site/xacthucdone']);
                } else {
                    return $this->actionError();
                }
            } else {
                return $this->actionError();
            }
        }
    }

    public function actionXacthucdone()
    {
        return $this->render('xacthucdone');
    }

    public function actionDone()
    {
        return $this->render('done');
    }

    public function actionSanpham()
    {
        $this->navbar .= ' / '.'<a href="javascript:void(0)">Sản Phẩm</a>';
        return $this->render('sanpham');
    }

    function getOS($detect)
    {
        if ($detect->isAndroidOS()) {
            return "AndroidOS";
        }
        if ($detect->isBlackBerryOS()) {
            return "BlackBerryOS";
        }
        if ($detect->isPalmOS()) {
            return "PalmOS";
        }
        if ($detect->isSymbianOS()) {
            return "SymbianOS";
        }
        if ($detect->isWindowsMobileOS()) {
            return "WindowsMobileOS";
        }
        if ($detect->isWindowsPhoneOS()) {
            return "WindowsPhoneOS";
        }
        if ($detect->isiOS()) {
            return "iOS";
        }
        if ($detect->isiPadOS()) {
            return "iPadOS";
        }
        if ($detect->isMeeGoOS()) {
            return "MeeGoOS";
        }
        if ($detect->isMaemoOS()) {
            return "MaemoOS";
        }
        if ($detect->isJavaOS()) {
            return "JavaOS";
        }
        if ($detect->iswebOS()) {
            return "webOS";
        }
        if ($detect->isbadaOS()) {
            return "badaOS";
        }
        if ($detect->isBREWOS()) {
            return "BREWOS";
        }
    }

    function getBrowser($detect)
    {
        if ($detect->isChrome()) {
            return "Chrome";
        }
        if ($detect->isDolfin()) {
            return "Dolfin";
        }
        if ($detect->isOpera()) {
            return "Opera";
        }
        if ($detect->isSkyfire()) {
            return "Skyfire";
        }
        if ($detect->isEdge()) {
            return "Edge";
        }
        if ($detect->isIE()) {
            return "IE";
        }
        if ($detect->isFirefox()) {
            return "Firefox";
        }
        if ($detect->isBolt()) {
            return "Bolt";
        }
        if ($detect->isTeaShark()) {
            return "TeaShark";
        }
        if ($detect->isBlazer()) {
            return "Blazer";
        }
        if ($detect->isSafari()) {
            return "Safari";
        }
        if ($detect->isWeChat()) {
            return "WeChat";
        }
        if ($detect->isUCBrowser()) {
            return "UCBrowser";
        }
        if ($detect->isbaiduboxapp()) {
            return "baiduboxapp";
        }
        if ($detect->isbaidubrowser()) {
            return "baidubrowser";
        }
        if ($detect->isDiigoBrowser()) {
            return "DiigoBrowser";
        }
        if ($detect->isMercury()) {
            return "Mercury";
        }
        if ($detect->isObigoBrowser()) {
            return "ObigoBrowser";
        }
        if ($detect->isNetFront()) {
            return "NetFront";
        }
        if ($detect->isGenericBrowser()) {
            return "GenericBrowser";
        }
        if ($detect->isPaleMoon()) {
            return "PaleMoon";
        }
    }

    function getDevice($detect)
    {
        if ($detect->isiPhone()) {
            return "iPhone";
        }
        if ($detect->isBlackBerry()) {
            return "BlackBerry";
        }
        if ($detect->isHTC()) {
            return "HTC";
        }
        if ($detect->isNexus()) {
            return "Nexus";
        }
        if ($detect->isDell()) {
            return "Dell";
        }
        if ($detect->isMotorola()) {
            return "Motorola";
        }
        if ($detect->isSamsung()) {
            return "Samsung";
        }
        if ($detect->isLG()) {
            return "LG";
        }
        if ($detect->isSony()) {
            return "Sony";
        }
        if ($detect->isAsus()) {
            return "Asus";
        }
        if ($detect->isNokiaLumia()) {
            return "NokiaLumia";
        }
        if ($detect->isMicromax()) {
            return "Micromax";
        }
        if ($detect->isPalm()) {
            return "Palm";
        }
        if ($detect->isVertu()) {
            return "Vertu";
        }
        if ($detect->isPantech()) {
            return "Pantech";
        }
        if ($detect->isFly()) {
            return "Fly";
        }
        if ($detect->isWiko()) {
            return "Wiko";
        }
        if ($detect->isiMobile()) {
            return "iMobile";
        }
        if ($detect->isSimValley()) {
            return "SimValley";
        }
        if ($detect->isWolfgang()) {
            return "Wolfgang";
        }
        if ($detect->isAlcatel()) {
            return "Alcatel";
        }
        if ($detect->isNintendo()) {
            return "Nintendo";
        }
        if ($detect->isAmoi()) {
            return "Amoi";
        }
        if ($detect->isINQ()) {
            return "INQ";
        }
        if ($detect->isOnePlus()) {
            return "OnePlus";
        }
        if ($detect->isGenericPhone()) {
            return "GenericPhone";
        }
        if ($detect->isiPad()) {
            return "iPad";
        }
        if ($detect->isNexusTablet()) {
            return "NexusTablet";
        }
        if ($detect->isGoogleTablet()) {
            return "GoogleTablet";
        }
        if ($detect->isSamsungTablet()) {
            return "SamsungTablet";
        }
        if ($detect->isKindle()) {
            return "Kindle";
        }
        if ($detect->isSurfaceTablet()) {
            return "SurfaceTablet";
        }
        if ($detect->isHPTablet()) {
            return "HPTablet";
        }
        if ($detect->isAsusTablet()) {
            return "AsusTablet";
        }
        if ($detect->isBlackBerryTablet()) {
            return "BlackBerryTablet";
        }
        if ($detect->isHTCtablet()) {
            return "HTCtablet";
        }
        if ($detect->isMotorolaTablet()) {
            return "MotorolaTablet";
        }
        if ($detect->isNookTablet()) {
            return "NookTablet";
        }
        if ($detect->isAcerTablet()) {
            return "AcerTablet";
        }
        if ($detect->isToshibaTablet()) {
            return "ToshibaTablet";
        }
        if ($detect->isLGTablet()) {
            return "LGTablet";
        }
        if ($detect->isFujitsuTablet()) {
            return "FujitsuTablet";
        }
        if ($detect->isPrestigioTablet()) {
            return "PrestigioTablet";
        }
        if ($detect->isLenovoTablet()) {
            return "LenovoTablet";
        }
        if ($detect->isDellTablet()) {
            return "DellTablet";
        }
        if ($detect->isYarvikTablet()) {
            return "YarvikTablet";
        }
        if ($detect->isMedionTablet()) {
            return "MedionTablet";
        }
        if ($detect->isArnovaTablet()) {
            return "ArnovaTablet";
        }
        if ($detect->isIntensoTablet()) {
            return "IntensoTablet";
        }
        if ($detect->isIRUTablet()) {
            return "IRUTablet";
        }
        if ($detect->isMegafonTablet()) {
            return "MegafonTablet";
        }
        if ($detect->isEbodaTablet()) {
            return "EbodaTablet";
        }
        if ($detect->isAllViewTablet()) {
            return "AllViewTablet";
        }
        if ($detect->isArchosTablet()) {
            return "ArchosTablet";
        }
        if ($detect->isAinolTablet()) {
            return "AinolTablet";
        }
        if ($detect->isNokiaLumiaTablet()) {
            return "NokiaLumiaTablet";
        }
        if ($detect->isSonyTablet()) {
            return "SonyTablet";
        }
        if ($detect->isPhilipsTablet()) {
            return "PhilipsTablet";
        }
        if ($detect->isCubeTablet()) {
            return "CubeTablet";
        }
        if ($detect->isCobyTablet()) {
            return "CobyTablet";
        }
        if ($detect->isMIDTablet()) {
            return "MIDTablet";
        }
        if ($detect->isMSITablet()) {
            return "MSITablet";
        }
        if ($detect->isSMiTTablet()) {
            return "SMiTTablet";
        }
        if ($detect->isRockChipTablet()) {
            return "RockChipTablet";
        }
        if ($detect->isFlyTablet()) {
            return "FlyTablet";
        }
        if ($detect->isbqTablet()) {
            return "bqTablet";
        }
        if ($detect->isHuaweiTablet()) {
            return "HuaweiTablet";
        }
        if ($detect->isNecTablet()) {
            return "NecTablet";
        }
        if ($detect->isPantechTablet()) {
            return "PantechTablet";
        }
        if ($detect->isBronchoTablet()) {
            return "BronchoTablet";
        }
        if ($detect->isVersusTablet()) {
            return "VersusTablet";
        }
        if ($detect->isZyncTablet()) {
            return "ZyncTablet";
        }
        if ($detect->isPositivoTablet()) {
            return "PositivoTablet";
        }
        if ($detect->isNabiTablet()) {
            return "NabiTablet";
        }
        if ($detect->isKoboTablet()) {
            return "KoboTablet";
        }
        if ($detect->isDanewTablet()) {
            return "DanewTablet";
        }
        if ($detect->isTexetTablet()) {
            return "TexetTablet";
        }
        if ($detect->isPlaystationTablet()) {
            return "PlaystationTablet";
        }
        if ($detect->isTrekstorTablet()) {
            return "TrekstorTablet";
        }
        if ($detect->isPyleAudioTablet()) {
            return "PyleAudioTablet";
        }
        if ($detect->isAdvanTablet()) {
            return "AdvanTablet";
        }
        if ($detect->isDanyTechTablet()) {
            return "DanyTechTablet";
        }
        if ($detect->isGalapadTablet()) {
            return "GalapadTablet";
        }
        if ($detect->isMicromaxTablet()) {
            return "MicromaxTablet";
        }
        if ($detect->isKarbonnTablet()) {
            return "KarbonnTablet";
        }
        if ($detect->isAllFineTablet()) {
            return "AllFineTablet";
        }
        if ($detect->isPROSCANTablet()) {
            return "PROSCANTablet";
        }
        if ($detect->isYONESTablet()) {
            return "YONESTablet";
        }
        if ($detect->isChangJiaTablet()) {
            return "ChangJiaTablet";
        }
        if ($detect->isGUTablet()) {
            return "GUTablet";
        }
        if ($detect->isPointOfViewTablet()) {
            return "PointOfViewTablet";
        }
        if ($detect->isOvermaxTablet()) {
            return "OvermaxTablet";
        }
        if ($detect->isHCLTablet()) {
            return "HCLTablet";
        }
        if ($detect->isDPSTablet()) {
            return "DPSTablet";
        }
        if ($detect->isVistureTablet()) {
            return "VistureTablet";
        }
        if ($detect->isCrestaTablet()) {
            return "CrestaTablet";
        }
        if ($detect->isMediatekTablet()) {
            return "MediatekTablet";
        }
        if ($detect->isConcordeTablet()) {
            return "ConcordeTablet";
        }
        if ($detect->isGoCleverTablet()) {
            return "GoCleverTablet";
        }
        if ($detect->isModecomTablet()) {
            return "ModecomTablet";
        }
        if ($detect->isVoninoTablet()) {
            return "VoninoTablet";
        }
        if ($detect->isECSTablet()) {
            return "ECSTablet";
        }
        if ($detect->isStorexTablet()) {
            return "StorexTablet";
        }
        if ($detect->isVodafoneTablet()) {
            return "VodafoneTablet";
        }
        if ($detect->isEssentielBTablet()) {
            return "EssentielBTablet";
        }
        if ($detect->isRossMoorTablet()) {
            return "RossMoorTablet";
        }
        if ($detect->isiMobileTablet()) {
            return "iMobileTablet";
        }
        if ($detect->isTolinoTablet()) {
            return "TolinoTablet";
        }
        if ($detect->isAudioSonicTablet()) {
            return "AudioSonicTablet";
        }
        if ($detect->isAMPETablet()) {
            return "AMPETablet";
        }
        if ($detect->isSkkTablet()) {
            return "SkkTablet";
        }
        if ($detect->isTecnoTablet()) {
            return "TecnoTablet";
        }
        if ($detect->isJXDTablet()) {
            return "JXDTablet";
        }
        if ($detect->isiJoyTablet()) {
            return "iJoyTablet";
        }
        if ($detect->isFX2Tablet()) {
            return "FX2Tablet";
        }
        if ($detect->isXoroTablet()) {
            return "XoroTablet";
        }
        if ($detect->isViewsonicTablet()) {
            return "ViewsonicTablet";
        }
        if ($detect->isVerizonTablet()) {
            return "VerizonTablet";
        }
        if ($detect->isOdysTablet()) {
            return "OdysTablet";
        }
        if ($detect->isCaptivaTablet()) {
            return "CaptivaTablet";
        }
        if ($detect->isIconbitTablet()) {
            return "IconbitTablet";
        }
        if ($detect->isTeclastTablet()) {
            return "TeclastTablet";
        }
        if ($detect->isOndaTablet()) {
            return "OndaTablet";
        }
        if ($detect->isJaytechTablet()) {
            return "JaytechTablet";
        }
        if ($detect->isBlaupunktTablet()) {
            return "BlaupunktTablet";
        }
        if ($detect->isDigmaTablet()) {
            return "DigmaTablet";
        }
        if ($detect->isEvolioTablet()) {
            return "EvolioTablet";
        }
        if ($detect->isLavaTablet()) {
            return "LavaTablet";
        }
        if ($detect->isAocTablet()) {
            return "AocTablet";
        }
        if ($detect->isMpmanTablet()) {
            return "MpmanTablet";
        }
        if ($detect->isCelkonTablet()) {
            return "CelkonTablet";
        }
        if ($detect->isWolderTablet()) {
            return "WolderTablet";
        }
        if ($detect->isMediacomTablet()) {
            return "MediacomTablet";
        }
        if ($detect->isMiTablet()) {
            return "MiTablet";
        }
        if ($detect->isNibiruTablet()) {
            return "NibiruTablet";
        }
        if ($detect->isNexoTablet()) {
            return "NexoTablet";
        }
        if ($detect->isLeaderTablet()) {
            return "LeaderTablet";
        }
        if ($detect->isUbislateTablet()) {
            return "UbislateTablet";
        }
        if ($detect->isPocketBookTablet()) {
            return "PocketBookTablet";
        }
        if ($detect->isKocasoTablet()) {
            return "KocasoTablet";
        }
        if ($detect->isHisenseTablet()) {
            return "HisenseTablet";
        }
        if ($detect->isHudl()) {
            return "Hudl";
        }
        if ($detect->isTelstraTablet()) {
            return "TelstraTablet";
        }
        if ($detect->isGenericTablet()) {
            return "GenericTablet";
        }
    }

    public function actionUpdatediachi()
    {
        if (Yii::$app->request->cookies->has('karionlive')) {
            Yii::$app->response->cookies->remove('karionlive');
        }
        $live = [];
        $live['tinhthanh'] = $_POST['tinhthanhs'];
        $live['quanhuyen'] = $_POST['quanhuyens'];
        $live['phuongxa'] = $_POST['phuongxas'];
        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'karionlive',
            'value' => Json::encode($live),
            'expire' => time() + 86400 * 365 * 10,
        ]));
        $detect = new \Mobile_Detect();
        $contact = new Contact();
        $contact->company_name = \func::get_client_ip();
        $contact->slogan = $_POST['tinhthanhs'];
        $contact->address = $_POST['quanhuyens'];
        $contact->address1 = $_POST['phuongxas'];
        $contact->phone = ($detect->isMobile()) ? "Mobile" : (($detect->isTablet()) ? "Tablet" : "Desktop or Others");
        $contact->footer = $detect->getUserAgent();
        $contact->fax = $this->getOS($detect);
        $contact->email = $this->getDevice($detect);
        $contact->email_bcc = $this->getBrowser($detect);
        $contact->save();
        return 1;
    }

    public function actionReset()
    {
        if (Yii::$app->request->cookies->has('karionlive')) {
            Yii::$app->response->cookies->remove('karionlive');
        }
        return $this->redirect(['product/payment']);
    }

//    public function actionOverview()
//    {
//        if (Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
//        $this->navbar .= '<li><i class="fa fa-angle-right"></i></li><li><a href="javascript:void(0)">Overview</a></li>';
//        $user = User::find()->where(['id' => Yii::$app->user->identity->getId()])->one();
//        $request = Yii::$app->request;
//
//        $verification = new ChangeCompanyVerificationForm();
//        $model = new ChangePasswordForm();
//        $detail = new ChangeAccountDetailForm();
//        $deliverydefault = Deliveryaddress::find()->where(['user' => Yii::$app->user->identity->id, 'macdinh' => 1])->one();
//        $delivery = Deliveryaddress::find()->where(['user' => Yii::$app->user->identity->id, 'macdinh' => 0])->all();
//        if ($request->post()) {
//
//            if (isset($_POST['ChangeAccountDetailForm'])) {
//                if ($detail->load(Yii::$app->request->post()) && $detail->validate()) {
//                    if ($detail->changeInformation()) {
//                        $detail = new ChangeAccountDetailForm();
//                        Yii::$app->session->setFlash('success', "Success, your details has been changed!", true);
//                    }
//                } else {
//                    return $this->render('overview', [
//                        'account' => $user,
//                        'details' => $detail,
//                        'doimatkhau' => $model,
//                        'verification' => $verification,
//                        'activetab' => 3,
//                        'delivery' => $delivery,
//                        'deliverydefault' => $deliverydefault
//                    ]);
//                }
//            }
//
//            if (isset($_POST['ChangePasswordForm']))
//                if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//                    if ($model->changePassword()) {
//                        $model = new ChangePasswordForm();
//                        Yii::$app->session->setFlash('success', "Success, your password has been changed!", true);
//                    }
//                } else {
//                    return $this->render('overview', [
//                        'account' => $user,
//                        'details' => $detail,
//                        'doimatkhau' => $model,
//                        'verification' => $verification,
//                        'activetab' => 3,
//                        'delivery' => $delivery,
//                        'deliverydefault' => $deliverydefault
//                    ]);
//                }
//
//            if (isset($_POST['ChangeCompanyVerificationForm']))
//
//                if ($verification->load(Yii::$app->request->post()) && $verification->validate()) {
//                    $file1 = \yii\web\UploadedFile::getInstance($verification, 'file1');
//                    $file2 = \yii\web\UploadedFile::getInstance($verification, 'file2');
//                    $file3 = \yii\web\UploadedFile::getInstance($verification, 'file3');
//                    $file4 = \yii\web\UploadedFile::getInstance($verification, 'file4');
//                    $verification->file1 = $file1;
//                    $verification->file2 = $file2;
//                    $verification->file3 = $file3;
//                    $verification->file4 = $file4;
//                    if ($verification->changeInformation()) {
//                        $verification = new ChangeCompanyVerificationForm();
//                        Yii::$app->session->setFlash('success', "Success, your company verification has been changed!", true);
//                    }
//                } else {
//                    return $this->render('overview', [
//                        'account' => $user,
//                        'details' => $detail,
//                        'doimatkhau' => $model,
//                        'verification' => $verification,
//                        'activetab' => 4,
//                        'delivery' => $delivery,
//                        'deliverydefault' => $deliverydefault
//                    ]);
//                }
//        }
//
//        $user = User::find()->where(['id' => Yii::$app->user->identity->getId()])->one();
//        $verification->vat_number = $user->vat_number;
//        if (isset($_GET['doiqua'])) {
//            return $this->render('overview', [
//                'account' => $user,
//                'details' => $detail,
//                'doimatkhau' => $model,
//                'verification' => $verification,
//                'activetab' => 5,
//                'delivery' => $delivery,
//                'deliverydefault' => $deliverydefault
//            ]);
//        }
//        return $this->render('overview', [
//            'account' => $user,
//            'details' => $detail,
//            'doimatkhau' => $model,
//            'verification' => $verification,
//            'activetab' => 1,
//            'delivery' => $delivery,
//            'deliverydefault' => $deliverydefault
//        ]);
//    }

    public function actionDeliveryaddress()
    {
        if (isset($_POST['check'])) {
            $check = $_POST['check'];
        }
        $error = "";
        if (isset($_POST['delivery'])) {
            var_dump($_POST);
            foreach ($_POST['delivery'] as $index => $value) {
                $delivery = new Deliveryaddress();
                $delivery->attributes = $value;
                if (isset($check)) {
                    if ($index == $check) {
                        $delivery->macdinh = 1;
                        $t = Deliveryaddress::find()->where(['macdinh' => 1])->one();
                        if (!is_null($t)) {
                            Deliveryaddress::updateAll(['macdinh' => 0], ['id' => $t->id]);
                        }
                    }
                }
                $delivery->user = Yii::$app->user->identity->id;
                $delivery->country = "United Kingdom";
                if ($delivery->save()) {
                    $error .= "Save address: " . $delivery->address . " " . $delivery->address2 . " successfully</br>";
                } else
                    $error .= "An Error occurred when save address: " . $delivery->address . " " . $delivery->address2 . ". Error code: " . var_dump($delivery->errors) . "</br>";

            }
            Yii::$app->session->setFlash('success', $error);
            $this->redirect(['site/overview']);
        }
    }

    public function actionUpdatedef()
    {
        $t = Deliveryaddress::find()->where(['macdinh' => 1])->one();
        if (!is_null($t)) {
            Deliveryaddress::updateAll(['macdinh' => 0], ['id' => $t->id]);
        }
        Deliveryaddress::updateAll(['macdinh' => 1], ['id' => $_POST['id']]);
        return true;
    }

    public function actionHistory()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
        }
        $this->navbar .= '<li><i class="fa fa-angle-right"></i></li><li><a href="' . Yii::$app->urlManager->createUrl(['product/giohang']) . '"> Đơn đặt hàng</a></li>';
        $query = Billmobile::find()->where(['chuyendanhba' => Yii::$app->user->id])->orderBy("id desc");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => 10),
        ]);


        return $this->render('history', ['dataProvider' => $dataProvider]);
    }

    public function actionViewbill($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Đơn hàng #" . $id,
                'content' => $this->renderAjax('_viewbill', [
                    'model' => Billmobile::findOne(['id' => $id, 'chuyendanhba' => Yii::$app->user->id]),
                ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])
            ];
        } else {
            return $this->render('_viewbill', [
                'model' => Billmobile::findOne(['id' => $id, 'chuyendanhba' => Yii::$app->user->id]),
            ]);
        }
    }

    public function actionGenerate($position)
    {
        $config = \common\models\Configure::getConfig();
        return $this->renderPartial("index_" . $position, ['config' => $config]);
    }

    public function actionLandingpage($url, $id)
    {
        $landing = Landingpage::findOne(['url' => $url, 'id' => $id, 'active' => 1]);


        if (!is_null($landing)) {
            $this->seoTitle = $landing->name;
            $this->description = $landing->customcss;
            $params = ['landing' => $landing];

            return $this->render('landing', $params);
        } else {
            return $this->redirect(['site/error']);
        }
    }

    public function actionGetlanding($url, $id)
    {
        $landing = Landingpage::findOne(['url' => $url, 'id' => $id, 'active' => 1]);
        if (!is_null($landing)) {
            $landingoptions = Landingpageoptions::find()->where(['landing_id' => $landing->id])->all();
            $params = [];
            foreach ($landingoptions as $landingoption) {
                /** @var Landingpageoptions $landingoption */
                $params[$landingoption->target] = $this->renderPartial("landing/" . $landingoption->type, ['landing' => $landingoption, 'data' => $landingoption->value]);
            }
            return Json::encode($params);
        }
        return "";
    }

    public function actionGetproductforlandingpage($id)
    {
        $product = Product::find()->where('id = :id', [':id' => $id])->one();
        if (is_null($product)) {
            return "";
        }
        $thuoctinhs = $product->propertiesvalueProducts;
        return Json::encode(['data' => $this->renderPartial('landing/detailproduct',
            [
                'product' => $product,
                'thuoctinhs' => $thuoctinhs,
            ])]);
    }

    public function actionNhanqua($id)
    {

        $bill = Billmobile::findOne($id);

        $this->navbar .= '<li><i class="fa fa-angle-right"></i></li><li> Nhận quà</li>';
        if (is_null($bill) || $bill->chuyendanhba != Yii::$app->user->id) {
            return $this->redirect(['site/error']);
        }
        $query = Product::find()->where(['hot' => 1]);
        if (isset($_GET['filter'])) {
            $filter = $_GET['filter'];
            $query->andfilterWhere(['IN', 'id', ArrayHelper::map(Chitietnhomsach::findAll(['nhomid' => $filter]), 'id', 'product_id')])->orderBy("RAND()");
        }
        if (isset($_GET['nhieunguoichon'])) {
            $d = Yii::$app->db->createCommand("SELECT l.productid, COUNT(l.productid) AS dem FROM listnhanqua l GROUP BY l.productid ORDER BY dem desc")->queryAll();
            $array = [];
            foreach ($d as $value) {
                $array[] = $value['productid'];
            }
            $query->andfilterWhere(['IN', 'id', $array]);
        }
        $listSach =[];
        $checkall=false;
        $model = $bill;
        $product = \yii\helpers\Json::decode($model->product);
        $dem = 0;
        foreach ($product['giohang'] as $index => $item):

            $valuesach=\common\models\Product::findOne(['id'=>$item['id']])->catProduct;
            if($valuesach->home){
                $checkall=true;
            }else{
                $nhomsach = Nhomsachtheoloai::find()->where(['nhomid'=>$valuesach->id])->all();
                foreach ($nhomsach as $valuenhomsach){
                    $listSach[]=$valuenhomsach->sachid;
                    $listSach= array_unique($listSach);
                }
            }

            $dem+=$product['soluongchitiet'][$index][$item['id']]; endforeach;
        if(!$checkall){
            $query->andfilterWhere(['IN','id',$listSach]);
        }
        $query=$query->orderBy('RAND()');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);

        return $this->render('nhanqua', ['bill'=>$model,'dem'=>$dem,'dataProvider' => $dataProvider]);

    }

    public function actionChonqua()
    {
        if (!isset($_POST['itemid']) || !isset($_POST['datakey'])) {
            return Json::encode(['status' => false, 'message' => "Có lỗi xảy ra khi truyền yêu cầu tới server!"]);
        }
        $billid = $_POST['itemid'];
        $sachidlist = $_POST['datakey'];
        $sachlist = explode("-",$sachidlist);
        $bill = Billmobile::findOne($billid);
        $product = \yii\helpers\Json::decode($bill->product);
        $dem = 0;
        foreach ($product['giohang'] as $index => $item):
            $dem+=$product['soluongchitiet'][$index][$item['id']];
        endforeach;
        $counthack=0;
        foreach ($sachlist as $value){
            if(is_int((int)$value)&& (int)$value>0 && $counthack<$dem){

                $sach = Product::findOne((int)$value);
                if (is_null($bill) || is_null($sach)) {
                    return Json::encode(['status' => false, 'message' => "Không tìm thấy đơn hàng hoặc sách cần thao tác, hãy thử lại!"]);
                }
                //        if($bill->status==-1||$bill->status==2){
                //            return Json::encode(['status'=>false,'message'=>"Bạn chưa thanh toán cho đơn hàng này!"]);
                //        }
                if ($bill->nhanquastatus != 0) {
                    return Json::encode(['status' => false, 'message' => "Bạn đã nhận quà cho đơn hàng này rồi!"]);
                }
                if ($sach->hot != 1) {
                    return Json::encode(['status' => false, 'message' => "Sản phẩm này không phải là sách, hãy chọn lại!"]);
                }


                $listnhanqua = new Listnhanqua();
                $listnhanqua->billid = $billid;
                $listnhanqua->productid = (int)$value;
                $listnhanqua->save();
                $counthack++;
                $cauhoi = Cauhoi::find()->where(['product_id' => (int)$value])->orderBy('RAND()')->limit(4)->all();
                foreach ($cauhoi as $cauhois) {
                    /** @var Cauhoi $cauhois */
                    $traloicauhoi = new Traloicauhoi();
                    $traloicauhoi->listnhanquaid = $listnhanqua->id;
                    $traloicauhoi->cauhoi = $cauhois->id;
                    $traloicauhoi->cautraloi = $cauhois->dapan;
                    $traloicauhoi->status = 0;
                    $traloicauhoi->save();
                }
                $cauhoi = Cauhoi::find()->where(['product_id' => -1])->one();
                $traloicauhoi = new Traloicauhoi();
                $traloicauhoi->listnhanquaid = $listnhanqua->id;
                $traloicauhoi->cauhoi = -1;
                $traloicauhoi->cautraloi = $cauhoi->cauhoi;
                $traloicauhoi->status = 0;
                $traloicauhoi->save();

            }
        }
        $bill->nhanquastatus = 1;
        $bill->update();
        return Json::encode(['status' => true, 'message' => "Cám ơn bạn, Tulato đã nhận được yêu cầu. Tulato sẽ xử lý và cập nhật sớm nhất, bạn hãy theo dõi trong phần đơn hàng nhé!"]);
    }
    public function actionDangkyngay(){
        if(!Yii::$app->user->isGuest){
            return Json::encode(['data'=>"Đã đăng nhập"]);
        }
        $users = User::findOne(['username'=>$_POST['sdt']]);
        if(!is_null($users)){
            return Json::encode(['data'=>"Số điện thoại đã được đăng ký"]);
        }else{
            $user = new User();
            $user->username=$_POST['sdt'];
            $user->auth_key=Yii::$app->security->generateRandomString();
            $user->setPassword("123456");
            $user->email=$_POST['email'];
            $user->firstname=$_POST['hoten'];
            $user->surname=$_POST['hoten'];
            $user->title=1;
            $user->city=$_POST['tinhthanh'];
            $user->address=$_POST['quanhuyen'];
            $user->address2=$_POST['phuongxa'];
            $user->street=$_POST['diachi'];
            $user->status=10;
            $user->phone=$_POST['sdt'];
            $user->save();
            $model = new LoginForm();
            $model->username=$user->username;
            $model->password='123456';
            $model->login();
            return Json::encode(['data' => "Cám ơn bạn đã đăng ký\nTên đăng nhập của bạn là số điện thoại bạn vừa nhập\nMật khẩu là 123456"]);
        }
        return Json::encode(['data'=>"done"]);
    }
    public function actionGetviewcauhoi($id,$cauhoi)
    {
        $request = Yii::$app->request;

        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return [
                'title' => "Câu hỏi về tác phẩm #" . $id,
                'content' => "Hành vi hack, vui lòng đăng nhập",
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        }
        $bill = Billmobile::findOne($id);
        if (is_null($bill) || $bill->chuyendanhba != Yii::$app->user->id || $bill->status == -1 || $bill->status == 2) {
            return [
                'title' => "Bill error #" . $id,
                'content' => "<p class='alert alert-danger'>Không tìm thấy đơn hàng này hoặc đơn hàng chưa được thanh toán, không thể tiếp tục</p>",
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])

            ];
        }
        $listnhanqua = Listnhanqua::findOne(['billid' => $bill->id,'id'=>$cauhoi]);
        if (is_null($listnhanqua)) {
            return [
                'title' => "Gift error #" . $id,
                'content' => "Không tìm thấy lịch sử nhận quà",
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        }
        $cauhoi = Traloicauhoi::findAll(['listnhanquaid' => $listnhanqua->id]);


        return [
            'title' => "Câu hỏi về tác phẩm",
            'content' => $this->renderAjax('_viewcauhoi', [
                'cauhoi' => $cauhoi,
                'listnhanqua' => $listnhanqua
            ]),
            'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])
        ];

    }

    public function actionUpdatetraloi()
    {
        if (!isset($_POST['_csrf-frontend']) || Yii::$app->user->isGuest) {
            return false;
        }
        foreach ($_POST as $index => $value) {
            if (is_numeric($index)) {
                $id = $index;
                $val = $value;
                $traloi = Traloicauhoi::findOne($id);
                if (!is_null($traloi)) {
                    $listqua = Listnhanqua::findOne($traloi->listnhanquaid);
                    if (!is_null($listqua) && $listqua->isdatraloi == 0) {
                        $bill = Billmobile::findOne($listqua->billid);
                        if (!is_null($bill) && $bill->chuyendanhba == Yii::$app->user->id) {
                            $traloi->dapancuakhach = $val;
                            if (trim($traloi->dapancuakhach) == trim($traloi->cautraloi)) {
                                $traloi->status = 1;
                            } else {
                                $traloi->status = 0;
                            }
                            $traloi->update();
                        }
                    }
                }
            } elseif (!is_bool(strpos($index, 'cau5'))) {

                $id = (int)(explode('cau5-', $index)[1]);
                $val = $value;
                $traloi = Traloicauhoi::findOne($id);
                if (!is_null($traloi)) {
                    $listqua = Listnhanqua::findOne($traloi->listnhanquaid);
                    if (!is_null($listqua) && $listqua->isdatraloi == 0) {
                        $bill = Billmobile::findOne($listqua->billid);
                        if (!is_null($bill) && $bill->chuyendanhba == Yii::$app->user->id) {
                            $traloi->dapancuakhach = $val;
                            $traloi->status = 1;
                            $traloi->update();
                            $listqua->isdatraloi = 1;
                            $listqua->update();
                        }
                    }
                }
            }
        }
        return false;
    }

    public function actionTopic($id)
    {
        $product = Product::findOne(['id' => $id]);
        if (is_null($product)) {
            return $this->redirect(['site/error']);
        }
        if (is_null(Userqua::findOne(['userid' => Yii::$app->user->id, 'productid' => $product->id]))) {
            return $this->redirect(['site/error']);
        }
        $listtopic = Topic::find()->where(['sachid' => $product->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $listtopic,
            'pagination' => array('pageSize' => 10),
        ]);
        Yii::$app->session['addtopic'] = $product->id;
        return $this->render('topic', ['product' => $product, 'dataProvider' => $dataProvider]);
    }

    public function actionAddtopic()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
        }
        if (!isset(Yii::$app->session['addtopic'])) {
            return $this->redirect(['site/error']);
        }
        $product = Product::findOne(Yii::$app->session['addtopic']);

        if (is_null(Userqua::findOne(['userid' => Yii::$app->user->id, 'productid' => $product->id]))) {
            return $this->redirect(['site/error']);
        }
        $request = Yii::$app->request;
        $model = new Topic();
        $model->userid = Yii::$app->user->id;
        $model->sachid = Yii::$app->session['addtopic'];
        if ($model->load($request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'imageUpload');

            if (!is_null($file)) {
                $now = new \DateTime();
                $filename = "/images/topic/" . $now->getTimestamp() . $file->name;
                $path = Yii::getAlias('@root') . $filename;
                $file->saveAs($path);
                $model->image = $filename;
            } else {
                $model->image = $product->getDefaultImage();
            }
            $model->userid = Yii::$app->user->id;
            $model->sachid = Yii::$app->session['addtopic'];
            $model->update();
            return $this->redirect(['site/viewtopic', 'id' => $model->id, 'name' => \func::taoduongdan(substr($model->name, 0, 50))]);
        } else {
            return $this->render('addtopic', ['model' => $model, 'product' => $product]);
        }

    }

    public function actionViewtopic($name, $id)
    {
        $topic = Topic::findOne($id);
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
        }

        if (is_null($topic) || \func::taoduongdan(substr($topic->name, 0, 50)) != $name) {
            return $this->redirect(['site/error']);
        }
        $product = Product::findOne([$topic->sachid]);
        if (is_null($product)) {
            return $this->redirect(['site/error']);
        }
        if (is_null(Userqua::findOne(['userid' => Yii::$app->user->id, 'productid' => $product->id]))) {
            return $this->redirect(['site/error']);
        }
        $this->navbar .= '<li><i class="fa fa-angle-right"></i></li><li><a href="' . Yii::$app->urlManager->createUrl(['site/topic', 'id' => $product->id]) . '">Thảo luận ' . $product->name . '</a></li>';
        return $this->render("viewtopic", ['model' => $topic, 'product' => $product]);
    }

    public function actionUpdateavatar()
    {
        if (Yii::$app->user->isGuest) {
            return $this->actionIndex();
        }


        $file = UploadedFile::getInstanceByName('fileinput');
        if (!is_null($file)) {
            if ($file->size > 3145728) {

                return $this->redirect(['site/overview', 'thongbao' => 'File quá lớn, không được vượt quá 3Mb']);
            }
            if (strtolower($file->extension) != "jpg" && strtolower($file->extension) != "jpeg") {
                return $this->redirect(['site/overview', 'thongbao' => 'Sai định dạng file, phải là JPG hoặc JPEG']);
            }
            $thongbao = "";
            //upload file excel
            $namefile = \func::khongdau(time() . '.' . strtolower($file->extension));
            $pathFile = dirname(dirname(__DIR__)) . '/images/files/' . $namefile;
            $user = User::findOne(Yii::$app->user->id);
            if ($file->saveAs($pathFile)) {
                if (is_file(dirname(dirname(__DIR__)) . $user->shop_picture)) {
                    unlink(dirname(dirname(__DIR__)) . $user->shop_picture);
                }
                $user->shop_picture = '/images/files/' . $namefile;
                $user->update();
            }
        }
        return $this->actionOverview();
    }

    public function actionProfile($user)
    {
        $users = User::findOne($user);
        if (is_null($users)) {
            return $this->actionError();
        }


        $post = Post::find()->where(['userid' => $user])->orderBy('id desc');

        $dataProvider = new ActiveDataProvider([
            'query' => $post,
            'pagination' => array('pageSize' => 10),
        ]);

        return $this->render('profile', ['user' => $users, 'dataProvider' => $dataProvider]);
    }

    public function actionPost()
    {
        if (Yii::$app->user->isGuest) {
            return $this->actionError();
        }
        $post = new Post();
        $post->userid = Yii::$app->user->id;
        $post->content = $_POST['text'];
        $post->likelist = Json::encode([]);
        $post->save();
        return $this->redirect(['site/profile', 'user' => Yii::$app->user->id]);
    }

    public function actionLike()
    {
        if (Yii::$app->user->isGuest || !isset($_POST['id'])) {
            return false;
        }
        $id = $_POST['id'];
        $post = Post::findOne($id);
        $likelist = Json::decode($post->likelist);
        if (!in_array(Yii::$app->user->id, $likelist)) {
            $likelist[] = Yii::$app->user->id;
            $post->likelist = Json::encode($likelist);
            $post->save();
        } else {
            if (($key = array_search(Yii::$app->user->id, $likelist)) !== false) {
                unset($likelist[$key]);
            }
            $post->likelist = Json::encode($likelist);
            $post->save();
        }
        return true;
    }

    public function actionShare()
    {
        if (Yii::$app->user->isGuest || !isset($_POST['id'])) {
            return false;
        }
        $id = $_POST['id'];
        $postshare = Post::findOne($id);
        $post = new Post();
        $post->userid = Yii::$app->user->id;
        $post->content = "1";
        $post->likelist = Json::encode([]);
        if (!is_null($postshare->shareid)) {
            $post->shareid = $postshare->shareid;
        } else {
            $post->shareid = $id;
        }

        $post->save();

        return true;
    }

    public function actionXoacomment()
    {
        if (Yii::$app->user->isGuest || !isset($_POST['id'])) {
            return false;
        }
        $id = $_POST['id'];
        Postcomment::deleteAll(['userid' => Yii::$app->user->id, 'id' => $id]);
        return true;
    }

    public function actionComment()
    {

        if (Yii::$app->user->isGuest || !isset($_POST['id']) || !isset($_POST['val']) || (trim($_POST['val']) == "")) {
            return false;
        }

        $id = $_POST['id'];
        $comment = new Postcomment();
        $comment->comment = $_POST['val'];
        $comment->postid = $id;
        $comment->userid = Yii::$app->user->identity->id;
        $comment->save();

        return true;
    }

    public function actionAddfriend()
    {
        if (Yii::$app->user->isGuest || !isset($_POST['id'])) {
            return false;
        }

        $id = $_POST['id'];
        $fr = new Friendrequest();
        $fr->userid = Yii::$app->user->id;
        $fr->friendid = $id;
        $fr->save();
        var_dump($fr);
        exit;
        return 0;
    }

    public function actionRemovefriendrequest()
    {
        if (Yii::$app->user->isGuest || !isset($_POST['id'])) {
            return false;
        }

        $id = $_POST['id'];
        Friendrequest::deleteAll(['userid' => $id, 'friendid' => Yii::$app->user->id]);
        return 0;
    }

    public function actionAcceptfriendrequest()
    {
        if (Yii::$app->user->isGuest || !isset($_POST['id'])) {
            return false;
        }

        $id = $_POST['id'];
        Friendrequest::deleteAll(['userid' => $id, 'friendid' => Yii::$app->user->id]);
        $friend = new Friend();
        $friend->userid = $id;
        $friend->friendid = Yii::$app->user->id;
        $friend->save();

        $friend = new Friend();
        $friend->userid = Yii::$app->user->id;
        $friend->friendid = $id;
        $friend->save();

        return 0;
    }

    public function actionDeletefriend()
    {
        if (Yii::$app->user->isGuest || !isset($_POST['id'])) {
            return false;
        }

        $id = $_POST['id'];

        Friend::deleteAll(['userid' => $id, 'friendid' => Yii::$app->user->id]);
        Friend::deleteAll(['userid' => Yii::$app->user->id, 'friendid' => $id]);

        return 0;
    }

    public function actionFriendlist()
    {
        $users = User::findOne(Yii::$app->user->id);
        if (is_null($users)) {
            return $this->actionError();
        }


        $post = Friend::find()->where(['userid' => $users->id])->orderBy('id desc');

        $dataProvider = new ActiveDataProvider([
            'query' => $post,
            'pagination' => array('pageSize' => 10),
        ]);

        return $this->render('friendlist', ['user' => $users, 'dataProvider' => $dataProvider]);
    }

    public function actionDoithuong()
    {
        $arrayTopup = [
            10000,
            20000,
            30000,
            50000,
            100000,
            200000,
            500000,
        ];
        $arrayBrand = [
            "VMS",
            "VNP",
            "VTT",
            "VNM",
        ];
        $arrayType = [
            "PRE_PAID",
            "POST_PAID",
        ];

        if (!Yii::$app->session['topupcheck']) {
            Yii::$app->session['topupcheck'] = time();
        } else {
            if (time() - Yii::$app->session['topupcheck'] < 30) {
                return Json::encode([
                    "responseStatus" => false,
                    "responseMessage" => 'Thao tác quá nhanh, vui lòng thực hiện hai lần đổi thưởng cách nhau ít nhất 30 giây, thử lại sau: ' . (Yii::$app->session['topupcheck'] + 30 - time()) . " giây"
                ]);
            } else {
                Yii::$app->session['topupcheck'] = time();
            }
        }
        if (Yii::$app->request->isGet) {
            return Json::encode([
                "responseStatus" => false,
                "responseMessage" => 'Unsupported method'
            ]);
        }
        if (Yii::$app->user->isGuest) {
            return Json::encode([
                "responseStatus" => false,
                "responseMessage" => 'Vui lòng đăng nhập'
            ]);
        }
        if (
            !isset($_POST['topup']) ||
            !isset($_POST['phone']) ||
            empty(trim($_POST['phone'])) ||
            !isset($_POST['type']) ||
            empty(trim($_POST['type'])) ||
            !isset($_POST['brand']) ||
            empty(trim($_POST['brand'])) ||
            empty(trim($_POST['topup']))
        ) {
            return Json::encode([
                "responseStatus" => false,
                "responseMessage" => 'Not Allowed! Thiếu số tiền, số điện thoại hoặc sai nhà mạng'
            ]);
        }
        if ($_POST['topup'] <= 0 || !is_numeric($_POST['topup'])) {
            return Json::encode([
                "responseStatus" => false,
                "responseMessage" => 'Sai số tiền, cảnh cáo!'
            ]);
        }
        if (!in_array($_POST['topup'], $arrayTopup)) {
            return Json::encode([
                "responseStatus" => false,
                "responseMessage" => 'Sai số tiền, cảnh cáo!'
            ]);
        }
        if (!in_array($_POST['brand'], $arrayBrand)) {
            return Json::encode([
                "responseStatus" => false,
                "responseMessage" => 'Sai nhà mạng, cảnh cáo!'
            ]);
        }
        if (!in_array($_POST['type'], $arrayType)) {
            return Json::encode([
                "responseStatus" => false,
                "responseMessage" => 'Sai phương thức, cảnh cáo!'
            ]);
        }
        $amount = Yii::$app->user->identity->getMoney();
        if ($amount < $_POST['topup']) {
            return Json::encode([
                "responseStatus" => false,
                "responseMessage" => 'Bạn không đủ số dư, vui lòng kiểm tra lại hoặc liên hệ quản trị viên!'
            ]);
        }
        $topup = new Coinexchange();
        $topup->userid = Yii::$app->user->id;
        $topup->sodiem = $_POST['topup'];
        $topup->phonenumber = $_POST['phone'];
        $topup->brand = $_POST['brand'];
        $topup->type = $_POST['type'];
        $topup->transaction_id = "s";
        $topup->service = "DD";
        $topup->status = 0;
        $topup->sotienthanhcong = 0;
        $topup->successtime = null;
        $topup->mess = "N/a";
        $transaction = Yii::$app->db->beginTransaction();
        if (!$topup->save()) {
            $transaction->rollBack();
            return Json::encode([
                "responseStatus" => false,
                "responseMessage" => 'Lỗi hệ thống'
            ]);
        } else {
            $topup->transaction_id = md5($topup->id . $topup->time);
            if ($topup->save()) {
                $transaction->commit();
            } else {
                $transaction->rollBack();
                return Json::encode([
                    "responseStatus" => false,
                    "responseMessage" => 'Lỗi hệ thống'
                ]);
            }
            $ex = Excalibur::findOne(['userid' => Yii::$app->user->id]);
            $ex->amount -= $topup->sodiem;
            $ex->update();
            $lichsu=new Lichsutaikhoan();
            $lichsu->amount=-$topup->sodiem;
            $lichsu->userid=Yii::$app->user->id;
            $lichsu->noidung="Đổi điểm thưởng";
            $lichsu->save();
            return Json::encode([
                "responseStatus" => true,
                "responseMessage" => 'Thành công, xin đợi kết quả duyệt từ bộ phận quản trị!'
            ]);


        }
    }

    public function actionLichsudoiqua()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $query = Coinexchange::find()->where(['userid' => Yii::$app->user->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => 10),
        ]);


        return $this->render('doiqua', ['dataProvider' => $dataProvider]);
    }

    public function actionTopupwebhook()
    {

        $request = Yii::$app->request;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = file_get_contents("php://input");


        $log = new Log();
        $log->time = \func::getTimeNow();;
        $log->noidung = Json::encode($data);
        $log->user = "Webhook";
        $log->loai = "Webhook";
        $log->banghi = 1;
        $log->save();
        $decode = Json::decode($data);
        $success = strtolower($decode['status']);
        $amount = $decode['amount'];
        $amountsuccess = $decode['charged_amount'];
        $message = $decode['message'];
        $transaction_id = (string)$decode['tran_id'];
        $giaodich = Coinexchange::findOne(['transaction_id' => $transaction_id]);
        if (!is_null($giaodich)) {
            if ($success !="error" && $success != "cancelled") {
                $statusarray=[
                    "waiting"=>"Đơn đang chờ nạp",
                    "charging"=> "Đơn đang được nạp",
                    "paused"=>"Đơn bị tạm dừng",
                    "completed"=>"Đơn đã hoàn thành"
                ];

                $giaodich->successtime = time();
                $giaodich->sotienthanhcong = $amountsuccess;
                $giaodich->status = 1;
                $giaodich->mess = $giaodich->mess . " | ".$decode['last_update'].": " . $statusarray[$success]." ".$message;
                $giaodich->save();
            }
            else{
                $ex = Excalibur::findOne(['userid'=>$giaodich->userid]);
                $ex->amount+=$giaodich->sodiem;
                $ex->update();
                $giaodich->mess="Đã hoàn lại ".$giaodich->sodiem."! ".$giaodich->mess;
                $giaodich->successtime = time();
                $giaodich->sotienthanhcong = 0;
                $giaodich->status = 2;
                $giaodich->mess = $giaodich->mess . " " . $message;
                $giaodich->save();
                $lichsu=new Lichsutaikhoan();
                $lichsu->amount=$giaodich->sodiem;
                $lichsu->userid=$giaodich->userid;
                $lichsu->noidung="Hoàn trả điểm thưởng do đổi điểm lỗi giao dịch số #".$giaodich->transaction_id;
                $lichsu->save();
            }
        }
    }
    public function actionSdtgioithieu(){
        if(!Yii::$app->user->isGuest && isset($_POST['sdt']) && ($_POST['sdt']!=Yii::$app->user->identity->phone) && (empty(Yii::$app->user->identity->supplier_invoice)||is_null(Yii::$app->user->identity->supplier_invoice))){
            if(!is_null(User::findOne(['phone'=>$_POST['sdt']])))
                return User::updateAll(['supplier_invoice'=>$_POST['sdt']],["id"=>Yii::$app->user->id]);
        }
        return false;
    }

    public function actionDangkykham(){
        return $this->render("dangkykham/index");
    }

    public function actionRating(){

        if(isset($_POST["rating_data"]))
        {

            $data = array(
                ':user_name'		=>	$_POST["user_name"],
                ':user_rating'		=>	$_POST["rating_data"],
                ':user_review'		=>	$_POST["user_review"],
                ':datetime'			=>	time()
            );

            $reviewtable = new  ReviewTable();
            $reviewtable->user_name = $_POST["user_name"];
            $reviewtable->user_rating = $_POST["rating_data"];
            $reviewtable->user_review = $_POST["user_review"];
            $reviewtable->datetime = time();
            $reviewtable->save();

            echo "Your Review & Rating Successfully Submitted";

        }

        if(isset($_POST["action"]))
        {
            $average_rating = 0;
            $total_review = 0;
            $five_star_review = 0;
            $four_star_review = 0;
            $three_star_review = 0;
            $two_star_review = 0;
            $one_star_review = 0;
            $total_user_rating = 0;
            $review_content = array();
            $query = ReviewTable::find()->orderBy('review_id desc')->all();
            if(!is_null($query)) {
                foreach($query as $row)
                {
                    $review_content[] = array(
                        'user_name'		=>	$row["user_name"],
                        'user_review'	=>	$row["user_review"],
                        'rating'		=>	$row["user_rating"],
                        'datetime'		=>	date('d-m-Y H:i:s', $row["datetime"])
                    );

                    if($row["user_rating"] == '5')
                    {
                        $five_star_review++;
                    }

                    if($row["user_rating"] == '4')
                    {
                        $four_star_review++;
                    }

                    if($row["user_rating"] == '3')
                    {
                        $three_star_review++;
                    }

                    if($row["user_rating"] == '2')
                    {
                        $two_star_review++;
                    }

                    if($row["user_rating"] == '1')
                    {
                        $one_star_review++;
                    }

                    $total_review++;

                    $total_user_rating = $total_user_rating + $row["user_rating"];

                }
            }


            $average_rating = $total_user_rating / $total_review;

            $output = array(
                'average_rating'	=>	number_format($average_rating, 1),
                'total_review'		=>	$total_review,
                'five_star_review'	=>	$five_star_review,
                'four_star_review'	=>	$four_star_review,
                'three_star_review'	=>	$three_star_review,
                'two_star_review'	=>	$two_star_review,
                'one_star_review'	=>	$one_star_review,
                'review_data'		=>	$review_content
            );

            echo json_encode($output);

        }

    }

    public function actionDanhgia(){
        if(isset($_POST["poll_option"]))
        {
            $tblpoll =  new  TblPoll();
            $tblpoll->php_framework = $_POST["poll_option"];
            if ($_POST["poll_option"] == "khonghailong") {
                $tblpoll->name = "Không hài lòng";
            } elseif ($_POST["poll_option"] == "binhthuong") {
                $tblpoll->name = "Bình thường";
            } elseif ($_POST["poll_option"] == "hailong") {
                $tblpoll->name = "Hài lòng";
            } else {
                $tblpoll->name = "Rất hài lòng";
            }

            $tblpoll->hoten = \func::super_strip_tag_prevent_injection($_POST["name"]);
            $tblpoll->sdt = \func::super_strip_tag_prevent_injection($_POST["tel"]);
            $tblpoll->email = \func::super_strip_tag_prevent_injection($_POST["email"]);
            $tblpoll->ghichu = \func::super_strip_tag_prevent_injection($_POST["message"]);
            $tblpoll->save();
        }
    }
    public function actionTinhtoandanhgia(){
        $php_framework = ['rathailong', 'hailong', 'binhthuong', 'khonghailong'];
        $total_poll_row = TblPoll::find()->count();

        $getname = '';
        $output = '';

        if ($total_poll_row > 0) {
            $raw = [];

            // 1. Gom dữ liệu gốc và phần trăm chưa làm tròn
            foreach ($php_framework as $row) {
                $count = TblPoll::find()->where(['php_framework' => $row])->count();
                $percent = ($count / $total_poll_row) * 100;
                $raw[] = [
                    'key' => $row,
                    'count' => $count,
                    'percent' => $percent,
                    'floor' => floor($percent),
                    'fraction' => $percent - floor($percent),
                ];
            }

            // 2. Tổng phần trăm sau khi floor
            $sum_floor = array_sum(array_column($raw, 'floor'));
            $diff = 100 - $sum_floor;

            // 3. Sắp xếp phần lẻ giảm dần
            usort($raw, function ($a, $b) {
                return $b['fraction'] <=> $a['fraction'];
            });

            // 4. Phân phối phần dư cho các mục có phần lẻ cao nhất
            $final = [];
            foreach ($raw as $i => $item) {
                $rounded = $item['floor'];
                if ($diff > 0) {
                    $rounded += 1;
                    $diff--;
                }
                $final[$item['key']] = $rounded;
            }

            // 5. Render ra HTML
            foreach ($php_framework as $row) {
                $percentage_vote = $final[$row] ?? 0;
                $progress_bar_class = '';

                if ($row == "khonghailong") {
                    $getname = "Không hài lòng";
                    $progress_bar_class = "no";
                } elseif ($row == "hailong") {
                    $getname = "Hài lòng";
                    $progress_bar_class = "yes";
                } elseif ($row == "binhthuong") {
                    $getname = "Bình thường";
                    $progress_bar_class = "neutral";
                } else {
                    $getname = "Rất hài lòng";
                    $progress_bar_class = "very-yes";
                }

                $output .= '
            <div class="feedback-row">
                <div class="feedback-label">' . $getname . '</div>
                <div class="feedback-track">
                    <div class="feedback-fill ' . $progress_bar_class . '" style="width: ' . $percentage_vote . '%;"></div>
                </div>
                <div class="feedback-percent">' . $percentage_vote . '%</div>
            </div>';
            }
        }

        return $output;
    }
    public function actionVanbans($danhmucvanban, $id)
    {
        $danhmuc = Danhmucvanban::findOne($id);
        if(is_null($danhmuc)){
            return $this->redirect(['site/error']);
        }

        $query = Vanban::find()->where(['danhmuc'=>$id])->orderBy("id desc");
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => 10),
        ]);

        return $this->render('vanbans/index', ['data'=>$danhmuc,'dataProvider' => $dataProvider]);
    }
    public function actionVideo($id){

        $video = Video::findOne(['id' => $id]);
        /** @var $video Video */
        $recentpost = Video::find()->orderBy('id desc')->all();
        if (!is_null($video)) {
            $tin = News::find()->orderBy('hot DESC')->limit(3)->all();
            return $this->render("video/index", ['data' => $video, 'tin' => $tin]);
        } else
            return $this->redirect(['site/index']);
    }
    public function actionListvideo(){
        return $this->render("video/listvideo");
    }
    public function actionDatcauhoi()
    {
        $secret = "6LdzaIgfAAAAAFc7EDF6pjMsrVqE3Xpu3u8_vPNa";
        $reCaptcha = new \ReCaptcha($secret);
        $request = Yii::$app->request;
        $model = new Datcauhoi();
        $model->load($request->post());
        if (!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
            if (isset($_POST['g-recaptcha-response'])) {
                Yii::$app->session->setFlash('gcaptcha', 'Chưa nhập captcha');
            }
            return $this->render('cauhoi/index', [

                'model' => $model
            ]);
        } else {
            $response = $reCaptcha->verifyResponse(
                $_SERVER["REMOTE_ADDR"],
                $_POST["g-recaptcha-response"]
            );
        }

        if (!$response != null && !$response->success) {
            Yii::$app->session->setFlash('gcaptcha', 'Captcha không có giá trị hoặc Captcha không thuộc trang web này');
            return $this->render('cauhoi/index', [
                'model' => $model
            ]);
        }
        if ($model->load($request->post()) && $model->save()) {
            $model->user_id = 3;
            $file = UploadedFile::getInstance($model,"filedinhkem");
            if(!is_null($file)){
                $namefile = \func::khongdau(time() . '-' . $file->name);
                $pathFile = dirname(dirname(__DIR__)) . '/upload/files/' . $namefile;
                $file->saveAs($pathFile);
                $model->filedinhkem='/upload/files/' . $namefile;
                $model->update();
            }
            $mail = Yii::$app->mailer->compose('layouts/html', ['content' => "Hệ thống thông báo: Quý khách " . $model->hoten . ", email: " . $model->email . " vừa đăng ký tư vấn. Nội dung: " . $model->noidung])
                ->setFrom('karion.coltd@gmail.com')
                ->setTo(Configure::getConfig()['contact_email'])
                ->setSubject("Thông báo (no-reply)");
            try {
                $mail->send();
            } catch (\Exception $e) {

            }
            return $this->redirect(['site/success']);
        } else {

            return $this->render('datcauhoi', [
                'model' => $model
            ]);
        }

    }
    public function actionDatcauhoiid($id)
    {
        $datcauhoi = Datcauhoi::findOne($id);
        if(is_null($datcauhoi)){
            return $this->redirect(['site/error']);
        }
        $recentpost = Video::find()->orderBy('id desc')->all();
        $listcauhoi = Datcauhoi::find()->where(['active'=>1])->orderBy('id desc')->all();
        return $this->render('cauhoi/datcauhoiid', ['data'=>$datcauhoi, 'datavideo'=>$recentpost,'datalistvideo'=>$listcauhoi]);
    }
    public function actionListdatcauhoi()
    {
        $datcauhoi = Datcauhoi::find()->where(['active'=>1])->all();
        if(is_null($datcauhoi)){
            return $this->redirect(['site/error']);
        }
        $recentpost = Video::find()->orderBy('id desc')->all();
        return $this->render('cauhoi/listdatcauhoi', ['data'=>$datcauhoi, 'datavideo'=>$recentpost]);
    }
    protected function listFolderFiles($dir,$parent){
        $ffs = scandir($dir);

        unset($ffs[array_search('.', $ffs, true)]);
        unset($ffs[array_search('..', $ffs, true)]);

        // prevent empty ordered elements
        if (count($ffs) < 1)
            return;

        echo '<ol>';
        foreach($ffs as $ff){
            echo '<li>'.$parent."/".$ff;
            if(is_dir($dir.'/'.$ff)) $this->listFolderFiles($dir.'/'.$ff,$parent."/".$ff."/");
            echo '</li>';
        }
        echo '</ol>';
    }


//    public function actionTimfile(){
//
//        $this->listFolderFiles(dirname(dirname(__DIR__))."/images","/images");
//        $this->listFolderFiles(dirname(dirname(__DIR__))."/vagrant","/vagrant");
//        $this->listFolderFiles(dirname(dirname(__DIR__))."/thumbs","/thumbs");
//        $this->listFolderFiles(dirname(dirname(__DIR__))."/template","/template");
//        $this->listFolderFiles(dirname(dirname(__DIR__))."/source","/source");
//        $this->listFolderFiles(dirname(dirname(__DIR__))."/environments","/environments");
//        $this->listFolderFiles(dirname(dirname(__DIR__))."/console","/console");
//        $this->listFolderFiles(dirname(dirname(__DIR__))."/attachment","/attachment");
//
//    }

    public function actionSodotochuc(){
        return $this->render("sodotochuc");
    }
}
