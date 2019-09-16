//Like/unlike Function
function like(id_user, token)
{
    $.ajax({
        type: "POST",
        url: id_user,
        data: { id_user, _token: token},
        success: function (response) 
        {   
            alert(response)
            console.log(response)
        },
    });
}

//Edit page redirect button
function edit()
{    
    document.getElementById('editPageRedirect').click();
}

//Home page redirect button
function home()
{    
    document.getElementById('homePageRedirect').click();
}

//Display the image before uploading on the edit page
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            console.log(e);
            $('#profileImage').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
    $("#imageUpload").change(function() {
    readURL(this);
});

//Make image clickable to select the file to upload.
function uploadImg()
{    
    document.getElementById('imageUpload').click();
}