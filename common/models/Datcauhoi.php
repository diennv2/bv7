<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "datcauhoi".
 *
 * @property int $id
 * @property string $tieude Tiêu đề
 * @property string $hoten Tên
 * @property string $noidung Nội dung
 * @property string $email email
 * @property string $filedinhkem
 * @property string $noidungtraloi
 * @property int $user_id
 * @property int $active
 */
class Datcauhoi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'datcauhoi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tieude', 'hoten', 'noidung', 'email'], 'required'],
            [['tieude', 'hoten', 'noidung', 'filedinhkem', 'noidungtraloi'], 'string'],
            [['user_id','active'], 'integer'],
            [['email'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tieude' => 'Tiêu đề',
            'hoten' => 'Tên',
            'noidung' => 'Nội dung',
            'email' => 'Email',
            'filedinhkem' => 'File đính kèm',
            'noidungtraloi' => 'Nội dung trả lời',
            'user_id' => 'Người phụ trách',
            'active'=>'Hiển thị ngoài giao diện'
        ];
    }
}
