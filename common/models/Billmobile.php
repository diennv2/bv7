<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "billmobile".
 *
 * @property int $id
 * @property string $ngaylap
 * @property string $gioitinh
 * @property string $ten
 * @property string $sdt
 * @property string $yeucaukhac
 * @property string $type
 * @property string $address
 * @property string $tinhthanh
 * @property string $quanhuyen
 * @property string $phuongxa
 * @property string $nguoinhanhang
 * @property string $nguoinhanhangsdt
 * @property int $chuyendanhba
 * @property string $mangdtkhac
 * @property string $xuathoadontencty
 * @property string $xuathoadondiachi
 * @property string $xuathoadonmst
 * @property int $status
 * @property int $vat
 * @property int $tongsauvat
 * @property int $dathanhtoan
 * @property int $nhanquastatus
 * @property string $product
 * @property string $typethanhtoan
 * @property string $email
 */
class Billmobile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'billmobile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ngaylap', 'gioitinh', 'ten', 'sdt', 'type', 'status', 'product', 'typethanhtoan'], 'required'],
            [['ngaylap'], 'safe'],
            [['yeucaukhac', 'address', 'mangdtkhac', 'xuathoadontencty', 'xuathoadondiachi', 'xuathoadonmst', 'product','email'], 'string'],
            [['chuyendanhba', 'status','vat','tongsauvat','dathanhtoan'], 'integer'],
            [['gioitinh', 'type', 'tinhthanh', 'quanhuyen', 'phuongxa', 'typethanhtoan'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 250],
            [['ten', 'nguoinhanhang'], 'string', 'max' => 500],
            [['sdt', 'nguoinhanhangsdt'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ngaylap' => 'Ngày lập',
            'gioitinh' => 'Danh xưng',
            'ten' => 'Tên',
            'sdt' => 'Sdt',
            'yeucaukhac' => 'Yêu cầu khác',
            'type' => 'Phương thức nhận hàng',
            'address' => 'Địa chỉ',
            'tinhthanh' => 'Tỉnh/Thành phố',
            'quanhuyen' => 'Quận/Huyện',
            'phuongxa' => 'Phường/Xã',
            'nguoinhanhang' => 'Người nhận hàng thay',
            'nguoinhanhangsdt' => 'SDT người nhận hàng thay',
            'chuyendanhba' => 'Yêu cầu chuyển danh bạ',
            'mangdtkhac' => 'Cú pháp chuyển khoản',
            'xuathoadontencty' => 'Xuất hóa đơn công ty',
            'xuathoadondiachi' => 'Địa chỉ xuất hóa đơn',
            'xuathoadonmst' => 'MST xuất hóa đơn',
            'status' => 'Trạng thái',
            'product' => 'Sản phẩm đặt',
            'typethanhtoan' => 'Kiểu thanh toán',
            'dathanhtoan' => 'Đã thanh toán',
            'vat'=>'VAT',
            'tongsauvat'=>'Tổng sau VAT',
            'email'=>'Email'
        ];
    }
}
