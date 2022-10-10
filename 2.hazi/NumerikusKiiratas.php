<?php
//1.feladat
$data= [5, '5', '05', 12.3, '16.7', 'five', 0xDECAFBAD, '10e200'];
         foreach ($data as $value){
        echo is_numeric($value)? "$value" . "igen<br>" : "nem<br>";
    }




//2.feladat
$orszagok = array(" Magyarorszag" => "Budapest", "Romania"=>"Bukarest","Belgium"=> "Brussels", "Austria" => "Vienna", "Poland"=>"Warsaw");
foreach ($orszagok as $item => $varos) {
        echo $item . " fovarosa " . $varos . "<br>";
         }




//3.feladat

$napok = array(
    "HU" => array("H", "K", "Sze", "Cs", "P", "Szo", "V"),
    "EN" => array("M", "Tu", "W", "Th", "F", "Sa", "Su"),
    "DE" => array("Mo", "Di", "Mi", "Do", "F", "Sa", "So"),
);

foreach ( $napok as $x => $y){
    echo "<br>" . $x . ":" ;
    foreach ($y as $item){
        echo  $item . ","  ;
    }
}

//4.feladat

/*function nestedLowercase($case, $value) {
    if (is_array($value) &&) {
        return strtoupper($case, $value);
    }
    return strtolower($value);

    //array_map('nestedLowercase', $value);

}
$szinek = array('A' => 'Kek', 'B' => 'Zold', 'c' => 'Piros');

$kicsi = nestedLowercase(1, $szinek);
print_r($kicsi);*/

function kisVagyNagybetu($bemenet, $betutipus)
{
    $atipusa = $betutipus;
    $narray = array();
    if(!is_array($bemenet))
    {
        return $narray;
    }
    foreach ($bemenet as $key => $value)
    {
        if(is_array($value))
        {
            $narray[$key] = kisVagyNagybetu($value, $atipusa);
            continue;
        }
        $narray[$key] = ($betutipus == CASE_UPPER ? strtoupper($value) : strtolower($value));
    }
    return $narray;
}

$szinek = array('A' => 'Kek', 'B' => 'Zold', 'c' => 'Piros');

$nagybetus = kisVagyNagybetu($szinek, CASE_UPPER);
print_r($nagybetus);
$kisbetus = kisVagyNagybetu($szinek, CASE_LOWER);
print_r($kisbetus);
