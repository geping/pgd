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
		jQuery('textarea').focus(function(){
			textv = jQuery(this).val();
		});
		jQuery('input[type="text"]').blur(function(){
			if (jQuery(this).val() != inputv) {
				var upval = jQuery(this).val();
				var field = jQuery(this).attr('id');
				_updateWebsite(field, upval);
			}
		});
		jQuery('.iPhoneCheckContainer').click(function(){
			var mail_wordwrap = 0;
			if (jQuery('#mail_wordwrap').attr('checked') == true) {
				mail_wordwrap = 1;
			} else {
				mail_wordwrap = 0;
			}
			_updateWebsite('mail_wordwrap', mail_wordwrap);
		});
		jQuery('textarea').blur(function(){
			if (jQuery(this).val() != textv) {
				var upval = jQuery(this).val();
				var field = jQuery(this).attr('id');
				_updateWebsite(field, upval);
			}
		});
		/*编辑数据end*/
	});

function _updateWebsite(field, value) {
	jQuery.ajax({
		type:	"GET",
		url:	"/ajaxSetweb",
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
						<li class="fade_hover tooltip" title="常用网站设置">
							<a href="/setweb">
								<img src="/images/icons/dashboard/2.png" alt="" />
								<span>常用网站设置</span>
							</a>
						</li>
					</ul> <!-- end dashboard items -->
                    <div class="clearboth"></div>
					<div class="messagebox"></div>
					<hr />
					 <fieldset>

						<legend>以下设置均为网站重要设置!</legend>
						
						<p>
							<label>网站名称：</label>
							<input class="lf" name="web_name" id="web_name" type="text" value="<?php echo $body['list']['web_name']; ?>" /> 
							<span class="field_desc">设置网站名称</span>
						</p>

						<p>
							<label>网站URL：</label>
							<input class="lf" name="web_host" id="web_host" type="text" value="<?php echo $body['list']['web_host']; ?>" /> 
							<span class="field_desc">网站的网址</span>
						</p>

						<p>
							<label>管理员邮箱：</label>
							<input class="lf" name="web_email" id="web_email" type="text" value="<?php echo $body['list']['web_email']; ?>" /> 
							<span class="field_desc">发送常用邮件时会用到</span>
						</p>

						<p>
							<label>网站关键字：</label>
							<input class="lf" name="web_keyword" id="web_keyword" type="text" value="<?php echo $body['list']['web_keyword']; ?>" /> 
							<span class="field_desc">用于搜索引擎获取关键字</span>
						</p>

						<p>
							<label>网站描述：</label>
							<textarea name="web_description" id="web_description" cols="80" rows="5"><?php echo $body['list']['web_description']; ?></textarea>
						</p>
						<div class="clearboth"></div>
						<hr />
						<p>
							<label>邮件发送协议：</label>
							<input class="lf" name="mail_protocol" id="mail_protocol" type="text" value="<?php echo $body['list']['mail_protocol']; ?>" /> 
							<span class="field_desc">设置邮件的发送方式</span>
						</p>
						<p>
							<label>SMTP 服务器地址：</label>
							<input class="lf" name="smtp_host" id="smtp_host" type="text" value="<?php echo $body['list']['smtp_host']; ?>" /> 
							<span class="field_desc">邮件服务器的主机地址</span>
						</p>
						<p>
							<label>SMTP 用户账号：</label>
							<input class="lf" name="smtp_user" id="smtp_user" type="text" value="<?php echo $body['list']['smtp_user']; ?>" /> 
							<span class="field_desc">发送邮件方的邮箱帐号</span>
						</p>
						<p>
							<label>SMTP 用户密码：</label>
							<input class="lf" name="smtp_pass" id="smtp_pass" type="text" value="<?php echo $body['list']['smtp_pass']; ?>" /> 
							<span class="field_desc">发送邮件方的邮箱密码</span>
						</p>
						<p>
							<label>SMTP 端口：</label>
							<input class="lf" name="smtp_port" id="smtp_port" type="text" value="<?php echo $body['list']['smtp_port']; ?>" /> 
							<span class="field_desc">邮件服务器的端口</span>
						</p>
						<p>
							<label>SMTP 超时设置(单位：秒)：</label>
							<input class="lf" name="smtp_timeout" id="smtp_timeout" type="text" value="<?php echo $body['list']['smtp_timeout']; ?>" /> 
							<span class="field_desc">发送邮件时的超时设置</span>
						</p>
						<p>
							<label class="fix">是否开启自动换行：</label>
							<input type="checkbox" class="iphone" name="mail_wordwrap" id="mail_wordwrap" <?php if ($body['list']['mail_wordwrap'] == 1) {echo 'checked="checked"';}?> />
							<span class="field_desc">设置邮件文字换行</span>
						</p>
						<p>
							<label>邮件类型：</label>
							<input class="lf" name="mail_type" id="mail_type" type="text" value="<?php echo $body['list']['mail_type']; ?>" /> 
							<span class="field_desc">邮件的文本格式</span>
						</p>
						<p>
							<label>字符编码：</label>
							<input class="lf" name="mail_charset" id="mail_charset" type="text" value="<?php echo $body['list']['mail_charset']; ?>" /> 
							<span class="field_desc">邮件的文本的编码方式</span>
						</p>
						<div class="clearboth"></div>
					</fieldset>
					<hr />
					<div class="clearboth"></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
