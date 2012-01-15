<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mmain extends CI_Model
{
	private $tabName = array();

	//构造函数
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->config('admin.config');

		//获取数据表名
		$this->tabName = $this->config->item('tab_name');
	}

	//查询用户名/密码是否正确，用于登录
	public function loginSelect($where) {
		$tab = $this->tabName['management'];
		$this->db->where($where);
		$result = $this->db->get($tab);

		if ($result->num_rows == 0) {
			return FALSE;
		}
		$result = $result->result_array();
		return $result[0];
	}

	//查询常用网站设置
	public function setWebSelect() {
		$tab = $this->tabName['website'];
		$result = $this->db->get($tab);

		if ($result->num_rows == 0) {
			return array();
		}
		$list = array();
		foreach ($result->result_array() as $key => $value) {
			$list[$value['webkey']] = $value['webvalue'];
		}
		return $list;
	}

	//修改常用网站设置
	public function setWebUpdate($update, $where) {
		$tab = $this->tabName['website'];
		$this->db->where($where);
		return $this->db->update($tab, $update);
	}

	//查询开发者附件设置
	public function setAttaSelect() {
		$tab = $this->tabName['atta'];
		$result = $this->db->get($tab);

		if ($result->num_rows == 0) {
			return array();
		}
		$list = array();
		foreach ($result->result_array() as $key => $value) {
			$list[$value['attakey']] = $value['attavalue'];
		}
		return $list;
	}

	//修改附件设置
	public function setAttaUpdate($update, $where) {
		$tab = $this->tabName['atta'];
		$this->db->where($where);
		return $this->db->update($tab, $update);
	}

	//附加属性 -- 读取数据
	public function addpropertySelect($page = 1, $pagesize = 10) {
		$tab = $this->tabName['addp'];
		$offset = ($page - 1) * $pagesize;
		$this->db->order_by('id', 'desc');
		$this->db->limit($pagesize, $offset);
		$result = $this->db->get($tab);

		if ($result->num_rows == 0) {
			return array();
		}
		return $result->result_array();
	}

	//附件属性 -- 读取单条数据
	public function addpropertySelectById($id) {
		$tab = $this->tabName['addp'];
		$this->db->where('id', $id);
		$result = $this->db->get($tab);

		if ($result->num_rows == 0) {
			return array();
		}
		return $result->result_array();
	}

	//附件属性 -- 修改单条记录
	public function addpropertyUpdateById($data, $id) {
		$tab = $this->tabName['addp'];
		$this->db->where('id', $id);
		return $this->db->update($tab, $data);
	}

	//附件属性 -- 获取数据总数
	public function addpropertyCount() {
		$tab = $this->tabName['addp'];
		$result = $this->db->get($tab);
		return $result->num_rows;
	}

	//附加属性 -- 插入数据
	public function addpropertyInsert($insert) {
		$tab = $this->tabName['addp'];
		$this->db->insert($tab, $insert);
		return $this->db->insert_id();
	}
	
	//附加属性 -- 删除数据
	public function addpropertyDelete($id) {
		$tab = $this->tabName['addp'];
		$this->db->where('id', $id);
		return $this->db->delete($tab);
	}

	//附加属性 -- 批量删除数据
	public function addpropertyBatDelete($field, $arr) {
		$tab = $this->tabName['addp'];
		$this->db->where_in($field, $arr);
		return $this->db->delete($tab);
	}

	//栏目管理 -- 查询数据
	public function sectionSelect() {
		$tab = $this->tabName['section'];
		$result = $this->db->get($tab);
		if ($result->num_rows == 0) {
			return array();
		}
		return $result->result_array();
	}

	//栏目管理 -- 根据ID查询数据
	public function sectionSelectById($id) {
		$tab = $this->tabName['section'];
		$this->db->where('id', $id);
		$result = $this->db->get($tab);
		if ($result->num_rows == 0) {
			return array();
		}
		return $result->result_array();
	}

	//栏目管理 -- 插入数据
	public function sectionInsert($data) {
		$tab = $this->tabName['section'];
		$this->db->insert($tab, $data);
		return $this->db->insert_id();
	}

	//栏目管理 -- 修改数据
	public function sectionUpdate($update, $where) {
		$tab = $this->tabName['section'];
		$this->db->where($where);
		return $this->db->update($tab, $update);
	}

	//栏目管理 -- 删除单条数据
	public function sectionDelete($where) {
		$tab = $this->tabName['section'];
		$this->db->where($where);
		return $this->db->delete($tab);
	}

	//栏目管理 -- 插入模板数据
	public function sectionTempInsert($data) {
		$tab = $this->tabName['section_t'];
		$this->db->insert($tab, $data);
		return $this->db->insert_id();
	}

	//栏目管理 -- 分类
	public function sectionCategorySelect() {
		$tab = $this->tabName['section'];
		$this->db->select('id, parent_id, path, title');
		$result = $this->db->get($tab);
		if ($result->num_rows == 0) {
			return array();
		}
		return $result->result_array();
	}

	//栏目管理 -- 栏目模板查询
	public function sectionTempSelect() {
		$tab = $this->tabName['section_t'];
		$this->db->order_by('s_id', 'desc');
		$result = $this->db->get($tab);
		if ($result->num_rows == 0) {
			return array();
		}
		$result = $result->result_array();
		foreach($result as $key => &$value) {
			if ($value['type'] == 0) {$value['title'] = $value['title'] . "（单页面）";}
			if ($value['type'] == 1) {$value['title'] = $value['title'] . "（列表页）";}
			if ($value['type'] == 2) {$value['title'] = $value['title'] . "（详细页）";}
		}
		return $result;
	}

	//栏目管理 -- 栏目模板查询数据
	public function sectionTempSelectBySid($id) {
		$tab = $this->tabName['section_t'];
		$this->db->where('s_id', $id);
		$result = $this->db->get($tab);
		if ($result->num_rows == 0) {
			return array();
		}
		return $result->result_array();
	}

	//栏目管理 -- 栏目模板 -- 删除
	public function sectionTempDeleteBySid($id) {
		$tab = $this->tabName['section_t'];
		$this->db->where('s_id', $id);
		return $this->db->delete($tab);
	}

	//模板管理 -- 查询数据
	public function templateSelect($page = 1, $pagesize = 10) {
		$tab = $this->tabName['template'];
		$offset = ($page - 1) * $pagesize;
		$this->db->order_by('id', 'desc');
		$this->db->limit($pagesize, $offset);
		$result = $this->db->get($tab);
		
		if ($result->num_rows == 0) {
			return array();
		}
		return $result->result_array();
	}

	//模板管理 -- 获取数据总数
	public function templateCount() {
		$tab = $this->tabName['template'];
		$result = $this->db->get($tab);
		return $result->num_rows;
	}

	//模板管理 -- 读取单条数据
	public function templateSelectById($id) {
		$tab = $this->tabName['template'];
		$this->db->where('id', $id);
		$result = $this->db->get($tab);

		if ($result->num_rows == 0) {
			return array();
		}
		return $result->result_array();
	}

	//模板管理 -- 插入模板数据
	public function templateInsert($data) {
		$tab = $this->tabName['template'];
		$this->db->insert($tab, $data);
		return $this->db->insert_id();
	}

	//模板管理 -- 修改数据
	public function templateUpdate($update, $where) {
		$tab = $this->tabName['template'];
		$this->db->where($where);
		return $this->db->update($tab, $update);
	}

	//模板管理 -- 删除模板数据
	public function templateDelete($where) {
		$tab = $this->tabName['template'];
		$this->db->where($where);
		return $this->db->delete($tab);
	}

	//模块管理 -- 查询数据
	public function moduleSelect($page = 1, $pagesize = 10) {
		$tab = $this->tabName['module'];
		$offset = ($page - 1) * $pagesize;
		$this->db->order_by('id', 'desc');
		$this->db->limit($pagesize, $offset);
		$result = $this->db->get($tab);
		
		if ($result->num_rows == 0) {
			return array();
		}
		return $result->result_array();
	}

	//模块管理 -- 插入数据
	public function moduleInsert($data) {
		$tab = $this->tabName['module'];
		$this->db->insert($tab, $data);
		return $this->db->insert_id();
	}

	//模块管理 -- 修改数据
	public function moduleUpdate($data, $where) {
		$tab = $this->tabName['module'];
		$this->db->where($where);
		return $this->db->update($tab, $data);
	}

	//模块管理 -- 删除数据
	public function moduleDelete($where) {
		$tab = $this->tabName['module'];
		$this->db->where($where);
		return $this->db->delete($tab);
	}

	//模块管理 -- 获取数据总数
	public function moduleCount() {
		$tab = $this->tabName['module'];
		$result = $this->db->get($tab);
		return $result->num_rows;
	}

	//模块管理 -- 读取单条数据
	public function moduleSelectById($id) {
		$tab = $this->tabName['module'];
		$this->db->where('id', $id);
		$result = $this->db->get($tab);

		if ($result->num_rows == 0) {
			return array();
		}
		return $result->result_array();
	}

	//查询栏目和模块的绑定表
	public function bindSectionModuleSelectById($id) {
		$tab = $this->tabName['bindsm'];
		$this->db->where('st_id', $id);
		$result = $this->db->get($tab);

		if ($result->num_rows == 0) {
			return array();
		}
		$result = $result->result_array();
		foreach($result as $key => &$value) {
			$module = $this->moduleSelectById($value['m_id']);
			$result[$key]['title'] = $module[0]['title'];
			$result[$key]['description'] = $module[0]['description'];
		}
		return $result;
	}

	//插入栏目和模块的绑定表
	public function bindSectionModuleInsert($data) {
		$tab = $this->tabName['bindsm'];
		$this->db->insert($tab, $data);
		return $this->db->insert_id();
	}

	//删除栏目和模块的绑定表的数据
	public function bindSectionModuleDelete($where) {
		$tab = $this->tabName['bindsm'];
		$this->db->where($where);
		return $this->db->delete($tab);
	}
}
