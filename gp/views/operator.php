<div class="container">
	<div style="height:30px;">&nbsp;</div>
	<div class="top_page" id="top_page">
		<div class="tab_add_ons">附加操作</div>
		<div id="top_opera_piece" class="top_opera_piece">
			<div id="bat_opera" style="margin:0 auto; width:910px; height:30px;line-height:30px;">
				<div style="width:380px; float:left;">
					<input type="button" value="删除" class="x_btn" id="bat_del">
				</div>
				<div style="width:510px; float:right;text-align:right;">:w</div>
			</div>
		</div>
	</div>
	<div>
		<table class="operator_tab">
			<tr class="operator_tab_tr_th">
				<th>编号</th>
				<th>姓名</th>
				<th>所属部门</th>
				<th>操作</th>
			</tr>
		<?php
			foreach($body['list'] as $key => $value) {
		?>
			<tr>
				<td align="center"><?php echo $value['p_id']; ?></td>
				<td align="center"><?php echo $value['name']; ?></td>
				<td align="center"><?php echo $value['department']; ?></td>
				<td align="center">[编辑]&nbsp;[删除]</td>
			</tr>
		<?php
			}
		?>
		</table>
	</div>
</div>

