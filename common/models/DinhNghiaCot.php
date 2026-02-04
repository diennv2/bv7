<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dinh_nghia_cot".
 *
 * @property int $id
 * @property int $dinh_nghia_bang_id
 * @property string $ten_cot
 * @property string $khoa
 * @property string $loai
 * @property string $cong_thuc
 * @property int $thu_tu
 * @property string $tao_luc
 *
 * @property DinhNghiaBang $dinhNghiaBang
 */
class DinhNghiaCot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dinh_nghia_cot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dinh_nghia_bang_id', 'ten_cot', 'khoa'], 'required'],
            [['dinh_nghia_bang_id', 'thu_tu'], 'integer'],
            [['cong_thuc'], 'string'],
            [['tao_luc'], 'safe'],
            [['ten_cot'], 'string', 'max' => 191],
            [['khoa'], 'string', 'max' => 100],
            [['loai'], 'string', 'max' => 50],
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
            'ten_cot' => 'Ten Cot',
            'khoa' => 'Khoa',
            'loai' => 'Loai',
            'cong_thuc' => 'Cong Thuc',
            'thu_tu' => 'Thu Tu',
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
