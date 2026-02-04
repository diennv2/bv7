<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "happycall".
 *
 * @property int $id id
 * @property string $stb Số thuê bao
 * @property string $ngayhpc Ngày  HPC
 * @property string $dongmay Dòng máy
 * @property string $goicuocdata Gói cước data
 * @property string $thoigiandangkygoi Thời gian đăng ký gói
 * @property double $sodutkg Số dư TKG
 * @property string $noidunghappycall Nội dung HPC
 * @property string $ghichu Ghi chú
 * @property int $vt_chuongtrinhhappycall_id
 * @property int $admin_id
 * @property string $donvi
 * @property int $langoi
 * @property string $trangthai
 * @property string $lydo
 * @property string $ngaygoihpc
 * @property string $ngayhen
 * @property int $pending
 * @property string $tongcuocdata
 * @property string $goicuocthuebao
 * @property string $ketquaban
 *
 * @property Admin $admin
 * @property Chuongtrinhhappycall $vtChuongtrinhhappycall
 */
class Happycall extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'happycall';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stb', 'ngayhpc', 'thoigiandangkygoi', 'sodutkg', 'admin_id', 'donvi', 'langoi', 'ngaygoihpc', 'pending'], 'required'],
            [['dongmay', 'goicuocdata', 'noidunghappycall', 'ghichu', 'trangthai', 'lydo', 'goicuocthuebao', 'ketquaban'], 'string'],
            [['sodutkg'], 'number'],
            [['tongcuocdata'], 'number'],
            [['vt_chuongtrinhhappycall_id', 'admin_id', 'langoi', 'pending'], 'integer'],
            [['stb', 'ngayhpc', 'thoigiandangkygoi', 'ngaygoihpc', 'ngayhen'], 'string', 'max' => 45],
            [['donvi'], 'string', 'max' => 200],
            [['admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Admin::className(), 'targetAttribute' => ['admin_id' => 'id']],
            [['vt_chuongtrinhhappycall_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chuongtrinhhappycall::className(), 'targetAttribute' => ['vt_chuongtrinhhappycall_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'stb' => 'Số thuê bao',
            'ngayhpc' => 'Ngày  HPC',
            'dongmay' => 'Dòng máy',
            'goicuocdata' => 'Gói cước data',
            'thoigiandangkygoi' => 'Thời gian đăng ký gói',
            'sodutkg' => 'Số dư TKG',
            'noidunghappycall' => 'Nội dung HPC',
            'ghichu' => 'Ghi chú',
            'vt_chuongtrinhhappycall_id' => 'Vt Chuongtrinhhappycall ID',
            'admin_id' => 'Người xử lý',
            'donvi' => 'Donvi',
            'langoi' => 'Langoi',
            'trangthai' => 'Trangthai',
            'lydo' => 'Lydo',
            'ngaygoihpc' => 'Ngaygoihpc',
            'ngayhen' => 'Ngayhen',
            'pending' => 'Pending',
            'tongcuocdata' => 'Tongcuocdata',
            'goicuocthuebao' => 'Goicuocthuebao',
            'ketquaban' => 'Ketquaban',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(Admin::className(), ['id' => 'admin_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtChuongtrinhhappycall()
    {
        return $this->hasOne(Chuongtrinhhappycall::className(), ['id' => 'vt_chuongtrinhhappycall_id']);
    }
}
