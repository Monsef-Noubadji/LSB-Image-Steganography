<?php

function steganize($file, $message)
{
    // Encode the message into a binary string.
    $binaryMessage = '';
    for ($i = 0; $i < mb_strlen($message); ++$i) {
        $character = ord($message[$i]);
        $binaryMessage .= str_pad(decbin($character), 8, '0', STR_PAD_LEFT);
    }

    // Inject the 'end of text' character into the string.
    $binaryMessage .= '00000011';

    // Load the image into memory.
    $img = imagecreatefromjpeg($file);

    // Get image dimensions.
    $width = imagesx($img);
    $height = imagesy($img);

    $messagePosition = 0;

    for ($y = 0; $y < $height; $y++) {
        for ($x = 0; $x < $width; $x++) {

            if (!isset($binaryMessage[$messagePosition])) {
                // No need to keep processing beyond the end of the message.
                break 2;
            }

            // Extract the colour.
            $rgb = imagecolorat($img, $x, $y);
            $colors = imagecolorsforindex($img, $rgb);

            $red = $colors['red'];
            $green = $colors['green'];
            $blue = $colors['blue'];
            $alpha = $colors['alpha'];

            // Convert the blue to binary.
            $binaryRed = str_pad(decbin($red), 8, '0', STR_PAD_LEFT);
            $binaryGreen = str_pad(decbin($green), 8, '0', STR_PAD_LEFT);
            $binaryBlue = str_pad(decbin($blue), 8, '0', STR_PAD_LEFT);

            // Replace the final bit of the blue colour with our message.
            $binaryRed[strlen($binaryRed) - 1] = $binaryMessage[$messagePosition];
            $newRed = bindec($binaryRed);
            $binaryGreen[strlen($binaryGreen) - 1] = $binaryMessage[$messagePosition];
            $newGreen = bindec($binaryGreen);
            $binaryBlue[strlen($binaryBlue) - 1] = $binaryMessage[$messagePosition];
            $newBlue = bindec($binaryBlue);
            // Inject that new colour back into the image.
            $newColor = imagecolorallocatealpha($img, $newRed, $newGreen, $newBlue, $alpha);
            imagesetpixel($img, $x, $y, $newColor);

            // Advance message position.
            $messagePosition++;
        }
    }

    // Save the image to a file.
    $newImage = 'secret.png';
    imagepng($img, $newImage, 9);

    // Destroy the image handler.
    imagedestroy($img);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Hide your data</title>
</head>

<body>
    <h3 style="font-family:sans-serif;font-size:2rem;">Stego Web app</h3>
    <img style="width:40%;height:40%;" src="img.jpg" alt="nerd">
    <form action="index.php" method="GET">
        <p class="style"> First thing first :</p> <input class="style" id="input" type="text" name="plaintext" placeholder="type in your message">
        <p class="style"> Then click here : </p> <input class="style" id="btn" type="submit" value="hide">
    </form>
    <br><br><br>
    <p class="style"> Theeen go here to see magic happens:</p> <br> <a id="link" href="desteganize.php">Reveal the data ;)</a>
    <?php
    $file = 'img.jpg';
    $message = '';
    $message = $_GET['plaintext'];
    steganize($file, $message);
    ?>
</body>

</html>