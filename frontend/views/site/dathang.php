<link href="https://muahang.haitau.vn/static/css/w2ui-1.4.3.min.css?v=1574111974" rel="stylesheet" media="screen">
<link href="https://muahang.haitau.vn/static/css/bootstrap.min.css?v=1574111974" rel="stylesheet" media="screen">
<link href="https://muahang.haitau.vn/static/css/nhkd-style.css?v=1574111974" rel="stylesheet" media="screen">
<link href="https://muahang.haitau.vn/static/css/style1.css?v=1574111974" rel="stylesheet" media="screen">
<link href="https://muahang.haitau.vn/static/css/responsive.css?v=1574111974" rel="stylesheet" media="screen">
<link href="https://muahang.haitau.vn/static/css/doc.min.css?v=1574111974" rel="stylesheet" media="screen">
<link href="https://muahang.haitau.vn/static/css/animate.css?v=1574111974" rel="stylesheet" media="screen">
<link href="https://muahang.haitau.vn/static/css/themify-icons.css?v=1574111974" rel="stylesheet" media="screen">
<link href="https://muahang.haitau.vn/static/css/font-awesome.min.css?v=1574111974" rel="stylesheet" media="screen">
<link href="https://muahang.haitau.vn/static/css/uploadfile.css?v=1574111974" rel="stylesheet" media="screen">
<link href="https://muahang.haitau.vn/static/css/tooltipster.bundle.min.css?v=1574111974" rel="stylesheet" media="screen">
<link href="https://muahang.haitau.vn/static/css/sideTip/themes/tooltipster-sideTip-noir.min.css?v=1574111974" rel="stylesheet" media="screen">
<link href="https://muahang.haitau.vn/static/css/sideTip/themes/tooltipster-sideTip-borderless.min.css?v=1574111974" rel="stylesheet" media="screen">
<link href="https://muahang.haitau.vn/static/css/nhkd-material-design-iconic-font.min.css?v=1574111974" rel="stylesheet" media="screen">

<script>
    <?php if(isset($_GET['message'])):?>
        alert("<?=$_GET['message']?>")
    <?php endif;?>
</script>

