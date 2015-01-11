<?php
/**
 * api基类
 * 
 * @author chenjia404
 * @version $Id$
 */
include_once('config.php');
include_once('CjMysql.class.php');
class api
{
    public $mysql_db;//数据连接对象
    
    public $debug = false;
    
    /**
     * 构造函数，建立连接，自动使用config.php的配置
     * 
     * @access global
     * @return void
     */
    function api()
    {
        $this->mysql_db = new CjMysql();
        $this->mysql_db -> mDbConnect(db_host,db_username, db_password, db_name);
    }
    
    function GetResult($sql)
    {
        if($this -> debug){
            echo $sql;
		}
        return $this->mysql_db->query($sql);
    }


    /**
     * 选取数据
     * 
     * @access global
     * @param mixed $table 表名
     * @param string $Condition 条件
     * @param mixed $field 需要选取的字段
     * @param int $count 数量，默认全部
     * @param int $page 页码，默认不分页
     * @return void
     */
    function Select($table,$Condition = '',$field='*',$count=0,$page = 1)
    {
        $insert = $page * $count - $count;
        $sql = 'SELECT ' . $field . " FROM $table $Condition";
        if($count == 0)
            $sql;
        elseif(is_numeric($count) && is_numeric($page))
            $sql .= "LIMIT $insert , $count";
        $this->GetResult($sql);//echo $sql;
    }

    /**
     * 选取数据
     * 
     * @access global
     * @param mixed $table 表名
     * @param string $Condition 条件
     * @param mixed $field 需要选取的字段
     * @param int $count 数量，默认全部
     * @param int $page 页码，默认不分页
     * @return void
     */
    function SelectArray($table,$ConditionArray = '',$field='*',$count=0,$page = 1)
    {
        $Condition = 'where ';
        foreach($ConditionArray  as $key => $value)
        {
            if($Condition != 'where ')
                $Condition .= ' and ';
            $Condition .=  "$key = '$value'";
        }
        $this->Select($table,$Condition,$field,$count,$page);
    }

    /**
     * 添加数据
     * 
     * @access global
     * @param mixed $table 表
     * @param mixed $data 数据数组，key即为字段值
     * @return void
     */
    function InsertArray($table,$data)
    {
        $sql = "INSERT INTO $table";
        $sqlcolumn = '(';
        $sqlVALUES  = 'VALUES (';
        foreach($data as $key => $value)
        {
            if($sqlcolumn == '(')
            {
                $sqlcolumn .= addslashes($key);
                $sqlVALUES .= '\'' . addslashes($value) . '\'';
            }
            else
            {
                $sqlcolumn .= ',' . addslashes($key);
                $sqlVALUES .= ',\'' . addslashes($value) . '\'';
            }
        }
        $sqlcolumn .= ')';
        $sqlVALUES .= ');';
        $sql .= $sqlcolumn . $sqlVALUES;
        $this->GetResult($sql);
    }

    /**
     * 更新数据
     * 
     * @access global
     * @param mixed $table 表
     * @param mixed $data 数据数组，key即为字段值
     * @return void
     */
    function UpdateArray($table,$data,$where)
    {
        $sql = "UPDATE $table SET ";

        foreach($data as $key => $value)
        {
            if($sql == "UPDATE $table SET ")
                $sql .=addslashes($key) . '=\'' . addslashes($value) . '\'';
            else
                $sql .=',' . addslashes($key) . '=\'' . addslashes($value) . '\'';
        }
        $sql .= ' WHERE ';
        foreach($where as $key => $value)
        {
            $sql .=addslashes($key) . '=\'' . addslashes($value) . '\'';
        }
        $this->GetResult($sql);
		//return $sql;
    }

    /**
     * 更新数据
     * 
     * @access global
     * @param mixed $table 表
     * @param mixed $data 数据数组，key即为字段值
     * @return void
     */
    function DeleteArray($table,$where)
    {
        $sql = "DELETE FROM  $table";
        $sql .= ' WHERE ';
        foreach($where as $key => $value)
        {
            $sql .=addslashes($key) . '=\'' . addslashes($value) . '\'';
        }
        $this->GetResult($sql);
    }

    /**
     * 使用特定function对数组中所有元素做处理
     * 
     * @param string $ &$array     要处理的字符串
     * @param string $function 要执行的函数
     * @return boolean $apply_to_keys_also     是否也应用到key上
     * @access public 
     */
    function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
    {
        foreach ($array as $key => $value)
        {
            if (is_array($value))
            {
                $this->arrayRecursive($array[$key], $function, $apply_to_keys_also);
            } 
            else
            {
                $array[$key] = $function($value);
            } 

            if ($apply_to_keys_also && is_string($key))
            {
                $new_key = $function($key);
                if ($new_key != $key)
                {
                    $array[$new_key] = $array[$key];
                    unset($array[$key]);
                } 
            } 
        } 
    } 
    /**
     * 将数组转换为JSON字符串（兼容中文）
     * 
     * @param array $array 要转换的数组
     * @return string 转换得到的json字符串
     * @access public 
     */
    function JSON_en($array)
    {
        $this->arrayRecursive($array, 'urlencode', true);
        $json = json_encode($array);
        return urldecode($json);
    } 
    function JSON_de($array)
    {
        $this->arrayRecursive($array, 'urlencode', true);
        $json = json_decode($array, true);
        return ($json);
    } 
}
?>