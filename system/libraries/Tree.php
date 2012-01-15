<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 通用的树型类，可以生成任何树型结构
 *
 * @package system
 * @version $Id$
 * @copyright 2011 27pu.com
 * @license Commercial
 * @author GP <vsgeping@163.com>
 * =================================================================
 * 版权所有 (C) 2011 27pu.com，并保留所有权利。
 * 网站地址:http://www.27pu.com/
 * -----------------------------------------------------------------
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * =================================================================
 */
 
class CI_Tree
{
	public $arr = array(); //存放初始数组数据
	public $tree = array(); //存放完整的树
	public $map = array(); //存放映射索引数组, 将原数组里每条数据的ID作为key，将原数组中每条数据的key作为value
    
	//----------------------------------------------------------
	/**
	 * 检查数组
	 *
	 * @param array $arr
	 * @return boolean
	 */
	private function _checkArray($arr) {
		return (!is_array($arr) || empty($arr)) ? false : true;
	}

	//----------------------------------------------------------
	/**
	 * 检查是否为大于零整数
	 *
	 * @param int $int
	 * @return boolean
	 */
	private function _checkInt($int) {
		return (intval($int) <= 0) ? false : true;
	}

    //----------------------------------------------------------
	/**
	 * 初始化
	 *
	 * @param array $arr
	 */
    public function initialize($arr){
        if ($this->_checkArray($arr)) {
        	$this->arr = $arr;
			$this->tree = $this->_gTree($arr, 0);
        }
    }
    
	//----------------------------------------------------------
	/**
	 * 返回完整的树
	 *
	 * @return array
	 */
	public function getTree()
	{
		return $this->tree;
	}

	//----------------------------------------------------------
	/**
	 * 生成树，由数据数组生成树关系
	 *
	 * @param array $arr
	 * @param int $pid
	 * @return array
	 */
	private function _gTree($arr, $pid = 0)
	{
		$tree = array();
		foreach($arr as $key => $value) {
			if ($value['parent_id'] == $pid) {
				$this->map[$value['id']] = $key; //构造映射数组
				$tree[$value['id']] = $arr[$key];
				$tree[$value['id']]['child'] = $this->_gTree($arr, $value['id']);
			}
		}
		return $tree;
	}

	//----------------------------------------------------------
	/**
	 * 获取某节点下的所有节点（包含节点的数据）
	 *
	 * @param int $id
	 * @return array
	 */
	public function getChild($id)
	{
		if ($this->_checkInt($id)) {
			$arrkey = $this->map[$id];
			$path = $this->arr[$arrkey]['path']; //获取path值
			$path_arr = explode(',', $path);
			$childs = $this->tree;
			foreach ($path_arr as $key => $value) {
				$childs = $childs[$value]['child'];
			}
			return $childs;
		} else {
			return array();
		}
	}

	//----------------------------------------------------------
	/**
	 * 获取某节点下的所有节点ID（包含自身ID）{只有ID，没有数据}
	 *
	 * @param int $id
	 * @return array
	 */
	public function getCompleteChild($id)
	{
		$childs = $this->getChild($id);
		if (empty($childs)) {
			$nodes = array($id);
		} else {
			$nodes = $this->_getNodes($childs);
			array_unshift($nodes, $id);
		}
		return $nodes;
	}
	
	//----------------------------------------------------------
	/**
	 * 获取某节点下的所有节点ID（不包含自身ID）{只有ID，没有数据}
	 *
	 * @param int $id
	 * @return array
	 */
	public function getIncompleteChild($id)
	{
		$childs = $this->getChild($id);
		if (empty($childs)) {
			return array();
		} else {
			$nodes = $this->_getNodes($childs);
			return $nodes;
		}
	}

	//----------------------------------------------------------
	/**
	 * 获取新树的所有节点
	 *
	 * @param array $new_tree
	 * @return array
	 */
	private function _getNodes($new_tree)
	{
		$nodes = $child = array();
		foreach ($new_tree as $key => $value) {
			$nodes[] = $key;
			if (!empty($value['child'])) {
				$child = $this->_getNodes($value['child']);
			}
			$nodes = array_merge($nodes, $child);
		}
		return $nodes;
	}

	//----------------------------------------------------------
	/**
	 * 获取指定ID的值
	 *
	 * @param int $id
	 * @return array
	 */
	public function getValue($id)
	{
		if ($this->_checkInt($id)) {
			$arrkey = $this->map[$id];
			$specific = $this->arr[$arrkey];
			return $specific;
		}else{
			return array();
		}
	}
	
	//----------------------------------------------------------
	/**
	 * 检查是否还有子节点
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function hasChild($id)
	{
		if (!$this->_checkInt($id)) {return false;}
		$path = $this->arr[$this->map[$id]]['path'];
		
		$path_arr = explode(',', $path);
		$child = $this->tree;
		foreach ($path_arr as $key => $value) {
			$child = $child[$value]['child'];
		}
		if (empty($child)) {
			return false;
		}else{
			return true;
		}
	}

	//----------------------------------------------------------
	/**
	 * 取最终节点的所有ID
	 *
	 * @param int $id
	 * @return array
	 */
	public function getEndNodes($id)
	{
		if (!$this->_checkInt($id)) {
			return array();
		} else {
			$end_node = array();
			$nodes = $this->getIncompleteChild($id);
			foreach ($nodes as $key => $value) {
				if (!$this->hasChild($value)) {
					$end_node[] = $value;
				}
			}
			return $end_node;
		}
	}
}
