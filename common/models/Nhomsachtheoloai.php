<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "nhomsachtheoloai".
 *
 * @property int $id
 * @property int $nhomid
 * @property int $sachid
 */
class Nhomsachtheoloai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nhomsachtheoloai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nhomid', 'sachid'], 'required'],
            [['nhomid', 'sachid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nhomid' => 'Nhomid',
            'sachid' => 'Sách',
        ];
    }
}
