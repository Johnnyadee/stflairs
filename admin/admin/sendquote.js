// $(document).ready(function() {
//     alert('I am working');
// });

$('#sub-btn').click(function() {

    var name = $('#name').val();
    var email = $('#email').val();
    var source = $('#source').val();
    var destination = $('#destination').val();
    var message = $('#messsage').val();

    if (name != "" && email != "" && source != "" && destination != "" && message != "") {
        $.ajax({
            url: "sendquote.php",
            type: "POST",
            data: {
                type: 1,
                name: name,
                email: email,
                source: source,
                destination: destination,
                message: message
            },
            cache: false,
            success: function(dataResult) {
                var dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode == 200) {
                    alert("Quote submitted Successfully");
                } else {
                    alert("Quote sending failed.")
                }

            }
        });
    } else {
        alert('Please fill all the field !');
    }
});