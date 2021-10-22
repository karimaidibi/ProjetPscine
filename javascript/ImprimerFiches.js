

function imprimer() {    
    var imprimer = document.getElementById('imprimer');
    var popupcontenu = window.open('', '_blank');
    popupcontenu.document.open();
    popupcontenu.document.write('<html><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"><body onload="window.print()"> ' + imprimer.innerHTML + '</html>');
    popupcontenu.document.close();
  }

document.addEventListener("change", function(){
  // avant
  var dateFabrication = document.getElementById('DateFabric').value;
  console.log(dateFabrication);

  var dateFabricationJAVASCRIPT = new Date(dateFabrication);
  console.log("avant changement: " + dateFabricationJAVASCRIPT);
  if(!isNaN(dateFabricationJAVASCRIPT)){
  var dayA = dateFabricationJAVASCRIPT.getDate();
  var monthA = dateFabricationJAVASCRIPT.getMonth()+1;
  console.log(monthA);
  var yearA = dateFabricationJAVASCRIPT.getFullYear();
  dateFabrication =  dayA+'/'+monthA+'/'+yearA;

  //apres
  dateFabricationJAVASCRIPT.setDate(dateFabricationJAVASCRIPT.getDate()+3);
  console.log("apres changement: " + dateFabricationJAVASCRIPT);

  var day = dateFabricationJAVASCRIPT.getDate();
  var month = dateFabricationJAVASCRIPT.getMonth()+1;
  console.log(month);
  var year = dateFabricationJAVASCRIPT.getFullYear();

  var datePeremtion = day+'/'+month+'/'+year;
  console.log(datePeremtion);


    document.getElementById('DateFabric').style.display = "none";
    document.getElementById('DateFabricCache').innerText = dateFabrication;
    document.getElementById("DatePeremption").innerText = datePeremtion;
  }
  //var lala = moment(dateFabrication);
  //var lalao = moment(lala).add(3,days);

});