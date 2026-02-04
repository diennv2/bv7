<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "topic".
 *
 * @property int $id
 * @property string $name
 * @property int $userid
 * @property int $sachid
 * @property string $image
 * @property int $luotxem
 * @property int $luotbinhluan
 * @property string $ngaytao
 * @property string $noidung
 * @property string $brief
 */
class Topic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $imageUpload;
    public static function tableName()
    {
        return 'topic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required','message'=>'Tiêu đề không được trống, tối đa 500 ký tự!'],
            [['brief'], 'required','message'=>'Mô tả ngắn không được trống, tối đa 500 ký tự!'],
            [['userid', 'sachid', 'luotxem', 'luotbinhluan'], 'integer'],
            [['image', 'noidung','brief'], 'string'],
            [['ngaytao'], 'safe'],
            [['name'], 'string', 'max' => 500,'tooLong'=>'Tiêu đề tối đa 500 ký tự!'],
            [['brief'], 'string', 'max' => 255,'tooLong'=>'Mô tả ngắn tối đa 255 ký tự!'],
            ['imageUpload', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 3,'tooBig'=>'File ảnh tối đa 3 MB'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tiêu đề topic',
            'userid' => 'Userid',
            'sachid' => 'Sachid',
            'image' => 'Hình ảnh',
            'luotxem' => 'Luotxem',
            'luotbinhluan' => 'Luotbinhluan',
            'ngaytao' => 'Ngaytao',
            'noidung' => 'Nội dung topic',
            'brief' => 'Mô tả ngắn',
        ];
    }
    public function getUrl(){
        return Yii::$app->urlManager->createUrl(['site/viewtopic','id'=>$this->id,'name'=>\func::taoduongdan(substr($this->name,0,50))]);
    }
}
