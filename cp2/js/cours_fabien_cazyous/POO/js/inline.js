let myAddition = {
    valeur01 : 5,
    valeur02 : 10,
    Calcul : function() {
        return this.valeur01 + this.valeur02;
    }
}
alert(myAddition.Calcul());
document.write(myAddition.Calcul());