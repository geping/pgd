<link href="/js/uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/js/uploadify/jquery.uploadify.js"></script>
<script type="text/javascript" src="/js/jquery.filestyle.mini.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('p').mouseover(function(){
			jQuery(this).children('span').css('color', '#000000');
		});
		jQuery('p').mouseout(function(){
			jQuery(this).children('span').css('color', '#BBBBBB');
		});
		/*
		jQuery('#pic').uploadify({
			'id': 'pic',
			'uploader' : '/templateAddUpload?up=pic',
			'swf' : '/js/uploadify/uploadify.swf',
			'cancelImage' : '/js/uploadify/uploadify-cancel.png',
			'checkExisting'   : '/js/uploadify/uploadify-check-exists.php',
			'auto' :false,
			'height':30,
			'width': 100,
			'multi'           : false,
			'queueSizeLimit': 1,
			'buttonText': '打开文件',
			'fileTypeDesc': 'image',
			'fileTypeExts': '*.jpg;*.png;*.gif;',
			'fileSizeLimit': 0,
			'simUploadLimit': 1,
			'removeCompleted': false,
			'onUploadSuccess': function (file,data,response) {
			
			}
		});
		*/
		jQuery("input[type=file]").filestyle({ 
			content: "打开",
			conpadleft: 20,
			imageheight : 22,
		    imagewidth : 82,
			width : 170
		});
	});
</script>
<style type="text/css">
	fieldset p {
		height: 35px;
		line-height: 35px;
	}
</style>
			<div id="primary_right">
				<div class="inner">
					<ul class="dash2">
						<li class="fade_hover tooltip" title="点击返回模板管理">
							<a href="/templateList">
								<span>模板管理</span>
							</a>
						</li>
					</ul> <!-- end dashboard items -->
					<form method="POST" action="/templateAdd" enctype="multipart/form-data">
                    <div class="clearboth"></div>
					<hr />
					 <fieldset>
						<legend>添加新模板</legend>
						<p>
							<label>模板名称：</label>
							<input class="lf" name="title" id="title" type="text" value="" /> 
							<span class="field_desc">模板名称，为模板取一个名称</span>
						</p>

						<p>
							<label style="float:left;">上传缩略图：</label>
							<input class="sf" name="pic" id="pic" type="file" value="" /> 
							<span class="field_desc" style="margin-left:20px;">上传一个缩略图</span>
						</p>

						<p style="float:left;">
							<label style="float:left;">模板伪代码：</label>
							<textarea name="code" id="code" cols="100" rows="10"></textarea>
						</p>

						<div class="clearboth"></div>
						<p style="margin-top:210px;"><input class="button" id="submit" name="submit" type="submit" value="提交" /></p>
					</fieldset>
					<hr />
					<div class="clearboth"></div>
					</form>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
