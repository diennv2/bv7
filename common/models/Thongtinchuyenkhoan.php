<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "thongtinchuyenkhoan".
 *
 * @property int $id
 * @property string $chutaikhoan
 * @property string $nganhang
 * @property string $sotaikhoan
 */
class Thongtinchuyenkhoan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'thongtinchuyenkhoan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chutaikhoan', 'nganhang', 'sotaikhoan'], 'required'],
            [['chutaikhoan', 'nganhang', 'sotaikhoan'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'chutaikhoan' => 'Chutaikhoan',
            'nganhang' => 'Nganhang',
            'sotaikhoan' => 'Sotaikhoan',
        ];
    }
}
