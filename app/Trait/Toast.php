<?php

namespace App\Trait;

trait Toast
{
    protected string $flashMessageKey = "notification";

    protected function errorToast(string $message): array {
        return ['message' => $message, 'icon' => 'error', 'title' => 'Gagal'];
    }

    protected function successToast(string $message): array {
        return ['message' => $message, 'icon' => 'success', 'title' => 'Berhasil'];
    }
}
