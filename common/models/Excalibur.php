<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "excalibur".
 *
 * @property int $id
 * @property int $userid
 * @property int $amount
 * @property string $time
 */
class Excalibur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'excalibur';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'amount'], 'required'],
            [['userid', 'amount'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'amount' => 'Amount',
        ];
    }
}
