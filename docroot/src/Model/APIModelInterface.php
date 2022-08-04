<?php
namespace App\Model;

interface APIModelInterface {
    public function toArray(): array;
    public function toJson(): string;
}