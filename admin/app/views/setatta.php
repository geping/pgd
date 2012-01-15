<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('p').mouseover(function(){
			jQuery(this).children('span').css('color', '#000000');
		});
		jQuery('p').mouseout(function(){
			jQuery(this).children('span').css('color', '#BBBBBB');
		});

		/*编辑数据*/
		var inputv = textv = '';
		jQuery('input[type="text"]').focus(function(){
			inputv = jQuery(this).val();
		});
		jQuery('input[type="text"]').blur(function(){
			if (jQuery(this).val() != inputv) {
				var upval = jQuery(this).val();
				var field = jQuery(this).attr('id');
				_updateWebsite(field, upval);
			}
		});
		jQuery('.iPhoneCheckContainer').click(function(){
			var isopen = 0;
			if (jQuery('#isopen').attr('checked') == true) {
				isopen = 1;
				/*禁止编辑框*/
				/*jQuery('input[type="text"]').attr('disabled', false);*/
			} else {
				isopen = 0;
				/*启用编辑框*/
				/*jQuery('input[type="text"]').attr('disabled', true);*/
			}
			_updateWebsite('isopen', isopen);
		});
		/*编辑数据end*/
	});
function _updateWebsite(field, value) {
	jQuery.ajax({
		type:	"GET",
		url:	"/ajaxSetAtta",
		data:	"field="+field+"&value="+value,
		success:function(msg) {
			var method = message = '';
			if (msg == 1) {
				method = 'success';
				message = '修改成功';
			} else {
				method = 'error';
				message = '修改数据失败，请检查！';
			}
			_gp_fade('.messagebox', method, message, 2000);
		}
	});
}
</script>
			<div id="primary_right">
				<div class="inner">
					<ul class="dash">
						<li class="fade_hover tooltip" title="附件设置">
							<a href="/setAtta">
								<img src="/images/icons/dashboard/36.png" alt="" />
								<span>附件管理</span>
							</a>
						</li>
					</ul> <!-- end dashboard items -->
                    <div class="clearboth"></div>
					<div class="messagebox"></div>
					<hr />
					 <fieldset>

						<legend>以下为开发者上传设置</legend>
						
						<p>
							<label class="fix">是否开启用户上传：</label>
							<input type="checkbox" class="iphone" id="isopen" name="isopen" <?php if ($body['list']['isopen'] == 1) {echo 'checked="checked"';} ?> />
							<span class="field_desc2">需开启用户上传功能，以下设置才会生效</span>
						</p>
						<div class="clearboth"></div>
						<hr />
						<p>
							<label>附件目录：</label>
							<input class="lf" name="atta_path" id="atta_path" type="text" value="<?php echo $body['list']['atta_path']; ?>" /> 
							<span class="field_desc">文件存放路径</span>
						</p>

						<p>
							<label>扩展名：</label>
							<input class="lf" name="atta_ext" id="atta_ext" type="text" value="<?php echo $body['list']['atta_ext']; ?>" /> 
							<span class="field_desc">允许上传的文件的扩展名，多个扩展名用英文逗号分隔（如：.abc,.xyz）</span>
						</p>

						<p>
							<label>附件大小（单位：KB）：</label>
							<input class="sf" name="atta_size" id="atta_size" type="text" value="<?php echo $body['list']['atta_size']; ?>" /> 
							<span class="field_desc">上传文件的大小(单位：K)</span>
						</p>

						<div class="clearboth"></div>
						<hr />
						<p>
							<label>上传图片路径：</label>
							<input class="lf" name="pic_path" id="pic_path" type="text" value="<?php echo $body['list']['pic_path']; ?>" /> 
							<span class="field_desc">上传图片的保存路径</span>
						</p>
						<p>
							<label>图片扩展名：</label>
							<input class="lf" name="pic_ext" id="pic_ext" type="text" value="<?php echo $body['list']['pic_ext']; ?>" /> 
							<span class="field_desc">允许上传的图片的扩展名，多个扩展名用英文逗号分隔（如：.jpg,.png）</span>
						</p>
						<p>
							<label>图片大小（单位：KB）：</label>
							<input class="sf" name="pic_size" id="pic_size" type="text" value="<?php echo $body['list']['pic_size']; ?>" /> 
							<span class="field_desc">上传图片的大小(单位：K)</span>
						</p>
						<p>
							<label>图片最大宽：</label>
							<input class="sf" name="pic_width" id="pic_width" type="text" value="<?php echo $body['list']['pic_width']; ?>" /> 
							<span class="field_desc">上传图片的最大宽度</span>
						</p>
						<p>
							<label>图片最大高：</label>
							<input class="sf" name="pic_height" id="pic_height" type="text" value="<?php echo $body['list']['pic_height']; ?>" /> 
							<span class="field_desc">上传图片的最大高度</span>
						</p>
						<div class="clearboth"></div>
					</fieldset>
					<hr />
					<div class="clearboth"></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
