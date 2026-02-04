<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "listnhanqua".
 *
 * @property int $id
 * @property int $billid
 * @property int $productid
 * @property int $isdatraloi
 * @property int $isdanhanqua
 * @property string $ngaynhan
 */
class Listnhanqua extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'listnhanqua';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['billid', 'productid'], 'required'],
            [['billid', 'productid'], 'integer'],
            [['ngaynhan'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'billid' => 'Đơn hàng',
            'productid' => 'Quà đăng ký nhận',
            'ngaynhan' => 'Ngày đăng ký nhận',
        ];
    }
}
