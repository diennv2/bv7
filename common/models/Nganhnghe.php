<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "nganhnghe".
 *
 * @property int $id
 * @property string $ten
 */
class Nganhnghe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nganhnghe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ten'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ten' => 'Ten',
        ];
    }
    public static function getListNganhNghe()
    {
        $lists = [];
        $parents = Nganhnghe::find()->all();

        foreach ($parents as $parent) {
            $lists[$parent->id] = $parent->ten;
        }
        return $lists;
    }
}
