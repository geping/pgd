/*
 * 常用JS函数
 *
 */

// 初始化全局变量
var domain_info = ''; //承载查询返回的json数据
var __is_login = 'false';
var _edit_obj;
var _edit_val = '';
var _pagesize = 20, _page = 1;

//返回头部
function baktop() {
    var o = $(".head");
    var offset = o.offset();
    var sctop = $(document).scrollTop();
    var w = $(".head").width();
    var h = $(window).height();
    if (sctop > 100) {
        $("#bak_top").css({
            left: offset.left + w - 25,
            top: h + sctop - 86,
            position: "absolute",
            zIndex: "999",
            cursor: "pointer",
            display: "block"
        });
    } else {
        $("#bak_top").hide();
    }

}
$(function (){
    $(window).scroll(baktop);
    $(window).resize(baktop);
})

function gototop() {
    var sctop = $(document).scrollTop();
    $('html,body').animate({
        scrollTop: '0px'
    },1500);
}


$(function() {
    $('.operator').mouseover(function(){
        $('.operator ul').show();
        $('.operator ul li').mouseover(function(){
            $(this).css('background', '#E3E3E3');
        });
        $('.operator ul li').mouseout(function(){
            $(this).css('background', '#ffffff');
        });
    });
    $('.operator').mouseout(function(){
        $('.operator ul').hide();
    });
    
})

$(document).ready(function(){
    //各种初始化
    Administry.setup();
    
    //登录错误提示初始化
    $('#login_error_point').hide();
    
    //版图信息表 --- 显示块初始化
    $('#show_container').hide();
    $('#show_head').click(function(){
        show_piece_effect($('#show_container'));
    });
    
    $('#top_pagesize').change(function(){
        _page = 1;
        _pagesize = parseInt($(this).val());
        bantuxinxibiao_ajax(_pagesize, _page);
    });

});

//版图信息表ajax
function bantuxinxibiao_ajax(pagesize, page) {
    $.ajax({
        type:   'GET',
        url:    '?c=home&m=indexAjax',
        data:   'pagesize='+pagesize+'&pages='+page,
        beforeSend:loading('load'),
        success:function(domain) {
            if (domain == 0) {
                $('#load').html('加载失败').removeClass('load').addClass('load_error');
                return false;
            }
            if (domain == -1) {
                $('#load').html('没有该查询下的数据，<a href="javascript:;" onclick="history.go(-1)">请返回</a>').removeClass('load').addClass('load_error').width(178);
                return false;
            }
            var incapt = eval('('+domain+')');
            domain_info = incapt['main'];
            //拆分
            var pages = incapt['pages'];
            var _tab_whole = bantuxinxibiao_create_tab_first(domain_info);
            create_page(pages);
            $('#tab_body').html(_tab_whole);
            //全选、反选
            $('#select_or_select').click(function(){
                if ($(this).is(':checked')) {
                    $('.sos').attr('checked', 'checked');
                } else {
                    $('.sos').removeAttr('checked');
                }
            });
            if (__is_login == 'true') {
                edit_val();
                table_click();
                del_note();
                create_bat_btn('bat_opera');
            }
            gototop();
            mouse_hover();
            btn_x();
            btn_s();
            return true;
        }
    });
}

//版图信息表 --- 显示表格
function bantuxinxibiao_create_tab_first(tab_data) {
    //获取需要列配置
    var _tab_show_json = $('#init_show_data').html();
    __is_login = $('#init_show_data').attr('class');
    var _tab_init = eval('('+_tab_show_json+')');
    return bantuxinxibiao_create_tab(tab_data, _tab_init);
}

