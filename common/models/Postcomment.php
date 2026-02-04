<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "postcomment".
 *
 * @property int $id
 * @property string $comment
 * @property int $replyid
 * @property int $postid
 * @property int $userid
 */
class Postcomment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'postcomment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment', 'postid', 'userid'], 'required'],
            [['comment'], 'string'],
            [['replyid', 'postid', 'userid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment' => 'Comment',
            'replyid' => 'Replyid',
            'postid' => 'Postid',
            'userid' => 'Userid',
        ];
    }
}
