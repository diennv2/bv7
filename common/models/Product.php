<?php

namespace common\models;

use Codeception\Lib\Interfaces\Queue;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $code
 * @property string $brief
 * @property string $decription
 * @property string $retail
 * @property string $ebook
 * @property string $sale
 * @property string $cuphap
 * @property string $philapdat
 * @property string $kieuthanhtoan
 * @property int $status
 * @property int $ord
 * @property int $home
 * @property int $hot
 * @property int $new
 * @property int $lang_id
 * @property int $luotxem
 * @property int $active
 * @property int $kieudangky
 * @property string $seo_title
 * @property string $seo_desc
 * @property string $seo_keyword
 * @property int $cat_product_id
 * @property int $brand_id

 * @property string $tags
 * @property Anhsanpham[] $anhsanphams
 * @property Brand $brand
 * @property CatProduct $catProduct
 * @property PropertiesvalueProduct[] $propertiesvalueProducts
 * @property TagsProduct[] $tagsProducts
 * @property BillProduct[] $billProducts
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'cat_product_id', 'brand_id', 'status'], 'required'],
            [['url', 'brief', 'decription','ebook', 'seo_desc', 'seo_keyword', 'tag','cuphap','kieuthanhtoan','philapdat','tags'], 'string'],
			[['retail', 'sale'], 'double'],
            [[ 'status', 'ord', 'home', 'hot','new', 'luotxem', 'active', 'cat_product_id', 'brand_id','kieudangky','code'], 'integer'],
            [['name', 'seo_title'], 'string', 'max' => 200],

            [['tag'], 'string', 'max' => 50],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'id']],
            [['cat_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Catproduct::className(), 'targetAttribute' => ['cat_product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên sản phẩm',
            'url' => 'Url',
            'code' => 'Code',
            'brief' => 'Mô tả',
            'decription' => 'Thông số kĩ thuật / hoặc mô tả ngắn nếu là sách',
            'retail' => 'Giá gốc hiển thị chung',
            'sale' => 'Giá bán hiển thị chung',
            'status' => 'Trạng thái',
            'ord' => 'Thứ tự',
            'home' => 'Trang chủ',
            'hot' => 'Là sách',
            'new' => 'Sản phẩm mới',
            'luotxem' => 'User',
            'active' => 'Hiển thị',
            'seo_title' => 'Seo Title',
            'seo_desc' => 'Seo Desc',
            'seo_keyword' => 'Seo Keyword',
            'cat_product_id' => 'Loại sản phẩm',
            'brand_id' => 'Thương hiệu',
            'tag' => 'NOTE NGẮN CHO SẢN PHẨM (MAX 50 KÝ TỰ)',
            'cuphap' => 'THÔNG TIN CỘT PHẢI SẢN PHẨM (nhập dưới dạng danh sách list)',
            'kieudangky' => 'Kiểu đăng ký',
            'philapdat' => 'THÔNG ĐIỆP NHỎ/ KHUYẾN MÃI',
            'kieuthanhtoan' => 'Thông tin nhỏ dưới sản phẩm',
            'tags'=>'Tags',
            'ebook'=>'Ebook'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnhsanphams()
    {
        return $this->hasMany(Anhsanpham::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatProduct()
    {
        return $this->hasOne(Catproduct::className(), ['id' => 'cat_product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertiesvalueProducts()
    {
        return $this->hasMany(Propertiesvalueproduct::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagsProducts()
    {
        return $this->hasMany(Tagsproduct::className(), ['product_id' => 'id']);
    }
    public function getBillProducts()
    {
        return $this->hasMany(BillProduct::className(), ['product_id' => 'id']);
    }
    public function afterSave($insert, $changedAttributes)
    {

        $res = Anhsanpham::find()->where(['product_id'=>$this->id,'default'=>1])->all();
        $files = UploadedFile::getInstancesByName('images');
        foreach ($files as $index=>$file)
        {
            // File and new size
            $tmp = time();
            $tenFile = $tmp.'-'.\func::taoduongdan($file->name);
            $filename = '/images/product/'.$tenFile;
            $thumbfilename = '/images/product/thumb/'.$tenFile;
            $path = dirname(dirname(__DIR__)).$filename;
            $thumbpath = dirname(dirname(__DIR__)).$thumbfilename;

            $imageProduct = new Anhsanpham();
            $imageProduct->image=$filename;

            $imageProduct->thumb=$thumbfilename;

            if (!count($res)) {
                if ($index ==0)
                    $imageProduct->default = 1;
                else
                    $imageProduct->default = 0;
            }

            $imageProduct->product_id = $this->id;
            if ($imageProduct->save()){
                $file->saveAs($path);

                $exploded = explode('.', $imageProduct->image);
                $ext = $exploded[count($exploded) - 1];
                if (!preg_match('/jpg|jpeg/i', $ext)) {

                    if (\func::convertImage($path, $path . ".jpg", 100) == 1) {
                        $imageProduct->image = $imageProduct->image . ".jpg";
                        $imageProduct->thumb=$thumbfilename.".jpg";

                    }
                }

                $imageProduct->save();

                $im = null;
                if (!preg_match('/jpg|jpeg/i', $ext)) {
                    $path = $path . ".jpg";
                }
                if (!preg_match('/jpg|jpeg/i', $ext)) {
                    $thumbpath = $thumbpath . ".jpg";
                }
                $type = exif_imagetype($path); // [] if you don't have exif you could use getImageSize()
                $allowedTypes = [
                    1,  // [] gif
                    2,  // [] jpg
                    3  // [] png
                ];
                if (in_array($type, $allowedTypes)) {
                    switch ($type) {
                        case 1 :
                            $im = imageCreateFromGif($path);
                            break;
                        case 2 :
                            $im = imagecreatefromjpeg($path);
                            break;
                        case 3 :
                            $im = imageCreateFromPng($path);
                            break;
                    }
                }

                list($w,$h) = getimagesize($path);
                $im2 = ImageCreateTrueColor(round($w/($h/260),2) , 260);
                imagecopyResampled ($im2, $im, 0, 0, 0, 0, round($w/($h/260),2), 260, $w, $h);
                switch ($type) {
                    case 1 :
                        imagegif($im2,$thumbpath);
                        break;
                    case 2 :
                        imagejpeg($im2,$thumbpath);
                        break;
                    case 3 :
                        imagepng($im2,$thumbpath);
                        break;
                }

            }
            else
                echo $imageProduct->errors;
        };

        $xoaproperties = Propertiesvalueproduct::find()->where('product_id = :id', [':id' => $this->id])->all();
        if (!$insert) {
            foreach ($xoaproperties as $item) {
                $item->delete();
            }
        }

        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    public function beforeDelete()
    {
        foreach ($this->anhsanphams as $hinhanh)
        {
            $path = dirname(dirname(__DIR__)).$hinhanh->image;
            $thumb = dirname(dirname(__DIR__)).$hinhanh->thumb;
            if (is_file($path))
                if(unlink($path)) {
                    if($hinhanh->thumb!='')
                        unlink($thumb);
                    $hinhanh->delete();
                }
        }
        foreach ($this->billProducts as $bill){
            $bill->delete();
        }
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }


    public static function getImageDefault($id){
        $image = Anhsanpham::find()->where(['product_id'=>$id,'default'=>1])->one();
        if(!is_null($image))
        return $image->image;
        else return "/images/noimg.jpg";
    }
    public static function getImageDefaultThumb($id){
        $image = Anhsanpham::find()->where(['product_id'=>$id,'default'=>1])->one();
        if(!is_null($image))
            return $image->thumb;
        else return "/images/noimg.jpg";
    }

    public function getDefaultImage(){
        $image = Anhsanpham::find()->where(['product_id'=>$this->id,'default'=>1])->one();
        if(!is_null($image))
            return $image->image;
        else return "/images/noimg.jpg";
    }

    public function getDefaultThumbImage(){
        $image = Anhsanpham::find()->where(['product_id'=>$this->id,'default'=>1])->one();
        if(!is_null($image))
            return $image->thumb;
        else return "/images/noimg.jpg";
    }
    public function getDefaultThumbImage2(){
        $image = Anhsanpham::find()->where(['product_id'=>$this->id])->andWhere(["<>","default",1])->one();
        if(!is_null($image))
            return $image->thumb;
        else return "/images/noimg.jpg";
    }

    public static function getProductCat($id){
        $products = Product::find()->where(['cat_product_id'=>$id,'active'=>1])->all();
        return $products;
    }

    public static function getHotProductcat($id){
        $products = Product::find()->where(['cat_product_id'=>$id,'active'=>1,'hot'=>1])->all();
        return $products;
    }

    public static function getHotProduct(){
        return self::find()->where(['active'=>1,'hot'=>1, 'home'=>1])->orderBy(['ord'=>SORT_ASC])->all();
    }

    public static function getNewProduct(){
        $newProduct=self::find()->where(['active'=>1,'home'=>1,'new'=>1])->orderBy(['ord'=>SORT_ASC])->all();
        return$newProduct;
    }

    public function beforeSave($insert)
    {
        $this->url= \func::taoduongdan($this->name);
        if($this->isNewRecord){

            $this->luotxem=Yii::$app->user->identity->id;
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public static function getAllImage($id){
        $imgaes = Anhsanpham::find()->where(['product_id'=>$id])->all();
        if(!empty($imgaes))
            return $imgaes;
        else return [];
    }

    public static function getProperties($id){
        $sanpham = Product::findOne($id);
        $cat = $sanpham->catProduct;
        $detaiproperties=$cat->detailProperties;
        $properties=[];
        foreach ($detaiproperties as $detaiproperty){
            $properties[]=$detaiproperty->properties;
        }
        return $properties;
    }

    public function getLink(){
       return Yii::$app->urlManager->createUrl(['product/detailproduct', 'path' => $this->url, 'id' => $this->id]);
    }
    public function getTopic(){
        return Yii::$app->urlManager->createUrl(['site/topic', 'id' => $this->id]);
    }
    public function getSale(){
        return number_format($this->sale,0,"",".");
    }
    public function getRetail(){
        return number_format($this->retail,0,"",".");
    }
}
