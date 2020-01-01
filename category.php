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

<h1>Category</h1>

<form action="#" method="get">
    <input type="text" name="id">
    <input type="submit" value="検索">
</form>

<form action="#" method="post">

<?php
if(isset($_POST["category"])){
    $sql = "UPDATE category SET name = '{$_POST["category"]}' WHERE id = {$_GET["id"]}";
    $result = executeQuery($sql);
    if(isset($result)){
        echo "successfully updated.";
    }
}
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "SELECT * FROM category where id = {$id} ORDER BY id";
    $result = executeQuery($sql);
    $rows = pg_num_rows($result);

    if($rows){
        print<<<EOT
            <table border="1">
                <tr>
                    <th>Id</th>
                    <th>Category</th>
                </tr>
EOT;
        $row = pg_fetch_array($result);
        print<<<EOT
            <tr>
                <td>{$row["id"]}</td>
                <td><input type="text" name="category" value={$row["name"]} size="10"></td>
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

    <p><input type="submit" name="submit" value="変更"></p>
</form>

</body>

</html>