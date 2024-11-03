import express from 'express';
import dbconn from './dbconn.js';
import { apiKeyMiddleware } from './apiKeyMiddleware.js';
import axios from 'axios';
import https from 'https';

const router = express.Router();

const httpsAgent = new https.Agent({
    rejectUnauthorized: false
});

const fetchTrack = (trackId) => {
    return new Promise((resolve, reject) => {
        dbconn.query('SELECT * FROM tracks WHERE id = ?', [trackId], (err, rows) => {
            if (err) {
                reject(err);
            }
            if (!rows.length) {
                reject(null);
            }
            const track = {
                id: rows[0].id,
                name: rows[0].name,
                type: rows[0].type,
                laps: rows[0].laps,
                baseLapTime: rows[0].baseLapTime,
                uri: `https://lab-2105cf46-fd70-4e4b-8ece-4494323c5240.australiaeast.cloudapp.azure.com:7042/track/${rows[0].id}`
            };
            resolve(track);
        });
    });
};

const fetchRace = (raceId) => {
    return new Promise((resolve, reject) => {
        dbconn.query('SELECT * FROM races WHERE id = ?', [raceId], (err, rows) => {
            if (err) {
                reject(err);
            }
            if (!rows.length) {
                reject(null);
            }
            const race = {
                id: rows[0].id,
                track: rows[0].track,
                entrants: JSON.parse(rows[0].entrants || '[]'),
                startingPositions: JSON.parse(rows[0].startingPositions || '[]'),
                laps: JSON.parse(rows[0].laps || '[]'),
                count: rows[0].count
            };
            console.log('Entrants:', race.entrants);
            resolve(race);
        });
    });
};

const fetchRaces = () => {
    return new Promise((resolve, reject) => {
        dbconn.query('SELECT * FROM races', (err, rows) => {
            if (err) {
                reject(err);
            }
            if (!rows.length) {
                reject('Race not found');
            }
            const races = rows.map((row) => {
                return {
                    id: row.id,
                    track: row.track,
                    entrants: JSON.parse(row.entrants || '[]'),
                    startingPositions: JSON.parse(row.startingPositions || '[]'),
                    laps: JSON.parse(row.laps || '[]')
                };
            });
            resolve(races);
        });
    });
};

const getRaces = async (req, res) => {
    try {
        const races = await fetchRaces();
        if (races.length === 0) {
            return res.status(404).json({ code: 404, result: 'Race not found' });
        }

        const racesWithTrack = await Promise.all(
            races.map(async (race) => {
                try {
                    const track = await fetchTrack(race.track);
                    return {
                        id: race.id,
                        track: {
                            name: track.name,
                            uri: track.uri
                        },
                        entrants: race.entrants,
                        startingPositions: race.startingPositions,
                        laps: race.laps
                    };
                } catch (err) {
                    return {
                        id: race.id,
                        track: {
                            name: 'Track not found',
                            uri: null
                        },
                        entrants: race.entrants,
                        startingPositions: race.startingPositions,
                        laps: race.laps
                    };
                }
            })
        );

        return res.status(200).json({ code: 200, result: racesWithTrack });
    } catch (error) {
        return res.status(500).json({ code: 500, result: 'Error fetching races' });
    }
};


const getRace = async (req, res) => {
    const raceId = req.params.id;

    try {
        const race = await fetchRace(raceId);

        const track = await fetchTrack(race.track);

        const raceWithTrack = {
            id: race.id,
            track: {
                name: track.name,
                uri: track.uri
            },
            entrants: race.entrants,
            startingPositions: race.startingPositions,
            laps: race.laps
        };

        return res.status(200).json({ code: 200, result: raceWithTrack });

    } catch (error) {
        if (error === 'Race not found' || error === 'Track not found') {
            return res.status(404).json({ code: 404, result: error });
        }
        return res.status(500).json({ code: 500, result: error });
    }
};

