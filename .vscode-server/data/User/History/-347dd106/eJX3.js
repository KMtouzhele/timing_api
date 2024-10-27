export const apiKeyMiddleware = (req, res, next) => {
    const apiKey = req.headers['x-api-key'];
    const validApiKey = 'Wells';
    if (apiKey !== validApiKey) {
        return res.status(401).json({
            code: 401,
            result: 'Invalid API Key'
        });
    }
    next();
};
