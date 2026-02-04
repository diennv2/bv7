<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "thuoctinh".
 *
 * @property int $id
 * @property string $tenthuoctinh
 * @property int $loaithuoctinh_id
 *
 * @property Loaithuoctinh $loaithuoctinh
 */
class Thuoctinh extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'thuoctinh';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tenthuoctinh', 'loaithuoctinh_id'], 'required'],
            [['loaithuoctinh_id'], 'integer'],
            [['tenthuoctinh'], 'string', 'max' => 255],
            [['loaithuoctinh_id'], 'exist', 'skipOnError' => true, 'targetClass' => Loaithuoctinh::className(), 'targetAttribute' => ['loaithuoctinh_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tenthuoctinh' => 'Tenthuoctinh',
            'loaithuoctinh_id' => 'Loaithuoctinh ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoaithuoctinh()
    {
        return $this->hasOne(Loaithuoctinh::className(), ['id' => 'loaithuoctinh_id']);
    }
}
