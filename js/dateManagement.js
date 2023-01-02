const bouttonMoins = document.getElementById('boutton-moins');
const bouttonPlus = document.getElementById('boutton-plus');
const dateFacture = document.getElementById('date-facture');
const factureTtc = document.getElementById('facture-ttc');
const factureTtcBig = document.getElementById('facture-ttc-big');
const facturePrelevement = document.getElementById('facture-prelevement');
const factureTva = document.getElementById('facture-tva');
const factureElectricite = document.getElementById('facture-electricite');
const factureGaz = document.getElementById('facture-gaz');

var currentDate = new Date();
var currentDateString = currentDate.toLocaleDateString();

var prelevementDate = new Date();
var lol = prelevementDate.setMonth(prelevementDate.getMonth()+1);
var oui = prelevementDate.setDate(4);

dateFacture.innerHTML = 'Facture du ' + currentDateString;
facturePrelevement.innerHTML = 'Prélevé le ' + prelevementDate.toLocaleDateString();;
let actualPrice = 527.20;
let tva = 0;
let electricite = 0;
let gaz = 0;

const coefficientElectricite = 0.55;
const coefficientGaz = 0.25;
const coefficient = 0.2;

bouttonPlus.addEventListener("click", function() {
    currentDate.setMonth(currentDate.getMonth() + 3);
    var dateString = currentDate.toLocaleDateString();
    prelevementDate.setMonth(currentDate.getMonth() + 1);
    prelevementDate.setDate(4);
    dateFacture.innerHTML = 'Facture du ' + dateString; 
    actualPrice =  actualPrice * 1.04;
    gaz = actualPrice * coefficientGaz; 
    electricite = actualPrice * coefficientElectricite; 
    tva = actualPrice * coefficient;
    factureGaz.innerHTML = gaz.toFixed(2) + '€';
    factureElectricite.innerHTML = electricite.toFixed(2) + '€';
    factureTva.innerHTML = tva.toFixed(2) + '€';
    factureTtc.innerHTML =   actualPrice.toFixed(2) + '€';
    factureTtcBig.innerHTML = actualPrice.toFixed(2) + '€';
    facturePrelevement.innerHTML = 'Prélevé le '+ prelevementDate.toLocaleDateString();

    factureTtcBig.classList.add("lol");
    setTimeout(() => {
      factureTtcBig.classList.remove("lol");
    }, 550);

});

bouttonMoins.addEventListener("click", function() {
  currentDate.setMonth(currentDate.getMonth() - 3);
  var dateString = currentDate.toLocaleDateString();
  prelevementDate.setMonth(currentDate.getMonth() - 1);
  prelevementDate.setDate(4);
  dateFacture.innerHTML = 'Facture du ' + dateString; 
  actualPrice =  actualPrice * 0.96;
  gaz = actualPrice * coefficientGaz; 
  electricite = actualPrice * coefficientElectricite; 
  tva = actualPrice * coefficient;
  factureGaz.innerHTML = gaz.toFixed(2) + '€';
  factureElectricite.innerHTML = electricite.toFixed(2) + '€';
  factureTtc.innerHTML = actualPrice.toFixed(2)+ '€';
  factureTtcBig.innerHTML = actualPrice.toFixed(2) + '€';
  factureTva.innerHTML = tva.toFixed(2) + ' €';
  facturePrelevement.innerHTML = 'Prélevé le '+ prelevementDate.toLocaleDateString();

  factureTtcBig.classList.add("mdr");
  setTimeout(() => {
    factureTtcBig.classList.remove("mdr");
  }, 550);


});
