<?php
namespace APIModule;

class Common
{
    static private function sql_escape($msg)
    {
        return str_replace(array("'","\0"),array("''",''),$msg);
    }

    static private function sql_validate_value($var)
    {
        if(is_null($var)){
            return 'NULL';
        }elseif(is_string($var)){
            return "'".self::sql_escape($var)."'";
        }else{
            return (is_bool($var)) ? intval($var) : $var;
        }
    }

    static function sql_build_array(string $query,$assoc_ary = false)
    {
        if(!is_array($assoc_ary)){
            return false;
        }
        $fields = $values = array();
        if($query == 'INSERT' || $query == 'INSERT_SELECT'){
            foreach($assoc_ary as $key=>$var){
                $fields[] = $key;
                $values[] = is_array($var) && is_string($var[0]) ? $var[0] : self::sql_validate_value($var);
            }
            $query = ($query == 'INSERT') ? '('.implode(',',$fields).')values('.implode(',',$values).')' : '('.implode(',',$fields).')SELECT'.implode(',',$values).' ';
        }elseif($query == 'MULTI_INSERT'){
            trigger_error('The MULTI_INSERT query value is no longer supported. Please use sql_multi_insert() instead.',E_USER_ERROR);
        }elseif($query == 'UPDATE' || $query == 'SELECT'){
            foreach($assoc_ary as $key=>$var){
                $values[] = "$key = ".self::sql_validate_value($var);
            }
            $query = implode(($query == 'UPDATE') ? ',' : ' and ',$values);
        }
        return $query;
    }
}

class Request
{
    public function sanitize($input)
    {
        if(is_array($input)){
            return array_map(function($item)
            {
                return self::sanitize($item);
            },$input);
        }else{
            $input = trim($input);
            $input = htmlspecialchars($input,ENT_QUOTES,'utf-8');
            return $input;
        }
    }

    public function request($key)
    {
        $request = array_change_key_case($_REQUEST,CASE_LOWER);
        return isset($request[$key]) ? self::sanitize($request[$key]) : null;
    }

    public function get($key)
    {
        $request = array_change_key_case($_GET,CASE_LOWER);
        return isset($request[$key]) ? self::sanitize($request[$key]) : null;
    }

    public function post($key)
    {
        $request = array_change_key_case($_POST,CASE_LOWER);
        return isset($request[$key]) ? self::sanitize($request[$key]) : null;
    }
}
