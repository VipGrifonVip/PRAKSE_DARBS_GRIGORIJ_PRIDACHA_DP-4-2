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
        <div id="TextHeader">
        </div>    
        <div id="wrapper">
            <div id="leftCol">
            <H2>Rezultāti</H2>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "kursac";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $tables_sql = "SHOW TABLES";
            $tables_result = $conn->query($tables_sql);

            if ($tables_result->num_rows > 0) {
                echo "<form method='get' action='" . $_SERVER['PHP_SELF'] . "'>";
                echo "<label for='table_name'>Select Table:</label>";
                echo "<select name='table_name'>";

                while ($table_row = $tables_result->fetch_assoc()) {
                    $table_name = $table_row["Tables_in_$dbname"];

                    if (in_array($table_name, ["users", "disciplina", "news", "sporta_klase"]) || strpos($table_name, "table_") === 0) {
                        continue;
                    }

                    echo "<option value='$table_name'>$table_name</option>";
                }

                echo "</select>";
                echo "<input type='submit' value='Show Table'>";
                echo "</form>";

                if (isset($_GET['table_name'])) {
                    $selected_table = $_GET['table_name'];

                    $select_sql = "SELECT * FROM $selected_table ORDER BY total_result DESC";
                    $select_result = $conn->query($select_sql);

                    if ($select_result->num_rows > 0) {
                        echo "<h2>$selected_table</h2>";
                        echo "<table>";
                        echo "<tr><th>First Name</th><th>Last Name</th><th>Birth Year</th><th>Team</th><th>Result 1</th><th>Result 2</th><th>Result 3</th><th>Result 4</th><th>Result 5</th><th>Result 6</th><th>Total Result</th><th>x10</th></tr>";

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
                    } else {
                        echo "No data found in table: $selected_table";
                    }
                }
            } else {
                echo "No tables found in the database";
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
                echo "No data found in table: sporta_klase";
            }

            $conn->close();
            ?>
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