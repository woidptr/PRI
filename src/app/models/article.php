<?php

namespace App\Models;

include "../../vendor/autoload.php";
include_once "../models/user.php";

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceOne;

use App\Models\User;

#[Document(db: "pri", collection: "articles")]
class Article {
    #[Id]
    private string $id;

    #[Field(type: "string")]
    private string $title;

    #[Field(type: "string")]
    private string $content;

    #[ReferenceOne(targetDocument: User::class, inversedBy: "articles")]
    private User $author;

    public function __construct(string $title, string $content, User $author) {
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function getAuthor(): User {
        return $this->author;
    }
}

?>