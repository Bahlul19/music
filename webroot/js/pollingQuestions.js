$(document).ready(function(){

 // Add new element
 $(".add").click(function(){

  // Finding total number of elements added
  var total_element = $(".inputText").length;
 console.log(total_element);
  // last <div> with element class id
  var lastid = $(".inputText:last").attr("id");console.log(lastid);
  var split_id = lastid.split("_");
  var nextindex = Number(split_id[1]) + 1;

  var max = 10;
  // Check total number elements
  if(total_element < max ){
   // Adding new div container after last occurance of element class
   $(".inputText:last").after("<div class='inputText' id='div_"+ nextindex +"'></div>");
 
   // Adding element to <div>
   $("#div_" + nextindex).append("<input type='text'  name='answer' class='form-control' placeholder='Enter your Answer' id='txt_"+
    nextindex +"'>&nbsp;<span id='remove_" + nextindex + "' class='remove'>X</span>");
 
  }
 
 });

 // Remove element
 $('.answerText').on('click','.remove',function(){
 
  var id = this.id;
  var split_id = id.split("_");
  var deleteindex = split_id[1];

  // Remove <div> with id
  $("#div_" + deleteindex).remove();

 }); 
});
