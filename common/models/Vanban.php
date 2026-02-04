<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vanban".
 *
 * @property int $id
 * @property string $mavanban
 * @property string $ngayvanban
 * @property string $trichyeu
 * @property string $filedinhkem
 * @property int $active
 * @property int $home
 * @property int $danhmuc
 *
 * @property Danhmucvanban $danhmuc0
 */
class Vanban extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vanban';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mavanban', 'trichyeu', 'danhmuc'], 'required'],
            [['mavanban', 'trichyeu', 'filedinhkem'], 'string'],
            [['ngayvanban'], 'safe'],
            [['active', 'home', 'danhmuc'], 'integer'],
            [['danhmuc'], 'exist', 'skipOnError' => true, 'targetClass' => Danhmucvanban::className(), 'targetAttribute' => ['danhmuc' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mavanban' => 'Mavanban',
            'ngayvanban' => 'Ngayvanban',
            'trichyeu' => 'Trichyeu',
            'filedinhkem' => 'Filedinhkem',
            'active' => 'Active',
            'home' => 'Home',
            'danhmuc' => 'Danhmuc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDanhmuc0()
    {
        return $this->hasOne(Danhmucvanban::className(), ['id' => 'danhmuc']);
    }
}
