<?php

/**
 * Created by PhpStorm.
 * User: HungLuongCoi
 * Date: 5/18/2015
 * Time: 3:28 PM
 */
class func
{
    public static function VndText($amount)
    {
        if ($amount <= 0) {
            return $textnumber = "Tiền phải là số nguyên dương lớn hơn số 0";
        }
        $Text = array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
        $TextLuythua = array("", "nghìn", "triệu", "tỷ", "ngàn tỷ", "triệu tỷ", "tỷ tỷ");
        $textnumber = "";
        $length = strlen($amount);

        for ($i = 0; $i < $length; $i++)
            $unread[$i] = 0;

        for ($i = 0; $i < $length; $i++) {
            $so = substr($amount, $length - $i - 1, 1);

            if (($so == 0) && ($i % 3 == 0) && ($unread[$i] == 0)) {
                for ($j = $i + 1; $j < $length; $j++) {
                    $so1 = substr($amount, $length - $j - 1, 1);
                    if ($so1 != 0)
                        break;
                }

                if (intval(($j - $i) / 3) > 0) {
                    for ($k = $i; $k < intval(($j - $i) / 3) * 3 + $i; $k++)
                        $unread[$k] = 1;
                }
            }
        }

        for ($i = 0; $i < $length; $i++) {
            $so = substr($amount, $length - $i - 1, 1);
            if ($unread[$i] == 1)
                continue;

            if (($i % 3 == 0) && ($i > 0))
                $textnumber = $TextLuythua[$i / 3] . " " . $textnumber;

            if ($i % 3 == 2)
                $textnumber = 'trăm ' . $textnumber;

            if ($i % 3 == 1)
                $textnumber = 'mươi ' . $textnumber;


            $textnumber = $Text[$so] . " " . $textnumber;
        }

        //Phai de cac ham replace theo dung thu tu nhu the nay
        $textnumber = str_replace("không mươi", "lẻ", $textnumber);
        $textnumber = str_replace("lẻ không", "", $textnumber);
        $textnumber = str_replace("mươi không", "mươi", $textnumber);
        $textnumber = str_replace("một mươi", "mười", $textnumber);
        $textnumber = str_replace("mươi năm", "mươi lăm", $textnumber);
        $textnumber = str_replace("mươi một", "mươi mốt", $textnumber);
        $textnumber = str_replace("mười năm", "mười lăm", $textnumber);

        return ucfirst($textnumber . " đồng chẵn");
    }

    public static function tinhsothang($ngaybatdau, $ngayketthuc)
    {
        if ($ngaybatdau != "" && $ngayketthuc != "") {
            $d1 = new DateTime($ngaybatdau);
            $d2 = new DateTime($ngayketthuc);
            $interval = $d2->diff($d1);
            $years = $interval->format('%y');
            $sothang = $interval->format("%m") + 12 * $years;
            return $sothang;
        }
        return "";
    }

    public static function taoduongdan($str)
    {
        $coDau = array("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ"
        , "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ", "ì", "í", "ị", "ỉ", "ĩ",
            "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ"
        , "ờ", "ớ", "ợ", "ở", "ỡ",
            "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
            "ỳ", "ý", "ỵ", "ỷ", "ỹ",
            "đ",
            "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă"
        , "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ",
            "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ",
            "Ì", "Í", "Ị", "Ỉ", "Ĩ",
            "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ"
        , "Ờ", "Ớ", "Ợ", "Ở", "Ỡ",
            "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ",
            "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ",
            "Đ", "ê", "ù", "à");
        $khongDau = array("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a"
        , "a", "a", "a", "a", "a", "a",
            "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
            "i", "i", "i", "i", "i",
            "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o"
        , "o", "o", "o", "o", "o",
            "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
            "y", "y", "y", "y", "y",
            "d",
            "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A"
        , "A", "A", "A", "A", "A",
            "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E",
            "I", "I", "I", "I", "I",
            "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O"
        , "O", "O", "O", "O", "O",
            "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U",
            "Y", "Y", "Y", "Y", "Y",
            "D", "e", "u", "a");
        $str = str_replace($coDau, $khongDau, $str);
        $str = trim(preg_replace("/\\s+/", " ", $str));
        $str = preg_replace("/[^a-zA-Z0-9 \-\.]/", "", $str);
        $str = strtolower($str);
        return str_replace(".", '-',str_replace(" ", '-', $str));
    }
    public static function Bomaychongupload($string){
        return str_replace(array(' ','(',')','[',']','{','}','<','>',';',':','"',"'",'?','/','\\','|','`','~','!','@','#','$','%','^','&','*','_','+','=','.',','), '', $string);
    }
    protected static $block_ext = [
        "php",
        "php2",
        "php3",
        "php4",
        "php5",
        "php6",
        "php7",
        "phps",
        "phps",
        "pht",
        "phtm",
        "phtml",
        "pgif",
        "shtml",
        "htaccess",
        "phar",
        "inc",
        "hphp",
        "ctp",
        "module",
        "xml",
        "war"
    ];
    protected static $allow_ext = [
        "csv",
        "xlsx",
        "xls",
        "doc",
        "docx",
        "jpg",
        "jpeg",
        "png",
        "webp",
        "pdf",
    ];

