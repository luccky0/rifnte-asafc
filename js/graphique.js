async function fetchRepartition() {
    try{
    const reponse = await fetch('../php/repartitionAdherents.php');
    const data = await reponse.json();
    const totalCell = document.getElementById('totalLieuDeVie');
    const tableBody = document.getElementById('lieuDevieTable');

// Remplir le tableau avec les donn�es
    let compteur =0;
        data.forEach(d => {compteur+=d.nombrePresent;});
    data.forEach(d => {
        const row = tableBody.insertRow(); // Ins�rer une nouvelle ligne
        const cell1 = row.insertCell(0);  // Ins�rer la premi�re cellule
        const cell2 = row.insertCell(1);  // Ins�rer la deuxi�me cellule
        const cell3 = row.insertCell(2);  // Ins�rer la trois�me cellule

        cell1.textContent = d.nom;
        cell2.textContent = d.nombrePresent;
            cell3.textContent = ((d.nombrePresent*100 )/compteur).toFixed(2) + '%';
        });
    totalCell.innerHTML = `<strong>${compteur}</strong>`;
    }

    catch (error){
        console.error('Erreur lors de la r�cup�ration des donn�es,', error);
    }
}

async function fetchAgeMoyen() {
    try{
        const reponse = await fetch('../php/ageMoyenAdhrent.php');
        const data = await reponse.json();
        const tableBody = document.getElementById('ageMoyenActivite');


// Remplir le tableau avec les donn�es
        data.forEach(d => {
            const row = tableBody.insertRow(); // Ins�rer une nouvelle ligne
            const cell1 = row.insertCell(0);  // Ins�rer la premi�re cellule
            const cell2 = row.insertCell(1);  // Ins�rer la deuxi�me cellule

            cell1.textContent = d.nom;
            cell2.textContent = Math.round(d.ageMoyen);

        });


    }
    catch (error){
        console.error('Erreur lors de la r�cup�ration des donn�es,', error);
    }
}
fetchRepartition();
fetchAgeMoyen();