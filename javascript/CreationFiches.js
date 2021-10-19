
function DeleteRow(o) {
    //no clue what to put here?
    var p=o.parentNode.parentNode;
    p.parentNode.removeChild(p);
}


/* verifier si l'ingredient à déja été choisi, ene parametre :
  - le nom de lingredient
  - la table a parcourir dans laquelle il ne doit pas exister déja, si existe renvoie true */
  function IngredientAlreadyInTable(ing,tableIng){
    var IngTrouver = false;
    var i = 0;
    while( i< tableIng.rows.length && !IngTrouver){
      if(tableIng.rows[i].cells[1].innerHTML == ing){
        IngTrouver = true;
      }
      i = i + 1 ;
    } // pour chaque ligne as row

    return IngTrouver;
  }
    /* Elle prend la table de la création des ingredient :
  - elle rajoute une ligne à la fin du tableau
  - si l'input n'existe pas dans la datalist de la barre de recherche, le rajout de la ligne n'est pas accepté */
  TabIngredients = new Array();
  function CreateLigneIngredient() {
    options = null;
    options = document.querySelectorAll('#listeDesIngredients .nomIngredient') //les noms des ingredients dans la BD
    optionsNum = document.querySelectorAll('#listeDesIngredients .NumIngredient')  // les num des ingredients dans ma BD
    optionsPrixU = document.querySelectorAll('#listeDesIngredients .PrixUnitaire') //les prixU des ing dans la BD
    optionsUnite = document.querySelectorAll('#listeDesIngredients .Unite') // les Unite des ing dans la BD
    optionsAllergene = document.querySelectorAll('#listeDesIngredients .Allergene') //les allergene des ingredients dans la BD
    var i = 0; //incrementeur
    var ingredienttrouver = false; // verifier si l'ingredient existe dans la liste des ing dans la BD
    var NomChoisi = document.getElementById('inputIngredient').value; // le nom d'ingredient choisi dans la barre de recherche
    var table = document.getElementById("bodyIngredients"); // le body de la table ingredient
    var $IngredientInTable = IngredientAlreadyInTable(NomChoisi,table) // verifier si l'ingredient à déja été choisi
    while(i<options.length && !ingredienttrouver){
    if(options[i].value === NomChoisi && !$IngredientInTable){ //si l'ingredient est trouvé dans la liste et qu'il n'existe pas deja dans le tableau
        ingredienttrouver = true;
        var CodeIngredient = optionsNum[i].value // on recupere le code de cet ingredient
        var PrixU = optionsPrixU[i].value // on recupere son PrixU
        var UniteIng = optionsUnite[i].value // son unite
        var AllergeneIng = optionsAllergene[i].value // son allergene si existe 
    }
    i = i + 1;
    }

    if(ingredienttrouver == true){
    var row = table.insertRow(table.length);
    var cell1 = row.insertCell(0);
    console.log("cell1 : " + cell1);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    cell1.innerHTML = AllergeneIng;
    cell2.innerHTML = NomChoisi;
    cell3.innerHTML = UniteIng;
    cell4.innerHTML = ' <input type="number" step="any" class="form-control w-50" id="QteIng" placeholder="Qté...">';
    console.log("input : " + cell4.lastChild);
    cell5.innerHTML = PrixU;
    console.log("cell 5 value : " + cell5.innerHTML);
    cell6.innerHTML =  "$PTHT";
    cell7.innerHTML = '<button class="btn btn-danger" type="button" onclick="DeleteRowIngredients(this)"><i class="bi bi-trash" style="font-size: 1rem;" ></i></button>';
    cell7.id = CodeIngredient;
    TabIngredients.push(CodeIngredient); // on rajoute le Code de lingredient rajouté par lutilisateur dans le tableau TabIngredients
    //document.cookie = 'TabFiches=' + JSON.stringify(TabIngredients) + '; path=/'; // cookie
    console.log("id ingredient qu'on va push : " + cell7.id);
    console.log("Ingredient rajouté : " + TabIngredients);
    }
    else{
      if($IngredientInTable){
        alert('Ingredient déja choisi, veuillez réessayer'); 
      }else{
        alert('Ingredient non trouvé, veuillez réessayer'); 
      }
    }
}

