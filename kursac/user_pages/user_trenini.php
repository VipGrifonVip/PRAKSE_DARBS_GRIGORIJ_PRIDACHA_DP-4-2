<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="..\style.css" rel="stylesheet" type="text/css">
    <title>Kursac</title>
</head>
<body>
    <header>
        <div id='logo'>
            <a href="user_page.php"><span>K</span>ursač</a>
        </div>

        <div id="menuhead">
            <a href="user_dis.php"><div>Disciplīnas</div></a>
            <a href="user_resultati.php"><div>Rezultāti</div></a>
            <a href="user_kalendar.php"><div>Sacensību kalendārs</div></a>
            <a href="user_trenini.php"><div>Treniņi</div></a>
        </div>

        <div id="regAus">
            <a href="..\functions\logaut.php">Izrakstīties</a>
        </div>
    </header>
<main>
    <h2>Datu tabulas aizpildes forma</h2>
    <form method="POST" action="">
        <label for="int_field1">Vesels lauks 1:</label>
        <input type="number" name="int_field1" required><br>

        <label for="int_field2">Vesels lauks 2:</label>
        <input type="number" name="int_field2" required><br>

        <label for="int_field3">Vesels lauks 3:</label>
        <input type="number" name="int_field3" required><br>

        <label for="int_field4">Vesels lauks 4:</label>
        <input type="number" name="int_field4" required><br>

        <label for="int_field5">Vesels lauks 5:</label>
        <input type="number" name="int_field5" required><br>

        <label for="int_field6">Vesels lauks 6:</label>
        <input type="number" name="int_field6" required><br>

        <label for="date_field">Datums:</label>
        <input type="date" name="date_field" required><br>

        <input type="submit" name="submit" value="Pievienot datus">
    </form>

    
</main>
<footer>

<div id="rights"> All rights reserved &copy; <?=date ('Y')?></div>

</footer>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kursac";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../aut.php");
    exit();
}

$userId = $_SESSION['user_id'];

if (isset($_POST['submit'])) {
    $int_field1 = $_POST['int_field1'];
    $int_field2 = $_POST['int_field2'];
    $int_field3 = $_POST['int_field3'];
    $int_field4 = $_POST['int_field4'];
    $int_field5 = $_POST['int_field5'];
    $int_field6 = $_POST['int_field6'];
    $date_field = $_POST['date_field'];

    $table = "table_" . mysqli_real_escape_string($conn, $userId);

$sql = "CREATE TABLE IF NOT EXISTS $table (
    SP_ID INT(6),
    int_field1 INT,
    int_field2 INT,
    int_field3 INT,
    int_field4 INT,
    int_field5 INT,
    int_field6 INT,
    date_field DATE,
    FOREIGN KEY (SP_ID) REFERENCES Users(SP_ID)
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabula veiksmīgi izveidota.";
} else {
    echo "Kļūda, veidojot tabulu: " . $conn->error;
}

$insertSql = "INSERT INTO $table (int_field1, int_field2, int_field3, int_field4, int_field5, int_field6, date_field)
    VALUES ('$int_field1', '$int_field2', '$int_field3', '$int_field4', '$int_field5', '$int_field6', '$date_field')";

if ($conn->query($insertSql) === TRUE) {
    echo "Dati veiksmīgi pievienoti tabulā.";
} else {
    echo "Kļūda, pievienojot datus: " . $conn->error;
}

$selectSql = "SELECT * FROM $table";
$result = $conn->query($selectSql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>SP_ID</th><th>int_field1</th><th>int_field2</th><th>int_field3</th><th>int_field4</th><th>int_field5</th><th>int_field6</th><th>date_field</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['SP_ID']."</td>";
        echo "<td>".$row['int_field1']."</td>";
        echo "<td>".$row['int_field2']."</td>";
        echo "<td>".$row['int_field3']."</td>";
        echo "<td>".$row['int_field4']."</td>";
        echo "<td>".$row['int_field5']."</td>";
        echo "<td>".$row['int_field6']."</td>";
        echo "<td>".$row['date_field']."</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Tabula ir tukša.";
}

    
}

$conn->close();
?>



</body>
</html>
