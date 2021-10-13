var mesTables =null, boutonSupprimer =  null;
document.addEventListener('DOMContentLoaded',function(){
  mesTables = document.getElementsByTagName('table');
  for(var j = 0; j<mesTables.length; j++) {
    boutonSupprimer = mesTables[j].getElementsByClassName('btn-danger');
    for(var i = 0; i<boutonSupprimer.length; i++){
      boutonSupprimer[i].addEventListener('click',  supprimerLigne);
    }//for
  }

});

/*
Méthode 1 basic 
compatible avec tous les navigateurs même tres anciens
*/
function supprimerLigne(oEvent){
  var oEleBt = oEvent.currentTarget,
      oTr = oEleBt.parentNode.parentNode ;
  oTr.remove(); 
}//fct

function DeleteRow(o) {
    //no clue what to put here?
    var p=o.parentNode.parentNode;
    p.parentNode.removeChild(p);
}

    /* Elle prend la table de la création des ingredient :
  - elle rajoute une ligne à la fin du tableau
  - si l'input n'existe pas dans la datalist de la barre de recherche, le rajout de la ligne n'est pas accepté */
  function CreateLigneIngredient() {
    var listDesIngredient = null, options = null;
    options = document.querySelectorAll('#listeDesIngredients .nomIngredient')
    var i = 0;
    var ingredienttrouver = false;
    var NomChoisi = document.getElementById('inputIngredient').value;
    while(i<options.length && !ingredienttrouver){
    if(options[i].value === NomChoisi){
        ingredienttrouver = true;
    }
    i = i + 1;
    }
    if(ingredienttrouver == true){
    var table = document.getElementById("bodyIngredients");
    var row = table.insertRow(table.length);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    cell1.innerHTML = "4";
    cell2.innerHTML = NomChoisi;
    cell3.innerHTML = "$Unite";
    cell4.innerHTML = ' <input type="number" class="form-control w-50" placeholder="Qté...">';
    cell5.innerHTML = "$PrixU";
    cell6.innerHTML =  "$PTHT";
    cell7.innerHTML = '<button class="btn btn-danger" type="button" onclick="DeleteRow(this)"><i class="bi bi-trash" style="font-size: 1rem;" ></i></button>';
    }
    else{
    alert('Ingredient non trouvé, veuillez réessayer'); 
    }
}

/* Elle prend la table de la création des fiches techniques :
  - elle rajoute une ligne à la fin du tableau
  - si l'input n'existe pas dans la datalist de la barre de recherche, le rajout de la ligne n'est pas accepté */
  function CreateLigneFiche() {
    var listDesFiches = null, options = null;
    options = document.querySelectorAll('#listeDesFichesTechniques .nomFiche');
    var i = 0;
    var fichetrouver = false;
    var NomChoisi = document.getElementById('inputFiches').value;
    while(i<options.length && !fichetrouver){
    if(options[i].value === NomChoisi){
        fichetrouver = true;
    }
    i = i + 1;
    }
    if(fichetrouver == true){
    var table = document.getElementById("bodyFiche");
    var row = table.insertRow(table.length);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    cell1.innerHTML = "4";
    cell2.innerHTML = NomChoisi;
    cell3.innerHTML = "nbrecouverts";
    cell4.innerHTML = "$auteur";
    cell5.innerHTML = "catégorie";
    cell6.innerHTML = '<button class="btn btn-danger" type="button" onclick="DeleteRow(this)"><i class="bi bi-trash" style="font-size: 1rem;" ></i></button>';
    }
    else{
    alert('fiche non trouvé, veuillez réessayer'); 
    }
}

    /* Elle prend la table de la création des fiches techniques :
  - elle rajoute une ligne à la fin du tableau
  - si l'input n'existe pas dans la datalist de la barre de recherche, le rajout de la ligne n'est pas accepté */
  function CreateLigneProgressionExistante() {
    var listDesProgressions = null, options = null;
    options = document.querySelectorAll('#listeDesProgressions .nomProgression');
    var i = 0;
    var progressiontrouver = false;
    var NomChoisi = document.getElementById('inputProgressionExistante').value;
    while(i<options.length && !progressiontrouver){
    if(options[i].value === NomChoisi){
        progressiontrouver = true;
    }
    i = i + 1;
    }
    if(progressiontrouver == true){
    var table = document.getElementById("bodyProgressions");
    var row = table.insertRow(table.length);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.innerHTML = "code";
    cell2.innerHTML = NomChoisi;
    cell3.innerHTML = '<button class="btn btn-danger" type="button" onclick="DeleteRow(this)"><i class="bi bi-trash" style="font-size: 1rem;" ></i></button>';
    }
    else{
    alert('Progression non trouvé, veuillez réessayer'); 
    }
}

    /* Elle prend la table de la création des fiches techniques :
  - elle rajoute une ligne à la fin du tableau
  - si l'input existe dans la datalist de la barre de recherche, le rajout de la ligne nest pas accepté*/
  function CreateLigneProgressionInDB() {
    var listDesProgressions = null, options = null;
    options = document.querySelectorAll('#listeDesProgressions .nomProgression');
    var i = 0;
    var progressiontrouver = false;
    var NomChoisi = document.getElementById('inputProgressionInDB').value;
    while(i<options.length && !progressiontrouver){
    if(options[i].value === NomChoisi || NomChoisi ==""){
        progressiontrouver = true;
    }
    i = i + 1;
    }
    if(progressiontrouver == false){
    var table = document.getElementById("bodyProgressions");
    var row = table.insertRow(table.length);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.innerHTML = "code";
    cell2.innerHTML = NomChoisi;
    cell3.innerHTML = '<button class="btn btn-danger" type="button" onclick="DeleteRow(this)"><i class="bi bi-trash" style="font-size: 1rem;" ></i></button>';
    }
    else{
      if(NomChoisi == ""){
        alert("impossible");
      }
      else{
        alert('Progression existe déja, veuillez la rajouter de la barre en dessous'); 
      }
    }
}


