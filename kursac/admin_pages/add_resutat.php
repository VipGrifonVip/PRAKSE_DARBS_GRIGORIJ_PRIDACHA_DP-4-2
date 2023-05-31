<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kursac";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["table_name"])) {
    $table_name = $_POST["table_name"];

    $create_table_sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(30) NOT NULL,
        last_name VARCHAR(30) NOT NULL,
        birth_year INT(4) NOT NULL,
        team VARCHAR(30) NOT NULL,
        result1 INT,
        result2 INT,
        result3 INT,
        result4 INT,
        result5 INT,
        result6 INT,
        total_result INT,
        x10 VARCHAR(10)
    )";

    if ($conn->query($create_table_sql) === TRUE) {
        echo "Table created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["table_name_insert"])) {
    $table_name_insert = $_POST["table_name_insert"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $birth_year = $_POST["birth_year"];
    $team = $_POST["team"];
    $result1 = $_POST["result1"];
    $result2 = $_POST["result2"];
    $result3 = $_POST["result3"];
    $result4 = $_POST["result4"];
    $result5 = $_POST["result5"];
    $result6 = $_POST["result6"];
    $total_result = $result1 + $result2 + $result3 + $result4 + $result5 + $result6;
    $x10 = $_POST["x10"];

    $insert_sql = "INSERT INTO $table_name_insert (first_name, last_name, birth_year, team, result1, result2, result3, result4, result5, result6, total_result, x10)
                   VALUES ('$first_name', '$last_name', $birth_year, '$team', $result1, $result2, $result3, $result4, $result5, $result6, $total_result, '$x10')";

    if ($conn->query($insert_sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error inserting data: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style.css" rel="stylesheet" type="text/css">
    <title>Kursac</title>
</head>
<body>
<header>
        <div id='logo'>
        <a href="\kursac\admin_pages\admin_page.php"><span>K</span>ursač</a>
        </div>

        <div id="menuhead">
        <a href="\kursac\admin_pages\admin_disciplina.php"><div>Disciplīnas</div></a><a href="\kursac\admin_pages\admin_resultati.php"><div>Rezultāti</div></a><a href="\kursac\admin_pages\admin_kalendars.php"><div>Sacensību kalendārs</div></a><a href="\kursac\admin_pages\add_news.php"><div>Ziņas</div></a><a href="\kursac\admin_pages\add_resutat.php"><div>Pievienot rezultātus</div></a>
        </div>

        <div id="regAus">
        <a href="..\functions\logaut.php">Izrakstīties</a>
        </div>

    </header>
   <main>
    <div id="wrapper">
        <div id="leftCol">
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <label for="table_name">Tabulas nosaukums:</label>
                <input type="text" name="table_name" required><br>
                <input type="submit" value="Izveidot tabulu">
            </form>
            <hr>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <label for="table_name_insert">Tabulas nosaukums:</label><input type="text" name="table_name_insert" required><br>
                <label for="first_name">Vārds:</label><input type="text" name="first_name" required><br>
                <label for="last_name">Uzvārds:</label><input type="text" name="last_name" required><br>
                <label for="birth_year">Dzimšanas gads:</label><input type="number" name="birth_year" required><br>
                <label for="team">Komanda:</label><input type="text" name="team" required><br>
                <label for="result1">Rezultāts 1:</label><input type="number" name="result1"><br>
                <label for="result2">Rezultāts 2:</label><input type="number" name="result2"><br>
                <label for="result3">Rezultāts 3:</label><input type="number" name="result3"><br>
                <label for="result4">Rezultāts 4:</label><input type="number" name="result4"><br>
                <label for="result5">Rezultāts 5:</label><input type="number" name="result5"><br>
                <label for="result6">Rezultāts 6:</label><input type="number" name="result6"><br>
                <label for="x10">x10:</label><input type="text" name="x10"><br>
                <input type="submit" value="Ievietot">
            </form>
        </div>
        <div id="rightCol">
                <img src="..\img\facebook.png" ><br>
                <img src="..\img\IZM.png" ><br>
                <img src="..\img\Karlis_Kreslins_baneris.jpg" ><br>
                <img src="..\img\LOK.png" ><br>
        </div>
    </div>
</main>
    <footer>
        <div id="rights"> All rights reserved &copy; <?=date ('Y')?></div>
    </footer>
</body>
</html>