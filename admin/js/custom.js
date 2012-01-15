jQuery.noConflict();

window.onscroll = function()
{
    if( window.XMLHttpRequest ) {
        if (document.documentElement.scrollTop > 0 || self.pageYOffset > 0) {
            jQuery('#primary_left').css('position','fixed');
            jQuery('#primary_left').css('top','0');
        } else if (document.documentElement.scrollTop < 0 || self.pageYOffset < 0) {
            jQuery('#primary_left').css('position','absolute');
            jQuery('#primary_left').css('top','175px');
        }
    }
}

function initMenu() {
    jQuery('#menu ul ul').hide();
	jQuery('#child_ul_current').show('fast');
	jQuery('#menu ul li').click(function() {
		jQuery(this).parent().find("ul").slideUp('fast');
		jQuery(this).parent().find("li").removeClass("current");
		jQuery(this).find("ul").slideToggle('fast');
		jQuery(this).toggleClass("current");
  });
}
 
	var point = '';
function _gp_fade(obj, method, message, gtime) {
	switch(method) {
		case 'success':point = '成功！';break;
		case 'warning':point = '警告！';break;
		case 'error':point = '错误！';break;
		case 'info':point = '提示！';break;
		case 'message':point = '信息！';break;
		case 'download':point = '下载！';break;
	}
	var html = '';
	html += '<div class="notification '+method+'" style="cursor: auto; position: fixed; top: 20px; z-index: 999; width: 78%;">';
	html += '<span></span>';
	html += '<div class="text">';
	html += '<p><b>'+point+'</b>'+message+'</p>';
	html += '</div>';
	html += '</div>';
	jQuery(obj).html(html);
	window.setTimeout(function(){
		jQuery(obj).children('.'+method).animate({opacity: 1.0}, gtime).fadeOut("slow", function(){
			//隐藏时把元素删除
			jQuery(this).remove();
		});
	}, gtime);
}

function _gp_countDown(url, t) {
    document.getElementById('counter').innerHTML = t;
    t --;
    if (t <= 0) window.location = url;
    else setTimeout('_gp_countDown("'+url+'", '+t+')',1000);
}

jQuery(document).ready(function() {
	
	Cufon.replace('h1, h2, h5, .notification strong', { hover: 'true' }); // Cufon font replacement
	initMenu(); // Initialize the menu!
	
	jQuery('#dialog').dialog({
		autoOpen: false,
		width: 650,
		buttons: {
			"确认": function() { 
				jQuery(this).dialog("close"); 
			}
		}
	}); // Default dialog. Each should have it's own instance.
			
	jQuery('.dialog_link').click(function(){
		jQuery('#dialog').dialog('open');
		return false;
	}); // Toggle dialog
	
	jQuery('.notification').hover(function() {
 		jQuery(this).css('cursor','pointer');
 	}, function() {
		jQuery(this).css('cursor','auto');
	}); // Close notifications
			
	jQuery('.checkall').click(
		function(){
			jQuery(this).parent().parent().parent().parent().find("input[type='checkbox']").attr('checked', jQuery(this).is(':checked'));   
		}
	); // Top checkbox in a table will select all other checkboxes in a specified column
			
	jQuery('.iphone').iphoneStyle(); //iPhone like checkboxes

	//全选/反选
	jQuery('.selall').click(function(){
		if (jQuery(this).attr('title') == '全选') {
			jQuery('.selme').each(function(){
				var $elem = jQuery(this).attr('checked', true).change();
			});
			jQuery(this).attr('title', '取消全选');
		} else {
			jQuery('.selme').each(function(){
				var $elem = jQuery(this).attr('checked', false).change();
			});
			jQuery(this).attr('title', '全选');
		}
	});

	jQuery('.notification span').click(function() {
		jQuery(this).parents('.notification').fadeOut(800);
	}); // Close notifications on clicking the X button
			
	jQuery(".tooltip").easyTooltip({
		xOffset: -60,
		yOffset: 70
	}); // Tooltips! 
			
	jQuery('#menu li:not(".current"), #menu ul ul li a').hover(function() {
		jQuery(this).find('span').animate({ marginLeft: '5px' }, 100);
	}, function() {
		jQuery(this).find('span').animate({ marginLeft: '0px' }, 100);           
	}); // Menu simple animation
			
	jQuery('.fade_hover').hover(
		function() {
			jQuery(this).stop().animate({opacity:0.6},200);
		},
		function() {
			jQuery(this).stop().animate({opacity:1},200);
		}
	); // The fade function
			
	//sortable, portlets
	jQuery(".column").sortable({
		connectWith: '.column',
		placeholder: 'ui-sortable-placeholder',
		forcePlaceholderSize: true,
		scroll: false,
		helper: 'clone'
	});
				
	jQuery(".portlet").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all").find(".portlet-header").addClass("ui-widget-header ui-corner-all").prepend('<span class="ui-icon ui-icon-circle-arrow-s"></span>').end().find(".portlet-content");

	jQuery(".portlet-header .ui-icon").click(function() {
		jQuery(this).toggleClass("ui-icon-minusthick");
		jQuery(this).parents(".portlet:first").find(".portlet-content").toggle();
	});

	jQuery(".column").disableSelection();
	
	jQuery("table.stats").each(function() {
		if(jQuery(this).attr('rel')) { var statsType = jQuery(this).attr('rel'); }
		else { var statsType = 'area'; }
		
		var chart_width = (jQuery(this).parent().parent(".ui-widget").width()) - 60;
		jQuery(this).hide().visualize({		
			type: statsType,	// 'bar', 'area', 'pie', 'line'
			width: '800px',
			height: '240px',
			colors: ['#6fb9e8', '#ec8526', '#9dc453', '#ddd74c']
		}); // used with the visualize plugin. Statistics.
	});
			
	jQuery(".tabs").tabs(); // Enable tabs on all '.tabs' classes
	
	jQuery( ".datepicker" ).datepicker({
		dateFormat: 'yy年mm月dd',  //日期格式，自己设置
		closeText: '关闭',
		prevText: '&#x3c;上月',
		nextText: '下月&#x3e;',
		currentText: '今天',
		monthNames: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
		monthNamesShort: ['一','二','三','四','五','六','七','八','九','十','十一','十二'],
		dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
		dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
		dayNamesMin: ['日','一','二','三','四','五','六'],
		weekHeader: '周',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: '年',
	});
	
	jQuery(".editor").cleditor({
		width: '800px'
	}); // The WYSIWYG editor for '.editor' classes
	
	// Slider
	jQuery(".slider").slider({
		range: true,
		values: [20, 70]
	});
				
	// Progressbar
	jQuery(".progressbar").progressbar({
		value: 40 
	});
});

