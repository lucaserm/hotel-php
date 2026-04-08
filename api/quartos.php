<?php
header('Content-Type: application/json');

if (!isset($_SESSION['id_usuario'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Não autenticado']);
    exit();
}

require_once ROOT . '/includes/conexao.php';

$data_chegada = $_GET['data_chegada'] ?? '';
$data_saida   = $_GET['data_saida']   ?? '';

if (!$data_chegada || !$data_saida || $data_saida <= $data_chegada) {
    http_response_code(400);
    echo json_encode(['error' => 'Datas inválidas']);
    exit();
}

$stmt = $conn->prepare(
    'SELECT id, numero, tipo_quarto, preco FROM quartos
     WHERE id NOT IN (
         SELECT id_quarto FROM reservas WHERE data_chegada < ? AND data_saida > ?
     )
     ORDER BY preco ASC'
);
$stmt->bind_param('ss', $data_saida, $data_chegada);
$stmt->execute();
$result = $stmt->get_result();

$quartos = [];
while ($row = $result->fetch_assoc()) {
    $quartos[] = [
        'id'          => (int)$row['id'],
        'numero'      => (int)$row['numero'],
        'tipo_quarto' => $row['tipo_quarto'],
        'preco'       => (float)$row['preco'],
    ];
}

echo json_encode(['quartos' => $quartos]);
