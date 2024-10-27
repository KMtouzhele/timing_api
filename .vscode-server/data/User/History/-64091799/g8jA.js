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

const getMovie = (req, res) => 
{
  dbconn.query('SELECT * FROM movie WHERE id = ?', [req.params.id], (err, rows) => 
  {
    // Forward on the SQL errors      
    if(err) 
    {
      res.status(500).send(err);
    }
    
    // Return 404 if no match found
    if (rows.length == 0) 
    {
      res.status(404).json({message: 'Movie Not found'});
      return;
    }
    
    // Otherwise output the one result
    res.json(rows[0]);
  });
}

const createMovie = (req, res) => {
    const name = 'Inception';
    const year = '2010';
    const director = 'Christopher Nolan';

    // Prepare the SQL insert statement
    const sql = 'INSERT INTO movie (name, year, director) VALUES (?, ?, ?)';

    // Execute the query
    dbconn.query(sql, [name, year, director], (err, result) => {
        if (err) {
            console.error(err); // Log the error for debugging
            return res.status(500).send('Internal Server Error');
        }

        // Send a response with the new movie's ID
        res.status(201).json({ id: result.insertId, name, year, director });
    });
}

// Define a router for all the routes about movies
const router = express.Router();
router.get('/', getMovies);
router.get('/:id', getMovie);
router.post('/', createMovie);
// (more routes to go here)

// Make the router available to other modules via export/import
export default router;