//版图信息表 --- 生成表格
function bantuxinxibiao_create_tab(tab_data, _tab_init) {
    var _tab_whole = '<table class="bt_tab" cellspacing="0">';

    var _init_length = _tab_init.length;
    //生成第一行
    _tab_whole += '<tr class="bt_tab_th" id="bt_float">';
    if (__is_login == 'true') {
        _tab_whole += '<td><div><input type="checkbox" id="select_or_select" /></div></td>';
    }
    for(var i = 0; i < _init_length; i++) {
        if(_tab_init[i]['show'] == 1) {
            _tab_whole += '<td><div>'+_tab_init[i]['comment']+'</div></td>';
        }
    }
    if (__is_login == 'true') {
        _tab_whole += '<td>操作</td>';
    }
    //生成第一行结束
    _tab_whole += '</tr>';
    
    //生成表数据
    var tab_length = tab_data.length;
    for(i = 0; i < tab_length; i++) {
        var _tab_col_style = '';
        if (i % 2 == 0) {
            _tab_col_style = 'class="bt_tab_tr1 tr_marker"';
        } else {
            _tab_col_style = 'class="bt_tab_tr0 tr_marker"';
        }
        var tmp_id = tab_data[i]['id'];
        _tab_whole += '<tr '+_tab_col_style+' id="tr'+tmp_id+'">';
        if (__is_login == 'true') {
            _tab_whole += '<td class="e_no"><div><input type="checkbox" id="s'+tmp_id+'" class="sos" /></div></td>';
        }
        for(var j = 0; j < _init_length; j++) {
            if(_tab_init[j]['show'] == 1) {
                var _tab_field = _tab_init[j]['field'];
                if(_tab_field == 'id') {
                    _tab_whole += '<td class="e_no"><div>'+tab_data[i][_tab_field]+'</div></td>';
                } else {
                    _tab_whole += '<td class="doub" delay="'+tmp_id+_tab_init[j]['field']+'"><div title="'+_tab_init[j]['comment']+'" name="'+_tab_init[j]['field']+'" class="'+tmp_id+'">'+tab_data[i][_tab_field]+'</div></td>';
                }
            }
        }
        if (__is_login == 'true') {
            _tab_whole += '<td class="e_no">[<a href="javascript:;" id="d'+tmp_id+'" class="delete">删除</a>]</td>';
        }
        _tab_whole += '</tr>';
    }
    //生成表格结束
    _tab_whole += '</table>';
    
    $('.show_filed').click(function(){
        $('#tab_body').html(reform_tab());
    });

    return _tab_whole;
}

//版图信息表 --- 生成分页
function create_page(pages) {
    $('#pages').html(pages);
    $('.gpages').click(function(){
        _page = parseInt($(this).attr('lang'));
        bantuxinxibiao_ajax(_pagesize, _page);
    });
    return true;
}

//版图信息表 --- 重组表格
function reform_tab() {
    var checked_arr = new Array();
    var tab_data = '';
    var i = 0;
    $('.show_filed').each(function(){
        var show_check = $(this).find('input');
        if (show_check.is(':checked')) {
            checked_arr[i] = new Array();
            checked_arr[i]['field'] = show_check.attr('name');
            checked_arr[i]['comment'] = show_check.attr('class');
            checked_arr[i]['show'] = 1;
            i++;
        }
    });
    tab_data = bantuxinxibiao_create_tab(domain_info, checked_arr);
    return tab_data;
}

//鼠标经过行
function mouse_hover() {
    var old = '';
    $('.tr_marker').mousemove(function(){
        old = $(this).css('background');
        $(this).css({
            background: "url(/images/marked_bg.png) repeat-x", 
            height:"27px", 
            "line-height":"27px"
        });
        $(this).mouseout(function(){
            $(this).css({
                background: old
            });
        });
    });
}

function create_bat_btn(obj) {
    var html = '', content = '';
    content = '<input type="button" id="bat_del" class="x_btn" value="批量删除" />';
    html = '<div>'+content+'</div>';
    $('#'+obj).html(html);
    click_btn();
    return true;
}

function click_btn() {
    $('#bat_del').click(function(){
        var click_num = '';
        $('.sos').each(function(i){
            if ($(this).is(':checked')) {
                click_num += $(this).attr('id').substring(1) + ',';
            }
        });
        if (click_num == '') {
            alert('请选择要删除的记录');
        } else {
            del_ajax(click_num);
        }
    });
    return;
}

function btn_x() {
    $('input[type="button"]').mousedown(function(){
        $(this).css({
            background: "url(/images/x_btn_bg_on.png)"
        })
    });
}

function btn_s() {
    $('input[type="button"]').mouseup(function(){
        $(this).css({
            background: "url(/images/x_btn_bg.png)"
        })
    });
}

