<?php


$config = [
    "Host" => 'smtp.example.com',
    "SMTPAuth" => true,
    "Username" => 'user@example.com',
    "Password" => 'secret',
    "Port" => 465
];


function arrayToObject($arr) {
    if (gettype($arr) != 'array') {
        return;
    }
    foreach ($arr as $k => $v) {
        if (gettype($v) == 'array' || getType($v) == 'object') {
            $arr[$k] = (object)arrayToObject($v);
        }
    }

    return (object)$arr;
}


$a = arrayToObject($config);

var_dump($a->Host);