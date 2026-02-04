<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lichsutaikhoan".
 *
 * @property int $id
 * @property int $userid
 * @property string $tieude
 * @property string $noidung
 * @property int $amount
 */
class Lichsutaikhoan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lichsutaikhoan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'noidung', 'amount'], 'required'],
            [['userid', 'amount'], 'integer'],
            [['noidung','tieude'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'noidung' => 'Noidung',
            'amount' => 'Amount',
            'tieude' => 'Tieude',
        ];
    }
}
