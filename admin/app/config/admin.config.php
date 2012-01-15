<?php
$config['tab_name'] = array(
                    'management' => 'management', //后台用户表
                    'website' => 'website', //网站常用信息
                    'atta' => 'attachment', //网站附件
                    'addp' => 'addproperty', //附加属性表
                    'section' => 'section', //栏目表
                    'section_t' => 'section_temp', //栏目表
                    'template' => 'template', //模板表
                    'module' => 'module', //模块表
                    'bindsm' => 'bind_section_module', //栏目和模块绑定表
);

//后台菜单
$config['menu'] = array(
					array('name' => '系统选项', 'show' => 1, 'style' => 1, 'child' => array(
						array('url' => 'index', 'tag' => 'index', 'name' => '系统信息', 'show' => 1, 'child' => array()),
						array('url' => 'setweb', 'tag' => 'setweb', 'name' => '常用网站设置', 'show' => 1, 'child' => array()),
						array('url' => 'setAtta', 'tag' => 'setAtta', 'name' => '附件管理', 'show' => 1, 'child' => array()),
						array('url' => 'addpropertyList', 'tag' => 'addpropertyList', 'name' => '附加属性', 'show' => 1, 'child' => array()),
						array('url' => 'addpropertyAdd', 'tag' => 'addpropertyAdd', 'name' => '添加附加属性', 'show' => 0, 'child' => array()),
					)),
					array('name' => '网站栏目', 'show' => 1, 'style' => 7, 'child' => array(
						array('url' => 'sectionList', 'tag' => 'sectionList', 'name' => '栏目管理', 'show' => 1, 'child' => array()),
						array('url' => 'sectionAdd', 'tag' => 'sectionAdd', 'name' => '添加栏目', 'show' => 1, 'child' => array()),
						array('url' => 'sectionEdit', 'tag' => 'sectionEdit', 'name' => '编辑栏目', 'show' => 0, 'child' => array()),
						array('url' => 'sectionMag', 'tag' => 'sectionMag', 'name' => '页面管理', 'show' => 1, 'child' => array()),
					)),
					array('name' => '页面模块', 'show' => 1, 'style' => 4, 'child' => array(
						array('url' => 'moduleList', 'tag' => 'moduleList', 'name' => '模块管理', 'show' => 1, 'child' => array()),
						array('url' => 'moduleEdit', 'tag' => 'moduleEdit', 'name' => '编辑模块', 'show' => 0, 'child' => array()),
						array('url' => 'moduleAdd', 'tag' => 'moduleAdd', 'name' => '添加模块', 'show' => 1, 'child' => array()),
					)),
					array('name' => '网站模板', 'show' => 1, 'style' => 2, 'child' => array(
						array('url' => 'templateList', 'tag' => 'templateList', 'name' => '模板管理', 'show' => 1, 'child' => array()),
						array('url' => 'templateEdit', 'tag' => 'templateEdit', 'name' => '编辑模板', 'show' => 0, 'child' => array()),
						array('url' => 'templateAdd', 'tag' => 'templateAdd', 'name' => '添加模板', 'show' => 1, 'child' => array()),
					)),
					array('name' => '内容管理', 'show' => 1, 'style' => 2, 'child' => array(
						array('url' => 'articleList', 'tag' => 'articleList', 'name' => '文章', 'show' => 1, 'child' => array()),
						array('url' => 'articleAdd', 'tag' => 'articleAdd', 'name' => '添加文章', 'show' => 0, 'child' => array()),
						array('url' => 'softList', 'tag' => 'softList', 'name' => '软件', 'show' => 1, 'child' => array()),
						array('url' => 'picList', 'tag' => 'picList', 'name' => '图片', 'show' => 1, 'child' => array()),
					)),
					array('name' => '开发者', 'show' => 1, 'style' => 4, 'child' => array(
						array('url' => 'devList', 'tag' => 'devList', 'name' => '开发者管理', 'show' => 1, 'child' => array()),
						array('url' => 'devAttaList', 'tag' => 'devAttaList', 'name' => '开发者文件管理', 'show' => 1, 'child' => array()),
					)),
					array('name' => '权限系统', 'show' => 1, 'style' => 3, 'child' => array(
						array('url' => 'permissionsList', 'tag' => 'permissionsList', 'name' => '权限管理', 'show' => 1, 'child' => array()),
						array('url' => 'userGroupList', 'tag' => 'userGroupList', 'name' => '用户组', 'show' => 1, 'child' => array()),
						array('url' => 'userList', 'tag' => 'userList', 'name' => '用户管理', 'show' => 1, 'child' => array()),
					)),
				);
