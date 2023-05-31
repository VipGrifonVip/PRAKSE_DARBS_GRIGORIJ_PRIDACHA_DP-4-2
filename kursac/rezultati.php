<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Kursac</title>
</head>

<body>
    <header>
        <div id='logo'>
            <a href="/kursac/"><span>K</span>ursač</a>
        </div>

        <div id="menuhead">
        <a href="/kursac/disciplina.php"><div>Disciplīnas</div></a><a href="/kursac/rezultati.php"><div>Rezultāti</div></a><a href="/kursac/kalendar.php"><div>Sacensību kalendārs</div></a>
        </div>

        <div id="regAus">
            <a href="/kursac/reg.php">Reģistrācija</a> | <a href="/kursac/aut.php">Autorizācija</a>
        </div>

    </header>
    <main>
        <div id="TextHeader">
        </div>    
        <div id="wrapper">
            <div id="leftCol">
            <h2>Rezultāti</h2>
            <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kursac";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Savienojums neizdevās: " . $conn->connect_error);
}

$tables_sql = "SHOW TABLES";
$tables_result = $conn->query($tables_sql);

if ($tables_result->num_rows > 0) {
    echo "<form method='get' action='" . $_SERVER['PHP_SELF'] . "'>";
    echo "<label for='table_name'>Izvēlieties tabulu:</label>";
    echo "<select name='table_name'>";

    while ($table_row = $tables_result->fetch_assoc()) {
        $table_name = $table_row["Tables_in_$dbname"];

        if (in_array($table_name, ["users", "disciplina", "news", "sporta_klase"]) || strpos($table_name, "table_") === 0) {
            continue;
        }

        echo "<option value='$table_name'>$table_name</option>";
    }

    echo "</select>";
    echo "<input type='submit' value='Parādīt tabulu'>";
    echo "</form>";

    if (isset($_GET['table_name'])) {
        $selected_table = $_GET['table_name'];

        $select_sql = "SELECT * FROM $selected_table ORDER BY total_result DESC";
        $select_result = $conn->query($select_sql);

        if ($select_result->num_rows > 0) {
            echo "<h2>$selected_table</h2>";
            echo "<table>";
            echo "<tr><th>Vārds</th><th>Uzvārds</th><th>Dzimšanas gads</th><th>Komanda</th><th>Rezultāts 1</th><th>Rezultāts 2</th><th>Rezultāts 3</th><th>Rezultāts 4</th><th>Rezultāts 5</th><th>Rezultāts 6</th><th>Kopējais rezultāts</th><th>x10</th></tr>";

            while ($row = $select_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>" . $row["birth_year"] . "</td>";
                echo "<td>" . $row["team"] . "</td>";
                echo "<td>" . $row["result1"] . "</td>";
                echo "<td>" . $row["result2"] . "</td>";
                echo "<td>" . $row["result3"] . "</td>";
                echo "<td>" . $row["result4"] . "</td>";
                echo "<td>" . $row["result5"] . "</td>";
                echo "<td>" . $row["result6"] . "</td>";
                echo "<td>" . $row["total_result"] . "</td>";
                echo "<td>" . $row["x10"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";

            // Создание временного файла для записи данных таблицы
            $filename = $selected_table . '.csv'; // Имя файла
            $temp_file = fopen($filename, 'w');

            // Запись заголовков в файл
            $headers = ["First Name", "Last Name", "Birth Year", "Team", "Result 1", "Result 2", "Result 3", "Result 4", "Result 5", "Result 6", "Total Result", "x10"];
            fputcsv($temp_file, $headers);

            // Запись данных строк таблицы в файл
            mysqli_data_seek($select_result, 0); // Сброс указателя результата запроса
            while ($row = $select_result->fetch_assoc()) {
                fputcsv($temp_file, $row);
            }

            fclose($temp_file);

            echo "<p><a href='$filename'>Lejupielādēt CSV</a></p>";

            // Удаление временного файла
            unlink($filename);
        } else {
            echo "Tabulā $selected_table nav atrasti dati";
        }
    }
} else {
    echo "Datubāzē nav atrastas tabulas";
}

$sql = "SELECT * FROM sporta_klase";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $sporta_klases = $row["Sporta_klases"];
        $nosaukums = $row["Nosaukums"];
        $rezultats = $row["Rezultats"];

        $data[$sporta_klases][$nosaukums] = $rezultats;
    }

    echo "<h2>Sporta klases</h2>";
    echo "<table>";
    echo "<tr><th></th>";

    $nosaukumi = array_keys($data[array_key_first($data)]);
    foreach ($nosaukumi as $nosaukums) {
        echo "<th>$nosaukums</th>";
    }

    echo "</tr>";

    foreach ($data as $sporta_klases => $row) {
        echo "<tr>";
        echo "<th>$sporta_klases</th>";

        foreach ($nosaukumi as $nosaukums) {
            echo "<td>" . $row[$nosaukums] . "</td>";
        }

        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Tabulā sporta_klase nav atrasti dati";
}

$conn->close();
?>
            </div>
            <div id="rightCol">
                <img src="img/facebook.png" ><br>
                <img src="img/IZM.png" ><br>
                <img src="img/Karlis_Kreslins_baneris.jpg" ><br>
                <img src="img/LOK.png" ><br>
            </div>
        </div>
    </main>
    <footer>
        <div id="rights"> All rights reserved &copy; <?=date ('Y')?></div>
    </footer>
</body>
</html>
