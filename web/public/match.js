function matched(){

    document.getElementById("match").innerHTML = "It's A match!!";
  
}
function notmatched(){
    document.getElementById("match").innerHTML = "";
}

function getPerson(){
	var id = 1;
	var params = {id:id};
	$.get("/person", params, function(result){
		document.getElementById("demo").innerHTML = result.pass;
		console.log(result);
	});
}
function getImage(){
	var img = ""
	var params = {img:img};
	$.get("/person", params, function(result){
		$("#image").attr("src",result.image);
		console.log(result.image);
	})
}
function signUp(){
	var user = $("#username").val();
	var password = $("#password").val();
	var image = $("#image").val();
	var insertUser = {
		user:user,
		password:password,
		image:image
	}
	$.post("/signUp", insertUser,function(result){

	})
}
function login() {
	var username = $("#username").val();
	var password = $("#password").val();

	var params = {
		username: username,
		password: password
	};

	$.post("/login", params, function(result) {
		if (result && result.success) {
			$("#status").text("Successfully logged in.");
			window.open("home.html");
		} else {
			$("#status").text("Error logging in.");
		}
	});
}

function logout() {
	$.post("/logout", function(result) {
		if (result && result.success) {
			$("#status").text("Successfully logged out.");
		} else {
			$("#status").text("Error logging out.");
		}
	});
}