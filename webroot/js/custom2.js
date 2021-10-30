function cancel()
{
    $("#overlay").hide();
}
function closeProgressBar(){
  $.ajax({
    url : "/DynamicPage/closeProgressBarSetSession",
    success: function(){
        $(".progress-bar-card").hide();
    }
  });
}

function addlike(counter,id,type){

    if(type == 1)
    {
        var controller = 'NotificationLikes';
    }
    else
    {
        var controller = 'Likes';
    }

    $.ajax({url: "/"+controller+"/hitlike/"+id, success: function(result){
   var data = JSON.parse(result);
   console.log(data);
    if(data.status == 1)
    {
        if(type == 1)
        {
            console.log("#likes_"+id);
            $("#likes_"+id).html(data.count);
        }
        else
        {
            console.log("#mlikes_"+id);
            $("#mlikes_"+id).html(data.count);
        }
    }
  }});
}

function comment(counter , id , type)
{
    if(type == 1)
    {
        var controller = 'NotificationComments';
    }
    else
    {
        var controller = 'MediaComments';
    }
    if($("#comment_"+id+"_"+type).val() == '')
    {
        alert("Comment cannot be Empty");
        return false;
    }
   $.ajax({url: "/"+controller+"/comment/",
    data :{ id: id,comment:$("#comment_"+id+"_"+type).val() },
    type: 'POST',
    beforeSend: function (xhr)
    {
      xhr.setRequestHeader('X-CSRF-Token', $('#csrf').val());
    },
    success: function(result){
   var data = JSON.parse(result);
    if(data.status == 1)
    {
            $("#latestcomment_"+id+"_"+type).append('<div class="comments">'+$("#comment_"+id+"_"+type).val()+' - <span class="label label-default"><b> You </b></span></div>');
            $("#comment_"+id+"_"+type).val('');

    }
  }});

}

function searchFriends(eventPassed)
{
    $.ajax({url: "/DynamicPage/searchFriends/"+eventPassed.value, success: function(result){
    $("#contact-list").html(result);
  }});
}


function searchArtists()
{
    if($("#contact-list-search").val().length >= 3)
    {
        if($("input[name='search_criteria']:checked").val() == null || $("input[name='search_criteria']:checked").val() == 'Artists')
        {
            $.ajax({url: "/DynamicPage/searchArtists/"+$("#contact-list-search").val(), success: function(result){
                $("#contact-list").html(result);
            }});
        }
        else
        {
            $.ajax({url: "/DynamicPage/searchArtistsFilter/"+$("#contact-list-search").val()+"/"+$("input[name='search_criteria']:checked").val(), success: function(result){
                $("#contact-list").html(result);
            }});
        }


    }
    if($("#contact-list-search").val().length < 3)
        $("#contact-list").html('');
}


  $( function() {

document.getElementById("file-wall").onchange = function() {
    document.getElementById("form-wall").submit();
};
document.getElementById("file-photo").onchange = function() {
    document.getElementById("form-photo").submit();
};
document.getElementById("file-profile-image").onchange = function() {
    document.getElementById("form-profile-img").submit();
};
$(document).on('click','#file-video-trigger',function(){

    $("#overlay").show();
    $("#video-select").show();
    $("#audio-select").hide();
    $("#overlay").focus();
});
$(document).on('click','#file-audio-trigger',function(){
    $("#overlay").show();
    $("#audio-select").show();
    $("#video-select").hide();
    $("#overlay").focus();
});


    $( "#datepicker" ).datepicker({
        'dateFormat': 'dd-mm-yy',
        maxDate : 0,
        changeMonth: true,
        changeYear: true,
        yearRange: '-100:+0'
    });
 } );

  function submitData(media_id, user_id)
  {
        var file_data = $("#medias-name").prop("files")[0]; // Getting the properties of file from file field
        console.log($("#medias-name").prop("files")[0]['name']);
        var imagename = $("#medias-name").prop("files")[0]['name'];

        var ext = imagename.split(".");
        ext = ext[ext.length-1].toLowerCase();
        var arrayExtensions = ["jpg" , "jpeg", "png"];

        // image validation
        if (arrayExtensions.lastIndexOf(ext) == -1) {
            alert("Only jpeg and png files are allowed.");
            return false;
        }
        // end
      var form_data = new FormData(); // Creating object of FormData class
      form_data.append("file", file_data) // Appending parameter named file with properties of file_field to form_data
      form_data.append("user_id", user_id) // Adding extra parameters to form_data
      $.ajax({
        url: '/medias/saveProfileImage/'+media_id, // Upload Script
        headers : {
          'X-CSRF-Token': $('[name="_csrfToken"]').val()
       },
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data, // Setting the data attribute of ajax with file_data
        type: 'post',
        success: function(data) {
           location.reload();
           //$("#profile-img").html('<img src="webroot/files\userData/"'+ user_id +'"\profileImg/'+ data +'" alt="'+ data +'"></img>');
        }
      });
  }

