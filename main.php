<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/execSQL.php");
// $sql = "SELECT * FROM category ORDER BY id";
// $result = executeQuery($sql);
// $rows = pg_num_rows($result);
// $categoryList;
// while($row = pg_fetch_array($result)){
//     echo $row["id"] . $row["name"];
// }
// pg_free_result($result);
?>

<html>
<head>
    <title>sqlAPI</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.min.css">
    <script type="text/javascript">
        function disp(url){
            window.open(url, "window_name", "width=300,height=200,scrollbars=yes");
        }
</script>
</head>
<body>
<p><a href="/">Home</a></p>
<p><a href="./category.php" target="window_name" onClick="disp('category.php')">category</a></p>
<p><a href="./junre.php" target="window_name" onClick="disp('junre.php')">junre</a></p>

<h1>Main</h1>

<form action="#" method="get">
    <input type="text" name="id">
    <input type="submit" value="検索">
</form>

<form action="#" method="post">

<?php
if(isset($_POST["title"])){
    $sql = "UPDATE main SET
    title = '{$_POST["title"]}',
    category = {$_POST["category"]},
    url = '{$_POST["url"]}',
    junre_1 = {$_POST["junre_1"]},
    junre_2 = {$_POST["junre_2"]},
    junre_3 = {$_POST["junre_3"]},
    update = '{$_POST["update"]}'
    WHERE id = {$_GET["id"]}
    ";
    $result = executeQuery($sql);
    if(isset($result)){
        echo "successfully updated.";
    }
}
if(isset($_GET["add_id"])){
    $sql = "INSERT INTO main VALUES({$_GET['add_id']}, '{$_GET['add_title']}', {$_GET['add_category']}, '{$_GET['add_url']}', {$_GET['add_junre_1']}, {$_GET['add_junre_2']}, {$_GET['add_junre_3']}, '{$_GET['add_update']}')";
    $result = executeQuery($sql);
    if(isset($result)){
        echo "successfully inserted.";
    }
    else{
        echo "error occured";
    }
    pg_free_result($result);
}
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "SELECT * FROM main where id = {$id} ORDER BY id";
    $result = executeQuery($sql);
    $rows = pg_num_rows($result);

    if($rows){
        print<<<EOT
            <table border="1">
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>URL</th>
                    <th>junre_1</th>
                    <th>junre_2</th>
                    <th>junre_3</th>
                    <th>update</th>
                </tr>
EOT;
        $row = pg_fetch_array($result);
        print<<<EOT
            <tr>
                <td>{$row["id"]}</td>
                <td><input type="text" name="title" value={$row["title"]} size="10"></td>
                <td><input type="text" name="category" value={$row["category"]} size="1"></td>
                <td><input type="text" name="url" value={$row["url"]} size="10"></td>
                <td><input type="text" name="junre_1" value={$row["junre_1"]} size="2"></td>
                <td><input type="text" name="junre_2" value={$row["junre_2"]} size="2"></td>
                <td><input type="text" name="junre_3" value={$row["junre_3"]} size="2"></td>
                <td><input type="text" name="update" value={$row["update"]} size="10"></td>
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

<table border="1">
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Category</th>
        <th>URL</th>
        <th>junre_1</th>
        <th>junre_2</th>
        <th>junre_3</th>
        <th>update</th>
    </tr>
    <form action="#" method="get">
        <tr>
            <td><input type="text" name="add_id" size="3"></td>
            <td><input type="text" name="add_title"></td>
            <td><input type="text" name="add_category"></td>
            <td><input type="text" name="add_url"></td>
            <td><input type="text" name="add_junre_1"></td>
            <td><input type="text" name="add_junre_2"></td>
            <td><input type="text" name="add_junre_3"></td>
            <td><input type="text" name="add_update"></td>
        </tr>
        <input type="submit" value="追加">
    </form>

<?php
    $sql = "SELECT * FROM main ORDER BY id";
    $result = executeQuery($sql);
    while($row = pg_fetch_array($result)){
        print<<<EOT
        <tr>
            <td>{$row["id"]}</td>
            <td>{$row["title"]}</td>
            <td>{$row["category"]}</td>
            <td>{$row["url"]}</td>
            <td>{$row["junre_1"]}</td>
            <td>{$row["junre_2"]}</td>
            <td>{$row["junre_3"]}</td>
            <td>{$row["update"]}</td>
        </tr>
EOT;
    }
    pg_free_result($result);
?>
</table>

</body>

</html>