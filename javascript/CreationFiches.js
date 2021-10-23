//espace variables globales
TabIngredients = new Array();
TabQteIngredient = new Array();
incrementeurIng = 0;

TabFiches = new Array(); // variable globale qui contient les sous fiches
var ordreFiche = 0;

TabProgressions = new Array();
document.cookie = 'TabProgressions=' + JSON.stringify(TabProgressions) + '; path=/'; // cookie
ordreProgressions = 0;
/*-----------*/ 

function DeleteRow(o) {
    //no clue what to put here?
    var p=o.parentNode.parentNode;
    p.parentNode.removeChild(p);
}

// initialiser la variable globale tableau de l'ingredient et tabQte avec les valeurs de la BD 
document.addEventListener('DOMContentLoaded',function(){
  document.cookie = ('TabIng=' + JSON.stringify(TabIngredients) + '; path=/'); // cookie
  document.cookie = ('TabQteIng=' + JSON.stringify(TabQteIngredient) + '; path=/'); // cookie
  document.cookie = 'TabFiches=' + JSON.stringify(TabFiches) + '; path=/'; // cookie
  document.cookie = 'TabProgressions=' + JSON.stringify(TabProgressions) + '; path=/'; // cookie
  if(document.getElementById('readonly')){ // si on fait un update 
    var tableIngredients = document.getElementById('bodyIngredients');
    for(var i = 0,row;row=tableIngredients.rows[i]; i++){ // pour chaque ligne as row
      var QteIng = $(row.cells[3]).find("input").val(); // on recupere la quantite de l'ing $(col).find("input").val();
      var CodeIng = row.cells[6].id;
      TabIngredients.push(CodeIng);
      TabQteIngredient.push(QteIng);
    } // fin pour ingredient
    console.log("Tab initiale ing : " + TabIngredients);
    console.log("Tab initiale QteIng : " + TabQteIngredient);
    var tableSousFiche = document.getElementById("bodyFiche");
    for(var i = 0, row;row=tableSousFiche.rows[i]; i++){
      var CodeSousFiche = row.cells[5].id;
      TabFiches.push(CodeSousFiche); // on push le code dans le tableau
    }// fin pour fiche
    document.cookie = 'TabFiches=' + JSON.stringify(TabFiches) + '; path=/'; // cookie
    console.log("Tab initiale Fiches : " + TabFiches);
    var tableProg = document.getElementById("bodyProgressions");
    for(var i = 0, row;row=tableProg.rows[i]; i++){
      var CodeProg= row.cells[2].id;
      TabProgressions.push(CodeProg); // on push le code dans le tableau
    }// fin pour prog
    document.cookie = 'TabProgressions=' + JSON.stringify(TabProgressions) + '; path=/'; // cookie
    console.log("Tab initiale Prog : " + TabProgressions);
  }// fin if
});


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
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    cell1.innerHTML = AllergeneIng;
    cell2.innerHTML = NomChoisi;
    cell3.innerHTML = UniteIng;
    var inputQte = document.createElement("input"); //input qui contiendra la qte
    inputQte.setAttribute("type","number");
    inputQte.setAttribute("step","any");
    inputQte.setAttribute("class","form-control w-50");
    inputQte.setAttribute("id","QteIng");
    inputQte.setAttribute("placeholder","Qté..");
    inputQte.required = true;
    //cell4.innerHTML = ' <input type="number" step="any" class="form-control w-50" id="QteIng" placeholder="Qté...">';
    cell4.appendChild(inputQte);
    cell5.innerHTML = PrixU;
    cell6.innerHTML =  "0";
    cell7.innerHTML = '<button class="btn btn-danger" type="button" onclick="DeleteRowIngredients(this)"><i class="bi bi-trash" style="font-size: 1rem;" ></i></button>';
    cell7.id = CodeIngredient;
    TabIngredients.push(CodeIngredient); // on rajoute le Code de lingredient rajouté par lutilisateur dans le tableau TabIngredients
    TabQteIngredient.push("");
    }
    else{
      if($IngredientInTable){
        alert('Ingredient déja choisi, veuillez réessayer'); 
      }else{
        alert('Ingredient non trouvé, veuillez réessayer'); 
      }
    }
}

