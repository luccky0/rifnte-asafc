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


    async function diagrammeCirculaire(){
    // V�rifiez que le fichier est bien charg�
    console.log("Le fichier script.js est charg�");

// 1. Pr�parer les donn�es
    try {
        const reponse = await fetch('../php/autonomieAdherent.php');
        const data = await reponse.json();
        console.log(data);

// 2. Dimensions
        let tab = [];

        let compteur =0;
        data.forEach(d => {compteur+=d.nombrePresent;});
        data.forEach(d => {
            tab.push(((d.nombrePresent * 100) / compteur).toFixed(2) + '%');
        });

        const width = 500;
        const height = 500;
        const radius = Math.min(width, height) / 2;

// 3. Couleurs
        const color = d3.scaleOrdinal()
            .domain(data.map(d => d.category))
            .range(d3.schemeCategory10);

// 4. Canevas SVG
        const svg = d3.select("#chart")
            .append("svg")
            .attr("width", width )
            .attr("height", height )
            .append("g")
            .attr("transform", `translate(${(width / 2)}, ${(height / 2)})`);

// 5. G�n�rer les arcs
        const pi = d3.pie().value(d=>d.nombrePresent);

        const arc = d3.arc()
            .innerRadius(0)
            .outerRadius(radius);
        let values = [];
        let names = [];
        data.forEach(d=> {values.push(d.nombrePresent);
        names.push(d.nom);});
        const dataTab = d3.pie()(values);
        console.log(dataTab);

// 6. Ajouter les segments
        svg.selectAll("path")
            .data(pi(data))
            .enter()
            .append("path")
            .attr("d", arc)
            .attr("stroke", "#fff")  // Couleur de la bordure (blanche ici)
            .attr("stroke-width", 2) // �paisseur de la bordure
            .attr("fill", d => color(d.data.id))

        ;

// 7. Ajouter les labels
        svg.selectAll("text")
            .data(dataTab)
            .enter()
            .append("text")
            .attr("transform", d => `translate(${arc.centroid(d)})`)
            .attr("text-anchor", "middle")
            .text((d, i) => tab[i])
            .style("font-size", "12px")
            .style("fill", "#fff");
        console.log(pi(data));

        const tableBody = document.getElementById('autonomie');

// Remplir le tableau avec les donn�es
        data.forEach(d => {
            const row = tableBody.insertRow(); // Ins�rer une nouvelle ligne
            const cell1 = row.insertCell(0);  // Ins�rer la premi�re cellule
            const cell2 = row.insertCell(1);  // Ins�rer la deuxi�me cellule

            cell1.textContent = d.nom;
            cell2.textContent = ((d.nombrePresent*100 )/compteur).toFixed(2) + '%';
        });

    }
    catch (e){
        console.log(e);
    }
};
async function main(){
    console.log("D�but du programme");

    // Appeler d'autres fonctions asynchrones si n�cessaire
    await fetchRepartition();
    await fetchAgeMoyen();

    // Cr�er le camembert apr�s r�cup�ration des donn�es
    await diagrammeCirculaire();

    console.log("Camembert affich�");
}
main();