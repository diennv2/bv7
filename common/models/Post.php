<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $userid
 * @property string $content
 * @property int $shareid
 * @property int $like
 * @property string $created
 * @property string $likelist
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'content'], 'required'],
            [['userid', 'shareid', 'like'], 'integer'],
            [['content'], 'string'],
            [['created'], 'safe'],
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
            'content' => 'Content',
            'shareid' => 'Shareid',
            'like' => 'Like',
            'created' => 'Created',
        ];
    }
}
