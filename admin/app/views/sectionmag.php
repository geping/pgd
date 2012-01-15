<script type="text/javascript">
var __initval = '';
jQuery(document).ready(function(){
	_getModule();
	setTimeout('_column()', 500);
	jQuery('#section').change(function(){
		if (jQuery(this).val() == 0) {
			return false;
		}
		var secid = jQuery(this).val();
		_getModule();
		jQuery('#sectioninfo').html('');
		/*获取栏目信息*/
		__initval = '';
		jQuery('#sectionname').html(jQuery('#section option:selected').text());
		_getSectionInfo(secid);
		setTimeout('_column()', 500);
	});
});
/*获取模块*/
function _getModule() {
	jQuery.ajax({
		type:	"GET",
		url:	"/sectionMag?method=gm",
		success:function(data) {
			if (data == 0) {
				_gp_fade('.messagebox', 'error', '没有任何模块可用，请先添加模块', 2000);
			} else {
				var jsdata = eval("("+data+")");
				var block = '';
				for (var i = 0; i < jsdata.length; i++) {
					block += '<div class="one_fifth2 column"><div class="portlet"><div class="portlet-header2">';
					block += jsdata[i]['title'];
					block += '<span style="display:none;" class="mid">'+jsdata[i]['id']+'</span>';
					block += '</div><div class="portlet-content" style="display: none;"><p>';
					block += jsdata[i]['description'];
					block += '</div></div></div>';
				}
				jQuery('#portletb').html(block);
			}
		}
	});
}
/*模块智能化*/
function _column() {
	/*模块智能化开始*/
	jQuery(".column").sortable({
		connectWith: '.column',
		placeholder: 'ui-sortable-placeholder',
		forcePlaceholderSize: true,
		scroll: false,
		helper: 'clone',
		stop: function(event, ui) {
			/*拖动完毕，保存状态*/
			_save();
		}
	});

	jQuery(".portlet").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all").find(".portlet-header2").addClass("ui-widget-header ui-corner-all").prepend('<span class="ui-icon ui-icon-circle-arrow-s"></span>').end().find(".portlet-content");

	jQuery(".portlet-header2 .ui-icon").click(function() {
		jQuery(this).toggleClass("ui-icon-minusthick");
		jQuery(this).parents(".portlet:first").find(".portlet-content").toggle();
	});

	jQuery(".column").disableSelection();
	/*模块智能化结束*/
}
/*保存状态*/
function _save() {
	if (jQuery('#sectioninfo').children().length >= 0) {
		var mids = chinit = '';
		jQuery('#sectioninfo').find('.mid').each(function(){
			chinit += jQuery(this).html();
			mids += jQuery(this).html() + '-' + jQuery('.mid').index(this);
			mids += ',';
		});
		if (__initval == chinit) {
			return false;
		}
		var stid = jQuery('#section').val();
		if (stid == 0) {
			_gp_fade('.messagebox', 'error', '请先选择一个页面，再为该页面进行编辑', 2000);
		}
		/*if (mids != '') {****此处屏蔽，允许一个页面没有模块的可能*/
			jQuery.ajax({
				type:	"GET",
				url:	"/sectionMag?method=s&stid="+stid+"&mids="+mids,
				success:function(data) {
					if (data == 0) {
						_gp_fade('.messagebox', 'error', '保存数据失败，请检查', 2000);
					} else {
						_gp_fade('.messagebox', 'success', '页面已经保存 ', 1000);
					}
				}
			});
		/*}*/
	}
	return false;
}
/*获取指定的栏目*/
function _getSectionInfo(id) {
	jQuery.ajax({
		type:	"GET",
		url:	"/sectionMag?method=gsi&id="+id,
		success:function(data) {
			if (data == 0) {
			} else {
				var jsdata = eval("("+data+")");
				var block = '';
				for (var i = 0; i < jsdata.length; i++) {
					block += '<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"><div class="portlet-header2 ui-widget-header ui-corner-all">';
					block += jsdata[i]['title'];
					block += '<span style="display:none;" class="mid">'+jsdata[i]['m_id']+'</span>';
					block += '</div><div class="portlet-content" style="display: none;"><p>';
					block += jsdata[i]['description'];
					block += '</div></div>';
					__initval += jsdata[i]['m_id'];
					/*此处开始排除可用模块处的模块*/
					/*_exclude(jsdata[i]['m_id']);*/
				}
				jQuery('#sectioninfo').html(block);
			}
		}
	});
}
/*排除相同的模块*/
function _exclude(m_id) {
	jQuery('#portletb').find('.mid').each(function(){
		if (jQuery(this).html() == m_id) {
			jQuery(this).parent().parent().parent().remove();
			return true;
		}
	});
	return true;
}
</script>
			<div id="primary_right">
				<div class="inner">
						<p>
							<label style="width:60px;">选择页面：</label>
							<select name="dropdown" id="section" class="dropdown">
								<option value="0">选择一个栏目页面</option>
								<?php
									foreach ($body['section'] as $key => $value) {
								?>
								<option value="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></option>
								<?php
									}
								?>
							</select>
						</p>
                        <div class="clearboth"></div>
					<hr />
					<div class="messagebox"></div>
                    <div style="width:100%;">
                        <div style="width: 70%; float: left;">
                            <div class="two_third2">
                                <div class="portlet">
                                    <div class="portlet-header">可用模块</div>
                                    <div id="portletb" class="portlet-content" style="display: block;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="width: 30%; float: right;">
                            <div class="two_third2">
                                <div class="portlet">
                                    <div class="portlet-header" id="sectionname">栏目名称</div>
                                    <div class="portlet-content" style="display: block;">
                                        <div class="column" id="sectioninfo"></div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
					<hr />
					<div class="clearboth"></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
