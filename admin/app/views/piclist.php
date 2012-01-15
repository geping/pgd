<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery(".tablesorter").tablesorter({
			headers: {
				0: {sorter: false},
				2: {sorter: false},
				3: {sorter: false}
			}
		});
	});
</script>
			<div id="primary_right">
				<div class="inner">
					<ul class="dash2">
						<li class="fade_hover tooltip" title="删除选中项">
							<a href="/sectionList">
								<span>批量删除</span>
							</a>
						</li>
					</ul> <!-- end dashboard items -->
                    <div class="clearboth"></div>
					<hr />
					
					<table class="normal tablesorter fullwidth">
						<thead>
							<tr>
								<th class="selall" title="全选">全选/反选</th>
								<th>名称</th>
								<th>预览图</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<tr class="odd">
								<td><input type="checkbox" class="iphone selme" /></td>
								<td>名称1</td>
								<td><img alt="" src="/images/avatar.png"></td>
								<td>
									<a href="#" title="编辑该模块" class="tooltip table_icon"><img src="/images/icons/actions_small/pencil.png" alt="" /></a> 
									<a href="#" title="删除该模块" class="tooltip table_icon"><img src="/images/icons/actions_small/trash.png" alt="" /></a>
								</td>
							</tr>
							<tr>
								<td><input type="checkbox" class="iphone selme" /></td>
								<td>名称2</td>
								<td><img alt="" src="/images/avatar.png"></td>
								<td>
									<a href="#" title="编辑该模块" class="tooltip table_icon"><img src="/images/icons/actions_small/pencil.png" alt="" /></a> 
									<a href="#" title="删除该模块" class="tooltip table_icon"><img src="/images/icons/actions_small/trash.png" alt="" /></a>
								</td>
							</tr>
							<tr class="odd">
								<td><input type="checkbox" class="iphone selme" /></td>
								<td>名称3</td>
								<td><img alt="" src="/images/avatar.png"></td>
								<td>
									<a href="#" title="编辑该模块" class="tooltip table_icon"><img src="/images/icons/actions_small/pencil.png" alt="" /></a> 
									<a href="#" title="删除该模块" class="tooltip table_icon"><img src="/images/icons/actions_small/trash.png" alt="" /></a>
								</td>
							</tr>
							<tr>
								<td><input type="checkbox" class="iphone selme" /></td>
								<td>名称4</td>
								<td><img alt="" src="/images/avatar.png"></td>
								<td>
									<a href="#" title="编辑该模块" class="tooltip table_icon"><img src="/images/icons/actions_small/pencil.png" alt="" /></a> 
									<a href="#" title="删除该模块" class="tooltip table_icon"><img src="/images/icons/actions_small/trash.png" alt="" /></a>
								</td>
							</tr>
							<tr class="odd">
								<td><input type="checkbox" class="iphone selme" /></td>
								<td>名称5</td>
								<td><img alt="" src="/images/avatar.png"></td>
								<td>
									<a href="#" title="编辑该模块" class="tooltip table_icon"><img src="/images/icons/actions_small/pencil.png" alt="" /></a> 
									<a href="#" title="删除该模块" class="tooltip table_icon"><img src="/images/icons/actions_small/trash.png" alt="" /></a>
								</td>
							</tr>

						</tbody>
					</table>
					<hr />
					<div class="clearboth"></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
