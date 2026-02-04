<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "goicuoc".
 *
 * @property int $id
 * @property int $user_id
 * @property int $loaidangky
 * @property int $status
 * @property string $time
 * @property string $ngayhethan
 * @property string $ngaydangky
 * @property int $duyet
 */
class Goicuoc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goicuoc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'loaidangky', 'status', 'duyet'], 'integer'],
            [['time', 'ngayhethan', 'ngaydangky'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'loaidangky' => 'Loaidangky',
            'status' => 'Status',
            'time' => 'Time',
            'ngayhethan' => 'Ngayhethan',
            'ngaydangky' => 'Ngaydangky',
            'duyet' => 'Duyet',
        ];
    }
}
