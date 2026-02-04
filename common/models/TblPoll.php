<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_poll".
 *
 * @property int $poll_id
 * @property string $php_framework
 * @property string $name
 * @property string $hoten
 * @property int $sdt
 * @property string $email
 * @property string $ghichu
 */
class TblPoll extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_poll';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['php_framework'], 'required'],
            [['php_framework'], 'string', 'max' => 100],
            [['sdt'],'integer'],
            [['name','email','ghichu','hoten'], 'string'],
            [['email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'poll_id' => 'Poll ID',
            'php_framework' => 'Php Framework',
        ];
    }
}
