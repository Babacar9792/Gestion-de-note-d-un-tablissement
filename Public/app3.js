
const mettreAjour = document.querySelector("#mettreAjour");
const ressource = document.querySelectorAll('input[data-type = "ressource"]');
const examen = document.querySelectorAll('input[data-type = "examen"]');
const CurrentClasse = document.querySelector("#CurrentClasse");
const input = document.querySelectorAll(".input")
console.log(input); 
    input.forEach(d => {
        d.addEventListener("change",()=>
        {
            d.classList.add("changed");
            
        })
    });
    input.forEach(d => {
        d.addEventListener("input",()=>
        {
            notletter(d.value, d);
            if( d.value<=0 )
            {
                mettreAjour.setAttribute("disabled", "true");
                d.classList.add("text-danger");
            }
            else 
            {
                d.classList.add("text-success");
                mettreAjour.removeAttribute("disabled");
            }
        })
    });
    function notletter(text, input) {
        let regular = /[^0-9]$/g;
        let value = text.replace(regular, "");
        input.value = value;
    }
    
    // numero.addEventListener("input", () => {
    //     notletter(numero.value, numero);
    
    // })
    mettreAjour.addEventListener("click",()=>
    {
        let donnee = document.querySelectorAll(".changed");
        let tab = [];
        donnee.forEach(d => {
            const tableau = d.getAttribute("id").split("_");
            let objet = {
                note : d.value,
                id :tableau[1],
                colonne : tableau[0]
            }
           tab.push(objet);

        });
        let error = 0;

        tab.forEach(d => {
            if(d.colonne === "noteExamen" && d.note <10 ){ error++;}
         });
        if(error === 0)
        {
            fetch("/Coefficient/update/", {
                method : 'POST', 
                headers : {
                    'Content-Type' : 'application/json'
                },
                body : JSON.stringify(tab)
            })
        }
        else 
        {
            alert("Aucune note d'examen ne doit etre inférieur à 10")
        }
    })

// mettreAjour.addEventListener("click", async () => {
//     let diogs = document.querySelectorAll(".diogs");
//     let tab = [];
//     console.log(diogs);
//     diogs.forEach(element => {
//         let objet = {
//             id: element.value,
//             examen: document.querySelector(`#examen_${element.value}`).value,
//             ressource: document.querySelector(`#ressource_${element.value}`).value
//         }
//         // let exam = document.querySelector(`#examen_${element.value}`).value
//         tab.push(objet);


//     });
//     let faux = 0;
//     tab.forEach(element => {
//         if (element.examen < 10) {
//             faux++;
//         }
//     });
//     if (faux === 0) {

//         let matar = await fetch('http://localhost:8000/Coefficient/update/', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify(tab)
//         });
//         let response = await matar.json();
//         console.log(response);
//     }
//     else {
//         console.log("Aucune note d'examen ne doit etre inférieur à 10");
//     }

// })

// alert("esrsre");


const deleteDiscipline = document.querySelectorAll(".bi-backspace");

deleteDiscipline.forEach(element => {
    element.addEventListener("click", (e) => {
        const idDiscipline = element.getAttribute("iddiscipline");
        let objet = {
            id_discipline: idDiscipline,
            CurrentClasse: CurrentClasse.textContent
        }
        let child = e.target;
        
        // console.log("ID de la discipline à supprimer :", idDiscipline);
        fetch("/Coefficient/delete/" + idDiscipline)
        document.querySelector("tbody").removeChild(child.parentNode.parentNode)
        alert("Suppression reussie");
    });
});