const deleteRace = (req, res) => {
    const raceId = req.params.id;
    dbconn.query(
        'DELETE FROM races WHERE id = ?',
        [raceId],
        (err, result) => {
            if (err) {
                return res.status(500).json({ code: 500, result: err });
            }
            if (!result.affectedRows) {
                return res.status(404).json({ code: 404, result: "Race not found" });
            }
            return res.status(200).json({ code: 200, result: "Race deleted successfully" });
        }
    );
};

const getEntrant = (req, res) => {
    const raceId = req.params.id;
    dbconn.query(
        'SELECT entrants FROM races WHERE id = ?',
        [raceId],
        (err, rows) => {
            if (err) {
                return res.status(500).json({ code: 500, result: err });
            }
            if (!rows.length) {
                return res.status(404).json({ code: 404, result: 'Race not found' });
            }
            try {
                const entrants = JSON.parse(rows[0].entrants || '[]');
                return res.status(200).json({ code: 200, result: entrants });
            } catch (parseError) {
                return res.status(400).json({ code: 400, result: 'Invalid entrants data' });
            }
        }
    );
};

const addEntrant = async (req, res) => {
    const raceId = req.params.id;
    const { entrant } = req.body;

    dbconn.query('SELECT * FROM races WHERE id = ?', [raceId], async (err, rows) => {
        if (err) {
            return res.status(500).json({ code: 500, result: err });
        }
        if (!rows.length) {
            return res.status(404).json({ code: 404, result: 'Race not found' });
        }

        let startingPositions;
        try {
            startingPositions = JSON.parse(rows[0].startingPositions || '[]');
        } catch (parseError) {
            return res.status(400).json({ code: 400, result: 'Invalid starting positions data' });
        }

        if (startingPositions.length !== 0) {
            return res.status(400).json({ code: 400, result: "Qualifying has already taken place" });
        }

        try {
            const response = await axios.get(entrant, { httpsAgent });
            const carData = response.data;

            if (carData.code !== 200) {
                return res.status(404).json({ code: 404, result: 'Car not found' });
            }
            if (!carData.result.driver || carData.result.driver.name === "N/A" || carData.result.driver.uri === "N/A") {
                return res.status(400).json({ code: 400, result: 'Driver not assigned for this car' });
            }

            let currentEntrants = JSON.parse(rows[0].entrants || '[]');

            if (currentEntrants.includes(entrant)) {
                return res.status(400).json({ code: 400, result: 'Car already registered as entrant' });
            }

            currentEntrants.push(entrant);
            dbconn.query('UPDATE races SET entrants = ? WHERE id = ?', [JSON.stringify(currentEntrants), raceId], (err, result) => {
                if (err) {
                    return res.status(500).json({ code: 500, result: err });
                }
                return res.status(200).json({ code: 200, result: 'Entrant added successfully' });
            });
        } catch (apiError) {
            return res.status(400).json({ code: 400, result: "Driver not assigned to this car" });
        }
    });
};

