<?php

function form_start($method,$action){
    echo"<div class='container'>";
    
    echo"<div class='col-lg-offset-1 col-lg-12'>";
    echo"<div class='row'>";
    
         echo "<form class='col-lg-8' id='FormIdentite' name='FormIdentite' method='".$method."' action='".$action."' onsubmit='return validateForm()'>";
}

function form_end (){
    echo "</section>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
}

function input($for,$type,$name,$text){
    echo "<div class='form-group'>";
    echo "<label for='".$for."'>".$text.":</label>";
    echo "<input class='form-control' type='".$type."' name='".$name."' id='".$for."' required>";
    echo "</div>";
}
function select($for,$name,$text,$element){
    echo "<label for='".$for."'>".$text.":</label>";
    echo "<select class='form-control' name='".$name."' id='".$for."'>";
    $nbre_element=count($element);
    for($i=0;$i<$nbre_element;$i++){
        echo "<option>".$element[$i]."</option>";
    }
    echo "</select>";
}
function button_Submit($href,$text,$offset){
    
    echo "<div class='col-xs-3 col-xs-offset-$offset'>";
    echo"<a class='btn btn-primary btn-lg active' role='button' aria-pressed='true' href='$href' role='button'>$text</a>";
    echo "</div>";
    
}

/*$element=array("Montgomery", "Raleigh", "Tallahassee", "Atlanta", "Topeka", "Augusta", "Albany", "Nashville");
$for='AZY';
$text='wech';
$name='wechwech';
select($for, $name, $text, $element);
*/
