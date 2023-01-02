const getWordDefinition = document.getElementsByClassName('lexique_a_traduire');
const definitionDisplay = document.getElementById('definition-text');
const definitionContainer = document.getElementById('definition-container');
const definitionButton = document.getElementById('definition-button');

const getSpan = document.querySelector('span');
const getOnlyWord = document.getElementById('definition-mot');

for (let i = 0; i < getWordDefinition.length; i++) {
    getWordDefinition[i].addEventListener('click', function () {
        definitionDisplay.innerHTML = getWordDefinition[i].dataset.definition;
        definitionContainer.classList.toggle("hidden");
        getOnlyWord.innerHTML = getSpan.innerHTML;
    })

}

definitionButton.addEventListener('click', function () {
    definitionContainer.classList.add('hidden');
})