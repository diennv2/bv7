<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lydokhongdy".
 *
 * @property int $id
 * @property string $name Lý do
 * @property int $vt_chuongtrinhhappycall_id
 *
 * @property Chuongtrinhhappycall $vtChuongtrinhhappycall
 */
class Lydokhongdy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lydokhongdy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'vt_chuongtrinhhappycall_id'], 'required'],
            [['name'], 'string'],
            [['vt_chuongtrinhhappycall_id'], 'integer'],
            [['vt_chuongtrinhhappycall_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chuongtrinhhappycall::className(), 'targetAttribute' => ['vt_chuongtrinhhappycall_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Lý do',
            'vt_chuongtrinhhappycall_id' => 'Vt Chuongtrinhhappycall ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtChuongtrinhhappycall()
    {
        return $this->hasOne(Chuongtrinhhappycall::className(), ['id' => 'vt_chuongtrinhhappycall_id']);
    }
}
