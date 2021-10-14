function imprimer() {    
    var imprimer = document.getElementById('imprimer');
    var popupcontenu = window.open('', '_blank');
    popupcontenu.document.open();
    popupcontenu.document.write('<html><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"><body onload="window.print()"> ' + imprimer.innerHTML + '</html>');
    popupcontenu.document.close();
  }