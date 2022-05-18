// On définit les questions et leur réponses dans des objets, eux mêmes rangés dans un tableau. Ici ce ne sont que des déclarations
// de variables, rien n'est encore affiché nulle part. On construit les questions en leur assignant un id et des options de réponses
// lesquelles sont des objets contenant un texte (la proposition) et une valeur isCorrect (si elles sont vraies ou fausses).

const questions = [
    {
        id: 0 ,
        q : "Laquelle de ces plantes est comestible ?" ,
        a : [
            { text : "La cigüe" , isCorrect : false },
            { text : "Le plantain", isCorrect : true },
            { text : "La belladone", isCorrect : false },
            { text : "Le muguet", isCorrect : false }
        ]
    },
    { 
        id: 1,
        q: "Laquelle de ces plantes est comestible (à dose raisonnable) ?",
        a: [
            { text: "La colchique d'automne", isCorrect: false, isSelected: false },
            { text: "La fougère", isCorrect: false },
            { text: "L'arum tacheté", isCorrect: false },
            { text: "L'ail des ours", isCorrect: true }
        ]
  
    }
];
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////AJOUT DES IMAGES/////////////////////////////////////////////////////////////////////////////////////////////////
var timOp1 = ["../images/cigue.jpg","../images/colchiqueDA.jpg"];
var timOp2 = ["../images/plantain.jpg","../images/fougere.jpg"];
var timOp3 = ["../images/belladone.jpg","../images/arum.png"];
var timOp4 = ["../images/muguet.jpg","../images/ailOurs.jpg"];
  //PERSO Rajout d'images
var imOp1 = document.getElementById("imOp1");
var imOp2 = document.getElementById("imOp2");
var imOp3 = document.getElementById("imOp3");
var imOp4 = document.getElementById("imOp4");
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Une fois les questions réponses déclarées, on va déclarer une variable qui servira à lancer le quizz

var start = true;

// Puis on construit une fonction

function iterate(id) {

    //On récupère le matos depuis le doc HTML (??)
    var result = document.getElementsByClassName("result");
    result[0].innerText="";
    var comment = document.getElementsByClassName("comment");
    comment[0].innertext=""

    const question = document.getElementById("questionid");

    const op1 = document.getElementById("op1");
    const op2 = document.getElementById("op2");
    const op3 = document.getElementById("op3");
    const op4 = document.getElementById("op4");


    

    //On définit le texte de la question
    question.innerText = questions[id].q;

    //On définit le texte des options en fonction de la valeur text renseignée dans les objets a (answer)
    op1.innerText = questions[id].a[0].text;
    op2.innerText = questions[id].a[1].text;
    op3.innerText = questions[id].a[2].text;
    op4.innerText = questions[id].a[3].text;

    //On définit les valeurs des objets "options" en fonction de la valeur isCorrect de l'objet a (answer)
    op1.value = questions[id].a[0].isCorrect;
    op2.value = questions[id].a[1].isCorrect;
    op3.value = questions[id].a[2].isCorrect;
    op4.value = questions[id].a[3].isCorrect;


    // On déclare une var selected vide qui se remplira au clic sur un des boutons options en même temps qu'il fera changer le bouton de couleur

    var selected = "";

    op1.addEventListener("click",()=>{
        op1.style.backgroundColor = "yellow";
        op2.style.backgroundColor = "lightgreen";
        op3.style.backgroundColor = "lightgreen";
        op4.style.backgroundColor = "lightgreen";
        selected = op1.value;
    })
    op2.addEventListener("click",()=>{
        op1.style.backgroundColor = "lightgreen";
        op2.style.backgroundColor = "yellow";
        op3.style.backgroundColor = "lightgreen";
        op4.style.backgroundColor = "lightgreen";
        selected = op2.value;
    })
    op3.addEventListener("click",()=>{
        op1.style.backgroundColor = "lightgreen";
        op2.style.backgroundColor = "lightgreen";
        op3.style.backgroundColor = "yellow";
        op4.style.backgroundColor = "lightgreen";
        selected = op3.value;
    })
    op4.addEventListener("click",()=>{
        op1.style.backgroundColor = "lightgreen";
        op2.style.backgroundColor = "lightgreen";
        op3.style.backgroundColor = "lightgreen";
        op4.style.backgroundColor = "yellow";
        selected = op4.value;
    })

    // On récupère le bouton "validation" dans la variable

    const validation = document.getElementsByClassName("validation");

    // On définit ce qui va s'afficher dans result la div au dessus de la question (c'est là qu'on peut ajouter un score)

    validation[0].addEventListener("click",()=>{
        if (selected=="true"){
            result[0].innerHTML="Bravo !"
            result[0].style.color="green";
            comment[0].innerHTML= "C'est Mamie qui va être contente."
            
        } else {
            result[0].innerHTML="<small>Mamie risque de ne pas s'en remettre...</small>"
            result[0].style.color="red";
        }
    })
    

} // La fonction iterate se termine ici

// On définit une fonction slider pour jouer sur l'attribut source des images en fonction de l'id
function slider(id) {
    imOp1.setAttribute("src",timOp1[id]);
    imOp2.setAttribute("src",timOp2[id]); 
    imOp3.setAttribute("src",timOp3[id]); 
    imOp4.setAttribute("src",timOp4[id]); 
}

// On lance le quizz grâce à notre variable start et notre fonction iterate ac l'argument 0
if(start) {
    iterate(0)
}

// On récupère le bouton suivant

const suivant=document.getElementsByClassName("suivant")[0];
var id=0;


// Au clic sur suivant, on demande d'annuler le start et de passer à la question suivante tant que l'id est inf à 2 (sil y a trois questions) ou 1 si deux
suivant.addEventListener("click",()=>{
    start=false;
    if(id<2){
        id++;
        iterate(id);
        slider(id);
        console.log(id);
    }
})