function validate(){

	name = $('#fullname').val();
	email = $('#email').val();
	password = $('#password').val();
	confirmpassword = $('#confirmpassword').val();

	regex1 = '^[a-z A-Z]+$'
	regex2 = '(@gmail\.com)$'
	regex3 = '^([a-zA-Z0-9@*#]{8,})$'
	
	name.match(regex1)? x=1 : x=0
	email.match(regex2)? y=1 : y=0
	password.match(regex3) ? z=1 : z=0
	password==confirmpassword ? match=1 : match=0

	if(x==1 && y==1 && z==1 && match==1){
		return true
	}
	else{
		if(!x){
			$('#namealert').show();
		}
		if(!y){
			$('#emailalert').show();	
		}
		if(!z){
			$('#passwordalert').addClass("text-danger");
		}
		if(!match){
			$('#confirmpasswordalert').show();		
		}
		alert("Registration not complete.")
		return false
	}
}