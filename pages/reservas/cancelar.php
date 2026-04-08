<?php
if (!isset($_SESSION['id_usuario'])) { header('Location: /login'); exit(); }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: /reservas'); exit(); }

require ROOT . '/includes/conexao.php';

$id         = (int)($_POST['id'] ?? 0);
$id_usuario = (int)$_SESSION['id_usuario'];

$stmt = $conn->prepare('DELETE FROM reservas WHERE id = ? AND id_cliente = ?');
$stmt->bind_param('ii', $id, $id_usuario);
$stmt->execute();

header('Location: /reservas');
exit();
