<?php
session_start();

$command = escapeshellcmd('python userScrap.py '.(string)$_SESSION['url']);
$output = shell_exec($command);

echo $output;

?>	