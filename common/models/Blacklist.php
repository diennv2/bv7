<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blacklist".
 *
 * @property string $ip
 * @property int $attempt
 * @property int $isblock
 */
class Blacklist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blacklist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip'], 'required'],
            [['attempt', 'isblock'], 'integer'],
            [['ip'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ip' => 'Ip',
            'attempt' => 'Attempt',
            'isblock' => 'Isblock',
        ];
    }
}
