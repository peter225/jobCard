$(document).ready(function(){
	var updateCustomer = function(callback){
		$.ajax({
          type:"POST", 
          url:"/Admins/fetchCustomers",
          dataType:"text",
          encode:true
        })
        .done( function(response){

          callback(response);

        })
        .fail( function(error){

          console.log(error);

        })
        .always( function(response){

        })
        $(window).load(function(event){

        	updateCustomer(response);

        	var customerNo = response.success.message.length;

        	console.log(customerNo);
        
        	$('div.customerNo', document).val(customerNo);
        });
        
	};
	
 });