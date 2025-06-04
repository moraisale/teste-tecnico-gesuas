<?php
namespace Alexandre\Gesuas\Model;

class Citizen {
    public function __construct(
        public ?int $id,    
        public string $name,
        public string $nis
    ) {
        $this->name = trim(preg_replace('/\s+/', ' ', $name));
    
        if (strlen($this->name) < 3 || strlen($this->name) > 100) {
            throw new \InvalidArgumentException("Nome deve ter entre 3 e 100 caracteres");
        }

        if (!preg_match('/^[A-Za-zÀ-ú\s]+$/', $this->name)) {
            throw new \InvalidArgumentException("Nome contém caracteres inválidos");
        }
    }
}