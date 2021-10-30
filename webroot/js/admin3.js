jQuery(document).ready(function(){
	jQuery('.countryID').on('change', function(){
		var country_id = jQuery(this).val();
		jQuery.ajax({
			type: 'POST',
			url: '/admin/Users/stateDropdown',
			data: country_id,
			dataType: 'json',
			beforeSend: function (xhr) 
			{
        		xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
 			},
			success: function(response)
			{
				var stateList = '';
				for(var i in response) {
					stateList += '<option value="'+response[i].id+'">' + response[i].name + '</option>';
                 }
				jQuery('.stateID option').remove();
				jQuery('.stateID').html(stateList);
			},
			error: function(err){
				console.log(err);
			}
		});
	});
});
