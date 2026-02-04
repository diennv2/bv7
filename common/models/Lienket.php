<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lienket".
 *
 * @property int $id
 * @property string $ten
 * @property string $lienket
 * @property string $hinhanh
 * @property int $active
 */
class Lienket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lienket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lienket', 'hinhanh'], 'string'],
            [['active'], 'integer'],
            [['ten'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ten' => 'Tiêu đề',
            'lienket' => 'Đường dẫn',
            'hinhanh' => 'Hình ảnh',
            'active' => 'Kích hoạt',
        ];
    }
}
