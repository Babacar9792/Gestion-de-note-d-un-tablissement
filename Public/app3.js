
const mettreAjour  = document.querySelector("#mettreAjour");
const ressource =  document.querySelectorAll('input[data-type = "ressource"]');
const examen =  document.querySelectorAll('input[data-type = "examen"]');
console.log(ressource);
console.log(ressource);

mettreAjour.addEventListener("click",()=>
{
    let diogs = document.querySelectorAll(".diogs");
    let tab = [];
    console.log(diogs);
    diogs.forEach(element => {
        let objet  = {
            id : element.value, 
            examen : document.querySelector(`#examen_${element.value}`).value,
            ressource : document.querySelector(`#ressource_${element.value}`).value
        } 
        // let exam = document.querySelector(`#examen_${element.value}`).value
        tab.push(objet);

        
    });
    console.log(tab);
    fetch('http://localhost:8000/Coefficient/update/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(tab)
        // body: JSON.stringify(tab)
    })
    // .then((data)=>{
    //     fetch("/fichier.json")
        .then(response=> response.json)
        .then(data=>
            {
                console.log(data);
            })
    //})
   

})