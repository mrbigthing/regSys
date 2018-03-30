$(document).ready(function() {
	var countItem = $("#total_count");
	var id = countItem.attr('attr');
	$.ajax({
		url:'/activity/' + id + '/registrationCount',
		type:'GET',
		cache:false,
		success:function(data){
			countItem.text(data);
		},
		error:function(data) {       
	          writeObj(data);    
	    }  
	});
});

function writeObj(obj){ 
    var description = ""; 
    for(var i in obj){   
        var property=obj[i];   
        description+=i+" = "+property+"\n";  
    }   
    alert(description); 
} 