//编辑数据
function edit_val() {
    $('.doub').dblclick(function(){
        if (check_edit()) return false;
        var edit_div = $(this).find('div');
        var id = edit_div.attr('class');
        var val = _edit_val = edit_div.html();
        var name = edit_div.attr('name');
        var title = edit_div.attr('title');
        var width = edit_div.width() - 2;
        
        //生成input
        var input = '<input type="text" name="'+name+'" title="'+title+'" id="e'+id+'" class="e'+id+'" value="'+val+'" style="width:'+width+'px;height:25px; border:0px;" />';
        edit_div.html(input);
        $('#e'+id+'').focus();
        $('#e'+id+'').keyup(function(e){
            if (e.which == 13) {
                var input_val = $(this).val();
                //keyworded();
                edit_ajax(id, name, input_val, edit_div, val);
            // 敲击回车的时候，自动跳到下一个单元格
            /*
                if (check_edit()) {
                    var td_index = edit_div.parent().index();
                    var next_td = edit_div.parent().next();
                    alert(next_td.html());
                }
                */
            }
        });
    //document.onkeyup = showKeyUp(2);
    /*
         * 此处用于弹出层来进行修改
        var evt = getEvent();
        var edit_div = $(this).find('div');
        _edit_obj = edit_div;
        var id = edit_div.attr('class');
        var val = edit_div.html();
        var name = edit_div.attr('title');
        var field = edit_div.attr('name');
        var html = '<div><lebal for="'+id+'">'+name+'：</lebal><input type="text" class="'+field+'" id="'+id+'" value="'+val+'" /></div>';
        TINY.box.show(html,0,0,0,0,evt.clientX, evt.clientY);
        */
    //Alive(edit_div, id, field, val);
    });
}

//检测编辑框是否只有一个
function check_edit() {
    if ($('input[class^="e"]').length > 0) {
        return true;
    } else {
        return false;
    }
}

//编辑框中按下回车以后
function keyworded(keycode) {
    alert(keycode);
}

//编辑数据
function edit_data() {
    var cpiece = $('#tinycontent');
    var edit_id = cpiece.find('input').attr('id');
    var edit_field = cpiece.find('input').attr('class');
    var edit_val = cpiece.find('input').val();
    edit_ajax(edit_id, edit_field, edit_val);
}

function edit_ajax(id, field, val, parent_div, old_val) {
    $.ajax({
        type:   "GET",
        url:    "?c=home&m=indexEdit",
        data:   'id='+id+'&field='+field+'&val='+val,
        success:function(msg){
            if (msg == -1 || msg == -2) {
                alert('操作有误，修改失败');
                parent_div.html(old_val);
            }
            if (msg == 0) {
                alert('修改数据失败，请联系管理员');
                parent_div.html(old_val);
            }
            if (msg == 1) {
                parent_div.html(val);
            }
        }
    });
    return;
}

//当存在编辑框，鼠标点击表格
function table_click() {
    $('body').click(function(){
        if ($('input[class^="e"]').length == 1) {
            var input = $('input[class^="e"]');
            var old_val = input.html
            var td = input.parent().parent();
            var delay = td.attr('delay');
            if ($(this).attr('delay') != delay) {
                var id = input.attr('id').substr(1);
                var name = input.attr('name');
                var val = input.val();
                edit_ajax(id, name, val, input.parent(), _edit_val);
            }
        }
    });
}

//编辑 --- 另一种展现
function Alive(obj, id, field, val) {
    var width = obj.width() - 3 + 'px';
    var html = '<input type="text" style="width:'+width+';border:1px #ff0000 solid" class="'+field+'" name="'+id+'" value="'+val+'" />';
    obj.html(html);
}

//删除记录
function del_note() {
    $('.delete').click(function(){
        if(confirm('你确定要删除该条数据吗？')) {
            var id = parseInt($(this).attr('id').substr(1));
            var ids = id;
            del_ajax(ids);
        }
        return false;
    });
}

//删除记录Ajax
function del_ajax(ids) {
    $.ajax({
        type:   'GET',
        url:    '?c=home&m=indexDel',
        data:   'ids='+ids,
        success:function(msg) {
            if (msg == -1) {
                alert('操作有误，删除失败');
                return false;
            }
            if (msg == 0) {
                alert('删除数据失败，请联系管理员');
                return false;
            }
            bantuxinxibiao_ajax(_pagesize, _page);
        }
    });
}

