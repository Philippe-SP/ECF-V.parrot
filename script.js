//Animation de texte page d'accueil
const cardText1 = document.querySelector('.card-text1')
const cardText2 = document.querySelector('.card-text2')
const cardText3 = document.querySelector('.card-text3')

window.addEventListener('load', () => {
    cardText1.classList.add('after')
    cardText2.classList.add('after')
    cardText3.classList.add('after')
})

//Filtre pour les champs des formulaires
//Index.php
const comIndex = document.getElementById('text-area')
const formIndex = document.getElementById('formIndex')

comIndex.onchange = () => {
    if(comIndex.value.includes("<", ">") === true) {
        formIndex.onsubmit = (e) => {
            e.preventDefault()
            alert("Le message ne peut pas contenir de < ou de >.")
        }
    }
}

//Detail_vehicule.php
const messageDetail = document.getElementById('messageDetail')
const formDetail = document.getElementById('formDetail')

messageDetail.onchange = () => {
    if(messageDetail.value.includes("<", ">") === true) {
        formDetail.onsubmit = (e) => {
            e.preventDefault()
            alert("Le message ne peut pas contenir de < ou de >.")
        }
    }
}

//Contact.php
const messageContact = document.getElementById('messageContact')
const formContact = document.getElementById('formContact')

messageContact.onchange = () => {
    if(messageContact.value.includes("<", ">") === true) {
        formContact.onsubmit = (e) => {
            e.preventDefault()
            alert("Le message ne peut pas contenir de < ou de >.")
        }
    }
}