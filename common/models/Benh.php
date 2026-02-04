<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "benh".
 *
 * @property int $id
 * @property string $duong_dan
 * @property string $tieu_de
 * @property string $mo_ta
 * @property int $nguoi_tao
 * @property string $tao_luc
 * @property string $cap_nhat_luc
 *
 * @property DinhNghiaBang[] $dinhNghiaBangs
 * @property TaiLieu[] $taiLieus
 */
class Benh extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'benh';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['duong_dan', 'tieu_de', 'nguoi_tao'], 'required'],
            [['mo_ta'], 'string'],
            [['nguoi_tao'], 'integer'],
            [['tao_luc', 'cap_nhat_luc'], 'safe'],
            [['duong_dan'], 'string', 'max' => 191],
            [['tieu_de'], 'string', 'max' => 255],
            [['duong_dan'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'duong_dan' => 'Duong Dan',
            'tieu_de' => 'Tieu De',
            'mo_ta' => 'Mo Ta',
            'nguoi_tao' => 'Nguoi Tao',
            'tao_luc' => 'Tao Luc',
            'cap_nhat_luc' => 'Cap Nhat Luc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDinhNghiaBangs()
    {
        return $this->hasMany(DinhNghiaBang::className(), ['benh_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaiLieus()
    {
        return $this->hasMany(TaiLieu::className(), ['benh_id' => 'id']);
    }
}