//版图信息表 --- 显示块效果
function show_piece_effect(obj){
    if (obj.is(':hidden')) {
        obj.show();
    } else {
        obj.hide();
    }
}

//点击登录按钮
$(function(){
    $('#login_submit').click(function(){
        var username_val = $('#username').val();
        var password_val = $('#password').val();
        if (username_val == '' || password_val == '') {
            $('#login_error_point').html('请输入帐号或密码').slideDown("slow");
            return false;
        } else {
            $('#login_error_point').hide();
        }
    });
});

function loading(div_id) {
    $('.'+div_id).html('<div id="load" class="load">正在载入数据...</div>');
}

//版图信息表 --- 表格头漂
(function($){
    $.fn.capacityFixed = function(options) {
        var opts = $.extend({},$.fn.capacityFixed.deflunt,options);
        var FixedFun = function(element) {
            var top = opts.top;
            $(window).scroll(function() {
                var scrolls = $(this).scrollTop();
                if (scrolls > top) {
                    if (window.XMLHttpRequest) {
                        element.css({
                            position: "fixed",
                            top: 0							
                        });
                    } else {
                        element.css({
                            top: scrolls
                        });
                    }
                }else {
                    element.css({
                        //position: "absolute",
                        top: top
                    });
                }
            });
        };
        return $(this).each(function() {
            FixedFun($(this));
        });
    };
    $.fn.capacityFixed.deflunt={
        right : 100,//相对于页面宽度的右边定位
        top:150,
        pageWidth : 960
    };
})(jQuery);

//弹出层
var TINY={};

function T$(i){
    return document.getElementById(i)
}

