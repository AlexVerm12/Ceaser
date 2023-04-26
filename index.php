<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>Caeser</title>

    <style>
        body {
            margin: 0;
            background-color: rgba(0, 0, 0, 0.05);
            font-family: 'Roboto', sans-serif;
        }

        body * {
            font-family: 'Roboto', sans-serif;
        }

        .header-container {
            height: 250px;
            background-color: grey;
            background-image: url('img/backgroundimage.jpg');
            background-size: cover;
            background-position: center;
        }

        .card {
            height: calc(100vh - 218px);
            background-color: white;
            border-radius: 8px;
            margin-top: -32px;
            margin-left: 16px;
            margin-right: 16px;
            padding: 16px;
            display: flex;
            flex-direction: column;
        }

        input {
            height: 48px;
            margin-bottom: 32px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background-color: rgba(0, 0, 0, 0.05);
        }

        button {
            height: 48px;
            background-color: #0fab0f;
            color: white;
            border: unset;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background-color: #29b929;
        }

        form {
            display: flex;
            flex-direction: column;
            margin-bottom: 100px;
            background-color: rgba(0, 0, 0, 0.05);
            padding: 8px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="header-container"></div>

    <?php
    $specialChars = [' ', 'ß', 'ä', 'ü', 'ö', '?', '!', '-', '_', '.', ':', ';', ',', '\''];
    ?>

    <div class="card">
        <form>
            <h2>Text verschlüsseln</h2>
            <input placeholder="Hier Text eingeben..." name="encrypt">

            <?php
            if (isset($_GET['encrypt'])) {
                $text = strtolower($_GET['encrypt']);
                $array = str_split($text);
                echo '<b>Verschlüsselter Text: </b>';
                foreach ($array as $char) {
                    if (in_array($char, $specialChars)) {
                        echo $char;
                    } else {
                        echo toChar(toNum($char) + 1);
                    }
                }

            }
            ?>
            <button type="submit">Verschlüsseln</button>
        </form>

        <form>
            <h2>Text entschlüsseln</h2>
            <input placeholder="Hier Text eingeben..." name="decrypt">
            <?php
            if (isset($_GET['decrypt'])) {
                $text = strtolower($_GET['decrypt']);
                $array = str_split($text);
                echo '<b>Entschlüsselter Text: </b>';
                foreach ($array as $char) {
                    if (in_array($char, $specialChars)) {
                        echo $char;
                    } else {
                        echo toChar(toNum($char) - 1);
                    }
                }

            }
            ?>
            <button type="submit">Entschlüsseln</button>
        </form>
    </div>
</body>

</html>


<?php
function toNum($data)
{
    $alphabet = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
    $alpha_flip = array_flip($alphabet);
    if (strlen($data) == 1) {
        return (isset($alpha_flip[$data]) ? $alpha_flip[$data] : FALSE);
    } else if (strlen($data) > 1) {
        $num = 1;
        for ($i = 0; $i < strlen($data); $i++) {
            if (($i + 1) < strlen($data)) {
                $num *= (26 * ($alpha_flip[$data[$i]] + 1));
            } else {
                $num += ($alpha_flip[$data[$i]] + 1);
            }
        }
        return ($num + 25);
    }
}

function toChar($number)
{
    if ($number < 0) {
        $number = $number + 26;
    }
    if ($number > 25) {
        $number = $number - 26;
    }

    $alphabet = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
    return $alphabet[$number];

}
?>