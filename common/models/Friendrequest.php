<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "friendrequest".
 *
 * @property int $id
 * @property int $userid
 * @property int $friendid
 */
class Friendrequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'friendrequest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'friendid'], 'integer'],
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
            'friendid' => 'Friendid',
        ];
    }
}
