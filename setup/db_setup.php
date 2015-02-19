<?php
    /* Info to hook up to a database.
    * This is imported by other pages to set up the database. This
    * page should never be called directly.
    */
    $username = "dmahockey";
    $password = "dmahockey";
    $database = "hockey";
    $server   = "localhost";
 
    // This connects to the database server. It is necessary before
    // doing any database commands.
    $connection = mysqli_connect($server,$username,$password,$database);

  ?>