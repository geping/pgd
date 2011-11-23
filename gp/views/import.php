<div class="login_main">
    <div class="box box-error" id="login_error_point" style="display: none;"></div>
    <div class="login" style="margin-left:200px;">
        <div class="login_top">
            <div class="import_t"><h2>导入数据</h2></div>
            <form id="loginForm" action="/index.php?c=home&m=import"  method="post" enctype="multipart/form-data">
                <ul class="import_ul">
                    <li class="text_import">上传Excel：</li><li class="input_import"><input type="file" size="16" name="file" id="file"/></li>
                    <li class="btn_l"><input name="submit" id="update_submit" type="submit" value=''/></li>
                </ul>
                <input type="hidden" name="up_submit" value="上传" />
            </form>
        </div>
        <div class="login_bottom_box">
            <div class="login_bottom">
                <div class="login_bottom"> <a href="#" class=""></a><a href="#" class="safe checked"></a></div>
            </div>
        </div>
    </div>
</div>

