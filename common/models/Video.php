<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "video".
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $code
 * @property string $path
 * @property int $ord
 * @property int $active
 * @property string $image
 * @property int $hot
 * @property string $posted_date
 *
 * @property TagsVideo[] $tagsVideos
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['ord', 'active','hot'], 'integer'],
            [['name', 'url', 'path'], 'string', 'max' => 200],
            [['image','posted_date'], 'string'],
            [['code'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'hot' => 'Hot',
            'url' => 'Đường dẫn',
            'code' => 'Code',
            'posted_date'=> 'Ngày cập nhật',
            'path' => 'Đường dẫn',
            'ord' => 'Thứ tự',
            'active' => 'Hoạt động',
            'image'=> 'Hình ảnh',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagsVideos()
    {
        return $this->hasMany(TagsVideo::className(), ['video_id' => 'id']);
    }
}
