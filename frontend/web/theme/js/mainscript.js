
(function ($) {

    $(window).ready(function () {

        var ele = $('.main-header');
        $(window).scroll(function () {
            if ($(window).scrollTop() > 35) {
                ele.addClass('navbar-fixed-top');
            }
            else {
                ele.removeClass('navbar-fixed-top');
            }
        });

        $(document).on('click', '.themvaogiohang', function () {

            var phienbancount=$("#checkphienban").val();

            if(phienbancount!=0){
                if($("input[name='selectthuoctinh']:checked").length==0){
                Swal.fire({
                        title: 'Lỗi!',
                        text: 'Hãy chọn một phiên bản',
                        icon: 'info',
                        confirmButtonText: 'Ok'
                    });
                }
                else{
                    var soluong = $("#quantity").val();
                    var id = $("input[name='selectthuoctinh']:checked").attr('value');

                    var selected = "phienban";


                    $.ajax({
                        url: 'addtocart.html',
                        data: {soluong: soluong, id: id,thongso:selected},
                        type: 'post',
                        dataType: 'json',
                        beforeSend: function () {

                        },
                        success: function (data) {

                            $("#myCart .modal-content").html(data.hangdadat);
                            $("#myCart").modal("show");
                            $("#cart-block-view").html(data.minicart);
                            Swal.fire('Thông báo!', 'Thêm sản phẩm vào giỏ hàng thành công.', 'success');
                        },
                        complete: function () {
                        }
                    });
                }
            }
            else{
                var soluong2 = $("#quantity").val();
                var id2 = $("#idsanpham").val();

                var selected2 = 'sanphamthuong';


                $.ajax({
                    url: 'addtocart.html',
                    data: {soluong: soluong2, id: id2,thongso:selected2},
                    type: 'post',
                    dataType: 'json',
                    beforeSend: function () {
                    },
                    success: function (data) {
                        Swal.fire('Thông báo!', 'Thêm sản phẩm vào giỏ hàng thành công.', 'success');
                        $("#myCart .modal-content").html(data.hangdadat);
                        $("#myCart").modal("show");
                        $("#cart-block-view").html(data.minicart);
                    },
                    complete: function () {
                    }
                });
            }
        });

        $(document).ready(function () {
            $(document).on('click', '#dangnhap-btn', function () {

                $.ajax({
                    url: 'site/dangnhap.html',
                    type: 'post',
                    dataType:'json',
                    data: {username: $('#loginform-username').val(), password: $('#loginform-password').val()},
                    beforeSend: function () {
                        $('#thongbao').html('');
                    },
                    success: function (data) {
                        if(data.type==="success"){
                            location.reload();
                        }else
                        {
                            $('#thongbao').html("<div class='alert alert-danger'>"+data.message+"</div>");
                        }
                    }
                });
            });

            $(document).on('click','.muangay.buy_now',function () {
                $(".themvaogiohang").click();
                var phienbancount=$("#checkphienban").val();
                if(phienbancount!=0){
                    if($("input[name='selectthuoctinh']:checked").length==0){

                    }else{
                        setTimeout(function () {
                            location.href="/thanh-toan.html";
                        },500);
                    }
                }else{
                    setTimeout(function () {
                        location.href="/thanh-toan.html";
                    },500);
                }
            });
            $(document).on('click','.muatragop',function () {
                $(".themvaogiohang").click();
                var phienbancount=$("#checkphienban").val();
                if(phienbancount!=0){
                    if($("input[name='selectthuoctinh']:checked").length==0){

                    }else{
                        setTimeout(function () {
                            location.href="/thanh-toan.html?type=tragop";
                        },500);
                    }
                }
            });
        });
        $(document).on('click','.thongbaoupdate',function () {
            $("#myCart .modal-content").html("<p style='text-align: center ; padding: 20px'>You have not reached minimum order, please update your carts</p>");
            $("#myCart").modal("show");
        });

        $(document).on('click','.checkvalue',function () {
            var id = $(this).attr('id');
            $.ajax({
                url: 'product/thaydoigia.html',
                data: {id: id},
                type: 'post',
                dataType: 'json',
                beforeSend: function () {
                },
                success: function (data) {
                    $('.sale-value').html(data.sale)
                },
                complete: function () {
                }
            });
        });

        /*$(document).on('click', '.add_to_cart_button', function () {
            var soluong =$(this).attr('soluong');
            var idsp =$(this).attr('id');
            $.ajax({
                url: 'addtocart.html',
                data: {soluong: soluong, id: idsp},
                type: 'post',
                dataType: 'json',
                beforeSend: function () {
                },
                success: function (data) {
                    $("#myCart .modal-content").html(data.hangdadat);
                    $("#myCart").modal("show");
                },
                complete: function () {
                }
            });

        });*/
        /*up date so luong tren modal*/

        $(document).on("click","#update-cart-modal",function(event){
            event.preventDefault();
            $(this).html('Updating');
            $.ajax({
                type: 'POST',
                url: 'product/updatemodalgiohang.html',
                data: $('#form-update-quantity').serialize(),
                dataType: 'json',
                success: function(data) {
                    $("#myCart .modal-content").html(data.hangdadat);
                    $("#myCart").modal("show");
                    $('#update-cart-modal').html('Update Cart');
                }

            });
        });

        $(document).on("click",".deletemodal",function(event){
            event.preventDefault();
            var id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: 'product/xoagiohangmodal.html',
                data: {id:id},
                dataType: 'json',
                success: function(data) {
                    $("#myCart .modal-content").html(data.hangdadat);
                    $("#myCart").modal("show");
                    $("#cart-block-view").html(data.minicart);
                },
            });
        });








        $(document).on('change','.procs .filter-box:not(.tagfil) ul input',function () {
            $.ajax({
                url: "product/updatefilter.html",
                type: 'post',
                dataType:'json',
                data: $("#filter-form").serialize(),
                beforeSend: function () {
                    $("#product-list-area").html("");
                    $(".icon-loading").removeAttr('style');
                },
                success: function (data) {
                    setTimeout(function () {
                        $("#dst_hottrends").html(data.display0);
                        $("#product-list-area").html(data.display1);
                        $(".icon-loading").attr('style',"display: none;");
                    },1000);

                },
                complete: function () {
                }
            })
        });
        $(document).on('change','.brandcon .filter-box:not(.tagfil) ul input',function () {
            $.ajax({
                url: "product/updatebrand.html",
                type: 'post',
                data: $("#filter-form").serialize(),
                beforeSend: function () {
                    $("#product-list-area").html("");
                    $(".icon-loading").removeAttr('style');
                },
                success: function (data) {
                    setTimeout(function () {
                        $("#product-list-area").html(data);
                        $(".icon-loading").attr('style',"display: none;");
                    },1000);

                },
                complete: function () {
                }
            });
        });
        $(document).on('change','.tagfil ul input',function () {
            $.ajax({
                url: "site/updatefilter.html",
                type: 'post',
                data: $("#filter-form").serialize(),
                beforeSend: function () {
                    $("#hienthitag").html("");
                    $(".icon-loading").removeAttr('style');
                },
                success: function (data) {
                    $("#hienthitag").html(data);
                    $(".icon-loading").attr('style',"display: none;");
                },
                complete: function () {
                }
            })
        });
        $(document).on('click','.quickview',function () {
            var t= $(this);
            $.ajax({
                url: "product/quickview.html",
                type: 'post',
                data: {
                    id: t.attr('data-handle')
                },
                beforeSend: function () {
                    $("#quickview").html("");
                },
                success: function (data) {
                    setTimeout(function () {
                        $("#quickview").html(data);
                    },1000)
                },
                complete: function () {
                }
            })
        });
        $(document).on('click','.themvaogiohang',function () {
            var t= $(this);
            $("#quickview").attr('class','wrapper-quickview').html("");
            $("body").attr('class','index');
        });
        if ( jQuery('#featured-products').length > 0 ) {
            var owl_tab = jQuery('#featured-products');
            owl_tab.owlCarousel({
                navigation : true,
                pagination : false,
                margin: 20,
                loop: true,
                addClassActive: true,
                items : 5,
                itemsDesktop : [1199,5],
                itemsDesktopSmall : [980,5],
                itemsTablet: [768,4],
                itemsMobile : [479,2],
                pagination : false,
                responsive: {
                    0: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    960: {
                        items: 5
                    },
                    1366: {
                        items: 6
                    },

                },
            });

            owl_tab.find('.owl-next').css({"position":"absolute","right":"5px","top":"40%"});
            owl_tab.find('.owl-prev').css({"position":"absolute","left":"5px","top":"40%"});
            checkItemOwlShow($('#coll-index-1'),'no-tab',5,5,4,2);
            jQuery(window).resize();

        }
    });
})(jQuery);
