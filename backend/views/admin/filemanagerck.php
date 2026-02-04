<script src="/admin/themes/js/jquery-1.11.3.min.js"></script>
<script src="/admin/themes/plugins/jquery-ui/jquery-ui.js"></script>
<script src="/admin/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.js"></script>
<script src="/admin/themes/plugins/jquery.blockui.min.js"></script>
<link rel="stylesheet" href="/admin/themes/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/admin/themes/css/components.css">
<link rel="stylesheet" href="/admin/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css">
<link rel="stylesheet" href="/admin/themes/plugins/font-awesome/css/font-awesome.min.css">


<link rel="stylesheet" href="/admin/jQuery-File-Upload-master/css/jquery.fileupload.css" />
<link rel="stylesheet" href="/admin/jQuery-File-Upload-master/css/jquery.fileupload-ui.css" />
<script src="/admin/jQuery-File-Upload-master/js/vendor/jquery.ui.widget.js"></script>
<script src="/admin/jQuery-File-Upload-master/js/tmpl.min.js"></script>
<script src="/admin/jQuery-File-Upload-master/js/load-image.all.min.js"></script>
<script src="/admin/jQuery-File-Upload-master/js/canvas-to-blob.min.js"></script>
<script src="/admin/jQuery-File-Upload-master/js/jquery.blueimp-gallery.min.js"></script>
<script src="/admin/jQuery-File-Upload-master/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="/admin/jQuery-File-Upload-master/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="/admin/jQuery-File-Upload-master/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="/admin/jQuery-File-Upload-master/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="/admin/jQuery-File-Upload-master/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="/admin/jQuery-File-Upload-master/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="/admin/jQuery-File-Upload-master/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="/admin/jQuery-File-Upload-master/js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->

<input type="hidden" value="<?=$_GET['CKEditorFuncNum']?>" id="funcnum">
      <script src="/admin/jQuery-File-Upload-master/js/cors/jquery.xdr-transport.js"></script>
