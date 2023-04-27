<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Filmoteka</title>
    <link rel="stylesheet" href="styl3.css">
</head>
<body>
<div class="top">
    <img src="klaps.png" alt="Nasze filmy">
</div>
<div class="top"><h1>BAZA FILMÓW</h1></div>
<div class="top">
    <form method="post" action="index.php">
        <select name="genre">
            <option value="Sci-Fi">Sci-Fi</option>
            <option value="animacja">Animacja</option>
            <option value="dramat" selected>Dramat</option>
            <option value="horror">Horror</option>
            <option value="komedia">Komedia</option>
        </select>
        <input type="submit" name="Filmy" value="WYŚLIJ">
    </form>
</div>
<div class="top"><img src="gwiezdneWojny.jpg" alt="szturmowcy"></div>
<div class="main">
    <h2>Wybrano filmy:</h2>
    <?php
    if(!empty($_POST)) {
        $db = mysqli_connect("localhost","root","","dane");
        mysqli_set_charset($db,"utf8");
        $selected_genre = $_POST['genre'];
        $q="SELECT filmy.tytul, filmy.ocena, filmy.rok, rezyserzy.imie, rezyserzy.nazwisko FROM filmy INNER JOIN rezyserzy ON rezyserzy.id=filmy.id INNER JOIN gatunki ON gatunki_id = gatunki.id  WHERE gatunki.nazwa='$selected_genre'";
        $result = mysqli_query($db, $q);
        if ($result) {
            while ($row = mysqli_fetch_array($result)) {
                echo "Tytuł: ";
                echo $row[0]." ";
                echo $row[1]." ";
                echo $row[2]." ";
                echo $row[3]." ";
                echo $row[4]."<br>";
            }
        }
        mysqli_close($db);
    }
    ?>
</div>
<div class="main">
    <h2>Wszystkie filmy</h2>
    <?php
    if(!empty($_POST)) {
        $db = mysqli_connect("localhost","root","","dane");
        mysqli_set_charset($db,"utf8");
        $selected_genre = $_POST['genre'];
        $q="SELECT filmy.tytul, rezyserzy.imie, rezyserzy.nazwisko FROM filmy INNER JOIN rezyserzy ON rezyserzy.id=filmy.id;";
        $result = mysqli_query($db, $q);
        $licznik=0;
        if ($result) {
            while ($row = mysqli_fetch_array($result)) {
                $licznik++;
                echo $licznik.". ";
                echo $row[0].", reżyseria: ";
                echo $row[1]." ";
                echo $row[2]."<br>";
            }
        }
        mysqli_close($db);
    }
    ?>
</div>
<footer>
    <p>Autor: Filip Rudziński</p>
    <a href="kwerendy.txt">Zapytania do bazy</a>
    <a href="https://filmy.pl" target="_blank">Przejdź do filmy.pl</a>
</footer>
</body>
</html>
