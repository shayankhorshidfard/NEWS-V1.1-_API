jQuery(document).ready(function ($) {
    $('#sendAjaxRequest').on('click', function (event) {

        $.ajax({
            url:'/wp-admin/admin-ajax.php',
            type:'post',
            dataType: 'json',
            data:{
                action: 'calculate_operation',
                numberOne: 25,
                numberTwo: 87
            },
            success:function (response) {
                alert(response.result);
            }
            error:function (error) {}
        });

    });

});