<div style="padding-top:30px;" class="sidebar-left-kk ">
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;"><ul class="nav navbar-nav side-nav nicescroll-bar" style="overflow: hidden; width: auto; height: 100%;">
            <li class="">
                <a href="https://muahang.haitau.vn/dashboard">
                    <div class="pull-left">
                        <i class="ti-desktop"></i>
                        <span>Bảng tin</span>
                    </div>
                    <div class="pull-right"></div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="">
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#order_tb" aria-expanded="false" class="collapsed">
                    <div class="pull-left"><i class="ti ti-book"></i><span>Đơn hàng</span></div>
                    <div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div>
                    <div class="clearfix"></div>
                </a>
                <ul id="order_tb" class="collapse-level-1 collapse " aria-expanded="false">
                    <li class=""><a href="https://muahang.haitau.vn/order/lists">Toàn bộ</a></li>
                    <li class=""><a href="https://muahang.haitau.vn/order/lists?filter_status=1">Chờ đặt cọc (0)</a></li>
                    <li class=""><a href="https://muahang.haitau.vn/order/lists?filter_status=2">Chờ mua hàng (0)</a></li>
                    <li class=""><a href="https://muahang.haitau.vn/order/lists?filter_status=3">Đang mua hàng (0)</a></li>
                    <li class=""><a href="https://muahang.haitau.vn/order/lists?filter_status=3.01">Chờ shop phát hàng (0)</a></li>
                    <li class=""><a href="https://muahang.haitau.vn/order/lists?filter_status=3.02">Shop TQ Phát hàng (0)</a></li>
                    <li class=""><a href="https://muahang.haitau.vn/order/lists?filter_status=3.1">Kho TQ nhận hàng (0)</a></li>
                    <li class=""><a href="https://muahang.haitau.vn/order/lists?filter_status=3.2">Xuất kho TQ (0)</a></li>
                    <li class=""><a href="https://muahang.haitau.vn/order/lists?filter_status=4">Trong kho VN (0)</a></li>
                    <li class=""><a href="https://muahang.haitau.vn/order/lists?filter_status=4.5">Sẵn sàng giao hàng (0)</a></li>
                    <li class=""><a href="https://muahang.haitau.vn/order/lists?filter_status=4.6">Chờ xử lý khiếu nại (0)</a></li>
                    <li class=""><a href="https://muahang.haitau.vn/order/lists?filter_status=5">Đã kết thúc (0)</a></li>
                    <li class=""><a href="https://muahang.haitau.vn/order/lists?filter_status=-1">Đã hủy (0)</a></li>
                </ul>
            </li>
            <li class="">
                <a href="https://muahang.haitau.vn/member/wallet">
                    <div class="pull-left"><i class="ti-credit-card"></i><span>Ví điện tử</span></div>
                    <div class="pull-right"></div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="">
                <a href="https://muahang.haitau.vn/complain/lists">
                    <div class="pull-left"><i class="ti-face-sad"></i><span>Khiếu nại</span></div>
                    <div class="pull-right"></div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="">
                <a href="https://muahang.haitau.vn/ShipOrder">
                    <div class="pull-left"><i class="ti-truck"></i><span>Đơn ký gửi</span></div>
                    <div class="pull-right"></div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="">
                <a href="https://muahang.haitau.vn/ship/transport">
                    <div class="pull-left"><i class="ti-package"></i><span>Kiện hàng</span></div>
                    <div class="pull-right"></div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="">
                <a href="https://muahang.haitau.vn/order/delivery_notes_list">
                    <div class="pull-left"><i class="ti-truck"></i><span>Phiếu giao hàng</span></div>
                    <div class="pull-right"></div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="">
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#ctv_online" aria-expanded="false" class="collapsed">
                    <div class="pull-left"><i class="fa fa-users"></i><span>CTV</span></div>
                    <div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div>
                    <div class="clearfix"></div>
                </a>
                <ul id="ctv_online" class="collapse-level-1 collapse " aria-expanded="false">
                    <li class=""><a href="https://muahang.haitau.vn/member/ctvinfo">Thông tin &amp; Hoa hồng</a></li>
                    <li class=""><a href="https://muahang.haitau.vn/member/ctvcustomer">Danh sách khách hàng</a></li>
                    <li class=""><a href="https://muahang.haitau.vn/member/ctvsale">Thống kê hoa hồng</a></li>
                </ul>
            </li>
            <li class="">
                <a href="https://muahang.haitau.vn/shop">
                    <div class="pull-left"><i class="fa fa-star"></i><span>Shop uy tín</span></div>
                    <div class="pull-right"></div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li>
                <a href="https://muahang.haitau.vn/cart/save_link">
                    <div class="pull-left"><i class="fa fa-heart-o fa-2x" aria-hidden="true"></i><span>Sản phẩm yêu thích</span></div>
                    <div class="pull-right"></div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li>
                <a target="_blank" href="http://haitau.vn/bang-gia/">
                    <div class="pull-left"><i class="fa fa-hospital-o"></i><span>Bảng giá</span></div>
                    <div class="pull-right"></div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li>
                <a target="_blank" href="http://haitau.vn/huong-dan/hinh-thuc-thanh-toan/">
                    <div class="pull-left"><i class="fa fa-credit-card"></i><span>Thông tin thanh toán</span></div>
                    <div class="pull-right"></div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li>
                <a target="_blank" href="http://haitau.vn/#cai-cong-cu">
                    <div class="pull-left"><i class="fa fa-wrench"></i><span>Cài đặt công cụ</span></div>
                    <div class="pull-right"></div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li>
            </li>
        </ul><div class="slimScrollBar" style="background: rgb(135, 135, 135); width: 4px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 0px; z-index: 99; right: 1px; height: 873px;"></div><div class="slimScrollRail" style="width: 4px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
</div>

