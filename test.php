<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

$string1 = "adâ'an";
$string2 = "abâng";

$jarak = levenshtein($string1, $string2);
echo "Jarak Levenshtein antara '$string1' dan '$string2' adalah $jarak"; 
?>
</body>
</html>

