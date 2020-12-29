<?php
function inputElement($size, $input, $name, $placeholder, $label){
 $ele = "
        <div class=\"$size\">
            <input type=\"$input\" class=\"form-control\" name=\"$name\" placeholder=\"$placeholder\" aria-label=\"$label\" min=\"0\">
        </div>
    ";
    echo $ele;
}

function buttonElement($btnid, $styleclass, $text, $name, $attr){
    $btn = "
        <button name='$name''$attr' class='$styleclass' id='$btnid'>$text</button>
        ";
    echo $btn;
}