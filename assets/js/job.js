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
    var enableSearch = function( searchFirstName,callback){

        $.ajax({
          type:"POST", 
          url:"/task/enableSearch",
          data: "firstname=" + searchFirstName +"&search-btn=true",
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

    var searchFirstNameButton = document.getElementById('searchFirstName-btn');

      searchFirstNameButton.addEventListener( 'click', function(){

        var form = $(this).closest('form');

        $('input[name=owner-name]', form ).val( '' );

        $('input[name=owner-phone]', form ).val( '' );

        $('input[name=owner-name]', form ).data( 'customer-id', '' );

        var searchFirstName = document.getElementById('searchFirstName').value;
        
          enableSearch( searchFirstName, function( response ){
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

              '<td><button type="button" class="btn btn-success apply-btn" data-customer-firstname="' + customer.firstname + '" data-customer-lastname="' + customer.lastname + '" data-customer-phone="' + customer.phone + '">Apply</button></td></tr>';

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
  var sendJobDetails = function( form, callback )
  {

      var formData = new FormData(form);

      formData.append('create_job', true );

      var xhttp = new XMLHttpRequest();

      xhttp.onreadystatechange = function(){

        if( this.readyState==4  && this.status==200 )
            {
              callback( this.response );
            }
        }

      xhttp.responseType = 'json';

      xhttp.open("POST", "/task/createJobProfile", true);

      xhttp.setRequestHeader("Accept", "application/json");
              
      xhttp.send( formData );
  };

  var saveJobButton = document.getElementById('create_job');

    saveJobButton.addEventListener( 'click', function(){

      var form = $(this).closest('form');

      var customerId =  $('input[name=owner-name]', form ).data('customer-id');

      console.log(customerId);

      var jobDataForm = document.getElementById('job-data-form');


        toastr.options = toastrOptions;
        
        toastr['info']('Connecting...please wait', 'Connecting');

        sendJobDetails( jobDataForm, handleAjaxResponse );

    });




   


