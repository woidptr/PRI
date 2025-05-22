<?php

namespace App\Models;

// include 'article.php';

include "../../vendor/autoload.php";
include_once "../models/article.php";

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Models\Article;

#[Document(db: "pri", collection: "users")]
class User {
    #[Id]
    private string $id;

    #[Field(type: "string")]
    private string $username;

    #[Field(type: "string")]
    private string $email;

    #[Field(type: "string")]
    private string $password_hash;

    #[ReferenceMany(targetDocument: Article::class, mappedBy: "author")]
    private Collection $articles;

    public function __construct(string $username, string $email, string $password_hash) {
        $this->username = $username;
        $this->email = $email;
        $this->password_hash = $password_hash;
        $this->articles = new ArrayCollection();
    }

    public function getId(): string {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPasswordHash(): string {
        return $this->password_hash;
    }

    public function getArticles(): Collection {
        return $this->articles;
    }

    public function addArticle(Article $article): void {
        $this->articles[] = $article;
    }
}

?>