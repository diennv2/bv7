<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lienhetuvan".
 *
 * @property int $id
 * @property string $donvi Tên đơn vị
 * @property string $hoten Tên liên hệ
 * @property string $dienthoai Điện thoại
 * @property string $noidung Nội dung
 * @property string $email email
 */
class Lienhetuvan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lienhetuvan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['donvi', 'hoten', 'dienthoai', 'noidung', 'email'], 'required'],
            [['donvi', 'hoten', 'noidung'], 'string'],
            [['dienthoai'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'donvi' => 'Tên đơn vị',
            'hoten' => 'Tên liên hệ',
            'dienthoai' => 'Điện thoại',
            'noidung' => 'Nội dung',
            'email' => 'Email',
        ];
    }
}
