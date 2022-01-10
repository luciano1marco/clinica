<?php
function printa_pre($string){
    if(is_object($string)){
        echo '<pre>';
        print_r($string);
        echo '</pre>';
    }
    if(is_array($string)){
        echo '<pre>';
        print_r($string);
        echo '</pre>';
    }
    if(!is_object($string) && !is_array($string)){    
        echo '<pre>'.$string.'</pre>';       
    }
}

function getFontAwesomeIcons() {
    $url = base_url('assets/frameworks/font-awesome/css/font-awesome-4.7.0.json');
   
    $string = file_get_contents($url);
    $json_a = json_decode($string, true);

    $data = array();
    foreach($json_a as $key => $value) {
        foreach($value as $row){       
            $fa = substr($row,0,3);
            $pieces = explode($fa, $row);
       
            $icon = $row;
            $nome = $pieces[1]; 
                     
            $data =$data +array($nome => $nome);           
        }           
    }  
    return $data;
}

function sanitizeString($str)
{
    return preg_replace('{\W}', '', preg_replace('{ +}', '_', strtr(
        utf8_decode(html_entity_decode($str)),
        utf8_decode('����������������������������'),
        'AAAAEEIOOOUUCNaaaaeeiooouucn')));
}

function sanitize($line){
    $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $line); // attempt to translate similar characters
    $clean = preg_replace('/[^\w]/', '', $clean); // drop anything but ASCII
    return $clean;
 }

function slugify($text){
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

function utf8_string_array_encode(&$array){
    $func = function(&$value,&$key){
        if(is_string($value)){
            $value = utf8_encode($value);
        }
        if(is_string($key)){
            $key = utf8_encode($key);
        }
        if(is_array($value)){
            utf8_string_array_encode($value);
        }
    };
    array_walk($array,$func);
    return $array;
}

function json_validate($string)
{
    // decode the JSON data
    $result = json_decode($string);

    // switch and check possible JSON errors
    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            $error = ''; // JSON is valid // No error has occurred
            break;
        case JSON_ERROR_DEPTH:
            $error = 'The maximum stack depth has been exceeded.';
            break;
        case JSON_ERROR_STATE_MISMATCH:
            $error = 'Invalid or malformed JSON.';
            break;
        case JSON_ERROR_CTRL_CHAR:
            $error = 'Control character error, possibly incorrectly encoded.';
            break;
        case JSON_ERROR_SYNTAX:
            $error = 'Syntax error, malformed JSON.';
            break;
        // PHP >= 5.3.3
        case JSON_ERROR_UTF8:
            $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
            break;
        // PHP >= 5.5.0
        case JSON_ERROR_RECURSION:
            $error = 'One or more recursive references in the value to be encoded.';
            break;
        // PHP >= 5.5.0
        case JSON_ERROR_INF_OR_NAN:
            $error = 'One or more NAN or INF values in the value to be encoded.';
            break;
        case JSON_ERROR_UNSUPPORTED_TYPE:
            $error = 'A value of a type that cannot be encoded was given.';
            break;
        default:
            $error = 'Unknown JSON error occured.';
            break;
    }

    if ($error !== '') {
        // throw the Exception or exit // or whatever :)
        exit($error);
    }

    // everything is OK
    return $result;
}