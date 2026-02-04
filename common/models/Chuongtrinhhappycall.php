<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "chuongtrinhhappycall".
 *
 * @property int $id Mã Chương Trình
 * @property string $name Tên Chương Trình HappyCall
 * @property string $noidunggoi
 *
 * @property Happycall[] $happycalls
 * @property Lydokhongdy[] $lydokhongdies
 */
class Chuongtrinhhappycall extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chuongtrinhhappycall';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'noidunggoi'], 'required'],
            [['name', 'noidunggoi'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Mã Chương Trình',
            'name' => 'Tên Chương Trình HappyCall',
            'noidunggoi' => 'Nội dung gọi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHappycalls()
    {
        return $this->hasMany(Happycall::className(), ['vt_chuongtrinhhappycall_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLydokhongdies()
    {
        return $this->hasMany(Lydokhongdy::className(), ['vt_chuongtrinhhappycall_id' => 'id']);
    }
}