<div class="page-wrapper-kk" style="min-height: 100vh;">
    <div class="container-fluid">
        <div class="row">

            <div class="col-xs-6" style="padding-top: 10px;">
                <div class="search-container" style="padding: 5px;">
                    <form action="http://haitau.vn/search/" target="_blank" method="POST">
                        <select name="s" style="height: 35px; ">
                            <option value="taobao">Taobao.com</option>
                            <option value="1688">1688.com</option>
                            <option value="tmall">Tmall.com</option>
                        </select>
                        <input type="text" style="display: inline;height: 35px;width: 350px;" class="inputAutcom ui-autocomplete-input" placeholder="Nhập tên sản phẩm Tiếng Việt" name="q" autocomplete="off">
                        <button class="bt-search btn-primary" style="height: 35px; padding: 5px; ">Tìm kiếm</button>
                    </form>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="panelcustom panel-default " style="margin: 0px 5px;">
                    <div class="message_text" style="
								text-align: center;
								background: #87cf82;
								color: #fff;
								padding: 14px; margin-bottom: 10px;">
                        THÔNG BÁO: Hải Tàu Logistics cập nhật tỷ giá mới như sau:  1NDT = 3.420 VNĐ. Áp dụng từ 0h ngày 8/11/2019. Các đơn hàng lên đơn và đặt cọc mua hàng trước thời điểm này vẫn giữ nguyên tỷ giá cũ 1NDT=  3.390 VNĐ							</div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="panelcustom panel-default " style="margin: 0px 5px;">
                    <div class="cart-by-page mb30">
                        <div class="card-view col-sm-12">
                            <div class="titles">
                                <h2 class="page-title">
                                    CHÚ Ý
                                </h2>
                            </div>
                            <div class="content">
                                <div class="mt10">
                                    <div class="col-md-6">
                                        Để nâng cao chất lượng dịch vụ, chúng tôi cung cấp tiện ích duyệt tiền nhanh cho quý khách hàng sử dụng chuyển khoản qua Internet - Banking và không cần gửi thông tin giao dịch nạp tiền. Quý khách hàng chỉ cần nhập nội dung chuyển tiền như sau : <strong style="color:red">HT20520NT</strong> . Trong đó "20520" là mã số riêng của khách hàng, HT xxxx NT là cú pháp nạp tiền.
                                        <span class="clearfix"></span>
                                    </div>
                                    <!--
 <div class="col-md-5">
    Nếu có bất cứ thắc mắc nào vui lòng gọi tư vấn viên hoặc hiện hệ nhân viên hỗ trợ <b class="text-info">CSKH</b> và số điện thoại <b class="text-info">077.486.1688</b>
 </div>
 -->
                                    <div class="col-md-6">
                                        <p>
                                            <b>Mọi thắc mắc, yêu cầu hỗ trợ quý khách vui lòng liên hệ chuyên viên tư vấn đang chăm sóc tài khoản của quý khách:</b>
                                            <br>- Tên NV.CSKH: <b style="color: #c1392b">Ngọc Diệp</b> - Điện thoại, Zalo: <b style="color: #c1392b">0326131616</b>
                                            <br>- Tên NV.KD: <b style="color: #c1392b">Ngọc Diệp</b> - Điện thoại, Zalo: <b style="color: #c1392b">0326131616</b>
                                        </p>
                                    </div>
                                    <span class="clearfix"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">

                <div class="row">
                    <div class="guide" style="padding: 14px;">
                        <div class="table-responsive text-center">
                            <button class="btn btn-info"id="btn-themmathang">Thêm mặt hàng</button>
                            <?= \yii\helpers\Html::beginForm(['site/dangkymuahang','post',['enctype'=>'multipart/form-data']]);?>
                            <table class="table table-hover table-bordered table-striped" id="order-table">
                                <tr>
                                    <th></th>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Đường link sản phẩm</th>
                                    <th>Đơn vị tính</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá CNY</th>
                                    <th>Đơn giá VNĐ</th>
                                    <th>Thành tiền VNĐ</th>
                                    <th>Lời nhắn cho người bán</th>
                                </tr>

                            </table>
                            <p >Tổng: <span id="tdtong"></span></td>
                            <button class="btn btn-warning" type="submit">Đặt hàng</button>
                            <?= \yii\helpers\Html::endForm()?>

                        </div>
                        <div class="detail">
                            <h3>Để đặt hàng, bạn phải cài công cụ đặt hàng trên Chrome, Cốccốc:</h3>
                            <div class="addon text-center">
                                <a rel="nofollow" href="https://chrome.google.com/webstore/detail/iiaflpgpmmimjphnlbfeliodljebhejb" target="_blank"><img src="https://muahang.haitau.vn/static/images/addon_chrome.png"></a>
                                <a rel="nofollow" href="https://chrome.google.com/webstore/detail/iiaflpgpmmimjphnlbfeliodljebhejb" target="_blank"><img src="https://muahang.haitau.vn/static/images/addon_cococ.png"></a>
                            </div>
                            <p>
                                - <b><a target="_blank" href="https://muahang.haitau.vn/login">Đăng nhập</a></b> trước
                                khi đặt hàng.<br>
                                - Bạn nên xem phần <b>DÀNH CHO KHÁCH HÀNG</b> trên <a class="links" href="http://haitau.vn" target="_blank"><b>Haitau.vn</b></a> để
                                nắm được qui định của chúng tôi.<br>
                                - Nếu chưa quen tìm hàng trên <a class="links" href="http://www.1688.com/" target="_blank"><b>Alibaba</b></a>, <a class="links" href="http://taobao.com/" target="_blank"><b>Taobao</b></a>, <a class="links" href="http://tmall.com/" target="_blank"><b>Tmall</b></a>, bạn có
                                thể tìm sản phẩm tại <a target="_blank" class="links" href="http://haitau.vn"><b>một số gian hàng
                                        sau</b></a>.<br>
                            </p>
                        </div>
                    </div>				            <span class="clearfix"></span>
                </div>
                <!-- Footer section -->
                <div class="footer_address">
                    <div class="container">
                        <div class="col-md-4">
                            <div class="contact-item">
                                <div class="contact-name">
                                    <h4>TP. HÀ NỘI</h4>
                                </div>
                                <div class="contact-detail">
                                    <p> CS1: Khu X2 Đấu giá Mỹ Đình </p>
                                    <p>ĐT: 077.486.1688 </p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-name">
                                    <h4>TP. HỒ CHÍ MINH</h4>
                                </div>
                                <div class="contact-detail">
                                    <p> CS1: 49/19 Phạm Văn Bạch,Tân Bình, TP HCM </p>
                                    <p>ĐT: 0899.965.230 </p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-name">
                                    <h4>Bằng Tường – Quảng Tây</h4>
                                </div>
                                <div class="contact-detail">
                                    <p>广西凭祥市黄龙区10号仓库 </p>
                                    <p>ĐT: 18777020579 </p>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="contact-item">
                                <div class="contact-name">
                                    <h4>ỨNG DỤNG ĐẶT HÀNG TRÊN ĐIỆN THOẠI</h4>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="item">
                                    <img style="width:170px; height: 180px !important;" src="http://haitau.vn/wp-content/uploads/2019/04/qr-code-cai-dat-ung-dung-tren-haitau.jpg">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-item">
                                <div class="contact-name">
                                    <h4>CÔNG CỤ MUA HÀNG</h4>
                                </div>
                            </div>
                            <div class="bloc_app">
                                <div class="item">
                                    <a style="margin-right: 20px;" rel="nofollow" href="https://chrome.google.com/webstore/detail/iiaflpgpmmimjphnlbfeliodljebhejb" target="_blank"><img src="https://muahang.haitau.vn/static/images/tool-chorme.png"></a>
                                    <a rel="nofollow" href="https://chrome.google.com/webstore/detail/iiaflpgpmmimjphnlbfeliodljebhejb" target="_blank"><img src="https://muahang.haitau.vn/static/images/tool-coccoc.png"></a>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-name">
                                    <h4>NGUỒN HÀNG</h4>
                                </div>
                            </div>
                            <div class="item">
                                <p>- <a href="http://haitau.vn/cach-tim-kiem-nguon-hang-tren-1688/" target="_blank" title="Hướng dẫn tìm hàng 1688">Hướng dẫn tìm hàng 1688</a></p>
                                <p>- <a href="http://haitau.vn/huong-dan-tim-san-pham-sale-tren-1688/" target="_blank" title="Săn sale 1688">Săn sale 1688</a></p>
                                <p>- <a href="http://haitau.vn/huong-dan-tim-san-pham-hottrend-tren-1688/" target="_blank" title="Săn sản phẩm bán chạy trên 1688">Săn sản phẩm bán chạy trên 1688</a></p>
                                <p>- <a href="http://haitau.vn/top-100-link-xuong-nhap-hang-taobao-uy-tin-nhat/" target="_blank" title="100 link xưởng taobao uy tín">100 link xưởng taobao uy tín</a></p>
                                <p>- <a href="http://haitau.vn/huong-dan-tao-tai-khoan-mua-hang-tren-taobao-tmall-1688/" target="_blank" title="Hướng dẫn tạo tài khoản taobao, tmall, 1688">Hướng dẫn tạo tài khoản taobao, tmall, 1688</a></p>
                                <p>- <a href="http://haitau.vn/danh-sach-100-nguon-hang-quang-chau-gia-si-tot/" target="_blank" title="100 nguồn hàng Quảng Châu giá tốt">100 nguồn hàng Quảng Châu giá tốt</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <footer>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                Copyright © 2015 HaiTau.VN. All Rights Reserved Web Design: <a target="_blank" title="VskyTech Website Design &amp; Web Development" href="http://vskytech.com/">Vskytech</a>
                            </div>
                        </div>
                    </div>
                </footer>
                <!--End Footer section -->
            </div>
        </div>
    </div>
