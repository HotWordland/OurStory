<?php
/**
 * 数据库操作类
 * 
 * @author chenjia404 
 * @package CjMysql
 */
class CjMysql
{
    public $mDbHost; //Address of the database 数据库地址
    public $mDbUser; //database username 数据库用户名
    public $mDbpwd; //database passward 数据库密码
    public $mDbDatabase; //database 所选数据库
    public $mConn; //数据库连接
    public $mCoding; //连接数据库所用编码
    public $mSql; //sql执行语句
    public $result;
    /**
     * 数据库连接函数
     * 
     * @access public 
     * @param mixed $mDb_host 数据库地址
     * @param mixed $mDb_user 数据库用户名
     * @param mixed $mDb_pwd 数据库密码
     * @param mixed $mDb_database 所选数据库
     * @param string $conn 持久连接
     * @param string $coding 编码
     * @return void 
     */
    public function mDbConnect($mDb_host, $mDb_user, $mDb_pwd, $mDb_database, $conn = null, $coding = 'UTF8')
    {
        $this -> mDb_host = $mDb_host;
        $this -> mDb_user = $mDb_user;
        $this -> mDb_pwd = $mDb_pwd;
        $this -> mDb_database = $mDb_database;
        $this -> mConn = $conn;
        $this -> mCoding = $coding;
        $this -> connect();
    } 
    /**
     * 数据库连接
     */
    public function connect()
    {
        if ($this -> mConn == "pconn")
        { 
            // 永久链接
            $this -> mConn = mysql_pconnect($this -> mDb_host, $this -> mDb_user, $this -> mDb_pwd);
        } elseif ($this -> mConn == null)
        { 
            // 即时链接
            $this -> mConn = mysql_connect($this -> mDb_host, $this -> mDb_user, $this -> mDb_pwd);
        } 

        if (!mysql_select_db($this -> mDb_database, $this -> mConn))
        {
            if ($this -> show_error)
            {
                $this -> show_error("数据库不可用：", $this -> mDb_database);
            } 
        } 
        mysql_query("SET NAMES UTF8");
        return $this -> mConn;
    } 
    // 数据库选择
    public function select_db($db_database)
    {
        return mysql_select_db($db_database);
    } 
    /**
     * 数据库执行语句，可执行查询添加修改删除等任何sql语句
     */
    /**
     * 数据库查询
     * 
     * @access public 
     * @param mixed $sql 数据库查询语句
     * @return void 
     */
    public function query($sql)
    {
        if ($sql == "")
        {
            $this -> show_error("SQL语句错误：", "SQL查询语句为空");
        } 
        $this -> mSql = $sql;

        $result = mysql_query($this -> mSql, $this -> mConn);

        $this -> result = $result;

        return $this -> result;
    } 
    /**
     * 影响行数
     * 
     * @access public 
     * @return int 
     */
    public function dbAffectedRows()
    {
        return mysql_affected_rows();
    } 
    public function show_error($message = "", $sql = "")
    {
        echo "错误原因：" . mysql_error() . "<br /><br />";
    } 
    /**
     * 魔法方法 调用任意函数
     * 
     * @access public 
     * @param mixed $methods 任意函数名
     * @return void 
     */
    public function MagicMethods($methods)
    {
        return $methods();
    } 

    /**
     * mysql_unbuffered_query
     * 
     * @author lenovo 
     * @version $Id$
     */

    public function mysql_unbuffered_query()
    {
        if ($sql == "")
        {
            $this -> show_error("SQL语句错误：", "SQL查询语句为空");
        } 
        $this -> mSql = $sql;

        $result = mysql_unbuffered_query($this -> mSql, $this -> mConn);

        $this -> result = $result;

        return $this -> result;
    } 
} 
?>