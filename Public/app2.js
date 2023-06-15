const Disciplineniveau = document.querySelector("#Disciplineniveau");
const ClasseNew = document.querySelector("#ClasseNew");
const disciplinecheck = document.querySelector(".disciplinecheck");
const inputModale = document.querySelector("#inputModale");
const modal = document.querySelector("#addModal");
const modal2 = document.querySelector(".modal2");
const GDiscipline = document.querySelector("#GDiscipline");
const submitNewDisciplineGroupe = document.querySelector("#submitNewDisciplineGroupe");
const newDisciplineGroup = document.querySelector("#newDisciplineGroup");
const newdiscipline = document.querySelector("#newdiscipline");
const buttonOk = document.querySelector("#buttonOk");
const inscription = document.querySelector("#inscription");
const nomClasse = document.querySelector(".nomClasse");
const messageError = document.querySelector("#messError");
buttonOk.setAttribute("disabled", true);

Disciplineniveau.addEventListener("change", () => {
    if (Disciplineniveau.value === "choisir") {
        console.log("veuiller choisir un niveau");
        ClasseNew.innerHTML = '';
    }
    else {


        console.log(Disciplineniveau.value);
        let objet = {
            Disciplineniveau: Disciplineniveau.value
        };
        // console.log(objet);
        fetch('/Discipline/getClasse/', {
            method: 'POST',
            body: JSON.stringify(objet),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then((data) => {
                // console.log(data.status)
                // fetch("/fichier.json")
                //     .then(response => response.json())
                    // .then(data => {
                        ClasseNew.innerHTML = '';
                        ClasseNew.innerHTML  = ` <option value="">Choisir une classe</option>
                        `;
                        data.forEach(element => {
                            var option = document.createElement("option");
                            option.setAttribute("class", "inputClasse")
                            option.value = element.id_classe;
                            option.text = element.libelle_classe;
                            ClasseNew.appendChild(option);
                        })
                    // })
                    .catch(error => {
                        console.error("error pas de classe", error);
                    })
            })

    }
})


ClasseNew.addEventListener("change", () => {
    disciplinecheck.innerHTML = '';
    let objet = {
        classe: ClasseNew.value
    };

    console.log(ClasseNew.textContent);
    let tableau = document.querySelectorAll(".inputClasse");
    // console.log(tableau);
    // console.log(getclasse(tableau, ClasseNew.value));
    nomClasse.removeAttribute("href");
    nomClasse.setAttribute("href", "/coefficient/coefficient/"+ClasseNew.value);

    nomClasse.textContent = getclasse(tableau, ClasseNew.value);
    // console.log(objet);
    fetch('http://localhost:8000/Discipline/getdisciplineClasse/', {
        method: 'POST',
        body: JSON.stringify(objet),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then((data) => {
            // console.log(data.status)
            fetch("/fichier.json")
                .then(response => response.json())
                .then(data => {
                    disciplinecheck.innerHTML = '';
                    console.log(data.length);
                    if(data.length === 0)
                    {
                        if(messageError.classList.contains("d-none"))
                        {
                            messageError.classList.remove("d-none");
                        }

                        messageError.innerText = "Il n'y a pas de discipline disponible pour cette classe";
                        messageError.classList.add("d-block");
                    }
                    else 
                    {
                        if(messageError.classList.contains("d-block"))
                        {
                            messageError.classList.remove("d-block");
                        };
                        messageError.classList.add("d-none");

                    }

                    data.forEach(element => {
                        let div = document.createElement("div");
                        div.classList.add("form-check", "form-check-inline", "d-flex", "flex-column", "align-items-center");

                        div.innerHTML = `

                        
                            <label class="form-check-label" for="inlineCheckbox1">${element.libelle_discipline}</label>
                            <input class="form-check-input input" type="checkbox" id="inlineCheckbox1" value="${element.id_discipline}">
                            <span>(${element.code_discipline})</span>
                       
                    `;
                        disciplinecheck.appendChild(div);
                    })
                    let input = document.querySelectorAll(".input");
                    input.forEach(element => {
                        element.setAttribute("checked", "true");
                    })
                    input.forEach(element => {
                        element.addEventListener("change", (e)=>
                        {
                            let child = e.target;
                            let parent = child.parentNode;
                            parent.classList.remove("text-danger");
                            if(!(element.checked))
                            {
                               
                                parent.classList.add("text-danger");

                            }
                        })
                        
                    });


                })
                .catch(error => {
                    console.error("error pas de classe", error);
                })
        })
})


GDiscipline.addEventListener("change", () => {
    if (GDiscipline.value === "nouveau") {
        console.log("le modal doit apparaitre");
        modal.style.display = "flex";
    }
    else {
        console.log("groupe de discipline choisi");
    }
})

submitNewDisciplineGroupe.addEventListener("click", () => {
    let objet = {
        discipline: newDisciplineGroup.value
    };
    // console.log(objet);
    fetch('http://localhost:8000/Discipline/addGroupeDiscipline/', {
        method: 'POST',
        body: JSON.stringify(objet),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then((data) => {
            // console.log(data.status)
            fetch("/fichier.json")
                    .then(response => response.json())
                    .then(data => {
                        GDiscipline.innerHTML = '';
                        GDiscipline.innerHTML  = `
                         <option value=""></option>
                         <option value="nouveau"> Nouveau </option>
                         `;
                        data.forEach(element => {
                            var option = document.createElement("option");
                            option.setAttribute("classeName", element.libelle_classe)
                            option.value = element.id_GroupeDiscipline;
                            option.text = element.libelle_GroupeDiscipline;
                            GDiscipline.appendChild(option);
                        })
                    })
                    .catch(error => {
                        console.error("error pas de classe", error);
                    })
        })

})

newDisciplineGroup.addEventListener("change", () => {
    if (newDisciplineGroup.value === "") {
        submitNewDisciplineGroupe.removeAttribute("data-bs-dismiss");
    }
    else {
        submitNewDisciplineGroupe.setAttribute("data-bs-dismiss", "modal")
        console.log()
    }
})

newdiscipline.addEventListener("input", () => {
    if (newdiscipline.value === "" || ClasseNew.value === "" || GDiscipline.value === "") {

        buttonOk.setAttribute("disabled", true);
        console.log(GDiscipline.value);
    }
    else {
        buttonOk.removeAttribute("disabled");
        console.log(GDiscipline.value);
    }
})


buttonOk.addEventListener("click", () => {
    let chaine = newdiscipline.value
    let tableau = chaine.split(" ");
    let code = "";
    if (tableau.length === 1) {
        code = chaine.substring(0, 3);
    }
    else {
        for (let i = 0; i < tableau.length; i++) {
            code += tableau[i][0];

        }

    }
    console.log(code);
    let objet = {
        discipline: newdiscipline.value,
        idClasse: ClasseNew.value,
        idGroupeDiscipline: Disciplineniveau.value,
        code: code
    }
    fetch('http://localhost:8000/Discipline/addDiscipline/', {
        method: 'POST',
        body: JSON.stringify(objet),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then((data) => {
            // console.log(data.status)
            fetch("/fichier.json")
                .then(response => response.json())
                .then(data => {
                    disciplinecheck.innerHTML = '';
                    messageError.classList.add("d-none");
                    if(data.length === 0)
                    {
                        messageError.textContent = "Il n'y a pas de discipline disponible pour cette classe";
                        messageError.style.display = "block";
                    }
                    else 
                    {
                        messageError.style.display = "none";
                    }
                    data.forEach(element => {
                        let div = document.createElement("div");
                        div.classList.add("form-check", "form-check-inline", "d-flex", "flex-column", "align-items-center");

                        div.innerHTML = `

                            
                                <label class="form-check-label" for="inlineCheckbox1">${element.libelle_discipline}</label>
                                <input class="form-check-input input" type="checkbox" id="inlineCheckbox1" value="${element.id_discipline}">
                                <span>(${element.code_discipline})</span>
                           
                        `;
                        disciplinecheck.appendChild(div);
                    })
                    let input = document.querySelectorAll(".input");
                    input.forEach(element => {
                        element.setAttribute("checked", "true");
                        element.addEventListener("click", () => {
                            if (!(element.checked)) {
                                element.style.color = "red";
                            }
                        })
                    })

                    input.forEach(element => {
                        element.addEventListener("change", (e)=>
                        {
                            let child = e.target;
                            let parent = child.parentNode;
                            parent.classList.remove("text-danger");
                            if(!(element.checked))
                            {
                               
                                parent.classList.add("text-danger");

                            }
                        })
                        
                    });


                })
                .catch(error => {
                    console.error("error pas de classe", error);
                })
        })
})

inscription.addEventListener("click", () => {
    let input = document.querySelectorAll(".input");
    let tab = [];
    input.forEach(element => {
        if (!(element.checked)) {
            tab.push(element.value);

        }

    });
    console.log(tab);
    if (tab.length === 0) {
        console.log("Il vous n'avez choisis aucune discipline à supprimer pour cette classe, merci")
    }
    else {
        let objet = {
            level: tab,
            id: ClasseNew.value
        }
        console.log(ClasseNew.value);
        fetch('http://localhost:8000/Discipline/delete/', {
            method: 'POST',
            body: JSON.stringify(objet),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then((data) => {
                // console.log(data.status)
                fetch("/fichier.json")
                    .then(response => response.json())
                    .then(data => {
                        disciplinecheck.innerHTML = '';


                        data.forEach(element => {
                            let div = document.createElement("div");
                            div.classList.add("form-check", "form-check-inline", "d-flex", "flex-column", "align-items-center");

                            div.innerHTML = `

                            
                                <label class="form-check-label" for="inlineCheckbox1">${element.libelle_discipline}</label>
                                <input class="form-check-input input" type="checkbox" id="inlineCheckbox1" value="${element.id_discipline}">
                                <span>(${element.code_discipline})</span>
                           
                        `;
                            disciplinecheck.appendChild(div);
                        })
                        let input = document.querySelectorAll(".input");
                        input.forEach(element => {
                            element.setAttribute("checked", "true");
                            element.addEventListener("click", () => {
                                if (!(element.checked)) {
                                    element.style.color = "red";
                                }
                            })
                        })
                        input.forEach(element => {
                            element.addEventListener("change", (e)=>
                            {
                                let child = e.target;
                                let parent = child.parentNode;
                                parent.classList.remove("text-danger");
                                if(!(element.checked))
                                {
                                   
                                    parent.classList.add("text-danger");
    
                                }
                            })
                            
                        });


                    })
                    .catch(error => {
                        console.error("error pas de classe", error);
                    })
            })

    }
})

function getclasse(tab, id)
{
    let nom = "";
    tab.forEach(element => {
        if(element.value === id)
        {
            nom = element.innerText;
        }
    });
    return nom;
}