</div>
<style>.stt{font-size: 14px!important;}</style>
<script>
    var stt=0;
    function reloadstt(){
        $.each($(".stt"),function (index,value) {

            $(this).html(index+1);
        });
        $("#tdtong").html(addCommas(Math.round(parseInt(tinhtongtien()*3303.23)))+" VNĐ");
    }
    function addCommas(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
    function tinhtongtien(){
        var tongtien=0;
        $.each($(".soluong"),function (index,value) {
            var ids = $(this).attr("vals");
           if($("#soluong-"+ids).val()!="" && $("#dongia-"+ids).val()!=""){

               tongtien+=parseInt($("#soluong-"+ids).val())*parseInt($("#dongia-"+ids).val());
           }
        });
        return tongtien;
    }
    $(document).ready(function () {
        $(document).on('click','#btn-themmathang',function () {

            $("#order-table").append("<tr id='tr-"+stt+"'>" +
                "<td class=''><a vals='"+stt+"' class='delete-button btn btn-warning'><i class='fa fa-trash-o'></i></a></td>" +
                "<td class='stt'></td>" +
                "<td><input required type='text' class='form-control' name='order[tensanpham][]'></td>" +
                "<td><input required type='text' class='form-control' name='order[link][]'></td>" +
                "<td><input required type='text' class='form-control' name='order[dvt][]'></td>" +
                "<td><input required type='number' vals='"+stt+"' class='form-control curencyChange soluong' id='soluong-"+stt+"' name='order[soluong][]'></td>" +
                "<td><input required type='number' vals='"+stt+"' class='form-control curencyChange' id='dongia-"+stt+"' name='order[dongia][]'></td>" +
                "<td id='dongiavnd-"+stt+"'></td>" +
                "<td id='thanhtien-"+stt+"'>0</td>" +
                "<td><input type='text' class='form-control' name='order[ghichu][]'></td>" +
                "</tr>");
            reloadstt();
            stt++;
        });
        $(document).on('input','.curencyChange',function(){
           var id= $(this).attr('vals');
           $("#thanhtien-"+id).html(addCommas(Math.round(parseInt($("#soluong-"+id).val())*3303.23*parseInt($("#dongia-"+id).val())))+" VNĐ");
           $("#dongiavnd-"+id).html(addCommas(Math.round(parseInt($("#soluong-"+id).val()))*3303.23)+" VNĐ");
           reloadstt();
        });
        $(document).on("click",".delete-button",function () {
            var self=$(this);
            if(confirm("Xóa?")){
                $("#tr-"+self.attr('vals')).remove();
                reloadstt();
            }
        })
    })
</script>