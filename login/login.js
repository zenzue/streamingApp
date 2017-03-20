/*
Author: Pradeep Khodke
URL: http://www.codingcage.com/
*/

$('document').ready(function()
{ 
     /* validation */
	 $("#login-form").validate({
      rules:
	  {
			password: {
			required: true,
			},
			username: {
            required: true,
            },
	   },
       messages:
	   {
            password:{
                required: "please enter your blah password"
                     },
            username: "please enter your user user name",
       },
	   submitHandler: submitForm	
       }); 
	   /* validation */
	   
	   /* login submit */
	   function submitForm()
	   {		
			var data = $("#login-form").serialize();
			$.ajax({
				
			type : 'POST',
			url  : './login/login_process.php',
			data : data,
			dataType: "json",
			beforeSend: function()
			{	
				$("#error").fadeOut();
				$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
			},
			success :  function(response)
			   {
					if(response.status === "ok"){
						$("#btn-login").html('&nbsp; Signing In ...');
						setTimeout(' window.location.href = "song/song.php"; ',4000);			
						
						// setTimeout(' window.location.href = "home.php"; ',4000);
					}
					else{
									
						$("#error").fadeIn(1000, function(){						
						$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
						$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
						});
					}
			  	}
			});
				return false;
		}
	   /* login submit */
});