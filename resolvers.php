<?php

$MyDB = new mysqli("localhost", "root", "", "example");

if ($MyDB->connect_errno) {
    error_log("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

function sql($query) {
    global $MyDB;
    $result = mysqli_query($MyDB, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);  

    return $rows;
}

return [
    'Person' => [
        'pets' =>  function($root, $args) {
            return sql("SELECT isDog, sound FROM pets WHERE owner = {$root['id']};");
        },
    ],
    'Query' => [
        'getPerson' => function($root, $args, $context) {
            return sql("SELECT name, id FROM people")[0];
        }
    ]
];