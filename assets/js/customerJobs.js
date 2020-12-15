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

          
      }
  }
var updateJobStatus = function(id, status, callback)
{
  $.ajax({
          type:"POST", 
          url:"/engineers/updateStatus",
          data:"id=" + id + "&status=" + status + "&update-status-btn=true",
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

var updateStatusForm ='<form class="update-status-form">' +
                        '<div class="form-group">' +
                          '<label for="inputStatus">Status</label>' +
                            '<select class="form-control custom-select" name="status">' +
                              '<option selected disabled>Select one</option>' +
                                '<option>pending</option>' +
                                '<option>processing</option>' +
                                '<option>finished</option>' +
                            '</select>'+
                          '</div>' +
                        '<div class="card-footer">' +
                            '<button type="button" class="btn btn-primary" id="update-status-btn" name="update-status-btn">Save Changes</button>' +
                          '</div>' +
                          '</form>';
var myDefaultModal = '<div class="modal fade" id="my-defaultModal">' + 
                      '<div class="modal-dialog">' + 
                        '<div class="modal-content">' + 
                            '<div class="modal-header">' +
                                '<h4 class="modal-title">Update Job Status Form</h4>' +
                                  '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                                      '<span aria-hidden="true">&times;</span>' +
                                  '</button>' +
                            '</div>' +
                          '<div class="modal-body">' +
                           updateStatusForm +
                          '</div>' +
                          '<div class="modal-footer justify-content-between">' +
                              '<button type="button" class="btn btn-success close" data-dismiss="modal">Close</button>' +
                          '</div>' +
                        '</div>' +
                    '</div>';

var fetchJobs = function(callback){
		$.ajax({
          type:"POST", 
          url:"/engineers/fetchJobs",
          data:"fetch-job-btn=true",
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
  console.log($('button').is('#fetch-job-btn'));
 $('#fetch-job-btn').on('click', function(event){
		fetchJobs( function(response){
      var notification = response.success.message.length + ' ' + 'New Jobs';
      console.log(notification);
      $('span.notification').html(response.success.message.length);
      $('span.notifications').html(notification);
			console.log(response);
      if (response.success) {

            var jobs = response.success.message;

            if(jobs.length <= 0 )
            {
                console.log('No jobs');
                return;
            }

            var customerJobsTable = '<table id="" class="table table-striped jobTable">' +

            '<thead>' +

            '<tr><th>SN</th><th>Job ID</th><th>Device name</th><th>Fault</th><th>Device description</th><th>Status</th><th></th></tr>' + 
            '</thead>' +

            '<tbody>';
             

            $.each( jobs, function(i,job){

              customerJobsTable += '<tr><td>' + (i+1) + '.</td>' +

              '<td>' + job.id + '</td>' +

              '<td>' + job.device_name + '</td>' +

              '<td>' + job.fault + '</td>' +

              '<td>' + job.device_description + '</td>';

              if(job.status == "pending")
              {
                customerJobsTable += '<td class="project-state"><span class="badge badge-danger">' + job.status + '</span></td>';
              }
              else if(job.status == "processing")
              {
                  customerJobsTable += '<td class="project-state"><span class="badge badge-primary">' + job.status + '</span></td>';
              }
              else if(job.status == "finished")
              {
                  customerJobsTable += '<td class="project-state"><span class="badge badge-success">' + job.status + '</span></td>';
              }

              customerJobsTable += '<td><button type="button" class="btn btn-success updateStatus"data-job-id="' + job.id + '">Update</button></td></tr>';

            });

            customerJobsTable += '</tbody></table>';

            var customerJobsDetail = '<div>' +
                    '<div class="row">' +
                      '<div class="col-12">' +
                        '<div class="card">' +
                          '<div class="card-header">' +
                            '<h3 class="card-title">Customer Table</h3>' +
                          '</div>' +
                          '<!-- /.card-header -->' +
                          '<div class="card-body">' +
                          customerJobsTable +
                          '</div>' +
                          '<!-- /.card-body -->' +
                        '</div>' +
                        '<!-- /.card -->' +
                      '</div>' +
                    '</div>' +
                  '</div>';

          
            $('#my-modal').find('h4.modal-title').html('Customer Jobs');

            $('#my-modal').find('div.modal-body').html(customerJobsDetail);

            $('#my-modal').modal("show");

             console.log($("table").is(".jobTable"));

            $("table.jobTable").DataTable({
              "responsive": true,
              "autoWidth": false,
              "searching": true,
            });
            $('button.updateStatus').on('click', function(event){
              var id = $(this).data('job-id');
              $('#my-modal').modal('hide');
              $(myDefaultModal).modal('show').on('shown.bs.modal', function(event){
                $('#update-status-btn').on('click', function(event){
                  var statusUpdateForm = $('.update-status-form').val();
                  
                  var status = $('select[name=status]', statusUpdateForm).val();
                  console.log(status);
                  console.log(id); 
                  updateJobStatus(id, status, function( response ){
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
                        $('div.modal').find('button.close').click();
                        
                    }
                });
                  
                });
              });
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