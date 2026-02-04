<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "deliveryaddress".
 *
 * @property int $id
 * @property string $city
 * @property string $street
 * @property string $country
 * @property string $firstname
 * @property string $surname
 * @property string $address
 * @property string $address2
 * @property string $phone
 * @property int $macdinh
 * @property int $user
 * @property string $postcode
 */
class Deliveryaddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deliveryaddress';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city', 'country', 'firstname', 'surname', 'address', 'user', 'postcode'], 'required'],
            [['address', 'address2'], 'string'],
            [['macdinh', 'user'], 'integer'],
            [['city', 'street', 'country', 'firstname', 'surname'], 'string', 'max' => 300],
            [['phone'], 'string', 'max' => 20],
            [['postcode'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city' => 'City',
            'street' => 'Street',
            'country' => 'Country',
            'firstname' => 'Firstname',
            'surname' => 'Surname',
            'address' => 'Address',
            'address2' => 'Address2',
            'phone' => 'Phone',
            'macdinh' => 'Macdinh',
            'user' => 'User',
            'postcode' => 'Postcode',
        ];
    }
    public static function getlistDiliver($user){
        $address = self::find()->where(['user'=>$user])->all();
        $adu = User::findOne($user);
        $list=[];
        foreach ($address as$index=>$addres){
            /** @var $addres Deliveryaddress */
            $list['delivery-'.$addres->id]=  $addres->address.' '.$addres->address2.' '.$addres->city.' '.$addres->street.' '.$addres->country.' '.$addres->postcode;
        }
        $list['user-'.$adu->id] = $adu->address.' '.$adu->address2.' '.$adu->city.' '.$adu->street.' '.$adu->country.' '.$adu->postcode;
        return $list;
    }
    public static function getaddress($id){
        $mang = explode('-',$id);

        if ($mang[0]=='delivery'){
            $adds = self::findOne($mang[1]);
            $addess= $adds->firstname.' ' .$adds->surname.': '.$adds->address.' '.$adds->address2.' '.$adds->city.' '.$adds->street.' '.$adds->country.' '.$adds->postcode;
            return $addess;
        }
        else{
            $adds = User::findOne($mang[1]);
            $addesss= $adds->firstname.' '.$adds->surname.': '.$adds->address.' '.$adds->address2.' '.$adds->city.' '.$adds->street.' '.$adds->country.' '.$adds->postcode;
            return $addesss;
        }
    }
    public static function getname($id){
        $name = self::findOne($id);
        $fullname= $name->firstname.' '.$name->surname;
        return $fullname;
    }
    public static function getdt($id){
        $mang = explode('-',$id);

        if ($mang[0]=='delivery'){
            $adds = self::findOne($mang[1]);
            $addess= $adds->phone;
            return $addess;
        }
        else{
            $adds = User::findOne($mang[1]);
            $addesss= $adds->phone;
            return $addesss;
        }
    }

}
