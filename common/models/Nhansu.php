<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "nhansu".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $gmail
 * @property string $phone
 * @property string $facebook
 * @property string $job
 * @property string $capbac
 * @property string $content
 * @property int $ord
 * @property int $active
 * @property int $lang_id
 */
class Nhansu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nhansu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'image', 'ord'], 'required'],
            [['image', 'content','capbac', 'facebook','phone', 'gmail'], 'string'],
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
            'facebook' => 'Link facebook',
            'phone' => 'Số điện thoại',
            'gmail' => 'Mã chuyên ngành',
            'job' => 'Chức danh',
            'content' => 'Nội dung',
            'ord' => 'Thứ tự',
            'active' => 'Kích hoạt',
            'lang_id' => 'Lang ID',
            'capbac' => 'Cấp bậc',
        ];
    }
}