TabIng = new Array();

document.addEventListener("click",function(){
        var tableIngredients = document.getElementById('bodyIngredients');
        for(var i = 0,row;row=tableIngredients.rows[i]; i++){ // pour chaque ligne as row
          var QteIng = $(row.cells[3]).find("input").val(); // on recupere la quantite de l'ing $(col).find("input").val();
          var CodeIngredient = row.cells[6].id; // on recupere lo code de ling
          for(y=0; y<TabIngredients.length; y++){ //pour chque element du cookie 
            if(TabIngredients[y]==CodeIngredient && QteIng!=""){
              TabQteIngredient.splice(y,1,QteIng);
            }
          }
        }
        console.log("TabIngredient : "+TabIngredients);
        console.log("TabQteIng : "+TabQteIngredient);
        document.cookie = ('TabIng=' + JSON.stringify(TabIngredients) + '; path=/'); // cookie
        document.cookie = ('TabQteIng=' + JSON.stringify(TabQteIngredient) + '; path=/'); // cookie
      });

/*document.addEventListener('submit',function(){
  document.cookie = ('TabIng=' + JSON.stringify(TabIng) + '; path=/'); // cookie
  document.cookie = ('TabQteIng=' + JSON.stringify(TabQteIngredient) + '; path=/'); // cookie
});*/



