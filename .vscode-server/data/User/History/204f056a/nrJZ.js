// Import the Express Library
const express = require('express');
const path = require('path');
const ejs = require('ejs');

// Define the port the server will run on
const PORT = 3389;

// Create a new express app
const app = express();

// Start the server on the specified PORT
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});

// You will add more lines here soon
app.use('/static', express.static('static'));

function test(req, res) 
{
    console.log({req});
    res.send('Hello World');
}
app.get('/test', test);

//some json output
function test_json(req, res) {
    console.log('A request was made to /json');
    res.json({message: 'Hello World'}); 
    //note that using .json() sets the Content-Type header to application/json automatically
}
app.get('/test_json', test_json);

//some xml output
function test_xml(req, res) {
    console.log('A request was made to /xml');
    //set the Content-Type header for xml manually
    res.set('Content-Type', 'text/xml');
    res.send('<message>Hello World</message>');
}
app.get('/test_xml', test_xml);

//some html output
function test_html(req, res) {
    console.log('A request was made to /html');
    //note that the Content-Type is by default set to text/html
    res.send('<h1>Hello World</h1><p>This is a paragraph</p>');
}
app.get('/test_html', test_html);

// Configure the subfolder "views" to hold our EJS files
app.set('views', path.join(__dirname, 'views')); 
// Configure Express to use EJS as the rendering engine
app.set('view engine', 'ejs');

// EJS rendering example
function test_ejs(req, res) 
{
    console.log('A request was made to /test_ejs');
    let messageFromURL = req.params.message;
    res.render('my_first_view', { pageTitle: 'Hello World', message: messageFromURL });
}
app.get('/test_ejs', test_ejs);

const router = express.Router();
router.get('/test', test);
router.get('/test_json', test_json);
router.get('/test_xml', test_xml);
router.get('/test_html', test_html);
router.get('/test_ejs/:message', test_ejs);
//we will do test_ejs in the next step
app.use('/', router);