<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kursac";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Savienojums neizdevās: " . $conn->connect_error);
}

$sql = "SELECT * FROM Disciplina";
$result = $conn->query($sql);
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
            <a href="user_page.php"><span>K</span>ursač</a>
        </div>

        <div id="menuhead">
        <a href="user_dis.php"><div>Disciplīnas</div></a><a href="user_resultati.php"><div>Rezultāti</div></a><a href="user_kalendar.php"><div>Sacensību kalendārs</div></a><a href="user_trenini.php"><div>Treniņi</div></a>
        </div>

        <div id="regAus">
            <a href="..\functions\logaut.php">Izrakstīties</a>
        </div>
</header>
    <main>
        <div id="TextHeader">   
            <div id="wrapper">
                <div id="leftCol">
                    <H2>Disciplīnas</H2>
                    <center>
                    <table>
                        <tr>
                            <th>Nosaukums</th>
                            <th>Savienusērijas</th>
                            <th>Attālums</th>
                            <th>Laiks</th>
                            <th>Ierocu tips</th>
                        </tr>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['Nosaukums'] . "</td>";
                                echo "<td>" . $row['savenuserijas'] . "</td>";
                                echo "<td>" . $row['Attalums'] . "</td>";
                                echo "<td>" . $row['Laiks'] . "</td>";
                                echo "<td>" . $row['Ierocu_tips'] . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </table>
                    </center>
                </div>
                <div id="rightCol">
                    <img src="..\img\facebook.png" ><br>
                    <img src="..\img\IZM.png" ><br>
                    <img src="..\img\Karlis_Kreslins_baneris.jpg" ><br>
                    <img src="..\img\LOK.png" ><br>
                </div>
            </div>
        </div>
    </main>

    <footer>

        <div id="rights"> All rights reserved &copy; <?=date ('Y')?></div>

    </footer>
</body>
</html>