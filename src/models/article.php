<?php

namespace App\Models;

include "../../vendor/autoload.php";

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;

#[Document(db: "pri", collection: "articles")]
class Article {
    #[Id]
    private string $id;

    #[Field(type: "string")]
    private string $title;

    #[Field(type: "string")]
    private string $description;

    #[Field(type: "string")]
    private string $content;

    public function __construct(string $title, string $description, string $content) {
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getContent(): string {
        return $this->content;
    }
}

?>