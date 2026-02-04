<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "congviec".
 *
 * @property int $id
 * @property string $ten Tên công việc
 * @property string $mota Mô tả công việc
 * @property string $yeucauchung Yêu cầu chung
 * @property string $chinhsachphucloi Chính sách / phúc lợi
 * @property string $lienhe Liên hệ
 * @property string $vitriungtuyen Vị trí ứng tuyển
 * @property string $capbac Cấp bậc
 * @property string $thoigianlamviec Thời gian làm việc
 * @property string $mucluong Mức lương
 * @property string $noilamviec Nơi làm việc
 * @property string $tuvanvien Từ vấn viên
 * @property int $donvi
 * @property string $nganhnghe
 * @property int $hot
 * @property int $douutien
 */
class Congviec extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'congviec';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ten', 'mota', 'yeucauchung', 'chinhsachphucloi', 'lienhe', 'vitriungtuyen', 'capbac', 'thoigianlamviec', 'mucluong', 'noilamviec', 'tuvanvien', 'donvi', 'nganhnghe'], 'required'],
            [['ten', 'mota', 'yeucauchung', 'chinhsachphucloi', 'lienhe', 'vitriungtuyen', 'capbac', 'thoigianlamviec', 'mucluong', 'tuvanvien'], 'string'],
            [['donvi', 'hot', 'douutien'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ten' => 'Tên công việc',
            'mota' => 'Mô tả công việc',
            'yeucauchung' => 'Yêu cầu chung',
            'chinhsachphucloi' => 'Chính sách / phúc lợi',
            'lienhe' => 'Liên hệ',
            'vitriungtuyen' => 'Vị trí ứng tuyển',
            'capbac' => 'Cấp bậc',
            'thoigianlamviec' => 'Thời gian làm việc',
            'mucluong' => 'Mức lương',
            'noilamviec' => 'Nơi làm việc',
            'tuvanvien' => 'Từ vấn viên',
            'donvi' => 'Đơn vị',
            'nganhnghe' => 'Ngành nghề',
            'hot' => 'Hiển thị ưu tiên',
            'douutien' => 'Độ ưu tiên',
        ];
    }
}
