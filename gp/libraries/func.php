<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * -------------------------------------------------
 * | 共用类库
 * -------------------------------------------------
 */

class Func {

    /*
     * 密码处理
     * @param password 初始密码
     * @return mpassword 处理后的密码
     */
    public function passwordHandle($password) {
        //MD5加密
        $tmp = md5($password);
        //取一个加密后的特殊值
        $tmp2 = md5('gp');
        //取加密后的密码第12位到24位
        $tmp3 = md5(substr($tmp, 12, 24));
        //取第一个12位
        $tmp = substr($tmp, 0, 12);
        //取第二个6位
        $tmp2 = substr($tmp2, 0, 6);
        //去第三个6位
        $tmp3 = substr($tmp3, 0, 6);
        $mpassword = $tmp . $tmp2 . $tmp3;
        return $mpassword;
    }

	/*
	 * 获取IP
	 */
	public function getIp() {
    		if ($HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"]) {
            		$ip = $HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"];
    		} elseif ($HTTP_SERVER_VARS["HTTP_CLIENT_IP"]) {
            		$ip = $HTTP_SERVER_VARS["HTTP_CLIENT_IP"];
    		} elseif ($HTTP_SERVER_VARS["REMOTE_ADDR"]) {
            		$ip = $HTTP_SERVER_VARS["REMOTE_ADDR"];
    		} elseif (getenv("HTTP_X_FORWARDED_FOR")) {
            		$ip = getenv("HTTP_X_FORWARDED_FOR");
   		} elseif (getenv("HTTP_CLIENT_IP")) {
            		$ip = getenv("HTTP_CLIENT_IP");
		} elseif (getenv("REMOTE_ADDR")) {
            		$ip = getenv("REMOTE_ADDR");
    		} else {
            		$ip = "Unknown";
    		}
    		return $ip;
	}

	/*
	 * 生成随机密码
	 * @param int 密码位数，默认为6
	 * @return string 生成的密码
	 */
	public function genRandomString($len = 6) {
		$chars = array(
        		"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", 
        		"l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", 
        		"w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", 
        		"H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", 
        		"S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2", 
        		"3", "4", "5", "6", "7", "8", "9"
        		);
        	$charsLen = count($chars) - 1;

        	shuffle($chars);    // 将数组打乱
    
        	$output = "";
        	for ($i=0; $i<$len; $i++) {
            		$output .= $chars[mt_rand(0, $charsLen)];
        	}
 
        	return $output;
	}

