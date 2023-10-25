
//This code ensures that the About Us data shows in the modal edit form
$(document).on('click', '.edit_production', function(e) {
    var id = $(this).attr("data-id");
    var prodid = $(this).attr("data-prodid");
    var cementquantity = $(this).attr("data-cementquantity");
    var stonedustquantity = $(this).attr("data-stonedustquantity");
    var quantityproduced = $(this).attr("data-quantityproduced");
    var date = $(this).attr("data-date");
   
    // This part fetches display the products
    var list_target_id = 'prodid_u'; //This is the select list box to be populated
    var initial_target_html = '<option value="">Select Product...</option>'; //Initial prompt for target select

    $('#'+list_target_id).html(initial_target_html); //Give the target select the prompt option

    $.ajax({url: 'getproducts.php?current_product='+prodid,
        success: function(output) {
            //alert(output);
            $('#'+list_target_id).html(output);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status +" "+ thrownError);
	    }
    });

    $('#id_u').val(id);
    $('#cement_quanity_u').val(cementquantity);
    $('#sd_quantity_u').val(stonedustquantity);
    $('#quantity_produced_u').val(quantityproduced);
    $('#detail_u').val(date);

});


// This code makes an ajax call to really update the database table
$(document).on('click', '#update_production', function(e) {
    var data = $("#update_productionform").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $('#editProductionModal').modal('hide');
                alert('The Production was updated successfully !');
                location.reload();
            } else if (dataResult.statusCode == 201) {
                alert(dataResult.error);
            }
        }
    });
});

//This code ensures that the Site/Org Profile data shows in the modal edit form
$(document).on('click', '.addproduction', function(e) {
    // This part fetches display the products
    var list_target_id = 'prodid'; //This is the select list box to be populated
    var initial_target_html = '<option value="">Select Product...</option>'; //Initial prompt for target select

    $('#'+list_target_id).html(initial_target_html); //Give the target select the prompt option

    $.ajax({url: 'getproducts2.php',
        success: function(output) {
            $('#'+list_target_id).html(output);
        },
        error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status + " "+ thrownError);
	}});
});

// This code makes an ajax call to really update the database table
$(document).on('click', '#recordnew_production', function(e) {
    var data = $("#addnew_productionform").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $('#addProductionModal').modal('hide');
                alert('New Production recorded successfully !');
                location.reload();
            } else if (dataResult.statusCode == 201) {
                alert(dataResult.error);
            }
        }
    });
});

//This code ensures that Website's statistics data shows in the modal edit form
$(document).on('click', '.edit_expenses', function(e) { 
    var id = $(this).attr("data-id");
    var catid = $(this).attr("data-catid");
    var description = $(this).attr("data-description");
    var totalamount = $(this).attr("data-totalamount");
    var date = $(this).attr("data-date");
   
    // This part fetches display the products
    var list_target_id = 'catid_u'; //This is the select list box to be populated
    var initial_target_html = '<option value="">Select Expense Category...</option>'; //Initial prompt for target select

    $('#'+list_target_id).html(initial_target_html); //Give the target select the prompt option

    $.ajax({url: 'getExpenseCategories.php?current_cat='+catid,
        success: function(output) {
            //alert(output);
            $('#'+list_target_id).html(output);
        },
        error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status + " "+ thrownError);
	}});

    $('#id_u').val(id);
    $('#catid_u').val(catid);
    $('#description_u').val(description);
    $('#amount_u').val(totalamount);
    $('#date_u').val(date);

});

// This code makes an ajax call to really update the database table 
$(document).on('click', '#update_expenses', function(e) {
    var data = $("#update_expensesform").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult) {
                dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $('#editExpenseModal').modal('hide');
                alert('Expense record updated successfully !');
                location.reload();
            } else if (dataResult.statusCode == 201) {
                alert(dataResult.error);
            }
        }
    });
});


//This code ensures 
$(document).on('click', '.addexpenses', function(e) {
    // This part fetches display the products
    var list_target_id = 'catid'; //This is the select list box to be populated
    var initial_target_html = '<option value="">Select Category...</option>'; //Initial prompt for target select

    $('#'+list_target_id).html(initial_target_html); //Give the target select the prompt option

    $.ajax({url: 'getExpenseCategories2.php',
        success: function(output) {
            $('#'+list_target_id).html(output);
        },
        error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status + " "+ thrownError);
	}});
});


