<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property int $id
 * @property string $time
 * @property string $noidung
 * @property string $user
 * @property string $loai
 * @property int $banghi
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time', 'noidung', 'user', 'loai'], 'required'],
            [['noidung'], 'string'],
            [['banghi'], 'integer'],
            [['time', 'user'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time',
            'noidung' => 'Noidung',
            'user' => 'User',
            'loai' => 'Loại',
            'banghi' => 'Bản Ghi',
        ];
    }
}
