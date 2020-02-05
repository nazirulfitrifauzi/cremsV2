demo = {

	showNotification: function(from, align, icon, message, type){

    	$.notify({
        	icon: icon,
        	message: message

        },{
            type: type,
            timer: 500,
            placement: {
                from: from,
                align: align
            }
        });
	}

}
