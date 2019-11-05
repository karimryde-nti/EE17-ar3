<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skriva inlägg</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="kontainer">
    <header>
        <h1>Bloggen</h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="skriva.php">Skriva inlägg</a></li>
                <li class="nav-item active"><a class="nav-link" href="lasa.php">Läsa inlägg</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php
/* Ta emot text från formuläret och spara ned i en textfil. */

$texten = $_POST["inlagg"];
$tidpunkt = date('l j F Y h:i:s');

$handtag = fopen("inlaggen.txt", 'a');
fwrite($handtag, "<div class=\"card card-body border-secondary\">$tidpunkt<br>$texten</div>\n");
echo "<p>Inlägget har sparats!</p>";
fclose($handtag);
?>
    </main>
    <footer>
        2019
    </footer>
    </div>
</body>

</html>