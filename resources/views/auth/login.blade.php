<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Dtyle bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"  crossorigin="anonymous">

	<!-- fontawsone -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">

	<!-- googleFont -->
	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans|Varela+Round" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Merriweather|Source+Sans+Pro" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="myStyle.css">
	<link rel="stylesheet" type="text/css" href="theme.css">
  <style media="screen">
  body{
font-family: 'Merriweather', serif;
font-family: 'Source Sans Pro', sans-serif;
background-color: dodgerblue;
}




.main-section{
margin: 0px auto;
margin-top: 80px;
padding: 0 auto;

}


.modal-content{
background-color: dodgerblue;
opacity: .98;
width: 130%;
height:100%;
background-color: white;
padding-bottom: 20px;
box-shadow: 7px 7px 3px 7px rgba(0, 0, 0, .3);
}

.user-img{
margin-top: -50px;
padding-bottom: 60px;

}
.user-img img{
width: 140px;

}
.form-group input{
width: 95%;
margin: 0px auto;
padding-left: 40px;
margin-bottom: 8%;
font-size: 17px;
font-weight: bold;
color: black;
}
.validate{
margin-top: -20px;
display: none;
}
.validate p{
color: red;

}
.input-error{
border:2px solid red;
}
.rememberme{
margin-top: -6px;
margin-left: -210px;
margin-bottom: 20px;
}
.btn{
width: 210px;
margin-bottom: 2px;
border-radius: 6%;
font-size: 18px;
background-color: dodgerblue;
font-weight: bold;
color: white;
}
.forgot{
border-bottom:  2px  solid;
padding-top: 15px;
padding-bottom: 10px;
}

.btnnew{
width: 210px;
margin: 10px auto;
background-color: white;
color: dodgerblue;
font-size: 18px;
font-weight: bold;
border-radius: 6%;

}
.btnnew:hover{
font-weight: bold;
cursor: pointer;
}

span{
margin-left:  -170px;
position: absolute;
font-size: 28px;
color: dodgerblue;

}

@media only screen and (max-width: 768px) {


.modal-content{
width: 150%;
height:100%;
margin-top: -75px;
margin-left: -80px;
box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, .3);
}

.user-img{
margin-top: 2.5px;

}

.rememberme{
margin-left: -268px;
}

span{
margin-left:  -195px;
position: absolute;
font-size: 28px;
}
.validate p{
color: red;
margin-left: -200px;
}

}

@media only screen and (max-width: 575px) {


.modal-content{
width: 100%;
height:100%;
margin: -85px -40px;
margin-right: 0px;

}

.user-img{
margin-top: 15.5px;
padding-bottom: 40px;


}


.user-img img{
width: 25%;


}


.form-group input{
width: 90%;
margin-left: 7%;
}
.btn{
width: 88%;
margin-left: 6.5%;
}

.rememberme{
margin-left:0%;
}

body{
margin-right: -65px;
margin-bottom: -50px;
}
span{
position: absolute;
font-size: 28px;
margin-left: -38%;
}
.validate p{
position: relative;
color: red;
margin-left: -38.5%;
}



}

@media only screen and (max-width: 450px) {
.validate p{
position: relative;
color: red;
margin-left: 7.5%;
}
}
  </style>
</head>
<body>



	<div class="modal-dialog text-center">
		<div class="col-sm-8  main-section">
			<div class="modal-content">
				<div class="col-12 user-img">
					<img src="{{asset('/images/icon.png')}}">
				</div>

				<form class="col-12" method="POST" action="{{ route('login') }}">
                        @csrf
				<div class="form-group">
					<span class="usericon" style=""><i class="fas fa-user-tie"></i></span>
					<input type="text" name="username" id="username"
					class="form-control" placeholder="entrez votre username">
				</div>
				<div class="validate" id="usernamevalidation" name="usernamevalidation">
					<p>Saisissez votre username</p>
				</div>

				<div class="form-group">
					<span class="passwordicon"><i class="fas fa-unlock-alt"></i></span>
					<input type="password" name="password" id="password" class="form-control" placeholder="entrez votre password">

				</div>
				<div class="validate" id="passwordvalidation" name="passwordvalidation" >
					<p>Saisissez un mot de passe.</p>
				</div>
				<div class="rememberme">
					<input type="checkbox" name="checkbox" id="check">
					<label>Remember me</label>
				</div>

				<button type="submit" class="btn" id="btn"> <i class="fas fa-sign-in-alt"></i> Login</button>

				</form>
				<div class="col-12 forgot">
					<a href="{{ route('password.request') }}">Forgot password?</a>
				</div>

				<a type="button" href="{{ route('register')}}" class="btnnew"> New account </a>

			</div>

		</div>


	</div>




<!--JQuery-->
<script src="https://code.jquery.com/jquery-3.3.1.js" crossorigin="anonymous"></script>

<!-- JQuery Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" crossorigin="anonymous"></script>


<script type="text/javascript">
	$(document).ready(function(){


		var username;
		var password;
	$("#btn").on("click",function(){


		username = $("#username").val();
		password = $("#password").val();

		if(username == ""){
			$("#username").addClass('input-error');
			$("#usernamevalidation").css("display","block");
			return false;
		}
		else{
			$("#username").removeClass("input-error");
			$("#usernamevalidation").css("display","none");
		}

		if (password == "") {
			$("#password").addClass('input-error');
			$("#passwordvalidation").css("display","block");
			return false;
		}
		else{
			$("#password").removeClass("input-error");
			$("#passwordvalidation").css("display","none");
		}
		if (username != "" && password != "") {
			// alert("Username : "+username + " Password : " +password);
		}


		});

			/*
			$("#username").keydown(function(){
				username = $("#username");
				console.log(username);
				if (username != "") {
					$("#usernamevalidation").css("display","none");
					$("#username").removeClass("input-error");
				}
				else{
					$("#usernamevalidation").css("display","block");
					$("#username").addClass("input-error");
				}
			});

			$("#password").keydown(function(){
				password = $("#password");
				if (password != "") {
					$("#passwordvalidation").css("display","none");
					$("#password").removeClass("input-error");
				}
			});

				$("#username").focusout(function(){
				username = $("#username");
				if (username == "") {
					$("#usernamevalidation").css("display","block");
					$("#username").addClass("input-error");

				}
			});

			$("#password").focusout(function(){
				password = $("#password");
				if (password  == "") {
					$("#passwordvalidation").css("display","block");
					$("#password").addClass("input-error");
				}
				else{
					$("#passwordvalidation").css("display","none");
					$("#password").removeClass("input-error");
				}
			});
			*/
});
</script>
</body>
</html>
