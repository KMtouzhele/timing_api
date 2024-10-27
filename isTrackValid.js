export const isTrackValid = (req, res, next) => {
    const { baseLapTime, laps, name, type } = req.body;
    if (!name || !type || !laps || !baseLapTime) {
        return res.status(400).send('Missing required fields');
    }
    if (type !== 'street' && type !== 'race') {
        return res.status(400).send('Invalid track type');
    }
    const lapsInt = parseInt(laps, 10);
    const baseLapTimeFloat = parseFloat(baseLapTime);
    if (isNaN(lapsInt) || isNaN(baseLapTimeFloat)) {
        return res.status(400).send('Invalid lap count or base lap time');
    }
    next();
};
