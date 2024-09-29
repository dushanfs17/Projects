<?php
require_once '../Database/Connection.php';

use Database\Connection as Connection;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents("php://input");
    $data = json_decode($input);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid JSON data"]);
        exit;
    }

    $noteId = $data->id ?? "";
    $noteTitle = $data->title ?? "";
    $noteText = $data->text ?? "";

    if (empty($noteId) || empty($noteTitle) || empty($noteText)) {
        http_response_code(400);
        echo json_encode(["error" => "Note ID, title, and text are required"]);
        exit;
    }

    try {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('UPDATE notes SET title = :noteTitle, text = :noteText WHERE id = :id');
        $statement->bindParam(':id', $noteId);
        $statement->bindParam(':noteTitle', $noteTitle);
        $statement->bindParam(':noteText', $noteText);

        $statement->execute();

        http_response_code(200);
        echo json_encode(["message" => "Note updated successfully"]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Method Not Allowed"]);
}
