//Affichage du filtre au click sur le bouton
//Déclaration des variables
const filtreBtn = document.getElementById('filtreBtn')
const filtreForm = document.getElementById('filtreForm')
const formulaire = document.getElementById('formulaire')
const formBtn = document.getElementById('formBtn')
const carList = document.getElementById('liste-voitures')
const mainContent = document.getElementById('mainContent')
const dropFilter = document.getElementById('DropFilter')
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
        kmMinText.innerText = kmMinValue
    }
}
kmMax.onchange = () => {
    kmMaxValue = kmMax.value
    if(Number(kmMinValue) > Number(kmMaxValue)) {
        alert("Le kilométrage minimum est supérieur au kilométrage maximum")
    } else {
        kmMaxText.innerText = kmMaxValue
    }
}

//annee de mise en circulation
anneeMin.onchange = () => {
    anneeMinValue = anneeMin.value
    if(Number(anneeMinValue) > Number(anneeMaxValue)) {
        alert("L'année de mise en circulation minimum est supérieure au kilométrage maximum")
    } else {
    anneeMinText.innerText = anneeMinValue
    }
}
anneeMax.onchange = () => {
    anneeMaxValue = anneeMax.value
    if(Number(anneeMinValue) > Number(anneeMaxValue)) {
        alert("L'année de mise en circulation minimum est supérieure au kilométrage maximum")
    } else {
    anneeMaxText.innerText = anneeMaxValue
    }
}

//prix
prixMin.onchange = () => {
    prixMinValue = prixMin.value
    if(Number(prixMinValue) > Number(prixMaxValue)) {
        alert("Le prix minimum est supérieur au kilométrage maximum")
    } else {
    prixMinText.innerText = prixMinValue
    }
}
prixMax.onchange = () => {
    prixMaxValue = prixMax.value
    if(Number(prixMinValue) > Number(prixMaxValue)) {
        alert("Le prix minimum est supérieur au kilométrage maximum")
    } else {
    prixMaxText.innerText = prixMaxValue
    }
}

//Requette AJAX pour filtrer sans rechargement de page
let formData = new FormData()

//Déclarations des variables correspondants aux elements créer apres le filtre
let divPrincipale = document.createElement('div')
let div = document.createElement('div')
let img = document.createElement('img')
let h3 = document.createElement('h3')
let pAnnee = document.createElement('p')
let pKm = document.createElement('p')
let hr = document.createElement('hr')
let pPrix = document.createElement('p')
let a = document.createElement('a')

formulaire.addEventListener('submit', (event) => {
    event.preventDefault()
    formData.append("km_min", parseInt(kmMinValue))
    formData.append("km_max", parseInt(kmMaxValue))
    formData.append("annee_min", parseInt(anneeMinValue))
    formData.append("annee_max", parseInt(anneeMaxValue))
    formData.append("prix_min", parseInt(prixMinValue))
    formData.append("prix_max", parseInt(prixMaxValue))
    fetch('../Back/BDDfiltre.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    //.then(response => console.log(response))
    .then(response => response.forEach(voiture => {
        //Réaffectation des variables pour créer de nouveaux éléments à chaque itérations
        div = document.createElement('div')
        img = document.createElement('img')
        h3 = document.createElement('h3')
        pAnnee = document.createElement('p')
        pKm = document.createElement('p')
        hr = document.createElement('hr')
        pPrix = document.createElement('p')
        a = document.createElement('a')
        //Création des div principales
        mainContent.appendChild(divPrincipale)
        divPrincipale.appendChild(div)
        //Affectation des valeurs
        img.src = `../voitureImg/Principales/${voiture.image_princ}`
        h3.textContent = `${voiture.marque} ${voiture.modele}`
        pAnnee.textContent = `Mise en circulation: ${voiture.annee_MES}`
        pKm.textContent = `Kilométrage: ${voiture.kilometrage}`
        pPrix.textContent = `${voiture.prix}€`
        //URL pour local -> http://localhost/ECF-V.parrot/detail_vehicule.php?idCar=
        a.setAttribute('href', './detail_vehicule.php?idCar=' + voiture.id)
        a.textContent = 'Infos'
        //Affectation des classes
        divPrincipale.classList.add('liste-voitures-filtred')
        hr.classList.add('separation')
        pPrix.classList.add('prix')
        a.classList.add('infos')
        //Création des éléments dans les div
        div.appendChild(img)
        div.appendChild(h3)
        div.appendChild(pAnnee)
        div.appendChild(pKm)
        div.appendChild(hr)
        div.appendChild(pPrix)
        div.appendChild(a)
    }))
    .catch(error => 'Erreur: ' + error)
})

//Affichage des voitures selon le filtre
formBtn.addEventListener('click', () => {
    carList.style.display = 'none'
})

dropFilter.addEventListener('click', () => {
    //Réaffectation des valeurs de bases
    kmMinValue = 10000
    kmMaxValue = 230000
    anneeMinValue = 2000
    anneeMaxValue = 2024
    prixMinValue = 5000
    prixMaxValue = 60000
    //Affichage des valeurs de base
    kmMinText.innerText = kmMinValue
    kmMaxText.innerText = kmMaxValue
    anneeMinText.innerText = anneeMinValue
    anneeMaxText.innerText = anneeMaxValue
    prixMinText.innerText = prixMinValue
    prixMaxText.innerText = prixMaxValue
    //Affichage de toute les voitures
    let carListFiltred = document.querySelector('.liste-voitures-filtred')
    carListFiltred.style.display = 'none'
    carList.style.display = 'flex'
})
