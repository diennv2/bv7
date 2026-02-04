<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cauhoi".
 *
 * @property int $id
 * @property string $cauhoi
 * @property string $cautraloia
 * @property int $product_id
 * @property string $cautraloib
 * @property string $cautraloic
 * @property int $dokho
 * @property string $dapan
 */
class Cauhoi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cauhoi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cauhoi', 'cautraloia', 'product_id', 'cautraloib', 'cautraloic', 'dokho', 'dapan'], 'required'],
            [['cauhoi', 'cautraloia', 'cautraloib', 'cautraloic'], 'string'],
            [['product_id', 'dokho'], 'integer'],
            [['dapan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cauhoi' => 'Câu hỏi',
            'cautraloia' => 'Đáp án A',
            'product_id' => 'Product ID',
            'cautraloib' => 'Đáp án B',
            'cautraloic' => 'Đáp án C',
            'dokho' => 'Độ khó',
            'dapan' => 'Đáp án',
        ];
    }
}
