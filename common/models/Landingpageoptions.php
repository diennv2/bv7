<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "landingpageoptions".
 *
 * @property int $id
 * @property string $type
 * @property string $value
 * @property string $valuemobile
 * @property string $target
 * @property int $landing_id
 * @property int $order
 * @property string $backgroundimage
 */
class Landingpageoptions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'landingpageoptions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'value', 'valuemobile', 'target', 'landing_id'], 'required'],
            [['target','backgroundimage'], 'string'],
            [['landing_id','order'], 'integer'],
            [['type', 'value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'value' => 'Value',
            'valuemobile' => 'Ảnh mobile',
            'target' => 'ID đối tượng HTML',
            'landing_id' => 'Landing ID',
            'backgroundimage'=>'Background Image',
            'order'=>'Thứ tự'
        ];
    }
}
