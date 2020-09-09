$(document).ready(function(){
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
    var showCustomerTable =  function( callback ){
    $.ajax({
          type:"POST", 
          url:"/Admins/fetchCustomers",
          data:"view-customer-btn=true",
          dataType:"json",
          encode:true,
         })
        .done( function(response){

          callback(response);
        })
        .fail( function(response){
          
          console.log(response);
        })   
   };

   var customerListBtn = document.getElementById('view-customer-btn');

   customerListBtn.addEventListener('click', function(){

        showCustomerTable( function(response){
          console.log(response.success.message.length);
          
          if (response.success) {

            var customers = response.success.message;

            if(customers.length <= 0 )
            {
                console.log('No customers');
                return;
            }

            var customersTable = '<table class="table table-striped">' +

            '<thead>' +

            '<tr><th>SN</th><th>First name</th><th>Last name</th><th>Email</th></tr>' + 
            '</thead>' +

            '<tbody>'; 

            $.each( customers, function(i,customer){

              customersTable += '<tr><td>' + (i+1) + '.</td>' +

              '<td>' + customer.firstname + '</td>' +

              '<td>' + customer.lastname + '</td>' +

              '<td>' + customer.email + '</td></tr>';

            });

            customersTable += '</tbody></table>';

            var customerDetail = '<div>' +
                    '<div class="row">' +
                      '<div class="col-12">' +
                        '<div class="card">' +
                          '<div class="card-header">' +
                            '<h3 class="card-title">Customer Table</h3>' +
                          '</div>' +
                          '<!-- /.card-header -->' +
                          '<div class="card-body table-responsive p-0">' +
                          customersTable +
                          '</div>' +
                          '<!-- /.card-body -->' +
                        '</div>' +
                        '<!-- /.card -->' +
                      '</div>' +
                    '</div>' +
                  '</div>';

            $('#my-modal').find('h4.modal-title').html('Customer Details');

            $('#my-modal').find('div.modal-body').html(customerDetail);

            $('#my-modal').modal("show");
          }
          else
          {
              toastr.options = toastrOptions;
              
              toastr['error']( response.error, 'Error');
          }
        });
   }); 
  
});










 