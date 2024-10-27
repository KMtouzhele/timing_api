import express from 'express';

// Import the MySQL connection from the previous step
//    and name it dbconn
import dbconn from './dbconn.js';

// Define a function for getting all movies
const getMovies = (req, res) => 
{
    dbconn.query('SELECT * FROM movie', (err, rows) => 
    {
        // Forward on any server-side MySQL errors verbatim 
        // Useful for debugging MySQL syntax errors
        // But bad for security
        if (err) 
        {
            res.status(500).send(err);
            return;
        }
        
        // Return the rows as a JSON object
        res.json(rows);
    });
}

// Define a router for all the routes about movies
const router = express.Router();
router.get('/', getMovies);
// (more routes to go here)

// Make the router available to other modules via export/import
export default router;