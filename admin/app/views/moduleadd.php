<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('p').mouseover(function(){
			jQuery(this).children('span').css('color', '#000000');
		});
		jQuery('p').mouseout(function(){
			jQuery(this).children('span').css('color', '#BBBBBB');
		});
		jQuery('#t_id').change(function(){
			var tid = jQuery(this).val();
			if (tid == 0) {
				jQuery('#preview').hide();
			} else {
				jQuery('#preview').show();
				var pic = jQuery('#pi'+tid).html();
				var img = '<img src="'+pic+'" width="80px" height="80px">';
				jQuery('#preview').html(img);
			}
		});
	});
</script>
			<div id="primary_right">
				<div class="inner">
					<ul class="dash2">
						<li class="fade_hover tooltip" title="点击返回模块管理">
							<a href="/moduleList">
								<span>模块管理</span>
							</a>
						</li>
					</ul> <!-- end dashboard items -->
					<div style="display:none;">
						<?php
							foreach($body['template'] as $key => $value) {
								echo '<span id="pi'.$value['id'].'">'.$value['pic'].'</span>';
							}
						?>
					</div>
					<form method="POST" action="/moduleAdd">
                    <div class="clearboth"></div>
					<hr />
					 <fieldset>
						<legend>添加新模块</legend>
						<p>
							<label>模块名称：</label>
							<input class="lf" name="title" id="title" type="text" value="" /> 
							<span class="field_desc">模块名称，为模块取一个名称</span>
						</p>

						<p>
							<label>标识（tag）：</label>
							<input class="lf" name="tag" id="tag" type="text" value="" /> 
							<span class="field_desc">为模块取一个标识名称</span>
						</p>

						<p>
							<label>使用模板：</label>
							<select name="t_id" id="t_id" class="dropdown">
								<option value="0" selected="selected">请选择该模块绑定的模板</option>
								<?php
									foreach($body['template'] as $key => $value) {
								?>
								<option value="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></option>
								<?php
									}
								?>
							</select>
							<span class="field_desc">选择模块在显示时所需的模板</span>
						</p>

						<div id="preview" style="margin-left:690px; margin-top:-60px; position:absolute;"></div>

						<p style="float:left;">
							<label style="float:left;">模块说明代码：</label>
							<textarea name="description" id="description" cols="60" rows="8"></textarea>
						</p>

						<div class="clearboth"></div>
						<p><input class="button" id="submit" name="submit" type="submit" value="提交" /></p>
					</fieldset>
					<hr />
					<div class="clearboth"></div>
					</form>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
