<?php
/**
 * Created by PhpStorm.
 * User: ihdes
 * Date: 8/24/2017
 * Time: 3:32 PM
 */

use yii\helpers\Html;

$this->title = 'Sản phẩm';
$nab = Yii::$app->controller->navbar;
?>
<main id="main" class="main-pages">
    <section class="section-banner white_after">
        <div class="banner-page">
            <div class="bs-container">
                <div class="banner-text"><h4 class="title aos-init aos-animate" data-aos="zoom-out"
                                             data-aos-delay="1200"> Sản phẩm </h4>
                    <ul class="link-list aos-init aos-animate" data-aos="zoom-out" data-aos-delay="1200">
                        <?= $nab?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <p></p>
    <section class="section-productPage abc">
        <div class="bs-container">
            <div class="bs-row">
                <div class="bs-col">
                    <div class="module module-product">
                        <div class="module-header"><h4 class="title aos-init aos-animate" data-aos="fade-down"
                                                       data-aos-delay="0">Nhóm sản phẩm</h4></div>
                        <div class="module-content aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                            <div class="product">
                                <div class="bs-row row-sm-10">
                                    <?php $catproduct = \common\models\Catproduct::find()->where(['active' => 1])->orderBy("ord asc")->all();
                                    foreach ($catproduct as $index => $value):
                                    ?>
                                    <div class="bs-col sm-33-10">
                                        <div class="item pro_block">
                                            <div class="img a_height"><h2 class="title f_height"><a
                                                            href="<?= "/" . $value->url . "-p" . $value->id . ".html" ?>" class="title_link"><span><?= $value->name ?></span></a>
                                                </h2><img src="<?= $value->image ?>"
                                                          alt="<?= $value->name ?>" loading="lazy"></div>
                                            <div class="description"><p class="desc-text"><?= $value->description ?></p></div>
                                            <div class="see-more"><a href="<?= "/" . $value->url . "-p" . $value->id . ".html" ?>"
                                                                     class="link">Xem thêm</a></div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--    <section class="section-productProcedure">-->
