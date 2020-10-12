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

      if( null !== response && ! response.success )
      {
          toastr.options = toastrOptions;

          toastr['error']( response.error.message, response.error.title );
      }
      else if( null !== response && ! response.error )
      {
          toastr.options = toastrOptions;

          toastr['success'](response.success.message, response.success.title );
      }
  }


$(document).ready(function(){
    var enableSearch = function( searchLastName,callback){

        $.ajax({
          type:"POST", 
          url:"/task/enableSearch",
          data: "lastname=" + searchLastName +"&search-btn=true",
          dataType:"json",
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
    };

    var searchLastNameButton = document.getElementById('searchLastName-btn');

      searchLastNameButton.addEventListener( 'click', function(){

        var form = $(this).closest('form');

        $('input[name=owner-name]', form ).val( '' );

        $('input[name=owner-phone]', form ).val( '' );

        $('input[name=owner-name]', form ).data( 'customer-id', '' );

        var searchLastName = document.getElementById('searchLastName').value;
        
          enableSearch( searchLastName, function( response ){
            console.log(response);
            
            
           if(response.success)
           {

              var customers = response.success.message;

              if(customers.length <= 0 )
              {
                console.log('zero search');
                return;
              }
              
              var customersTable = '<table class="table table-striped">' +

              '<thead>' +

              '<tr><th>SN</th><th>Firstname</th><th>Lastname</th><th>Phone no.</th><th></th></tr>' + 
              '</thead>' +

              '<tbody>'; 

              $.each( customers, function(i,customer){

              customersTable += '<tr><td>' + (i+1) + '.</td>' +

              '<td>' + customer.firstname + '</td>' +

              '<td>' + customer.lastname + '</td>' +

              '<td>' + customer.phone + '</td>' +

              '<td><button type="button" class="btn btn-success apply-btn" data-customer-firstname="' + customer.firstname + '" data-customer-lastname="' + customer.lastname + '" data-customer-phone="' + customer.phone + '" data-customer-id="' + customer.customer_id + '">Apply</button></td></tr>';

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

              $('#my-modal').find('h4.modal-title').html('search results');

              $('#my-modal').find('div.modal-body').html(customerDetail);

              $('#my-modal').modal("show");

              $('button.apply-btn').on('click', function(event){

                $('input[name=owner-name]', form ).val(  $(this).data('customer-firstname') + " " + $(this).data('customer-lastname') );

                $('input[name=owner-phone]', form ).val(  $(this).data('customer-phone') );

                $('input[name=owner-name]', form ).data( 'customer-id', $(this).data('customer-id') );                

                $('#my-modal').modal("hide");

                console.log( $(this).data('customer-firstname') );
              });
            }
            else if (response.error) 
            {
              toastr.options = toastrOptions;

              toastr['error']( response.error.message, response.error.title );
            }

         });
      });
  });
 
var sendJobDetails = function(ownerName, ownerPhone, jobTitle, deviceName,deviceDescription,deviceID, fault, price,customerId, callback ){
  $.ajax({
          type:"POST", 
          url:"/task/createJob",
          data:"owner-name=" + ownerName + "&owner-phone=" + ownerPhone + "&job-title=" + jobTitle + "&device-name=" + deviceName + "&device-description=" + deviceDescription + "&device-id=" + deviceID + "&fault=" + fault + "&price=" + price + "&customerId=" + customerId + "&create_job=true",
          dataType:"json",
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
};
$("#create_job").on('click', function(event){

  var form = $(this).closest('form');

  var customerId =  $('input[name=owner-name]', form ).data('customer-id');

  console.log(customerId);

  sendJobDetails($("#owner-name").val(), $("#owner-phone").val(), $("#job-title").val(), $("#device-name").val(),$("#device-description").val(),$("#device-id").val(),$("#fault").val(),$("#price").val(), customerId, function(response){
    
    if(response.success)
    {
      toastr.options = toastrOptions;

      toastr['success']( response.success.message, response.success.title );
    }
    else
    {
      toastr.options = toastrOptions;

      toastr['error']( response.error.message, response.error.title );
    }
  } );
});

   


