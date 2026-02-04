<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "coinexchange".
 *
 * @property int $id
 * @property int $userid
 * @property int $sodiem
 * @property string $phonenumber
 * @property string $brand
 * @property string $type
 * @property string $transaction_id
 * @property string $service
 * @property int $status
 * @property int $sotienthanhcong
 * @property string $mess
 * @property string $time
 * @property string $successtime
 */
class Coinexchange extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $arrayBrand = [
//        "VMS"=>'Mobifone',
//        "VNP"=>'Vinaphone',
        "VTT"=>'Viettel',
//        "VNM"=>'Vietnammobile',
    ];
    public $arrayType = [
        "PRE_PAID"=>'Trả trước',
        "POST_PAID"=>'Trả sau',
    ];

    public static function tableName()
    {
        return 'coinexchange';
    }

    public $statusArray=[
      0=>'Đang chờ duyệt',
      1=>'Thành công',
      2=>'Thất bại',
      3=>'Bị từ chối',
      4=>'Đã được duyệt, chờ kết quả!'
    ];
    public $statusDuyetArray=[
        0=>'Đang chờ duyệt',
        4=>'Duyệt',
        2=>'Từ chối'
    ];
    public $statusClass=[
        0=>'label label-info',
        1=>'label label-success',
        2=>'label label-warning',
        3=>'label label-danger',
        4=>'label label-primary'
    ];
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'sodiem', 'phonenumber', 'brand', 'type', 'transaction_id', 'service', 'status', 'sotienthanhcong', 'mess'], 'required'],
            [['userid', 'sodiem', 'status', 'sotienthanhcong'], 'integer'],
            [['mess'], 'string'],
            [['time', 'successtime'], 'safe'],
            [['phonenumber', 'brand', 'type', 'transaction_id', 'service'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'User',
            'sodiem' => 'Số tiền',
            'phonenumber' => 'Số điện thoại',
            'brand' => 'Nhà mạng',
            'type' => 'Kiểu',
            'transaction_id' => 'Transaction ID',
            'service' => 'Service',
            'status' => 'Trạng thái',
            'sotienthanhcong' => 'Số tiền nạp thành công',
            'mess' => 'Ghi chú',
            'time' => 'Thời gian quy đổi',
            'successtime' => 'Thời gian duyệt',
        ];
    }
    public function getBrand(){
        return (isset($this->arrayBrand[$this->brand]))?$this->arrayBrand[$this->brand]:"#N/A";
    }
    public function getType(){
        return (isset($this->arrayType[$this->type]))?$this->arrayType[$this->type]:"#N/A";
    }
    public function getStatusText(){
        return "<span class='".$this->statusClass[$this->status]."'>".$this->statusArray[$this->status]."</span>";
    }
}
