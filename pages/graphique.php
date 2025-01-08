<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphique D3.js</title>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script src="../js/graphique.js" ></script>
</head>
<body>
<style>
    table {
        width: 50%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        text-align: center;
        padding: 8px;

    }
    table{
        margin-left: 25%;
    }
    #chart{
        margin-left: 40%;
        margin-top: 3%;

    }
    h1{
        text-align: center;
    }
</style>
</head>
<h1>Tableau de la répartition des adhérents dans les lieux de vie</h1>
<table>
    <thead>
    <tr>
        <th>Lieu de vie</th>
        <th>Nombre total</th>
        <th>Pourcentage</th>

    </tr>
    </thead>
    <tbody id="lieuDevieTable"></tbody>
    <tfoot>
    <tr>
        <td><strong>Total</strong></td>
        <td id="totalLieuDeVie"></td>
        <td><strong>100%</strong></td>
    </tr>
    </tfoot>
</table>
<h1>Moyenne des adhérents par activité scolaire ou professionnelle</h1>
<table>
    <thead>
    <tr>
        <th>Activité scolaire ou professionnelle</th>
        <th>Âge Moyen</th>

    </tr>
    </thead>
    <tbody id="ageMoyenActivite"></tbody>

</table>

<div id="chart"></div>
<table id ="autonomieTable">
    <thead>
    <tr>
        <th>Besoin de soutien</th>
        <th>Pourcentage</th>

    </tr>
    </thead>
    <tbody id="autonomie"></tbody>

    <div id="qualiterdevie"></div>

</body>
</html>