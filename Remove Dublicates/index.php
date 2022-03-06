<?php

function printArray($array){
    foreach ($array as $key => $value) {
        echo "[". $key . "] => " . $value;
    }
}

$givenArray = array(1,5,2,5,1,3,2,4,5);
$uniqueArry = array();

foreach($givenArray as $val) { //Loop1 
    
    foreach($uniqueArry as $uniqueValue) { //Loop2 

        if($val == $uniqueValue) {
            continue 2;
        }
    }
    $uniqueArry[] = $val;
}
echo "Original Array : ";
echo "Array<br>(";
printArray($givenArray);
echo ")";
echo "<br><br>";

echo "Updated Array : ";
echo "Array<br>(";
printArray($uniqueArry);
echo ")";
echo "<br><br>";





?>