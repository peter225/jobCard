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

	var viewJobDetails = function(customer_id, callback){
		$.ajax({
          type:"POST", 
          url:"/task/enableSearch",
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
		viewJobDetails( $('#customer_id'), handleAjaxResponse);
	});

});