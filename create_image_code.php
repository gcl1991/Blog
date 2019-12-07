<?php
function create_code(){
    $string = "abcdefghijklmnopqrstuvwxyz0123456789";
    $str = "";
    for($i=0;$i<6;$i++){
        $pos = rand(0,35);
        $str .= $string{$pos};
    }
    return $str;
}
?>