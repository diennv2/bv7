<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "loaithuoctinh".
 *
 * @property int $id
 * @property string $tenloai
 *
 * @property Thuoctinh[] $thuoctinhs
 */
class Loaithuoctinh extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loaithuoctinh';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tenloai'], 'required'],
            [['tenloai'], 'string', 'max' => 100],
            [['tenloai'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tenloai' => 'Tenloai',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThuoctinhs()
    {
        return $this->hasMany(Thuoctinh::className(), ['loaithuoctinh_id' => 'id']);
    }
}
