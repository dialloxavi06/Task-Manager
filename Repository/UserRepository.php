<?php

require_once '../Entity/User.php';


class UserRepository
{

    public function __construct(private \PDO $pdo) {}

    public function findByUsername(string $username): ?User
    {

        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $data = $stmt->fetch();

        if ($data) {
            return new User($data['id'], $data['username'], $data['password']);
        }

        return null;
    }


    public function save(User $user): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
        $stmt->execute([
            $user->getUsername(),
            $user->getPassword()
        ]);
    }
}
