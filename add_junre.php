<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/execSQL.php");
?>

<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/execSQL.php");
?>

<html>
<head>
    <title>sqlAPI</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.min.css">
</head>
<body>
<p><a href="/">Home</a></p>

<h1>Add junre</h1>

<form action="#" method="get">
    <input type="text" name="search_main_id">
    <input type="text" name="search_junre_id">
    <input type="submit" value="検索">
</form>

<form action="#" method="post">

<?php
//更新
if(isset($_POST["change"])){
    $sql = "UPDATE junre_relation SET main_id={$_POST['main_id']}, junre_id ={$_POST['junre_id']} WHERE main_id={$_POST['change_main_id']} AND junre_id={$_POST['change_junre_id']}";
    $result = executeQuery($sql);
    if(isset($result)){
        echo "successfully updated.";
    }
}
//追加
if(isset($_GET["add_main_id"])){
    $sql = "INSERT INTO junre_relation VALUES({$_GET['add_main_id']}, '{$_GET['add_junre_id']}')";
    $result = executeQuery($sql);
    if(isset($result)){
        echo "successfully inserted.";
    }
    else{
        echo "error occured";
    }
    pg_free_result($result);
}
//削除
if(isset($_POST["delete"])){
    $sql = "DELETE FROM junre_relation WHERE main_id={$_POST['main_id']} AND junre_id={$_POST['junre_id']}";
    $result = executeQuery($sql);
    if(isset($result)){
        echo "successfully deleted.";
    }
    else{
        echo "error occured";
    }
    pg_free_result($result);
}
//検索(→削除、更新)
if(isset($_GET["search_main_id"])){
    $main_id = $_GET["search_main_id"];
    $junre_id = $_GET["search_junre_id"];
    $sql = "SELECT * FROM junre_relation WHERE main_id = {$main_id} AND junre_id = {$junre_id} ORDER BY junre_id";
    $result = executeQuery($sql);
    $rows = pg_num_rows($result);

    if($rows){
        print<<<EOT
            <table border="1">
                <tr>
                    <th>main_id</th>
                    <th>junre_id</th>
                </tr>
EOT;
        $row = pg_fetch_array($result);
        print<<<EOT
            <tr>
                <td><input type="text" name="main_id" value={$row["main_id"]} size="5"></td>
                <td><input type="text" name="junre_id" value={$row["junre_id"]} size="5"></td>
            </tr>
EOT;
        echo "</table>";
    }
    else{
        echo "Invalid scope.\n";
    }
    pg_free_result($result);
}

?>

    <p>
        <input type="submit" name="change" value="変更">
        <input type="submit" name="delete" value="削除">
        <input type="hidden" name="change_main_id" value="<?= $main_id?>">
        <input type="hidden" name="change_junre_id" value="<?= $junre_id?>">
    </p>
</form>

<table border="1">
    <tr>
        <th>main_id</th>
        <th>junre_id</th>
    </tr>
    <form action="#" method="get">
        <tr>
            <td><input type="text" name="add_main_id" size="10"></td>
            <td><input type="text" name="add_junre_id"size="10"></td>
        </tr>
        <input type="submit" value="追加">
    </form>

<?php
    $sql = "SELECT * FROM junre_relation ORDER BY main_id, junre_id";
    $result = executeQuery($sql);
    while($row = pg_fetch_array($result)){
        print<<<EOT
        <tr>
            <td>{$row["main_id"]}</td>
            <td>{$row["junre_id"]}</td>
        </tr>
EOT;
    }
    pg_free_result($result);
?>
</table>

</body>

</html>