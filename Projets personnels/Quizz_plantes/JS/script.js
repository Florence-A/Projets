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

var timOp1 = ["../images/cigue.jpg",    "../images/colchiqueDA.jpg"];
var timOp2 = ["../images/plantain.jpg", "../images/fougere.jpg"];
var timOp3 = ["../images/belladone.jpg","../images/arum.png"];
var timOp4 = ["../images/muguet.jpg",   "../images/ailOurs.jpg"];


var imOp1 = document.getElementById("imOp1");
var imOp2 = document.getElementById("imOp2");
var imOp3 = document.getElementById("imOp3");
var imOp4 = document.getElementById("imOp4");


var start = true;


function iterate(id) {

    
    var result = document.getElementsByClassName("result");
    result[0].innerText="";
    var comment = document.getElementsByClassName("comment");
    comment[0].innertext=""

    const question = document.getElementById("questionid");

    const op1 = document.getElementById("op1");
    const op2 = document.getElementById("op2");
    const op3 = document.getElementById("op3");
    const op4 = document.getElementById("op4");


    

    // AFFICHAGE
    question.innerText = questions[id].q;


    op1.innerText = questions[id].a[0].text;
    op2.innerText = questions[id].a[1].text;
    op3.innerText = questions[id].a[2].text;
    op4.innerText = questions[id].a[3].text;


    op1.value = questions[id].a[0].isCorrect;
    op2.value = questions[id].a[1].isCorrect;
    op3.value = questions[id].a[2].isCorrect;
    op4.value = questions[id].a[3].isCorrect;


    // BOUTON SELECTIONNE

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


    const validation = document.getElementsByClassName("validation");

    // RESULTAT

    validation[0].addEventListener("click",()=>{
        if (selected=="true"){
            result[0].innerHTML="Bravo ! C'est Mamie qui va être contente."
            result[0].style.color="green";
            
        } else {
            result[0].innerHTML="<small>Mamie risque de ne pas s'en remettre...</small>"
            result[0].style.color="red";
        }
    })
    

} 

// SLIDER
function slider(id) {
    imOp1.setAttribute("src",timOp1[id]);
    imOp2.setAttribute("src",timOp2[id]); 
    imOp3.setAttribute("src",timOp3[id]); 
    imOp4.setAttribute("src",timOp4[id]); 
}

// DEMARREUR
if(start) {
    iterate(0)
}


const suivant=document.getElementsByClassName("suivant")[0];
var id=0;


// SUIVANT
suivant.addEventListener("click",()=>{
    start=false;
    if(id<2){
        id++;
        iterate(id);
        slider(id);
        console.log(id);
    }
})