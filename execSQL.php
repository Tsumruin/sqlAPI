<?php

function executeQuery($sql){
    $database_url = parse_url(getenv('DATABASE_URL'));
    $url = $database_url["host"];
    $port = $database_url["port"];
    $user = $database_url["user"];
    $pass = $database_url["pass"];
    $db = substr($database_url['path'], 1);

    $link = pg_connect("host={$url} port={$port} dbname={$db} user={$user} password={$pass}");
    if(!$link){
        echo "エラーが発生しました。";
        die();
    }

    $result = pg_query($sql);

    return $result;
}
?>