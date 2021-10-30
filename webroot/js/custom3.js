jQuery(document).ready(function(){
	var signupPage = jQuery('.countryID');
	if(signupPage.length)
	{
		var country_id = jQuery(".countryID").children("option").filter(":selected").val()
		jQuery.ajax({
			type: 'POST',
			url: '/Users/stateDropdown',
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
				jQuery('.signup.stateID option').remove();
				jQuery('.signup.stateID').html(stateList);
			},
			error: function(err){
				console.log(err);
			}
		});
	}


	jQuery('.countryID').on('change', function(){
		var country_id = jQuery(this).val();
		jQuery.ajax({
			type: 'POST',
			url: '/Users/stateDropdown',
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





	$("#image").on('change', function () {

	        if (typeof (FileReader) != "undefined") {
	        	$(".displayImage").remove();
	            var image_holder = $("#image-holder");
	            image_holder.empty();

	            var reader = new FileReader();
	            reader.onload = function (e) {
	                $("<img />", {
	                    "src": e.target.result,
	                    "class": "thumb-image"
	                }).appendTo(image_holder);

	            }
	            image_holder.show();
	            reader.readAsDataURL($(this)[0].files[0]);
	        } else {
	            alert("This browser does not support FileReader.");
	        }
	    });
});

        function validateAudio(){
             var fileExtension = ['mp3'];
                if ($.inArray($("#audio #audio").val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    alert("Only mp3 format is allowed ");
                    return false;
                }

        }

function nextTab(tabid){
    var tablist = {1 : 'contact-info-writer',2 : 'contact-info-group',3 : 'contact-info-group-description',4 : 'contact-info-terms-conditions'};
    $("#"+tablist[tabid]).removeClass("hide");
    for(var i=1; i < 5; i++){
        console.log(i);
        if(i != tabid)
            $("#"+tablist[i]).addClass("hide");
    }

}

function validateData()
{
    var requiredArray = ['artistname','city','state','signature','date'];
    var errorString = '';
    for(var i=0;i<requiredArray.length;i++){
        if($("#"+requiredArray[i]).val() == '' || $("#"+requiredArray[i]).val() == null){
            errorString = errorString + requiredArray[i].toUpperCase() + ',';
        }
    }
    if(errorString != '')
    {
        errorString = errorString + ' cannot be Empty'
        alert(errorString);
        return false;
    }
}
