			<div id="primary_right">
				<div class="inner">
					<ul class="dash">
						<li class="fade_hover tooltip" title="服务器信息">
							<a href="/index">
								<img src="/images/icons/dashboard/21.png" alt="" />
								<span>系统信息</span>
							</a>
						</li>
					</ul> <!-- end dashboard items -->
                    <div class="clearboth"></div>
					<hr />
					 <div class="sortable">
						<div class="two_third">
						  <div class="portlet">
							<div class="portlet-header">系统信息</div>
							<div class="portlet-content" style="display: block;">
							  <p><?php echo php_uname(); ?></p>
							</div>
						  </div>
						</div>
						<div class="two_third">
						  <div class="portlet">
							<div class="portlet-header">服务器类型</div>
							<div class="portlet-content" style="display: block;">
							  <p><?php echo $_SERVER['SERVER_SOFTWARE']; ?></p>
							</div>
						  </div>
						</div>
						<div class="two_third">
						  <div class="portlet">
							<div class="portlet-header">PHP版本</div>
							<div class="portlet-content" style="display: block;">
							  <p><?php echo 'PHP' . PHP_VERSION; ?></p>
							</div>
						  </div>
						</div>
						<div class="two_third">
						  <div class="portlet">
							<div class="portlet-header">Mysql版本</div>
							<div class="portlet-content" style="display: block;">
							  <p><?php echo 'MySQL' . mysql_get_server_info(); ?></p>
							</div>
						  </div>
						</div>
						<div class="two_third">
						  <div class="portlet">
							<div class="portlet-header">上传文件大小</div>
							<div class="portlet-content" style="display: block;">
							  <p><?php echo ini_get("upload_max_filesize"); ?></p>
							</div>
						  </div>
						</div>
					  </div> <!-- sortable end -->
					<hr />
					<div class="clearboth"></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
