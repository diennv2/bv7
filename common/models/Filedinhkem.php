<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "filedinhkem".
 *
 * @property int $id
 * @property string $tenfile
 * @property string $thumb
 * @property int $ord
 * @property int $default
 * @property int $lienhe_id
 *
 * @property Lienhetuvan $lienhe
 */
class Filedinhkem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'filedinhkem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tenfile', 'thumb'], 'string'],
            [['ord', 'default', 'lienhe_id'], 'integer'],
            [['lienhe_id'], 'required'],
            [['lienhe_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lienhetuvan::className(), 'targetAttribute' => ['lienhe_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tenfile' => 'Tenfile',
            'thumb' => 'Thumb',
            'ord' => 'Ord',
            'default' => 'Default',
            'lienhe_id' => 'Lienhe ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLienhe()
    {
        return $this->hasOne(Lienhetuvan::className(), ['id' => 'lienhe_id']);
    }
}
