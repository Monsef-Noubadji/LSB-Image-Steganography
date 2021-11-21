<?php
function desteganize($file)
{
    // Read the file into memory.
    $img = imagecreatefrompng($file);

    // Read the message dimensions.
    $width = imagesx($img);
    $height = imagesy($img);

    // Set the message.
    $binaryMessage = '';

    // Initialise message buffer.
    $binaryMessageCharacterParts = [];

    for ($y = 0; $y < $height; $y++) {
        for ($x = 0; $x < $width; $x++) {

            // Extract the colour.
            $rgb = imagecolorat($img, $x, $y);
            $colors = imagecolorsforindex($img, $rgb);

            $red = $colors['red'];
            $green = $colors['green'];
            $blue = $colors['blue'];

            // Convert the blue to binary.
            $binaryRed = decbin($red);
            $binaryGreen = decbin($green);
            $binaryBlue = decbin($blue);

            // $m_red = $binaryRed[strlen($binaryRed) - 1];
            // $m_green = $binaryGreen[strlen($binaryGreen) - 1];
            // $m_blue = $binaryBlue[strlen($binaryBlue) - 1];
            // $m_colors = $m_red + $m_green + $m_blue;

            // Extract the least significant bit into out message buffer..

            $binaryMessageCharacterPartsRed[] = $binaryRed[strlen($binaryRed) - 1];
            $binaryMessageCharacterPartsGreen[] = $binaryGreen[strlen($binaryGreen) - 1];
            $binaryMessageCharacterPartsBlue[] = $binaryBlue[strlen($binaryBlue) - 1];


            if (count($binaryMessageCharacterPartsRed) == 8) {
                // If we have 8 parts to the message buffer we can update the message string.
                $binaryCharacter = implode('', $binaryMessageCharacterPartsRed);
                $binaryMessageCharacterPartsRed = [];
                if ($binaryCharacter == '00000011') {
                    // If the 'end of text' character is found then stop looking for the message.
                    break 2;
                } else {
                    // Append the character we found into the message.
                    $binaryMessage .= $binaryCharacter;
                }
            }
            if (count($binaryMessageCharacterPartsGreen) == 8) {
                // If we have 8 parts to the message buffer we can update the message string.
                $binaryCharacter = implode('', $binaryMessageCharacterPartsGreen);
                $binaryMessageCharacterPartsGreen = [];
                if ($binaryCharacter == '00000011') {
                    // If the 'end of text' character is found then stop looking for the message.
                    break 2;
                } else {
                    // Append the character we found into the message.
                    $binaryMessage .= $binaryCharacter;
                }
            }
            if (count($binaryMessageCharacterPartsBlue) == 8) {
                // If we have 8 parts to the message buffer we can update the message string.
                $binaryCharacter = implode('', $binaryMessageCharacterPartsBlue);
                $binaryMessageCharacterPartsBlue = [];
                if ($binaryCharacter == '00000011') {
                    // If the 'end of text' character is found then stop looking for the message.
                    break 2;
                } else {
                    // Append the character we found into the message.
                    $binaryMessage .= $binaryCharacter;
                }
            }
        }
    }

    // Convert the binary message we have found into text.
    $message = '';
    for ($i = 0; $i < strlen($binaryMessage); $i += 24) {
        $character = mb_substr($binaryMessage, $i, 24);
        $message .= chr(bindec($character));
    }

    return $message;
}
$secretfile = 'secret.png';
$message = desteganize($secretfile);
echo "Here's your hidden data:" . '<br>' . $message;
// echo $message;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Desteganize the data</title>
</head>

<body>
    <br><br><br>
    <a id="link2" href="index.php?plaintext=<?php $message ?>">Return</a>
</body>

</html>