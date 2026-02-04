<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "landingpage".
 *
 * @property int $id
 * @property int $active
 * @property string $templatefile
 * @property string $customcss
 * @property string $name
 * @property string $url
 */
class Landingpage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'landingpage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active', 'templatefile', 'name', 'url'], 'required'],
            [['active'], 'integer'],
            [['templatefile', 'customcss', 'name', 'url'], 'string'],
            ['url', 'isUnique', 'message' => 'This email address has already been taken.'],
        ];
    }
    public function isUnique($attribute)
    {
        if (!is_null(Landingpage::findOne([$attribute => $this->$attribute])) && $this->isNewRecord) {
            $this->addError($attribute, $attribute.' đã tồn tại trong hệ thống, phải là duy nhất');
        }else if (!is_null(Landingpage::findOne([$attribute => $this->$attribute,'id <> '.$this->id])) && !$this->isNewRecord) {
            $this->addError($attribute, $attribute.' đã tồn tại trong hệ thống, phải là duy nhất');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'active' => 'Active',
            'templatefile' => 'Templatefile',
            'customcss' => 'SEO Desc',
            'name' => 'SEO Tittle',
            'url' => 'Url',
        ];
    }
}