// This code makes an ajax call to really update the database table
$(document).on('click', '#recordnew_expense', function(e) {
    var data = $("#recordnew_expenseform").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $('#addExpenseModal').modal('hide');
                alert('New Expense recorded successfully !');
                location.reload();
            } else if (dataResult.statusCode == 201) {
                alert(dataResult.error);
            }
        }
    });
});

//This code ensures that the Edit sales modal pops up having the details of the particular instance of sales to be edited 
$(document).on('click', '.edit_sales', function(e) {  
    var id = $(this).attr("data-id");
    var paymentmethod = $(this).attr("data-paymentmethod");
    var description = $(this).attr("data-description");
    var quantity = $(this).attr("data-quantity");
    var amount = $(this).attr("data-amount");
    var amount_paid = $(this).attr("data-amountpaid");
    var date = $(this).attr("data-date");


    // This part fetches display the products
    var list_target_id = 'payment_method'; //This is the select list box to be populated
    var initial_target_html = '<option value="">Select Payment Method...</option>'; //Initial prompt for target select

    $('#'+list_target_id).html(initial_target_html); //Give the target select the prompt option

    $.ajax({url: 'getPaymentMethod.php?current_pm='+paymentmethod,
        success: function(output) {
            //alert(output);
            $('#'+list_target_id).html(output);
        },
        error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status + " "+ thrownError);
	}});

    $('#id_u').val(id);
    $('#description_u').val(description);
    $('#quantity_u').val(quantity);
    $('#amount_u').val(amount);
    $('#amountpaid_u').val(amount_paid);
    $('#balance_u').val(amount - amount_paid);
    $('#date_u').val(date);

});

// This code makes an ajax call to really update the donation table in the database
$(document).on('click', '#update_sales', function(e) {
    var data = $("#update_salesform").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult) {
                dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $('#editSalesModal').modal('hide');
                alert('Sales details updated successfully !');
                location.reload();
            } else if (dataResult.statusCode == 201) {
                alert(dataResult.error);
            }
            
        }
    });
});


// This section codes the retrieval of a given customers price for a partcular product 
 // I am to code the change event of the total amount and amount paid
$(document).on('keyup', '#quantity', function(e){
    var customerid = $('#customerid').val();
    var productid =$('#productid').val();
    var quantity = $('#quantity').val();

    $.ajax({url: 'getCustomerPrice.php?customerid='+customerid+'&productid='+productid+'&quantity='+quantity,
        success: function(output) {
            //alert(output);
            $('#amount').val(output);
        },
        error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status + " "+ thrownError);
	}});

});


// I am to code the change event of the total amount and amount paid
$(document).on('keyup', '.calc', function(e) {
    var amount = parseFloat($('#amount').val());
    var amountpaid =parseFloat($('#amountpaid').val());
    if(amountpaid>amount){
        alert('Invalid Calculation');
        $('#amountpaid').val("");
        $('#balance').val("");
    }
    else{
        $('#balance').val(amount - amountpaid);
    }
});

$(document).on('click', '.load_customers', function(e) {  

    // This part fetches populates the names of customers
    var list_target_id = 'customerid'; //This is the select list box to be populated
    var initial_target_html = '<option value="">Select Customer ...</option>'; //Initial prompt for target select

    $('#'+list_target_id).html(initial_target_html); //Give the target select the prompt option

    $.ajax({url: 'getAllCustomers.php',
        success: function(output1) {
            //alert(output);
            $('#'+list_target_id).html(output1);
        },
        error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status + " "+ thrownError);
	}});

    // This part fetches and populates the products sold by the company
    var list_target_id2 = 'productid'; //This is the select list box to be populated
    var initial_target_html2 = '<option value="">Select Product ...</option>'; //Initial prompt for target select

    $('#'+list_target_id2).html(initial_target_html2); //Give the target select the prompt option

    $.ajax({url: 'getproducts2.php',
        success: function(output2) {
            //alert(output);
            $('#'+list_target_id2).html(output2);
        },
        error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status + " "+ thrownError);
	}});


    


});

// This code makes an ajax call to record new sales into the database table
$(document).on('click', '#recordnew_sales', function(e) {
    var data = $("#recordnew_salesform").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $('#addSalesModal').modal('hide');
                alert('New Sales recorded successfully !');
                location.reload();
            } else if (dataResult.statusCode == 201) {
                alert(dataResult.error);
            }
        }
    });
});

//retrieve the field of the raw materials and display them in the modal
$(document).on('click', '.edit_rawmaterial', function(e) {
    var id = $(this).attr("data-id");
    var title = $(this).attr("data-title");
    var quantity = $(this).attr("data-quantity");
    var measureunit = $(this).attr("data-measureunit");
    
    $('#id_u').val(id);
    $('#title_u').val(title);
    $('#quantity_u').val(quantity);
    $('#measureunit_u').val(measureunit);
    
});


