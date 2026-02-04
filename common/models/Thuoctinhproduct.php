<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "thuoctinhproduct".
 *
 * @property int $id
 * @property int $product_id
 * @property string $thuoctinh_id
 * @property int $gia
 * @property bool $conhang
 * @property int $giagoc
 */
class Thuoctinhproduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'thuoctinhproduct';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'thuoctinh_id', 'gia', 'giagoc'], 'required'],
            [['product_id', 'gia', 'giagoc'], 'integer'],
            [['thuoctinh_id'], 'string'],
            [['conhang'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'thuoctinh_id' => 'Thuoctinh ID',
            'gia' => 'Giá bán',
            'conhang' => 'Còn hàng',
            'giagoc' => 'Giá gốc',
        ];
    }
}
