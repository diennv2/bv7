<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "traloicauhoi".
 *
 * @property int $id
 * @property int $listnhanquaid
 * @property int $cauhoi
 * @property string $cautraloi
 * @property string $dapancuakhach
 * @property int $status
 */
class Traloicauhoi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'traloicauhoi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['listnhanquaid', 'cauhoi', 'cautraloi', 'status'], 'required'],
            [['listnhanquaid', 'cauhoi', 'status'], 'integer'],
            [['cautraloi', 'dapancuakhach'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'listnhanquaid' => 'Listnhanquaid',
            'cauhoi' => 'Cauhoi',
            'cautraloi' => 'Cautraloi',
            'dapancuakhach' => 'Dapancuakhach',
            'status' => 'Status',
        ];
    }
}
