
jQuery(document).ready(function($){
    $('.activate-user').on('click',function(){
        var id=$(this).attr('activate');
        $.ajax({
            data:{
                action: 'ActivateUser',
                id:id,
            },
            url:ajaxurl,
            method:'POST',
            success: function(response){
                if(response.success== true) {
                    alert("User Activated");
                    window.location=document.location.href;
                 }
                 else {
                    alert("User Not Activated");
                 }
            }

        });
    })
})