import { exec } from 'child_process';
import express, { json } from 'express';
import dbconn from './dbconn.js';
import { apiKeyMiddleware } from './apiKeyMiddleware.js';
import { isTrackValid } from './isTrackValid.js';

const getTracks = (req, res) => {
    dbconn.query('SELECT * FROM tracks', (err, rows) => {
        if (err) {
            return res.josn({
                code: 500,
                result: err
            });
        }
        if (!rows.length) {
            res.json({
                code: 404,
                result: 'No tracks found'
            });
            return;
        }
        res.json({
            code: 200,
            result: {
                id: rows
            }
        });
    });
}

const getTrack = (req, res) => {
    const { id } = req.params;
    dbconn.query('SELECT * FROM tracks WHERE id = ?', [id], (err, rows) => {
        if (err) {
            res.json({
                code: 500,
                result: err
            });
            return;
        }
        if (!rows.length) {
            res.json({
                code: 404,
                result: 'Track not found'
            });
            return;
        }
        res.json({
            code: 200,
            result: rows[0]
        });
    });
}

const scrapeTracks = (req, res) => {
    exec('php php_web_scraper2/guzzle_requests.php', (error, stdout, stderr) => {
        if (error) {
            console.error(`Error executing PHP script: ${error.message}`);
            return res.json({
                code: 500,
                result: 'Error executing PHP script'
            });
        }
        if (stderr) {
            console.error(`PHP stderr: ${stderr}`);
            return res.json({
                code: 500,
                result: 'PHP error occurred'
            });
        }

        try {
            const data = JSON.parse(stdout);
            res.json({
                code: 200,
                result: data
            });
        } catch (err) {
            console.error(`Error parsing JSON: ${err.message}`);
            res.json({
                code: 500,
                result: 'Error parsing scraped data'
            });
        }
    });
};

const addTrack = (req, res) => {
    const { baseLapTime, laps, name, type } = req.body;
    const lapsInt = parseInt(laps, 10);
    const baseLapTimeFloat = parseFloat(baseLapTime);
    dbconn.query(
        'INSERT INTO tracks (name, type, laps, baseLapTime) VALUES (?, ?, ?, ?)',
        [name, type, lapsInt, baseLapTimeFloat],
        (err, result) => {
            if (err) {
                return res.status(500).json({
                    code: 500,
                    result: err
                });
            }
            res.status(200).json({
                code: 200,
                result: 'Track added successfully'
            });
        }
    );
};

const deleteTrack = (req, res) => {
    const { id } = req.params;
    dbconn.query('DELETE FROM tracks WHERE id = ?', [id], (err, result) => {
        if (err) {
            res.json({
                code: 500,
                result: err
            });
            return;
        }
        if (!result.affectedRows) {
            res.json({
                code: 404,
                result: 'Track not found'
            });
            return;
        }
        res.json({
            code: 200,
            result: 'Track deleted successfully'
        });
    });
};

const getRacesForTrack = (req, res) => {
    const trackId = req.params.id;
    dbconn.query(
        'SELECT * FROM races where track = ?',
        [trackId],
        (err, rows) => {
            if (err) {
                return res.status(500).json({
                    code: 500,
                    result: err
                });
            }
            if (!rows.length) {
                return res.stauts(404).json({
                    code: 404,
                    result: "No races found for this track"
                });
            }
            res.status(200).json({
                code: 200,
                result: rows
            });
        }
    )

};

const createARaceWithTrack = (req, res) => {
    const trackId = req.params.id;
    dbconn.query('SELECT * FROM tracks WHERE id = ?', [trackId], (err, rows) => {
        if (err) {
            res.json({
                code: 500,
                result: err
            });
            return;
        }
        if (!rows.length) {
            res.json({
                code: 404,
                result: 'Track not found'
            });
            return;
        }
        dbconn.query(
            'INSERT INTO races (track) VALUES (?)',
            [trackId],
            (err, result) => {
                if (err) {
                    res.status(500).send(err);
                    return;
                }
                res.json({
                    code: 200,
                    result: 'Race created!'
                });
            }
        );
    }
    );
};

const router = express.Router();
router.get('/', getTracks);
router.get('/scrape', scrapeTracks);
router.get('/:id', getTrack);
router.post('/', apiKeyMiddleware, isTrackValid, addTrack);
router.delete('/:id', apiKeyMiddleware, deleteTrack);
router.get('/:id/races', getRacesForTrack);
router.post('/:id/races', apiKeyMiddleware, createARaceWithTrack);

export default router;