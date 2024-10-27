import { exec } from 'child_process';
import express from 'express';
import dbconn from './dbconn.js';
import { apiKeyMiddleware } from './apiKeyMiddleware.js';
import { isTrackValid } from './isTrackValid.js';

const getTracks = (req, res) => {
    dbconn.query('SELECT * FROM tracks', (err, rows) => {
        if (err) {
            res.status(500).send(err);
            return;
        }
        if (!rows.length) {
            res.status(404).send('No tracks found');
            return;
        }
        res.json(rows);
    });
}

const getTrack = (req, res) => {
    const { id } = req.params;
    dbconn.query('SELECT * FROM tracks WHERE id = ?', [id], (err, rows) => {
        if (err) {
            res.status(500).send(err);
            return;
        }
        if (!rows.length) {
            res.status(404).send('Track not found');
            return;
        }
        res.json(rows[0]);
    });
}

const scrapeTracks = (req, res) => {
    exec('php php_web_scraper/guzzle_requests.php', (error, stdout, stderr) => {
        if (error) {
            console.error(`Error executing PHP script: ${error.message}`);
            return res.status(500).send('Error executing PHP script');
        }
        if (stderr) {
            console.error(`PHP stderr: ${stderr}`);
            return res.status(500).send('PHP error occurred');
        }

        try {
            const data = JSON.parse(stdout);
            res.json(data);
        } catch (err) {
            console.error(`Error parsing JSON: ${err.message}`);
            res.status(500).send('Error parsing scraped data');
        }
    });
};

const addTrack = (req, res) => {
    const { name, type, laps, baseLapTime } = req.body;
    dbconn.query(
        'INSERT INTO tracks (name, type, laps, baseLapTime) VALUES (?, ?, ?, ?)',
        [name, type, laps, baseLapTime],
        (err, result) => {
            if (err) {
                res.status(500).send(err);
                return;
            }
            res.json({ message: 'Track added successfully' });
        });
};

const deleteTrack = (req, res) => {
    const { id } = req.params;
    dbconn.query('DELETE FROM tracks WHERE id = ?', [id], (err, result) => {
        if (err) {
            res.status(500).send(err);
            return;
        }
        if (!result.affectedRows) {
            res.status(404).send('Track not found');
            return;
        }
        res.json({ message: 'Track deleted successfully' });
    });
};

const createARaceWithTrack = (req, res) => {
    const { id } = req.params;
    dbconn.query('SELECT * FROM tracks WHERE id = ?', [id], (err, rows) => {
        if (err) {
            res.status(500).send(err);
            return;
        }
        if (!rows.length) {
            res.status(404).send('Track not found');
            return;
        }
        dbconn.query(
            'INSERT INTO races (trackId) VALUES (?)',
            [id],
            (err, result) => {
                if (err) {
                    res.status(500).send(err);
                    return;
                }
                

};

const router = express.Router();
router.get('/', getTracks);
router.get('/scrape', scrapeTracks);
router.get('/:id', getTrack);
router.post('/', apiKeyMiddleware, isTrackValid, addTrack);
router.delete('/:id', apiKeyMiddleware, deleteTrack);

export default router;