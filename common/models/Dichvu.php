<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dichvu".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $job
 * @property string $content
 * @property int $ord
 * @property int $active
 * @property int $lang_id
 */
class Dichvu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dichvu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'image', 'ord'], 'required'],
            [['image', 'content'], 'string'],
            [['ord', 'active', 'lang_id'], 'integer'],
            [['name', 'job'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'image' => 'Hình ảnh',
            'job' => 'Chức vụ',
            'content' => 'Mô tả',
            'ord' => 'Thứ tự',
            'active' => 'Hoạt động',
            'lang_id' => 'Lang ID',
        ];
    }
}
