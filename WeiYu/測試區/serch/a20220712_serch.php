<?php
// 來自 php 的MyQuery範例，可能會用在log的部分

class MyQuery
{
    private $mysqli;

    // this is for correct use colume name
    // how to use?     MyQuery::QUERY_NAME
    const QUERY_NAME = 'name';
    const QUERY_TEL = 'tel';
    const QUERY_ADDRESS = 'addr';
    const QUERY_EMAIL = 'email';

    function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    function getProductData($id, $field)
    {
        $sql = "SELECT * FROM food WHERE id ={$id}";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 0) {
            return false;
        } else {
            $data = $result->fetch_assoc();
            return $data[$field];
        }
    }


    // getAllData('city = "台中市"') => data[]
    // getAllData('addr like "%中市%"') => data[]

    function getAllAddress($where = '')
    {
        $sql = "SELECT addr FROM food";

        if (strlen($where) > 0) {
            $sql .= " WHERE  {$where}";
        }
        $sql .= " ORDER BY id";
        $result = $this->mysqli->query($sql);


        $ret = [];
        while ($row = $result->fetch_object()) {
            $ret[] = $row;
        }
        return $ret;
    }

    // $keyword => 'xxx'
    // $keyword => 'xxx; yyy; zzz' => or
    // name, tel,addr
    function getDataByKeyword($keyword = ''){
        $keys = explode(';',$keyword);
        $sql = "SELECT `name`,tel,addr FROM food ";


        if (count($keys) > 0){
        $sql .= " WHERE" ;
        
        foreach ($keys as $i => $key){
            if ($i !=0) {
                $sql .= ' OR ';    
            }
            $trimKey = trim($key);
            $sql .= " `name` LIKE '%{$trimKey}%' OR  tel LIKE '%{$trimKey}%' OR  addr LIKE '%{$trimKey}%'";
            
        }

        
        $result = $this->mysqli->query($sql);
        }
        $ret = [];
        while ($row = $result->fetch_object()) {
            $ret[] = $row;
        }
        return $ret;
    }
}