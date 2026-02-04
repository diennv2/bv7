$(document).on('click','.tab-seo',function () {

    $(".seo-content").toggle();
});

$(document).on('click','.radio-img',function () {
    var id = $(this).attr('id');
    $.ajax({
        url: 'defaultimg',
        data: {id: id},
        type: 'post',
        dataType: 'json',
        success: function (data) {
        }
    })
});


$(document).on('click','.home-change',function () {
    var t= $(this);

    $.ajax({
        url: "/admin/"+t.attr('control')+"/updatehome",
        data: {
            id: t.attr('vals')
        },
        type: 'post',
        beforeSend: function () {
            block({target: "#crud-datatable-container"});
        },
        success: function () {

        },
        complete: function () {
            if(t.attr('class')==='home-change glyphicon glyphicon-ok text-success')
                t.removeAttr('class').attr('class','home-change glyphicon glyphicon-remove text-danger');
            else
                t.removeAttr('class').attr('class','home-change glyphicon glyphicon-ok text-success');
            unblock("#crud-datatable-container");
        }
    });

});
$(document).on('click','.active-change',function () {
    var t= $(this);

    $.ajax({
        url: "/admin/"+t.attr('control')+"/updateactive",
        data: {
            id: t.attr('vals')
        },
        type: 'post',
        beforeSend: function () {
            block({target: "#crud-datatable-container"});
        },
        success: function () {

        },
        complete: function () {
            if(t.attr('class')==='active-change glyphicon glyphicon-ok text-success')
                t.removeAttr('class').attr('class','active-change glyphicon glyphicon-remove text-danger');
            else
                t.removeAttr('class').attr('class','active-change glyphicon glyphicon-ok text-success');
            unblock("#crud-datatable-container");
        }
    });
});
$(document).on('change','.update-parent',function () {
    var t= $(this);
    $.ajax({
        url: "/admin/"+t.attr('control')+"/updateparent",
        data: {
            id: t.attr('vals'),
            value: t.val()
        },
        type: 'post',
        beforeSend: function () {
            block({target: "#crud-datatable-container"});
        },
        success: function () {
            $.pjax.reload({container:"#crud-datatable-pjax"});
        },
        complete: function () {
            unblock("#crud-datatable-container");
        }
    });
});
$(document).on('change','.update-foreign',function () {
    var t= $(this);
    $.ajax({
        url: "/admin/"+t.attr('control')+"/updateforeign",
        data: {
            id: t.attr('vals'),
            value: t.val(),
            foreign: t.attr('foreign')
        },
        type: 'post',
        beforeSend: function () {
            block({target: "#crud-datatable-container"});
        },
        success: function () {

        },
        complete: function () {
            unblock("#crud-datatable-container");
        }
    });
});

$(document).on('change','.position-change',function () {
    var t= $(this);
    $.ajax({
        url: "/admin/"+t.attr('control')+"/updateposition",
        data: {
            id: t.attr('vals'),
            value: t.val()
        },
        type: 'post',
        beforeSend: function () {
            block({target: "#crud-datatable-container"});
        },
        success: function () {
        },
        complete: function () {
            unblock("#crud-datatable-container");
        }
    })
})
$(document).on('change','.update-position',function () {

    var t= $(this);

    $.ajax({

        url: "/admin/"+t.attr('control')+"/updateposition",

        data: {

            id: t.attr('vals'),

            value: t.val()

        },

        type: 'post',

        beforeSend: function () {

            block({target: "#crud-datatable-container"});

        },

        success: function () {

            $.pjax.reload({container:"#crud-datatable-pjax"});

        },

        complete: function () {

            unblock("#crud-datatable-container");

        }

    });

});
$(document).on('change','.ord-change',function () {
    var t= $(this);
    $.ajax({
        url: "/admin/"+t.attr('control')+"/updateord",
        data: {
            id: t.attr('vals'),
            value: t.val()
        },
        type: 'post',
        beforeSend: function () {
            block({target: "#crud-datatable-container"});
        },
        success: function () {
        },
        complete: function () {
            unblock("#crud-datatable-container");
        }
    })
});
$(document).on('change','.position-change',function () {

    var t= $(this);

    $.ajax({

        url: "/admin/"+t.attr('control')+"/updateposition",

        data: {

            id: t.attr('vals'),

            value: t.val()

        },
        type: 'post',

        beforeSend: function () {

            block({target: "#crud-datatable-container"});
        },
        success: function () {
        },

        complete: function () {

            unblock("#crud-datatable-container");

        }

    })

});
$(document).on('click','.hot-change',function () {
    var t= $(this);
    $.ajax({
        url: "/admin/"+t.attr('control')+"/updatehot",
        data: {
            id: t.attr('vals'),
            value: t.val()
        },
        type: 'post',
        beforeSend: function () {
            block({target: "#crud-datatable-container"});
        },
        success: function () {
        },
        complete: function () {
            if(t.attr('class')==='hot-change glyphicon glyphicon-ok text-success')
                t.removeAttr('class').attr('class','hot-change glyphicon glyphicon-remove text-danger');
            else
                t.removeAttr('class').attr('class','hot-change glyphicon glyphicon-ok text-success');
            unblock("#crud-datatable-container");
        }
    })
});
$(document).on('change','.hots-change',function () {
    var t= $(this);
    $.ajax({
        url: "/admin/"+t.attr('control')+"/updatehot",
        data: {
            id: t.attr('vals'),
            value: t.val()
        },
        type: 'post',
        beforeSend: function () {
            block({target: "#crud-datatable-container"});
        },
        success: function () {
        },
        complete: function () {

            unblock("#crud-datatable-container");
        }
    })
});
$(document).on('click','.new-change',function () {
    var t= $(this);
    $.ajax({
        url: "/admin/"+t.attr('control')+"/updatenew",
        data: {
            id: t.attr('vals'),
            value: t.val()
        },
        type: 'post',
        beforeSend: function () {
            block({target: "#crud-datatable-container"});
        },
        success: function () {
        },
        complete: function () {

            if(t.attr('class')==='hot-change glyphicon glyphicon-ok text-success')
                t.removeAttr('class').attr('class','new-change glyphicon glyphicon-remove text-danger');
            else
                t.removeAttr('class').attr('class','new-change glyphicon glyphicon-ok text-success');
            unblock("#crud-datatable-container");
        }
    })
});

