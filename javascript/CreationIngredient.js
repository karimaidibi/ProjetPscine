function SupprimerAllergene(){
    document.getElementById("AllergeneDiv").style.display="none";
    var all =  document.getElementById("FK_NumAllergene_id").getElementsByTagName('option')[0];
    all.selected = 'selected';
}

function AfficherAllergene(){
    document.getElementById("AllergeneDiv").style.display="";
}
