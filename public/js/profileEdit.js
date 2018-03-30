$(document).ready(function() {
	$("#add_members").click(function() {
		$("#group_member_list").append(
			"<div><label class='col-md-4 control-label'>成员(姓名+身份证)：</label>"
			+ "<div class='col-md-6 half-item'>"
			+ "<input type='text' class='form-control-half' style='width:30%' name='family_member_name' value='' title='输入姓名'>"
			+ "<div class='space'></div>"
			+ "<input type='text' class='form-control-half' style='width:50%;' name='family_member_identi_card' value='' title='输入身份证号'>"
			+ "<div class='space'></div>"
			+ "<a  class='remove_members' name='remove_btn' href='#'>移除</a>"
			+ "</div>"
			+ "</div>");
		bindListener();
	});

	bindListener();

	$('#submit_info_btn').click(function() {
		$(this).attr("disabled", true);
		var familyMemberNames = $("[name='family_member_name']");
		var familyMemberIDs = $("[name='family_member_identi_card']");

		var size = familyMemberNames.size();
		var familyMemberJson="";
		var shouldSubmit = true;
		var number = 0;

		for (var i=0; i<size; i++) {
			var name = familyMemberNames[i].value;
			var ID = familyMemberIDs[i].value;
			if (isEmpty(name) && isEmpty(ID)) {
				continue;
			} else if(!isEmpty(name) && !isEmpty(ID)) {
				if(i==0){
					familyMemberJson='{"name":"' + name + '","identi_card":"' + ID + '"}';
				} else {
					familyMemberJson += ',{"name":"' + name + '","identi_card":"' + ID + '"}';
				}

				number++;
			} else {
				if(isEmpty(name)) {
					familyMemberNames[i].focus();
				} else {
					familyMemberIDs[i].focus();
				}

				shouldSubmit = false;
				break;
			}
		}

		if (shouldSubmit) {
			familyMemberJson = "[" + familyMemberJson + "]";
			$("#family_members").val(familyMemberJson);
			$("#family_numbers").val(number);

			$("form").submit();
		}

		$(this).attr("disabled", false);
	});
});

function isEmpty(str) {
	return str==null || str=="";
}

function bindListener(){
	$("a[name=remove_btn]").unbind().click(function(){
		$(this).parent().parent().remove();
	});

	$("input[name='family_member_name']").poshytip({
		className: 'tip-yellowsimple',
		showOn: 'focus',
		alignTo: 'target',
		alignX: 'inner-left',
		offsetX: 0,
		offsetY: 5,
		showTimeout: 100
	});

	$("input[name='family_member_identi_card']").poshytip({
		className: 'tip-yellowsimple',
		showOn: 'focus',
		alignTo: 'target',
		alignX: 'inner-left',
		offsetX: 0,
		offsetY: 5,
		showTimeout: 100
	});
}
