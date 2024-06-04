<?php

$dbHost = "localhost";
$dbName = "fahmi_dania";
$dbUser = "root";
$dbPass = "";
$connection = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName) or die(mysqli_error($connection));

//for get data
function query($query)
{
    global $connection;
    $returnQuery = mysqli_query($connection, $query);

    $temp = [];
    while ($line = mysqli_fetch_assoc($returnQuery)) {
        $temp[] = $line;
    }

    return $temp;
}

//function create comment
function createComment($data)
{
    global $connection;

    $name_user     = htmlspecialchars($data['name_user']);
    $status_user   = htmlspecialchars($data['status_user']);
    $comment       = htmlspecialchars($data['comment']);
    $created_at    = date('Y-m-d H:i:s');

    $query = "INSERT INTO comments (name_user, status_user, comment, created_at) VALUES 
                ('$name_user', '$status_user' , '$comment', '$created_at')";

    mysqli_query($connection, $query);

    return mysqli_affected_rows($connection);
}
