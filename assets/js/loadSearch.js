let hasSearched = false; // pour vérifier si il y a déjà eu une recherche
const loadSearch = async (searchInput) => {
    const response = await fetch(`http://localhost:8000/assets/php/searchServer.php?search=${searchInput}`);
    const searchJson = await response.json();

    searchJson.forEach(result => {
        const searchContainer = document.querySelector('section section');
        const searchElement = document.createElement('article');
        searchElement.innerHTML = `
            <h3>${result.title}</h3>
            <p>${result.content}</p>
        `
        searchContainer.appendChild(searchElement);
    })
    hasSearched = true;
}


document.querySelector('form button')
    .addEventListener('click', async (event) => {
        const searchInputElem = document.querySelector('form input');
        const searchInput = searchInputElem.value;

        if (hasSearched) {
            const searchContainer = document.querySelector('section section');
            searchContainer.innerHTML = ''; // enlève les anciens résultats de recherche
        }

        await loadSearch(searchInput);
        searchInputElem.value = ''; // efface la recherche de la barre de recherche
    });