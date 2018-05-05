
<?
session_start();
$_SESSION['MSGErr'] = $Message;
header('Location: ' . base_url() . 'livelines'  );
