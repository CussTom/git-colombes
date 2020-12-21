/*
Une fonction javascript asynchrone peut être créée avec le mot clé async
avant le nom de la fonction ou avant les () pour les fonctions flêchées.
Une fonction async retourne toujours une Promis
*/

function helloWorld() {
    return new Promise((resolve) => {
      setTimeout(() => {
        resolve("Hello World!");
      }, 2000);
    });
  }
  
  const msg = async function () {
    //Async Function Expression
    const msg = await helloWorld();
    console.log("Message:", msg);
  };
  
  const msg1 = async () => {
    //Async Arrow Function
    const msg = await helloWorld();
    console.log("Message:", msg);
  };
  
  msg(); // Message: Hello World! <-- after 2 seconds
  msg1(); // Message: Hello World! <-- after 2 seconds
  
  /*
  Résoudre des Promises:
  En utilisant async...await plusieurs aopérations async peuvent s'exécuter
  en "parallèle". Si la valeur résolue est requise pour chaque Promise initiée
  Promise.all() peut être utilisé pour les combiner, cela permet d'éviter les
  blocages non nécessaires.
  */
  
  let promise1 = Promise.resolve(5);
  let promise2 = 44;
  let promise3 = new Promise(function (resolve, reject) {
    setTimeout(resolve, 100, "foo");
  });
  
  Promise.all([promise1, promise2, promise3]).then(function (values) {
    console.log(values);
  });
  // expected output: Array [5, 44, "foo"]
  
  /*
  La syntaxe async..await permet d'écrire du code plus lisible et scalable
  pour manipuler des Promises, sous le capot, async await utilise du js
  classique avec les Promises
  
  
  Construire une ou plusieurs promesses ou appels sans await
  peut permettre l'exécution simultanée de plusieurs fonctions async.
  Grâce à cette approche, un programme peut tirer parti de la concurrence,
  et des actions asynchrones peuvent être lancées au sein d'une fonction
  async. Puisque l'utilisation du mot-clé await met en pause l'exécution
  d'une fonction asynchrone, chaque fonction asynchrone peut être attendue (await)
  une fois que sa valeur est requise par la logique du programme.
  
  La syntaxe JavaScript async...await permet d'initier plusieurs promesses
  puis de les résoudre pour des valeurs lorsque cela est nécessaire pendant
  l'exécution du programme. En tant qu'alternative au chaînage
  des fonctions .then(), elle offre une meilleure maintenabilité du
  code et une ressemblance étroite avec le code synchrone.
  */
  
  /*
  Gestion d'erreur:
  Les fonctions asynchrones de JavaScript utilisent des instructions
  try...catch pour le traitement des erreurs. Cette méthode permet de
  partager la gestion des erreurs pour le code synchrone et asynchrone.
  */
  
  // Pour rapelle:
  let json = '{ "age": 30 }'; // incomplete data
  
  try {
    let user = JSON.parse(json); // <-- no errors
    alert(user.name); // no name!
  } catch (e) {
    alert("Invalid JSON data!");
  }
  
  /*
  La syntaxe JavaScript async...await dans l'ES6 offre une nouvelle
  façon d'écrire du code plus lisible et plus scablable pour gérer les
  promesses. Une fonction JavaScript async peut contenir des expressions
  précédées d'un opérateur await. L'opérande de await est une promesse.
  Lors d'une expression await, l'exécution de la fonction async est mise
  en pause et attend la résolution de la Promise. L'opérateur
  await renvoie la valeur résolue de la promesse.
  L'opérateur await ne peut être utilisé qu'à l'intérieur d'une
  fonction asynchrone.
  
  */
  
  
  function helloWorld() {
      return new Promise((resolve) => {
        setTimeout(() => {
          resolve("Hello World!");
        }, 2000);
      });
    }
    
    async function msg() {
        
      const msg = await helloWorld();
      console.log("Message:", msg);
    }
    
    msg(); // Message: Hello World! <-- after 2 seconds
    