function DeleteRowIngredients(o) {
  // supprimer dans le tableau
  var index = TabIngredients.indexOf(o.parentNode.id); // trouver l'index de l'id à supprimer dans la TabFiches
  console.log(o.parentNode.id);
  var rem = TabIngredients.splice(index,1); // supprimer un element qui se trouve à la position index
  console.log("Ingredient supprime : " + TabIngredients);
  // supprimer la ligne
  var p=o.parentNode.parentNode;
  p.parentNode.removeChild(p);

}

//fonction pour calculer les prix et le mettre a jour directement
document.addEventListener("click",function(){
  var tableIngredients = document.getElementById('bodyIngredients');
  console.log("longueur table ingredient: " + tableIngredients.rows.length);
  var TotalDenree = 0; // pour le totalDenree
  //recuperer le Coeff ASS
  var SelectCoeffAss = document.getElementById('coeffASS');
  var CoeffAss = parseFloat(SelectCoeffAss.options[SelectCoeffAss.selectedIndex].text);
  console.log("CoeffASS : " + CoeffAss);
  //recuperer le coeff perso
  var SelectCoeffPerso = document.getElementById('coeffCoutPersonnel');
  var CoeffPerso = parseFloat(SelectCoeffPerso.options[SelectCoeffPerso.selectedIndex].text);
  console.log("coeff perso : " + CoeffPerso);
  //recuperer le cout de fluide 
  var CoutFluide = document.getElementById('CoutFluide_id').value;
  console.log("cout fluide : " + CoutFluide);
  //commencer le calcul
  for(var i = 0,row;row=tableIngredients.rows[i]; i++){ // pour chaque ligne as row
    var QteIng = row.cells[3].lastChild.value; // on recupere la quantite de l'ing
    var prixU = parseFloat(row.cells[4].innerHTML); // on recupere son prixU
    var ptht = QteIng * prixU; // on calcul sn ptht
    row.cells[5].innerHTML = ptht; // on met le ptht dans la bonne colonne
    TotalDenree = TotalDenree + ptht;
  }
  //calculer les autres prix 
  var ASS = CoeffAss * TotalDenree; 
  var CoutMatiere = TotalDenree + ASS;
  var CoutPersonnel = CoeffPerso *16.74;
  var CoutProductionTotale = CoutMatiere + CoutPersonnel + CoutFluide;
  var CoutProductionPortion = CoutProductionTotale * 0.1;
  // maintenant,, mettre les prix dans leur table de prix 
  var tablePrix = document.getElementById('bodyPrix');
  tablePrix.rows[0].cells[1].innerHTML = TotalDenree;
  tablePrix.rows[1].cells[1].innerHTML = ASS;
  tablePrix.rows[2].cells[1].innerHTML = CoutMatiere;
  tablePrix.rows[3].cells[1].innerHTML = CoutPersonnel;
  tablePrix.rows[4].cells[1].innerHTML = CoutFluide;
  tablePrix.rows[5].cells[1].innerHTML = CoutProductionTotale;
  tablePrix.rows[6].cells[1].innerHTML = CoutProductionPortion;
});

  TabFiches = new Array(); // variable globale qui contient les sous fiches
  var ordreFiche = 0;
