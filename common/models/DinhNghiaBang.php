<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dinh_nghia_bang".
 *
 * @property int $id
 * @property int $benh_id
 * @property string $tieu_de
 * @property string $mo_ta
 * @property int $nguoi_tao
 * @property string $tao_luc
 *
 * @property Benh $benh
 * @property DinhNghiaCot[] $dinhNghiaCots
 * @property DongDuLieu[] $dongDuLieus
 * @property TaiLieu[] $taiLieus
 */
class DinhNghiaBang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dinh_nghia_bang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['benh_id', 'tieu_de', 'nguoi_tao'], 'required'],
            [['benh_id', 'nguoi_tao'], 'integer'],
            [['mo_ta'], 'string'],
            [['tao_luc'], 'safe'],
            [['tieu_de'], 'string', 'max' => 255],
            [['benh_id'], 'exist', 'skipOnError' => true, 'targetClass' => Benh::className(), 'targetAttribute' => ['benh_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'benh_id' => 'Benh ID',
            'tieu_de' => 'Tieu De',
            'mo_ta' => 'Mo Ta',
            'nguoi_tao' => 'Nguoi Tao',
            'tao_luc' => 'Tao Luc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBenh()
    {
        return $this->hasOne(Benh::className(), ['id' => 'benh_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDinhNghiaCots()
    {
        return $this->hasMany(DinhNghiaCot::className(), ['dinh_nghia_bang_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDongDuLieus()
    {
        return $this->hasMany(DongDuLieu::className(), ['dinh_nghia_bang_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaiLieus()
    {
        return $this->hasMany(TaiLieu::className(), ['dinh_nghia_bang_id' => 'id']);
    }
}
