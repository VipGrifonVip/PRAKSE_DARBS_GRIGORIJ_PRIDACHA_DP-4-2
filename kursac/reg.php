<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kursac";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Datubāzes pieslēguma kļūda:" . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Vards = $_POST["Vards"];
    $Uzvards = $_POST["Uzvards"];
    $Vecums = $_POST["Vecums"];
    $Dimums = $_POST["Dimums"];
    $Email = $_POST["Email"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 
    $Roole = "User";

    $sql = "SELECT * FROM users WHERE Email = '$Email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $error_message = "Пользователь с таким адресом электронной почты уже существует";
    } else {
        $sql = "INSERT INTO users (Vards, Uzvards, Vecums, Dimums, Email, parole, Roole) VALUES ('$Vards', '$Uzvards', '$Vecums', '$Dimums', '$Email', '$hashedPassword', '$Roole')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION["Email"] = $Email;
            header("Location: aut.php");
        } else {
            $error_message = "Ошибка при создании пользователя: " . $conn->error;
        }
    }
}
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
            <a href="\kursac\disciplina.php"><div>Disciplīnas</div></a>
            <a href="\kursac\rezultati.php"><div>Rezultāti</div></a>
            <a href="\kursac\kalendar.php"><div>Sacensību kalendārs</div></a>
        </div>

        <div id="regAus">
            <a href="\kursac\reg.php">Reģistrācija</a> | <a href="\kursac\aut.php">Autorizācija</a>
        </div>
    </header>

    <main>
        <div id="wrapper">
            <div id="leftCol">
                <h2>Reģistrācija</h2>
                <center>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="text" name="Vards" placeholder="Vārds" required><br>
                    <input type="text" name="Uzvards" placeholder="Uzvārds" required><br>
                    <input type="number" name="Vecums" placeholder="Vecums" required><br>
                    <select name="Dimums" required>
                        <option value="male">Vīrietis</option>
                        <option value="female">Sieviete</option>
                    </select><br>
                    <input type="email" name="Email" placeholder="E-pasta adrese" required><br>
                    <input type="password" name="password" placeholder="Parole" required><br>
                    <input type="submit" value="Ienākt">
                </form>
                </center>
            </div>
            <div id="rightCol">
                <img src="img\facebook.png"><br>
                <img src="img\IZM.png"><br>
                <img src="img\Karlis_Kreslins_baneris.jpg"><br>
                <img src="img\LOK.png"><br>
            </div>
        </div>
    </main>

    <footer>
        <div id="rights"> All rights reserved &copy; <?=date ('Y')?></div>
    </footer>
</body>
</html>
