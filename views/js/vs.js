var postForm = '../vs/data.php';
var postedData = '';
$( document ).ready(function() {
    $("#vsForm").on('submit', function(e){
	    e.preventDefault();
	    //consulta via ajax
	  	$.ajax({
		    type: 'POST',
		    url: postForm,
		    data: $( this ).serialize(),

		})
		.done(function( html ) {
			$( ".mt-5" ).html( html );
		});

	});
});