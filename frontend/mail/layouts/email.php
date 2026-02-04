<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        table{
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }
        .table1 th,.table1 td{
            text-align: left!important;
            width: 250px;
        }
        table>tbody>tr>td, table>tbody>tr>th, table>tfoot>tr>td, table>tfoot>tr>th, table>thead>tr>td, table>thead>tr>th {
            border: 1px solid #ddd;
            text-align: right;
        }
        table>tbody>tr>td, table>tbody>tr>th, table>tfoot>tr>td, table>tfoot>tr>th, table>thead>tr>td, table>thead>tr>th {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
            text-align: right;
        }
        th{
            background-color: #dff0d8;;
        }
        .imglogo{
            width: 150px;
        }
    </style>
</head>
<body>

<?php $this->beginBody() ?>
<?= $content?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
