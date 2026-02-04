<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ykienphananh".
 *
 * @property int $id
 * @property string $ngaylap
 * @property string $ten
 * @property string $sdt
 * @property string $noidung
 * @property string $address
 * @property int $status
 * @property string $email
 * @property int $dathanhtoan
 */
class Ykienphananh extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ykienphananh';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ngaylap', 'ten', 'sdt', 'status', 'email'], 'required'],
            [['ngaylap'], 'safe'],
            [['noidung', 'address'], 'string'],
            [['status', 'dathanhtoan'], 'integer'],
            [['ten'], 'string', 'max' => 500],
            [['sdt'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ngaylap' => 'Ngaylap',
            'ten' => 'Ten',
            'sdt' => 'Sdt',
            'noidung' => 'Noidung',
            'address' => 'Address',
            'status' => 'Status',
            'email' => 'Email',
            'dathanhtoan' => 'Dathanhtoan',
        ];
    }
}
