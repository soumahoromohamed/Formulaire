<?php
$prenom    = '';
$nom       = '';
$email     = '';
$email_confirm = '';
$age       = '';
$filiere   = '';
$motivation = '';
$reglement  = false;
$erreurs   = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $prenom    = $_POST['prenom'] ?? '';
    $nom       = $_POST['nom'] ?? '';
    $email     = $_POST['email'] ?? '';
    $email_confirm = $_POST['email_confirm'] ?? '';
    $age       = $_POST['age'] ?? '';
    $filiere   = $_POST['filiere'] ?? '';
    $motivation = $_POST['motivation'] ?? '';

    // true si cochée, false sinon
    $reglement = isset($_POST['reglement']);

    if (empty($prenom)) {
        $erreurs[] = "Le prénom est obligatoire.";
    }

    if (empty($nom)) {
        $erreurs[] = "Le nom est obligatoire.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'adresse email est invalide.";
    }

    if ($email !== $email_confirm) {
    $erreurs[] = "Les deux adresses email ne correspondent pas.";
    }

    if (!is_numeric($age) || $age < 16 || $age > 30) {
        $erreurs[] = "L'âge doit être un nombre entre 16 et 30.";
    }

    if (empty($filiere)) {
        $erreurs[] = "Veuillez choisir une filière.";
    }

    if (strlen($motivation) < 30) {
        $erreurs[] = "La motivation doit contenir au moins 30 caractères.";
    }

    if (strlen($motivation) > 300) {
    $erreurs[] = "La lettre de motivation ne doit pas dépasser 300 caractères.";
    }

    if (!$reglement) {
        $erreurs[] = "Vous devez accepter le règlement.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de candidature</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">

        <?php if (empty($erreurs) && $_SERVER['REQUEST_METHOD'] === 'POST'): ?>

            <?php
                echo "<div class='confirmation'>";
                echo "<h2>Candidature reçue !</h2>";
                echo "<p>Prénom : " . $prenom . "</p>";
                echo "<p>Nom : " . $nom . "</p>";
                echo "<p>Email : " . $email . "</p>";
                echo "<p>Âge : " . $age . " ans</p>";
                echo "<p>Filière choisie : " . $filiere . "</p>";
                echo "<p>Lettre de motivation : " . $motivation . "</p>";
                echo "<p class='message-final'>Votre candidature a bien été enregistrée. Nous vous contacterons à l'adresse indiquée.</p>";
                echo "<a href='candidature.php'>Soumettre une nouvelle candidature</a>";
                echo "</div>";
            ?>
        <?php else: ?>

            <h1>Formulaire de candidature</h1>
            <p class="page-subtitle">Veuillez renseigner vos informations pour soumettre votre candidature.</p>

            <?php if (!empty($erreurs)): ?>
                <ul class="erreurs">
                    <?php foreach ($erreurs as $e): ?>
                        <li><?php echo $e; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form action="candidature.php" method="POST">

                <div class="form-group">
                    <label>Prénom :
                    <input type="text" name="prenom" value="<?php echo $prenom; ?>">
                    </label>
                </div>

                <div class="form-group">
                    <label>Nom :
                    <input type="text" name="nom" value="<?php echo $nom; ?>">
                    </label>
                </div>

                <div class="form-group">
                    <label>Email :
                    <input type="email" name="email" value="<?php echo $email; ?>">
                    </label>
                </div>
                <div class="form-group">
                     <label>Confirmez votre email :
                     <input type="email" name="email_confirm" value="<?php echo $email_confirm; ?>">
                     </label>
                </div>

                <div class="form-group">
                     <label>Âge :
                     <input type="number" name="age" value="<?php echo $age; ?>">
                     </label>
                </div>

                <div class="form-group">
                    <label>Filière souhaitée :</label>
                    <select name="filiere">
                        <option value="" <?php echo ($filiere === '') ? 'selected' : ''; ?>>-- Choisir --</option>
                        <option value="Informatique" <?php echo ($filiere === 'Informatique') ? 'selected' : ''; ?>>Informatique</option>
                        <option value="Électronique" <?php echo ($filiere === 'Électronique') ? 'selected' : ''; ?>>Électronique</option>
                        <option value="Mécanique" <?php echo ($filiere === 'Mécanique') ? 'selected' : ''; ?>>Mécanique</option>
                        <option value="Autre" <?php echo ($filiere === 'Autre') ? 'selected' : ''; ?>>Autre</option>
                    </select>
                </div>

                <div class="form-group">
                     <label>Lettre de motivation :</label>
                     <textarea name="motivation" rows="6"><?php echo $motivation; ?></textarea>
                     <p><?php echo strlen($motivation); ?> / 300 caractères</p>
                </div>

                <div class="checkbox-group">
                     <input type="checkbox" name="reglement" value="1" <?php echo $reglement ? 'checked' : ''; ?>>
                     <label>J'ai lu et j'accepte le règlement du club.</label>
                </div>

                <div>
                    <button type="submit">Envoyer ma candidature</button>
                </div>
            </form>
            
        <?php endif; ?>

    </div>
    
</body>
</html>