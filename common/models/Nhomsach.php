<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "nhomsach".
 *
 * @property int $id
 * @property string $tennhom
 * @property int $douutien
 */
class Nhomsach extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nhomsach';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tennhom', 'douutien'], 'required'],
            [['tennhom'], 'string'],
            [['douutien'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tennhom' => 'Tên nhóm',
            'douutien' => 'Độ ưu tiên',
        ];
    }
}
