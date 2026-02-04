<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "review_table".
 *
 * @property int $review_id
 * @property string $user_name
 * @property int $user_rating
 * @property string $user_review
 * @property int $datetime
 */
class ReviewTable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'review_table';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_name', 'user_rating', 'user_review', 'datetime'], 'required'],
            [['user_rating', 'datetime'], 'integer'],
            [['user_review'], 'string'],
            [['user_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'review_id' => 'Review ID',
            'user_name' => 'User Name',
            'user_rating' => 'User Rating',
            'user_review' => 'User Review',
            'datetime' => 'Datetime',
        ];
    }
}
