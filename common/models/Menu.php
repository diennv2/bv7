<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property string $name
 * @property int $position
 * @property string $type
 * @property string $link
 * @property int $parent
 * @property int $ord
 * @property int $new_tab
 * @property int $active
 * @property int $menustyle
 * @property string $symbol
 * @property string $background
 * @property string $background1
 * @property int $lang_id
 *
 * @property Menu $parent0
 * @property Menu[] $menus
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position', 'parent', 'ord', 'new_tab', 'active', 'lang_id', 'menustyle'], 'integer'],
            [['link'], 'string'],
            [['name'], 'string', 'max' => 200],
            [['background', 'background1'], 'string', 'max' => 300],
            [['type'], 'string', 'max' => 45],
            [['symbol'], 'string', 'max' => 50],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['parent' => 'id']],
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
            'position' => 'Là cơ cấu tổ chức',
            'type' => 'Kiểu',
            'link' => 'Đường dẫn',
            'parent' => 'Menu (Cha)',
            'ord' => 'Thứ tự',
            'new_tab' => 'Mở  tab mới',
            'active' => 'Hoạt động',
            'symbol' => 'Biểu tượng',
            'menustyle' => 'Menu Style',
            'background' => 'Icon (PNG Recommend)',
            'background1' => 'Hình nền',
            'lang_id' => 'Lang ID',
        ];
    }

    public static function getRootMenu($type)
    {
        return self::find()->where(['parent'=>null, 'active'=>1, 'type'=>$type])->orderBy(['ord'=>SORT_ASC])->all();
    }

    public function getChilds()
    {
        return self::find()->where(['parent'=>$this->id, 'active'=>1])->orderBy(['ord'=>SORT_ASC])->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(Menu::className(), ['id' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['parent' => 'id']);
    }
    public static function getMenuByType($type){
        return self::find()->where('type="'.$type.'" and active = 1 order by ord asc')->all();
    }
    public function getUrl(){
        return ((substr($this->link, 0, 4) != "http") ? Yii::$app->urlManager->baseUrl . $this->link : $this->link) ;
    }
}