/* Elle prend la table de la création des fiches techniques :
  - elle rajoute une ligne à la fin du tableau
  - si l'input n'existe pas dans la datalist de la barre de recherche, le rajout de la ligne n'est pas accepté */
  function CreateLigneFiche() {
    options = null;
    options = document.querySelectorAll('#listeDesFichesTechniques .nomFiche'); // les noms des fiches dand la BD
    optionsNum = document.querySelectorAll('#listeDesFichesTechniques .NumeroFiche'); // les numero des fiches dans la BD
    optionsCouv = document.querySelectorAll('#listeDesFichesTechniques .NbreCouverts'); // less nbrecouverts des fiches dans la BD
    optionsAuteur = document.querySelectorAll('#listeDesFichesTechniques .NomAuteur'); //les nomAuteur des fihces dans la BD
    //optionsFluide = document.querySelectorAll('#listeDesFichesTechniques .CoutFluide'); // les cout fluide de  la fiche dans la BD
    optionsCat = document.querySelectorAll('#listeDesFichesTechniques .NomCategorieFiche'); // les categorie des fiches dans la BD 
    var i = 0; // incrementeur
    var fichetrouver = false;
    var NomChoisi = document.getElementById('inputFiches').value; // le nom que le client met dans la barre de recherche
    while(i<options.length && !fichetrouver){
    if(options[i].value === NomChoisi){ // si le nom se trouve dans la liste
        fichetrouver = true;
        ordreFiche = ordreFiche +  1 ; // on incremente lordre des fiches
        var codeFiche = optionsNum[i].value; // le code de la fiche
        var CouvFiche = optionsCouv[i].value; // le code de la fiche
        var AuteurFiche = optionsAuteur[i].value; // le code de la fiche
        //var FluideFiche = optionsFluide[i].value; // le code de la fiche
        var CategorieFiche = optionsCat[i].value; // le code de la fiche
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
    cell1.innerHTML = ordreFiche;
    cell2.innerHTML = NomChoisi;
    cell3.innerHTML = CouvFiche;
    cell4.innerHTML = AuteurFiche;
    cell5.innerHTML = CategorieFiche;
    cell6.innerHTML = '<button class="btn btn-danger" type="button" onclick="DeleteRowFiches(this)"><i class="bi bi-trash" style="font-size: 1rem;" ></i></button>';
    cell6.id = codeFiche; // on attribut le code de la fiche qui vient detre rajouté dans le front comme id à la case qui contient le bouton supprimer 
    console.log(cell6.id);
    TabFiches.push(codeFiche); // on rajoute le Code de la fiche rajouté par lutilisateur dans le tableau TabFiches
    console.log(TabFiches.length);
    console.log("Fiche ajouté : " + TabFiches);
    
    //document.cookie = "TabFiches=; expires=Thu, 01 Jan 1970 00:00:00 GMT; SameSite=None; Secure";
    document.cookie = 'TabFiches=' + JSON.stringify(TabFiches) + '; path=/'; // cookie
    //envoyer la TabFiche vers la pageHtml avec la method setAttribute
    document.getElementById("inputTableIngredients").setAttribute("name",TabFiches);
    console.log(document.getElementById("inputTableIngredients").getAttribute("name"));
    }
    else{
    alert('fiche non trouvé, veuillez réessayer'); 
    }
}

  function DeleteRowFiches(o) {
    // supprimer dans le tableau
    var index = TabFiches.indexOf(o.parentNode.id); // trouver l'index de l'id à supprimer dans la TabFiches
    console.log(o.parentNode.id);
    var rem = TabFiches.splice(index,1); // supprimer un element qui se trouve à la position index
    console.log("Fiche supprime " + TabFiches);
    // supprimer la ligne
    var p=o.parentNode.parentNode;
    p.parentNode.removeChild(p);
    document.cookie = 'TabFiches=' + JSON.stringify(TabFiches) + '; path=/'; // cookie renvoyé avec le tableau mis à jour
  }

    /* Elle prend la table de la création des fiches techniques :
  - elle rajoute une ligne à la fin du tableau
  - si l'input n'existe pas dans la datalist de la barre de recherche, le rajout de la ligne n'est pas accepté */
  TabProgressions = new Array();
  ordreProgressions = 0;
  function CreateLigneProgressionExistante() {
    options = null;
    options = document.querySelectorAll('#listeDesProgressions .nomProgression'); //les noms des progressions dans la BD
    optionsNum = document.querySelectorAll('#listeDesProgressions .NumProgression'); //les Num des progressions dans la BD
    var i = 0;
    var progressiontrouver = false;
    var NomChoisi = document.getElementById('inputProgressionExistante').value;
    while(i<options.length && !progressiontrouver){
    if(options[i].value === NomChoisi){
        progressiontrouver = true;
        ordreProgressions = ordreProgressions + 1; //ordre + 1
        var CodeProgression = optionsNum[i].value;
    }
    i = i + 1;
    }
    if(progressiontrouver == true){
    var table = document.getElementById("bodyProgressions");
    var row = table.insertRow(table.length);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.innerHTML = ordreProgressions;
    cell2.innerHTML = NomChoisi;
    cell3.innerHTML = '<button class="btn btn-danger" type="button" onclick="DeleteRowProgressions(this)"><i class="bi bi-trash" style="font-size: 1rem;" ></i></button>';
    cell3.id = CodeProgression; // on attribut le code de la progression qui vient detre rajouté dans le front comme id à la case qui contient le bouton supprimer
    console.log("id etape ajouté : " + CodeProgression);
    TabProgressions.push(CodeProgression); // on push le code dans le tableau 
    console.log("le tab de prog : " + TabProgressions);
    document.cookie = 'TabProgressions=' + JSON.stringify(TabProgressions) + '; path=/'; // cookie
    }
    else{
    alert('Progression non trouvé, veuillez réessayer'); 
    }
}

function DeleteRowProgressions(o) {
  // supprimer dans le tableau
  var index = TabProgressions.indexOf(o.parentNode.id); // trouver l'index de l'id à supprimer dans la TabFiches
  console.log(o.parentNode.id);
  var rem = TabProgressions.splice(index,1); // supprimer un element qui se trouve à la position index
  console.log("étape supprime " + TabProgressions);
  // supprimer la ligne
  var p=o.parentNode.parentNode;
  p.parentNode.removeChild(p);
  document.cookie = 'TabProgressions=' + JSON.stringify(TabFiches) + '; path=/'; // cookie renvoyé avec le tableau mis à jour
}

    /* Elle prend la table de la création des fiches techniques :
  - elle rajoute une ligne à la fin du tableau
  - si l'input existe dans la datalist de la barre de recherche, le rajout de la ligne nest pas accepté*/
  function CreateLigneProgressionInDB() {
    options = null;
    options = document.querySelectorAll('#listeDesProgressions .nomProgression'); //les noms des progressions dans la BD
    //optionsNum = document.querySelectorAll('#listeDesProgressions .NumProgression'); //les Num des progressions dans la BD
    var i = 0;
    var progressiontrouver = false;
    var NomChoisi = document.getElementById('inputProgressionInDB').value;
    while(i<options.length && !progressiontrouver){
    if(options[i].value === NomChoisi || NomChoisi ===""){
        progressiontrouver = true;
        ordreProgressions = ordreProgressions + 1; //ordre + 1
        //var CodeProgression = optionsNum[i].value;
    }
    i = i + 1;
    }
    if(progressiontrouver == false){
      var table = document.getElementById("bodyProgressions");
      var row = table.insertRow(table.length);
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      var cell3 = row.insertCell(2);
      cell1.innerHTML = ordreProgressions;
      cell2.innerHTML = NomChoisi;
      cell3.innerHTML = '<button class="btn btn-danger" type="button" onclick="DeleteRowProgressions(this)"><i class="bi bi-trash" style="font-size: 1rem;" ></i></button>';
      cell3.id = NomChoisi; // on attribut le code de la progression qui vient detre rajouté dans le front comme id à la case qui contient le bouton supprimer
      console.log("id etape ajouté : " + NomChoisi);
      TabProgressions.push(NomChoisi); // on push le code dans le tableau 
      console.log("le tab de prog : " + TabProgressions);
      document.cookie = 'TabProgressions=' + JSON.stringify(TabProgressions) + '; path=/'; // cookie
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

