import express from 'express';
import tracksRouter from './tracks.js'
import racesRouter from './rc'

const app = express();
const PORT = 3389;

//enable CORS (this lets us make requests from any origin, including localhost)
app.use((req, res, next) => {
    res.header('Access-Control-Allow-Origin', '*');
    res.header('Access-Control-Allow-Methods', 'GET,PUT, POST,DELETE');
    next();
});

//parse JSON and URL encoded data
app.use(express.json());
app.use(express.urlencoded({extended: true}));
app.use("/track", tracksRouter);
app.use("/race", racesRouter);

//finally, serve it on the specified port
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});