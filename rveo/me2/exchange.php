<?
$Currencies = array(
			'cny' => '人民币',
			'hkd' => '港元',
			'usd' => '美元',
			'eur' => '欧元',
			'gbp' => '英镑',
			'aud' => '澳元',
			'jpy' => '日元',
			'krw' => '韩元',
			'chf' => '瑞士法郎'
		);

$Base = $_POST['Currencies'];

$Target = $_POST['Currencies2'];
?>
<meta charset="utf-8" />
<form action="" method="post">
100元<select name="Currencies">
<?
foreach ( $Currencies as $key => $value )
{
	$selected = ( $key == $Base ) ? ' selected' : '';
	echo ("<option value=\"{$key}\"{$selected}>{$value}</option>\n");
}
?>
</select>
兑换<select name="Currencies2">
<?
foreach ( $Currencies as $key => $value )
{
	$selected = ( $key == $Target ) ? ' selected' : '';
	echo ("<option value=\"{$key}\"{$selected}>{$value}</option>\n");
}
?>
</select>
<input type="submit" value=" OK " />
</form>
<?
if ( $Base && $Target )
{
	$exchange = file_get_contents("http://xurrency.com/api/{$Base}/{$Target}/100");

	//echo ("http://xurrency.com/api/{$Base}/{$Target}/100<br/><br/>\n");

	$exchangeJson = json_decode( $exchange );

	$exchangevalue = $exchangeJson -> result -> value;

	echo ("可兑换得 {$exchangevalue} {$Currencies[$Target]}<br/><br/>\n");

//	print_r ( $exchangeJson );

// 可操作 stdClass Object 方法，也可操作 Array 方法：

//	$exchangeJson = json_decode( $exchange, true );

//	$exchangevalue = $exchangeJson['result']['value'];

//	echo ("可兑换得 {$exchangevalue} {$Currencies[$Target]}<br/><br/>\n");

//	var_dump( $exchangeJson );

}
?>
