<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery(".tablesorter").tablesorter({
			headers: {
				0: {sorter: false},
				1: {sorter: false},
				2: {sorter: false},
				3: {sorter: false},
				4: {sorter: false},
				5: {sorter: false}
			}
		});
        /*标题前的加减号点击*/
        var flag = 0;
        jQuery('.plus').click(function(){
            flag = parseInt(jQuery(this).attr('flag'));
            if (flag == 1) {
                jQuery(this).attr('flag', 0);
                jQuery(this).children('img').attr('src', '/images/dedecontract.gif');
                _controllerTr(jQuery(this).parent().parent(), 1);
            } else {
                jQuery(this).attr('flag', 1);
                jQuery(this).children('img').attr('src', '/images/dedeexplode.gif');
                _controllerTr(jQuery(this).parent().parent(), 0);
            }
        });
	});
function _controllerTr(obj, sh) {
	var id = obj.attr('sec_id').substr(2);
	var parent_id = obj.attr('parent_id').substr(3);
	if (sh == 1) {
		jQuery('tr[parent_id="pid'+id+'"]').show();
	} else {
		jQuery('tr[parent_id="pid'+id+'"]').each(function(){
			if (jQuery(this).children('td').children('a').attr('flag') == 0) {
				jQuery(this).children('td').children('a').attr('flag', 1);
				jQuery(this).children('td').children('a').children('img').attr('src', '/images/dedeexplode.gif');
				_controllerTr(jQuery(this), 0);
			}
		});
		jQuery('tr[parent_id="pid'+id+'"]').hide();
	}
}
</script>
			<div id="primary_right">
				<div class="inner">
					<ul class="dash2">
						<li class="fade_hover tooltip" title="修改排序">
							<a href="/sectionList">
								<span>排序</span>
							</a>
						</li>
						<li class="fade_hover tooltip" title="删除选中项">
							<a href="/sectionList">
								<span>批量删除</span>
							</a>
						</li>
						<li class="fade_hover tooltip" title="显示选中项">
							<a href="/sectionList">
								<span>批量显示</span>
							</a>
						</li>
						<li class="fade_hover tooltip" title="隐藏选中项">
							<a href="/sectionList">
								<span>批量隐藏</span>
							</a>
						</li>
						<li class="fade_hover tooltip" title="添加新的栏目">
							<a href="/sectionAdd">
								<span>添加新栏目</span>
							</a>
						</li>
					</ul> <!-- end dashboard items -->
                    <div class="clearboth"></div>
					<hr />
					
					<table class="normal tablesorter fullwidth">
						<thead>
							<tr>
								<th class="selall" title="全选">全选/反选</th>
								<th>栏目名称</th>
								<th>文件保存路径</th>
								<th>是否显示</th>
								<th>排序</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
						<?php echo $body['table']; ?>
						</tbody>
					</table>
					<hr />
					<div class="clearboth"></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
