/* Exercice:
Créer un objet qui fait sens pour vous dans un scénario imaginaire, avec Object.create()
Et un autre (autre structure) en créant d'abord un constructeur puis avec new
*/

// avec Object.create
const aVendre = {
    getProduct: function () {
        console.log(`Le livre ${this.bookName} écrit par ${this.author} au prix de ${this.price} euros`);
    },
};

const daVinci = Object.create(aVendre);
daVinci.bookName = "JS pour les nuls";
daVinci.author = "un gars";
daVinci.price = 25;
daVinci.getProduct();


// avec constructeur
function ListOfBooks(bookName, author, price){
    this.name = bookName;
    this.author = author;
    this.price = price;
    this.getProduct = () =>
    console.log (`Le livre ${this.name} écrit par ${this.author} au prix de ${this.price} euros`);
}

const myBook = new ListOfBooks("JS pour les nuls", "un gars", 25);
myBook.getProduct();