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
	

	var viewJobDetails = function(customerID, callback){
		$.ajax({
          type:"POST", 
          url:"/Admins/viewJob",
          data: "customer_id=" + customerID +"&search-btn=true",
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
	$('#customerIdBtn').on('click', function(event){
		var form = $(this).closest('form');

		$('#displayJob').html('');

		var customerID = $('#customer_id').val();

		viewJobDetails( customerID, function(response){
			console.log(response);

			if(response.success)
			{
				var jobs = response.success.message;

				if(jobs.length <= 0 )
              	{
                	console.log('zero search');
                	return;
              	}
              	var customersJobTable = '<table class="table table-striped">' +

              	'<thead>' +

              	'<tr><th>SN</th><th>Job Title</th><th>Price</th><th>Amount Paid</th><th>Balance</th><th>Faults</th><th>Engineer Status</th><th>#</th></tr>' + 
              	'</thead>' +

              	'<tbody>';
				$.each(jobs, function(i, job){
					customersJobTable += '<tr><td>' + (i+1) + '.</td>' +

              		'<td>' + job.job_title + '</td>' +

              		'<td>' + job.job_price + '</td>' +

              		'<td>' + job.amount_paid + '</td>' + 

              		'<td>' + job.balance + '</td>' +

              		'<td>' + job.fault + '</td>';

              		if(job.status == "pending")
              {
                customersJobTable += '<td class="project-state"><span class="badge badge-danger">' + job.status + '</span></td>';
              }
              else if(job.status == "processing")
              {
                  customersJobTable += '<td class="project-state"><span class="badge badge-primary">' + job.status + '</span></td>';
              }
              else if(job.status == "finished")
              {
                  customersJobTable += '<td class="project-state"><span class="badge badge-success">' + job.status + '</span></td>';
              }

              customersJobTable += '<td><button type="button" class="btn btn-info btn-default editBtn" data-toggle="modal" data-target="#modal-default" data-job-ownerName="' + job.owner_name +  '" data-job-phone="' + job.owner_phone + '"data-job-id="' + job.id + '" data-job-title="' + job.job_title + '" data-job-device-name="' + job.device_name + '" data-job-device-description="' + job.device_description + '" data-job-device-id="' + job.device_id + '" data-job-actual-price="' + job.job_price + '" data-job-amount-paid="' + job.amount_paid + '" data-job-balance="' + job.balance + '" data-job-fault="' + job.fault + '"><i class="fas fa-pencil-alt"></i>Edit</button></td></tr>';

          });

				customersJobTable += '</tbody></table>';

	              var jobDetail = '<div>' +
				                    '<div class="row">' +
				                      '<div class="col-12">' +
				                        '<div class="card">' +
				                          '<div class="card-header">' +
				                            '<h3 class="card-title">Customer Job Table</h3>' +
				                          '</div>' +
				                          '<!-- /.card-header -->' +
				                          '<div class="card-body table-responsive p-0">' +
				                          customersJobTable +
				                          '</div>' +
				                          '<!-- /.card-body -->' +
				                        '</div>' +
				                        '<!-- /.card -->' +
				                      '</div>' +
				                    '</div>' +
				                  '</div>';

	            console.log($('#displayJob').html(jobDetail));

	            var updateForm ='<form class="updateForm">' +
		            				'<div class="form-group job-title">' +
	                    				'<label for="basicinput">Job Title</label>' +
	                    					'<input type="text" name="job-title" class="form-control" placeholder="">' +
	                  				 '</div>' +
						              '<div class="form-group">' +
						                 '<label for="basicinput">Device Name</label>' +
						                    '<input type="text" name="device-name" class="form-control" placeholder="">' +
						               '</div>' +
						               '<div class="form-group">' +
						               	  '<label for="basicinput">Device Description</label>' +
						               '	<input type="text" name="device-description" class="form-control" placeholder="">' +
						                '</div>' +
						                '<div class="form-group">' +
						                    '<label for="basicinput">Device Id</label>' +
						                    	'<input type="text" name="device-id" class="form-control" placeholder="">' +
						                '</div>' +
						                '<div class="form-group">' +
						                    '<label for="basicinput">Actual Price</label>' +
						                    	'<input type="text" name="actualPrice" class="form-control"placeholder="">' +
						                '</div>' +
										'<div class="form-group">' +
						                    '<label for="basicinput">Amount Paid</label>' +
						                    	'<input type="text" name="amountPaid" class="form-control" placeholder="">' +
						                 '</div>' +
						                 '<div class="form-group">' +
						                    '<label for="basicinput">Balance</label>' +
						                    	'<input type="text" name="balance" class="form-control" placeholder="">' +
						                 '</div>' +
						                 '<div class="form-group">' +
						                    '<label for="basicinput">Faults/Complaints</label>' +
						                    	'<input type="text" name="fault" class="form-control" placeholder="">' +
						                  '</div>' +
						                  '<div class="card-footer">' +
                  							'<button type="button" class="btn btn-primary" id="update_job" name="update_job">Save Changes</button>' +
                						  '</div>' +
					                '</form>';
				    
              	var myDefaultModal = '<div class="modal fade" id="my-defaultModal">' + 
  										'<div class="modal-dialog">' + 
    										'<div class="modal-content">' + 
        										'<div class="modal-header">' +
          											'<h4 class="modal-title">Update Job Details Form</h4>' +
            											'<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                											'<span aria-hidden="true">&times;</span>' +
            											'</button>' +
        										'</div>' +
    											'<div class="modal-body">' +
    											updateForm +
    											'</div>' +
    											'<div class="modal-footer justify-content-between">' +
      												'<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>' +
    											'</div>' +
  											'</div>' +
										'</div>';
										

				$('button.editBtn').on('click', function(event){
     				 
                  	var jobTitle = $(this).data('job-title');

     				var deviceName = $(this).data('job-device-name');

     				var deviceDescription = $(this).data('job-device-description');

     				var deviceId = $(this).data('job-device-id');

     				var actualPrice = $(this).data('job-actual-price');
     				
     				var amountPaid = $(this).data('job-amount-paid');

     				var balance = $(this).data('job-balance');

     				var fault = $(this).data('job-fault');

     				var id = $(this).data('job-id');
     				

					$(myDefaultModal).modal('show').on('shown.bs.modal', function(event){
						
						var jobUpdateForm = $('form.updateForm');
						
						$('input[name=job-title]', jobUpdateForm ).val(  jobTitle );

						$('input[name=device-name]', jobUpdateForm ).val( deviceName );

						$('input[name=device-description]', jobUpdateForm ).val( deviceDescription );

						$('input[name=device-id]', jobUpdateForm ).val( deviceId  );

						$('input[name=actualPrice]', jobUpdateForm ).val( actualPrice );

						$('input[name=amountPaid]', jobUpdateForm ).val( amountPaid );

						$('input[name=balance]', jobUpdateForm ).val( balance );

						$('input[name=fault]', jobUpdateForm ).val( fault );

						//$('input[name=job-title]', jobUpdateForm ).data( 'job-customer-id', customerId );
/*
						var updateJobDetails = function(jobTitle, deviceName,deviceDescription,deviceID, fault, jobPrice, pricePaid,id, callback ){
						  $.ajax({
						          type:"POST", 
						          url:"/Admins/updateJob",
						          data: "job-title=" + jobTitle + "&device-name=" + deviceName + "&device-description=" + deviceDescription + "&device-id=" + deviceID + "&fault=" + fault + "&actualPrice=" + jobPrice + "&pricePaid=" + pricePaid + "&id=" + id +"&update_job=true",
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
*/
						console.log($('button[name=update_job]', jobUpdateForm).is('#update_job'));
				     					
				     	$('#update_job').on('click', function(event){

				     		var form = $(this).closest('form');
				     		console.log(id);			
				     		updateJobDetails(form, id, function( response ){

      	
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
							          $('div.modal').find('button.close').click();
							      }
    						});
				     	});
				    });
					//console.log($(this).hasClass('job-title'));
					//console.log($('div.job-title').val( $(this).data('job-title') ));
				});
			}
			else if (response.error) 
            {
              toastr.options = toastrOptions;

              toastr['error']( response.error.message, response.error.title );
            }
		});
	});

	var updateJobDetails = function( updateForm, jobID, callback ){
	  console.log($(updateForm).serialize());
	  $.ajax({
          type:"POST", 
          url:"/Admins/updateJob",
          data: $(updateForm).serialize() + "&id=" + jobID +"&update_job=true",
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

	
});