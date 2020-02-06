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

<div class="change">
    <a href="./main.php">Change page information</a>
    <a href="./category.php">Change category</a>
    <a href="./junre.php">Change junre</a>
</div>

<?php
$sql = "SELECT main.id, main.title, category.name as category, main.url, j1.name as junre_1, j2.name as junre_2, j3.name as junre_3, main.good, main.update
FROM main inner join category ON main.category = category.id
inner join junre as j1 ON main.junre_1 = j1.id
inner join junre as j2 ON main.junre_2 = j2.id
inner join junre as j3 ON main.junre_3 = j3.id
order by id;
";
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
                <th>good</th>
                <th>update</th>
            </tr>
EOT;
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
                <td>{$row["good"]}</td>
                <td>{$row["update"]}</td>
            </tr>
EOT;
    }
    echo "</table>";
}

pg_free_result($result);
?>

</body>
</html>