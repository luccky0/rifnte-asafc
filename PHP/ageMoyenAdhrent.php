<?php
header("Content-Type: application/json");
try {
    // Connexion � la base de donn�es
    $pdo = new PDO("sqlite:../data/data.sqlite");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requ�te SQL
    $sql = "SELECT S.idActivite, AVG(S.age) AS ageMoyen, A.libelle AS nom  FROM sondage S INNER JOIN activite A ON S.idLieu = A.id  group by idActivite";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // R�cup�ration des r�sultats
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Conversion en JSON
    echo json_encode($results);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>