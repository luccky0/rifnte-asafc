<?php
session_start();
try{
    $hasParticipated = false;
    $db = new PDO('sqlite:../data/data.sqlite');
    $stmt = $db->prepare("SELECT COUNT(*) FROM sondage WHERE idPersonne = :userId");
    $stmt->bindParam(':userId', $_SESSION['user_id']);
    $stmt->execute();
    $count = $stmt->fetchColumn();
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

if ($count > 0) {
    $hasParticipated = true;
}
$_SESSION['hasParticipated'] = $hasParticipated;
$hasParticipated = isset($_SESSION['hasParticipated']) ? $_SESSION['hasParticipated'] : false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Association Française du Syndrome de Fatigue Chronique</title>
  <script src="../js/animation.js" defer></script>
  <link href="../css/style_espaceadherent.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="../pages/accueil.php">
        <img src="../image/logo_asfc2.png">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../pages/accueil.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="https://www.asso-sfc.org/asfc-adhesion.php">Adhésion & Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="https://www.asso-sfc.org/asfc-user-login-frm.php">Forum</a>
          </li>
        </ul>
        <div class="header-buttons">
          <a href="../pages/faireundon.php" class="don-btn">Comment faire un don ?</a>
            <a href="<?php echo  !isset($_SESSION['user_id']) ? "../PHP/authentification.php" : ($_SESSION['admin']==true ? "../PHP/espace_admin.php" : "../PHP/espace_adherent.php"); ?>" class="adh-btn">Espace adhérents</a>
        </div>
      </div>
    </div>
  </nav>
  <h1><span class="bold">Espace Adhérent</span></h1>
  <div id="buttons">
    <div class="sondage">
      <h2>Sondage</h2>
      <p>Répondez à un sondage concernant votre situation (Age, Lieu de vie, Activité scolaire ou professionnelle, Qualité de vie, Besoin de soutien). Ces informations sont collectées dans le but de réaliser des indicateurs. L’objectif de cette enquête est de mieux comprendre les
        besoins et problèmes de nos adhérents. (Attention, vous ne pouvez répondre au questionnaire qu'une seule fois)
      </p>
        <button class="button <?php echo $hasParticipated ? 'disabled' : ''; ?>"
                onclick="window.location.href='../pages/page_sondage.php';">
            Accéder au sondage
        </button>
    </div>
      <div class="deconextion">
          <button class="button" onclick="window.location.href='./deconnexion.php';">
              Déconnexion
          </button>
      </div>
  </div>
  <footer>    <a href="#">Liens utiles</a>
    <a href="#">Documentation</a>
    <a href="#">Agenda</a>
    <a href="#">Démarches administratives</a>
    <a href="#">Accueil téléphonique</a>
    <a href="#">Accueil en régions</a>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>