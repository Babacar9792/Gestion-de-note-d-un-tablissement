// alert ("bonjour");



// console.log("https://images.unsplash.com/photo-1611608822650-925c227ef4d2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1935&q=80".length);
const discipline = document.querySelector("#discipline");
const noteChoisie = document.querySelector("#noteChoisie");
const note = document.querySelectorAll(".noteEleve");
const noteMaximale = document.querySelectorAll(".noteMaximale");
const inputNote = document.querySelectorAll(".inputNote");
const autoloader = document.querySelector(".autoloader");
const btnUpdate = document.querySelector(".btn-update");
const maximale = document.querySelector(".maximale");
inputNote.forEach(d => {
    d.addEventListener("change",()=>
    {
        d.classList.add("changed");
    })
});



inputNote.forEach(d => {
    d.addEventListener("input",()=>
    {
        if(d.value < maximale.value*0.5)
        {

            d.classList.remove("text-success");    
            d.classList.add("text-danger");
        }
        else
        {
            d.classList.remove("text-danger");
            d.classList.add("text-success");
        }
        console.log(maximale.value);
    })
});



btnUpdate.addEventListener("click", ()=>
{

    let changed = document.querySelectorAll(".changed");
    console.log(changed);
    let tab = [];
    changed.forEach(d => {
       
        console.log(d.getAttribute("form-data"));
        let objet = {
            idEleve : d.getAttribute("form-data"), 
            note : d.value, 
            type : noteChoisie.value,
            discipline : discipline.value
        }
        tab.push(objet);
    });
    console.log(tab)
    // console.log(inputNote);
    autoloader.classList.remove("d-none");
    autoloader.classList.add("d-block");
    setTimeout(() => {
        autoloader.classList.remove("d-block");
        autoloader.classList.add("d-none");
    }, 3000);
})
noteChoisie.addEventListener("change", () => {
    inputEmpty(inputNote);
    if (noteChoisie.value != "" && discipline.value != "") {
        console.log(noteChoisie.value);
        console.log(discipline.value);
        let objet = {
            id: discipline.value,
            colonne: noteChoisie.value
        }
       
        getNoteMaximale(objet);
        note.forEach(element => {
            element.classList.remove("d-none");

        });
    }
    else {
        note.forEach(element => {
            element.classList.add("d-none");

        });
    }
})

discipline.addEventListener("change", () => {
    inputEmpty(inputNote);
    if (noteChoisie.value != "" && discipline.value != "") {
        note.forEach(element => {
            element.classList.remove("d-none");
        });
        console.log(noteChoisie.value);
        console.log(discipline.value);
        let objet = {
            id: discipline.value,
            colonne: noteChoisie.value
        };
        getNoteMaximale(objet);
    }
    else {
        note.forEach(element => {
            element.classList.add("d-none");

        });
    }
})


function getNoteMaximale(objet)
{
    let choix = "";
        fetch("/Classe/getNoteDiscipline", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(objet)
        })
            .then(response => response.json())
            .then(data => {
                for (const key in data[0]) {
                    choix += key
                    console.log(key, data[0][key]);
                  }
                    console.log(choix);
                    maximale.value = data[0][choix];
                    noteMaximale.forEach(d => {
                    d.innerText = data[0][choix]

                });
                // console.log(data[0]);
            });

}


function inputEmpty(tab)
{
    tab.forEach(d => {
        d.valyue = "";
    });
}