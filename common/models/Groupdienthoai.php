<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "groupdienthoai".
 *
 * @property string $hang Hãng sản xuất
 * @property string $tong
 */
class Groupdienthoai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'groupdienthoai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hang'], 'required'],
            [['tong'], 'integer'],
            [['hang'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hang' => 'Hãng sản xuất',
            'tong' => 'Tong',
        ];
    }
}
