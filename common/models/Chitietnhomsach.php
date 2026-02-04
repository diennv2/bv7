<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "chitietnhomsach".
 *
 * @property int $id
 * @property int $product_id
 * @property int $nhomid
 */
class Chitietnhomsach extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chitietnhomsach';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'nhomid'], 'required'],
            [['product_id', 'nhomid'], 'integer'],
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
            'nhomid' => 'Nhomid',
        ];
    }
}
