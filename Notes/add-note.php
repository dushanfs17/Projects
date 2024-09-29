<?php
require_once '../Database/Connection.php';

use Database\Connection as Connection;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_input = file_get_contents("php://input");
    $data = json_decode($json_input);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid JSON data: " . json_last_error_msg()]);
        exit;
    }

    $user_id = $data->user_id ?? "";
    $book_id = $data->book_id ?? "";
    $title = $data->title ?? "";
    $text = $data->text ?? "";

    try {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('INSERT INTO notes (`title`, `text`, `user_id`, `book_id`) VALUES (:title, :text, :user_id, :book_id)');
        $statement->bindParam(':user_id', $user_id);
        $statement->bindParam(':book_id', $book_id);
        $statement->bindParam(':title', $title);
        $statement->bindParam(':text', $text);
        $statement->execute();

        http_response_code(200);
        echo json_encode(["message" => "Note added successfully"]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Method Not Allowed"]);
}
