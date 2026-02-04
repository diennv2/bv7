<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tinhthanh".
 *
 * @property int $id
 * @property string $ten
 *
 * @property Quanhuyen[] $quanhuyens
 */
class Tinhthanh extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tinhthanh';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ten'], 'required'],
            [['id'], 'integer'],
            [['ten'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ten' => 'Ten',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuanhuyens()
    {
        return $this->hasMany(Quanhuyen::className(), ['tinhthanh_id' => 'id']);
    }

    public static function getListTinhThanhForDropdown(){
        return ArrayHelper::map(Tinhthanh::find()->orderBy('ten asc')->all(),'ten','ten');
    }
}
