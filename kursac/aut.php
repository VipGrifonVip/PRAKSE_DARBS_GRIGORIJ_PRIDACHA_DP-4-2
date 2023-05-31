<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kursac";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Datubāzes pieslēguma kļūda: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = $_POST["Email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE Email = '$Email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["Parole"])) {
            $_SESSION["Email"] = $Email;
            $_SESSION["user_id"] = $row["SP_ID"];

            if ($row["Roole"] === "Admin") {
                $_SESSION["Roole"] = "Admin";
                header("Location: admin_pages/admin_page.php");
            } else {
                $_SESSION["Roole"] = "User";
                header("Location: user_pages/user_page.php");
            }
            exit();
        } else {
            $error_message = "Nepareiza parole";
        }
    } else {
        $error_message = "Lietotājs ar šādu e-pasta adresi nav atrasts";
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
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Kursac</title>
</head>
<body>
    <header>
        <div id='logo'>
            <a href="/kursac/"><span>K</span>ursač</a>
        </div>

        <div id="menuhead">
        <a href="\kursac\disciplina.php"><div>Disciplīnas</div></a><a href="\kursac\rezultati.php"><div>Rezultāti</div></a><a href="\kursac\kalendar.php"><div>Sacensību kalendārs</div></a>
        </div>

        <div id="regAus">
            <a href="\kursac\reg.php">Reģistrācija</a> | <a href="\kursac\aut.php">Autorizācija</a>
        </div>

    </header>

    <main> 
        <div id="wrapper">
            <div id="leftCol">
                <h2>Autorizācija</h2>
                <center>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="email" name="Email" placeholder="E-pasta adrese" required><br><br>
                        <input type="password" name="password" placeholder="Parole" required><br><br>
                        <input type="submit" value="Ienākt">
                    </form>
                </center>
                    <?php if (isset($error_message)) { echo $error_message; } ?>
                
            </div>
            <div id="rightCol">
                <img src="img\facebook.png" ><br>
                <img src="img\IZM.png" ><br>
                <img src="img\Karlis_Kreslins_baneris.jpg" ><br>
                <img src="img\LOK.png" ><br>
            </div>
        </div>
    </main>

    <footer>
        <div id="rights"> All rights reserved &copy; <?=date ('Y')?></div>
    </footer>
</body>
</html>
