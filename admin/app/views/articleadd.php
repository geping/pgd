<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('p').mouseover(function(){
			jQuery(this).children('span').css('color', '#000000');
		});
		jQuery('p').mouseout(function(){
			jQuery(this).children('span').css('color', '#BBBBBB');
		});
		jQuery('#type1').click(function(){
			jQuery('.type2').hide();
			jQuery('.type1').show();
		});
		jQuery('#type2').click(function(){
			jQuery('.type1').hide();
			jQuery('.type2').show();
		});
		jQuery('.module').change(function(){
			jQuery('#dialog').children('h2').html('请选择附加属性');
			jQuery('#dialog').children('p').html('请选择附加属性');
			jQuery('#dialog').dialog({'title': 'x'});
			jQuery('#dialog').dialog('open');
		});
	});
</script>
			<div id="primary_right">
				<div class="inner">
					<ul class="dash2">
						<li class="fade_hover tooltip" title="点击返回文章管理">
							<a href="/articleList">
								<span>文章管理</span>
							</a>
						</li>
					</ul> <!-- end dashboard items -->
                    <div class="clearboth"></div>
					<hr />
					 <fieldset>
						<legend>添加文章</legend>
						<p>
							<label>文章标题：</label>
							<input class="lf" name="title" id="title" type="text" value="" /> 
							<span class="field_desc">文章名称</span>
						</p>

						<p>
							<label>文章别称：</label>
							<input class="lf" name="alias" id="alias" type="text" value="" /> 
							<span class="field_desc">文章的另一个标题</span>
						</p>

						<p>
							<label>所属栏目：</label>
							<select name="templete" class="dropdown">
								<option>栏目1</option>
								<option>栏目2</option>
								<option>栏目3</option>
								<option>栏目4</option>
							</select>
							<span class="field_desc">选择该文章所属的模块</span>
						</p>

						<p>
							<label>所属模块：</label>
							<select name="templete" class="dropdown module">
								<option>模块1</option>
								<option>模块2</option>
								<option>模块3</option>
								<option>模块4</option>
							</select>
							<span class="field_desc">选择该文章所属的模块</span>
						</p>

						<p>
							<label>发表日期：</label>
							<input class="datepicker" name="pubdate" id="pubdate" type="text" value="" /> 
							<span class="field_desc">文章的另一个标题</span>
						</p>

						<p>
							<label>作者：</label>
							<input class="lf" name="author" id="author" type="text" value="" /> 
							<span class="field_desc">文章作者</span>
						</p>

						<p>
							<label>权重：</label>
							<input class="sf" name="weight" id="weight" type="text" value="" /> 
							<span class="field_desc">与文章排序有关</span>
						</p>

						<div class="clearboth"></div>
						<p><input class="button" type="submit" value="提交" /></p>
					</fieldset>
					<hr />
					<div class="clearboth"></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
