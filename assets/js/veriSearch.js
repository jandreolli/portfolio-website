document.querySelector('#search_main form button')
    .addEventListener('click', function (event) {
        event.preventDefault(); // évite d'envoyer le formulaire (pour faire la verif avant)

        const regexInput = /^[a-zA-Z0-9\s]{1,80}$/;
        let hasError = false;

        const inputVerif = function () {
            if ((this.value.match(regexInput) == null)) {
                this.classList.add('error');
                this.previousElementSibling.classList.add('error');
                hasError = true;
            }
            else {
                this.classList.remove('error');
                this.previousElementSibling.classList.remove('error');
                hasError = false;
            }
        }

        let searchInput = document.getElementById('search');
        // console.log(firstNameInput.value)
        if ((searchInput.value.match(regexInput) == null)) {
            searchInput.classList.add('error');
            // je récupère l'élém html précé (= label prénom)
            searchInput.previousElementSibling.classList.add('error');
            hasError = true;
        }

        // véfifie si txt en train d'être écrit rouge ou pas
        searchInput.addEventListener('input', inputVerif);

        // si tout est juste on envoie
        if (!hasError) {
            // // on appelle le formulaire
            document.querySelector('#search_main form')
                .button; // button au lieu de submit() sinon page refresh
        }
    })