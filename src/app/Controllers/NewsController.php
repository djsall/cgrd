<?php

namespace src\app\Controllers;

use src\app\Models\News;
use Twig\Environment;

class NewsController
{
    private News $newsModel;
    private Environment $twig;

    public function __construct(News $newsModel, Environment $twig)
    {
        $this->newsModel = $newsModel;
        $this->twig = $twig;
    }

    public function save(array $data): void
    {
        $id = $data['id'] ?? null;
        $title = $data['title'] ?? '';
        $content = $data['content'] ?? '';

        if ($id) {
            $this->newsModel->update($id, $title, $content);
            $this->redirect('/?message=News was successfully changed!');
        }

        $this->newsModel->create($title, $content);
        $this->redirect('/?message=News was successfully created!');
    }

    public function delete(?string $id): void
    {
        if ($id) {
            $this->newsModel->delete($id);
            $this->redirect('/?message=News was deleted!');
        }

        $this->redirect('/?message=Invalid delete request.');
    }

    public function index(?string $message): void
    {
        $news = $this->newsModel->all();

        echo $this->twig->render('admin.twig', [
            'news' => $news,
            'message' => $message,
        ]);
    }

    private function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }
}
