	var submitCheckBoxes = function (electronics, mobile_phone, pc, automobiles, callback) {
		$(document).ready(function{
			$.ajax({
				url:"",
				type:"POST",
				dataType: "json",
				data:,
				encode: true
			})
			.done( function(response){

				callback(response);

			})
			.fail(function(error){

				console.log(error);
			})
			.always(function(response){

			})
		});
		
	};
	$("#saveJobCategory").on('click', function(event){

	});