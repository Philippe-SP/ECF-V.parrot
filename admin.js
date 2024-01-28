//Récupération des champs et zone de text où sera affiché le nom des fichiers
//Principal
const princ_doc = document.getElementById('docP')
const text_p = document.getElementById('img_P')
//Secondaires
const second_doc = document.getElementById('docS')
const showDocs = document.getElementById('showDocs')

//Fonctions permettant l'affichage du nom des fichiers lorsqu'ils sont ajouté par l'utilisateur
//Principal
princ_doc.onchange = () => {
  const selectedPrincDoc = princ_doc.files[0].name
  text_p.innerHTML = selectedPrincDoc
}
//Secondaires
second_doc.onchange = () => {
  let selectedDocs = second_doc.files
  //Conversion de l'objet files en tableau associatif
  let docsList = []
  for (i = 0; i < selectedDocs.length; i++) {
    docsList.push(selectedDocs[i].name)
  }
  //Affichage du nom des fichier séparés par un /
  let docslistString = docsList.join(' / ')
  showDocs.innerHTML = docslistString
}
