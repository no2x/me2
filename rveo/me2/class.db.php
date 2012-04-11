<?php
class dbdo
{
	var $querynum = 0;
	var $link_identifier = null;

	function Connect( $dbserver = '', $dbcharset = 'utf8', $dbname = '', $dbuser = '', $dbpw = '', $pconnect = 0, $newlink = 0 )
	{
		if ( $pconnect )
		{
			if ( !$this -> link_identifier = @mysql_pconnect( $dbserver, $dbuser, $dbpw, $newlink ))
			{
				$this -> halt( 'Can not connect to MySQL server' );
			}
		}
		else
		{
			if ( !$this -> link_identifier = @mysql_connect( $dbserver, $dbuser, $dbpw, $newlink ))
			{
				$this -> halt( 'Can not connect to MySQL server' );
			}
		}

		$version = $this -> version();
		if ( $version > '4.1' )
		{
			if ( !empty( $this -> dbcharset ))
			{
				mysql_query( 'SET character_set_connection = '.$this -> dbcharset.', character_set_results = '.$this -> dbcharset.', character_set_client = binary', $this -> link_identifier );
			}
			if ( $version > '5.0.1' )
			{
				mysql_query( "SET sql_mode = ''", $this -> link_identifier );
			}
		}

		if ( $dbname )
		{
			mysql_select_db( $dbname, $this -> link_identifier );
		}
	}

	function select_db( $dbname )
	{//选择数据库
		return mysql_select_db( $dbname, $this -> link_identifier );
	}

	function query( $sql, $type = '' )
	{//返回操作数据的状态
		$func = $type ==  'UNBUFFERED' && @function_exists( 'mysql_unbuffered_query' ) ? 'mysql_unbuffered_query' : 'mysql_query';
		if ( !( $query = $func( $sql, $this -> link_identifier )) && $type !=  'SILENT' )
		{
			$this -> halt( 'MySQL Query Error', $sql );
		}
		$this -> querynum++;
		return $query;
	}

	function result( $query, $row, $field )
	{//返回一格操作数据结果（ 操作数据, 第几条, 字段名 ）
		$query = @mysql_result( $query, $row, $field );
		return $query;
	}

	function fetch_array( $query, $result_type = MYSQL_ASSOC )
	{//返回操作数据结果放入数组 [ 索引 + 字段名 ]
		return mysql_fetch_array( $query, $result_type );
	}

	function fetch_row( $query )
	{//返回操作数据结果放入数组 [ 索引 ]
		$query = mysql_fetch_row( $query );
		return $query;
	}

	function affected_rows()
	{//返回最后操作影响的列数
		return mysql_affected_rows( $this -> link_identifier );
	}

	function errno()
	{//返回错误信息代码
		return intval(( $this -> link_identifier ) ? mysql_errno( $this -> link_identifier ) : mysql_errno());
	}

	function error()
	{//返回错误信息
		return (( $this -> link_identifier ) ? mysql_error( $this -> link_identifier ) : mysql_error());
	}

	function num_rows( $query )
	{//返回操作数据列数
		$query = mysql_num_rows( $query );
		return $query;
	}

	function num_fields( $query )//
	{//返回操作数据字段的数目
		return mysql_num_fields( $query );
	}

	function free_result( $query )//
	{//释放操作数据占用的内存资源
		return mysql_free_result( $query );
	}

	function insert_id()//
	{//返回最后一次使用 insert 产生的 id 数
		return ( $id = mysql_insert_id( $this -> link_identifier )) >=  0 ? $id : $this -> result( $this -> query( "SELECT last_insert_id()" ), 0 );
	}

	function version()
	{//返回数据库版本
		return mysql_get_server_info( $this -> link_identifier );
	}

	function close()
	{//关闭数据库连接
		return mysql_close( $this -> link_identifier );
	}

	function halt( $message = '', $sql = '' )
	{//停止数据库操作
		@$this -> close;
		echo ( $message );
	}
}

?>