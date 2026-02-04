<?php
namespace frontend\models;

use common\models\Admin;
use common\models\Dulieuhososuckhoe;
use yii\base\BaseObject;
use yii\base\Model;
use common\models\User;
use yii\web\UploadedFile;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $ten;
    public $username;
    public $title;
    public $firstname;
    public $surname;
    public $password;
    public $password_repeat;
    public $email;
    public $email_confirm;
    public $phone;
    public $address;
    public $address2;
    public $websiteurl;
    public $city;
    public $street;
    public $postcode;
    public $country;
    public $company;
    public $company_registration_number;
    public $vat_number;
    public $brief;
    public $status;
    public $isdaily;
    public $nganhnghe_id;

    public $file1;
    public $file2;
    public $file3;
    public $file4;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'username',
                    'ten',
                    'email_confirm',
                    'phone',
                    'firstname',
                    'surname',
                    'address',
                    'address2',
                    'websiteurl',
                    'city',
                    'street',
                    'postcode',
                    'country',
                    'company',
                    'vat_number',
                    'company_registration_number',
                    'brief',
                    'isdaily',
                    'nganhnghe_id',
                ],
                'trim'
            ],
//            ['ten', 'required', 'message'=>'Tên đại lý không được rỗng.'],
            ['username', 'required', 'message'=>'Tên tài khoản không được rỗng.'],
