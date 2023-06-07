// alert("erty");
const prenom = document.querySelector("#prenom");
const nom = document.querySelector("#nom");
const numero = document.querySelector("#numero");
const messError1 = document.querySelector("#messError1");
const dateNaissance = document.querySelector("#dateNaissance");
// let radio = document.querySelectorAll(".radio");
const radio = document.querySelectorAll(".radio");
const inscription = document.querySelector("#inscription");
const lieuNaissance = document.querySelector("#lieuNaissance");
const niveau = document.querySelector("#niveau");
const classe = document.querySelector("#ClasseNew");
const inputHidden = document.querySelector("#inputHidden");
const typeEleve = document.querySelector("#typeEleve");

//----------------------------------------------------------------------------------const


//-----------------------------------------------------------------------------------------------------------------------------------------
// let checkRadio = "masculin";
console.log(radio);
inscription.addEventListener("click", (e) => {
    let sexe = "";
    radio.forEach(rad => {
        if (rad.checked) {
            sexe = rad.value;
        }

    });
    // e.preventDefault();
    let objet = {
        prenom: prenom.value,
        nom: nom.value,
        dateNaissance: dateNaissance.value,
        lieuNaissance: lieuNaissance.value,
        numero: numero.value,
        niveau: niveau.value,
        sexe: sexe,
        typeEleve: typeEleve.value
    }
    console.log(objet);
})
verifaction();
prenom.addEventListener("input", () => {
    notNumber(prenom.value, prenom);
})




nom.addEventListener("input", () => {
    notNumber(nom.value, nom);
    // messageErreur("date incorrecte",messError1);
})
numero.addEventListener("input", () => {
    notletter(numero.value, numero);

})
dateNaissance.addEventListener("change", () => {
    if (validerDate(dateNaissance.value)) {
        // alert("good");
    }
    else {
        verifaction();
        messageErreur("date de naissance incorrecte", messError1);
    }
});



prenom.addEventListener("change", () => {
    verifaction();
})


nom.addEventListener("change", () => {
    verifaction();
});

dateNaissance.addEventListener("change", () => {
    verifaction();
});

radio.forEach(element => {

    if (element.checked == "true") {
        element.checked = "false";
    }

    element.addEventListener("click", () => {
        element.checked = "true";
    })

});

// Fonction pour empêcher à l'utilisatuer de saisir des chiffres ou des caractères spéciaux
function notNumber(text, input) {
    let regular = /[^a-z ]$/i;
    let value = text.replace(regular, "");
    input.value = value;
}


// Fonction pour empêcher la saisie de lettre dans un input
function notletter(text, input) {
    let regular = /[^0-9]$/g;
    let value = text.replace(regular, "");
    input.value = value;
}

function messageErreur(message, endroit) {
    endroit.innerText = message;
    endroit.style.display = "block";


    setTimeout(() => {
        endroit.style.display = "none";
    }, 2000);
}

function validerDate(date) {
    var pattern = /^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-([0-9]{4})$/;
    return pattern.test(date);
}

function delAllChecked(tab) {

    tab.forEach(element => {
        if (element.checked) {

            element.checked = false;
        }

    });

}



function recupererDonnees() {
    var formulaire = document.getElementById("monFormulaire");
    var donnees = new FormData(formulaire);

    // Parcours des données du formulaire
    for (var pair of donnees.entries()) {
        console.log(pair[0] + ": " + pair[1]);
    }
}




messError1.style.position = "absolute";
messError1.style.top = "42%";
messError1.style.left = "35%";
messError1.style.color = "red";
messError1.style.fontSize = "1.1rem";
messError1.style.display = "none";


function verifaction() {
    let error = 0;
    if (prenom.value === "") { error++; }
    if (nom.value === "") { error++; }
    if (dateNaissance.value === "") { error++; }
    if (!validerDate(dateNaissance.value)) { error++; }
    if (error != 0) {
        inscription.setAttribute("disabled", true);
        inscription.style.backgroundColor = "grey";
    }
    else {
        inscription.removeAttribute("disabled");
        inscription.style.backgroundColor = "green";

    }
    // return error;

}


niveau.addEventListener("change", () => {
    let objet = {
        niveau: niveau.value
    };
    fetch('http://localhost:8000/Inscription/getClasse', {
        method: 'POST',
        body: JSON.stringify(objet),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then((data) => {
        console.log(data);
        fetch("/fichier.json")
        .then(response => response.json())
        .then(data =>  {
                    classe.innerHTML = '';
                    data.forEach(element => {
                        var option = document.createElement("option");
                        option.value = element.id_classe;
                        option.text = element.libelle_classe;
                        classe.appendChild(option);
                    })
                })
                .catch( error => {
                    console.error("error pas de classe", error);
               }) // Affiche les données récupérées dans la console
        // Faites ce que vous souhaitez avec les données, par exemple :
        // Mettez à jour l'affichage des classes sur votre page HTML
    });
  

});
