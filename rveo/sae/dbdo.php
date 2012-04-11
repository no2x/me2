<?php
define( 'rveoUri', $_SERVER["REQUEST_URI"] );
define( 'rveoUrs', $_SERVER['QUERY_STRING'] );
include_once('config.xx2w');
include_once('class.db.xx2w');

global $DB;

echo ('<title>Connect & operate database</title>');
echo ('<meta http-equiv="content-type" content="text/html; charset=utf-8" />');

$DB = new dbdo;
$DB -> Connect( $DBI['DBServer'], $DBI['DBChset'], $DBI['DBName'], $DBI['DBUser'], $DBI['DBPwd'], $DBI['DBPconnect']);

echo ( '<br/><br/><br/><br/>' );

$query =  $DB -> query("select * from supe_categories");

$rows = $DB -> num_rows( $query );
echo ( '$rows = '. $rows .' !' );
echo ( '<br/><br/><br/><br/>' );
$DB -> free_result( $query );

$query =  $DB -> query("select * from supe_categories");

$fields = $DB -> num_fields( $query );
echo ( '$fields = '. $fields .' !' );
echo ( '<br/><br/><br/><br/>' );
$DB -> free_result( $query );

$query =  $DB -> query("select * from supe_categories");

$sort = $DB -> result( $query, 0, 4 );
echo ( '$sort = '. $sort .' !' );
echo ( '<br/><br/><br/><br/>' );
$DB -> free_result( $query );

$query =  $DB -> query("select * from supe_categories");

echo ( 'Load = ' );
while( $value = $DB -> fetch_array( $query ))
{
	echo ( $value['name'] .'&nbsp;/&nbsp;' );
}
echo ( '!' );
echo ( '<br/><br/><br/><br/>' );
$DB -> free_result( $query );

$query =  $DB -> query("select * from supe_categories");

echo ( 'Load = ' );
while( $value = $DB -> fetch_row( $query ))
{
	echo ( $value[18] .'&nbsp;/&nbsp;' );
}
echo ( '!' );
echo ( '<br/><br/><br/><br/>' );
$DB -> free_result( $query );

$query =  $DB -> query("select * from supe_categories");

echo ( 'Load = ' );
$value = $DB -> fetch_row( $query );
for ( $i = 0; $i < $fields; $i++ )
{
	echo ( $value[$i] .'&nbsp;/&nbsp;' );
}
echo ( '!' );
echo ( '<br/><br/><br/><br/>' );
$DB -> free_result( $query );

//中文怎么办？
?>