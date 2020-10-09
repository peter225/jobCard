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
    var showAdminsTable =  function( callback ){
    $.ajax({
          type:"POST", 
          url:"/superAdmins/fetchAdmins",
          data:"view-admin-btn=true",
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

   var adminListBtn = document.getElementById('view-admin-btn');

   adminListBtn.addEventListener('click', function(){

        showAdminsTable( function(response){
          console.log(response.success.message.length);
          
          if (response.success) {

            var admins = response.success.message;

            if(admins.length <= 0 )
            {
                console.log('No customers');
                return;
            }

            var adminsTable = '<table id="" class="table table-bordered table-striped example1">' +

            '<thead>' +

            '<tr><th>SN</th><th>First name</th><th>Last name</th><th>Email</th><th></th></tr>' + 
            '</thead>' +

            '<tbody>'; 

            $.each( admins, function(i,admin){

              adminsTable += '<tr><td>' + (i+1) + '.</td>' +

              '<td>' + admin.firstname + '</td>' +

              '<td>' + admin.lastname + '</td>' +

              '<td>' + admin.email + '</td>' + 

              '<td><button type="button" class="btn btn-danger"><i class="fas fa-trash"></i> Remove </button></td></tr>';

            });

            adminsTable += '</tbody></table>';

            var adminDetail = '<div>' +
                    '<div class="row">' +
                      '<div class="col-12">' +
                        '<div class="card">' +
                          '<div class="card-header">' +
                            '<h3 class="card-title">Customer Table</h3>' +
                          '</div>' +
                          '<!-- /.card-header -->' +
                          '<div class="card-body">' +
                          adminsTable +
                          '</div>' +
                          '<!-- /.card-body -->' +
                        '</div>' +
                        '<!-- /.card -->' +
                      '</div>' +
                    '</div>' +
                  '</div>';

            $('#my-modal').find('h4.modal-title').html('Admin Details');

            $('#my-modal').find('div.modal-body').html(adminDetail);

            $('#my-modal').modal("show");

             console.log($("table").is(".example1"));

            $("table.example1").DataTable({
              "responsive": true,
              "autoWidth": false,
              "searching": true,
            });
          }
          else
          {
              toastr.options = toastrOptions;
              
              toastr['error']( response.error, 'Error');
          }
        });
   }); 
  
  
});

