<?php


namespace frontend\models;


use yii\base\Model;

class GoiCuocForm extends Model
{
    public $user_id;
    public $loaidangky;
    public $status;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['loaidangky'], 'required'],
        ];
    }

}