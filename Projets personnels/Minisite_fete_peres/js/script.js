$(document).ready(function(){

    $(document).click(function(){ party.confetti(); })

    var arrayText = 
    [
        "C'est un fait, avoir des enfants n'est pas toujours un long fleuve tranquille...",
        "...et pourtant, malgré nos taquineries, tu as su nous supporter tout ce temps...",
        "...enfin... tu es toi même un sacré taquin, on entend souvent l'histoire des jouets en haut de l'armoire",
        "Ca ne t'auras pas empêché d'être un super papa",
        "Tu nous as concocté, des heures durant, de bons petits plats, engloutis en moins de deux",
        "Tu nous as initié à deux trois trucs comme : le café",
        "Le language canin",
        "La nature",
        "La cuisine",
        "Tu nous as bercés de tes douces symphonies",
        "Tu nous as conduits aux 4 coins de la France",
        "Tu nous fabrique des tas de trucs",
        "On passe de bons moments en ta compagnie",
        "On va devoir l'avouer, on est tout de même assez complices maintenant"
    ];

    var arrayImages = 
    [
        "../images/hotel_kids2.gif",
        "../images/merlin_archimede_mdr.gif",
        "../images/rdb_prince_jean.webp",
        "../images/mmm_orga.gif",
        "../images/monthy_chef.gif",
        "../images/merlin_listen.gif",
        "../images/merlin_loup_miam.webp",
        "../images/rr_pioupiou.gif",
        "../images/muppets_cook.gif",
        "../images/mickey_piano.gif",
        "../images/dingo_drive.gif",
        "../images/stitch_build.gif",
        "../images/mmm_manege.gif",
        "../images/kuzco_complices.gif"
    ];

    

    $(".right").click(function() { 
        if (i<(arrayText.length-1)){
            i++;
            $(".text").text(arrayText[i]);
            $("#gif").attr("src", arrayImages[i]);    
        }
        else {
            
            //ajouter un truc qui pop ac des confettis
        }

    });    



    $(".left").click(function() { 
        if (i>0){
            i--;
            $(".text").text(arrayText[i]);
            $("#gif").attr("src", arrayImages[i]);    
        }
        
    }); 
    

});
