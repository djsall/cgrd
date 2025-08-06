<?php

namespace src\app\Models;
class News
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        return $this->pdo->query("SELECT * FROM news ORDER BY created_at DESC")->fetchAll();
    }

    public function create($title, $content)
    {
        $stmt = $this->pdo->prepare("INSERT INTO news (title, content) VALUES (?, ?)");
        return $stmt->execute([$title, $content]);
    }

    public function update($id, $title, $content)
    {
        $stmt = $this->pdo->prepare("UPDATE news SET title = ?, content = ? WHERE id = ?");
        return $stmt->execute([$title, $content, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM news WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
