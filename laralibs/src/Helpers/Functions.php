<?php



if(!function_exists('extract_with_unset')) {

    function extract_with_unset(array $data,$attribute) {
        $extract = $data[$attribute];
        unset($data[$attribute]);
        return $extract;
    }

}