function submitProfileformData(event){
  event.preventDefault();
  var firstname = $('#users-first-name').val();var lastname = $('#users-last-name').val();var email = $('#users-email').val();var username = $('#users-username').val();var address = $('#users-address').val();var city = $('#users-city').val();var zipcode = $('#users-zipcode').val();var contact = $('#users-mobie-phone').val();var country =  $('#users-country-id').val();var state =  $('#users-state-id').val();
  var regex = /^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i;
  var telregex =  /^[1-9]{1}[0-9]{9}$/;
  if(firstname == "" || lastname == "" || email == "" || username == "" || address == "" || city == "" || zipcode == "" || contact == "" || country == "" || state == ""){
      alert('Please fill mandatory details');
      }
      else if(!regex.test(email)){
      alert('Enter valid email address!');
      }
      else if(!telregex.test(contact)){
        alert('Enter valid contact number!');
        }
      else{
        $.ajax({
          url:'/profiles/saveAccountData/'+Number($('.id').val()),
          dataType: 'json',
          data: $('#userDataEdit').serializeArray(),
          type: "POST",
          success: function(data){
            location.reload();
          },
          error: function(passParams){
               // code here
          }
        });
      }
};


function ratepost(id,vid,counter,type)
{
   var arr = id.split('_');
   var i=1;
   for(i=1;i<=arr[3];i++)
   {
      $("#"+arr[0]+'_'+arr[1]+'_'+arr[2]+'_'+i).removeClass('empty-star');
      $("#"+arr[0]+'_'+arr[1]+'_'+arr[2]+'_'+i).addClass('full-star');
   }
   for(j=i;j<=5;j++)
   {
    $("#"+arr[0]+'_'+arr[1]+'_'+arr[2]+'_'+j).removeClass('full-star');
    $("#"+arr[0]+'_'+arr[1]+'_'+arr[2]+'_'+j).addClass('empty-star');
   }

   if(arr[0] == 'lratingstart')
   {
    return false;
   }

    if(type == 1)
    {
        var controller = 'NotificationRatings';
    }
    else
    {
        var controller = 'Ratings';
    }

    $.ajax({url: "/"+controller+"/giveRating/"+vid+'/'+arr[3], success: function(result){
   var data = JSON.parse(result);
   console.log(data);
    if(data.status == 1)
    {
        if(type == 0)
        {

            ratepost('lratingstart_'+arr[1]+'_'+arr[2]+'_'+data.count,vid,counter,type);
            $("#ratingbox_"+arr[1]+'_'+arr[2]).hide();
        }
        else
        {
            //alert('lratingstart_'+arr[1]+'_'+data.count+'_'+vid+'_'+counter+'_'+type);
            ratepost('lratingstart_'+arr[1]+'_'+arr[2]+'_'+data.count,vid,counter,type);
            $("#ratingbox_"+arr[1]+'_'+arr[2]).hide();
            }
    }
  }});


}

function delete_post($id){
  if (confirm("Do you want to delete")) {
  $.ajax({
          type: "POST",
          url: "/notifications/delete/"+$id,
          headers : {
         'X-CSRF-Token': $('[name="_csrfToken"]').val()
        },
          success: function(data){
                    location.reload();
          },
       });
      }
 }
 function delete_media($id){
  if (confirm("Do you want to delete")) {
  $.ajax({
          type: "POST",
          url: "/media-metas/delete/"+$id,
          headers : {
         'X-CSRF-Token': $('[name="_csrfToken"]').val()
        },
          success: function(data){
                    location.reload();
          },
       });
      }
 }
