			<div id="primary_right">
				<div class="inner" style="margin-top:100px;">
					<hr />
					<div class="clearboth"></div>
                    <div style="width:100%;">
                        <div style="width: 50%; margin:0 auto;">
                            <div class="two_third2">
                                <div class="portlet">
                                    <div class="portlet-header"><?php echo $body['title']; ?><span style="float:right;"><label id="counter"></label>秒后自动跳转</span></div>
                                    <div class="portlet-content" style="display: block;">
                                        <div><?php echo $body['message']; ?></div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
					<hr />
					<div class="clearboth"></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->

<script type="text/javascript">
	_gp_countDown('<?php echo $body['url']; ?>', <?php echo $body['gtime']; ?>);
</script>
