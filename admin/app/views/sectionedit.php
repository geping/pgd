<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('p').mouseover(function(){
			jQuery(this).children('span').css('color', '#000000');
		});
		jQuery('p').mouseout(function(){
			jQuery(this).children('span').css('color', '#BBBBBB');
		});
		jQuery('.type1').show();
		jQuery('.type2').hide();
		jQuery('input[type="radio"]').each(function(){
			if (jQuery(this).is(':checked') == true) {
				if (jQuery(this).attr('id') == 'type1') {
					jQuery('.type2').hide();
					jQuery('.type1').show();
				}
				if (jQuery(this).attr('id') == 'type2') {
					jQuery('.type1').hide();
					jQuery('.type2').show();
				}
			}
		});
		jQuery('#type1').click(function(){
			jQuery('.type2').hide();
			jQuery('.type1').show();
		});
		jQuery('#type2').click(function(){
			jQuery('.type1').hide();
			jQuery('.type2').show();
		});
        /*用于联合下拉*/
        jQuery('#category').html('');
        _getAjaxCategory('ajaxRelevanceCategory', <?php echo $body['data']['id']; ?>);
		/*提交前做最后挣扎*/
		jQuery('form').submit(function(){
			_setHidden();
			return true;
		});
	});
function _getAjaxCategory(action, id) {
	jQuery.ajax({
		type:	"GET",
		url:	"/"+action,
		data:	"id="+id,
		success:function(msg) {
			if (msg === 0) {
				alert('获取数据出错，请检查');
			} else if (msg === '') {
			} else {
				jQuery('#category').append(msg);
			}
		}
	});
	return ;
}
function _selectChange(obj) {
	/*编辑状态特加的，不能选择自己*/
	if (jQuery(obj).val() == jQuery('#id').val()) {
		_gp_fade('.messagebox', 'error', '不能选择自己作为自己的父栏目', 3000);
		jQuery(obj).val('');
		return false;
	}
	jQuery(obj).nextAll('select').remove();
	if (jQuery(obj).val() != '') {
		/*获取并设置路径*/
		var selectval = '';
		jQuery('.style1').each(function(){
			selectval += jQuery(this).val() + ',';
		});
		if (selectval != '') {
			jQuery('#path').val(selectval);
		}
		jQuery('#parent_id').val(jQuery(obj).val());
		_getAjaxCategory('ajaxSectionCategory', jQuery(obj).val());
	} else {
		_setHidden();
	}
	return ;
}
function _setHidden() {
	var selectval = parentval = '';
	jQuery('.style1').each(function(){
		if (jQuery(this).val() != '') {
			selectval += jQuery(this).val() + ',';
			parentval = jQuery(this).val();
		}
	});
	if (selectval != '') {
		jQuery('#path').val(selectval);
	} else {
		jQuery('#path').val('');
	}
	if (parentval != '') {
		jQuery('#parent_id').val(parentval);
	} else {
		jQuery('#parent_id').val(0);
	}
}
</script>
			<div id="primary_right">
				<div class="inner">
					<ul class="dash2">
						<li class="fade_hover tooltip" title="点击返回栏目管理">
							<a href="/sectionList">
								<span>栏目管理</span>
							</a>
						</li>
					</ul> <!-- end dashboard items -->
					<div class="messagebox"></div>
					<form action="/sectionEdit" method="POST">
                    <div class="clearboth"></div>
					<hr />
					 <fieldset>
						<legend>添加新栏目</legend>
						<p>
							<label>栏目名称：</label>
							<input class="lf" name="title" id="title" type="text" value="<?php echo $body['data']['title']; ?>" /> 
							<span class="field_desc">栏目名称，显示在首页菜单</span>
						</p>

                        <p>
							<label class="fix">所属栏目：</label>
							<span id="category"></span>
							<span class="field_desc2">选择所属栏目</span>
						</p>

                        <p>
							<label class="fix">是否显示：</label>
							<input type="checkbox" class="iphone" name="isshow" id="isshow" value="1" <?php if ($body['data']['isshow'] == 1){echo 'checked="checkbox"';} ?> />
							<span class="field_desc2">该栏目是否显示在菜单里面</span>
						</p>
                        
						<p>
							<label>文件保存目录：</label>
							<input class="lf" name="uri" id="uri" type="text" value="<?php echo $body['data']['uri']; ?>" /> 
							<span class="field_desc">生成的文件所存放的目录（如：/product/）</span>
						</p>

						<!--
						<p>
							<label>默认页名称：</label>
							<input class="sf" name="default" id="default" type="text" value="" /> 
							<span class="field_desc">默认页名称为index.html，也可根据实际情况更改</span>
						</p>
						-->

						<p>
							<label>栏目类型：</label>
							<input type="radio" name="type" id="type1" value="1" <?php if ($body['data']['type'] == 1) {echo 'checked="checked"';} ?> /><label for="type1">单页面</label>
							<input type="radio" name="type" id="type2" value="2" <?php if ($body['data']['type'] == 2) {echo 'checked="checked"';} ?>/><label for="type2">双页面</label>
						</p>

						<p class="type1">
							<label>页面模板：</label>
							<input class="lf" name="templete_path" id="templete_path" type="text" value="<?php echo $body['data']['templete_path']; ?>" /> 
							<span class="field_desc">页面模板的路径，如：/templete/abc.html</span>
						</p>
						<p class="type2">
							<label>列表页模板：</label>
							<input class="lf" name="templete_list_path" id="templete_list_path" type="text" value="<?php echo $body['data']['templete_list_path']; ?>" /> 
							<span class="field_desc">列表页面模板的路径，如：/templete/abc.html</span>
						</p>
						<p class="type2">
							<label>详细页模板：</label>
							<input class="lf" name="templete_detailed_path" id="templete_detailed_path" type="text" value="<?php echo $body['data']['templete_detailed_path']; ?>" /> 
							<span class="field_desc">详细页面模板的路径，如：/templete/xyz.html</span>
						</p>
						<p>
							<label>排序：</label>
							<input class="sf" name="sort" id="sort" type="text" value="<?php echo $body['data']['sort']; ?>" /> 
							<span class="field_desc">和显示顺序有关</span>
						</p>
						<p>
							<label>栏目关键字：</label>
							<input class="lf" name="keyword" id="keyword" type="text" value="<?php echo $body['data']['keyword']; ?>" /> 
							<span class="field_desc">用于搜索引擎获取关键字</span>
						</p>

						<p>
							<label>栏目描述：</label>
							<textarea name="description" id="description" cols="80" rows="5"><?php echo $body['data']['description']; ?></textarea>
						</p>
						<div class="clearboth"></div>
						<input type="hidden" name="id" id="id" value="<?php echo $body['data']['id']; ?>" />
						<input type="hidden" name="parent_id" id="parent_id" value="" />
						<input type="hidden" name="path" id="path" value="" />
						<p><input class="button" type="submit" name="submit" value="提交" /></p>
					</fieldset>
					<hr />
					<div class="clearboth"></div>
					</form>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
