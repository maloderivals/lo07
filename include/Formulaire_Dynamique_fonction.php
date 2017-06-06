<?php

function form_start($method,$action){
    echo "<form method='".$method."' action='".$action."' >";
}

function form_end (){
    echo "</form>";
}

function input($for,$type,$name,$text){
    echo "<label for='".$for."'>".$text.":</label>";
    echo "<input type='".$type."' name='".$name."' id='".$for."'>";
    
}
function select($for,$name,$text,$element){
    echo "<label for='".$for."'>".$text.":</label>";
    echo "<select name='".$name."' id='".$for."'>";
    $nbre_element=count($element);
    for($i=0;$i<$nbre_element;$i++){
        echo "<option>".$element[$i]."</option>";
    }
    echo "</select>";
}

/*$element=array("Montgomery", "Raleigh", "Tallahassee", "Atlanta", "Topeka", "Augusta", "Albany", "Nashville");
$for='AZY';
$text='wech';
$name='wechwech';
select($for, $name, $text, $element);
*/
