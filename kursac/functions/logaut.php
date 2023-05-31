<?php
session_start();

// Удаление всех переменных сессии
$_SESSION = array();

// Уничтожение сессии
session_destroy();

// Перенаправление на страницу входа или на другую страницу по вашему выбору
header("Location: ..\index.php");
exit();
?>