const deleteEntrant = (req, res) => {
    const raceId = req.params.id;
    const { entrant } = req.body;

    dbconn.query('SELECT entrants FROM races WHERE id = ?', [raceId], (err, rows) => {
        if (err) {
            return res.status(500).json({ code: 500, result: err });
        }
        if (!rows.length) {
            return res.status(404).json({ code: 404, result: 'Race not found' });
        }

        let currentEntrants;
        try {
            currentEntrants = JSON.parse(rows[0].entrants || '[]');
        } catch (parseError) {
            return res.status(400).json({ code: 400, result: 'Invalid entrants data' });
        }

        const index = currentEntrants.indexOf(entrant);
        if (index === -1) {
            return res.status(404).json({ code: 404, result: 'Entrant not found' });
        }

        currentEntrants.splice(index, 1);

        dbconn.query(
            "UPDATE races SET entrants = ? WHERE id = ?",
            [JSON.stringify(currentEntrants), raceId],
            (err, result) => {
                if (err) {
                    return res.status(500).json({ code: 500, result: err });
                }
                return res.status(200).json({ code: 200, result: 'Entrant deleted successfully' });
            }
        );
    });
};
const qualify = async (req, res) => {
    const raceId = req.params.id;
    const race = await fetchRace(raceId);
    const driverSkills = {};
    if (!race) {
        return res.status(404).json({ code: 404, result: "Race not found" });
    }
    const entrants = race.entrants;
    if (entrants.length === 0) {
        return res.status(400).json({ code: 400, result: "No entrants registered" });
    }
    const trackId = race.track;
    const track = await fetchTrack(trackId);
    if (!track) {
        return res.status(404).json({ code: 404, result: "Track not found" });
    }
    const trackType = track.type;
    for (const entrant of entrants) {
        const carResponse = await axios.get(entrant, { httpsAgent });
        if (!carResponse || carResponse.data.code !== 200) {
            return res.status(404).json({ code: 404, result: "Car not found" });
        }
        const carData = carResponse.data;
        const driverURL = carData.result.driver.uri;
        const driverResponse = await axios.get(driverURL, { httpsAgent });
        if (!driverResponse || driverResponse.data.code !== 200) {
            return res.status(404).json({ code: 404, result: "Driver not found" });
        }
        const driverData = driverResponse.data;
        const skill = driverData.result.skill[trackType];
        driverSkills[entrant] = skill;
    }
    const originalEntrants = [...entrants];
    const sortedDrivers = entrants.sort((a, b) => driverSkills[b] - driverSkills[a]);
    const newStartingPositions = sortedDrivers.map((entrant) => originalEntrants.indexOf(entrant));

    dbconn.query(
        'UPDATE races SET startingPositions = ? WHERE id = ?',
        [JSON.stringify(newStartingPositions), raceId],
        (err) => {
            if (err) {
                return res.status(500).json({ code: 500, result: err });
            }
            return res.status(200).json({
                code: 200,
                result: "Qulifying completed"
            });
        }
    );
};

const getlap = async (req, res) => {
    const raceId = req.params.id;
    const race = await fetchRace(raceId);
    if (!race) {
        return res.status(404).json({ code: 404, result: "Race not found" });
    }
    const laps = race.laps || [];
    res.status(200).json({ code: 200, result: laps });
};

const simulateLaps = async (req, res) => {
    const raceId = req.params.id;
    const race = await fetchRace(raceId);
    if (!race) {
        return res.status(404).json({ code: 404, result: "Race not found" });
    }

    const trackId = race.track;
    const entrants = race.entrants || [];
    const startingPositions = race.startingPositions || [];
    const track = await fetchTrack(trackId);
    if (!track) {
        return res.status(404).json({ code: 404, result: "Track not found" });
    }

    let count = race.count || 0;
    const totalLaps = track.laps;
    let laps = race.laps || [];

    if (count >= totalLaps) {
        return res.status(400).json({ code: 400, result: "Race has already finished" });
    }
    let entrantsLap = [];
    for (const entrant of entrants) {
        try {
            const getLapURL = entrant + '/lap';
            const lapResponse = await axios.get(
                getLapURL, {
                httpsAgent,
                params: {
                    type: track.type,
                    baseLapTime: track.baseLapTime
                }
            }
            );

            const index = startingPositions[entrants.indexOf(entrant)];
            const time = parseFloat(lapResponse.data.result.time);
            const crashed = lapResponse.data.result.crashed;
            const isCrashed = laps.some(lap => lap.lapTimes.some(lapTime => lapTime.entrant === index && lapTime.crashed === true));
            let lap = {};
            if (isCrashed) {
                lap = {
                    entrant: index,
                    time: 0,
                    crashed: true
                };
            } else {
                lap = {
                    entrant: index,
                    time: crashed ? 0 : time,
                    crashed: crashed
                };
            }
            entrantsLap.push(lap);
        } catch (error) {
            return res.status(500).json({ code: 500, result: error });
        }
    }

    const newLap = {
        number: count,
        lapTimes: entrantsLap
    };

    laps.push(newLap);
    count += 1;

    dbconn.query(
        'UPDATE races SET laps = ?, count = ? WHERE id = ?',
        [JSON.stringify(laps), count, raceId],
        (err) => {
            if (err) {
                return res.status(500).json({ code: 500, result: err });
            }
        }
    );
    return res.status(200).json({ code: 200, result: "Lap simulated!" });
};

