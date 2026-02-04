<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * ThayPass form
 */
class ChangeAccountDetailForm extends Model
{
    public $address;
    public $address2;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'address',
                    'address2',
                ],
                'trim'
            ],

            ['address', 'required', 'message'=>'Address cannot be blanked.'],

            ['address', 'string', 'max' => 500],
            ['address2', 'string', 'max' => 500],
        ];
    }


    public function changeInformation()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = User::findOne(\Yii::$app->user->identity->getId());

        $user->address = $this->address;
        $user->address2 = $this->address2;
        return $user->save();
    }
}
