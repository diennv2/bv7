<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "userqua".
 *
 * @property int $userid
 * @property int $productid
 */
class Userqua extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userqua';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'productid'], 'integer'],
            [['productid'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => 'Userid',
            'productid' => 'Productid',
        ];
    }
}
