$(document).ready(function(){
    $("form#UesrRegister").on("submit", function(event){
        event.preventDefault();
        formdata=new FormData(this);
        $.ajax({
            data:formdata,
            action:'RegisterUser',
            url :ajaxobj.ajaxurl+"?action=RegisterUser",
            method:'POST',
            contentType: false,
            cache: false,
            processData:false,
            success:function(responce){
                if(responce.success==true){
                    alert(responce.data);
                    location.reload();
                }
                else{
                    alert(responce.data);
                }
            },
            error: function(res){
                alert(res.data);
            }
            
        });
    });
});