//editor
var imageTypes = ['jpeg', 'jpg', 'png']; //Validate the images to show
function showImage(src, target)
{
    var fr = new FileReader();
    fr.onload = function(e)
    {
        target.src = this.result;
    };
    fr.readAsDataURL(src.files[0]);

}
var uploadImage = function(obj)
{
    $('#img-view').html('<img id="aImgShow" src="" style="width: 150px; margin-top:20px" class="hidden"/><a data-toggle="collapse" data-target="#aImgShow" aria-expanded="true">Hiện/ẩn ảnh</a>');
    var val = obj.value;
    var lastInd = val.lastIndexOf('.');
    var ext = val.slice(lastInd + 1, val.length);
    console.log(imageTypes.indexOf(ext))
    if (imageTypes.indexOf(ext) !== -1)
    {
        var id = $(obj).data('target');
        var src = obj;
        var target = $(id)[0];
        showImage(src, target);

    }
    else
    {
        $('#img-view').html("");
    }
    $("#aImgShow").removeAttr('class').attr('class','colapse collapse in');
};

var uploadImage2 = function(obj)
{

    var val = obj.value;
    var lastInd = val.lastIndexOf('.');
    var ext = val.slice(lastInd + 1, val.length);
    console.log(imageTypes.indexOf(ext))
    if (imageTypes.indexOf(ext) !== -1)
    {
        var id = $(obj).data('target');
        var src = obj;
        var target = $(id)[0];
        showImage(src, target);

    }
    else
    {
        $('#img-view').html("");
    }
    $("#aImgShow").removeAttr('class').attr('class','colapse collapse in');
};
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
CKEDITOR.config.width= "100%";
CKEDITOR.plugins.registered['save']=
    {
        init : function( editor )
        {
            var command = editor.addCommand( 'save',
                {
                    modes : { wysiwyg:1, source:1 },
                    exec : function( editor ) {
                        var fo=editor.element.$.form;
                        editor.updateElement();
                        rxsubmit(fo);
                    }
                }
            );
            editor.ui.addButton( 'Save',{label : 'My Save',command : 'save'});
        }
    };
/*-------------------------------------------------------------------------------*/
$(document).on('click', '.btn-view-cthd', function () {
    var iddonhang = $(this).attr('id');
    $.pjax.reload({container: '#grid-CTDDH', data: {iddonhang: iddonhang}, method: 'post'});
    $("#modal-chitet-donhang").modal("show");

});
/*them thuoc tinh cho san pham*/
$(document).on('click', '.click-thongso', function (e) {
    e.preventDefault();
    var id = $(this).attr('id');
    var giatri =$(this).attr('giatri');
    var types =$(this).attr('types');

    var table = "#table-them-"+giatri+" tbody";
    var emptyRow = $(table+" .emptyRow").length;

    var indexsanpham = parseInt($("#index-sanpham-"+giatri).val(), 10);

    $.ajax({
        url: 'addnewrow',
        data: {
            indexsanpham: indexsanpham,
            giatri:giatri,
            types:types
        },
        type: 'post',
        dataType:'json',
        beforeSend: function () {
        },
        success: function (data) {

            if (emptyRow > 0) {
                $(table).html(data.newRow);
            }
            else
                $(table).append(data.newRow);
            indexsanpham++;
            $("#index-sanpham-"+giatri).val(indexsanpham);
        },
        error: function (r1, r2) {
            alert(r2.responseText)
        }
    })
});
$(document).on('click','.btn-remove-row',function (e) {
    e.preventDefault();
    var id = $(this).attr('id');
    var giatri = $(this).attr('xoa');
    var table = "#table-them-"+giatri+" tbody";
    $("#"+id).parent().parent().remove();
    var sodongconlai = $(table+ " tr").length;
    if (sodongconlai ==0)
        $(table).html('<tr class="emptyRow"><td colspan="6"><p>chưa nhập thông tin</p></td></tr>')
});

function selectchange(e) {
    $.ajax({
        url: 'bindproperties',
        data: {idcatproduct: e},
        type: 'post',
        dataType:'json',
        beforeSend: function () {
        },
        success: function (data) {
            $('#tab2').html(data.property)
        }
    })
}
$(document).on('change','.btn-trangthai',function () {
   var id = $(this).attr('id');
    var val = $(this).val();
    if(confirm("bạn có muốn lưu không")) {
        $.ajax({
            url: 'bill/updatetrangthai',
            data: {id: id, value: val},
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (data) {

                $.pjax.reload({
                    container: '#crud-datatable',
                });

            }
        })
    }
});



