<?php

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

#[ORM\Entity]
#[ORM\Table(name: 'urls')]
class Url {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 10, unique: true)]
    private string $originalUrl;

    #[ORM\Column(type: 'string', length: 10, unique: true)]
    private string $shortCode;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'integer')]
    private int $visits = 0;

    public function __construct(string $originalUrl, string $shortCode)
    {
        $this->originalUrl = $originalUrl;
        $this->shortCode = $shortCode;
        $this->createdAt = new DateTimeImmutable();
        $this->visits = 0;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getOriginalUrl(): string {
        return $this->originalUrl;
    }

    public function getShortCode(): string {
        return $this->shortCode;
    }

    public function getCreatedAt(): DateTimeImmutable {
        return $this->createdAt;
    }

    public function getVisits(): int {
        return $this->visits;
    }

    // Domain logic method
    // Increment the visit count
    public function incrementVisits(): void {
        $this->visits++;
    }

}