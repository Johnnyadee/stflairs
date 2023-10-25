$(document).ready(function() {
    $('#butsaveuser').on('click', function() {
        $("#butsaveuser").attr("disabled", "disabled");
        var fullname = $('#fullname').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var repassword = $('#repassword').val();
        var email = $('#email').val();
        var wallet_address = $('#wallet_address').val();
        var referrer = $("#referrer").val();

        if (password !== repassword) {
            alert("Passwords do not match!!!")
        }

        if (fullname != "" && username != "" && password != "" && repassword != "" && wallet_address != "") {
            $.ajax({
                url: "saveuser.php",
                type: "POST",
                data: {
                    type: 1,
                    fullname: fullname,
                    username: username,
                    password: password,
                    email: email,
                    wallet_address: wallet_address,
                    referrer: referrer
                },
                cache: false,
                success: function(data) {

                    // var dataResult = JSON.parse(dataResult);
                    // if (dataResult.statusCode == 200) {
                    //     $("#butsaveuser").removeAttr("disabled");
                    //     alert('Registration successful !');
                    //     window.location = "client/dashboard.php";
                    // } else if (dataResult.statusCode == 201) {
                    //     $("#butsaveuser").removeAttr("disabled");
                    //     alert('The username you choose already exists !!!');
                    // } else {
                    //     $("#butsaveuser").removeAttr("disabled");
                    //     alert('error occured check mysqli error')
                    // }
                    alert(data);
                    window.location = "client/index.php";

                }
            });
        } else {
            alert('Please fill all the field !');
        }

    });

});