<style>
    .gtreetable .icon{position:relative;top:1px;display:inline-block;font-family:'Glyphicons Halflings';font-style:normal;font-weight:400;line-height:1;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.gtreetable .node-name{line-height:28px;cursor:pointer}.gtreetable .node-loading{background:url(data:image/gif;base64,R0lGODlhEAAQAIQAACQmJJyanMzOzOzq7GRiZNze3LS2tPT29ERCRNza3OTm5MTCxPz+/CwuLJyenNTS1Ozu7IyKjOTi5Pz6/FRWVMTGxP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQJBgAWACwAAAAAEAAQAAAFf6AlWpP0KA4RQGMrLXARAUDjtGSyGItMAwiWSFI5JAQKBsRAQUgSEhKsyGgxBrrFoQATVHEMQewBU+BGiq6kUJicRRO2QsF2v+MFBXlhfg+6XAteZ2ExEzALE18iDBNZBxYFRUcDExMDApMFjI6IbIhFOC8xgT1vW0gSAgWQIyEAIfkECQYAFwAsAAAAABAAEACEJCYknJqczM7M7OrsZGJktLa03N7c9Pb0VFZUpKak3NrchIKExMLE5Obk/P78LC4snJ6c1NLU7O7s5OLk/Pr8lJKUxMbE////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABXzgJV7UFDXmdIzsxLyG8TITSypMwcSzRY0Ty0EhaDgoDYtwASG9hA7WcQF4SGQMQdTmQAAAgcirYRsVvoRJ7Fe+SCqVRGPdJhkmpnF98BJgtWUOAjAUMxRbIkc4DCsGQkQDFBQDAo8GiRSLO1gMQjYuMJyXZQcGRRN+KyMhACH5BAkGABcALAAAAAAQABAAhCQmJJyanMzOzOzq7GRiZLS2tNze3PT29FRWVKSmpNza3ISChMTCxOTm5Pz+/CwuLJyenNTS1Ozu7OTi5Pz6/JSSlMTGxP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAV+4CVe1BQ15nSM7MS8hvEyE0sqTMHEs0WNE8tBIWg4KA2LUFGjvIQO1hHHOMgYgqjNIYBFXg3bqPESTGI/MSnWaKDVF0mlkvgywuoCAEC4ZsUOCHsBTi8UWiJHCwAPAxcGSwIDFBQDAkILAYkUVDtXhjYuMDI6NWJWRRNFaSIhACH5BAkGABYALAAAAAAQABAAAAV8oCVak/QopnSMrLS8RfEuEksmi7HEczWNksohIVAwJoqKMFGbvIQM1hG3OMgWgqiNIYA9XgrbSPESSGI/MSmmUKDV64LiuwirB+VrVsyFOV8TWiIMA1QrBUsCAxMQBhQIEgkFgxNUOxEAmQh2QDMFmAANDmpWRQ4EAQMsIQAh+QQJBgAWACwAAAAAEAAQAIQkJiScmpzMzszs6uy0trTc3txUVlT09vSsrqzc2tzEwsTk5uSEgoT8/vwsLiycnpzU0tTs7uzk4uRkYmT8+vzExsT///8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAFfKAlWpQELaZ0jKykvEXxKhJLJgqhxHNFjZLKISFYNCiLijBRo7yEDdYRpzjIFIKorSGAQV4L22jxEkhiPzEptlig1evC4qsIqwfla1bMhTlfFFoiUy8rBUIMBgQRFAMCQhAFgxQMAJYBVAo+Ng8OlzI6NWIDARMIEkVpIiEAIfkECQYAFwAsAAAAABAAEACEJCYknJqczM7M7OrsZGJktLa03N7c9Pb0REJEpKak3NrcxMLE5Obk/P78LC4snJ6c1NLU7O7slJKU5OLk/Pr8VFZUxMbE////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABX/gJV7UBDHmdIzstLyG8S4TSypLscSzRY0Ty0EhYDQoDItQUaO8hA3WEbc4yBaCqK0hgEFeDNuI8RJMYj8xKcZISCQR9drAIAAABfmgHLhXtFJdOxEOAAgDgBdTLysPCBNEAxQUAwJCEAYiDQNUO1cLPjYuMDI6NWJWRRNFaSIhACH5BAkGABcALAAAAAAQABAAhCQmJJyanMzOzOzq7GRiZLS2tNze3PT29ERCRKSmpNza3MTCxOTm5Pz+/CwuLJyenNTS1Ozu7JSSlOTi5Pz6/FRWVMTGxP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAV/4CVe1AQx5nSM7LS8hvEuE3tFylsw8mtRowdiohAwGgeGxXJQ1CIOAOLIalByi0MAAKg0bJeGAEbgFsCiwUuQkEgiaJLCgDJMgOhDjAF5MeJqCwIugl82YjAHMxSGIlZYKwZMRQMUFAMCkwaOVzMxM0w2hAufMHkGRhMCBisjIQAh+QQJBgAWACwAAAAAEAAQAIQkJiScmpzMzszs6uy0trTc3txUVlT09vSsqqzc2tzEwsTk5uSEgoT8/vwsLiycnpzU0tTs7uzk4uRkYmT8+vzExsT///8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAFfaAlWlEwIRIkHWP7OAAQFEottRbFxDJdV5SRpHJgGAgRyqJCTNwov0Nw1KAkagefoIGzNAS1AqS26IoWNYGkUJh2KezFgu3GwQuLsaJsHqS1XDhfYVA1FIEiVVcKLAVNAgMUFAMCTQWJVjUKbJpEOBKanGFmWQILEgIFLCMhADs=) no-repeat;padding-left:22px}.gtreetable .node-icon-selected{margin-right:6px;display:none}.gtreetable .node-icon-selected:before{content:"\e013"}.gtreetable .node-icon-type{margin-right:12px;opacity:.2;filter:alpha(opacity=20);display:none}.gtreetable .node-icon-ce{margin-right:6px;opacity:.2;filter:alpha(opacity=20);cursor:pointer}.gtreetable .node-icon-ce:before{content:"\e080"}.gtreetable .node-expanded .node-icon-ce{-webkit-transform:rotate(90deg);-ms-transform:rotate(90deg);-o-transform:rotate(90deg);transform:rotate(90deg)}.gtreetable .node-hovered{background-color:#f5f5f5}.gtreetable .node-hovered .node-icon-ce,.gtreetable .node-hovered .node-icon-type{opacity:1;filter:alpha(opacity=100)}.gtreetable .node-icon-handle{padding-right:12px;cursor:url(data:image/x-icon;base64,AAACAAEAICACAAcABQAwAQAAFgAAACgAAAAgAAAAQAAAAAEAAQAAAAAAAAEAAAAAAAAAAAAAAgAAAAAAAAAAAAAA////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD8AAAA/AAAAfwAAAP+AAAH/gAAB/8AAA//AAAd/wAAGf+AAAH9gAADbYAAA2yAAAZsAAAGbAAAAGAAAAAAAAA//////////////////////////////////////////////////////////////////////////////////////gH///4B///8Af//+AD///AA///wAH//4AB//8AAf//AAD//5AA///gAP//4AD//8AF///AB///5A////5///8=),move;background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAECAMAAABx7QVyAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAAZQTFRFzMzM////040VdgAAAAJ0Uk5T/wDltzBKAAAAFklEQVR42mJgYGBkAAEQyQgCEBIgwAAAeAAN4Rn1SQAAAABJRU5ErkJggg==) repeat-y;visibility:hidden}.gtreetable .node-draggable.node-hovered .node-icon-handle{visibility:visible}.gtreetable .node-buttons{visibility:hidden}.gtreetable.gtreetable-fullAccess .node-hovered.node-saved .node-buttons,.gtreetable.gtreetable-fullAccess .node-selected.node-saved .node-buttons{visibility:visible}.gtreetable .node-selected .node-icon-selected{display:inline-block}.gtreetable input{display:inline;margin-right:6px;height:28px;padding:3px 6px}.gtreetable .node-draggable-helper{cursor:url(data:image/x-icon;base64,AAACAAEAICACAAcABQAwAQAAFgAAACgAAAAgAAAAQAAAAAEAAQAAAAAAAAEAAAAAAAAAAAAAAgAAAAAAAAAAAAAA////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD8AAAA/AAAAfwAAAP+AAAH/gAAB/8AAAH/AAAB/wAAA/0AAANsAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA//////////////////////////////////////////////////////////////////////////////////////gH///4B///8Af//+AD///AA///wAH//+AB///wAf//4AH//+AD///yT/////////////////////////////8=),pointer}.gtreetable .node-draggable-pointer{position:absolute;visibility:hidden;display:inline-block;width:0;height:0;margin-left:2px;vertical-align:middle;border-top:6px solid;border-right:6px solid transparent;border-left:6px solid transparent;transform:rotate(-90deg)}.node-draggable-container{background-color:#f5f5f5}.node-draggable-container .node-draggable-pointer{visibility:visible}
    span:has(.node-icon-selected){

        color: black;
    }
    .dropdown-menu{
       margin-top: 0!important;
    }
    .btn-group.pull-right.node-buttons{
        position: absolute;
        right: 0;
    }
</style>
<script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-upload fade{%=o.options.loadImageFileTypes.test(file.type)?' image':''%}">
            <td>
                <span class="preview"></span>
            </td>
            <td>
                <p class="name">{%=file.name%}</p>
                <strong class="error text-danger"></strong>
            </td>
            <td>
                <p class="size">Processing...</p>
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
            </td>
            <td>
                {% if (!o.options.autoUpload && o.options.edit && o.options.loadImageFileTypes.test(file.type)) { %}
                  <button class="btn btn-success edit" data-index="{%=i%}" disabled>
                      <i class="glyphicon glyphicon-edit"></i>
                      <span>Edit</span>
                  </button>
                {% } %}
                {% if (!i && !o.options.autoUpload) { %}
                    <button class="btn btn-primary start" disabled>
                        <i class="glyphicon glyphicon-upload"></i>
                        <span>Start</span>
                    </button>
                {% } %}
                {% if (!i) { %}
                    <button class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancel</span>
                    </button>
                {% } %}
            </td>
        </tr>
    {% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-download fade{%=file.thumbnailUrl?' image':''%}">
            <td>
                <span class="preview">
                    {% if (file.thumbnailUrl) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                    {% } %}
                </span>
            </td>
            <td>
                <p class="name">
                    {% if (file.url) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                    {% } else { %}
                        <span>{%=file.name%}</span>
                    {% } %}
                </p>
                {% if (file.error) { %}
                    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                {% } %}
            </td>
            <td>
                <span class="size">{%=o.formatFileSize(file.size)%}</span>
            </td>
            <td>
                {% if (file.deleteUrl) { %}
                    <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                        <i class="glyphicon glyphicon-trash"></i>
                        <span>Delete</span>
                    </button>
                    <input type="checkbox" name="delete" value="1" class="toggle">
                {% } else { %}
                    <button class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancel</span>
                    </button>
                {% } %}
            </td>
        </tr>
    {% } %}
</script>
<script>
    function block(options) {
        var globalImgPath = "<?php echo Yii::$app->urlManager->baseUrl ?>"+'/themes/img/';

        options = $.extend(true, {}, options);
        var html = '';
        if (options.animate) {
            html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '">' + '<div class="block-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>' + '</div>';
        } else if (options.iconOnly) {
            html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><img src="' + globalImgPath + 'loading-spinner-grey.gif" align=""></div>';
        } else if (options.textOnly) {
            html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><span>&nbsp;&nbsp;' + (options.message ? options.message : 'LOADING...') + '</span></div>';
        } else {
            html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><img src="' + globalImgPath + 'loading-spinner-grey.gif" align=""><span>&nbsp;&nbsp;' + (options.message ? options.message : 'LOADING...') + '</span></div>';
        }

        if (options.target) { // element blocking
            var el = $(options.target);
            if (el.height() <= ($(window).height())) {
                options.cenrerY = true;
            }
            el.block({
                message: html,
                baseZ: options.zIndex ? options.zIndex : 1000,
                centerY: options.cenrerY !== undefined ? options.cenrerY : false,
                css: {
                    top: '10%',
                    border: '0',
                    padding: '0',
                    backgroundColor: 'none'
                },
                overlayCSS: {
                    backgroundColor: options.overlayColor ? options.overlayColor : '#555',
                    opacity: options.boxed ? 0.05 : 0.1,
                    cursor: 'wait'
                }
            });
        } else { // page blocking
            $.blockUI({
                message: html,
                baseZ: options.zIndex ? options.zIndex : 1000,
                css: {
                    border: '0',
                    padding: '0',
                    backgroundColor: 'none'
                },
                overlayCSS: {
                    backgroundColor: options.overlayColor ? options.overlayColor : '#555',
                    opacity: options.boxed ? 0.05 : 0.1,
                    cursor: 'wait'
                }
            });
        }
    }

    function unblock(target) {
        if (target) {
            $(target).unblock({
                onUnblock: function() {
                    $(target).css('position', '');
                    $(target).css('zoom', '');
                }
            });
        } else {
            $.unblockUI();
        }
    }
</script>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-purple-plum">
            <i class="icon-speech font-purple-plum"></i>
            <span class="caption-subject bold uppercase"> Trình quản lý file</span>
            <span class="caption-helper">Chỉ chấp nhận file ảnh và file tài liệu</span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="col-md-3">
            <table class="table table-hover table-light gtreetable" id="gtreetable">
                <thead>
                <tr>
                    <th>
                        File Upload
                    </th>
                </tr>
                </thead>
            </table>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-9 upload" style="display: none">
            <button style="margin-bottom: 5px" id="backtodisplay" class="btn btn-success"><i class="fa fa-backward"></i> Quay lại</button>
            <form
                    id="fileupload"
                    action="/admin/admin/uploadfile"
                    method="POST"
                    enctype="multipart/form-data"
            >
                <input name="tbr" type="hidden" id="folder">
                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->csrfToken?>">
                <div class="row fileupload-buttonbar">
                    <div class="col-lg-7">
                        <!-- The fileinput-button span is used to style the file input field as button -->
                        <span class="btn btn-success fileinput-button">
              <i class="glyphicon glyphicon-plus"></i>
              <span>Add files...</span>
              <input type="file" name="files[]" multiple />
            </span>
                        <button type="submit" class="btn btn-primary start">
                            <i class="glyphicon glyphicon-upload"></i>
                            <span>Start upload</span>
                        </button>
                        <button type="reset" class="btn btn-warning cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancel upload</span>
                        </button>
                        <button type="button" class="btn btn-danger delete">
                            <i class="glyphicon glyphicon-trash"></i>
                            <span>Delete selected</span>
                        </button>
                        <input type="checkbox" class="toggle" />
                        <!-- The global file processing state -->
                        <span class="fileupload-process"></span>
                    </div>
                    <!-- The global progress state -->
                    <div class="col-lg-5 fileupload-progress fade">
                        <!-- The global progress bar -->
                        <div
                                class="progress progress-striped active"
                                role="progressbar"
                                aria-valuemin="0"
                                aria-valuemax="100"
                        >
                            <div
                                    class="progress-bar progress-bar-success"
                                    style="width: 0%;"
                            ></div>
                        </div>
                        <!-- The extended global progress state -->
                        <div class="progress-extended">&nbsp;</div>
                    </div>
                </div>
                <!-- The table listing the files available for upload/download -->
                <table role="presentation" class="table table-striped">
                    <tbody class="files"></tbody>
                </table>
            </form>
        </div>
        <div class="col-md-9 display">
            <button id="add" class="btn btn-success hidden"><i class="fa fa-cloud-upload"></i> Tải file lên</button>
            <div  id="result-ck" style="max-height: 600px;min-height: 400px;overflow-y: scroll;overflow-x: hidden;padding-top: 10px;padding-bottom: 10px">

            </div>

        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</div>
<script>


    $(".modal-dialog").addClass("modal-full");
    /*!
 * Bootstrap v3.4.1 (https://getbootstrap.com/)
 * Copyright 2011-2019 Twitter, Inc.
 * Licensed under the MIT license
 */
    if("undefined"==typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");!function(t){"use strict";var e=jQuery.fn.jquery.split(" ")[0].split(".");if(e[0]<2&&e[1]<9||1==e[0]&&9==e[1]&&e[2]<1||3<e[0])throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 4")}(),function(n){"use strict";n.fn.emulateTransitionEnd=function(t){var e=!1,i=this;n(this).one("bsTransitionEnd",function(){e=!0});return setTimeout(function(){e||n(i).trigger(n.support.transition.end)},t),this},n(function(){n.support.transition=function o(){var t=document.createElement("bootstrap"),e={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var i in e)if(t.style[i]!==undefined)return{end:e[i]};return!1}(),n.support.transition&&(n.event.special.bsTransitionEnd={bindType:n.support.transition.end,delegateType:n.support.transition.end,handle:function(t){if(n(t.target).is(this))return t.handleObj.handler.apply(this,arguments)}})})}(jQuery),function(s){"use strict";var e='[data-dismiss="alert"]',a=function(t){s(t).on("click",e,this.close)};a.VERSION="3.4.1",a.TRANSITION_DURATION=150,a.prototype.close=function(t){var e=s(this),i=e.attr("data-target");i||(i=(i=e.attr("href"))&&i.replace(/.*(?=#[^\s]*$)/,"")),i="#"===i?[]:i;var o=s(document).find(i);function n(){o.detach().trigger("closed.bs.alert").remove()}t&&t.preventDefault(),o.length||(o=e.closest(".alert")),o.trigger(t=s.Event("close.bs.alert")),t.isDefaultPrevented()||(o.removeClass("in"),s.support.transition&&o.hasClass("fade")?o.one("bsTransitionEnd",n).emulateTransitionEnd(a.TRANSITION_DURATION):n())};var t=s.fn.alert;s.fn.alert=function o(i){return this.each(function(){var t=s(this),e=t.data("bs.alert");e||t.data("bs.alert",e=new a(this)),"string"==typeof i&&e[i].call(t)})},s.fn.alert.Constructor=a,s.fn.alert.noConflict=function(){return s.fn.alert=t,this},s(document).on("click.bs.alert.data-api",e,a.prototype.close)}(jQuery),function(s){"use strict";var n=function(t,e){this.$element=s(t),this.options=s.extend({},n.DEFAULTS,e),this.isLoading=!1};function i(o){return this.each(function(){var t=s(this),e=t.data("bs.button"),i="object"==typeof o&&o;e||t.data("bs.button",e=new n(this,i)),"toggle"==o?e.toggle():o&&e.setState(o)})}n.VERSION="3.4.1",n.DEFAULTS={loadingText:"loading..."},n.prototype.setState=function(t){var e="disabled",i=this.$element,o=i.is("input")?"val":"html",n=i.data();t+="Text",null==n.resetText&&i.data("resetText",i[o]()),setTimeout(s.proxy(function(){i[o](null==n[t]?this.options[t]:n[t]),"loadingText"==t?(this.isLoading=!0,i.addClass(e).attr(e,e).prop(e,!0)):this.isLoading&&(this.isLoading=!1,i.removeClass(e).removeAttr(e).prop(e,!1))},this),0)},n.prototype.toggle=function(){var t=!0,e=this.$element.closest('[data-toggle="buttons"]');if(e.length){var i=this.$element.find("input");"radio"==i.prop("type")?(i.prop("checked")&&(t=!1),e.find(".active").removeClass("active"),this.$element.addClass("active")):"checkbox"==i.prop("type")&&(i.prop("checked")!==this.$element.hasClass("active")&&(t=!1),this.$element.toggleClass("active")),i.prop("checked",this.$element.hasClass("active")),t&&i.trigger("change")}else this.$element.attr("aria-pressed",!this.$element.hasClass("active")),this.$element.toggleClass("active")};var t=s.fn.button;s.fn.button=i,s.fn.button.Constructor=n,s.fn.button.noConflict=function(){return s.fn.button=t,this},s(document).on("click.bs.button.data-api",'[data-toggle^="button"]',function(t){var e=s(t.target).closest(".btn");i.call(e,"toggle"),s(t.target).is('input[type="radio"], input[type="checkbox"]')||(t.preventDefault(),e.is("input,button")?e.trigger("focus"):e.find("input:visible,button:visible").first().trigger("focus"))}).on("focus.bs.button.data-api blur.bs.button.data-api",'[data-toggle^="button"]',function(t){s(t.target).closest(".btn").toggleClass("focus",/^focus(in)?$/.test(t.type))})}(jQuery),function(p){"use strict";var c=function(t,e){this.$element=p(t),this.$indicators=this.$element.find(".carousel-indicators"),this.options=e,this.paused=null,this.sliding=null,this.interval=null,this.$active=null,this.$items=null,this.options.keyboard&&this.$element.on("keydown.bs.carousel",p.proxy(this.keydown,this)),"hover"==this.options.pause&&!("ontouchstart"in document.documentElement)&&this.$element.on("mouseenter.bs.carousel",p.proxy(this.pause,this)).on("mouseleave.bs.carousel",p.proxy(this.cycle,this))};function r(n){return this.each(function(){var t=p(this),e=t.data("bs.carousel"),i=p.extend({},c.DEFAULTS,t.data(),"object"==typeof n&&n),o="string"==typeof n?n:i.slide;e||t.data("bs.carousel",e=new c(this,i)),"number"==typeof n?e.to(n):o?e[o]():i.interval&&e.pause().cycle()})}c.VERSION="3.4.1",c.TRANSITION_DURATION=600,c.DEFAULTS={interval:5e3,pause:"hover",wrap:!0,keyboard:!0},c.prototype.keydown=function(t){if(!/input|textarea/i.test(t.target.tagName)){switch(t.which){case 37:this.prev();break;case 39:this.next();break;default:return}t.preventDefault()}},c.prototype.cycle=function(t){return t||(this.paused=!1),this.interval&&clearInterval(this.interval),this.options.interval&&!this.paused&&(this.interval=setInterval(p.proxy(this.next,this),this.options.interval)),this},c.prototype.getItemIndex=function(t){return this.$items=t.parent().children(".item"),this.$items.index(t||this.$active)},c.prototype.getItemForDirection=function(t,e){var i=this.getItemIndex(e);if(("prev"==t&&0===i||"next"==t&&i==this.$items.length-1)&&!this.options.wrap)return e;var o=(i+("prev"==t?-1:1))%this.$items.length;return this.$items.eq(o)},c.prototype.to=function(t){var e=this,i=this.getItemIndex(this.$active=this.$element.find(".item.active"));if(!(t>this.$items.length-1||t<0))return this.sliding?this.$element.one("slid.bs.carousel",function(){e.to(t)}):i==t?this.pause().cycle():this.slide(i<t?"next":"prev",this.$items.eq(t))},c.prototype.pause=function(t){return t||(this.paused=!0),this.$element.find(".next, .prev").length&&p.support.transition&&(this.$element.trigger(p.support.transition.end),this.cycle(!0)),this.interval=clearInterval(this.interval),this},c.prototype.next=function(){if(!this.sliding)return this.slide("next")},c.prototype.prev=function(){if(!this.sliding)return this.slide("prev")},c.prototype.slide=function(t,e){var i=this.$element.find(".item.active"),o=e||this.getItemForDirection(t,i),n=this.interval,s="next"==t?"left":"right",a=this;if(o.hasClass("active"))return this.sliding=!1;var r=o[0],l=p.Event("slide.bs.carousel",{relatedTarget:r,direction:s});if(this.$element.trigger(l),!l.isDefaultPrevented()){if(this.sliding=!0,n&&this.pause(),this.$indicators.length){this.$indicators.find(".active").removeClass("active");var h=p(this.$indicators.children()[this.getItemIndex(o)]);h&&h.addClass("active")}var d=p.Event("slid.bs.carousel",{relatedTarget:r,direction:s});return p.support.transition&&this.$element.hasClass("slide")?(o.addClass(t),"object"==typeof o&&o.length&&o[0].offsetWidth,i.addClass(s),o.addClass(s),i.one("bsTransitionEnd",function(){o.removeClass([t,s].join(" ")).addClass("active"),i.removeClass(["active",s].join(" ")),a.sliding=!1,setTimeout(function(){a.$element.trigger(d)},0)}).emulateTransitionEnd(c.TRANSITION_DURATION)):(i.removeClass("active"),o.addClass("active"),this.sliding=!1,this.$element.trigger(d)),n&&this.cycle(),this}};var t=p.fn.carousel;p.fn.carousel=r,p.fn.carousel.Constructor=c,p.fn.carousel.noConflict=function(){return p.fn.carousel=t,this};var e=function(t){var e=p(this),i=e.attr("href");i&&(i=i.replace(/.*(?=#[^\s]+$)/,""));var o=e.attr("data-target")||i,n=p(document).find(o);if(n.hasClass("carousel")){var s=p.extend({},n.data(),e.data()),a=e.attr("data-slide-to");a&&(s.interval=!1),r.call(n,s),a&&n.data("bs.carousel").to(a),t.preventDefault()}};p(document).on("click.bs.carousel.data-api","[data-slide]",e).on("click.bs.carousel.data-api","[data-slide-to]",e),p(window).on("load",function(){p('[data-ride="carousel"]').each(function(){var t=p(this);r.call(t,t.data())})})}(jQuery),function(a){"use strict";var r=function(t,e){this.$element=a(t),this.options=a.extend({},r.DEFAULTS,e),this.$trigger=a('[data-toggle="collapse"][href="#'+t.id+'"],[data-toggle="collapse"][data-target="#'+t.id+'"]'),this.transitioning=null,this.options.parent?this.$parent=this.getParent():this.addAriaAndCollapsedClass(this.$element,this.$trigger),this.options.toggle&&this.toggle()};function n(t){var e,i=t.attr("data-target")||(e=t.attr("href"))&&e.replace(/.*(?=#[^\s]+$)/,"");return a(document).find(i)}function l(o){return this.each(function(){var t=a(this),e=t.data("bs.collapse"),i=a.extend({},r.DEFAULTS,t.data(),"object"==typeof o&&o);!e&&i.toggle&&/show|hide/.test(o)&&(i.toggle=!1),e||t.data("bs.collapse",e=new r(this,i)),"string"==typeof o&&e[o]()})}r.VERSION="3.4.1",r.TRANSITION_DURATION=350,r.DEFAULTS={toggle:!0},r.prototype.dimension=function(){return this.$element.hasClass("width")?"width":"height"},r.prototype.show=function(){if(!this.transitioning&&!this.$element.hasClass("in")){var t,e=this.$parent&&this.$parent.children(".panel").children(".in, .collapsing");if(!(e&&e.length&&(t=e.data("bs.collapse"))&&t.transitioning)){var i=a.Event("show.bs.collapse");if(this.$element.trigger(i),!i.isDefaultPrevented()){e&&e.length&&(l.call(e,"hide"),t||e.data("bs.collapse",null));var o=this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[o](0).attr("aria-expanded",!0),this.$trigger.removeClass("collapsed").attr("aria-expanded",!0),this.transitioning=1;var n=function(){this.$element.removeClass("collapsing").addClass("collapse in")[o](""),this.transitioning=0,this.$element.trigger("shown.bs.collapse")};if(!a.support.transition)return n.call(this);var s=a.camelCase(["scroll",o].join("-"));this.$element.one("bsTransitionEnd",a.proxy(n,this)).emulateTransitionEnd(r.TRANSITION_DURATION)[o](this.$element[0][s])}}}},r.prototype.hide=function(){if(!this.transitioning&&this.$element.hasClass("in")){var t=a.Event("hide.bs.collapse");if(this.$element.trigger(t),!t.isDefaultPrevented()){var e=this.dimension();this.$element[e](this.$element[e]())[0].offsetHeight,this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded",!1),this.$trigger.addClass("collapsed").attr("aria-expanded",!1),this.transitioning=1;var i=function(){this.transitioning=0,this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")};if(!a.support.transition)return i.call(this);this.$element[e](0).one("bsTransitionEnd",a.proxy(i,this)).emulateTransitionEnd(r.TRANSITION_DURATION)}}},r.prototype.toggle=function(){this[this.$element.hasClass("in")?"hide":"show"]()},r.prototype.getParent=function(){return a(document).find(this.options.parent).find('[data-toggle="collapse"][data-parent="'+this.options.parent+'"]').each(a.proxy(function(t,e){var i=a(e);this.addAriaAndCollapsedClass(n(i),i)},this)).end()},r.prototype.addAriaAndCollapsedClass=function(t,e){var i=t.hasClass("in");t.attr("aria-expanded",i),e.toggleClass("collapsed",!i).attr("aria-expanded",i)};var t=a.fn.collapse;a.fn.collapse=l,a.fn.collapse.Constructor=r,a.fn.collapse.noConflict=function(){return a.fn.collapse=t,this},a(document).on("click.bs.collapse.data-api",'[data-toggle="collapse"]',function(t){var e=a(this);e.attr("data-target")||t.preventDefault();var i=n(e),o=i.data("bs.collapse")?"toggle":e.data();l.call(i,o)})}(jQuery),function(a){"use strict";var r='[data-toggle="dropdown"]',o=function(t){a(t).on("click.bs.dropdown",this.toggle)};function l(t){var e=t.attr("data-target");e||(e=(e=t.attr("href"))&&/#[A-Za-z]/.test(e)&&e.replace(/.*(?=#[^\s]*$)/,""));var i="#"!==e?a(document).find(e):null;return i&&i.length?i:t.parent()}function s(o){o&&3===o.which||(a(".dropdown-backdrop").remove(),a(r).each(function(){var t=a(this),e=l(t),i={relatedTarget:this};e.hasClass("open")&&(o&&"click"==o.type&&/input|textarea/i.test(o.target.tagName)&&a.contains(e[0],o.target)||(e.trigger(o=a.Event("hide.bs.dropdown",i)),o.isDefaultPrevented()||(t.attr("aria-expanded","false"),e.removeClass("open").trigger(a.Event("hidden.bs.dropdown",i)))))}))}o.VERSION="3.4.1",o.prototype.toggle=function(t){var e=a(this);if(!e.is(".disabled, :disabled")){var i=l(e),o=i.hasClass("open");if(s(),!o){"ontouchstart"in document.documentElement&&!i.closest(".navbar-nav").length&&a(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(a(this)).on("click",s);var n={relatedTarget:this};if(i.trigger(t=a.Event("show.bs.dropdown",n)),t.isDefaultPrevented())return;e.trigger("focus").attr("aria-expanded","true"),i.toggleClass("open").trigger(a.Event("shown.bs.dropdown",n))}return!1}},o.prototype.keydown=function(t){if(/(38|40|27|32)/.test(t.which)&&!/input|textarea/i.test(t.target.tagName)){var e=a(this);if(t.preventDefault(),t.stopPropagation(),!e.is(".disabled, :disabled")){var i=l(e),o=i.hasClass("open");if(!o&&27!=t.which||o&&27==t.which)return 27==t.which&&i.find(r).trigger("focus"),e.trigger("click");var n=i.find(".dropdown-menu li:not(.disabled):visible a");if(n.length){var s=n.index(t.target);38==t.which&&0<s&&s--,40==t.which&&s<n.length-1&&s++,~s||(s=0),n.eq(s).trigger("focus")}}}};var t=a.fn.dropdown;a.fn.dropdown=function e(i){return this.each(function(){var t=a(this),e=t.data("bs.dropdown");e||t.data("bs.dropdown",e=new o(this)),"string"==typeof i&&e[i].call(t)})},a.fn.dropdown.Constructor=o,a.fn.dropdown.noConflict=function(){return a.fn.dropdown=t,this},a(document).on("click.bs.dropdown.data-api",s).on("click.bs.dropdown.data-api",".dropdown form",function(t){t.stopPropagation()}).on("click.bs.dropdown.data-api",r,o.prototype.toggle).on("keydown.bs.dropdown.data-api",r,o.prototype.keydown).on("keydown.bs.dropdown.data-api",".dropdown-menu",o.prototype.keydown)}(jQuery),function(a){"use strict";var s=function(t,e){this.options=e,this.$body=a(document.body),this.$element=a(t),this.$dialog=this.$element.find(".modal-dialog"),this.$backdrop=null,this.isShown=null,this.originalBodyPad=null,this.scrollbarWidth=0,this.ignoreBackdropClick=!1,this.fixedContent=".navbar-fixed-top, .navbar-fixed-bottom",this.options.remote&&this.$element.find(".modal-content").load(this.options.remote,a.proxy(function(){this.$element.trigger("loaded.bs.modal")},this))};function r(o,n){return this.each(function(){var t=a(this),e=t.data("bs.modal"),i=a.extend({},s.DEFAULTS,t.data(),"object"==typeof o&&o);e||t.data("bs.modal",e=new s(this,i)),"string"==typeof o?e[o](n):i.show&&e.show(n)})}s.VERSION="3.4.1",s.TRANSITION_DURATION=300,s.BACKDROP_TRANSITION_DURATION=150,s.DEFAULTS={backdrop:!0,keyboard:!0,show:!0},s.prototype.toggle=function(t){return this.isShown?this.hide():this.show(t)},s.prototype.show=function(i){var o=this,t=a.Event("show.bs.modal",{relatedTarget:i});this.$element.trigger(t),this.isShown||t.isDefaultPrevented()||(this.isShown=!0,this.checkScrollbar(),this.setScrollbar(),this.$body.addClass("modal-open"),this.escape(),this.resize(),this.$element.on("click.dismiss.bs.modal",'[data-dismiss="modal"]',a.proxy(this.hide,this)),this.$dialog.on("mousedown.dismiss.bs.modal",function(){o.$element.one("mouseup.dismiss.bs.modal",function(t){a(t.target).is(o.$element)&&(o.ignoreBackdropClick=!0)})}),this.backdrop(function(){var t=a.support.transition&&o.$element.hasClass("fade");o.$element.parent().length||o.$element.appendTo(o.$body),o.$element.show().scrollTop(0),o.adjustDialog(),t&&o.$element[0].offsetWidth,o.$element.addClass("in"),o.enforceFocus();var e=a.Event("shown.bs.modal",{relatedTarget:i});t?o.$dialog.one("bsTransitionEnd",function(){o.$element.trigger("focus").trigger(e)}).emulateTransitionEnd(s.TRANSITION_DURATION):o.$element.trigger("focus").trigger(e)}))},s.prototype.hide=function(t){t&&t.preventDefault(),t=a.Event("hide.bs.modal"),this.$element.trigger(t),this.isShown&&!t.isDefaultPrevented()&&(this.isShown=!1,this.escape(),this.resize(),a(document).off("focusin.bs.modal"),this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"),this.$dialog.off("mousedown.dismiss.bs.modal"),a.support.transition&&this.$element.hasClass("fade")?this.$element.one("bsTransitionEnd",a.proxy(this.hideModal,this)).emulateTransitionEnd(s.TRANSITION_DURATION):this.hideModal())},s.prototype.enforceFocus=function(){a(document).off("focusin.bs.modal").on("focusin.bs.modal",a.proxy(function(t){document===t.target||this.$element[0]===t.target||this.$element.has(t.target).length||this.$element.trigger("focus")},this))},s.prototype.escape=function(){this.isShown&&this.options.keyboard?this.$element.on("keydown.dismiss.bs.modal",a.proxy(function(t){27==t.which&&this.hide()},this)):this.isShown||this.$element.off("keydown.dismiss.bs.modal")},s.prototype.resize=function(){this.isShown?a(window).on("resize.bs.modal",a.proxy(this.handleUpdate,this)):a(window).off("resize.bs.modal")},s.prototype.hideModal=function(){var t=this;this.$element.hide(),this.backdrop(function(){t.$body.removeClass("modal-open"),t.resetAdjustments(),t.resetScrollbar(),t.$element.trigger("hidden.bs.modal")})},s.prototype.removeBackdrop=function(){this.$backdrop&&this.$backdrop.remove(),this.$backdrop=null},s.prototype.backdrop=function(t){var e=this,i=this.$element.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var o=a.support.transition&&i;if(this.$backdrop=a(document.createElement("div")).addClass("modal-backdrop "+i).appendTo(this.$body),this.$element.on("click.dismiss.bs.modal",a.proxy(function(t){this.ignoreBackdropClick?this.ignoreBackdropClick=!1:t.target===t.currentTarget&&("static"==this.options.backdrop?this.$element[0].focus():this.hide())},this)),o&&this.$backdrop[0].offsetWidth,this.$backdrop.addClass("in"),!t)return;o?this.$backdrop.one("bsTransitionEnd",t).emulateTransitionEnd(s.BACKDROP_TRANSITION_DURATION):t()}else if(!this.isShown&&this.$backdrop){this.$backdrop.removeClass("in");var n=function(){e.removeBackdrop(),t&&t()};a.support.transition&&this.$element.hasClass("fade")?this.$backdrop.one("bsTransitionEnd",n).emulateTransitionEnd(s.BACKDROP_TRANSITION_DURATION):n()}else t&&t()},s.prototype.handleUpdate=function(){this.adjustDialog()},s.prototype.adjustDialog=function(){var t=this.$element[0].scrollHeight>document.documentElement.clientHeight;this.$element.css({paddingLeft:!this.bodyIsOverflowing&&t?this.scrollbarWidth:"",paddingRight:this.bodyIsOverflowing&&!t?this.scrollbarWidth:""})},s.prototype.resetAdjustments=function(){this.$element.css({paddingLeft:"",paddingRight:""})},s.prototype.checkScrollbar=function(){var t=window.innerWidth;if(!t){var e=document.documentElement.getBoundingClientRect();t=e.right-Math.abs(e.left)}this.bodyIsOverflowing=document.body.clientWidth<t,this.scrollbarWidth=this.measureScrollbar()},s.prototype.setScrollbar=function(){var t=parseInt(this.$body.css("padding-right")||0,10);this.originalBodyPad=document.body.style.paddingRight||"";var n=this.scrollbarWidth;this.bodyIsOverflowing&&(this.$body.css("padding-right",t+n),a(this.fixedContent).each(function(t,e){var i=e.style.paddingRight,o=a(e).css("padding-right");a(e).data("padding-right",i).css("padding-right",parseFloat(o)+n+"px")}))},s.prototype.resetScrollbar=function(){this.$body.css("padding-right",this.originalBodyPad),a(this.fixedContent).each(function(t,e){var i=a(e).data("padding-right");a(e).removeData("padding-right"),e.style.paddingRight=i||""})},s.prototype.measureScrollbar=function(){var t=document.createElement("div");t.className="modal-scrollbar-measure",this.$body.append(t);var e=t.offsetWidth-t.clientWidth;return this.$body[0].removeChild(t),e};var t=a.fn.modal;a.fn.modal=r,a.fn.modal.Constructor=s,a.fn.modal.noConflict=function(){return a.fn.modal=t,this},a(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',function(t){var e=a(this),i=e.attr("href"),o=e.attr("data-target")||i&&i.replace(/.*(?=#[^\s]+$)/,""),n=a(document).find(o),s=n.data("bs.modal")?"toggle":a.extend({remote:!/#/.test(i)&&i},n.data(),e.data());e.is("a")&&t.preventDefault(),n.one("show.bs.modal",function(t){t.isDefaultPrevented()||n.one("hidden.bs.modal",function(){e.is(":visible")&&e.trigger("focus")})}),r.call(n,s,this)})}(jQuery),function(g){"use strict";var o=["sanitize","whiteList","sanitizeFn"],a=["background","cite","href","itemtype","longdesc","poster","src","xlink:href"],t={"*":["class","dir","id","lang","role",/^aria-[\w-]*$/i],a:["target","href","title","rel"],area:[],b:[],br:[],col:[],code:[],div:[],em:[],hr:[],h1:[],h2:[],h3:[],h4:[],h5:[],h6:[],i:[],img:["src","alt","title","width","height"],li:[],ol:[],p:[],pre:[],s:[],small:[],span:[],sub:[],sup:[],strong:[],u:[],ul:[]},r=/^(?:(?:https?|mailto|ftp|tel|file):|[^&:/?#]*(?:[/?#]|$))/gi,l=/^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[a-z0-9+/]+=*$/i;function u(t,e){var i=t.nodeName.toLowerCase();if(-1!==g.inArray(i,e))return-1===g.inArray(i,a)||Boolean(t.nodeValue.match(r)||t.nodeValue.match(l));for(var o=g(e).filter(function(t,e){return e instanceof RegExp}),n=0,s=o.length;n<s;n++)if(i.match(o[n]))return!0;return!1}function n(t,e,i){if(0===t.length)return t;if(i&&"function"==typeof i)return i(t);if(!document.implementation||!document.implementation.createHTMLDocument)return t;var o=document.implementation.createHTMLDocument("sanitization");o.body.innerHTML=t;for(var n=g.map(e,function(t,e){return e}),s=g(o.body).find("*"),a=0,r=s.length;a<r;a++){var l=s[a],h=l.nodeName.toLowerCase();if(-1!==g.inArray(h,n))for(var d=g.map(l.attributes,function(t){return t}),p=[].concat(e["*"]||[],e[h]||[]),c=0,f=d.length;c<f;c++)u(d[c],p)||l.removeAttribute(d[c].nodeName);else l.parentNode.removeChild(l)}return o.body.innerHTML}var m=function(t,e){this.type=null,this.options=null,this.enabled=null,this.timeout=null,this.hoverState=null,this.$element=null,this.inState=null,this.init("tooltip",t,e)};m.VERSION="3.4.1",m.TRANSITION_DURATION=150,m.DEFAULTS={animation:!0,placement:"top",selector:!1,template:'<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,container:!1,viewport:{selector:"body",padding:0},sanitize:!0,sanitizeFn:null,whiteList:t},m.prototype.init=function(t,e,i){if(this.enabled=!0,this.type=t,this.$element=g(e),this.options=this.getOptions(i),this.$viewport=this.options.viewport&&g(document).find(g.isFunction(this.options.viewport)?this.options.viewport.call(this,this.$element):this.options.viewport.selector||this.options.viewport),this.inState={click:!1,hover:!1,focus:!1},this.$element[0]instanceof document.constructor&&!this.options.selector)throw new Error("`selector` option must be specified when initializing "+this.type+" on the window.document object!");for(var o=this.options.trigger.split(" "),n=o.length;n--;){var s=o[n];if("click"==s)this.$element.on("click."+this.type,this.options.selector,g.proxy(this.toggle,this));else if("manual"!=s){var a="hover"==s?"mouseenter":"focusin",r="hover"==s?"mouseleave":"focusout";this.$element.on(a+"."+this.type,this.options.selector,g.proxy(this.enter,this)),this.$element.on(r+"."+this.type,this.options.selector,g.proxy(this.leave,this))}}this.options.selector?this._options=g.extend({},this.options,{trigger:"manual",selector:""}):this.fixTitle()},m.prototype.getDefaults=function(){return m.DEFAULTS},m.prototype.getOptions=function(t){var e=this.$element.data();for(var i in e)e.hasOwnProperty(i)&&-1!==g.inArray(i,o)&&delete e[i];return(t=g.extend({},this.getDefaults(),e,t)).delay&&"number"==typeof t.delay&&(t.delay={show:t.delay,hide:t.delay}),t.sanitize&&(t.template=n(t.template,t.whiteList,t.sanitizeFn)),t},m.prototype.getDelegateOptions=function(){var i={},o=this.getDefaults();return this._options&&g.each(this._options,function(t,e){o[t]!=e&&(i[t]=e)}),i},m.prototype.enter=function(t){var e=t instanceof this.constructor?t:g(t.currentTarget).data("bs."+this.type);if(e||(e=new this.constructor(t.currentTarget,this.getDelegateOptions()),g(t.currentTarget).data("bs."+this.type,e)),t instanceof g.Event&&(e.inState["focusin"==t.type?"focus":"hover"]=!0),e.tip().hasClass("in")||"in"==e.hoverState)e.hoverState="in";else{if(clearTimeout(e.timeout),e.hoverState="in",!e.options.delay||!e.options.delay.show)return e.show();e.timeout=setTimeout(function(){"in"==e.hoverState&&e.show()},e.options.delay.show)}},m.prototype.isInStateTrue=function(){for(var t in this.inState)if(this.inState[t])return!0;return!1},m.prototype.leave=function(t){var e=t instanceof this.constructor?t:g(t.currentTarget).data("bs."+this.type);if(e||(e=new this.constructor(t.currentTarget,this.getDelegateOptions()),g(t.currentTarget).data("bs."+this.type,e)),t instanceof g.Event&&(e.inState["focusout"==t.type?"focus":"hover"]=!1),!e.isInStateTrue()){if(clearTimeout(e.timeout),e.hoverState="out",!e.options.delay||!e.options.delay.hide)return e.hide();e.timeout=setTimeout(function(){"out"==e.hoverState&&e.hide()},e.options.delay.hide)}},m.prototype.show=function(){var t=g.Event("show.bs."+this.type);if(this.hasContent()&&this.enabled){this.$element.trigger(t);var e=g.contains(this.$element[0].ownerDocument.documentElement,this.$element[0]);if(t.isDefaultPrevented()||!e)return;var i=this,o=this.tip(),n=this.getUID(this.type);this.setContent(),o.attr("id",n),this.$element.attr("aria-describedby",n),this.options.animation&&o.addClass("fade");var s="function"==typeof this.options.placement?this.options.placement.call(this,o[0],this.$element[0]):this.options.placement,a=/\s?auto?\s?/i,r=a.test(s);r&&(s=s.replace(a,"")||"top"),o.detach().css({top:0,left:0,display:"block"}).addClass(s).data("bs."+this.type,this),this.options.container?o.appendTo(g(document).find(this.options.container)):o.insertAfter(this.$element),this.$element.trigger("inserted.bs."+this.type);var l=this.getPosition(),h=o[0].offsetWidth,d=o[0].offsetHeight;if(r){var p=s,c=this.getPosition(this.$viewport);s="bottom"==s&&l.bottom+d>c.bottom?"top":"top"==s&&l.top-d<c.top?"bottom":"right"==s&&l.right+h>c.width?"left":"left"==s&&l.left-h<c.left?"right":s,o.removeClass(p).addClass(s)}var f=this.getCalculatedOffset(s,l,h,d);this.applyPlacement(f,s);var u=function(){var t=i.hoverState;i.$element.trigger("shown.bs."+i.type),i.hoverState=null,"out"==t&&i.leave(i)};g.support.transition&&this.$tip.hasClass("fade")?o.one("bsTransitionEnd",u).emulateTransitionEnd(m.TRANSITION_DURATION):u()}},m.prototype.applyPlacement=function(t,e){var i=this.tip(),o=i[0].offsetWidth,n=i[0].offsetHeight,s=parseInt(i.css("margin-top"),10),a=parseInt(i.css("margin-left"),10);isNaN(s)&&(s=0),isNaN(a)&&(a=0),t.top+=s,t.left+=a,g.offset.setOffset(i[0],g.extend({using:function(t){i.css({top:Math.round(t.top),left:Math.round(t.left)})}},t),0),i.addClass("in");var r=i[0].offsetWidth,l=i[0].offsetHeight;"top"==e&&l!=n&&(t.top=t.top+n-l);var h=this.getViewportAdjustedDelta(e,t,r,l);h.left?t.left+=h.left:t.top+=h.top;var d=/top|bottom/.test(e),p=d?2*h.left-o+r:2*h.top-n+l,c=d?"offsetWidth":"offsetHeight";i.offset(t),this.replaceArrow(p,i[0][c],d)},m.prototype.replaceArrow=function(t,e,i){this.arrow().css(i?"left":"top",50*(1-t/e)+"%").css(i?"top":"left","")},m.prototype.setContent=function(){var t=this.tip(),e=this.getTitle();this.options.html?(this.options.sanitize&&(e=n(e,this.options.whiteList,this.options.sanitizeFn)),t.find(".tooltip-inner").html(e)):t.find(".tooltip-inner").text(e),t.removeClass("fade in top bottom left right")},m.prototype.hide=function(t){var e=this,i=g(this.$tip),o=g.Event("hide.bs."+this.type);function n(){"in"!=e.hoverState&&i.detach(),e.$element&&e.$element.removeAttr("aria-describedby").trigger("hidden.bs."+e.type),t&&t()}if(this.$element.trigger(o),!o.isDefaultPrevented())return i.removeClass("in"),g.support.transition&&i.hasClass("fade")?i.one("bsTransitionEnd",n).emulateTransitionEnd(m.TRANSITION_DURATION):n(),this.hoverState=null,this},m.prototype.fixTitle=function(){var t=this.$element;(t.attr("title")||"string"!=typeof t.attr("data-original-title"))&&t.attr("data-original-title",t.attr("title")||"").attr("title","")},m.prototype.hasContent=function(){return this.getTitle()},m.prototype.getPosition=function(t){var e=(t=t||this.$element)[0],i="BODY"==e.tagName,o=e.getBoundingClientRect();null==o.width&&(o=g.extend({},o,{width:o.right-o.left,height:o.bottom-o.top}));var n=window.SVGElement&&e instanceof window.SVGElement,s=i?{top:0,left:0}:n?null:t.offset(),a={scroll:i?document.documentElement.scrollTop||document.body.scrollTop:t.scrollTop()},r=i?{width:g(window).width(),height:g(window).height()}:null;return g.extend({},o,a,r,s)},m.prototype.getCalculatedOffset=function(t,e,i,o){return"bottom"==t?{top:e.top+e.height,left:e.left+e.width/2-i/2}:"top"==t?{top:e.top-o,left:e.left+e.width/2-i/2}:"left"==t?{top:e.top+e.height/2-o/2,left:e.left-i}:{top:e.top+e.height/2-o/2,left:e.left+e.width}},m.prototype.getViewportAdjustedDelta=function(t,e,i,o){var n={top:0,left:0};if(!this.$viewport)return n;var s=this.options.viewport&&this.options.viewport.padding||0,a=this.getPosition(this.$viewport);if(/right|left/.test(t)){var r=e.top-s-a.scroll,l=e.top+s-a.scroll+o;r<a.top?n.top=a.top-r:l>a.top+a.height&&(n.top=a.top+a.height-l)}else{var h=e.left-s,d=e.left+s+i;h<a.left?n.left=a.left-h:d>a.right&&(n.left=a.left+a.width-d)}return n},m.prototype.getTitle=function(){var t=this.$element,e=this.options;return t.attr("data-original-title")||("function"==typeof e.title?e.title.call(t[0]):e.title)},m.prototype.getUID=function(t){for(;t+=~~(1e6*Math.random()),document.getElementById(t););return t},m.prototype.tip=function(){if(!this.$tip&&(this.$tip=g(this.options.template),1!=this.$tip.length))throw new Error(this.type+" `template` option must consist of exactly 1 top-level element!");return this.$tip},m.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".tooltip-arrow")},m.prototype.enable=function(){this.enabled=!0},m.prototype.disable=function(){this.enabled=!1},m.prototype.toggleEnabled=function(){this.enabled=!this.enabled},m.prototype.toggle=function(t){var e=this;t&&((e=g(t.currentTarget).data("bs."+this.type))||(e=new this.constructor(t.currentTarget,this.getDelegateOptions()),g(t.currentTarget).data("bs."+this.type,e))),t?(e.inState.click=!e.inState.click,e.isInStateTrue()?e.enter(e):e.leave(e)):e.tip().hasClass("in")?e.leave(e):e.enter(e)},m.prototype.destroy=function(){var t=this;clearTimeout(this.timeout),this.hide(function(){t.$element.off("."+t.type).removeData("bs."+t.type),t.$tip&&t.$tip.detach(),t.$tip=null,t.$arrow=null,t.$viewport=null,t.$element=null})},m.prototype.sanitizeHtml=function(t){return n(t,this.options.whiteList,this.options.sanitizeFn)};var e=g.fn.tooltip;g.fn.tooltip=function i(o){return this.each(function(){var t=g(this),e=t.data("bs.tooltip"),i="object"==typeof o&&o;!e&&/destroy|hide/.test(o)||(e||t.data("bs.tooltip",e=new m(this,i)),"string"==typeof o&&e[o]())})},g.fn.tooltip.Constructor=m,g.fn.tooltip.noConflict=function(){return g.fn.tooltip=e,this}}(jQuery),function(n){"use strict";var s=function(t,e){this.init("popover",t,e)};if(!n.fn.tooltip)throw new Error("Popover requires tooltip.js");s.VERSION="3.4.1",s.DEFAULTS=n.extend({},n.fn.tooltip.Constructor.DEFAULTS,{placement:"right",trigger:"click",content:"",template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'}),((s.prototype=n.extend({},n.fn.tooltip.Constructor.prototype)).constructor=s).prototype.getDefaults=function(){return s.DEFAULTS},s.prototype.setContent=function(){var t=this.tip(),e=this.getTitle(),i=this.getContent();if(this.options.html){var o=typeof i;this.options.sanitize&&(e=this.sanitizeHtml(e),"string"===o&&(i=this.sanitizeHtml(i))),t.find(".popover-title").html(e),t.find(".popover-content").children().detach().end()["string"===o?"html":"append"](i)}else t.find(".popover-title").text(e),t.find(".popover-content").children().detach().end().text(i);t.removeClass("fade top bottom left right in"),t.find(".popover-title").html()||t.find(".popover-title").hide()},s.prototype.hasContent=function(){return this.getTitle()||this.getContent()},s.prototype.getContent=function(){var t=this.$element,e=this.options;return t.attr("data-content")||("function"==typeof e.content?e.content.call(t[0]):e.content)},s.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".arrow")};var t=n.fn.popover;n.fn.popover=function e(o){return this.each(function(){var t=n(this),e=t.data("bs.popover"),i="object"==typeof o&&o;!e&&/destroy|hide/.test(o)||(e||t.data("bs.popover",e=new s(this,i)),"string"==typeof o&&e[o]())})},n.fn.popover.Constructor=s,n.fn.popover.noConflict=function(){return n.fn.popover=t,this}}(jQuery),function(s){"use strict";function n(t,e){this.$body=s(document.body),this.$scrollElement=s(t).is(document.body)?s(window):s(t),this.options=s.extend({},n.DEFAULTS,e),this.selector=(this.options.target||"")+" .nav li > a",this.offsets=[],this.targets=[],this.activeTarget=null,this.scrollHeight=0,this.$scrollElement.on("scroll.bs.scrollspy",s.proxy(this.process,this)),this.refresh(),this.process()}function e(o){return this.each(function(){var t=s(this),e=t.data("bs.scrollspy"),i="object"==typeof o&&o;e||t.data("bs.scrollspy",e=new n(this,i)),"string"==typeof o&&e[o]()})}n.VERSION="3.4.1",n.DEFAULTS={offset:10},n.prototype.getScrollHeight=function(){return this.$scrollElement[0].scrollHeight||Math.max(this.$body[0].scrollHeight,document.documentElement.scrollHeight)},n.prototype.refresh=function(){var t=this,o="offset",n=0;this.offsets=[],this.targets=[],this.scrollHeight=this.getScrollHeight(),s.isWindow(this.$scrollElement[0])||(o="position",n=this.$scrollElement.scrollTop()),this.$body.find(this.selector).map(function(){var t=s(this),e=t.data("target")||t.attr("href"),i=/^#./.test(e)&&s(e);return i&&i.length&&i.is(":visible")&&[[i[o]().top+n,e]]||null}).sort(function(t,e){return t[0]-e[0]}).each(function(){t.offsets.push(this[0]),t.targets.push(this[1])})},n.prototype.process=function(){var t,e=this.$scrollElement.scrollTop()+this.options.offset,i=this.getScrollHeight(),o=this.options.offset+i-this.$scrollElement.height(),n=this.offsets,s=this.targets,a=this.activeTarget;if(this.scrollHeight!=i&&this.refresh(),o<=e)return a!=(t=s[s.length-1])&&this.activate(t);if(a&&e<n[0])return this.activeTarget=null,this.clear();for(t=n.length;t--;)a!=s[t]&&e>=n[t]&&(n[t+1]===undefined||e<n[t+1])&&this.activate(s[t])},n.prototype.activate=function(t){this.activeTarget=t,this.clear();var e=this.selector+'[data-target="'+t+'"],'+this.selector+'[href="'+t+'"]',i=s(e).parents("li").addClass("active");i.parent(".dropdown-menu").length&&(i=i.closest("li.dropdown").addClass("active")),i.trigger("activate.bs.scrollspy")},n.prototype.clear=function(){s(this.selector).parentsUntil(this.options.target,".active").removeClass("active")};var t=s.fn.scrollspy;s.fn.scrollspy=e,s.fn.scrollspy.Constructor=n,s.fn.scrollspy.noConflict=function(){return s.fn.scrollspy=t,this},s(window).on("load.bs.scrollspy.data-api",function(){s('[data-spy="scroll"]').each(function(){var t=s(this);e.call(t,t.data())})})}(jQuery),function(r){"use strict";var a=function(t){this.element=r(t)};function e(i){return this.each(function(){var t=r(this),e=t.data("bs.tab");e||t.data("bs.tab",e=new a(this)),"string"==typeof i&&e[i]()})}a.VERSION="3.4.1",a.TRANSITION_DURATION=150,a.prototype.show=function(){var t=this.element,e=t.closest("ul:not(.dropdown-menu)"),i=t.data("target");if(i||(i=(i=t.attr("href"))&&i.replace(/.*(?=#[^\s]*$)/,"")),!t.parent("li").hasClass("active")){var o=e.find(".active:last a"),n=r.Event("hide.bs.tab",{relatedTarget:t[0]}),s=r.Event("show.bs.tab",{relatedTarget:o[0]});if(o.trigger(n),t.trigger(s),!s.isDefaultPrevented()&&!n.isDefaultPrevented()){var a=r(document).find(i);this.activate(t.closest("li"),e),this.activate(a,a.parent(),function(){o.trigger({type:"hidden.bs.tab",relatedTarget:t[0]}),t.trigger({type:"shown.bs.tab",relatedTarget:o[0]})})}}},a.prototype.activate=function(t,e,i){var o=e.find("> .active"),n=i&&r.support.transition&&(o.length&&o.hasClass("fade")||!!e.find("> .fade").length);function s(){o.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",!1),t.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded",!0),n?(t[0].offsetWidth,t.addClass("in")):t.removeClass("fade"),t.parent(".dropdown-menu").length&&t.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",!0),i&&i()}o.length&&n?o.one("bsTransitionEnd",s).emulateTransitionEnd(a.TRANSITION_DURATION):s(),o.removeClass("in")};var t=r.fn.tab;r.fn.tab=e,r.fn.tab.Constructor=a,r.fn.tab.noConflict=function(){return r.fn.tab=t,this};var i=function(t){t.preventDefault(),e.call(r(this),"show")};r(document).on("click.bs.tab.data-api",'[data-toggle="tab"]',i).on("click.bs.tab.data-api",'[data-toggle="pill"]',i)}(jQuery),function(l){"use strict";var h=function(t,e){this.options=l.extend({},h.DEFAULTS,e);var i=this.options.target===h.DEFAULTS.target?l(this.options.target):l(document).find(this.options.target);this.$target=i.on("scroll.bs.affix.data-api",l.proxy(this.checkPosition,this)).on("click.bs.affix.data-api",l.proxy(this.checkPositionWithEventLoop,this)),this.$element=l(t),this.affixed=null,this.unpin=null,this.pinnedOffset=null,this.checkPosition()};function i(o){return this.each(function(){var t=l(this),e=t.data("bs.affix"),i="object"==typeof o&&o;e||t.data("bs.affix",e=new h(this,i)),"string"==typeof o&&e[o]()})}h.VERSION="3.4.1",h.RESET="affix affix-top affix-bottom",h.DEFAULTS={offset:0,target:window},h.prototype.getState=function(t,e,i,o){var n=this.$target.scrollTop(),s=this.$element.offset(),a=this.$target.height();if(null!=i&&"top"==this.affixed)return n<i&&"top";if("bottom"==this.affixed)return null!=i?!(n+this.unpin<=s.top)&&"bottom":!(n+a<=t-o)&&"bottom";var r=null==this.affixed,l=r?n:s.top;return null!=i&&n<=i?"top":null!=o&&t-o<=l+(r?a:e)&&"bottom"},h.prototype.getPinnedOffset=function(){if(this.pinnedOffset)return this.pinnedOffset;this.$element.removeClass(h.RESET).addClass("affix");var t=this.$target.scrollTop(),e=this.$element.offset();return this.pinnedOffset=e.top-t},h.prototype.checkPositionWithEventLoop=function(){setTimeout(l.proxy(this.checkPosition,this),1)},h.prototype.checkPosition=function(){if(this.$element.is(":visible")){var t=this.$element.height(),e=this.options.offset,i=e.top,o=e.bottom,n=Math.max(l(document).height(),l(document.body).height());"object"!=typeof e&&(o=i=e),"function"==typeof i&&(i=e.top(this.$element)),"function"==typeof o&&(o=e.bottom(this.$element));var s=this.getState(n,t,i,o);if(this.affixed!=s){null!=this.unpin&&this.$element.css("top","");var a="affix"+(s?"-"+s:""),r=l.Event(a+".bs.affix");if(this.$element.trigger(r),r.isDefaultPrevented())return;this.affixed=s,this.unpin="bottom"==s?this.getPinnedOffset():null,this.$element.removeClass(h.RESET).addClass(a).trigger(a.replace("affix","affixed")+".bs.affix")}"bottom"==s&&this.$element.offset({top:n-t-o})}};var t=l.fn.affix;l.fn.affix=i,l.fn.affix.Constructor=h,l.fn.affix.noConflict=function(){return l.fn.affix=t,this},l(window).on("load",function(){l('[data-spy="affix"]').each(function(){var t=l(this),e=t.data();e.offset=e.offset||{},null!=e.offsetBottom&&(e.offset.bottom=e.offsetBottom),null!=e.offsetTop&&(e.offset.top=e.offsetTop),i.call(t,e)})})}(jQuery);

    /* =========================================================
 * bootstrap-gtreetable v2.2.1-alpha
 * https://github.com/gilek/bootstrap-gtreetable
 * =========================================================
 * Copyright 2014 Maciej Kłak
 * Licensed under MIT (https://github.com/gilek/bootstrap-gtreetable/blob/master/LICENSE)
 * ========================================================= */

    !function(a){function b(b,c){this.options=c,this.$tree=a(b),this.language=void 0===this.options.languages[this.options.language]?this.options.languages["en-US"]:a.extend({},this.options.languages["en-US"],this.options.languages[this.options.language]),this._isNodeDragging=!1,this._lastId=0,this.actions=[],null!==this.options.defaultActions&&(this.actions=this.options.defaultActions),void 0!==this.options.actions&&this.actions.push.apply(this.actions,this.options.actions),this.options.cache>0&&(this.cacheManager=new d(this));var e=this.language;if(this.template=void 0!==this.options.template?this.options.template:'<table class="table gtreetable"><tr class="'+this.options.classes.node+" "+this.options.classes.collapsed+'"><td><span>${draggableIcon}${indent}${ecIcon}${selectedIcon}${typeIcon}${name}</span><span class="hide '+this.options.classes.action+'">${input}${saveButton} ${cancelButton}</span><div class="btn-group pull-right '+this.options.classes.buttons+'">${actionsButton}${actionsList}</div></td></tr></table>',this.templateParts=void 0!==this.options.templateParts?this.options.templateParts:{draggableIcon:this.options.draggable===!0?'<span class="'+this.options.classes.handleIcon+'">&zwnj;</span><span class="'+this.options.classes.draggablePointer+'">&zwnj;</span>':"",indent:'<span class="'+this.options.classes.indent+'">&zwnj;</span>',ecIcon:'<span class="'+this.options.classes.ceIcon+' icon"></span>',selectedIcon:'<span class="'+this.options.classes.selectedIcon+' icon"></span>',typeIcon:'<span class="'+this.options.classes.typeIcon+'"></span>',name:'<span class="'+this.options.classes.name+'"></span>',input:'<input type="text" name="name" value="" style="width: '+this.options.inputWidth+'" class="form-control" />',saveButton:'<button type="button" class="btn btn-sm btn-success '+this.options.classes.saveButton+'">'+e.save+"</button>",cancelButton:'<button type="button" class="btn btn-sm '+this.options.classes.cancelButton+'">'+e.cancel+"</button>",actionsButton:'<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">'+e.action+' <span class="caret"></span></button>',actionsList:""},this.actions.length>0){var f='<ul class="dropdown-menu" role="menu"><li role="presentation" class="dropdown-header">'+e.action+"</li>";a.each(this.actions,function(a,b){if(b.divider===!0)f+='<li class="divider"></li>';else{var c=b.name.match(/\$\{([\w\W]+)\}/),d=null!==c&&void 0!==c[1]&&void 0!==e.actions[c[1]]?e.actions[c[1]]:b.name;f+='<li role="presentation"><a href="#notarget" class="node-action-'+a+'" tabindex="-1">'+d+"</a></li>"}}),f+="</ul>",this.templateParts.actionsList=f}var g=this.template;a.each(this.templateParts,function(a,b){g=g.replace("${"+a+"}",b)}),this.options.template=g,0===this.$tree.find("tbody").length&&this.$tree.append("<tbody></tbody>"),this.options.readonly||this.$tree.addClass("gtreetable-fullAccess"),this.$nodeTemplate=a(void 0!==this.options.templateSelector?this.options.templateSelector:this.options.template).find("."+this.options.classes.node),this.options.draggable===!0&&this.isNodeDragging(!1),this.init()}function c(a,b){this.manager=b,this.level=parseInt(a.level),this.parent=a.parent,this.name=a.name,this.type=a.type,this.id=a.id,this.insertPosition=void 0,this.movePosition=void 0,this.relatedNodeId=void 0,this._isExpanded=!1,this._isLoading=!1,this._isSaved=void 0===a.id?!1:!0,this._isSelected=!1,this._isHovered=!1,this._isEditable=!1,this.init()}function d(a){this._cached={},this.manager=a}function e(c,d){var e=null;return this.each(function(){var f=a(this),g=f.data("bs.gtreetable"),h=a.extend({},a.fn.gtreetable.defaults,f.data(),"object"==typeof c&&c);g||(g=new b(this,h),f.data("bs.gtreetable",g)),"string"==typeof c&&(e=g[c](d))}),e||(e=this),e}b.prototype={getNode:function(a){return a.data("bs.gtreetable.gtreetablenode")},getNodeById:function(a){return this.getNode(this.$tree.find("."+this.options.classes.node+"[data-id='"+a+"']"))},getSelectedNodes:function(){var b=[],c=this;return a.each(this.$tree.find("."+this.options.classes.selected),function(){b.push(c.getNode(a(this)))}),b},getSourceNodes:function(b,c){var d=this,e=this.getNodeById(b),f=b>0&&this.options.cache>0;if(f&&c!==!0){var g=this.cacheManager.get(e);if(void 0!==g){var h={};return h[d.options.nodesWrapper]=g,h}}var i=this.options.source(b),j={beforeSend:function(){b>0&&e.isLoading(!0)},success:function(a){if(void 0!==a[d.options.nodesWrapper]){g=a[d.options.nodesWrapper];for(var c=0;c<g.length;c+=1)g[c].parent=b;"function"==typeof d.options.sort&&g.sort(d.options.sort),f&&d.cacheManager.set(e,g)}},error:function(a){alert(a.status+": "+a.responseText)},complete:function(){b>0&&e.isLoading(!1)}};return a.ajax(a.extend({},j,i))},init:function(){var a=this;this.getSourceNodes(0).done(function(b){var d=b[a.options.nodesWrapper];for(var e in d){var f=new c(d[e],a);f.insertIntegral(f)}})},isNodeDragging:function(a){return void 0===a?this._isNodeDragging:void(a===!0?(this._isNodeDragging=!0,this.$tree.disableSelection()):(this._isNodeDragging=!1,this.$tree.enableSelection()))},generateNewId:function(){return this._lastId+=1,"g"+this._lastId}},c.prototype={getPath:function(){var b=this,c=[b.name],d=b.parent;return b.$node.prevAll("."+this.manager.options.classes.node).each(function(){var e=b.manager.getNode(a(this));e.id===d&&(d=e.parent,c[c.length]=e.name)}),c},getParents:function(){for(var a=[],b=this.parent;;){if(0===b)break;var c=this.manager.getNodeById(b);a.push(c),b=c.parent}return a},getIP:function(){var b=this,c="0",d=b.getParents();return d.reverse(),a.each(d,function(){c+="."+this.id}),c+="."+b.id},getSiblings:function(){for(var b=this,c=[],d="."+b.manager.options.classes.node+"[data-parent='"+b.parent+"']",e=b.$node.prevAll(d),f=e.length-1;f>=0;--f)c.push(b.manager.getNode(a(e[f])));return c.push(b),b.$node.nextAll(d).each(function(){c.push(b.manager.getNode(a(this)))}),c},getDescendants:function(b){var c=this,d=a.extend({},{depth:1,includeNotSaved:!1,index:void 0},b),e="."+c.manager.options.classes.node,f=-1!==d.depth||isNaN(d.depth)?d.depth:1/0,g=[];if(d.includeNotSaved===!1&&(e+="."+c.manager.options.classes.saved),f>1?c.$node.nextAll(e).each(function(){var b=c.manager.getNode(a(this));return(b.level<=c.level||b.level===c.level&&b.parent===c.parent)&&(d.includeNotSaved!==!0||b.isSaved())?!1:void g.push(b)}):c.$node.nextAll(e+"[data-parent='"+c.id+"'][data-level='"+(c.level+1)+"']").each(function(){g.push(c.manager.getNode(a(this)))}),!isNaN(d.index)){var h=d.index>=0?d.index-1:g.length+d.index;return g[h]}return g},getMovePosition:function(){return this.movePosition},setMovePosition:function(a,b){this.$node.removeClass(this.manager.options.classes.draggableContainer),void 0!==a&&(this.$node.addClass(this.manager.options.classes.draggableContainer),this.movePosition=a,this.$pointer.css("top",b.top+"px"),this.$pointer.css("left",b.left+"px"))},getId:function(){return this.id},getName:function(){return this.isEditable()?this.$input.val():this.name},getParent:function(){return this.parent},getInsertPosition:function(){return this.insertPosition},getRelatedNodeId:function(){return this.relatedNodeId},init:function(){this.$node=this.manager.$nodeTemplate.clone(!1),this.$name=this.$node.find("."+this.manager.options.classes.name),this.$ceIcon=this.$node.find("."+this.manager.options.classes.ceIcon),this.$typeIcon=this.$node.find("."+this.manager.options.classes.typeIcon),this.$icon=this.$node.find("."+this.manager.options.classes.icon),this.$action=this.$node.find("."+this.manager.options.classes.action),this.$indent=this.$node.find("."+this.manager.options.classes.indent),this.$saveButton=this.$node.find("."+this.manager.options.classes.saveButton),this.$cancelButton=this.$node.find("."+this.manager.options.classes.cancelButton),this.$input=this.$node.find("input"),this.$pointer=this.$node.find("."+this.manager.options.classes.draggablePointer),this.render(),this.attachEvents(),this.$node.data("bs.gtreetable.gtreetablenode",this)},render:function(){this.$name.html(this.name),void 0!==this.id&&(this.$node.attr("data-id",this.id),this.isSaved(!0),this.manager.options.draggable===!0&&this.$node.addClass(this.manager.options.classes.draggable)),this.$node.attr("data-parent",this.parent),this.$node.attr("data-level",this.level),this.$indent.css("marginLeft",(parseInt(this.level)-this.manager.options.rootLevel)*this.manager.options.nodeIndent+"px").html("&zwnj;"),void 0!==this.type&&this.manager.options.types&&void 0!==this.manager.options.types[this.type]&&this.$typeIcon.addClass(this.manager.options.types[this.type]).show()},attachEvents:function(){var b=this,c=parseInt(this.manager.options.selectLimit);if(this.$node.mouseover(function(){(b.manager.options.draggable!==!0||b.manager.isNodeDragging()!==!0)&&(b.$node.addClass(b.manager.options.classes.hovered),b.isHovered(!0))}),this.$node.mouseleave(function(){b.$node.removeClass(b.manager.options.classes.hovered),b.isHovered(!1)}),this.$name.click(isNaN(c)===!1&&(c>0||-1===c)?function(d){if(b.isSelected())a.isFunction(b.manager.options.onUnselect)&&b.manager.options.onUnselect(b),b.isSelected(!1);else{var e=b.manager.getSelectedNodes();1===c&&1===e.length?(e[0].isSelected(!1),e=[]):e.length===c&&(a.isFunction(b.manager.options.onSelectOverflow)&&b.options.onSelectOverflow(b),d.preventDefault()),(e.length<c||-1===c)&&b.isSelected(!0),a.isFunction(b.manager.options.onSelect)&&b.manager.options.onSelect(b)}}:function(){b.$ceIcon.click()}),this.$ceIcon.click(function(a){b.isExpanded()?b.collapse():b.expand({isAltPressed:a.altKey})}),b.manager.options.dragCanExpand===!0&&this.$ceIcon.mouseover(function(){b.manager.options.draggable===!0&&b.manager.isNodeDragging()===!0&&(b.isExpanded()||b.expand())}),a.each(this.manager.actions,function(a,c){b.$node.find("."+b.manager.options.classes.action+"-"+a).click(function(){c.event(b,b.manager)})}),this.$saveButton.click(function(){b.save()}),this.$cancelButton.click(function(){b.saveCancel()}),b.manager.options.draggable===!0){var d=function(a,c){var d,e=a.offset.top-c.offset().top,f=c.offset().top,g=c.outerHeight(),h=g-Math.round(a.helper.outerHeight()/2),i={left:b.manager.$tree.offset().left+5};return.3*h>=e?(d="before",i.top=f+3):.7*h>=e?(d="lastChild",i.top=f+h/2):(d="after",i.top=f+h),i.top+=2,{position:d,pointerOffset:i}};this.$node.draggable({scroll:!0,refreshPositions:b.manager.options.dragCanExpand,helper:function(){var c=b.manager.getNode(a(this));return'<mark class="'+b.manager.options.classes.draggableHelper+'">'+c.name+"</mark>"},cursorAt:{top:0,left:0},handle:"."+b.manager.options.classes.handleIcon,start:function(){a.browser.webkit||a(this).data("bs.gtreetable.gtreetablenode.scrollTop",a(window).scrollTop())},stop:function(){b.manager.isNodeDragging(!1)},drag:function(c,e){if(!a.browser.webkit){var f=a(window).scrollTop(),g=a(this).data("bs.gtreetable.gtreetablenode.scrollTop")-f;e.position.top-=f+g,a(this).data("bs.gtreetable.gtreetablenode.startingScrollTop",f)}var h=a(this).data("bs.gtreetable.gtreetablenode.currentDroppable");if(h){var i=d(e,h);b.manager.getNode(h).setMovePosition(i.position,i.pointerOffset)}}}).droppable({accept:"."+b.manager.options.classes.node,over:function(c,e){var f=a(this),g=d(e,f);b.manager.getNode(f).setMovePosition(g.position,g.pointerOffset),e.draggable.data("bs.gtreetable.gtreetablenode.currentDroppable",f)},out:function(c,d){d.draggable.removeData("bs.gtreetable.gtreetablenode.currentDroppable"),b.manager.getNode(a(this)).setMovePosition()},drop:function(c,d){var e=a(this),f=b.manager.getNode(e),g=f.getMovePosition();d.draggable.removeData("bs.gtreetable.gtreetablenode.currentDroppable"),f.setMovePosition(),b.manager.getNode(d.draggable).move(f,g)}})}},makeEditable:function(){this.showForm(!0)},save:function(){var b=this;a.isFunction(b.manager.options.onSave)?a.when(a.ajax(b.manager.options.onSave(b))).done(function(a){b._save(a)}):b._save({name:b.getName(),id:b.manager.generateNewId()})},_save:function(b){var c=this;c.id=b.id,c.name=b.name,a.isFunction(c.manager.options.sort)&&c.sort(),this.manager.options.cache>0&&this.manager.cacheManager.synchronize(c.isSaved()?"edit":"add",c),c.render(),c.showForm(!1),c.isHovered(!1)},saveCancel:function(){this.showForm(!1),this.isSaved()||this._remove()},expand:function(b){var d=this,e=d,f=a.extend({},{isAltPressed:!1,onAfterFill:function(a,b){a.isExpanded(!0),0===b.length&&(a.manager.options.showExpandIconOnEmpty===!0?a.isExpanded(!1):a.showCeIcon(!1))}},b);a.when(this.manager.getSourceNodes(d.id,f.isAltPressed)).done(function(a){var b=a[d.manager.options.nodesWrapper];for(var g in b){var h=new c(b[g],d.manager);d.insertIntegral(h,e),e=h}f&&f.onAfterFill(d,b)})},collapse:function(){this.isExpanded(!1),a.each(this.getDescendants({depth:-1,includeNotSaved:!0}),function(){this.$node.remove()})},_canAdd:function(a){var b={result:!(0===a.parent&&this.manager.options.manyroots===!1)};return b.result||(b.message=this.manager.language.messages.onNewRootNotAllowed),b},add:function(a,b){function d(){f&&(e.isExpanded(!0),e.showCeIcon(!0)),g.insert(a,e),g.insertPosition=a,g.relatedNodeId=e.id,g.showForm(!0)}var e=this,f="lastChild"===a||"firstChild"===a,g=new c({level:e.level+(f?1:0),parent:e.level!==this.manager.options.rootLevel||f?f?e.id:e.parent:0,type:b},this.manager),h=this._canAdd(g);return h.result?void(f&&!e.isExpanded()?e.expand({onAfterFill:function(){d()}}):d()):(alert(h.message),!1)},insert:function(a,b){var c,d,e=this;if("before"===a)b.$node.before(e.$node);else if("after"===a)d=b,b.isExpanded()&&(c=b.getDescendants({depth:1,index:-1,includeNotSaved:!0}),d=void 0===c?d:c),d.$node.after(e.$node);else if("firstChild"===a)this.manager.getNodeById(b.id).$node.after(e.$node);else{if("lastChild"!==a)throw"Wrong position.";c=b.getDescendants({depth:1,index:-1,includeNotSaved:!0}),d=void 0===c?b:c,d.$node.after(e.$node)}},insertIntegral:function(a,b){void 0===b?this.manager.$tree.append(a.$node):b.$node.after(a.$node)},remove:function(){var b=this;b.isSaved()&&a.isFunction(b.manager.options.onDelete)?a.when(a.ajax(b.manager.options.onDelete(b))).done(function(){b._remove()}):this._remove()},_remove:function(){if(this.isExpanded()===!0&&this.collapse(),this.$node.remove(),this.parent>0){var a=this.manager.getNodeById(this.parent);0===a.getDescendants({depth:1,includeNotSaved:!0}).length&&a.collapse()}this.manager.options.cache>0&&this.manager.cacheManager.synchronize("delete",this)},_canMove:function(b,c){var d=this,e={result:!0};return 0===b.parent&&this.manager.options.manyroots===!1&&"lastChild"!==c?(e.result=!1,e.message=this.manager.language.messages.onMoveAsRoot):a.each(b.getParents(),function(){return this.id===d.id?(e.result=!1,e.message=this.manager.language.messages.onMoveInDescendant,!1):void 0}),e},move:function(b,c){var d=this,e=this._canMove(b,c);return e.result===!1?(alert(e.message),!1):void(a.isFunction(d.manager.options.onMove)?a.when(a.ajax(d.manager.options.onMove(d,b,c))).done(function(){d._move(b,c)}):d._move(b,c))},_move:function(b,c){var d=this,e=d.getDescendants({depth:-1,includeNotSaved:!0}),f=a.extend({},d),g=d.getIP(),h=b.level-d.level;if(d.parent="lastChild"===c?b.id:b.parent,d.level=b.level,"lastChild"!==c||b.isExpanded()){if("lastChild"===c&&(d.level+=1,b.showCeIcon(!0)),d.render(),d.insert(c,b),e.length>0){var i=d.$node;"lastChild"===c&&(h+=1),a.each(e,function(){var a=this;a.level+=h,a.render(),i.after(a.$node),i=a.$node})}}else d.$node.remove(),a.each(e,function(){this.$node.remove()});var j=d.manager.getNodeById(f.parent);void 0!==j&&0===j.getDescendants({depth:1,includeNotSaved:!0}).length&&j.isExpanded(!1),a.isFunction(d.manager.options.sort)&&d.sort(),this.manager.options.cache>0&&this.manager.cacheManager.synchronize("move",d,{oOldNode:f,oldIP:g})},sort:function(){var b=this,c=b.getSiblings();if(c.length>0){var d,e=b.isExpanded()?b.getDescendants({depth:-1,includeNotSaved:!0}):[];a.each(c,function(){return-1===b.manager.options.sort(b,this)?(d=this,!1):void 0}),void 0===d?(d=c[c.length-1],d.isExpanded()&&(d=b.manager.getNodeById(b.parent).getDescendants({depth:-1,index:-1,includeNotSaved:!0})),d.$node.after(b.$node)):d.$node.before(b.$node);var f=b.$node;a.each(e,function(){var a=this;f.after(a.$node),f=a.$node})}},isLoading:function(a){return void 0===a?this._isLoading:void(a?(this.$name.addClass(this.manager.options.classes.loading),this._isLoading=!0):(this.$name.removeClass(this.manager.options.classes.loading),this._isLoading=!1))},isSaved:function(a){return void 0===a?this._isSaved:void(a?(this.$node.addClass(this.manager.options.classes.saved),this._isSaved=!0):(this.$node.removeClass(this.manager.options.classes.saved),this._isSaved=!1))},isSelected:function(a){return void 0===a?this._isSelected:void(a?(this.$node.addClass(this.manager.options.classes.selected),this._isSelected=!0):(this.$node.removeClass(this.manager.options.classes.selected),this._isSelected=!1))},isExpanded:function(a){return void 0===a?this._isExpanded:void(a?(this.$node.addClass(this.manager.options.classes.expanded).removeClass(this.manager.options.classes.collapsed),this._isExpanded=!0):(this.$node.addClass(this.manager.options.classes.collapsed).removeClass(this.manager.options.classes.expanded),this._isExpanded=!1))},isHovered:function(a){return void 0===a?this._isHovered:void(a?(this.$node.addClass(this.manager.options.classes.hovered),this._isHovered=!0):(this.$node.removeClass(this.manager.options.classes.hovered),this.$node.find(".btn-group").removeClass("open"),this._isHovered=!1))},isEditable:function(a){return void 0===a?this._isEditable:void(this._isEditable=a)},showCeIcon:function(a){this.$ceIcon.css("visibility",a?"visible":"hidden")},showForm:function(a){a===!0?(this.isEditable(!0),this.$input.val(this.name),this.$name.addClass("hide"),this.$action.removeClass("hide"),this.$input.focus()):(this.isEditable(!1),this.$name.removeClass("hide"),this.$action.addClass("hide"))}},d.prototype={_getIP:function(a){return"string"==typeof a?a:a.getIP()},get:function(a){return this._cached[this._getIP(a)]},set:function(a,b){this._cached[this._getIP(a)]=b},remove:function(a){this._cached[this._getIP(a)]=void 0},synchronize:function(a,b,c){if(b.parent>0)switch(a){case"add":this._synchronizeAdd(b);break;case"edit":this._synchronizeEdit(b);break;case"delete":this._synchronizeDelete(b);break;case"move":this._synchronizeMove(b,c);break;default:throw"Wrong method."}},_synchronizeAdd:function(a){var b=this.manager.getNodeById(a.parent);if(this.manager.options.cache>1){var c=this.get(b);void 0!==c&&(c.push({id:a.id,name:a.getName(),level:a.level,type:a.type,parent:a.parent}),this.set(b,this.isSortDefined()?this.sort(c):c))}else this.remove(b)},_synchronizeEdit:function(b){var c=this.manager.getNodeById(b.parent);if(this.manager.options.cache>1){var d=this.get(c);a.each(d,function(){return this.id===b.id?(this.name=b.getName(),!1):void 0}),this.set(c,this.isSortDefined()?this.sort(d):d)}else this.remove(c)},_synchronizeDelete:function(b){var c=this.manager.getNodeById(b.parent);if(this.manager.options.cache>1){var d,e=this.get(c);a.each(e,function(a){return this.id===b.id?(d=a,!1):void 0}),void 0!==d&&(e.splice(d,1),this.set(c,e))}else this.remove(c)},_synchronizeMove:function(b,c){var d=this,e=b.getIP(),f=b.level-c.oOldNode.level;a.each(this._cached,function(b){if(b===c.oldIP||0===b.indexOf(c.oldIP+".")){if(d.manager.options.cache>1){var g=[],h=b!==c.oldIP?e+b.substr(c.oldIP.length):e;a(d.get(b)).each(function(){this.level+=f,g.push(this)}),d.set(h,g)}d.remove(b)}}),this.synchronize("delete",c.oOldNode),this.synchronize("add",b)},isSortDefined:function(){return a.isFunction(this.manager.options.sort)},sort:function(a){return a.sort(this.manager.options.sort)}};var f=a.fn.gtreetable;a.fn.gtreetable=e,a.fn.gtreetable.Constructor=b,a.fn.gtreetable.defaults={nodesWrapper:"nodes",nodeIndent:16,language:"en",inputWidth:"60%",cache:2,readonly:!1,selectLimit:1,rootLevel:0,manyroots:!1,draggable:!1,dragCanExpand:!1,showExpandIconOnEmpty:!1,languages:{"en-US":{save:"Save",cancel:"Cancel",action:"Action",actions:{createBefore:"Create before",createAfter:"Create after",createFirstChild:"Create first child",createLastChild:"Create last child",update:"Update","delete":"Delete"},messages:{onDelete:"Are you sure?",onNewRootNotAllowed:"Adding the now node as root is not allowed.",onMoveInDescendant:"The target node should not be descendant.",onMoveAsRoot:"The target node should not be root."}}},defaultActions:[{name:"${createBefore}",event:function(a){a.add("before","default")}},{name:"${createAfter}",event:function(a){a.add("after","default")}},{name:"${createFirstChild}",event:function(a){a.add("firstChild","default")}},{name:"${createLastChild}",event:function(a){a.add("lastChild","default")}},{divider:!0},{name:"${update}",event:function(a){a.makeEditable()}},{name:"${delete}",event:function(a,b){confirm(b.language.messages.onDelete)&&a.remove()}}],classes:{node:"node",loading:"node-loading",selected:"node-selected",hovered:"node-hovered",expanded:"node-expanded",collapsed:"node-collapsed",draggable:"node-draggable",draggableHelper:"node-draggable-helper",draggablePointer:"node-draggable-pointer",draggableContainer:"node-draggable-container",saved:"node-saved",name:"node-name",icon:"node-icon",selectedIcon:"node-icon-selected",ceIcon:"node-icon-ce",typeIcon:"node-icon-type",handleIcon:"node-icon-handle",action:"node-action",indent:"node-indent",saveButton:"node-save",cancelButton:"node-cancel",buttons:"node-buttons"}},a.fn.gtreetable.noConflict=function(){return a.fn.gtreetable=f,this}}(jQuery);

    $(document).ready(function () {
        $(document).off('click','#add').on('click',"#add",function () {
           $(".upload").show();
           $(".display").hide();
        });
        $(document).off('click','#backtodisplay').on('click',"#backtodisplay",function () {
            $(".upload").hide();
            $(".display").show();
            $.ajax(
                {
                    type: 'POST',
                    url: '/admin/admin/reloadlist',
                    data: {
                        dir: $(document).find("#folder").val(),
                        "<?= Yii::$app->request->csrfParam; ?>":"<?=Yii::$app->request->csrfToken?>"
                    },
                    dataType: 'json',
                    success: function (XMLHttpRequest) {
                        var container = $(document).find("#result-ck");
                        container.html(XMLHttpRequest.responseText);
                    },
                }
            )
        });

        var TableTree = function () {

            var demo1 = function () {
                var container = $(document).find("#result-ck");
                jQuery('#gtreetable').gtreetable({
                    'draggable': false,
                    'manyroots': true,
                    'source': function (id) {
                        return {
                            type: 'GET',
                            url: '/admin/admin/tabletree',
                            data: {
                                'id': id,
                                "<?= Yii::$app->request->csrfParam; ?>":"<?=Yii::$app->request->csrfToken?>"
                            },
                            dataType: 'json',
                            error: function (XMLHttpRequest) {
                                alert(XMLHttpRequest.status + ': ' + XMLHttpRequest.responseText);
                            }
                        }
                    },
                    defaultActions: [],
                    actions: [{
                        name: "Thêm thư mục", event: function (a) {
                            a.add("before", "default")
                        }
                    }, {
                        name: "Thêm thư mục con", event: function (a) {
                            a.add("firstChild", "default")
                        }
                    }, {divider: !0}, {
                        name: "Đổi tên", event: function (a) {
                            a.makeEditable()
                        }
                    }, {
                        name: "Xóa", event: function (a, b) {
                            confirm(b.language.messages.onDelete) && a.remove()
                        }
                    }],
                    'sort': function (a, b) {
                        var aName = a.name.toLowerCase();
                        var bName = b.name.toLowerCase();
                        return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
                    },
                    'types': {default: 'glyphicon glyphicon-folder-open', folder: 'glyphicon glyphicon-folder-open'},
                    'inputWidth': '255px',
                    'onSave': function (oNode) {
                        return {
                            type: 'POST',
                            url: !oNode.isSaved() ? '/admin/admin/nodecreate' : '/admin/admin/nodeupdate?id=' + oNode.getId(),
                            data: {
                                parent: oNode.getParent(),
                                name: oNode.getName(),
                                position: oNode.getInsertPosition(),
                                related: oNode.getRelatedNodeId(),
                                "<?= Yii::$app->request->csrfParam; ?>":"<?=Yii::$app->request->csrfToken?>"
                            },
                            dataType: 'json',
                            success: function (XMLHttpRequest) {
                                alert(XMLHttpRequest.responseText);
                                if (XMLHttpRequest.status) {
                                    location.reload();
                                }
                            },
                            error: function (XMLHttpRequest) {
                                alert(XMLHttpRequest.responseText);
                            }
                        };
                    },
                    'onSelect': function (oNode) {
                        block({target: "#result-ck"});
                        $.ajax(
                            {
                                type: 'POST',
                                url: '/admin/admin/nodeselected',
                                data: {
                                    parent: oNode.getParent(),
                                    name: oNode.getName(),
                                    position: oNode.getInsertPosition(),
                                    related: oNode.getRelatedNodeId(),
                                    "<?= Yii::$app->request->csrfParam; ?>":"<?=Yii::$app->request->csrfToken?>"
                                },
                                dataType: 'json',
                                success: function (XMLHttpRequest) {
                                    $("tbody.files").html("");
                                    $(document).find("#add").removeClass("hidden");
                                    container.html(XMLHttpRequest.responseText)
                                    var dir_path="";
                                    var parent=oNode.getParent();
                                    if(parent===0){
                                        dir_path="/source/"+oNode.getName()
                                    }else{
                                        dir_path=parent.split(":")[0]+"/"+oNode.getName()
                                    }
                                    $(document).find("#folder").val(dir_path);
                                    unblock("#result-ck");
                                },
                            }
                        )
                    },
                    'onDelete': function (oNode) {
                        return {
                            type: 'POST',
                            url: '/admin/admin/nodedelete',
                            dataType: 'json',
                            data: {
                                node: oNode.getId(),
                                "<?= Yii::$app->request->csrfParam; ?>":"<?=Yii::$app->request->csrfToken?>"
                            },
                            success: function (XMLHttpRequest) {
                                alert(XMLHttpRequest.responseText);
                            },
                            error: function (XMLHttpRequest) {
                                alert(XMLHttpRequest.responseText);
                            }
                        };
                    }
                });
            }

            return {

                //main function to initiate the module
                init: function () {
                    demo1();
                }

            };

        }();


        TableTree.init();

        $('#fileupload').fileupload({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: '/admin/admin/uploadfile',
            maxFileSize: 45000000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png|webp|xlsx|xls|csv|doc|docx|pdf)$/i
        });

    })
    $(document).find("#ajaxCrudModal").on('hidden.bs.modal', function () {
        $(".modal-dialog").removeClass("modal-full");
    })
</script>