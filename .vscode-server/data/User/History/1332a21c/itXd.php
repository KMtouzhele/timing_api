<?php

class ViewSearchBox
{
    public function output()
    {
        ?>
        <div>
            <h2>Search for Customers</h2>
            <form method="GET" action="">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter name">
                <button type="submit">Search</button>
            </form>
        </div>
        <?php
    }
}
?>