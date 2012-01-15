			<div id="primary_right">
				<div class="inner">
					<ul class="dash2">
						<li class="fade_hover tooltip" title="添加附加属性">
							<a href="/addpropertyAdd">
								<span>添加附加属性</span>
							</a>
						</li>
					</ul> <!-- end dashboard items -->
                    <div class="clearboth"></div>
					<div class="messagebox"></div>
					<hr />
					<ul class="dash2">
						<li class="fade_hover tooltip add_action_bar" url="/addpropertyBatDel" title="删除选中项">
							<a href="javascript:;">
								<span>批量删除</span>
							</a>
						</li>
					</ul> <!-- end dashboard items -->
                    <div class="clearboth"></div>
					<hr />
					
					<div class="gpages"><?php echo $body['pages']; ?></div>
                    <div class="clearboth"></div>
					<hr />
					<table class="normal tablesorter fullwidth">
						<thead>
							<tr>
								<th class="selall" title="全选">全选/反选</th>
								<th>属性名称</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($body['list'] as $key => $value) {
									$tr_class = '';
									if ($key % 2 == 0) {
										$tr_class = ' class="odd"';
									}
							?>
							<tr<?php echo $tr_class?>>
								<td><input type="checkbox" class="iphone selme" id="sel<?php echo $value['id']; ?>" /></td>
								<td><?php echo $value['title']; ?></td>
								<td>
									<a href="/addpropertyEdit?id=<?php echo $value['id']; ?>" title="编辑<?php echo $value['title']; ?>" class="tooltip table_icon"><img src="/images/icons/actions_small/pencil.png" alt="" /></a> 
									<a href="/addpropertyDel?id=<?php echo $value['id']; ?>" title="删除<?php echo $value['title']; ?>" class="tooltip table_icon"><img src="/images/icons/actions_small/trash.png" alt="" /></a>
								</td>
							</tr>
							<?php
								}
							?>
						</tbody>
					</table>
					<hr />
					<div class="clearboth"></div>
					<div class="gpages"><?php echo $body['pages']; ?></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery(".tablesorter").tablesorter({
			headers: {
				0: {sorter: false}
			}
		});
		jQuery('.add_action_bar').click(function(){
			var url = jQuery(this).attr('url');
			var ids = '';
			jQuery('.selme').each(function(i){
				if (jQuery(this).attr('checked') == true) {
					ids += jQuery(this).attr('id').substr(3) + ',';
				}
			});
			if (ids != '') {
				window.location.href = url + '?ids=' + ids;
			} else {
				_gp_fade('.messagebox', 'error', '未选择任何附加属性', 2000);
			}
		});
	});
</script>
