<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('p').mouseover(function(){
			jQuery(this).children('span').css('color', '#000000');
		});
		jQuery('p').mouseout(function(){
			jQuery(this).children('span').css('color', '#BBBBBB');
		});
	});
</script>
			<div id="primary_right">
				<div class="inner">
					<ul class="dash2">
						<li class="fade_hover tooltip" title="点击返回附加属性列表">
							<a href="/addpropertyList">
								<span>附加属性</span>
							</a>
						</li>
					</ul> <!-- end dashboard items -->
					<form action="/addpropertyEdit" method="POST">
                    <div class="clearboth"></div>
					<hr />
					 <fieldset>
						<legend>修改附加属性</legend>
						<p>
							<label>附加属性名称：</label>
							<input class="lf" name="title" id="title" type="text" value="<?php echo $body['list']['title']; ?>" /> 
							<span class="field_desc"></span>
						</p>
						<p>
							<label>标识符：</label>
							<input class="lf" name="tag" id="tag" type="text" value="<?php echo $body['list']['tag']; ?>" /> 
							<span class="field_desc"></span>
						</p>

						<div class="clearboth"></div>
						<input type="hidden" name="id" value="<?php echo $body['list']['id']; ?>" />
						<p><input class="button" type="submit" name="submit" value="提交" /></p>
					</fieldset>
					<hr />
					<div class="clearboth"></div>
					</form>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