function DeleteRowIngredients(o) {
  // supprimer dans le tableau
  var index = TabIngredients.indexOf(o.parentNode.id); // trouver l'index de l'id à supprimer dans la TabFiches
  console.log("id a spurrimer : " + o.parentNode.id);
  var rem = TabIngredients.splice(index,1); // supprimer un element qui se trouve à la position index
  TabQteIngredient.splice(index,1);
  console.log("TabIngredient après supprime : " + TabIngredients);
  incrementeurIng = incrementeurIng - 1;
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
    var QteIng = $(row.cells[3]).find("input").val(); // on recupere la quantite de l'ing $(col).find("input").val();
    var prixU = parseFloat(row.cells[4].innerHTML); // on recupere son prixU
    var ptht = QteIng * prixU; // on calcul sn ptht
    ptht = Math.round(ptht * 100) / 100;
    row.cells[5].innerHTML = ptht; // on met le ptht dans la bonne colonne
    TotalDenree = TotalDenree + ptht;
  }
  //calculer les autres prix 
  var ASS = CoeffAss * TotalDenree; 
  ASS = Math.round(ASS * 100) / 100;
  var CoutMatiere = TotalDenree + ASS;
  CoutMatiere = Math.round(CoutMatiere * 100) / 100;
  var CoutPersonnel = CoeffPerso *16.74;
  CoutPersonnel = Math.round(CoutPersonnel * 100) / 100;
  var CoutProductionTotale = CoutMatiere + CoutPersonnel + CoutFluide;
  CoutProductionTotale = Math.round(CoutProductionTotale * 100) / 100;
  var CoutProductionPortion = CoutProductionTotale * 0.1;
  CoutProductionPortion = Math.round(CoutProductionPortion * 100) / 100;
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
    dejaPresent = false;
    for(var i=0; i<TabFiches.length; i++){
      if(TabFiches[i]==codeFiche){
        dejaPresent=true;
      }
    }
    if(fichetrouver == true && !dejaPresent){
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
    console.log("id sous fiche créée : " + cell6.id);
    TabFiches.push(codeFiche); // on rajoute le Code de la fiche rajouté par lutilisateur dans le tableau TabFiches
    associerIngredient(TabFiches);
    associerProgressions();
    console.log("TabFiche après ajouté : " + TabFiches);
    
    //document.cookie = "TabFiches=; expires=Thu, 01 Jan 1970 00:00:00 GMT; SameSite=None; Secure";
    document.cookie = 'TabFiches=' + JSON.stringify(TabFiches) + '; path=/'; // cookie
    //envoyer la TabFiche vers la pageHtml avec la method setAttribute
    //document.getElementById("inputTableIngredients").setAttribute("name",TabFiches);
    //console.log(document.getElementById("inputTableIngredients").getAttribute("name"));
    }
    else{
    alert('fiche non trouvé, veuillez réessayer'); 
    }
}

  var tabingredientsPushed = [];

  function associerIngredient(TabFiches){
    options = document.querySelectorAll('#listeDesIngredients .nomIngredient') //les noms des ingredients dans la BD
    console.log(options);
    optionsNum = document.querySelectorAll('#listeDesIngredients .NumIngredient')  // les num des ingredients dans ma BD
    optionsPrixU = document.querySelectorAll('#listeDesIngredients .PrixUnitaire') //les prixU des ing dans la BD
    optionsUnite = document.querySelectorAll('#listeDesIngredients .Unite') // les Unite des ing dans la BD
    optionsAllergene = document.querySelectorAll('#listeDesIngredients .Allergene') //les allergene des ingredients dans la BD
    FK_NumeroFiche = document.querySelectorAll('#compositions .FK_NumeroFiche');
    FK_NumeroIngredient = document.querySelectorAll('#compositions .FK_NumeroIngredient');
    QuantiteIngredient = document.querySelectorAll('#compositions .QuantiteIngredient');
    var table = document.getElementById("bodyIngredients");
    if(TabFiches.length>tabingredientsPushed.length){
      if(tabingredientsPushed.length==0){
        indexFiche = 0;
      }
      else{
        indexFiche = TabFiches.length - tabingredientsPushed.length;
      }
      for(var i=0; i<FK_NumeroFiche.length; i++){
        if(FK_NumeroFiche[i].value==TabFiches[indexFiche]){
          for(var y=0; y<optionsNum.length; y++){
            if(optionsNum[y].value==FK_NumeroIngredient[i].value){
              CodeIngredient = FK_NumeroIngredient[i].value;
              nomIngredient = options[y].value;
              PrixUnitaire = optionsPrixU[y].value; // on recupere son PrixU
              Unite = optionsUnite[y].value;
              Allergene = optionsAllergene[y].value;
              Quantite = QuantiteIngredient[i].value;
              console.log(ingredientInTable(CodeIngredient));
              if(!ingredientInTable(CodeIngredient)){
                var row = table.insertRow(table.length);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                var cell6 = row.insertCell(5);
                var cell7 = row.insertCell(6);
                cell1.innerHTML = Allergene;
                cell2.innerHTML = nomIngredient;
                cell3.innerHTML = Unite;
                inputQte = document.createElement("input"); //input qui contiendra la qte
                inputQte.setAttribute("type","number");
                inputQte.setAttribute("step","any");
                inputQte.setAttribute("class","form-control w-50");
                inputQte.setAttribute("id","QteIng");
                inputQte.setAttribute("value",Quantite);
                //cell4.innerHTML = ' <input type="number" step="any" class="form-control w-50" id="QteIng" placeholder="Qté...">';
                cell4.appendChild(inputQte);
                cell5.innerHTML = PrixUnitaire;
                cell6.innerHTML =  "$PTHT";
                cell7.innerHTML = '<button class="btn btn-danger" type="button" onclick="DeleteRowIngredients(this)"><i class="bi bi-trash" style="font-size: 1rem;" ></i></button>';
                cell7.id = CodeIngredient;
                TabIngredients.push(CodeIngredient); // on rajoute le Code de lingredient rajouté par lutilisateur dans le tableau TabIngredients
                tabingredientsPushed.push(CodeIngredient);
                TabQteIngredient.push("");
                console.log(TabIngredients);
              }
            }
            /*
            else{
            console.log("cell");
            console.log(cell+ingredientInTable(CodeIngredient)[1]);
            }*/
          }
        }
      }
    }
  }

  function ingredientInTable(CodeIngredient){
    for(var i=0; i<TabIngredients.length; i++){
      console.log('TabIngredients');
      console.log(TabIngredients[i]);
      console.log(i);
      if(CodeIngredient==TabIngredients[i]){
        return true;
      }
    }
    return false;
  }



  function DeleteRowFiches(o) {
    // supprimer dans le tableau
    var index = TabFiches.indexOf(o.parentNode.id); // trouver l'index de l'id à supprimer dans la TabFiches
    var rem = TabFiches.splice(index,1); // supprimer un element qui se trouve à la position index
    console.log("TabFiche après supprime " + TabFiches);
    // supprimer la ligne
    var p=o.parentNode.parentNode;
    p.parentNode.removeChild(p);
    document.cookie = 'TabFiches=' + JSON.stringify(TabFiches) + '; path=/'; // cookie renvoyé avec le tableau mis à jour
  }

    /* Elle prend la table de la création des fiches techniques :
  - elle rajoute une ligne à la fin du tableau
  - si l'input n'existe pas dans la datalist de la barre de recherche, le rajout de la ligne n'est pas accepté */
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

  tabProgressionsPushed = [];

  function associerProgressions(){
    options = document.querySelectorAll('#listeDesProgressions .nomProgression'); //les noms des progressions dans la BD
    optionsNum = document.querySelectorAll('#listeDesProgressions .NumProgression'); //les Num des progressions dans la BD
    ContenirFiche = document.querySelectorAll('#listeDesProgressionsA .NumeroFicheA');
    ContenirEtape = document.querySelectorAll('#listeDesProgressionsA .NumEtapeA');
    console.log('ContenirFiche');
    console.log(ContenirFiche);
    if(TabFiches.length>tabProgressionsPushed.length){
      if(tabingredientsPushed.length==0){
        indexFiche = 0;
      }
      else{
        indexFiche = TabFiches.length - tabingredientsPushed.length;
      }
      console.log('ContenirFiche.length');
      console.log(ContenirFiche.length);
      for(var i=0; i<ContenirFiche.length; i++){
        console.log('dzezfzfefezezfffzf');
        if(TabFiches[indexFiche]==ContenirFiche[i].value){
          console.log('dzezfzfefezezfffzf');
          for(var y=0; y<ContenirEtape.length; y++){
            if(ContenirEtape[i].value==optionsNum[y].value){
              console.log('hgyuuygugugujbkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkgyuy');
              description = options[y].value;
              ordreProgressions = ordreProgressions + 1;
              if(!ProgressionInTable(ContenirEtape[i].value)){
                var table = document.getElementById("bodyProgressions");
                var row = table.insertRow(table.length);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                cell1.innerHTML = ordreProgressions;
                cell2.innerHTML = description;
                cell3.innerHTML = '<button class="btn btn-danger" type="button" onclick="DeleteRowProgressions(this)"><i class="bi bi-trash" style="font-size: 1rem;" ></i></button>';
                cell3.id = ContenirEtape[i].value;
              }
            }
          }
        }
      }
  }

  function ProgressionInTable(CodeProgression){
    for(var i=0; i<TabProgressions.length; i++){
      if(CodeProgression==TabProgressions[i]){
        return true;
      }
    }
    return false;
  }

  function DeleteRowProgressions(o) {
    // supprimer dans le tableau
    var index = TabProgressions.indexOf(o.parentNode.id); // trouver l'index de l'id à supprimer dans la TabFiches
    var rem = TabProgressions.splice(index,1); // supprimer un element qui se trouve à la position index
    console.log("TABétape après supprime " + TabProgressions);
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
        //var CodeProgression = optionsNum[i].value;
    }
    i = i + 1;
    }
    if(progressiontrouver == false){
      ordreProgressions = ordreProgressions + 1; //ordre + 1
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
}

