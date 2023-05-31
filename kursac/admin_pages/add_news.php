<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kursac";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Savienojums neizdevās: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];

    $targetDirectory = "../uploads/";
    $targetFile = $targetDirectory . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Fails nav attēls.";
            $uploadOk = 0;
        }
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            $photo = $targetFile;

            $sql = "INSERT INTO news (photo, title, content) VALUES ('$photo', '$title', '$content')";
            if ($conn->query($sql) === TRUE) {
                echo "Ziņa veiksmīgi pievienota.";
            } else {
                echo "Kļūda pievienojot ziņu: " . $conn->error;
            }
        } else {
            echo "Kļūda augšupielādējot failu.";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"])) {
    $title = $_GET["delete"];

    $sql = "DELETE FROM news WHERE title = '$title'";
    if ($conn->query($sql) === TRUE) {
        echo "Ziņa veiksmīgi dzēsta.";
    } else {
        echo "Kļūda dzēšot ziņu: " . $conn->error;
    }
}

$sql = "SELECT * FROM news ORDER BY created_at DESC";
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
                <h2>Ziņas</h2>
                <center>
                <form method="post" action="add_news.php" enctype="multipart/form-data">
                <input type="file" name="photo" required><br>
                <input type="text" name="title" placeholder="Virsraksts" required><br>
                <textarea name="content" placeholder="Saturs" required></textarea><br>
                <input type="submit" value="Pievienot ziņu">
                </form>
                </center>
                
                <h2>Dzēst ziņu</h2>
                <center>
                <form method="get" action="add_news.php">
                <select name="delete">
                </center>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['title'] . "'>" . $row['title'] . "</option>";
                    }
                }
                ?>
                </select><br>
                <input type="submit" value="Dzēst">
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
        <div id="rights"> Visas tiesības aizsargātas &copy; <?=date ('Y')?></div>
    </footer>
</body>
</html>
