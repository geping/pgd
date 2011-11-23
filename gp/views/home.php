<script type="text/javascript">
	bantuxinxibiao_ajax(_pagesize, _page);
</script>
<div class="tab_bar">&nbsp;
    <div class="show_piece">
        <div>
            <a class="show_head" id="show_head" href="javascript:;">显示</a>
        </div>
        <div id="show_container">
            <?php
            $front_is_login = $head['username'] !== '' ? 'true' : 'false';
            echo '<div style="display: none;" id="init_show_data" class="' . $front_is_login . '">' . json_encode($body['show_piece']) . '</div>';
            foreach ($body['show_piece'] as $key => $value) {
                ?>
                <div class="show_filed">
                    <input type="checkbox" name="<?php echo $value['field']; ?>" class="<?php echo $value['comment']; ?>" <?php
            if ($value['show'] === 1) {
                echo 'checked="checked"';
            }
                ?> id="<?php echo $value['field']; ?>" /><label for="<?php echo $value['field']; ?>"><?php echo $value['comment']; ?></lable>
                </div>
                <?php
            }
            ?>
        </div>

        <div class="clear"></div>
    </div>
    <div class="line"></div>
    <div id="top_page" class="top_page">
        <div class="tab_add_ons">附加操作</div>
        <div class="top_opera_piece" id="top_opera_piece">
            <div id="top_select_pagesize" class="top_select_pagesize">
                <label for="top_pagesize">请选择每页显示数：</label>
                <select id="top_pagesize">
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div id="bat_opera"></div>
        </div>
    </div>
    <div id="tab_body">
        <div id="load" class="load">正在载入数据...</div>
    </div>
    <!--
    <div id="but_page" class="but_page">
        <div id="but_select_pagesize" class="but_select_pagesize">
            <label for="but_pagesize">请选择每页显示数：</label>
            <select id="but_pagesize">
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>
    -->
    <div class="clear"></div>
    <div><div id="pages"></div></div>
</div>
