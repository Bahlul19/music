$(function () {
    $('.datatable').DataTable({
      bJQueryUI : true,
      bDestroy : true,
      aaSorting : [[0, 'desc']]});
    
  })

$('.sendFeedbackReply').click(function() {
$('#fbRecepient').val($(this).data('email'));
$('#fbid').val($(this).data('id'));
});

//onchange video and audio
 $(document).ready(function(){
    $("#media-link").on("input", function(){
         $("#mediaupload").html($(this).val());
    });
    });
