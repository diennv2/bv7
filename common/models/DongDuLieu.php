<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dong_du_lieu".
 *
 * @property int $id
 * @property int $dinh_nghia_bang_id
 * @property string $du_lieu
 * @property int $nguoi_tao
 * @property string $tao_luc
 *
 * @property DinhNghiaBang $dinhNghiaBang
 */
class DongDuLieu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dong_du_lieu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dinh_nghia_bang_id', 'du_lieu', 'nguoi_tao'], 'required'],
            [['dinh_nghia_bang_id', 'nguoi_tao'], 'integer'],
            [['du_lieu'], 'string'],
            [['tao_luc'], 'safe'],
            [['dinh_nghia_bang_id'], 'exist', 'skipOnError' => true, 'targetClass' => DinhNghiaBang::className(), 'targetAttribute' => ['dinh_nghia_bang_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dinh_nghia_bang_id' => 'Dinh Nghia Bang ID',
            'du_lieu' => 'Du Lieu',
            'nguoi_tao' => 'Nguoi Tao',
            'tao_luc' => 'Tao Luc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDinhNghiaBang()
    {
        return $this->hasOne(DinhNghiaBang::className(), ['id' => 'dinh_nghia_bang_id']);
    }
}
