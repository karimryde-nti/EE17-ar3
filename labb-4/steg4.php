<?php
/*
* Data från https://pcpartpicker.com/products/cpu/
* 
* PHP version 7
* @category   Webbshop
* @author     Karim Ryde <karye.webb@gmail.com>
* @license    PHP CC
*/

include_once "./funktioner.inc.php";
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Webbshop - steg 1 - cpu</title>
    <link rel="stylesheet" href="./shop.css">
</head>
<body>
    <div class="kontainer">
        <h1>Bygg din PC - steg 4</h1>
        <h2>Varukorg</h2>
        <?php
        /* Visa innehållet på varukorgen = varukorg.txt */
        $varukorg = "./varukorg.txt";

        /* Ta emot data som skickas */
        $vara = filter_input(INPUT_POST, 'vara', FILTER_SANITIZE_STRING);
        if ($vara) {
            /* Spara ned i varukorg.txt */
            $handtag = fopen($varukorg, 'a');
            fwrite($handtag, "$vara\n");
            fclose($handtag);
        }

        if (is_readable($varukorg)) {
            /* Läs in textfilen varukorg.txt i en array */
            $rader = file($varukorg);

            /* Skriv ut som tabell */
            echo "<table>";
            echo "<tr><th>Vara</th><th>Pris</th></tr>";
            foreach ($rader as $rad) {
                $vara = vara($rad);
                $pris = pris($rad);
                echo "<tr><td>$vara</td><td>$pris</td></tr>";
            }
            echo "</table>";    
        } else {
            echo "<p>Varukorgen saknas!</p>";
        }
        ?>
        <h2>Välj interminne</h2>
        <form action="steg5.php" method="post">
        <?php
        /* Lista alla produkter i katalogen */
        $katalog = "./shop-bilder/ram";

        /* Hämta katalogens innehåll */
        $filer = scandir($katalog);
        foreach ($filer as $fil) {
            $info = pathinfo("./$fil");
            if ($info['extension'] == 'jpg' || $info['extension'] == 'png' || $info['extension'] == 'webp') {
                echo "<label>";
                echo "<input type=\"radio\" name=\"vara\" value=\"$fil\">";
                echo "<img src=\"$katalog/$fil\">";
                $vara = vara($fil);
$pris = pris($fil);
echo "$vara $pris:-";
                echo "</label>";
            }
        }
        ?>
        <button>Nästa</button>
        </form>
    </div>
</body>
</html>