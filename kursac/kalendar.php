<!DOCTYPE html>
<html lang="lv"><head>
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
        <div id="TextHeader">
        </div>    
        <div id="wrapper">
            <div id="leftCol">
                <H2>Sacensību kalendārs</H2>
                <center>
                    <iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=2&bgcolor=%23616161&ctz=Europe%2FRiga&showTitle=0&showCalendars=0&showTz=0&showDate=0&showNav=0&showTabs=0&src=cnUubGF0dmlhbi5vZmZpY2lhbCNob2xpZGF5QGdyb3VwLnYuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&color=%230B8043" style="border-width:0" width="600" height="400" frameborder="0" scrolling="no"></iframe>
                </center>  
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