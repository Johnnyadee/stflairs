$(document).ready(function($) {
    var list_target_id = 'email'; //first select list ID
    var list_select_id = 'username'; //second select list ID
    var initial_target_html = 'Customer email...'; //Initial prompt for target select

    $('#' + list_target_id).val(initial_target_html); //Give the target select the prompt option
    $('#' + list_select_id).change(function(e) {

        //Grab the chosen value on first select list change
        var selectvalue = $(this).val();


        //Display 'loading' status in the target textfields
        $('#' + list_target_id).val('Loading value...');

        if (selectvalue == "") {
            //Display initial prompt in target select if blank value selected
            $('.' + list_target_id).val(initial_target_html);
        } else {
            
            $('#'+list_target_id).val(selectvalue);
        }
    });
});

$(document).on('click', '#sendmail', function(e) {
    data = $('#mail_sending_form').serialize();
   
   $.ajax({
        data: data,
        type: "post",
        url: "sendmail.php",
        success: function(dataResult) {
             dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                alert('Email Sent successfully !');
                location.reload();
            } else if (dataResult.statusCode == 201) {
                alert(dataResult.error);
            }
        }
    });

});