// This code makes an ajax call to really update the database table 
$(document).on('click', '#update_rawmaterial', function(e) {
    var data = $("#update_rawmaterialform").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult) {
                dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $('#editRawMaterialModal').modal('hide');
                alert('Raw Materials updated successfully !');
                location.reload();
            } else if (dataResult.statusCode == 201) {
                alert(dataResult.error);
            }
        }
    });
});


// This code makes an ajax call to really update the database table
$(document).on('click', '#recordnew_rawmaterial', function(e) {
    var data = $("#recordnew_rawmaterialform").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $('#addRawMaterialModal').modal('hide');
                alert('New Raw Material recorded successfully !');
                location.reload();
            } else if (dataResult.statusCode == 201) {
                alert(dataResult.error);
            }
        }
    });
});

//retrieve the fields of a customer and display them in the modal

$(document).on('click', '.edit_customer', function(e) {
    var id = $(this).attr("data-id");
    var firstname = $(this).attr("data-firstname");
    var lastname = $(this).attr("data-lastname");
    var email = $(this).attr("data-email");
    var phone = $(this).attr("data-phone");
    var country = $(this).attr("data-country");
    var address = $(this).attr("data-address");
    var city = $(this).attr("data-city");
    
    $('#id_u').val(id);
    $('#firstname_u').val(firstname);
    $('#lastname_u').val(lastname);
    $('#email_u').val(email);
    $('#phone_u').val(phone);
    $('#country_u').val(country);
    $('#address_u').val(address);
    $('#city_u').val(city);
});

// This code makes an ajax call to really update the database table
$(document).on('click', '#update_customer', function(e) {
    var data = $("#update_customerform").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $('#editCustomerModal').modal('hide');
                alert('Customer record updated successfully !');
                location.reload();
            } else if (dataResult.statusCode == 201) {
                alert(dataResult.error);
            }
        }
    });
});


// This code makes an ajax call to really update the database table
$(document).on('click', '#recordnew_customer', function(e) {
    var data = $("#recordnew_customerform").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $('#addCustomerModal').modal('hide');
                alert('New Customer recorded successfully !');
                location.reload();
            } else if (dataResult.statusCode == 201) {
                alert(dataResult.error);
            }
        }
    });
});

$(document).on('click', '.view_debt_details', function(e) {
    var customername = $(this).attr("data-customername");
    var customerid   = $(this).attr("data-customerid");

    $('#titledata').html("List of credit sale to "+customername);
    
    //make ajax call to fetch and populate the records of these debts
    $.ajax({url: 'getCreditSales.php?customerid='+customerid,
        success: function(output) {
            //alert(output);
            $('#debt_view_list').html(output);
        },
        error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status + " "+ thrownError);
	}});
});

//This code ensures that all the customers in the database are fetched and popluated on the list
//to enable the user select the particular customer that made an upfront payment
$(document).on('click', '.addupfrontpayment', function(e) {
    // This part fetches display the products
    var list_target_id = 'customerid'; //This is the select list box to be populated
    var initial_target_html = '<option value="">Select Customer Name...</option>'; //Initial prompt for target select

    $('#'+list_target_id).html(initial_target_html); //Give the target select the prompt option

    $.ajax({url: 'getAllCustomers.php',
        success: function(output) {
            $('#'+list_target_id).html(output);
        },
        error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status + " "+ thrownError);
	}});
});

// The code below inserts an upfront payment record into the database
$(document).on('click', '#recordnew_upfrontpayment', function(e) {
    var data = $("#recordnew_upfrontpaymentform").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $('#addNewUpfrontPaymentModal').modal('hide');
                alert('New Up-front Payment recorded successfully !');
                location.reload();
            } else if (dataResult.statusCode == 201) {
                alert(dataResult.error);
            }
        }
    });
});

//The code below lifts the data from that selected records and plant them on the edit form
$(document).on('click', '.edit_upfrontpayment', function(e) {
    var id = $(this).attr("data-id");
    var customername = $(this).attr("data-customername");
    var paymentdescription = $(this).attr("data-paymentdescription");
    var totalamount = $(this).attr("data-totalamount");
    var date =$(this).attr("data-date"); 
    var customerid = $(this).attr("data-customerid");   
    
    $('#id_u').val(id);
    $('#customername_u').val(customername);
    $('#customerid_u').val(customerid);
    $('#paymentdescription_u').val(paymentdescription);
    $('#totalamount_u').val(totalamount);
    $('#date_u').val(date);

});


