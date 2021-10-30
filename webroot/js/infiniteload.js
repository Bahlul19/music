var counter = 1;
var alreadycalled = 0;
var counterStop = 0;
var calledcounter = 0;
var alreadyAjax = 0;
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= ($(document).height() - 10)) {
            if(counterStop == 1)
            {

            }
            else
            {
                if($("#loaderdiv").length){

                }
                else{
                    var str1 = window.location.href;
                    var str2 = "mynotifications";
                    if(str1.indexOf(str2) != -1){
                        var action = "mynotifications";
                    }
                    else
                    {
                        if(str1.indexOf('view-profile') != -1)
                            var action = "myOthersNotifications";
                        else
                            var action = "viewAllNotifications";
                    }
                    if(action == "mynotifications" || action == "myOthersNotifications")
                            $("#myProfile").append('<div id="loaderdiv" style="text-align:center;"><img src="/files/Loader/30.gif"/></div>');
                        else{
                            $("#main-div").append('<div id="loaderdiv" style="text-align:center;"><img src="/files/Loader/30.gif"/></div>');                        }

                }
                alreadycalled = 1;
                if(calledcounter != counter)
                {
                    loadMoreData();
                    calledcounter = counter;
                }

            }

        }

    });


    function loadMoreData(){

    var str1 = window.location.href;
    var str2 = "mynotifications";
    if(str1.indexOf(str2) != -1){
        var action = "mynotifications";
    }
    else
    {
        if(str1.indexOf('edit-my-profile') != -1)
            var action = "mynotifications";
        else{
            if(str1.indexOf('view-profile') != -1)
                var action = "myOthersNotifications";
            else
                var action = "viewAllNotifications";
        }
    }

    if(action == "myOthersNotifications"){
        var urlCall = '/notifications/'+action+'/' +counter+'/'+$('#user_id').val();
    }
    else{
        var urlCall = '/notifications/'+action+'/' +counter;
    }
    console.log("Hit : "+alreadyAjax);
    if(alreadyAjax == 0){
            console.log("Hit Inside: "+alreadyAjax);
        alreadyAjax = 1;
      $.ajax(

            {

                url: urlCall,

                type: "get",

                beforeSend: function()

                {
                    $("#notificationid").remove();
                    $("#mediaid").remove();
                    $('.ajax-load').show();

                }

            })

            .done(function(data)

            {

                $('.ajax-load').hide();
                $("#loaderdiv").remove();
                if(data == 'Sorry, No more Notifications')
                {
                    counterStop = 1;
                    if( $('#nmn').length )         // use this if you are using id to check
                    {

                    }
                    else
                    {
                        if(action == "mynotifications" || action == "myOthersNotifications")
                            $("#myProfile").append('<h2 id="nmn" style="text-align:center;color:white;">'+data+'</h2>');
                        else{
                            $("#main-div").append('<h2 id="nmn" style="text-align:center;color:white;">'+data+'</h2>');
                            console.log("Complate Sorry, No more Notifications");
                        }
                    }
                }
                else
                {
                        if(action == "mynotifications" || action == "myOthersNotifications")
                            $("#myProfile").append(data);
                        else{
                            $("#main-div").append(data);
                            console.log("Complate Sorry, No more Notifications");
                        }
                }
                counter++;
                alreadycalled = 0;
                alreadyAjax = 0;

            })

            .fail(function(jqXHR, ajaxOptions, thrownError)

            {

                  alert('server not responding...');
                  alreadyAjax = 0;

            });
        }
    }
