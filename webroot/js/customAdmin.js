
    $("#profile-dob" ).datepicker({
        'dateFormat': 'dd-mm-yy',
        maxDate : 0,
        changeMonth: true,
        changeYear: true,
        yearRange: '-100:+0'
    });




function validateImage()
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
}
