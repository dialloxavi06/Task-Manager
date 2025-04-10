<?php
session_start();

require_once '../config/Database.php';
require_once '../Repository/UserRepository.php';

$db = Database::getConnection();
$repo = new UserRepository($db);

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $user = $repo->findByUsername($username);

    if ($user && password_verify($password, $user->getPassword())) {
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['username'] = $user->getUsername();
        header("Location: index.php"); // index.php → dashboard.php recommandé
        exit;
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<?php include 'header.php'; ?>

<div class="container">
    <h2>Connexion</h2>
    <?php if ($error) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post" action="">
        <label>Nom d'utilisateur :</label>
        <input type="text" name="username" required>
        <label>Mot de passe :</label>
        <input type="password" name="password" required>
        <button type="submit">Se connecter</button>
    </form>
</div>

<?php include 'footer.php'; ?>