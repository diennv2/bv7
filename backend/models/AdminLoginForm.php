<?php
namespace backend\models;


use common\models\Blacklist;
use Yii;
use yii\base\Model;
/**
 * Login form
 */
class AdminLoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {
        $ip = \func::get_client_ip();
        $model = Blacklist::findOne(['ip' => $ip]);

        if (!is_null($model) && $model->isblock == 1) {
            $this->addError($attribute, 'You are Blocked.');
        } else {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        $ip=\func::get_client_ip();
        $model = Blacklist::findOne(['ip'=>$ip]);
        if ($this->validate() && (is_null($model)||$model->isblock==0)) {
            if(!is_null($model)){
                $model->attempt=0;
                $model->save();
            }
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            if(is_null($model)){
                $new = new Blacklist();
                $new->ip=$ip;
                $new->attempt=1;
                $new->isblock=0;
                $new->save();
                if($new->isblock==0){
                    $this->addError("username","19 attempts remain to block!");
                }
            }else if($model->isblock==0){
                $model->attempt+=1;
                if($model->attempt>=20){
                    $model->isblock=1;
                    $this->addError("username","You are Blocked!");
                }
                $model->save();
                if($model->isblock==0){
                    $this->addError("username",(20-$model->attempt)." attempts remain to block!");
                }
            }else{
                $this->addError("username","You are Blocked!");
            }

            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return Admin|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = \common\models\Admin::findByUsername($this->username);
        }

        return $this->_user;
    }
}
?>

