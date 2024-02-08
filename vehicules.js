//Affichage du filtre au click sur le bouton
const filtreBtn = document.getElementById('filtreBtn')
const filtreForm = document.getElementById('filtreForm')
const formulaire = document.getElementById('formulaire')
//Variable pour afficher une croix ou le mot "filtre" selon le status du bouton
let isToggled = false
//Fonction d'affichage a l'appek de l'evenement
filtreBtn.addEventListener('click', () => {
    filtreForm.classList.toggle('active')
    if(isToggled == false) {
        filtreBtn.innerHTML = "&#x2715;"
        isToggled = true
        console.log(isToggled)
    } else if(isToggled == true) {
        filtreBtn.innerHTML = "Filtre"
        isToggled = false
        console.log(isToggled)
    }
})

//Récupération et affichage des valeurs du filtre
//Récupération de la valeur des champs
const kmMin = document.getElementById('km_min')
const kmMax = document.getElementById('km_max')
const anneeMin = document.getElementById('anneeMES_min')
const anneeMax = document.getElementById('anneeMES_max')
const prixMin = document.getElementById('prix_min')
const prixMax = document.getElementById('prix_max')

//Récupération des zones de text pour afficher la valeur
const kmMinText = document.getElementById('kmMin_text')
const kmMaxText = document.getElementById('kmMax_text')
const anneeMinText = document.getElementById('anneeMin_text')
const anneeMaxText = document.getElementById('anneeMax_text')
const prixMinText = document.getElementById('prixMin_text')
const prixMaxText = document.getElementById('prixMax_text')

//Affectation de la valeur des champs a des variables
let kmMinValue = kmMin.value
let kmMaxValue = kmMax.value
let anneeMinValue = anneeMin.value
let anneeMaxValue = anneeMax.value
let prixMinValue = prixMin.value
let prixMaxValue = prixMax.value

//Ecouteurs d'evenements pour les chaps du formulaire

//kilometrage
kmMin.onchange = () => {
    kmMinValue = kmMin.value
    if(Number(kmMinValue) > Number(kmMaxValue)) {
        alert("Le kilométrage minimum est supérieur au kilométrage maximum")
    } else {
        kmMinText.innerHTML = kmMinValue
    }
}
kmMax.onchange = () => {
    kmMaxValue = kmMax.value
    if(Number(kmMinValue) > Number(kmMaxValue)) {
        alert("Le kilométrage minimum est supérieur au kilométrage maximum")
    } else {
        kmMaxText.innerHTML = kmMaxValue
    }
}

//annee de mise en circulation
anneeMin.onchange = () => {
    anneeMinValue = anneeMin.value
    if(Number(anneeMinValue) > Number(anneeMaxValue)) {
        alert("L'année de mise en circulation minimum est supérieure au kilométrage maximum")
    } else {
    anneeMinText.innerHTML = anneeMinValue
    }
}
anneeMax.onchange = () => {
    anneeMaxValue = anneeMax.value
    if(Number(anneeMinValue) > Number(anneeMaxValue)) {
        alert("L'année de mise en circulation minimum est supérieure au kilométrage maximum")
    } else {
    anneeMaxText.innerHTML = anneeMaxValue
    }
}

//prix
prixMin.onchange = () => {
    prixMinValue = prixMin.value
    if(Number(prixMinValue) > Number(prixMaxValue)) {
        alert("Le prix minimum est supérieur au kilométrage maximum")
    } else {
    prixMinText.innerHTML = prixMinValue
    }
}
prixMax.onchange = () => {
    prixMaxValue = prixMax.value
    if(Number(prixMinValue) > Number(prixMaxValue)) {
        alert("Le prix minimum est supérieur au kilométrage maximum")
    } else {
    prixMaxText.innerHTML = prixMaxValue
    }
}

//Requette AJAX pour filtrer sans rechargement de page
let formData = new FormData()

formulaire.addEventListener('submit', (event) => {
    event.preventDefault()
    formData.append("km_min", parseInt(kmMinValue))
    formData.append("km_max", parseInt(kmMaxValue))
    formData.append("annee_min", parseInt(anneeMinValue))
    formData.append("annee_max", parseInt(anneeMaxValue))
    formData.append("prix_min", parseInt(prixMinValue))
    formData.append("prix_max", parseInt(prixMaxValue))
    fetch('./Back/BDDfiltre.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(response => console.log(response))
    .catch(error => 'Erreur: ' + error)
})