    /**
     *----------------------------------------------------------
     * 字符串截取，支持中文和其他编码
     *----------------------------------------------------------
     * @param string $source 需要转换的字符串
     * @param string $start 开始位置
     * @param string $length 截取长度
     * @param string $charset 编码格式
     * @param string $suffix 截断显示字符后缀
     *----------------------------------------------------------
     * @return string
     *----------------------------------------------------------
     */
    public function gpSubstr($source, $start = 0, $length = 30, $charset = "utf-8", $suffix = "")
    {
        if (function_exists("mb_substr")) {        //采用PHP自带的mb_substr截取字符串
            $string = mb_substr($source, $start, $length, $charset).$suffix;
        } elseif (function_exists('iconv_substr')) { //采用PHP自带的iconv_substr截取字符串
            $string = iconv_substr($source,$start,$length,$charset).$suffix;
        } else {
            $pattern['utf-8']   = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
            $pattern['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
            $pattern['gbk']    = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
            $pattern['big5']   = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
            preg_match_all($pattern[$charset], $source, $match);
            $slice = join("",array_slice($match[0], $start, $length));
       
            $string = $slice.$suffix;
        }
        return $string;
    }



	/*
	 * 把汉字转换为拼音
	 * @param str 汉字
	 */
	public function toPinyin($str) {
		$datakey = "a|ai|an|ang|ao|ba|bai|ban|bang|bao|bei|ben|beng|bi|bian|biao|bie|bin|bing|bo|bu|ca|cai|can|cang|cao|ce|ceng|cha".
					"|chai|chan|chang|chao|che|chen|cheng|chi|chong|chou|chu|chuai|chuan|chuang|chui|chun|chuo|ci|cong|cou|cu|".
					"cuan|cui|cun|cuo|da|dai|dan|dang|dao|de|deng|di|dian|diao|die|ding|diu|dong|dou|du|duan|dui|dun|duo|e|en|er".
					"|fa|fan|fang|fei|fen|feng|fo|fou|fu|ga|gai|gan|gang|gao|ge|gei|gen|geng|gong|gou|gu|gua|guai|guan|guang|gui".
					"|gun|guo|ha|hai|han|hang|hao|he|hei|hen|heng|hong|hou|hu|hua|huai|huan|huang|hui|hun|huo|ji|jia|jian|jiang".
					"|jiao|jie|jin|jing|jiong|jiu|ju|juan|jue|jun|ka|kai|kan|kang|kao|ke|ken|keng|kong|kou|ku|kua|kuai|kuan|kuang".
					"|kui|kun|kuo|la|lai|lan|lang|lao|le|lei|leng|li|lia|lian|liang|liao|lie|lin|ling|liu|long|lou|lu|lv|luan|lue".
					"|lun|luo|ma|mai|man|mang|mao|me|mei|men|meng|mi|mian|miao|mie|min|ming|miu|mo|mou|mu|na|nai|nan|nang|nao|ne".
					"|nei|nen|neng|ni|nian|niang|niao|nie|nin|ning|niu|nong|nu|nv|nuan|nue|nuo|o|ou|pa|pai|pan|pang|pao|pei|pen".
					"|peng|pi|pian|piao|pie|pin|ping|po|pu|qi|qia|qian|qiang|qiao|qie|qin|qing|qiong|qiu|qu|quan|que|qun|ran|rang".
					"|rao|re|ren|reng|ri|rong|rou|ru|ruan|rui|run|ruo|sa|sai|san|sang|sao|se|sen|seng|sha|shai|shan|shang|shao|".
					"she|shen|sheng|shi|shou|shu|shua|shuai|shuan|shuang|shui|shun|shuo|si|song|sou|su|suan|sui|sun|suo|ta|tai|".
					"tan|tang|tao|te|teng|ti|tian|tiao|tie|ting|tong|tou|tu|tuan|tui|tun|tuo|wa|wai|wan|wang|wei|wen|weng|wo|wu".
					"|xi|xia|xian|xiang|xiao|xie|xin|xing|xiong|xiu|xu|xuan|xue|xun|ya|yan|yang|yao|ye|yi|yin|ying|yo|yong|you".
					"|yu|yuan|yue|yun|za|zai|zan|zang|zao|ze|zei|zen|zeng|zha|zhai|zhan|zhang|zhao|zhe|zhen|zheng|zhi|zhong|".
					"zhou|zhu|zhua|zhuai|zhuan|zhuang|zhui|zhun|zhuo|zi|zong|zou|zu|zuan|zui|zun|zuo"; 
		$datavalue = "-20319|-20317|-20304|-20295|-20292|-20283|-20265|-20257|-20242|-20230|-20051|-20036|-20032|-20026|-20002|-19990".
					"|-19986|-19982|-19976|-19805|-19784|-19775|-19774|-19763|-19756|-19751|-19746|-19741|-19739|-19728|-19725".
					"|-19715|-19540|-19531|-19525|-19515|-19500|-19484|-19479|-19467|-19289|-19288|-19281|-19275|-19270|-19263".
					"|-19261|-19249|-19243|-19242|-19238|-19235|-19227|-19224|-19218|-19212|-19038|-19023|-19018|-19006|-19003".
					"|-18996|-18977|-18961|-18952|-18783|-18774|-18773|-18763|-18756|-18741|-18735|-18731|-18722|-18710|-18697".
					"|-18696|-18526|-18518|-18501|-18490|-18478|-18463|-18448|-18447|-18446|-18239|-18237|-18231|-18220|-18211".
					"|-18201|-18184|-18183|-18181|-18012|-17997|-17988|-17970|-17964|-17961|-17950|-17947|-17931|-17928|-17922".
					"|-17759|-17752|-17733|-17730|-17721|-17703|-17701|-17697|-17692|-17683|-17676|-17496|-17487|-17482|-17468".
					"|-17454|-17433|-17427|-17417|-17202|-17185|-16983|-16970|-16942|-16915|-16733|-16708|-16706|-16689|-16664".
					"|-16657|-16647|-16474|-16470|-16465|-16459|-16452|-16448|-16433|-16429|-16427|-16423|-16419|-16412|-16407".
					"|-16403|-16401|-16393|-16220|-16216|-16212|-16205|-16202|-16187|-16180|-16171|-16169|-16158|-16155|-15959".
					"|-15958|-15944|-15933|-15920|-15915|-15903|-15889|-15878|-15707|-15701|-15681|-15667|-15661|-15659|-15652".
					"|-15640|-15631|-15625|-15454|-15448|-15436|-15435|-15419|-15416|-15408|-15394|-15385|-15377|-15375|-15369".
					"|-15363|-15362|-15183|-15180|-15165|-15158|-15153|-15150|-15149|-15144|-15143|-15141|-15140|-15139|-15128".
					"|-15121|-15119|-15117|-15110|-15109|-14941|-14937|-14933|-14930|-14929|-14928|-14926|-14922|-14921|-14914".
					"|-14908|-14902|-14894|-14889|-14882|-14873|-14871|-14857|-14678|-14674|-14670|-14668|-14663|-14654|-14645".
					"|-14630|-14594|-14429|-14407|-14399|-14384|-14379|-14368|-14355|-14353|-14345|-14170|-14159|-14151|-14149".
					"|-14145|-14140|-14137|-14135|-14125|-14123|-14122|-14112|-14109|-14099|-14097|-14094|-14092|-14090|-14087".
					"|-14083|-13917|-13914|-13910|-13907|-13906|-13905|-13896|-13894|-13878|-13870|-13859|-13847|-13831|-13658".
					"|-13611|-13601|-13406|-13404|-13400|-13398|-13395|-13391|-13387|-13383|-13367|-13359|-13356|-13343|-13340".
					"|-13329|-13326|-13318|-13147|-13138|-13120|-13107|-13096|-13095|-13091|-13076|-13068|-13063|-13060|-12888".
					"|-12875|-12871|-12860|-12858|-12852|-12849|-12838|-12831|-12829|-12812|-12802|-12607|-12597|-12594|-12585".
					"|-12556|-12359|-12346|-12320|-12300|-12120|-12099|-12089|-12074|-12067|-12058|-12039|-11867|-11861|-11847".
					"|-11831|-11798|-11781|-11604|-11589|-11536|-11358|-11340|-11339|-11324|-11303|-11097|-11077|-11067|-11055".
					"|-11052|-11045|-11041|-11038|-11024|-11020|-11019|-11018|-11014|-10838|-10832|-10815|-10800|-10790|-10780".
					"|-10764|-10587|-10544|-10533|-10519|-10331|-10329|-10328|-10322|-10315|-10309|-10307|-10296|-10281|-10274".
					"|-10270|-10262|-10260|-10256|-10254";
		$tdatakey = explode('|', $datakey);
		$tdatavalue = explode('|', $datavalue);

		$data = array_combine($tdatakey, $tdatavalue);
		arsort($data);
		reset($data);

		//utf-8 转换为 gb2312
		$tstr = '';
		if ($str < 0x80) {
			$tstr .= $str;
		} elseif ($str < 0x800) {
			$tstr .= chr(0xC0 | $str >> 6);
			$tstr .= chr(0x80 | $str & 0x3F);
		} elseif ($str < 0x10000) {
			$tstr .= chr(0xE0 | $str >> 12);
			$tstr .= chr(0x80 | $str >> 6 & 0x3F);
			$tstr .= chr(0x80 | $str & 0x3F);
		} elseif ($str < 0x200000) {
			$tstr .= chr(0xF0 | $str >> 18);
			$tstr .= chr(0x80 | $str >> 12 & 0x3F);
			$tstr .= chr(0x80 | $str >> 6 & 0x3F);
			$tstr .= chr(0x80 | $str & 0x3F);
		}
		$str = iconv('UTF-8', 'GB2312', $tstr);

		$res = '';
		for ($i = 0; $i < strlen($str); $i++) {
			$asc = ord(substr($str, $i, 1));
			if ($asc > 160) {
				$asc2 = ord(substr($str, ++$i, 1));
				$asc = $asc * 256 + $asc2 - 65536;
			}
			if ($asc > 0 && $asc < 160) {
				$res .= chr($asc);
			} elseif ($asc < -20319 || $asc > -10247) {
				$res .= '';
			} else {
				foreach($data as $key => $value) {
					if ($value <= $asc) {
						$res .= $key;
						break;
					}
				}
			}
		}
		return preg_replace('/[^a-z0-9]*/', '', $res);
	}

	/*
	 * @author: GP
	 * @date:2011年11月22日
	 * 用于取文字拼音的首字母
	 */
	public function getPinyinAbb($str) {
		
	}

	/*
	 * 压缩html代码
	 */
	public function compressHtml($html) {
		$yhtml = str_replace("\r\n", '', $html);
		$yhtml = str_replace("\n", '', $html);
		$yhtml = str_replace("\t", '', $yhtml);
		$yhtml = preg_replace("/ {2,}/", '', $yhtml);
		return $yhtml;
	}

	/*
	 * INT类型的GET/POST接收和处理 （大于零）
	 * @param 要GET/POST接收的字符串
	 * @param 如果接收到的数据不是INT型，则做第二个参数处理
	 * @return 处理后的数据
	 */
	public function intGetHandle($gp, $str, $default = 'show_404()') {
		$it = $gp->input->get_post($str);
		$it = intval($it) ? intval($it) : $default;
		if ($it <= 0) {
			if ($default == 'show_404()') {
				show_404();
				exit;
			} else {
				$it = $default;
			}
		}
		return $it;
	}

	/*
	 * 循环创建目录
	 * @param 路径
	 * @return boolean
	 */
	public function gmkdir($dir) {
		$pathprefix = '';
		$firststr = substr($dir, 0, 1);
		if ($firststr == '/') {
			$pathprefix = '/';
		} elseif ($firststr == '.') {
			$secstr = substr($dir, 1, 1);
			if ($secstr == '/') {
				$pathprefix = './';
			} else {
				$pathprefix = '';
			}
		} else {
			$pathprefix = '';
		}
		$dirs = explode('/', $dir);
		foreach ($dirs as $key => $value) {
			$value = preg_replace('/[\/\\ <> \*\?\: "\|]+/', '', $value);
			if ($value != '.' && $value != '') {
				$path = $pathprefix.$value;
				if (!is_dir($path)) {
					@mkdir($path, 0777);
				}
				$pathprefix = $path . '/';
			}
		}
		if (is_dir($dir)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/*
	 * Ajax分页方法
	 * @author: GP
	 * @date: 2011年8月29日
	 * @param page 当前页
	 * @param pagesize 每页显示多少
	 * @param total 数据总数
	 * @param offest 偏移量
	 * @return 分页字符串
	 */
	public function gpages($page, $pagesize, $total, $offest = 3) {
		$class = "gpages";
		$show_page_num = $offest * 2 + 1;//偏移量乘2+1，构造分页效果数目
		$page_count = ceil($total/$pagesize);//总共有多少页
		//取当前URL
		$now_url = $_SERVER['REQUEST_URI'];
		//处理URL
		$tmp_url = substr($now_url, strripos($now_url, '/')+1);
		$url_arr = explode('&', $tmp_url);
		if (count($url_arr) > 1) {
			foreach ($url_arr as $key => $value) {
				if (strripos($value, 'page') !== FALSE) {
					unset($url_arr[$key]);
				}
			}
			$tmp_url = implode('&', $url_arr);
		}
		//一些其他判断
		if ($page <= 1) {
			$sh_ash = 'ash';
		} else {
			$sh_ash = $class;
		}
		if ($page >= $page_count) {
			$x_ash = 'ash';
		} else {
			$x_ash = $class;
		}
		//第一页
		$first = "<span lang='1' class=".$sh_ash.">第一页</span>";
		//最后一页
		$last = "<span lang=".$page_count." class=".$x_ash.">最后一页</span>";

		//构造数字链接
		if ($page_count <= $show_page_num) {//如果总页数小于某一个值
			$show_page_int = $page_count;
		} else {
			$show_page_int = $show_page_num;
		}
		if ($page <= $offest) {
			$page_start = 1;
			$page_end = $show_page_int;
		} elseif ( $page > ($page_count-$offest)) {
			$page_start = $page_count - $show_page_int + 1;
			$page_end = $page_count;
		} else {
			$page_start = $page - $offest;
			$page_end = $page + $offest;
		}
		$page_num = '';
		for ($i = $page_start; $i <= $page_end; $i++) {
			if ($page == $i) $page_current = 'current';
			else $page_current = $class;
			$page_num .= "<span lang=".$i." class=\"".$page_current."\">".$i."</span>";
		}
		//构造上一页和下一页
		if ($page <= 1) $prev_page = 1;
		else $prev_page = $page - 1;
		if ($page >= $page_count) $next_page = $page_count;
		else $next_page = $page + 1;
		$prev_link = "<span lang=".$prev_page." class=\"".$sh_ash."\">上一页</span>";
		$next_link = "<span lang=".$next_page." class=\"".$x_ash."\">下一页</span>";

		//组合分页
		$g_page = $first.$prev_link.$page_num.$next_link.$last;
		return $g_page;
	}

	/*
	 * 分页方法
	 * @author: GP
	 * @date: 2011年10月8日
	 * @param page 当前页
	 * @param pagesize 每页显示多少
	 * @param total 数据总数
	 * @param offest 偏移量
	 * @return 分页字符串
	 */
	public function gpageStr($page, $pagesize, $total, $offest = 3) {
		$class = "thisclass";
		$show_page_num = $offest * 2 + 1;//偏移量乘2+1，构造分页效果数目
		$page_count = (int)ceil($total/$pagesize);//总共有多少页

		//一些其他判断
		if ($page <= 1) {
			//第一页
			$first = "<span>第一页</span>";
		} else {
			//第一页
			$first = "<span><a href='/articlelist?page=1'>第一页</a></span>";
		}
		if ($page >= $page_count) {
			//最后一页
			$last = "<span>最后一页</span>";
		} else {
			//最后一页
			$last = "<span><a href='/articlelist?page=$page_count'>最后一页</a></span>";
		}
		//构造数字链接
		if ($page_count <= $show_page_num) {//如果总页数小于某一个值
			$show_page_int = $page_count;
		} else {
			$show_page_int = $show_page_num;
		}
		if ($page <= $offest) {
			$page_start = 1;
			$page_end = $show_page_int;
		} elseif ( $page > ($page_count-$offest)) {
			$page_start = $page_count - $show_page_int + 1;
			$page_end = $page_count;
		} else {
			$page_start = $page - $offest;
			$page_end = $page + $offest;
		}
		$page_num = '';
		for ($i = $page_start; $i <= $page_end; $i++) {
			if ($page == $i) {
				$page_num .= "<span class=\"".$class."\">$i</span>";
			} else {
				$page_num .= "<span><a href='/articlelist?page=$i'>$i</a></span>";
			}
		}
		//构造上一页和下一页
		if ($page <= 1) {
			$prev_link = "<span>上一页</span>";
		} else {
			$prev_page = $page - 1;
			$prev_link = "<span><a href='/articlelist?page=$prev_page'>上一页</a></span>";
		}
		if ($page >= $page_count) {
			$next_link = "<span>下一页</span>";
		} else {
			$next_page = $page + 1;
			$next_link = "<span><a href='/articlelist?page=$next_page'>下一页</a></span>";
		}

		//分页信息
		$pageinfo = '<span class="pageinfo">共<strong>'.$page_count.'</strong>页&nbsp;<strong>'.$total.'</strong>条</span>';
		//组合分页
		$g_page = $first.$prev_link.$page_num.$next_link.$last.$pageinfo;
		return $g_page;
	}

	/*
	 * 验证用户名/email/密码
	 * @param data 将要验证的数据
	 * @param rules 验证规则 默认为email
	 * @return boolean
	 */
	public function uepDetect($data, $rules = 'email') {
		//正则验证
		if ($rules == 'email') {
			return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $data)) ? FALSE : TRUE;
		}
		if ($rules == 'username') {
			return ( ! preg_match("/^([a-z0-9]{6,20})$/i", $data)) ? FALSE : TRUE;
		}
		if ($rules == 'password') {
			return ( ! preg_match("/^([-a-z0-9_-]{6,20})$/i", $str)) ? FALSE : TRUE; 
		}
	}
}

