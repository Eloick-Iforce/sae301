
function displayDate() {
    var currentDate = new Date();
    var dateString = currentDate.toLocaleDateString();
    document.write(dateString);
}
function preleve() {
    var currentDate = new Date();
    currentDate.setMonth(currentDate.getMonth() - 1);
    currentDate.setDate(currentDate.getDate() - 10);
    var dateString = currentDate.toLocaleDateString();
    document.write(dateString);
}

var prix = 290.45;
var taux = 0.2;
var prixGaz = 148.89;
var prixtot = prix + prixGaz;
var TVA = prixtot * taux;
TVA = Math.round(TVA * 100) / 100;

var prixTTC = prixtot * (1 + taux);
prixTTC = Math.round(prixTTC * 100) / 100;

