$(document).ready(function() {
	$("span[name=delete_user]").unbind().click(function(){
		var id = $(this).attr('attr');
		var target = this;
		$.ajax({
			url:'admin/user/' + id + '/delete',
			type:'GET',
			cache:false,
			success:function(data){
				if(data == id) {
					$(target).parent().parent().remove();
				}
			}/*,
			error:function(data) {       
		          writeObj(data);    
		    }  */  
		});
	});

	$("span[name=edit_user]").unbind().click(function(){
		var id = $(this).attr('attr');
		location.href = 'admin/user/' + id + '/edit';
	});

	$("span[name=view_user]").unbind().click(function(){
		var id = $(this).attr('attr');
		location.href = 'admin/user/' + id + '/view';
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