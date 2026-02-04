<?php
namespace backend\models;

use yii\base\Model;
use common\models\Admin;

/**
 * ThayPass form
 */
class ThayPass extends Model
{
    public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }


    public function setPassword()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new Admin();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->status = 0;
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
