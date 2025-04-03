<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "users")]
class User {
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\Column(type: "string")]
    private string $username;

    #[ORM\Column(type: "string")]
    private string $password_hash;

    public function __construct(string $username, string $password_hash) {
        $this->username = $username;
        $this->password_hash = $password_hash;
    }
}

?>