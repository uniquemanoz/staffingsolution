/*function checkSubdomainExists(subDomain) {
	
	var handlerSuccess;
	var response;
	
	var postArray = '{"identifier":"'+subDomain+'"}';
		
	$.ajax({	
		type: "POST",
		async: false,
		url: '/php/public_ajax_handler.php?type=check_business_id_exists',
		data: ({ postArray: postArray }),	
		dataType: "json",	
		error: function(XMLHttpRequest, textStatus, errorThrown) {
     		alert(textStatus + ', ' + errorThrown);
  		},
		success: function(data){
												
			if (data.success === 1) {
			
				handlerSuccess = true;
			
				if (data.message.identifier_exists === 1) {
					response = 1;
				} else {
				response = 0;
				}
			
			} else {
				handlerSuccess = false;
			}
						
		}
		
	});
	
	if (handlerSuccess === true) {
		if (response === 1) {
		return false;	
		} else {
		return true;	
		}
	} else {
	return false;	
	}
}
*/

/* TOGGLE HTML TEXT FUNCTION ".toggleText()" */
$.fn.toggleText = function(t1, t2) {
    if (this.text() == t1) this.text(t2);
    else this.text(t1);
    return this;
};
