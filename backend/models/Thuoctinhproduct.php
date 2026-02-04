<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "thuoctinhproduct".
 *
 * @property int $id
 * @property int $product_id
 * @property int $thuoctinh_id
 * @property int $gia
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
            [['product_id', 'thuoctinh_id', 'gia'], 'required'],
            [['product_id', 'thuoctinh_id', 'gia'], 'integer'],
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
            'gia' => 'Gia',
        ];
    }
}
