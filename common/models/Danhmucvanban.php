<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "danhmucvanban".
 *
 * @property int $id
 * @property string $loaivanban
 *
 * @property Vanban[] $vanbans
 */
class Danhmucvanban extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'danhmucvanban';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loaivanban'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Loại Văn bản',
        ];
    }
    public static function getExportColumn(){
        return [
            'id' ,
            'loaivanban'
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVanbans()
    {
        return $this->hasMany(Vanban::className(), ['danhmuc' => 'id']);
    }
}
