<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tai_lieu".
 *
 * @property int $id
 * @property int $benh_id
 * @property int $dinh_nghia_bang_id
 * @property string $tieu_de
 * @property string $duong_dan
 * @property string $loai
 * @property int $nguoi_tai
 * @property string $tai_luc
 *
 * @property Benh $benh
 * @property DinhNghiaBang $dinhNghiaBang
 */
class TaiLieu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tai_lieu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['benh_id', 'dinh_nghia_bang_id', 'nguoi_tai'], 'integer'],
            [['duong_dan', 'nguoi_tai'], 'required'],
            [['tai_luc'], 'safe'],
            [['tieu_de'], 'string', 'max' => 255],
            [['duong_dan'], 'string', 'max' => 1024],
            [['loai'], 'string', 'max' => 50],
            [['benh_id'], 'exist', 'skipOnError' => true, 'targetClass' => Benh::className(), 'targetAttribute' => ['benh_id' => 'id']],
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
            'benh_id' => 'Benh ID',
            'dinh_nghia_bang_id' => 'Dinh Nghia Bang ID',
            'tieu_de' => 'Tieu De',
            'duong_dan' => 'Duong Dan',
            'loai' => 'Loai',
            'nguoi_tai' => 'Nguoi Tai',
            'tai_luc' => 'Tai Luc',
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
    public function getDinhNghiaBang()
    {
        return $this->hasOne(DinhNghiaBang::className(), ['id' => 'dinh_nghia_bang_id']);
    }
}
