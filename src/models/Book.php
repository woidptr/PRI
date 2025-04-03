<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

use App\Models\Author;

#[ORM\Entity]
#[ORM\Table(name: "books")]
class Book {
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GenerateValue]
    private int|null $id = null;

    #[ORM\Column(type: "string")]
    private string $title;

    #[ORM\ManyToOne(targetEntity: Author::class, inversedBy: "books")]
    #[ORM\JoinColumn(name: "author_id", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private Author $author;

    public function __construct(string $title, Author $author) {
        $this->title = $title;
        $this->author = $author;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }
}

?>