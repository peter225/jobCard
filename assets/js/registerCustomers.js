var toastrOptions = {
              "closeButton": true,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-top-center", //"toast-top-center", "toast-top-full-width", 
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "1000",
              "hideDuration": "1000",
              "timeOut": "0",
              "extendedTimeOut": "10000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            };

var handleAjaxResponse = function( response ){

      
      toastr.clear();

      if(  ! response.success )
      {
          toastr.options = toastrOptions;

          toastr['error']( response.error.message, response.error.title );
      }
      else if( ! response.error )
      {
          toastr.options = toastrOptions;

          toastr['success'](response.success.message, response.success.title );

          window.location = response.login;
      }
  }


var registerCustomers = function( form, callback )
{

      var formData = new FormData(form);

      formData.append('register_customer', true );

      var xhttp = new XMLHttpRequest();

      xhttp.onreadystatechange = function(){

        if( this.readyState==4  && this.status==200 )
            {
              callback( this.response );
            }
        }

      xhttp.responseType = 'json';

      xhttp.open("POST", "/registerCustomers/registerCustomer", true);

      xhttp.setRequestHeader("Accept", "application/json");
              
      xhttp.send( formData );
};

    var registerCustomerButton = document.getElementById('register_customer');

    registerCustomerButton.addEventListener( 'click', function(){

    var customerDataForm = document.getElementById('customer-data-form');

      toastr.options = toastrOptions;
          
      toastr['info']('Connecting...please wait', 'Connecting');
        //submitButton.setAttribute('disabled', true);
      registerCustomers( customerDataForm, handleAjaxResponse );

    });

   