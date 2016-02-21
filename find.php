<?php
$pass = explode("\n", file_get_contents('/var/www/src/PWorganized.txt'));
$pdo = new PDO('mysql:dbname=organized;host=localhost;charset=utf8', $pass[0], $pass[1], [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);

if (is_string($_REQUEST['str']) && is_numeric($_REQUEST['num'])){
	$sth = $pdo->prepare('
		SELECT val from organized where str = :str AND num = :num;
	');

	$sth->bindParam(':str', $val['str'], PDO::PARAM_STR);
	$sth->bindParam(':num', $val['num'], PDO::PARAM_INT);

	$val['str'] = $_REQUEST['str'];
	$val['num'] = $_REQUEST['num'];

	$sth->execute();
	$result = $sth->fetchAll(PDO::FETCH_CLASS);

	print_r($result);
} else if(is_numeric($_REQUEST['val']) ) {
	$sth = $pdo->prepare('
		SELECT str, num from organized where val = :val;
	');

	$sth->bindParam(':val', $val['val'], PDO::PARAM_INT);

	$val['val'] = $_REQUEST['val'];

	$sth->execute();
	$result = $sth->fetchAll(PDO::FETCH_CLASS);

	print_r($result);

} else {
	echo "引数が間違っています\n";
}
