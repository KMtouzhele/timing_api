import express from 'express';
import moviesRouter from './movies.js';

const app = express();
const PORT = 3389;

//enable CORS (this lets us make requests from any origin, including localhost)
app.use((req, res, next) => {
    res.header('Access-Control-Allow-Origin', '*');
    res.header('Access-Control-Allow-Methods', 'GET,PUT, POST,DELETE');
    next();
});

//parse JSON and URL encoded data
app.use(express.urlencoded({extended: true}));

//finally, serve it on the specified port
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});

app.use("/movie", moviesRouter);