    protected static $allowedType = [
        'image/gif',
        'image/jpeg',
        'image/png',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/pdf',
        'application/msword',
        'application/vnd.ms-excel',
    ];
    public static function OnlyNotPhpInFileName($file){
        $file_real_extension_exploded = explode(".",$file->name);
        $file_real_extension = end($file_real_extension_exploded);
        if($file_real_extension!=$file->extension){
            return "error.jpg";
        }
        $antihack_extension = strtolower(self::Bomaychongupload(self::taoduongdan($file->extension)));
        if(!in_array($file->type,self::$allowedType)){
            return "error.jpg";
        }
        if(in_array($antihack_extension,self::$block_ext)){
            return "error.jpg";
        }
        if(!in_array($antihack_extension,self::$allow_ext)){
            return "error.jpg";
        }

        return str_replace(array('.php'), '', self::Bomaychongupload($file->name).".".$antihack_extension);
    }
    public static function tach_ten($hoten)
    {
        $hoten = trim($hoten);
        $str_arr = explode(' ', $hoten);

        $array_hoten = array('ho' => '', 'ten' => '');

        $array_hoten['ten'] = array_pop($str_arr);
        if (count($str_arr) > 0)
            $array_hoten['ho'] = implode(' ', $str_arr);

        return $array_hoten;
    }

    function get_data($url)
    {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public static function trimFields(&$fields = array())
    {
        foreach ($fields as $field) {
            $field = trim($field);
        }
    }


    public static function layThu($thu)
    {
        $thu = strtolower($thu);
        switch ($thu) {
            case 'mon':
                return 2;
            case 'tue':
                return 3;
            case 'wed':
                return 4;
            case 'thu':
                return 5;
            case 'fri':
                return 6;
            case 'sat':
                return 7;
            case 'sun':
                return 8;
        }
    }

    public static function yWeek()
    {
        $date = date('Y-m-d');
        while (date('w', strtotime($date)) != 1) {
            $tmp = strtotime('-1 day', strtotime($date));
            $date = date('Y-m-d', $tmp);
        }

        $week = date('W', strtotime($date));
        return $week;
    }

    public static function khongdau($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
        $str = preg_replace("/(đ)/", "d", $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
        $str = preg_replace("/(Đ)/", "D", $str);
        return $str;
    }

    public static function getTiet()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = getdate();
        $a = 0;
        if ($now["minutes"] > 50 && $now["minutes"] <= 59)
            $a = 1;

        if ($now["hours"] == 7)
            return $a + 1;
        elseif ($now["hours"] == 8)
            return $a + 2;
        elseif ($now["hours"] == 9)
            return $a + 3;
        elseif ($now["hours"] == 10)
            return $a + 4;
        elseif ($now["hours"] == 11)
            return $a + 5;
        elseif ($now["hours"] == 13)
            return $a + 6;
        elseif ($now["hours"] == 14)
            return $a + 7;
        elseif ($now["hours"] == 15)
            return $a + 8;
        elseif ($now["hours"] == 16)
            return $a + 9;
        elseif ($now["hours"] == 17)
            return 10;
        else
            return 0;
    }

    public static function layThu2()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = getdate();
        switch ($now['weekday']) {
            case 'Monday':
                return 2;
            case 'Tuesday':
                return 3;
            case 'Wednesday':
                return 4;
            case 'Thursday':
                return 5;
            case 'Friday':
                return 6;
            case 'Saturday':
                return 7;
            case 'Sunday':
                return 8;
        }
    }

    public static function layThangEnglish($ten)
    {
        switch ($ten) {
            case '1':
                return 'JAN';
            case '2':
                return 'FEB';
            case '3':
                return "MAR";
            case '4':
                return 'APR';
            case '5':
                return 'MAY';
            case '6':
                return 'JUN';
            case '7':
                return 'JUL';
            case '8':
                return 'AUG';
            case '9':
                return 'SEP';
            case '10':
                return "OCT";
            case '11':
                return 'NOV';
            case '12':
                return 'DEC';
        }
    }

    public static function getFileSizeUrl($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE);

        $data = curl_exec($ch);
        $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

