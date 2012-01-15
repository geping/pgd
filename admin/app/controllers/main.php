<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	private $data = array();
	
	function __construct() {
		parent::__construct();
		$this->load->library('func');
		$this->load->config('admin.config');
		$this->load->model('mmain');

		$this->data['head'] = array();
		$this->data['body'] = array();
		$this->data['foot'] = array();
		$this->data['success'] = '';
		$this->data['error'] = '';
	}

	//----------------------------------------------------------------
	// 具体页面实现和AJAX --- start
	//----------------------------------------------------------------
	/**
	 * 首页
	 */
	public function index() {
		$this->_show();
	}

	/**
	 * 登录页
	 */
	public function login() {
		$submit = $this->input->post('submit');
		if ($submit) {
			$username = $this->func->formatString($this->input->post('username'));
			$password = $this->func->passwordHandle($this->input->post('password'));
			$where = array(
				'username' => $username,
				'password' => $password,
			);
			$res = $this->mmain->loginSelect($where);
			if ($res == FALSE) {
				$this->data['error'] = '用户名或密码错误';
			} else {
				$ses_arr = array(
					'__Admin__' => TRUE,
					'Management' => $res,
				);
				$this->_setSession($ses_arr);
				header("Location:/index");
			}
		}
		$this->load->view('login', $this->data);
	}

	/**
	 * 常用网站设置
	 */
	public function setWeb() {
		//获取数据
		$this->data['body']['list'] = $this->mmain->setWebSelect();
		$this->_show('setweb');
	}

	/**
	 * 常用网站设置AJAX
	 */
	public function ajaxSetweb() {
		$field = $this->func->formatString($this->input->get('field'));
		$value = mysql_real_escape_string($this->input->get('value'));
		$update = array('webvalue' => $value);
		$where = array('webkey' => $field);
		$ups = $this->mmain->setWebUpdate($update, $where);
		if ($ups) {
			echo 1;
		} else {
			echo 0;
		}
		exit;
	}

	/**
	 * 附件设置
	 */
	public function setAtta() {
		//获取数据
		$this->data['body']['list'] = $this->mmain->setAttaSelect();
		$this->_show('setatta');
	}

	/**
	 * 附件设置AJAX
	 */
	public function ajaxSetAtta() {
		$field = $this->func->formatString($this->input->get('field'));
		$value = mysql_real_escape_string($this->input->get('value'));
		$update = array('attavalue' => $value);
		$where = array('attakey' => $field);
		$ups = $this->mmain->setAttaUpdate($update, $where);
		if ($ups) {
			echo 1;
		} else {
			echo 0;
		}
		exit;
	}

	/**
	 * 附加属性 -- 列表
	 */
	public function addpropertyList() {
		$page = $this->func->intGetHandle($this, 'page', 1);
		$pagesize = 20;
		$total = $this->mmain->addpropertyCount();
		$this->data['body']['list'] = $this->mmain->addpropertySelect($page, $pagesize);
		$this->data['body']['pages'] = $this->func->gpageStr($page, $pagesize, $total);
		$this->_show('addpropertylist');
	}

	/**
	 * 附加属性 -- 添加
	 */
	public function addpropertyAdd() {
		$submit = $this->input->post('submit');
		if ($submit) {
			$title = $this->func->formatCnString($this->input->post('title'));
			$tag = $this->func->formatCnString($this->input->post('tag'));
			$insert = array('title' => $title, 'tag' => $tag);
			$ins = $this->mmain->addpropertyInsert($insert);
			if ($ins) {
				$message = '添加附加属性成功';
				$url = '/addpropertyList';
				$gtime = 3;
			} else {
				$message = '添加附加属性失败，请检查';
				$url = '/addpropertyAdd';
				$gtime = 10;
			}
			$this->_transit('提示信息', $message, $url, $gtime);
		}
		$this->_show('addpropertyadd');
	}

	/**
	 * 附加属性 -- 编辑
	 */
	public function addpropertyEdit() {
		$id = $this->func->intGetHandle($this, 'id');
		$submit = $this->input->post('submit');
		if ($submit) {
			$update = array(
				'title' => $this->input->post('title'),
				'tag' => $this->input->post('tag'),
			);
			$ups = $this->mmain->addpropertyUpdateById($update, $id);
			if ($ups) {
				$message = '修改附加属性成功';
				$url = '/addpropertyList';
				$gtime = 5;
			} else {
				$message = '修改附加属性失败，请检查';
				$url = '/addpropertyEdit';
				$gtime = 20;
			}
			$this->_transit('提示信息', $message, $url, $gtime);
		}
		$list = $this->mmain->addpropertySelectById($id);
		$this->data['body']['list'] = $list[0];
		$this->_show('addpropertyedit');
	}

	/**
	 * 附加属性 -- 删除属性
	 */
	public function addpropertyDel() {
		$id = $this->func->intGetHandle($this, 'id');
		$method = $this->input->get('method');
		if ($method === 'del') {
			$des = $this->mmain->addpropertyDelete($id);
			if ($des) {
				$message = '删除附加属性成功';
				$gtime = 3;
			} else {
				$message = '删除附加属性失败，请检查';
				$gtime = 10;
			}
			$this->_transit('提示信息', $message, '/addpropertyList', $gtime);
		}
		$this->_confirm('提示信息', '你确定要删除选该属性吗？', '/addpropertyDel?method=del&id='.$id, '/addpropertyList');
	}

	/**
	 * 附加属性 -- 批量删除属性
	 */
	public function addpropertyBatDel() {
		$ids = $this->input->get('ids');
		$method = $this->input->get('method');
		if ($method === 'del') {
			if ($ids != '') {
				$ids = substr($ids, 0, -1);
				$idar = explode(',', $ids);
			}
			foreach ($idar as $key => &$value) {
				if (intval($value) <= 0) {
					unset($idar[$key]);
				}
			}
			$des = $this->mmain->addpropertyBatDelete('id', $idar);
			if ($des) {
				$message = '已经删除选中的附加属性';
				$gtime = 3;
			} else {
				$message = '删除选中的附加属性失败，请检查';
				$gtime = 10;
			}
			$this->_transit('提示信息', $message, '/addpropertyList', $gtime);
		}
		$this->_confirm('提示信息', '你确定要删除选中的属性吗？', '/addpropertyBatDel?method=del&ids='.$ids, '/addpropertyList');
	}

	/**
	 * 栏目列表
	 */
	public function sectionList() {
		$arr = $this->mmain->sectionSelect();
		$this->load->library('tree');
		$this->tree->initialize($arr);
		$this->data['body']['table'] = $this->_categoryCreateTable($this->tree->getTree());
		$this->_show('sectionlist');
	}

	/*
	 * 类别管理 -- 生成表格
	 */
	private function _categoryCreateTable($tree, $prestr = '', $parent_id = 0) {
		$table = '';
		$i = 0;
		foreach ($tree as $key => $value) {
			$type = '双页面';
			$isshow = '不显示';
			$block = '<img src="/images/dedecontract.gif" style="vertical-align:middle;" />';
			$display = '';
			$tr_class = '';
			if ($value['type'] === 1) {
				$type = '单页面';
			}
			if ($value['isshow'] == 1) {
				$isshow = '显示';
			}
			if (!empty($value['child'])) {
				$block = '<a href="javascript:;" class="plus" flag="1"><img src="/images/dedeexplode.gif" style="vertical-align:middle;" border="0" /></a>';
			}
			if ($i % 2 == 0) {
				$tr_class = ' class="odd"';
			}
			$i++;
			if ($parent_id != $value['parent_id']) {
				$display = 'style="display:none;"';
			}
			$table .= '<tr parent_id="pid'.$value['parent_id'].'" sec_id="id'.$value['id'].'" '.$display.$tr_class.'>';
			$table .= '<td><input type="checkbox" class="selme" /></th>';
			$table .= '<td>'.$prestr.$block.$value['title'].'</td>';
			$table .= '<td>'.$value['uri'].'</td>';
			$table .= '<td>'.$isshow.'</td>';
			$table .= '<td><input type="text" class="tf" value="'.$value['sort'].'" /></td>';
			$table .= '<td><a href="/sectionEdit?id='.$value['id'].'" title="编辑'.$value['title'].'" class="tooltip table_icon"><img src="/images/icons/actions_small/pencil.png" alt="" /></a><a href="/sectionDel?id='.$value['id'].'" title="删除'.$value['title'].'" class="tooltip table_icon"><img src="/images/icons/actions_small/trash.png" alt="" /></a></td>';
			$table .= '</tr>';
			if (!empty($value['child'])) {
				$table .= $this->_categoryCreateTable($value['child'], $prestr.'+--');
			}
		}
		return $table;
	}

	/**
	 * 栏目管理 -- 编辑栏目
	 */
	public function sectionEdit() {
		$id = $this->func->intGetHandle($this, 'id');
		$submit = $this->input->post('submit');
		if ($submit) {
			$type = intval($this->input->post('type'));
			$path = $this->input->post('path');
			$title = $this->func->formatCnString($this->input->post('title'));
			if ($path == '') {
				$path = $id;
			} else {
				$path = $path . $id;
			}
			$data = array(
				'parent_id' => $this->func->intGetHandle($this, 'parent_id', 0),
				'path' => $path,
				'title' => $title,
				'keyword' => $this->func->formatCnString($this->input->post('keyword')),
				'description' => $this->func->formatCnString($this->input->post('description')),
				'uri' => $this->input->post('uri'),
				'type' => $type,
				'sort' => intval($this->input->post('sort')),
				'isshow' => $this->input->post('isshow') ? 1 : 0,
			);
			//修改数据
			$where = array('id' => $id);
			//修改数据
			$ups = $this->mmain->sectionUpdate($data, $where);
			if ($ups) {
				//删除模板表的数据
				$this->mmain->sectionTempDeleteBySid($id);
				
				$tempdata = array(
					's_id' => $id,
					'title' => $title,
				);
				if ($type == 1) {
					//插入单页面数据
					$tempdata['type'] = 0;
					$tempdata['temp_path'] = $this->input->post('templete_path');
					$ins = $this->mmain->sectionTempInsert($tempdata);
					if (!$ins) {
						$this->_transit('提示信息', '修改模板单页面出错（错误号：#1），请检查', '/sectionEdit?id='.$id, 5);
					}
				} else {
					//插入双页面数据
					$tempdata['type'] = 1;
					$tempdata['temp_path'] = $this->input->post('templete_list_path');
					$ins = $this->mmain->sectionTempInsert($tempdata);
					$tempdata['type'] = 2;
					$tempdata['temp_path'] = $this->input->post('templete_detailed_path');
					$ins = $this->mmain->sectionTempInsert($tempdata);
					if (!$ins) {
						$this->_transit('提示信息', '修改栏目模板时出错（错误号：#2），请检查', '/sectionAdd', 5);
					}
				}
				$this->_transit('提示信息', '修改栏目成功', '/sectionList', 3);
			} else {
				$this->_transit('提示信息', '修改数据出错，请检查', '/sectionEdit?id='.$id, 5);
			}

		}
		$arr = $this->mmain->sectionSelectById($id);
		$temp_arr = $this->mmain->sectionTempSelectBySid($id);
		$this->data['body']['data'] = $arr[0];
		$this->data['body']['data']['templete_path'] = $this->data['body']['data']['templete_list_path'] = $this->data['body']['data']['templete_detailed_path'] = '';
		foreach($temp_arr as $key => $value) {
			if ($value['type'] == 0) $this->data['body']['data']['templete_path'] = $value['temp_path'];
			if ($value['type'] == 1) $this->data['body']['data']['templete_list_path'] = $value['temp_path'];
			if ($value['type'] == 2) $this->data['body']['data']['templete_detailed_path'] = $value['temp_path'];
		}
		$this->_show('sectionedit');
	}

	/**
	 * 栏目管理 -- 页面管理
	 */
	public function sectionMag() {
		$method = $this->func->formatString($this->input->get('method'));
		//获取模块
		if ($method === 'gm') {
			$list = $this->mmain->moduleSelect(1, 999);
			if (empty($list)) {
				echo 0;
			} else {
				echo json_encode($list);
			}
			exit;
		}
		//获取单个栏目页面
		if ($method === 'gsi') {
			$id = $this->input->get('id');
			if (intval($id) <= 0) {
				echo 0;exit;
			}
			$list = $this->mmain->bindSectionModuleSelectById($id);
			if (empty($list)) {
				echo 0;
			} else {
				echo json_encode($list);
			}
			exit;
		}
		//保存栏目页面数据
		if ($method === 's') {
			$stid = $this->input->get('stid');
			$mids = $this->input->get('mids');
			if (intval($stid) <= 0) { // || $mids == '') {
				echo 0;exit;
			}
			if ($mids == '') {
				$delwhere = array('st_id' => $stid);
				$des = $this->mmain->bindSectionModuleDelete($delwhere);
				echo 1;exit;
			}
			$mids = substr($mids, 0, -1);
			$midsarr = explode(',', $mids);
			if (!empty($midsarr)) {
				$mcount = 0;
				if (count($midsarr) == 1) $mcount = 1;
				//删除之前的数据
				$delwhere = array('st_id' => $stid);
				$des = $this->mmain->bindSectionModuleDelete($delwhere);
				foreach($midsarr as $key => $value) {
					$mvalarr = explode('-', $value);
					if ($mcount == 0) {
						$mvalarr[1]++;
					}
					$insert = array('st_id' => $stid, 'm_id' => $mvalarr[0], 'sort' => $mvalarr[1]);
					$ins = $this->mmain->bindSectionModuleInsert($insert);
				}
			}
			echo 1;
			exit;
		}
		//获取栏目数据
		$this->data['body']['section'] = $this->mmain->sectionTempSelect();
		$this->_show('sectionmag');
	}

	/**
	 * 栏目管理 -- 添加栏目
	 */
	public function sectionAdd() {
		$submit = $this->input->post('submit');
		if ($submit) {
			$type = intval($this->input->post('type'));
			$path = $this->input->post('path');
			$title = $this->func->formatCnString($this->input->post('title'));
			$data = array(
				'parent_id' => $this->func->intGetHandle($this, 'parent_id', 0),
				'path' => '',
				'title' => $title,
				'keyword' => $this->func->formatCnString($this->input->post('keyword')),
				'description' => $this->func->formatCnString($this->input->post('description')),
				'uri' => $this->input->post('uri'),
				'type' => $type,
				'sort' => intval($this->input->post('sort')),
				'isshow' => $this->input->post('isshow') ? 1 : 0,
			);
			//插入数据
			$ins = $this->mmain->sectionInsert($data);
			if ($ins > 0) {
				//插入path字段
				if ($path == '') {
					$fpath = $ins;
				} else {
					$fpath = $path . $ins;
				}
				$update = array('path' => $fpath);
				$where = array('id' => $ins);
				//修改数据
				$ups = $this->mmain->sectionUpdate($update, $where);
				if ($ups) {
					//进行下一步插入
					$tempdata = array(
						's_id' => $ins,
						'title' => $title,
					);
					if ($type == 1) {
						//插入单页面数据
						$tempdata['type'] = 0;
						$tempdata['temp_path'] = $this->input->post('templete_path');
						$ins = $this->mmain->sectionTempInsert($tempdata);
						if (!$ins) {
							$des = $this->mmain->sectionDelete($where);
							$this->_transit('提示信息', '插入模板单页面出错，请检查', '/sectionAdd', 5);
						}
					} else {
						//插入双页面数据
						$tempdata['type'] = 1;
						$tempdata['temp_path'] = $this->input->post('templete_list_path');
						$ins = $this->mmain->sectionTempInsert($tempdata);
						$tempdata['type'] = 2;
						$tempdata['temp_path'] = $this->input->post('templete_detailed_path');
						$ins = $this->mmain->sectionTempInsert($tempdata);
						if (!$ins) {
							$des = $this->mmain->sectionDelete($where);
							$this->_transit('提示信息', '插入模板双页面出错，请检查', '/sectionAdd', 5);
						}
					}
					$this->_transit('提示信息', '添加栏目成功！', '/sectionList', 3);
				} else {
					//修改数据失败，删除刚才插入的数据
					$des = $this->mmain->sectionDelete($where);
					$this->_transit('提示信息', '获取数据路径错误，请检查', '/sectionAdd', 5);
				}
			} else {
				$this->_transit('提示信息', '插入数据失败，请检查', '/sectionAdd', 5);
			}
		}
		$this->_show('sectionadd');
	}
    
	/*
	 * 栏目管理 -- 添加栏目 -- ajax获取分类
	 */
	public function ajaxSectionCategory() {
		$id = $this->func->intGetHandle($this, 'id', 0);
		$arr = $this->mmain->sectionCategorySelect();
		$this->load->library('tree');
		$this->tree->initialize($arr);
		if (($id != 0) && !($this->tree->hasChild($id))) {
			echo '';
			exit;
		}
		echo $this->_categoryCreateSelect($arr, $id);
		exit;
	}
    
	/*
	 * 栏目管理 -- 添加栏目 -- 生成联动
	 */
	private function _categoryCreateSelect($arr, $id, $option = 0) {
		$select = '';
		$select .= '<select class="style1" onChange="_selectChange(this)">';
		$select .= '<option value="">请选择栏目</option>';
		foreach ($arr as $key => $value) {
			if ($value['parent_id'] == $id) {
				$checked = '';
				if ($option != 0 && $option == $value['id']) {
					$checked = 'selected="selected"';
				}
				$select .= '<option value="'.$value['id'].'" '.$checked.'>'.$value['title'].'</option>';
			}
		}
		$select .= '</select>';
		return $select;
	}
    
	/*
	 * 类别管理 -- ajax获取联动的分类
	 */
	public function ajaxRelevanceCategory() {
		$id = $this->func->intGetHandle($this, 'id', 0);
		$arr = $this->mmain->sectionCategorySelect();
		$this->load->library('tree');
		$this->tree->initialize($arr);
		if ($id == 0) {
			echo '';exit;
		}
		$srckey = $this->tree->map[$id];
		$path = explode(',', $arr[$srckey]['path']);
		$option = $path;
		array_pop($option);
		//压入数组头部元素
		array_unshift($path, 0);
		//取出最后一个元素
		array_pop($path);
		$select = '';
		foreach ($path as $key => $value) {
			if (!isset($option[$key])) $option[$key] = -1;
			$select .= $this->_categoryCreateSelect($arr, $value, $option[$key]);
		}
		echo $select;exit;
	}

	/**
	 * 栏目管理 -- 删除栏目
	 */
	public function sectionDel() {
		$id = $this->func->intGetHandle($this, 'id');
		$method = $this->func->formatString($this->input->get('method'));
		if ($method === 'del') {
			$where = array('id' => $id);
			//删除栏目的数据
			$des = $this->mmain->sectionDelete($where);
			//删除模板表的数据
			$this->mmain->sectionTempDeleteBySid($id);
			$this->_transit('提示信息', '已经删除ID为'.$id.'的栏目', '/sectionList', 3);
		}
		$arr = $this->mmain->sectionCategorySelect();
		$this->load->library('tree');
		$this->tree->initialize($arr);
		if ($this->tree->hasChild($id)) {
			$this->_alert('提示信息', '该分类下有子栏目，请先删除子栏目', '/sectionList', 5);
		}
		$this->_confirm('提示信息', '你确定要删除该栏目吗？', '/sectionDel?method=del&id='.$id, '/sectionList');
	}

	/**
	 * 模块管理 -- 列表
	 */
	public function moduleList() {
		//获取数据
		$pagesize = 10;
		$page = $this->func->intGetHandle($this, 'page', 1);
		$total = $this->mmain->moduleCount();
		$list = $this->mmain->moduleSelect($page, $pagesize);
		//
		if (!empty($list)) {
			foreach($list as $key => &$value) {
				$tempone = $this->mmain->templateSelectById($value['t_id']);
				$value['template'] = $tempone[0]['title'];
			}
		}
		$this->data['body']['list'] = $list;
		$this->data['body']['pages'] = $this->func->gpageStr($page, $pagesize, $total);
		$this->_show('modulelist');
	}

	/**
	 * 模块管理 -- 添加
	 */
	public function moduleAdd() {
		$submit = $this->input->post('submit');
		if ($submit) {
			$t_id = intval($this->input->post('t_id'));
			if ($t_id <= 0) {
				$this->_alert('提示信息', '请必须选择该模块指定的模板', '/moduleAdd', 5);
			}
			
			$title = $this->func->formatCnString($this->input->post('title'));
			$insert = array(
				'title' => $title,
				'tag' => $this->func->formatCnString($this->input->post('tag')),
				't_id' => $t_id,
				'description' => $this->func->formatCnString($this->input->post('description')),
			);
			$ins = $this->mmain->moduleInsert($insert);
			if ($ins) {
				$this->_transit('提示信息', '成功插入模块<b>'.$title.'</b>', '/moduleList', 3);
			} else {
				$this->_alert('提示信息', '添加模块数据失败，请检查后再添加', '/moduleList', 5);
			}
		}
		//读取模板数据
		$this->data['body']['template'] = $this->mmain->templateSelect(1, 999);
		$this->_show('moduleadd');
	}

	/**
	 * 模块管理 -- 编辑
	 */
	public function moduleEdit() {
		$id = $this->func->intGetHandle($this, 'id');
		$submit = $this->input->post('submit');
		if ($submit) {
			$t_id = intval($this->input->post('t_id'));
			if ($t_id <= 0) {
				$this->_alert('提示信息', '请必须选择该模块指定的模板', '/moduleEdit', 5);
			}
			
			$title = $this->func->formatCnString($this->input->post('title'));
			$update = array(
				'title' => $title,
				'tag' => $this->func->formatCnString($this->input->post('tag')),
				't_id' => $t_id,
				'description' => $this->func->formatCnString($this->input->post('description')),
			);
			$where = array('id' => $id);
			$ups = $this->mmain->moduleUpdate($update, $where);
			if ($ups) {
				$this->_transit('提示信息', '成功修改模块<b>'.$title.'</b>', '/moduleList', 3);
			} else {
				$this->_alert('提示信息', '修改模块<b>'.$title.'</b>失败，请检查后再修改', '/moduleList', 5);
			}
		}
		//获取数据
		$list = $this->mmain->moduleSelectById($id);
		$this->data['body']['list'] = $list[0];
		//读取模板数据
		$this->data['body']['template'] = $this->mmain->templateSelect(1, 999);
		$this->_show('moduleedit');
	}

	/**
	 * 模块管理 -- 删除
	 */
	public function moduleDel() {
		$id = $this->func->intGetHandle($this, 'id');
		$method = $this->func->formatString($this->input->get('method'));
		if ($method === 'del') {
			$where = array('id' => $id);
			//删除模板的数据
			$des = $this->mmain->moduleDelete($where);
			$this->_transit('提示信息', '已经删除ID为'.$id.'的模板', '/moduleList', 3);
		}
		$this->_confirm('提示信息', '你确定要删除该模块吗？', '/moduleDel?method=del&id='.$id, '/moduleList');
	}

	/**
	 * 模板管理 -- 列表
	 */
	public function templateList() {
		//获取数据
		$pagesize = 10;
		$page = $this->func->intGetHandle($this, 'page', 1);
		$total = $this->mmain->templateCount();
		$this->data['body']['list'] = $this->mmain->templateSelect($page, $pagesize);
		$this->data['body']['pages'] = $this->func->gpageStr($page, $pagesize, $total);
		$this->_show('templatelist');
	}

	/**
	 * 模板管理 -- 添加
	 */
	public function templateAdd() {
		$submit = $this->input->post('submit');
		if ($submit) {
			if ($_FILES['pic']['tmp_name'] == '') {
				$this->_alert('提示信息', '请上传预览图', '/templateAdd', 10);
			}
			$path = '/uploads/template_pic';
			$upres = $this->_uploadfile($path, 'pic');
			if ($upres === 1 || $upres === 2) {
				$this->_alert('提示信息', '上传文件失败，请检查', '/templateAdd', 10);
			}
			$insert = array(
				'title' => $this->func->formatCnString($this->input->post('title')),
				'pic' => $upres,
				'code' => mysql_real_escape_string($this->input->post('code')),
			);
			$ins = $this->mmain->templateInsert($insert);
			if ($ins) {
				$this->_transit('提示信息', '添加模板成功！', '/templateList', 3);
			} else {
				$this->_alert('提示信息', '添加模板错误，请检查', '/templateAdd', 10);
			}
		}
		$this->_show('templateadd');
	}

	/**
	 * 模板管理 -- 编辑
	 */
	public function templateEdit() {
		$id = $this->func->intGetHandle($this, 'id');
		$submit = $this->input->post('submit');
		if ($submit) {
			$where = array('id' => $id);
			$update = array(
				'title' => $this->func->formatCnString($this->input->post('title')),
				'code' => mysql_real_escape_string($this->input->post('code')),
			);
			$old_pic = $this->input->post('old_pic');
			if ($old_pic == '') {
				$delpic['pic'] = '';
				$this->mmain->templateUpdate($delpic, $where);
			}
			if (!$_FILES['pic']['tmp_name'] == '') {
				$path = '/uploads/template_pic';
				$upres = $this->_uploadfile($path, 'pic');
				if ($upres === 1 || $upres === 2) {
					$this->_alert('提示信息', '上传文件失败，请检查', '/templateEdit?id='.$id, 10);
				}
				//删除之前的图片
				if ($old_pic != '') {
					$this->func->grm($_SERVER['DOCUMENT_ROOT'] . $old_pic);
				}
				$update['pic'] = $upres;
			}
			$ups = $this->mmain->templateUpdate($update, $where);
			if ($ups) {
				$this->_transit('提示信息', '修改模板成功！', '/templateList', 3);
			} else {
				$this->_alert('提示信息', '修改模板错误，请检查', '/templateEdit?id='.$id, 10);
			}
		}
		//获取数据
		$list = $this->mmain->templateSelectById($id);
		$this->data['body']['list'] = $list[0];
		$this->_show('templateedit');
		$this->_show('templateedd');
	}

	/**
	 * 模板管理 -- 删除模板
	 */
	public function templateDel() {
		$id = $this->func->intGetHandle($this, 'id');
		$method = $this->func->formatString($this->input->get('method'));
		if ($method === 'del') {
			$list = $this->mmain->templateSelectById($id);
			$where = array('id' => $id);
			//删除模板的数据
			$des = $this->mmain->templateDelete($where);
			//删除图片
			$this->func->grm($_SERVER['DOCUMENT_ROOT'] . $list[0]['pic']);
			$this->_transit('提示信息', '已经删除ID为'.$id.'的模板', '/templateList', 3);
		}
		$this->_confirm('提示信息', '你确定要删除该模板吗？', '/templateDel?method=del&id='.$id, '/templateList');
	}

	/**
	 * 模板管理 -- 删除图片
	 */
	public function ajaxTemplateDelPic() {
		$path = $this->input->get('path');
		if ($this->func->grm($_SERVER['DOCUMENT_ROOT'] . $path)) {
			echo 1;
		} else {
			echo 0;
		}
		exit;
	}

	/**
	 * 内容管理 -- 文章 -- 列表
	 */
	public function articleList() {
		$this->_show('articlelist');
	}
	
	/**
	 * 内容管理 -- 文章 -- 添加
	 */
	public function articleAdd() {
		$this->_show('articleadd');
	}

	/**
	 * 内容管理 -- 软件 -- 列表
	 */
	public function softList() {
		$this->_show('softlist');
	}
	
	/**
	 * 内容管理 -- 软件 -- 添加
	 */
	public function softAdd() {
		$this->_show('softadd');
	}

	/**
	 * 内容管理 -- 图片 -- 列表
	 */
	public function picList() {
		$this->_show('piclist');
	}
	
	/**
	 * 内容管理 -- 图片 -- 添加
	 */
	public function picAdd() {
		$this->_show('picadd');
	}
	//----------------------------------------------------------------
	// 具体页面实现和AJAX --- end
	//----------------------------------------------------------------
	

	//----------------------------------------------------------------
	// 功能区 --- start
	//----------------------------------------------------------------
	/*
	 * 显示页面
	 * @author: GP
	 * @date: 2011年8月14日
	 */
	private function _show($main = 'main', $head = 'head', $foot = 'foot') {
		if (!$this->_isLogin()) {
			show_404();
		}
		$this->data['Management'] = $this->_getSession('Management');
		//菜单
		$this->data['menu'] = $this->config->item('menu');
		$this->data['current'] = $this->router->method;

		$view_head = $this->func->compressHtml($this->load->view($head, $this->data, true));
		$view_body = $this->func->compressHtml($this->load->view($main, $this->data, true));
		$view_foot = $this->func->compressHtml($this->load->view($foot, $this->data, true));

		echo $view_head.$view_body.$view_foot;
		exit;
	}


	/*
	 * 中转页面
	 * @author: GP
	 * @date: 2011年12月30日
	 */
	private function _transit($title = '提示信息', $message = '', $url = '/', $gtime = 5) {
		$this->data['body']['title'] = $title;
		$this->data['body']['message'] = $message;
		$this->data['body']['url'] = $url;
		$this->data['body']['gtime'] = $gtime;
		$this->_show('transit');
	}

	/*
	 * 确认页面
	 * @author: GP
	 * @date: 2011年12月30日
	 */
	private function _confirm($title = '提示信息', $message = '', $determine = '#', $cancel = '#') {
		$this->data['body']['title'] = $title;
		$this->data['body']['message'] = $message;
		$this->data['body']['determine'] = $determine;
		$this->data['body']['cancel'] = $cancel;
		$this->_show('confirm');
	}

	/*
	 * 提示页面
	 * @author: GP
	 * @date: 2012年1月10日
	 */
	private function _alert($title = '提示信息', $message = '', $url = '/', $gtime = 5) {
		$this->data['body']['title'] = $title;
		$this->data['body']['message'] = $message;
		$this->data['body']['url'] = $url;
		$this->data['body']['gtime'] = $gtime;
		$this->_show('alert');
	}

	/*
	 * 上传文件
	 * @author: GP
	 * @date: 2012年1月10日
	 * @param: $path 上传文件的路径 格式：/upload/pic
	 * @param: $postname 上传表单的名称
	 * @param: $filetypes 上传的文件类型
	 * @param: $filesize 上传的文件大小，单位是K，0代表不限制大小
	 * @return 1 路径错误
	 * @return 2 上传失败
	 * @return 上传正确，返回上传文件的文件名
	 */
	private function _uploadfile($path, $postname, $filetypes = 'gif|jpg|png', $filesize = '0') {
		$path = $path . '/' . date('Y') . '/' . date('m') . '/' . date('d');
		if (!is_dir($path)) {
			$this->func->gmkdir($_SERVER['DOCUMENT_ROOT'] . $path);
		}
		if (!$path) {
			return 1;
		}
		$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . $path;
		$config['allowed_types'] = $filetypes;
		$config['file_name'] = date('YmdHis') . '_' . md5(date('His'));

		exec("echo " . $config['upload_path'] . " > /tmp/path");

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($postname)) {
			$error = $this->upload->display_errors();
			return 2;
		} else {
			$updata = $this->upload->data();
			return $path . '/' . $updata['file_name'];
		}
	}

    /*
     * 判断是否登录
     * @return boolean
     */
    private function _isLogin() {
        $islogin = $this->_getSession('__Admin__');
        if ($islogin === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * 存session值
     * @param s_arr 放SESSION的数组
     */
    private function _setSession($s_arr) {
        $this->load->library('session');
        $this->session->set_userdata($s_arr);
        return TRUE;
    }
    
    /*
     * 取session值
     * @param $sssion_name SESSION名
     * @return string
     */
    private function _getSession($session_name) {
        $this->load->library('session');
        return $this->session->userdata($session_name);
    }
    
    /*
     * 删session值
     * @param $sssion_name SESSION名
     * @return string
     */
    private function _delSession($session_name) {
        $this->load->library('session');
        $this->session->unset_userdata($session_name);
    }
	//----------------------------------------------------------------
	// 功能区 --- end
	//----------------------------------------------------------------
}
