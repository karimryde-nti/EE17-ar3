<?php
/*
* Data från https://pcpartpicker.com/products/cpu/
*
* PHP version 7
* @category   Lånekalkylator
* @author     Karim Ryde <karye.webb@gmail.com>
* @license    PHP CC
*/
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bygg din PC</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/shop.css">
</head>
<body>
    <div class="kontainer">
        <h1>Bygg din PC - steg 1</h1>
        <h2>Välj cpu</h2>
        <?php
        echo "<form action=\"./steg2.php\" method=\"post\">";
        $katalog = './shop-bilder/cpu';
        $filer = scandir($katalog);
        foreach ($filer as $fil) {
            if (is_dir("$katalog/$fil")) {
            } else {
                $delar = pathinfo("$katalog/$fil");
                $filtyp = $delar['extension'];
                $filnamn = $delar['filename'];
                $namn = str_replace('-', ' ', $filnamn);

                if ($filtyp == 'jpg') {
                    echo "
                <label>
                    <input class=\"with-gap\" name=\"vara\" type=\"radio\" value=\"$filnamn\" required>
                    <img src=\"$katalog/$fil\" alt=\"$filnamn\">
                    <span>$namn</span>
                </label>";
                }
            }
        }
        echo "<button class=\"primary\">Nästa</button>";
        echo "</form>";
        ?>
    </div>
</body>
</html>