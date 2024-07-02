<?php

// src/Entity/ApiKey.php
// src/Entity/ApiKey.php
namespace App\Entity;

use App\Repository\ApiKeyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApiKeyRepository::class)]
class ApiKey
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $key;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    public function __construct()
    {
        $this->key = bin2hex(random_bytes(32));
        $this->createdAt = new \DateTime();
    }

    // Getter for key
    public function getKey(): string
    {
        return $this->key;
    }

    // Getters and setters for other properties (if needed)
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
}