const getLeaderboards = async (req, res) => {
    const raceId = req.params.id;
    const race = await fetchRace(raceId);

    if (!race) {
        return res.status(404).json({ code: 404, result: "Race not found" });
    }

    const laps = race.laps || [];
    let entrants = [];
    const startingPositions 

    for (let entrantIndex = 0; entrantIndex < race.entrants.length; entrantIndex++) {
        const uri = race.entrants[entrantIndex];
        const carResponse = await axios.get(uri, { httpsAgent });

        if (carResponse.data.code !== 200) {
            return res.status(404).json({ code: 404, result: "Car not found" });
        }

        const driverURL = carResponse.data.result.driver.uri;
        const driverResponse = await axios.get(driverURL, { httpsAgent });

        if (driverResponse.data.code !== 200) {
            return res.status(404).json({ code: 404, result: "Driver not found" });
        }

        const driver = driverResponse.data.result;
        const number = driver.number;
        const shortName = driver.shortName;
        const name = driver.name;

        let totalTime = 0;
        let completedLaps = 0;

        for (const lap of laps) {
            const lapData = lap.lapTimes.find(lt => lt.entrant === entrantIndex);
            if (lapData) {
                totalTime += lapData.time;
                completedLaps = lap.number + 1;
            }
        }

        const entrant = {
            number: number,
            shortName: shortName,
            name: name,
            uri: uri,
            laps: completedLaps,
            time: totalTime
        };

        entrants.push(entrant);
    }

    entrants.sort((a, b) => b.laps - a.laps || a.time - b.time);

    return res.status(200).json({ code: 200, result: entrants });
};


const getLeaderboard = async (req, res) => {
    const raceId = req.params.id;
    const lapNumber = req.params.number;
    const race = await fetchRace(raceId);
    if (!race) {
        return res.status(404).json({ code: 404, result: "Race not found" });
    }
    const laps = race.laps || [];
    const lap = laps.find(
        (lap) => lap.number === parseInt(lapNumber, 10)
    );
    if (!lap) {
        return res.status(404).json({ code: 404, result: "Lap not found" });
    }
    console.log(JSON.stringify(lap));
    let entrants = [];
    for (const lapTime of lap.lapTimes) {
        const uri = race.entrants[lapTime.entrant];
        const carResponse = await axios.get(uri, { httpsAgent });
        if (carResponse.data.code !== 200) {
            return res.status(404).json({ code: 404, result: "Car not found" });
        }
        const driverURL = carResponse.data.result.driver.uri;
        const driverResponse = await axios.get(driverURL, { httpsAgent });
        if (driverResponse.data.code !== 200) {
            return res.status(404).json({ code: 404, result: "Driver not found" });
        }
        const driver = driverResponse.data.result;
        const number = driver.number;
        const shortName = driver.shortName;
        const name = driver.name;

        let totalTime = 0;
        let completedLaps = 0;

        for (let i = 0; i <= lapNumber; i++) {
            const lapData = laps[i].lapTimes.find(lt => lt.entrant === lapTime.entrant);
            if (lapData && lapData.crashed === false) {
                totalTime += lapData.time;
                completedLaps = laps[i].number + 1;
            }
        }
        const entrant = {
            number: number,
            shortName: shortName,
            name: name,
            uri: uri,
            laps: completedLaps,
            time: totalTime
        };
        entrants.push(entrant);
        entrants.sort((a, b) => b.laps - a.laps || a.time - b.time);
    }
    return res.status(200).json({ code: 200, result: entrants });
};
router.get('/', getRaces);
router.get('/:id', getRace);
router.delete('/:id', apiKeyMiddleware, deleteRace);
router.get('/:id/entrant', getEntrant);
router.post('/:id/entrant', apiKeyMiddleware, addEntrant);
router.delete('/:id/entrant', apiKeyMiddleware, deleteEntrant);
router.post('/:id/qualify', apiKeyMiddleware, qualify);
router.get('/:id/lap', getlap);
router.post('/:id/lap', apiKeyMiddleware, simulateLaps);
router.get('/:id/lap/:number', getLeaderboard);
router.get('/:id/leaderboard', getLeaderboards);
export default router;