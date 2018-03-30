jQuery(function ($) { 
	$.datepicker.regional['zh-CN'] = { 
	closeText: '关闭', 
	prevText: '<上月', 
	nextText: '下月>', 
	currentText: '今天', 
	monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', 
	'七月', '八月', '九月', '十月', '十一月', '十二月'], 
	monthNamesShort: ['一', '二', '三', '四', '五', '六', 
	'七', '八', '九', '十', '十一', '十二'], 
	dayNames: ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'], 
	dayNamesShort: ['周日', '周一', '周二', '周三', '周四', '周五', '周六'], 
	dayNamesMin: ['日', '一', '二', '三', '四', '五', '六'], 
	weekHeader: '周', 
	dateFormat: 'yy-mm-dd', 
	firstDay: 1, 
	isRTL: false, 
	showMonthAfterYear: true, 
	yearSuffix: '年' ,
	Style:'blue'
	}; 
	$.datepicker.setDefaults($.datepicker.regional['zh-CN']); 
});

$(document).ready(function(){ 
	var datetime = new Date();
	var year = datetime.getFullYear();
	var month = datetime.getMonth() + 1 < 10 ? "0" + (datetime.getMonth() + 1) : datetime.getMonth() + 1;
	var date = datetime.getDate() < 10 ? "0" + datetime.getDate() : datetime.getDate();
	var dateText = year + "-" + month + "-" + date;

	$("#start_register_time").datepicker({
		onSelect: function(selectedDate){
			$("#end_register_time").datepicker("option", "minDate", selectedDate); 
	    	var endDateText = $("#end_register_time").val();

	    	if (endDateText!=null && endDateText!="") {
	    		if(endDateText < selectedDate) {
	    			$("#end_register_time").val('');
	    		}
	    	}
		}
    });
    
    $("#end_register_time").datepicker({
    	onSelect: function(selectedDate){
			$("#start_register_time").datepicker("option", "maxDate", selectedDate); 
	    	var startDateText = $("#start_register_time").val();

	    	if (startDateText!=null && startDateText!="") {
	    		if(startDateText > selectedDate) {
	    			$("#startDateText").val('');
	    		}
	    	}
    	}
    }); 
	$("#end_register_time").datepicker("option","minDate",dateText);
	$("#start_register_time").datepicker("option", "minDate", dateText);
	$("#start_register_time").datepicker("option", "showAnim", "slide"); 
    $("#end_register_time").datepicker("option", "showAnim", "slide");  
});  