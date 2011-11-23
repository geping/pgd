<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	private $sessionName = 'GP';

	private $data = array();

	function __construct() {
		parent::__construct();
		$this->output->enable_profiler(TRUE);
		$this->load->library('func');
		$this->load->config('gp');
		$this->load->model('mhome');

		$this->data['head'] = array();
		$this->data['body'] = array();
		$this->data['foot'] = array();
	}
	
	/*
	 * 首页 --- 版图信息表
	 * @author: GP
	 * @date: 2011年8月14日
	 */
	public function index() {
		//加载显示部分
		$this->data['body']['show_piece'] = $this->config->item('domain_info_col');
		$this->_show();
	}

	/*
	 * 首页 --- ajax数据显示
	 * @author: GP
	 * @date: 2011年8月20日
	 */
	public function indexAjax() {
		$conbination = array();
		// 每页显示多少条
		$pagesize = intval($this->input->get('pagesize')) ? intval($this->input->get('pagesize')) : 20;
		$pages = intval($this->input->get('pages')) ? intval($this->input->get('pages')) : 1;
		$total = $this->mhome->countSql();
		$page_count = ceil($total/$pagesize);
		if ($pages > $page_count) {
			$pages = $page_count;
		} 
		$domain = $this->mhome->selectSql($pagesize, $pagesize * ($pages - 1));
		if ($domain) {
			$conbination['main'] = $domain;
			$conbination['pages'] = $this->func->gpages($pages, $pagesize, $total);
			echo json_encode($conbination);
			exit;
		}
		if ($total == 0){
			echo -1;
			exit;
		}
		echo 0;
		exit;
	}

	/*
	 * 首页 --- 编辑版图信息表
	 * @author: GP
	 * @date: 2011年9月4日
	 */
	public function indexEdit() {
		if (!$this->_isLogin()) {
			echo -2; //未登录
			exit;
		}
		$id = intval($this->input->get('id'));
		$field = $this->input->get('field');
		$val = $this->input->get('val');
		if (!$id) {
			echo -1; //ID为零，操作犯规
			exit;
		}
		$erow = $this->mhome->editSql($id, $field, $val);
		if ($erow) {
			echo 1;
			exit;
		} else {
			echo 0;
			exit;
		}
		exit;
	}

	/*
	 * 首页 --- 删除信息
	 * @author: GP
	 * @date: 2011年9月5日
	 */
	public function indexDel() {
		if (!$this->_isLogin()) {
			echo -1;
			exit;
		}
		$str_id = $this->input->get('ids');
		$ids = explode(',', $str_id);
		foreach($ids as $key => $value) {
			$value = intval($value);
			if (!$value) {
				unset($ids[$key]);
			}
		}
		if (empty($ids)) {
			echo -1;
			exit;
		}
		$drow = $this->mhome->delSql($ids);
		if ($drow) {
			echo 1;
			exit;
		} else {
			echo 0;
			exit;
		}
		exit;
	}

	/*
	 * 登录页面
	 * @author: GP
	 * @date: 2011年8月14日
	 */
	public function login() {
		$this->_show('login');
	}

	/*
	 * 导入数据页面
	 * @author: GP
	 * @date: 2011年8月14日
	 */
	public function import() {
		if ($this->input->post('up_submit') && $this->input->post('up_submit') == '上传') {
			$file = $_FILES['file'];
			if (!empty($file['tmp_name'])) {
				require_once('./func/reader.php');
				$excel = new Spreadsheet_Excel_Reader();
				$excel->setOutputEncoding('utf-8');
				$excel->read($file['tmp_name']);
				if (isset($excel->sheets)) {
					$excel = $excel->sheets[0]['cells'];
					$values = '';
					foreach($excel as $key => $value) {
						if ($key >= 2) {
							$values .= '(';
							$values .= isset($value[2]) ? floatval($value[2]) : '""'; // DECIMAL(5,2)
							$values .= ',';
							$values .= isset($value[3]) ? '"' . mysql_real_escape_string($value[3]) . '"' : '""'; // char
							$values .= ',';
							$values .= isset($value[4]) ? '"' . mysql_real_escape_string($value[4]) . '"' : '""'; // char
							$values .= ',';
							$values .= isset($value[5]) ? '"' . mysql_real_escape_string($value[5]) . '"' : '""'; // char
							$values .= ',';
							$values .= isset($value[6]) ? '"' . mysql_real_escape_string($value[6]) . '"' : '""'; // char
							$values .= ',';
							$values .= isset($value[7]) ? '"' . mysql_real_escape_string($value[7]) . '"' : '""'; // char
							$values .= ',';
							$values .= isset($value[8]) ? '"' . mysql_real_escape_string($value[8]) . '"' : '""'; // date
							$values .= ',';
							$values .= isset($value[9]) ? '"' . mysql_real_escape_string($value[9]) . '"' : '""'; // char
							$values .= ',';
							$values .= isset($value[10]) ? intval($value[10]) : 0; // int
							$values .= ',';
							$values .= isset($value[11]) ? floatval($value[11]) : 0; // DECIMAL(6,2)
							$values .= ',';
							$values .= isset($value[12]) ? round($value[12], 2) : 0; // DECIMAL(5,2)
							$values .= ',';
							$values .= isset($value[13]) ? round($value[13], 2) : 0; // DECIMAL(5,2)
							$values .= ',';
							$values .= isset($value[14]) ? round($value[14], 2) : 0; // DECIMAL(5,2)
							$values .= ',';
							$values .= isset($value[15]) ? '"' . mysql_real_escape_string($value[15]) . '"' : '""'; // char
							$values .= ',';
							$values .= isset($value[16]) ? floatval($value[16]) : 0; // DECIMAL(5,2)
							$values .= ',';
							$values .= isset($value[17]) ? floatval($value[17]) : 0; // DECIMAL(8,2)
							$values .= ',';
							$values .= isset($value[18]) ? floatval($value[18]) : 0; // DECIMAL(8,2)
							$values .= ',';
							$values .= isset($value[19]) ? '"' . mysql_real_escape_string($value[19]) . '"' : '""'; // char
							$values .= ',';
							$values .= isset($value[20]) ? '"' . mysql_real_escape_string($value[20]) . '"' : '""'; // char
							$values .= ',';
							$values .= isset($value[21]) ? '"' . mysql_real_escape_string($value[21]) . '"' : '""'; // char
							$values .= ',';
							$values .= isset($value[22]) ? intval($value[22]) : 0; // int
							$values .= ',';
							$values .= isset($value[23]) ? floatval($value[23]) : 0; // DECIMAL(5,2)
							$values .= ',';
							$values .= isset($value[24]) ? floatval($value[24]) : 0; // DECIMAL(5,2)
							$values .= ',';
							$values .= isset($value[25]) ? floatval($value[25]) : 0; // DECIMAL(5,2)
							$values .= ',';
							$values .= isset($value[26]) ? floatval($value[26]) : 0; // DECIMAL(5,2)
							$values .= ',';
							$values .= isset($value[27]) ? intval($value[27]) : 0; // int
							$values .= ',';
							$values .= isset($value[28]) ? intval($value[28]) : 0; // int
							$values .= ',';
							$values .= isset($value[30]) ? floatval($value[30]) : 0; // DECIMAL(5,2)
							$values .= ',';
							$values .= isset($value[31]) ? floatval($value[31]) : 0; // DECIMAL(5,2)
							$values .= ',';
							$values .= isset($value[32]) ? floatval($value[32]) : 0; // DECIMAL(5,2)
							$values .= ',';
							$values .= isset($value[33]) ? intval($value[33]) : 0; // int
							$values .= ',';
							$values .= isset($value[34]) ? floatval($value[34]) : 0; // DECIMAL(4,2)
							$values .= '), ';
						}
					}
					$values = substr($values, 0, -2);
					
					$this->load->model('home');
					$affect_row = $this->home->importSql($values);
					if ($affect_row) {
						//插入成功
					} else {
						//插入失败
					}
					header('Location:/');
				}
				
			}
		}
		$this->_show('import');
	}
	
	/*
	 * 登录检查
	 * @author: GP
	 * @date: 2011年8月14日
	 */
	public function loginCheck() {
		$username = $this->input->post('username');
		$password = $this->func->passwordHandle($this->input->post('passowrd'));

		if (!empty($username) && !empty($password)) {
			$account = $this->config->item('account');
			if ($username === $account['username'] && $password === $account['password']) {
				$session_arr = array(
								$this->sessionName => TRUE,
								'username' => $username,
								);
				$this->_setSession($session_arr);
			}
		}

		header('Location:/');
	}

	/*
	 * 退出登录
	 * @author: GP
	 * @date: 2011年8月14日
	 */
	public function outThis() {
		$this->_delSession($this->sessionName);
		$this->_delSession('username');
		
		header('Location:/');
	}

	/*
	 * 操作人员管理
	 * @author: GP
	 * @date: 2011年11月9日
	 */
	public function operator() {
		if (!$this->_isLogin()) {
			show_404();
		}
		$page = $this->input->get('page');
		if (!$page) {
			$page = 1;
		}
		$pagesize = 10;
		
		$this->data['body']['list'] = $this->mhome->operatorSelect($page, $pagesize);

		$this->_show('operator');
	}

	/*
	 * 显示页面
	 * @author: GP
	 * @date: 2011年8月14日
	 */
	private function _show($home = 'home', $head = 'head', $foot = 'foot') {
		$os = $this->config->item('os');
		$this->data['head']['title'] = $os['os_name'];
		$this->data['head']['username'] = $this->_isLogin() ? $this->_getSession('username') : '';

		$view_head = $this->func->compressHtml($this->load->view($head, $this->data, true));
		$view_body = $this->func->compressHtml($this->load->view($home, $this->data, true));
		$view_foot = $this->func->compressHtml($this->load->view($foot, $this->data, true));

		echo $view_head.$view_body.$view_foot;
		exit;
	}

    /*
     * 判断是否登录
     * @return boolean
     */
    private function _isLogin() {
        $islogin = $this->_getSession($this->sessionName);
        if ($islogin) {
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
}