<!--        <div class="bs-container">-->
<!--            <div class="bs-row">-->
<!--                <div class="bs-col">-->
<!--                    <div class="module module-productProcedure">-->
<!--                        <div class="module-header"><h3 class="title aos-init aos-animate" data-aos="fade-down"-->
<!--                                                       data-aos-delay="0">QUY TRÌNH DỊCH VỤ BYTESOFT</h3>-->
<!--                            <p class="desc aos-init aos-animate" data-aos="fade-down" data-aos-delay="200">Chi phí thấp-->
<!--                                - Hiệu quả cao - Uy tín tuyệt đối</p></div>-->
<!--                        <div class="module-content">-->
<!--                            <div class="bs-row row-md-5 row-sm-15 row-xs-5" id="_hv">-->
<!--                                <div class="bs-col md-100-5 sm-100-15 xs-100-5" id="process_">-->
<!--                                    <div class="process-line">-->
<!--                                        <div class="line"><img alt="line"-->
<!--                                                               src="https://bytesoft.vn/themes/bytesoft/images/line.gif"-->
<!--                                                               loading="lazy"></div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="bs-col md-20-5 xs-50-5 sm-50-15">-->
<!--                                    <div class="number one aos-init aos-animate" data-aos="fade-down"-->
<!--                                         data-aos-delay="400" id="number"><p class="number-item "><span>01</span></p>-->
<!--                                    </div>-->
<!--                                    <div class="item item-process aos-init aos-animate" data-aos="fade-down"-->
<!--                                         data-aos-delay="400">-->
<!--                                        <div class="img"><img alt="nghien cuu noi dung" class="icon"-->
<!--                                                              src="https://bytesoft.vn/themes/bytesoft/images/product_icon1.gif"><img-->
<!--                                                    alt="nghien cuu noi dung 1" class="icon_hover"-->
<!--                                                    src="https://bytesoft.vn/themes/bytesoft/images/product_icon1_hover.gif">-->
<!--                                        </div>-->
<!--                                        <p class="title">NGHIÊN CỨU NỘI DUNG</p>-->
<!--                                        <p class="desc">Phân tích rõ ràng mục đích, yêu cầu, nguyện vọng khách hàng; Lập-->
<!--                                            kế hoạch thực hiện dự án.</p></div>-->
<!--                                </div>-->
<!--                                <div class="bs-col md-20-5 xs-50-5 sm-50-15">-->
<!--                                    <div class="number two aos-init aos-animate" data-aos="fade-up" data-aos-delay="400"-->
<!--                                         id="number"><p class="number-item "><span>02</span></p></div>-->
<!--                                    <div class="item item-process aos-init aos-animate" data-aos="fade-up"-->
<!--                                         data-aos-delay="400">-->
<!--                                        <div class="img"><img alt="thiet ke theo yeu cau" class="icon"-->
<!--                                                              src="https://bytesoft.vn/themes/bytesoft/images/product_icon2.gif"><img-->
<!--                                                    alt="thiet ke theo yeu cau 1" class="icon_hover"-->
<!--                                                    src="https://bytesoft.vn/themes/bytesoft/images/product_icon2_hover.gif">-->
<!--                                        </div>-->
<!--                                        <p class="title">THIẾT KẾ THEO YÊU CẦU</p>-->
<!--                                        <p class="desc">Xây dựng giao diện demo gửi đến khách hàng; Nhận phản hồi, góp ý-->
<!--                                            và cùng thống nhất giao diện, chức năng.</p></div>-->
<!--                                </div>-->
<!--                                <div class="bs-col md-20-5 xs-50-5 sm-50-15">-->
<!--                                    <div class="number three aos-init aos-animate" data-aos="fade-up"-->
<!--                                         data-aos-delay="400" id="number"><p class="number-item "><span>03</span></p>-->
<!--                                    </div>-->
<!--                                    <div class="item item-process aos-init aos-animate" data-aos="fade-up"-->
<!--                                         data-aos-delay="400">-->
<!--                                        <div class="img"><img alt="lap trinh" class="icon"-->
<!--                                                              src="https://bytesoft.vn/themes/bytesoft/images/product_icon3.gif"><img-->
<!--                                                    alt="lap trinh 1" class="icon_hover"-->
<!--                                                    src="https://bytesoft.vn/themes/bytesoft/images/product_icon3_hover.gif">-->
<!--                                        </div>-->
<!--                                        <p class="title">LẬP TRÌNH</p>-->
<!--                                        <p class="desc">Phối hợp các phòng ban (Code, HTML, Design, Test, Marketing,-->
<!--                                            ...) triển khai dự án.</p></div>-->
<!--                                </div>-->
<!--                                <div class="bs-col md-20-5 xs-50-5 sm-50-15">-->
<!--                                    <div class="number four aos-init aos-animate" data-aos="fade-down"-->
<!--                                         data-aos-delay="400" id="number"><p class="number-item "><span>04</span></p>-->
<!--                                    </div>-->
<!--                                    <div class="item item-process aos-init aos-animate" data-aos="fade-down"-->
<!--                                         data-aos-delay="400">-->
<!--                                        <div class="img"><img alt="demo va kiem thu" class="icon"-->
<!--                                                              src="https://bytesoft.vn/themes/bytesoft/images/product_icon4.gif"><img-->
<!--                                                    alt="demo va kiem thu 1" class="icon_hover"-->
<!--                                                    src="https://bytesoft.vn/themes/bytesoft/images/product_icon4_hover.gif">-->
<!--                                        </div>-->
<!--                                        <p class="title">DEMO VÀ KIỂM THỬ</p>-->
<!--                                        <p class="desc">Cho chạy thử trên Internet; Tiến hành chỉnh sửa theo yêu cầu của-->
<!--                                            khách (nếu có) trước khi bàn giao.</p></div>-->
<!--                                </div>-->
<!--                                <div class="bs-col md-20-5 xs-50-5 sm-50-15">-->
<!--                                    <div class="number five aos-init aos-animate" data-aos="fade-up"-->
<!--                                         data-aos-delay="400" id="number"><p class="number-item "><span>05</span></p>-->
<!--                                    </div>-->
<!--                                    <div class="item item-process aos-init aos-animate" data-aos="fade-up"-->
<!--                                         data-aos-delay="400">-->
<!--                                        <div class="img"><img alt="ban giao khach hang" class="icon"-->
<!--                                                              src="https://bytesoft.vn/themes/bytesoft/images/product_icon5.gif"><img-->
<!--                                                    alt="ban giao khach hang 1" class="icon_hover"-->
<!--                                                    src="https://bytesoft.vn/themes/bytesoft/images/product_icon5_hover.gif">-->
<!--                                        </div>-->
<!--                                        <p class="title">BÀN GIAO KHÁCH HÀNG</p>-->
<!--                                        <p class="desc">Bàn giao các thông số quản lý; Bảo hành và hỗ trợ kỹ thuật-->
<!--                                            24/7.</p></div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
    <p></p>
    <section class="section-slogan">
        <div class="bs-container"><p class="desc aos-init aos-animate" data-aos="zoom-out" data-aos-delay="0">Chúng tôi
                ở đây để làm mọi thứ tốt hơn!</p></div>
    </section>
</main>a
