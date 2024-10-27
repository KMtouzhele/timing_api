export const apiKeyMiddleware = (req, res, next) => {
    const apiKey = req.headers['x-api-key'];
    const validApiKey = 'Wells';
    if (apiKey !== validApiKey) {
        return res.status(404).json({ 
            code: 404,
            result: 'Invalid API Key' 
        });
    }
    next();
};
