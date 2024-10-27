import express from 'express';
import dbconn from './dbconn.js';
const getTracks = (req, res) => 
{
    dbconn.query('SELECT * FROM tracks', (err, rows) => 
    {
        if (err) 
        {
            res.status(500).send(err);
            return;
        }
        res.json(rows);
    });
}
const router = express.Router();
router.get('/', getTracks);
export default router;