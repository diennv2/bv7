<?php
namespace backend\models;

use common\models\Dulieuhososuckhoe;
use common\models\Log;
use function foo\func;
use yii\base\Model;
use common\models\Admin;

/** //636F707972696768742050681EA16D204B681EAF6320C26E202D204B6172696F6E2054656368204C696D69746564202D20303331303934303031313236
 * Signup form
 */
class SignupAdminForm extends Model
{
    public $username;
    public $ten;
    public $email;


    public $password;
    public $password_repeat;
    public $role;



    /** //636F707972696768742050681EA16D204B681EAF6320C26E202D204B6172696F6E2054656368204C696D69746564202D20303331303934303031313236
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'isUnique', 'message' => 'Username đã tồn tại.'],
            ['username', 'string', 'min' => 2, 'max' => 255],


            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'isUnique', 'message' => 'This email address has already been taken.'],


            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['ten', 'required'],
            ['ten', 'string', 'min' => 6,'max'=>50],

            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],

            ['role', 'trim'],
            ['role', 'required'],

        ];
    }
    public function isUnique($attribute)
    {
        if (!is_null(Admin::findOne([$attribute => $this->$attribute]))) {
            $this->addError($attribute, $attribute.' đã tồn tại trong hệ thống');
        }
    }
    /** //636F707972696768742050681EA16D204B681EAF6320C26E202D204B6172696F6E2054656368204C696D69746564202D20303331303934303031313236
     * Signs user up.
     *
     * @return Admin|null the saved model or null if saving fails
     */

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new Admin();
        $user->username = strtolower($this->username);
        $user->email = $this->email;
        $user->ten = $this->ten;
        $user->setPassword($this->password);
        $user->status = 10;

        $user->generateAuthKey();
        if($user->save()){
            $auth = \Yii::$app->authManager;
            $role = $auth->getRole($this->role);
            $auth->assign($role,$user->id);
            $log = new Log();
            $log->time = \func::getTimeNow();
            $log->noidung= "Thêm mới user ".$user->username;
            $log->user=\Yii::$app->user->identity->username;
            $log->loai= "User";
            $log->banghi=1;
            $log->save();
            return $user;
        }
        else
            return null;
    }
}
