var express = require("express");
var app = express();

var session = require('express-session')

// set up sessions
app.use(session({
  secret: 'my-super-secret-secret!',
  resave: false,
  saveUninitialized: true
}))

var bodyParser = require('body-parser')
app.use( bodyParser.json() );       // to support JSON-encoded bodies
app.use(bodyParser.urlencoded({     // to support URL-encoded bodies
  extended: true
}));

const { Pool } = require('pg');
//This is where all your database information such as password user and database goes.
var connectionString = process.env.DATABASE_URL || "postgres://awkwardUser@localhost:5432/creeps";

const pool = new Pool({connectionString: connectionString});



app.set("port", process.env.PORT || 5000)
  .use(express.static(__dirname + "/public"))
  .use(express.json())
  .use(express.urlencoded({extended:true}))
  .get("/person", getPerson)
  .get("/image", function(request, response){
    getImage(request, response)})
  .post('/login', handleLogin)
  .post('logout', handleLogout)
  .post("/signUp", signUp)
  .listen(app.get("port"), function() {
  	console.log("Listening on port", app.get("port"));
  })


function getPerson(request, response){
    // First get the person's id
	var id = request.query.id;
	// TODO: We should really check here for a valid id before continuing on...
	// use a helper function to query the DB, and provide a callback for when it's done
	getPersonFromDb(id, function(error, result) {
		// This is the callback function that will be called when the DB is done.
		// The job here is just to send it back.

		// Make sure we got a row with the person, then prepare JSON to send back
		if (error || result == null || result.length != 1) {
			response.status(500).json({success: false, data: error});
		} else {
			var person = result[0];
			response.status(200).json(result[0]);
		}
	});
}
function getPersonFromDb(id, callback) {
  console.log("Getting person from DB with id: " + id);
  
  var sql = "SELECT id, username, pass, gender, creepiness, image FROM users WHERE id = $1::int";

  var params = [id];

  // This runs the query, and then calls the provided anonymous callback function
	// with the results.
	pool.query(sql, params, function(err, result) {
		// If an error occurred...
		if (err) {
			console.log("Error in query: ")
			console.log(err);
			callback(err, null);
    }
    // Log this to the console for debugging purposes.
		console.log("Found result: " + JSON.stringify(result.rows));
		// (The first parameter is the error variable, so we will pass null.)
    callback(null, result.rows);
  });

}
function signUp(){

  pool.query(sql, params, function(err, result) {
		// If an error occurred...
		if (err) {
			console.log("Error in query: ")
			console.log(err);
			callback(err, null);
    }
    // Log this to the console for debugging purposes.
		console.log("Found result: " + JSON.stringify(result.rows));
		// (The first parameter is the error variable, so we will pass null.)
    callback(null, result.rows);
  });
}

function handleLogin(request, response) {
  var result = {success: false};
  
  if (request.body.username == "admin" && request.body.password == "password") {
		request.session.user = request.body.username;
		result = {success: true};
	}
  response.json(result);
  pool.query(`SELECT password FROM users WHERE username='${username}'`, params, function(err, result) {
		// If an error occurred...
		if (err) {
			console.log("Error in query: ")
			console.log(err);
			callback(err, null);
    }
    // Log this to the console for debugging purposes.
		console.log("Found result: " + JSON.stringify(result.rows));
		// (The first parameter is the error variable, so we will pass null.)
    callback(null, result.rows);
  });
  
}

// If a user is currently stored on the session, removes it
function handleLogout(request, response) {
	var result = {success: false};

	// We should do better error checking here to make sure the parameters are present
	if (request.session.user) {
		request.session.destroy();
		result = {success: true};
	}

  response.json(result);
}


