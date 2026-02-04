<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "datlichkham".
 *
 * @property int $id
 * @property string $hoten Tên liên hệ
 * @property string $dienthoai Điện thoại
 * @property string $noidung Nội dung
 * @property string $email email
 * @property int $status
 * @property string $time
 * @property string $tieude
 * @property string $donvi
 * @property string $ngaykham
 */
class Datlichkham extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'datlichkham';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['donvi','hoten', 'dienthoai', 'noidung','ngaykham', 'email',  'status'], 'required'],
            [['donvi','hoten', 'noidung'], 'string'],
            [['status'], 'integer'],
            [['time'], 'safe'],
            [['dienthoai'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 50],
            [['tieude'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'donvi' => 'Đơn vị',
            'hoten' => 'Họ và tên',
            'dienthoai' => 'Số điện thoại',
            'noidung' => 'Nội dung',
            'email' => 'Email',
            'status' => 'Trạng thái',
            'time' => 'Time',
            'tieude' => 'Tiêu đề',
            'ngaykham' => 'Ngày khám'
        ];
    }
}
