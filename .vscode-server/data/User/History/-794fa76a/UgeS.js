export const isTrackValid = (req, res, next) => {
    const { name, type, laps, baseLapTime } = req.body;
    if (!name || !type || !laps || !baseLapTime) {
        return res.status(400).send('Missing required fields');
    }
    if (type !== 'street' && type !== 'race') {
        return res.status(400).send('Invalid track type');
    }
    next();
};
