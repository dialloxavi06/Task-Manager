<?php
require_once '../config/Database.php';
require_once '../Entity/User.php';
require_once '../Repository/UserRepository.php';

$db = Database::getConnection();
$repo = new UserRepository($db);

$error = ''; // Initialiser une variable pour les erreurs

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si les champs sont remplis
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Vérifier que le mot de passe n'est pas vide
        if (empty($password)) {
            $error = 'Le mot de passe ne peut pas être vide.';
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Créer l'utilisateur et enregistrer
            $user = new User();
            $user->setUsername($username);
            $user->setPassword($hashedPassword);

            $repo->save($user);
            header("Location: login.php");
            exit; // Assurez-vous d'arrêter le script ici après la redirection
        }
    } else {
        $error = 'Tous les champs doivent être remplis.';
    }
}

include 'header.php';
?>

<div class="container">
    <h2 class="text-center mb-4">Inscription</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" action="register.php" class="mx-auto" style="max-width: 400px;">
        <div class="mb-3">
            <label for="username" class="form-label">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe :</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">S’inscrire</button>
        </div>
    </form>
</div>

<?php
include 'footer.php';
?>