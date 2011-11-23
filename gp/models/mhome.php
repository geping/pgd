<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mhome extends CI_Model
{
	private $tabName = array();
	
	// 构造函数
	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->config('gp');
		$this->tabName = $this->config->item('tab_name');
	}

	/*
	 * 导入数据数据库
	 * @param $values 插入数据库的数据
	 * @return 插入数据的ID号|FALSE
	 */
	public function importSql($values) {
		$tab = $this->tabName['domain'];
		if ($values) {
			$sql = "insert into `domain_info`(`ship_type`, `ship_id`, `section`, `part_type`, `state`, `domain_id`, `complete_date`, `device`, `operation`, `detail_scale`, `cut_length`, `theory_tasktime`, `reality_tasktime`, `material_quality`, `steel_plate_land`, `steel_plate_width`, `steel_plate_length`, `cut_type`, `steel_plate_id`, `cut_space`, `detail_count`, `space_length`, `space_time`, `lineation_length`, `lineation_time`, `point_cut_count`, `point_cut_time`, `cut_time`, `cut_groove`, `half_groove`, `bridge_count`, `time_tally`) values{$values}";
			$this->db->query($sql);
			return $this->db->affected_rows();
		}
		return FALSE;
	}

	public function selectSql($pagesize = 20, $offest = 0) {
		$tab = $this->tabName['domain'];
		$this->db->select('*');
		$this->db->from($tab);
		//$this->db->where(array('id' => 58));
		$this->db->limit($pagesize, $offest);
		$query = $this->db->get();
		return $query->result();
	}

	/*
	 * 查询数据总量
	 * 
	 */
	public function countSql() {
		$tab = $this->tabName['domain'];
		$this->db->select('id');
		$this->db->from($tab);
		//$this->db->where(array('id' => 58));
		$query = $this->db->get();
		return $query->num_rows;
	}

	/*
	 * 编辑单个字段
	 *
	 */
	public function editSql($id, $field, $val) {
		$tab = $this->tabName['domain'];
		$up = array(
					$field => $val,		
				);
		$this->db->where('id', $id);
		return $this->db->update($tab, $up);
	}

	/*
	 * 删除数据
	 *
	 */
	public function delSql($ids) {
		$tab = $this->tabName['domain'];
		$this->db->where_in('id', $ids);
		return $this->db->delete($tab);
	}

	/*
	 * 操作人员 -- 查询
	 */
	public function operatorSelect($page = 1, $pagesize = 10, $where = array()) {
		$tab = $this->tabName['opera'];
		$this->db->from($tab);
		if (!empty($where)) {
			$this->db->where($where);
		}
		$this->db->limit($pagesize, ($page - 1) * $pagesize);
		$result = $this->db->get();
		if ($result->num_rows == 0) {
			return array();
		}
		foreach($result->result() as $key => $row) {
			$list[] = (array)$row;
		}
		return $list;
	}

	/*
	 * 操作人员 -- 数据总数
	 */
	public function operatorCount($where = array()) {
		$tab = $this->tabName['opera'];
		$this->db->from($tab);
		if (!empty($where)) {
			$this->db->where($where);
		}
		$result = $this->db->get();
		return $result->num_rows;
	}

	// 析构函数
	function __destruct() {
		$this->db->close();
	}
}
