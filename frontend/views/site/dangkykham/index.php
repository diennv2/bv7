<?php

$config = \common\models\Configure::getConfig();
$this->context->og_type = 'website';
$this->context->og_image = $config['contact_logo'];

\johnitvn\ajaxcrud\CrudAsset::register($this);

?>
<style>
    .form-control {
        font-size: 14px !important;
    }

    .headline_outer {
        background-image: url(/images/heading-3-2.jpg);
        background-repeat: no-repeat;
        background-attachment: scroll;
        background-size: cover;
    }
</style>
<section class="page-108">
    <div class="container">
        <div role="form" class="wpcf7" id="wpcf7-f14612-p7366-o1"
             lang="en-US" dir="ltr">
            <div class="screen-reader-response"><p role="status"
                                                   aria-live="polite"
                                                   aria-atomic="true"></p>
                <ul></ul>
            </div>
            <img id="preloadimg" style="width: 100%" src="/images/loading.gif">
            <div id="hidden-input" style="display: none">
                <div class="form-group">
                    <label class="control-label">
                        Họ và tên
                    </label>
                    <input required type="text" class="form-control" id="hovaten" name="hovaten">
                </div>
                <div class="form-group">
                    <label class="control-label">
                        CMND/CCCD
                    </label>
                    <input required type="text" class="form-control" id="cccd" name="cccd">
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Số điện thoại
                    </label>
                    <input required type="text" class="form-control" id="sdt" name="sdt">
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Ngày giờ hẹn khám
                    </label>
                    <input required type="datetime-local" class="form-control" id="ngaygiohenkham"
                           name="ngaygiohenkham">
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Mô tả triệu chứng
                    </label>
                    <input type="text" class="form-control" id="motatrieuchung" name="motatrieuchung">
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Chuyên khoa khám
                    </label>
                    <select required class="form-control" id="chuyenkhoa" name="chuyenkhoa"></select>
                </div>
                <div class="btn-group">
                    <button id="dangky" class="btn btn-success">Đăng ký</button>
                </div>
            </div>
            <script>
                $(document).ready(function () {
                    $('input[name="cccd"]').keyup(function (e) {
                        if (/\D/g.test(this.value)) {
                            // Filter non-digits from input value.
                            this.value = this.value.replace(/\D/g, '');
                        }
                    });
                    $('input[name="sdt"]').keyup(function (e) {
                        if (/\D/g.test(this.value)) {
                            // Filter non-digits from input value.
                            this.value = this.value.replace(/\D/g, '');
                        }
                    });
                    var t = $("#chuyenkhoa");
                    $.ajax({
                        url: "https://ttkc.techber.vn/api/services/app/PortalAppServices/PortalGetListChuyenKhoa",
                        type: 'post',
                        dataType: 'json',
                        contentType: "application/json",
                        data: JSON.stringify({
                            token: "<?=$config['api_token']?>"
                        }),
                        success: function (data) {
                            $.each(data.result.chuyenKhoaDtos, function (index, value) {
                                t.append("<option value='" + value.id + "'>" + value.ten + "</option>")
                            });

                            $("#preloadimg").fadeOut();
                            $("#hidden-input").fadeIn();
                        }
                    });

                    $(document).on("click", "#dangky", function () {
                        var hovaten = $("#hovaten").val();
                        var sdt = $("#sdt").val();
                        var ngaygiohenkham = $("#ngaygiohenkham").val();
                        var motatrieuchung = $("#motatrieuchung").val();
                        var cccd = $("#cccd").val();
                        var chuyenkhoa = $("#chuyenkhoa").val();
                        if (hovaten === "" || ngaygiohenkham === "" || cccd === "" || chuyenkhoa === "" || sdt === "") {
                            alert("Chưa nhập đủ thông tin!");
                        } else {
                            $.ajax({
                                url: "https://ttkc.techber.vn/api/services/app/PortalAppServices/PortalRegister",
                                type: 'post',
                                contentType: "application/json",
                                dataType: 'json',
                                data: JSON.stringify({
                                    token: "<?=$config['api_token']?>",
                                    hovaten: hovaten,
                                    ngaygiohenkham: ngaygiohenkham + ":00Z",
                                    motatrieuchung: motatrieuchung,
                                    cccd: cccd,
                                    sdt: sdt,
                                    chuyenkhoa: chuyenkhoa,
                                }),
                                success: function (data) {
                                    console.log(data);
                                    alert(data.result.message);
                                    $("#hidden-input").html("<p class='alert " + (data.result.status ? "alert-success-white" : "alert-warning") + "'>" + data.result.message + "</p>")
                                }
                            });
                        }

                    })
                })
            </script>
        </div>
    </div>
</section>