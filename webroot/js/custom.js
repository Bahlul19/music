 //for emoji
        function validateAudio(){
             var fileExtension = ['mp3'];
                if ($.inArray($("#audio #audio").val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    alert("Only mp3 format is allowed ");
                    return false;
                }

        }
 $(document).ready(function(){
  $("#textbox").emojioneArea({
           pickerPosition: "top"
});
});

//loading image when submitting value
 $(document).ready(function(){
    $('#form1').bind("keypress", function(e) {
      if (e.keyCode == 13) {
        e.preventDefault();
        return false;
      }
    });
    $('select#country-id').val(231);
});

 //loading the gif when page load

$(document).ready(function() {
  setTimeout(function(){ $('.second-wrap').css('display', 'block');
  $('.first-wrap').css('display', 'none');
  $('.first-wrap').css('overflow', 'hidden'); }, 2000);
})
