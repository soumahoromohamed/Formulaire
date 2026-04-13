<?php
$prenom    = '';
$nom       = '';
$email     = '';
$age       = '';
$filiere   = '';
$motivation = '';
$erreurs   = [];
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
        <h1>Formulaire de candidature</h1>
        <p class="page-subtitle">Veuillez renseigner vos informations pour soumettre votre candidature.</p>

        <form action="candidature.php" method="POST">

            <div class="form-group">
                 <label>Prénom :
                 <input type="text" name="prenom">
                 </label>
            </div>

            <div class="form-group">
                 <label>Nom :
                 <input type="text" name="nom">
                 </label>
            </div>

            <div class="form-group">
                 <label>Email :
                 <input type="email" name="email">
                 </label>
            </div>

            <div class="form-group">
                 <label>Âge :
                 <input type="number" name="age">
                 </label>
            </div>

            <div class="form-group">
                 <label>Filière souhaitée :</label>
                 <select name="filiere">
                    <option value="">-- Choisir --</option>
                    <option value="Informatique">Informatique</option>
                    <option value="Électronique">Électronique</option>
                    <option value="Mécanique">Mécanique</option>
                    <option value="Autre">Autre</option>
                 </select>
            </div>

            <div class="form-group">
                 <label>Lettre de motivation :</label>
                 <textarea name="motivation" rows="6"></textarea>
            </div>

            <div class="checkbox-group">
                 <input type="checkbox"  name="reglement" value="1">
                 <label>J'ai lu et j'accepte le règlement du club.</label>
            </div>

            <div>
                 <button type="submit">Envoyer ma candidature</button>
            </div>
        </form>

    </div>

</body>
</html>