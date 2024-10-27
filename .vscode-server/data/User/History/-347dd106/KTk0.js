export const apiKeyMiddleware = (req, res, next) => {
    const apiKey = req.headers['x-api-key'];
    const validApiKey = 'Wells';
    if (apiKey !== validApiKey) {
        return res.status(401).json({ message: 'Invalid API Key' });
    }
    next();
};