// The code below inserts an upfront payment record into the database
$(document).on('click', '#update_upfrontpayment', function(e) {
    var data = $("#update_upfrontpaymentform").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $('#editUpfrontPaymentModal').modal('hide');
                alert('Up-front Payment updated successfully !');
                location.reload();
            } else if (dataResult.statusCode == 201) {
                alert(dataResult.error);
            }
        }
    });
});


$(document).on('click', '.view_credit_details', function(e) {
    var customername = $(this).attr("data-customername");
    var customerid   = $(this).attr("data-customerid");

    $('#titledata').html("List of credit sale to "+customername);
    //make ajax call to fetch and populate the records of these debts
    $.ajax({url: 'getCreditSales.php?customerid='+customerid,
        success: function(output) {
            //alert(output);
            $('#debt_view_list').html(output);
        },
        error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status + " "+ thrownError);
	}});
});

// This is the code that uses the customer ID to fetch sales recorded in the name
// The has not gotten an invoice ID.

$(document).ready(function($) {
    var list_target_id = 'invoicebody'; //first select list ID
    var list_select_id = 'customerid'; //second select list ID
    var initial_target_html = 'Invoice body loading...'; //Initial prompt for target select

    $('#' + list_target_id).val(initial_target_html); //Give the target select the prompt option
    
    $('#' + list_select_id).change(function(e) {
        //Grab the chosen value on first select list change
        var customerid = $(this).val();
        //Display 'loading' status in the target textfields
        $('#' + list_target_id).val('Sales by the selected customer is Loading value...');

        if (customerid == "") {
            //Display initial prompt in target select if blank value selected
            $('.' + list_target_id).val(initial_target_html);
        } else {
            $.ajax({url: 'getSalesDetails.php?customerid='+customerid,
                success: function(output) {
                    //alert(output);
                    $('#'+list_target_id).html("");
                    $('#'+list_target_id).html(output);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " "+ thrownError);
                }
            });
        }
    });


});



// The code ensures that the poped up deleted box contain customer ID
$(document).on("click", ".delete", function() {
    var id = $(this).attr("data-id");
    $('#id_d').val(id);

});

// The below deletes a particular customer record from the table customer
$(document).on("click", "#delete", function() {
    $.ajax({
        url: "save.php",
        type: "POST",
        cache: false,
        data: {
            type: 3,
            id: $("#id_d").val()
        },
        success: function(dataResult) {
            location.reload();
            $('#deleteCustomerModal').modal('hide');
            $("#" + dataResult).remove();

        }
    });
});


// The code ensures that the poped up deleted box contain customer ID
$(document).on("click", ".delete", function() {
    var id = $(this).attr("data-id");
    $('#id_d').val(id);
});


$(document).on("click", "#delete_multiple", function() {
    var user = [];
    $(".user_checkbox:checked").each(function() {
        user.push($(this).attr('data-id'));
    });
    if (user.length <= 0) {
        alert("Please select records.");
    } else {
        WRN_PROFILE_DELETE = "Are you sure you want to delete " + (user.length > 1 ? "these" : "this") + " row?";
        var checked = confirm(WRN_PROFILE_DELETE);
        if (checked == true) {
            var selected_values = user.join(",");
            $.ajax({
                type: "POST",
                url: "save.php",
                cache: false,
                data: {
                    type: 4,
                    id: selected_values
                },
                success: function(response) {
                    var ids = response.split(",");
                    for (var i = 0; i < ids.length; i++) {
                        $("#" + ids[i]).remove();
                    }

                },
                error: function(jqXhr, textStatus, errorMessage) { // error callback 
                    alert('Error: ' + errorMessage);
                }
            });
            location.reload();
        }
    }
});

$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function() {
        if (this.checked) {
            checkbox.each(function() {
                this.checked = true;
            });
        } else {
            checkbox.each(function() {
                this.checked = false;
            });
        }
    });
    checkbox.click(function() {
        if (!this.checked) {
            $("#selectAll").prop("checked", false);
        }
    });
});

// This code ensures that the particular image you wish to change shows up
$(document).on('click', '.update_image', function(e) {
    var src = $(this).attr("src");
    var id =$(this).attr("data-id");
    // var file_name = $(this).attr("file-name");
    
    $('#imgbox').attr('src',src);
    $('#id').val(id);
    $('#file_name').val()

});