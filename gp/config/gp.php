<?
//配置文件
$config['os'] = array(
				'os_name' => 'xxx管理系统',
				);
$config['tab_name'] = array(
					'user' => 'account',//用户表
					'domain' => 'domain_info2',//派工单表
					'opera' => 'operation',//操作人员表
				);

$config['account'] = array(
					'username' => 'admin', // 用户名
					'password' => 'd41d8cd98f005343b20321f1', // 密码
				);

//版图信息表数据列配置
$config['domain_info_col'] = array(
					array('field' => 'id', 'comment' => 'ID', 'show' => 1),
					array('field' => 'ship_type', 'comment' => '船型', 'show' => 1,),
					array('field' => 'ship_id', 'comment' => '船号', 'show' => 1,),
					array('field' => 'section', 'comment' => '分段号', 'show' => 1,),
					array('field' => 'part_type', 'comment' => '分道类型', 'show' => 1,),
					array('field' => 'state', 'comment' => '钢板情况', 'show' => 0,),
					array('field' => 'domain_id', 'comment' => '版图号', 'show' => 1,),
					array('field' => 'complete_date', 'comment' => '完工日期', 'show' => 1,),
					array('field' => 'device', 'comment' => '设备编号', 'show' => 1,),
					array('field' => 'operation', 'comment' => '操作人员', 'show' => 1,),
					array('field' => 'detail_scale', 'comment' => '零件重量', 'show' => 0,),
					array('field' => 'cut_length', 'comment' => '切割长度', 'show' => 1,),
					array('field' => 'theory_tasktime', 'comment' => '理论工时(M)', 'show' => 0,),
					array('field' => 'reality_tasktime', 'comment' => '实际工时(H)', 'show' => 1,),
					array('field' => 'material_quality', 'comment' => '材质', 'show' => 1,),
					array('field' => 'steel_plate_land', 'comment' => '板厚', 'show' => 1,),
					array('field' => 'steel_plate_width', 'comment' => '板宽', 'show' => 1,),
					array('field' => 'steel_plate_length', 'comment' => '板长', 'show' => 1,),
					array('field' => 'cut_type', 'comment' => '切割类型', 'show' => 0,),
					array('field' => 'steel_plate_id', 'comment' => '钢板号', 'show' => 0,),
					array('field' => 'cut_space', 'comment' => '切割跨间', 'show' => 1,),
					array('field' => 'detail_count', 'comment' => '零件数', 'show' => 0,),
					array('field' => 'space_length', 'comment' => '空行长度', 'show' => 0,),
					array('field' => 'space_time', 'comment' => '空行时间', 'show' => 0,),
					array('field' => 'lineation_length', 'comment' => '划线长度', 'show' => 0,),
					array('field' => 'lineation_time', 'comment' => '划线时间', 'show' => 0,),
					array('field' => 'point_cut_count', 'comment' => '引割点数', 'show' => 0,),
					array('field' => 'point_cut_time', 'comment' => '引割时间', 'show' => 0,),
					array('field' => 'cut_time', 'comment' => '切割时间', 'show' => 0,),
					array('field' => 'cut_groove', 'comment' => '自切坡口', 'show' => 0,),
					array('field' => 'half_groove', 'comment' => '半切坡口', 'show' => 0,),
					array('field' => 'bridge_count', 'comment' => '过桥点数', 'show' => 0,),
					array('field' => 'time_tally', 'comment' => '时间小计', 'show' => 0,),
				);
