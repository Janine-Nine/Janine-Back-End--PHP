<?php
class WebhookController {
    public function atualizar() {
        $data = json_decode(file_get_contents('php://input'), true);
        global $pdo;

        if (!isset($data['status'], $data['id'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Dados inválidos']);
            return;
        }

        try {
            if ($data['status'] === 'cancelado') {
                $stmt = $pdo->prepare("DELETE FROM pedidos WHERE id = ?");
                $stmt->execute([$data['id']]);
            } else {
                $stmt = $pdo->prepare("UPDATE pedidos SET status = ? WHERE id = ?");
                $stmt->execute([$data['status'], $data['id']]);
            }
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Erro no banco de dados']);
        }
    }
}