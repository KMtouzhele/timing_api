// Import the Express Library
const express = require('express');

// Define the port the server will run on
const PORT = 3389;

// Create a new express app
const app = express();

// Start the server on the specified PORT
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
