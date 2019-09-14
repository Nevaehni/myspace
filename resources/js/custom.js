//Like Function
function like(id_user, token)
{
    $.ajax({
        type: "POST",
        url: id_user,
        data: { id_user, _token: token},
        success: function (response) 
        {   
            console.log(response)
        },
    });
}

function edit()
{    
    document.getElementById('editPageRedirect').click();
}

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
    $("#imgInp").change(function() {
    readURL(this);
});

function uploadImg()
{    
    document.getElementById('imgInp').click();
}