TINY.box=function(){
    var p,m,b,fn,ic,iu,iw,ih,ia,f=0,x,y;
    return{
        show:function(c,u,w,h,a,xz, yz, t){
            //c--内容, u--是否加载外部页面(1=加载;0=不加载), w--宽度, h--高度, a--初始化时是否先显示一个加载样式（一个空白图层）, t--自动消失的时间
            if(!f){
                p=document.createElement('div');
                p.id='tinybox';
                m=document.createElement('div');
                m.id='tinymask';
                b=document.createElement('div');
                b.id='tinycontent';
                document.body.appendChild(m);
                document.body.appendChild(p);
                p.appendChild(b);
                m.onclick=TINY.box.hide;
                window.onresize=TINY.box.resize(xz,yz);
                f=1
            }
            if(!a&&!u){
                p.style.width=w?w+'px':'auto';
                p.style.height=h?h+'px':'auto';
                p.style.backgroundImage='none';
                b.innerHTML=c
            }else{
                b.style.display='none';
                p.style.width=p.style.height='100px'
            }
            this.mask();
            ic=c;
            iu=u;
            iw=w;
            ih=h;
            ia=a;
            this.alpha(m,1,80,3,xz,yz);
            if(t){
                setTimeout(function(){
                    TINY.box.hide()
                },1000*t)
            }
        },
        fill:function(c,u,w,h,a,xz,yz){
            if(u){
                p.style.backgroundImage='';
                var x=window.XMLHttpRequest?new XMLHttpRequest():new ActiveXObject('Microsoft.XMLHTTP');
                x.onreadystatechange=function(){
                    if(x.readyState==4&&x.status==200){
                        TINY.box.psh(x.responseText,w,h,a,xz,yz)
                    }
                };
                x.open('GET',c,1);
                x.send(null)
            }else{
                this.psh(c,w,h,a,xz,yz)
            }
        },
        psh:function(c,w,h,a,xz,yz){
            if(a){
                if(!w||!h){
                    var x=p.style.width, y=p.style.height;
                    b.innerHTML=c;
                    p.style.width=w?w+'px':'';
                    p.style.height=h?h+'px':'';
                    b.style.display='';
                    w=parseInt(b.offsetWidth);
                    h=parseInt(b.offsetHeight);
                    b.style.display='none';
                    p.style.width=x;
                    p.style.height=y;
                }else{
                    b.innerHTML=c
                }
                this.size(p,w,h,4,xz,yz)
            }else{
                p.style.backgroundImage='none'
            }
        },
        hide:function(){
            edit_data();
            TINY.box.alpha(p,-1,0,5)
        },
        resize:function(xz,yz){
            TINY.box.pos(xz,yz);
            TINY.box.mask()
        },
        mask:function(){
            m.style.height=TINY.page.theight()+'px';
            m.style.width='';
            m.style.width=TINY.page.twidth()+'px'
        },
        pos:function(xz,yz){
            var t=(TINY.page.height()/2)-(p.offsetHeight/2);
            t=t<10?10:t;
            p.style.top=yz + TINY.page.top() - TINY.page.divheight() + 'px';//(t+TINY.page.top())+'px';
            p.style.left=xz - TINY.page.divwidth()/2 + 'px';//(TINY.page.width()/2)-(p.offsetWidth/2)+'px'
        },
        alpha:function(e,d,a,s,xz,yz){
            clearInterval(e.ai);
            if(d==1){
                e.style.opacity=0;
                e.style.filter='alpha(opacity=0)';
                e.style.display='block';
                this.pos(xz,yz)
            }
            e.ai=setInterval(function(){
                TINY.box.twalpha(e,a,d,s,xz,yz)
            },20)
        },
        twalpha:function(e,a,d,s,xz,yz){
            var o=Math.round(e.style.opacity*100);
            if(o==a){
                clearInterval(e.ai);
                if(d==-1){
                    e.style.display='none';
                    e==p?TINY.box.alpha(m,-1,0,3,xz,yz):b.innerHTML=p.style.backgroundImage=''
                }else{
                    e==m?this.alpha(p,1,100,5,xz,yz):TINY.box.fill(ic,iu,iw,ih,ia,xz,yz)
                }
            }else{
                var n=o+Math.ceil(Math.abs(a-o)/s)*d;
                e.style.opacity=n/100;
                e.style.filter='alpha(opacity='+n+')'
            }
        },
        size:function(e,w,h,s,xz,yz){
            e=typeof e=='object'?e:T$(e);
            clearInterval(e.si);
            var ow=e.offsetWidth, oh=e.offsetHeight,
            wo=ow-parseInt(e.style.width), ho=oh-parseInt(e.style.height);
            var wd=ow-wo>w?-1:1, hd=(oh-ho>h)?-1:1;
            e.si=setInterval(function(){
                TINY.box.twsize(e,w,wo,wd,h,ho,hd,s,xz,yz)
            },20)
        },
        twsize:function(e,w,wo,wd,h,ho,hd,s,xz,yz){
            var ow=e.offsetWidth-wo, oh=e.offsetHeight-ho;
            if(ow==w&&oh==h){
                clearInterval(e.si);
                p.style.backgroundImage='none';
                b.style.display='block'
            }else{
                if(ow!=w){
                    e.style.width=ow+(Math.ceil(Math.abs(w-ow)/s)*wd)+'px'
                }
                if(oh!=h){
                    e.style.height=oh+(Math.ceil(Math.abs(h-oh)/s)*hd)+'px'
                }
                this.pos(xz,yz)
            }
        }
    }
}();

TINY.page=function(){
    return{
        top:function(){
            return document.body.scrollTop||document.documentElement.scrollTop
        },
        width:function(){
            return self.innerWidth||document.documentElement.clientWidth
        },
        height:function(){
            return self.innerHeight||document.documentElement.clientHeight
        },
        theight:function(){
            var d=document, b=d.body, e=d.documentElement;
            return Math.max(Math.max(b.scrollHeight,e.scrollHeight),Math.max(b.clientHeight,e.clientHeight))
        },
        twidth:function(){
            var d=document, b=d.body, e=d.documentElement;
            return Math.max(Math.max(b.scrollWidth,e.scrollWidth),Math.max(b.clientWidth,e.clientWidth))
        },
        divheight:function(){
            return $('#tinybox').height();
        },
        divwidth:function(){
            return $('#tinybox').width();
        }
    }
}();

// 获得事件Event对象，用于兼容IE和FireFox
function getEvent() {
    return window.event || arguments.callee.caller.arguments[0];
}