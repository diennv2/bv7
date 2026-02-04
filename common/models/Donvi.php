<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "donvi".
 *
 * @property int $id
 * @property string $companyname
 * @property string $aboutcompany
 */
class Donvi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'donvi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['companyname'], 'required'],
            [['companyname', 'aboutcompany'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'companyname' => 'Tên công ty',
            'aboutcompany' => 'Giới thiệu về công ty',
        ];
    }
}
