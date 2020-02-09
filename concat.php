<?php

echo "Łączynt kilka tekstów ";
echo 'Dodając kolejne "echo".';

echo 'Łączymy ' . 'takze ' . 'kropkę';

echo 'albo ', 'przecinek ', ',';

echo "test echo \n";
printf('test printf%s', "\n");
sprintf('test printf%s', "\n");

$test1 = sprintf('test printf%s', "\n");

/**
*  imię psa lub kotora
*  @var string
*/
$name = 'azor';

/**
*  licznik pokoi
*  @var integer
*/
$roomsCounter = 12;

/**
*  obecna nazwa psa
*  @var string
*/
$currentBandName = $name;
echo "<br>";
echo "$name $roomsCounter $currentBandName";
echo "<br>";
printf($name. " " .$roomsCounter. " " .$currentBandName);
sprintf($name. " " .$roomsCounter. " " .$currentBandName);

// $tekst = "pies"
// echo md5($tekst);

$var = rand(1,10);
echo $var;

$str = 'apple';

if (md5($str) === '1f3870be274f6c49b3e31a0c6728957f') {
    echo "Would you like a green or red apple?";
}
?>