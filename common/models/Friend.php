<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "friend".
 *
 * @property int $id
 * @property int $userid
 * @property int $friendid
 */
class Friend extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'friend';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'friendid'], 'integer'],
            [['userid', 'friendid'], 'unique', 'targetAttribute' => ['userid', 'friendid']],
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