        curl_close($ch);
        if ($size != -1) {
            $base = log($size) / log(1024);
            $suffix = array("", "kB", "MB", "GB", "TB")[floor($base)];
            return round(pow(1024, $base - floor($base)), 2) . $suffix;
        } else
            return "N/A";
    }

    public static function Get_ImagesToFolder($dir)
    {
        $ImagesArray = [];
        $file_display = ['jpg', 'jpeg', 'png', 'gif'];
        if (!file_exists($dir)) {
            return $ImagesArray;
        } else {
            $dir_contents = scandir($dir);
            foreach ($dir_contents as $file) {
                $file_type = pathinfo($file, PATHINFO_EXTENSION);
                if (in_array($file_type, $file_display) == true) {
                    $ImagesArray[] = $file;
                }
            }
            return $ImagesArray;
        }
    }

    public static function Get_FilesToFolder($dir)
    {
        $ImagesArray = [];
        if (!file_exists($dir)) {
            return $ImagesArray;
        } else {
            $dir_contents = scandir($dir);
            foreach ($dir_contents as $file) {
                if ($file != '.' && $file != '..')
                    $ImagesArray[] = $file;
            }
            return $ImagesArray;
        }
    }

    public static function createCatProductDragMenu($id,$datas){
        if ($id == 'null') {
            foreach ($datas as $data) {
                if ($data->parent==-1) {
                    $checked = $data->active==1?'checked="checked"':'';
                    $home = $data->home==1?'checked="checked"':'';
                    echo '<li class="dd-item dd3-item" data-id="' . $data->id . '">
                        <div class="dd-handle dd3-handle"> 
                        </div>
                        <div class="dd3-content">
                            ' . $data->name .(($data->menustyle==1)?" <span class='text-danger'>(Chỉ dành cho thành viên)</span>":""). '
                            
                            <a href="' . Yii::$app->urlManager->baseUrl . '/catproduct/capnhat?id=' . $data->id . '" data-pjax="0" role="modal-remote" data-toggle="tooltip" style="float: right" title="Sửa" class="btn-sua-menu" data-id="' . $data->id . '"><i class="fa fa-edit"></i></a>
                            <a style="float: right" title="Xóa" class="btn-xoa-menu" data-id="' . $data->id . '"><i class="fa fa-remove"></i></a>
                            <a style="float: right; padding: 0 5px" href="/admin/catproduct/taomoi?parent='.$data->id.'" title="Create new catproduct" role="modal-remote" style="color:white"><i style="color: #0B61A4" class="glyphicon glyphicon-plus"></i></a>
                            <input style="float: right" type="checkbox" class="active_checkbox" data-id="' . $data->id . '" '.$checked.'><span class="pull-right" style="padding: 0 5px;">Active</span></input> 
                            
                        </div>';
                    self::createCatProductDragMenu($data->id, $datas);
                    echo '</li>';
                }
            }
        } else {
            $temp = 0;
            foreach ($datas as $data) {
                if ($data->parent == $id) {
                    $temp++;

                }
            }
            if ($temp != 0) {
                echo '<ol class="dd-list">';
                foreach ($datas as $data) {
                    if ($data->parent == $id) {
                        $checked = $data->active==1?'checked="checked"':'';
                        $home = $data->home==1?'checked="checked"':'';
                        echo '
                        <li class="dd-item dd3-item" data-id="' . $data->id . '">
                            <div class="dd-handle dd3-handle">
                            </div>
                            <div class="dd3-content">
                                ' . $data->name .(($data->menustyle==1)?" <span class='text-danger'>(Chỉ dành cho thành viên)</span>":"").'
                                
                                <a style="float: right" href="' . Yii::$app->urlManager->baseUrl . '/catproduct/capnhat?id=' . $data->id . '" data-pjax="0" role="modal-remote" data-toggle="tooltip" style="float: right" title="Sửa" class="btn-sua-menu" data-id="' . $data->id . '"><i class="fa fa-edit"></i></a>
                                <a style="float: right" title="Xóa" class="btn-xoa-menu" data-id="' . $data->id . '"><i class="fa fa-remove"></i></a>
                                <a style="float: right; padding: 0 5px" href="/admin/catproduct/taomoi?parent='.$data->id.'" title="Create new catproduct" role="modal-remote" style="color:white"><i style="color: #0B61A4" class="glyphicon glyphicon-plus"></i></a>
                                <a style="float: right; padding: 0 5px" href="/admin/nhomsachtheoloai?id='.$data->id.'" title="Thêm sách tặng" target="_blank" data-pjax="0" style="color:white"><i style="color: #0B61A4" class="glyphicon glyphicon-plus-sign"></i></a>
                                <input style="float: right" type="checkbox" class="active_checkbox"  data-id="' . $data->id . '" '.$checked.'><span class="pull-right" style="padding: 0 5px;">Active</span></input>
                                
                            <input style="float: right" type="checkbox" class="home_checkbox" data-id="' . $data->id . '" '.$home.'><span class="pull-right" style="padding: 0 5px;">Được chọn toàn bộ sách</span></input>
                            </div>';
                        self::createCatProductDragMenu($data->id, $datas);
                        echo '</li>';
                    }
                }
                echo '</ol>';
            }
        }
        return;
    }



    public static function updateCatMenu($id, $datas, $ord)
    {

        if ($id == 'null') {
            foreach ($datas as $data) {
                \common\models\Catproduct::updateAll(['parent' => -1, 'ord' => $ord], ['id' => $data['id']]);
                $ord++;
                if (isset($data['children'])) {
                    self::updateCatMenu($data['id'], $data['children'], ($ord + 1));
                }
            }
        } else {
            foreach ($datas as $data) {
                \common\models\Catproduct::updateAll(['parent' => $id, 'ord' => $ord], ['id' => $data['id']]);
                $ord++;
                if (isset($data['children'])) {
                    self::updateCatMenu($data['id'], $data['children'], ($ord + 1));
                }
            }
        }
        return;
    }

    public static function deleteCatMenu($id)
    {
        $con = \common\models\Catproduct::find()->where('parent = :pr', [':pr' => $id])->all();
        if (!empty($con)) {
            foreach ($con as $cons) {
                self::deleteCatMenu($cons->id);
                \common\models\Catproduct::deleteAll(['id' => $id]);
            }
        }
        \common\models\Catproduct::deleteAll(['id' => $id]);
    }

    public static function createMenu($id, $data)
    {
        if ($id == 'null') {
            foreach ($data as $datas) {
                if (is_null($datas->parent)) {
                    echo '<li class="dd-item dd3-item" data-id="' . $datas->id . '">
                        <div class="dd-handle dd3-handle">
                        
                        </div>
                        <div class="dd3-content">
                            ' . $datas->name . '
                            <a a href="' . Yii::$app->urlManager->baseUrl . '/menu/update?id=' . $datas->id . '" data-pjax="0" role="modal-remote" data-toggle="tooltip" style="float: right" title="Sửa" class="btn-sua-menu" data-id="' . $datas->id . '"><i class="fa fa-edit"></i></a>
                            <a style="float: right" title="Xóa" class="btn-xoa-menu" data-id="' . $datas->id . '"><i class="fa fa-remove"></i></a>
                            </div>';
                    self::createMenu($datas->id, $data);
                    echo '</li>';
                }
            }
        } else {
            $temp = 0;
            foreach ($data as $datas) {
                if ($datas->parent == $id) {
                    $temp++;

                }
            }
            if ($temp != 0) {
                echo '<ol class="dd-list">';
                foreach ($data as $datas) {
                    if ($datas->parent == $id) {
                        echo '
                    <li class="dd-item dd3-item" data-id="' . $datas->id . '">
                        <div class="dd-handle dd3-handle">
                        
                        </div>
                        <div class="dd3-content">
                            ' . $datas->name . '
                            
                            <a a href="' . Yii::$app->urlManager->baseUrl . '/menu/update?id=' . $datas->id . '" data-pjax="0" role="modal-remote" data-toggle="tooltip" style="float: right" title="Sửa" class="btn-sua-menu" data-id="' . $datas->id . '"><i class="fa fa-edit"></i></a>
                            <a style="float: right" title="Xóa" class="btn-xoa-menu" data-id="' . $datas->id . '"><i class="fa fa-remove"></i></a>
                            </div>';
                        self::createMenu($datas->id, $data);
                        echo '</li>';
                    }
                }
                echo '</ol>';
            }
        }
        return;
    }

    public static function updateMenu($id, $data, $ord)
    {

        if ($id == 'null') {
            foreach ($data as $datas) {
                \common\models\Menu::updateAll(['parent' => null, 'ord' => $ord], ['id' => $datas['id']]);
                $ord++;
                if (isset($datas['children'])) {
                    self::updateMenu($datas['id'], $datas['children'], ($ord + 1));
                }
            }
        } else {
            foreach ($data as $datas) {
                \common\models\Menu::updateAll(['parent' => $id, 'ord' => $ord], ['id' => $datas['id']]);
                $ord++;
                if (isset($datas['children'])) {
                    self::updateMenu($datas['id'], $datas['children'], ($ord + 1));
                }
            }
        }
        return;
    }

    public static function deleteMenu($id)
    {
        $con = \common\models\Menu::find()->where('parent = :pr', [':pr' => $id])->all();
        if (!empty($con)) {
            foreach ($con as $cons) {
                self::deleteMenu($cons->id);
                \common\models\Menu::deleteAll(['id' => $id]);
            }
        }
        \common\models\Menu::deleteAll(['id' => $id]);
    }

    public static function getMenu()
    {
        $data = array(
            ['value' => 'link', 'text' => 'Liên kết tĩnh', 'group' => 'Liên kết tĩnh'],
            ['value' => '/', 'text' => '|--Trang chủ', 'group' => 'Liên kết thông thường'],
            ['value' => '/lien-he.html', 'text' => '|--Trang liên hệ', 'group' => 'Liên kết thông thường'],
            ['value' => '/san-pham.html', 'text' => '|--Trang sản phẩm', 'group' => 'Liên kết thông thường'],
        );
        $page = \common\models\Page::find()->where('active = 1')->all();
        foreach ($page as $pages) {
            $new = array();
            $new['value'] = $pages->url;
            $new['text'] = "|--" . $pages->title;
            $new['group'] = 'Trang nội dung';
            $data[] = $new;
        }
        $chuyenkhoa = \common\models\Chuyenkhoa::find()->where('active = 1')->all();
        foreach ($chuyenkhoa as $cat) {
            $new = array();
            $new['value'] = "/" . func::taoduongdan($cat->title) . "-ck" . $cat->id . ".html";
            $new['text'] = "|--" . $cat->title;
            $new['group'] = "Trang chuyên khoa";
            $data[] = $new;
        }
        $danhmucvanban = \common\models\Danhmucvanban::find()->all();
        foreach ($danhmucvanban as $cat) {
            $new = array();
            $new['value'] = "/" . func::taoduongdan($cat->loaivanban) . "-dmvb" . $cat->id . ".html";
            $new['text'] = "|--" . $cat->loaivanban;
            $new['group'] = "Trang Tài liệu";
            $data[] = $new;
        }
        $video = \common\models\Video::find()->all();
        foreach ($video as $videos) {
            $new = array();
            $new['value'] = "/" . func::taoduongdan($videos->name) . "-vd" . $videos->id . ".html";
            $new['text'] = "|--" . $videos->name;
            $new['group'] = "Trang Tài liệu";
            $data[] = $new;
        }
        $catproducts = \common\models\Catproduct::find()->where('parent=-1 and active=1')->all();
        foreach ($catproducts as $cat) {
            $new = array();
            $new['value'] = "/" . $cat->url . "-p" . $cat->id . ".html";
            $new['text'] = "|--" . $cat->name;
            $new['group'] ="Danh mục SP";
            $data[] = $new;
        }
        foreach ($catproducts as $cat) {

            $catproduct = \common\models\Catproduct::getSubCatProduct($cat->id);
            if (!empty($catproduct)) {
                foreach ($catproduct as $pages) {
                    $new = array();
                    $new['value'] = "/" . $pages->url . "-p" . $pages->id . ".html";
                    $new['text'] = "|--" . $pages->name;
                    $new['group'] =$cat->name;
                    $data[] = $new;
                }
            }
        }
        $catnew = \common\models\Catnew::find()->where('parent=-1 and active=1')->all();
        foreach ($catnew as $cat) {
            $new = array();
            $new['value'] = "/" . $cat->url . "-l" . $cat->id . ".html";
            $new['text'] = "|--" . $cat->name;
            $new['group'] = "Chuyên mục tin tức";
            $data[] = $new;
        }
        $groupproduct = \common\models\Grproduct::find()->all();
        foreach ($groupproduct as $cat) {
            $new = array();
            $new['value'] = "/" . func::taoduongdan($cat->name) . "-g" . $cat->id . ".html";
            $new['text'] = "|--" . $cat->name;
            $new['group'] = "Nhóm sản phẩm theo tag";
            $data[] = $new;
        }
        return $data;
    }
    public static function getLeafCatProducts()
    {
        $data = array(

        );


        $catproducts = \common\models\Catproduct::find()->where('parent=-1 and active=1')->all();

        foreach ($catproducts as $cat) {

            $catproduct = \common\models\Catproduct::getSubCatProduct($cat->id);
            if (!empty($catproduct)) {
                foreach ($catproduct as $pages) {
                    $new = array();
                    $new['value'] = $pages->id;
                    $new['text'] = "|--" . $pages->name;
                    $new['group'] =$cat->name;
                    $data[] = $new;
                }
            }else{
                $new = array();
                $new['value'] = $cat->id;
                $new['text'] = "|--" . $cat->name;
                $new['group'] =$cat->name;
                $data[] = $new;
            }
        }

        return $data;
    }
    public static function getProductsByCat()
    {
        $data = array(

        );


        $products = \common\models\Product::find()->where('active=1')->orderBy('')->all();

        foreach ($products as $cat) {
                    $new = array();
                    $new['value'] = $cat->id ;
                    $new['text'] = "|--" . $cat->name;
                    $new['group'] =$cat->catProduct->name;
                    $data[] = $new;
        }

        return $data;
    }
    public static function callMenu($id, $datas, $sub_ul_class)
    {
        if ($id == 'null') {
            foreach ($datas as $data) {
                if (is_null($data->parent)) {
                    echo '<li data-id="' . $data->id . '"><a href="' . Yii::$app->urlManager->baseUrl . $data->link . '">' . $data->name . '</a>';
                    self::callMenu($data->id, $datas, $sub_ul_class);
                    echo '</li>';
                }
            }
        } else {
            $temp = 0;
            foreach ($datas as $data) {
                if ($data->parent == $id) {
                    $temp++;
                }
            }
            if ($temp != 0) {
                echo '<ul class="' . $sub_ul_class . '">';
                foreach ($datas as $data) {
                    if ($data->parent == $id) {
                        echo '<li data-id="' . $data->id . '"><a href="' . Yii::$app->urlManager->baseUrl . $data->link . '">' . $data->name . '</a>';
                        self::callMenu($data->id, $datas, $sub_ul_class);
                        echo '</li>';
                    }
                }
                echo '</ul>';
            }
        }
        return;
    }

    public static function callCat($id, $datas, $sub_ul_class, $cur, $dosau)
    {
        if($cur==$dosau)//dừng khi đạt độ sâu cho trước
            return;

        if ($id == 'null') {
            foreach ($datas as $data) {
                if ($data->parent==-1) {
                    $temp = 0;
                    foreach ($datas as $item) {
                        if ($item->parent == $data->id) {
                            $temp++;
                            break;
                        }
                    }
                    $parent = ($temp>0)?'parent':'';
                    echo '<li><a class="'.$parent.'" href="' . Yii::$app->urlManager->createUrl(['product/product','path'=>$data->url,'id'=>$data->id]).'"><i class="fa '.$data->small_icon.'" aria-hidden="true"></i>' . $data->name . '</a>';
                    self::callCat($data->id, $datas, $sub_ul_class, $cur+1, $dosau);
                    echo '</li>';
                }
            }
        } else {
            $temp = 0;
            foreach ($datas as $data) {
                if ($data->parent == $id) {
                    $temp++;
                    break;
                }
            }
            if ($temp != 0) {
                echo '
                    <div class="vertical-dropdown-menu">
                        <div class="vertical-groups col-sm-12">
                            <ul class="' . $sub_ul_class . ' group-link-default">';
                foreach ($datas as $data) {
                    if ($data->parent == $id) {
                        echo '<li><a href="' .Yii::$app->urlManager->createUrl(['product/product','path'=>$data->url,'id'=>$data->id]). '"><i class="fa fa-angle-double-right" aria-hidden="true"></i>' . $data->name . '</a>';
                        self::callCat($data->id, $datas, $sub_ul_class, $cur+1, $dosau);
                        echo '</li>';
                    }
                }
                echo '
                            </ul>
                        </div>
                    </div>';
            }
        }
        return;
    }
    public static function callMobileMenu($id, $datas, $sub_ul_class, $cur, $dosau)
    {
        if($cur==$dosau)//dừng khi đạt độ sâu cho trước
            return;

        if ($id == 'null') {
            foreach ($datas as $data) {
                if (is_null($data->parent)) {
                    $temp = 0;
                    foreach ($datas as $item) {
                        if ($item->parent == $data->id) {
                            $temp++;
                            break;
                        }
                    }
                    $parent = ($temp>0)?'chopdown':'';
                    $href = ($temp>0)?'#':Yii::$app->urlManager->baseUrl . $data->link;
                    echo '<li><a data-toggle="collapse" data-target="#dropdown'.$data->id.'" class="'.$parent.'" href="' . $href . '">' . $data->name . '</a>';
                    self::callMobileMenu($data->id, $datas, $sub_ul_class, $cur, $dosau);
                    echo '</li>';
                }
            }
        } else {
            $temp = 0;
            foreach ($datas as $data) {
                if ($data->parent == $id) {
                    $temp++;
                    break;
                }
            }
            if ($temp != 0) {
                echo '<ul id="dropdown'.$id.'" class="' . $sub_ul_class . '">';
                foreach ($datas as $data) {
                    if ($data->parent == $id) {
                        $temp = 0;
                        foreach ($datas as $item) {
                            if ($item->parent == $data->id) {
                                $temp++;
                                break;
                            }
                        }
                        $parent = ($temp>0)?'chopdown':'';
                        $href = ($temp>0)?'#':Yii::$app->urlManager->baseUrl . $data->link;
                        echo '<li><a data-toggle="collapse" data-target="#dropdown'.$data->id.'" class="'.$parent.'" href="' . $href . '">' . $data->name . '</a>';
                        self::callMobileMenu($data->id, $datas, $sub_ul_class, $cur, $dosau);
                        echo '</li>';
                    }
                }
                echo '</ul>';
            }
        }
        return;
    }


    public static function trangthai($str ='0|1|2')
    {
        if ($str =='0')
            return '<span class="label label-info">Đang chờ xử lý</span>';
        if ($str =='2')
            return '<span class="label label-danger">Hủy đơn hàng</span>';
        if ($str =='1')
            return '<span class="label label-success">Giao hàng thành công</span>';

    }

    public static function is2DCatArray($id)
    {
        $subcats = \common\models\Catproduct::getSubCatProduct($id);
        foreach ($subcats as $subcat){
            $leafcats = \common\models\Catproduct::getSubCatProduct($subcat->id);
            if(count($leafcats))
                return true;
        }
        return false;
    }
    public static function getAllAnimate(){
        return ["bounce"=>"bounce",
            "flash"=>"flash",
            "pulse"=>"pulse",
            "rubberBand"=>"rubberBand",
            "shake"=>"shake",
            "swing"=>"swing",
            "tada"=>"tada",
            "wobble"=>"wobble",
            "jello"=>"jello",
            "bounceIn"=>"bounceIn",
            "bounceInDown"=>"bounceInDown",
            "bounceInLeft"=>"bounceInLeft",
            "bounceInRight"=>"bounceInRight",
            "bounceInUp"=>"bounceInUp",
            "bounceOut"=>"bounceOut",
            "bounceOutDown"=>"bounceOutDown",
            "bounceOutLeft"=>"bounceOutLeft",
            "bounceOutRight"=>"bounceOutRight",
            "bounceOutUp"=>"bounceOutUp",
            "fadeIn"=>"fadeIn",
            "fadeInDown"=>"fadeInDown",
            "fadeInDownBig"=>"fadeInDownBig",
            "fadeInLeft"=>"fadeInLeft",
            "fadeInLeftBig"=>"fadeInLeftBig",
            "fadeInRight"=>"fadeInRight",
            "fadeInRightBig"=>"fadeInRightBig",
            "fadeInUp"=>"fadeInUp",
            "fadeInUpBig"=>"fadeInUpBig",
            "fadeOut"=>"fadeOut",
            "fadeOutDown"=>"fadeOutDown",
            "fadeOutDownBig"=>"fadeOutDownBig",
            "fadeOutLeft"=>"fadeOutLeft",
            "fadeOutLeftBig"=>"fadeOutLeftBig",
            "fadeOutRight"=>"fadeOutRight",
            "fadeOutRightBig"=>"fadeOutRightBig",
            "fadeOutUp"=>"fadeOutUp",
            "fadeOutUpBig"=>"fadeOutUpBig",
            "flip"=>"flip",
            "flipInX"=>"flipInX",
            "flipInY"=>"flipInY",
            "flipOutX"=>"flipOutX",
            "flipOutY"=>"flipOutY",
            "lightSpeedIn"=>"lightSpeedIn",
            "lightSpeedOut"=>"lightSpeedOut",
            "rotateIn"=>"rotateIn",
            "rotateInDownLeft"=>"rotateInDownLeft",
            "rotateInDownRight"=>"rotateInDownRight",
            "rotateInUpLeft"=>"rotateInUpLeft",
            "rotateInUpRight"=>"rotateInUpRight",
            "rotateOut"=>"rotateOut",
            "rotateOutDownLeft"=>"rotateOutDownLeft",
            "rotateOutDownRight"=>"rotateOutDownRight",
            "rotateOutUpLeft"=>"rotateOutUpLeft",
            "rotateOutUpRight"=>"rotateOutUpRight",
            "slideInUp"=>"slideInUp",
            "slideInDown"=>"slideInDown",
            "slideInLeft"=>"slideInLeft",
            "slideInRight"=>"slideInRight",
            "slideOutUp"=>"slideOutUp",
            "slideOutDown"=>"slideOutDown",
            "slideOutLeft"=>"slideOutLeft",
            "slideOutRight"=>"slideOutRight",
            "zoomIn"=>"zoomIn",
            "zoomInDown"=>"zoomInDown",
            "zoomInLeft"=>"zoomInLeft",
            "zoomInRight"=>"zoomInRight",
            "zoomInUp"=>"zoomInUp",
            "zoomOut"=>"zoomOut",
            "zoomOutDown"=>"zoomOutDown",
            "zoomOutLeft"=>"zoomOutLeft",
            "zoomOutRight"=>"zoomOutRight",
            "zoomOutUp"=>"zoomOutUp",
            "hinge"=>"hinge",
            "jackInTheBox"=>"jackInTheBox",
            "rollIn"=>"rollIn",
            "rollOut"=>"rollOut"];
    }
    public static function getInAnimate(){
        return ["bounce"=>"bounce",
            "flash"=>"flash",
            "pulse"=>"pulse",
            "rubberBand"=>"rubberBand",
            "shake"=>"shake",
            "swing"=>"swing",
            "tada"=>"tada",
            "wobble"=>"wobble",
            "jello"=>"jello",
            "bounceIn"=>"bounceIn",
            "bounceInDown"=>"bounceInDown",
            "bounceInLeft"=>"bounceInLeft",
            "bounceInRight"=>"bounceInRight",
            "bounceInUp"=>"bounceInUp",
            "fadeIn"=>"fadeIn",
            "fadeInDown"=>"fadeInDown",
            "fadeInDownBig"=>"fadeInDownBig",
            "fadeInLeft"=>"fadeInLeft",
            "fadeInLeftBig"=>"fadeInLeftBig",
            "fadeInRight"=>"fadeInRight",
            "fadeInRightBig"=>"fadeInRightBig",
            "fadeInUp"=>"fadeInUp",
            "fadeInUpBig"=>"fadeInUpBig",
            "flip"=>"flip",
            "flipInX"=>"flipInX",
            "flipInY"=>"flipInY",
            "lightSpeedIn"=>"lightSpeedIn",
            "rotateIn"=>"rotateIn",
            "rotateInDownLeft"=>"rotateInDownLeft",
            "rotateInDownRight"=>"rotateInDownRight",
            "rotateInUpLeft"=>"rotateInUpLeft",
            "rotateInUpRight"=>"rotateInUpRight",
            "slideInUp"=>"slideInUp",
            "slideInDown"=>"slideInDown",
            "slideInLeft"=>"slideInLeft",
            "slideInRight"=>"slideInRight",
            "zoomIn"=>"zoomIn",
            "zoomInDown"=>"zoomInDown",
            "zoomInLeft"=>"zoomInLeft",
            "zoomInRight"=>"zoomInRight",
            "zoomInUp"=>"zoomInUp",
            "jackInTheBox"=>"jackInTheBox",
            "rollIn"=>"rollIn"];
    }
    public static function getTimeNow()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = getdate();
        return $now["hours"].":".$now["minutes"].":".$now["seconds"]." ".$now["mday"]."/".$now["mon"]."/".$now["year"];
    }
    public static function getTimeNowForFilename()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = getdate();
        return $now["hours"]."_".$now["minutes"]."_".$now["seconds"]."_".$now["mday"]."_".$now["mon"]."_".$now["year"];
    }
    public static function vndFormat($val){

        return number_format($val,0,"",".");
    }

    public static function convertImage($originalImage, $outputImage, $quality)
    {

        // jpg, png, gif or bmp?
        $exploded = explode('.',$originalImage);
        $ext = $exploded[count($exploded) - 1];

        if (preg_match('/jpg|jpeg/i',$ext))
            $imageTmp=imagecreatefromjpeg($originalImage);
        else if (preg_match('/png/i',$ext))
            $imageTmp=imagecreatefrompng($originalImage);
        else if (preg_match('/gif/i',$ext))
            $imageTmp=imagecreatefromgif($originalImage);
        else if (preg_match('/bmp/i',$ext))
            $imageTmp=imagecreatefrombmp($originalImage);
        else
            return 0;

        // quality is a value from 0 (worst) to 100 (best)
        imagejpeg($imageTmp, $outputImage, $quality);
        imagedestroy($imageTmp);

        return 1;
    }
    public static function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    public static function generate_sup_script($model,$attribute,$text){
        return $model->attributeLabels()[$attribute]." <sup style='font-weight: bolder;font-size: 12px;' sup-script-rel='".$attribute."'>?<div class='sup-image'><img src='/pimage/".$attribute.".jpg'><p style='font-size: 14px; font-weight: normal; text-transform: none'>".$text."</p></div></sup>";
    }
    public static function generateFileButton($text,$class,$for){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = getdate();
        $nowfullstring = $now["mday"]."/".$now["mon"]."/".$now["year"];
        return '<style>#fancybox-overlay,#fancybox-wrap{z-index: 99999;!important;}</style><a href="/admin/admin/getfilemanagerforck?editor=ckeditor&field_id='.$for.'&CKEditorFuncNum=1&langCode=vi" data-parent="'.$for.'" data-parent-value="" class="btn iframe-btn '.$class.'" type="button">'.$text.'</a>';
    }
    ////////////////////////
    //bỏ các tag của php
    public static function remove_phptag_prevent_injection($string){
        $t = str_replace("?>", "", str_replace("<?", "", $string));
        if(mb_strpos($t, "<?") !== false || mb_strpos($t, "?>") !== false){
            $t = self::remove_phptag_prevent_injection($t);
        }
        $t = htmlspecialchars($t, ENT_QUOTES, 'UTF-8');
        return $t;
    }


    //xóa hết tất cả thẻ html
    public static function super_strip_tag_prevent_injection($string){
        $result = strip_tags(self::remove_phptag_prevent_injection($string));
        return $result;
    }
    public static function strip_tag_input($string){
        $result = strip_tags($string);
        return $result;
    }

    //giữ lại các thẻ html
    public static function strip_tags_for_content($content){
        $allowed_tags = '<!--...--><!DOCTYPE><a><abbr><acronym><address><applet><area><article><aside><audio><b><base><basefont><bdi><bdo><big><blockquote><body><br><button><canvas><caption><center><cite><code><col><colgroup><data><datalist><dd><del><details><dfn><dialog><dir><div><dl><dt><em><embed><fieldset><figcaption><figure><font><footer><frame><frameset><h1><h2><h3><h4><h5><h6><head><header><hgroup><hr><html><i><iframe><img><input><ins><kbd><label><legend><li><link><main><map><mark><menu><meta><meter><nav><noframes><noscript><object><ol><optgroup><option><output><p><param><picture><pre><progress><q><rp><rt><ruby><s><samp><search><section><select><small><source><span><strike><strong><style><sub><summary><sup><svg><table><tbody><td><template><textarea><tfoot><th><thead><time><title><tr><track><tt><u><ul><var><video><wbr>';
        $content = strip_tags(self::remove_phptag_prevent_injection($content), $allowed_tags);
        return $content;
    }
}