//            ['email', 'required', 'message'=>'Email không được rỗng.'],
            ['email_confirm', 'required', 'message'=>'Confirm Email không được rỗng.'],
            /*['phone', 'required', 'message'=>'Số điện thoại không được rỗng.'],*/
            ['password', 'required', 'message'=>'Password không được rỗng.'],
            ['password_repeat', 'required', 'message'=>'Nhập lại password không được rỗng.'],
            /*['firstname', 'required', 'message'=>'Họ và tên không được rỗng.'],*/
            ['surname', 'required', 'message'=>'Surname không được rỗng.'],
            ['address', 'required', 'message'=>'Quận huyện không được rỗng.'],
            ['address2', 'required', 'message'=>'Phường xã không được rỗng.'],
            ['city', 'required', 'message'=>'Tỉnh thành không được rỗng.'],
            ['street', 'required', 'message'=>'Địa chỉ không được rỗng.'],
            ['postcode', 'required', 'message'=>'Postcode không được rỗng.'],
            ['country', 'required', 'message'=>'Country không được rỗng.'],
            ['company', 'required', 'message'=>'Company không được rỗng.'],
            /*['title', 'required', 'message'=>'Danh xưng không được rỗng.'],*/
            ['company_registration_number', 'required', 'message'=>'Company Registration Number không được rỗng.'],


            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'isUnique', 'message' => 'Email đã tồn tại'],

            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'isUnique', 'message' => 'Username đã tồn tại.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['phone', 'string', 'max' => 20],
            [['phone'], 'isUnique'],
            ['firstname', 'string', 'max' => 100],
            ['surname', 'string', 'max' => 100],

            ['websiteurl', 'string', 'max' => 1000],


            ['postcode', 'string', 'max' => 20],
            ['country', 'string', 'max' => 100],
            ['company', 'string', 'max' => 200],
            ['vat_number', 'string', 'max' => 50],
            ['company_registration_number', 'string', 'max' => 50],
            ['brief', 'string', 'max' => 2000],

            [
                [
                    'file1',//$company_registration_certificate
                    'file2',//vat_document
                    'file3',//supplier_invoice
                    'file4',//shop_picture
                ],
                'file',
                'skipOnEmpty' => true,
                'extensions' => 'png, jpg, jpeg, pdf, doc'
            ],

            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Password nhập lại không đúng" ],


        ];
    }
    public function isUnique($attribute)
    {
        if ($this->isdaily == 1) {
            if (!is_null(User::findOne([$attribute => $this->$attribute]))) {
                $this->addError($attribute, $attribute.' đã tồn tại trong hệ thống');
            }
        } else {
            if (!is_null(Admin::findOne([$attribute => $this->$attribute]))) {
                $this->addError($attribute, $attribute.' đã tồn tại trong hệ thống');
            }
        }

    }

    public function signup()
    {

        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user1 = new Admin();
        $user->username = $this->username;
        $user->title = $this->title;
        $user->phone = $this->phone;
        $user->address = $this->address;
        $user->address2 = $this->address2;
        $user->firstname = $this->firstname;
        $user->surname = $this->surname;
        $user->websiteurl = $this->websiteurl;
        $user->city = $this->city;
        $user->street = $this->street;
        $user->postcode = $this->postcode;
        $user->country = $this->country;
        $user->company = $this->company;
        $user->company_registration_number = $this->company_registration_number;
        $user->vat_number = $this->vat_number;
        $user->brief = $this->brief;
        $user->isdaily=$this->isdaily;
        $user->nganhnghe_id=$this->nganhnghe_id;
        $user->status = 10;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        var_dump($this->isdaily);
        if($this->isdaily==2){
            $user->username = $this->username;
            $user->title = $this->title;
            $user->phone = $this->phone;
            $user->address = $this->address;
            $user->address2 = $this->address2;
            $user->firstname = $this->firstname;
            $user->surname = $this->surname;
            $user->websiteurl = $this->websiteurl;
            $user->city = $this->city;
            $user->street = $this->street;
            $user->postcode = $this->postcode;
            $user->country = $this->country;
            $user->company = $this->company;
            $user->company_registration_number = $this->company_registration_number;
            $user->vat_number = $this->vat_number;
            $user->brief = $this->brief;
            $user->isdaily=$this->isdaily;
            $user->nganhnghe_id=$this->nganhnghe_id;
            $user->status = 10;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user1->username = $this->username;
            $user1->email = $this->email;
            $user1->ten = $this->firstname;
            $user1->status = 10;
            $user1->setPassword($this->password);
            $user1->generateAuthKey();
            $user1->save();
        }

        $t = time();
        $temp = '/images/user/'.$user->username.'/';
        $folder = dirname(dirname(__DIR__)).$temp;

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        if (!is_null($this->file1)) {
            $filename = \func::taoduongdan($t. '-1-' . $this->file1->name);
            $user->company_registration_certificate = $temp . $filename;
            $path = $folder.$filename;
            $this->file1->saveAs($path);
        }

        if (!is_null($this->file2)) {
            $filename = \func::taoduongdan($t. '-2-' . $this->file2->name);
            $user->vat_document = $temp . $filename;
            $path = $folder.$filename;
            $this->file2->saveAs($path);
        }

        if (!is_null($this->file3)) {
            $filename = \func::taoduongdan($t. '-3-' . $this->file3->name);
            $user->supplier_invoice = $temp . $filename;
            $path = $folder.$filename;
            $this->file3->saveAs($path);
        }

        if (!is_null($this->file4)) {
            $filename = \func::taoduongdan($t. '-4-' . $this->file4->name);
            $user->shop_picture = $temp . $filename;
            $path = $folder.$filename;
            $this->file4->saveAs($path);
        }
        return $user->save() ? $user : null;
    }

    public function signupByAdmin()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->title = $this->title;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->address = $this->address;
        $user->address2 = $this->address2;
        $user->firstname = $this->firstname;
        $user->surname = $this->surname;
        $user->websiteurl = $this->websiteurl;
        $user->city = $this->city;
        $user->street = $this->street;
        $user->postcode = $this->postcode;
        $user->country = $this->country;
        $user->company = $this->company;
        $user->company_registration_number = $this->company_registration_number;
        $user->vat_number = $this->vat_number;
        $user->brief = $this->brief;
        $user->status = 10;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        $t = time();
        $temp = '/images/user/'.$user->username.'/';
        $folder = dirname(dirname(__DIR__)).$temp;

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
//
//        if (!is_null($this->file1)) {
//            $filename = \func::taoduongdan($t. '-1-' . $this->file1->name);
//            $user->company_registration_certificate = $temp . $filename;
//            $path = $folder.$filename;
//            $this->file1->saveAs($path);
//        }
//
//        if (!is_null($this->file2)) {
//            $filename = \func::taoduongdan($t. '-2-' . $this->file2->name);
//            $user->vat_document = $temp . $filename;
//            $path = $folder.$filename;
//            $this->file2->saveAs($path);
//        }
//
//        if (!is_null($this->file3)) {
//            $filename = \func::taoduongdan($t. '-3-' . $this->file3->name);
//            $user->supplier_invoice = $temp . $filename;
//            $path = $folder.$filename;
//            $this->file3->saveAs($path);
//        }
//
//        if (!is_null($this->file4)) {
//            $filename = \func::taoduongdan($t. '-4-' . $this->file4->name);
//            $user->shop_picture = $temp . $filename;
//            $path = $folder.$filename;
//            $this->file4->saveAs($path);
//        }

        return $user->save() ? $user : null;
    }


    public function signupDaiLy()
    {

        if (!$this->validate()) {
            return null;
        }

        $user = new Admin();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->ten = $this->ten;
        $user->status = 0;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        $t = time();
        $temp = '/images/user/'.$user->username.'/';
        $folder = dirname(dirname(__DIR__)).$temp;

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        return $user->save() ? $user : null;
    }
}
