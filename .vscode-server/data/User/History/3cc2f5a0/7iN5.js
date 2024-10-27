import mysql from 'mysql';

// MySQL Config
var con = mysql.createConnection({ 
    user: "tute9",
    password: "qgnuQnV8QatX7Y8B", //and even better use the .env file or read it from a file not on source control ;)
    database: "tute9"
});

// Connect to MySQL
con.connect(function(err) {
    if (err) throw err;
    console.log("MySQL Connected!");
});

// Make the connection available to other modules via export/import
export default con;