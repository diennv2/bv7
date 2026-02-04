<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * ThayPass form
 */
class ChangePasswordForm extends Model
{
    public $old_password;
    public $password;
    public $password_repeat;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old_password','password','password_repeat'], 'required'],
            [['old_password','password'], 'string', 'min' => 6],
            ['old_password', 'findPasswords'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Confirm password don't match!" ],
        ];
    }

    public function attributeLabels(){
        return [
            'old_password'=>'Current Password',
            'password'=>'New Password',
            'password_repeat'=>'Confirm New Password',
        ];
    }

    public function findPasswords()
    {
        $user = User::findByUsername(\Yii::$app->user->identity->username);
        if(\Yii::$app->security->validatePassword($this->old_password,$user->password_hash)==false)
            $this->addError("old_password","Incorrect Password.");
    }

    public function changePassword()
    {
        $user = User::findOne(\Yii::$app->user->identity->getId());
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }
}
