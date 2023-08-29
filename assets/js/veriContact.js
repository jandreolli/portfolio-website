document.querySelector('#comments_container form button')
    .addEventListener('click', function (event) {
        event.preventDefault() // évite d'envoyer le formulaire (pour faire la verif avant)

        const regexInput = /^[\S]{1,50}$/
        let hasError = false // si erreur dans form, devient true

        // si commence à écrire qqch de juste, enlève le rouge (fct dans variable)
        const inputVerif = function () {
            if ((this.value.match(regexInput) == null)) {
                this.classList.add('error')
                this.previousElementSibling.classList.add('error')
                hasError = true
            }
            else {
                this.classList.remove('error')
                this.previousElementSibling.classList.remove('error')
                hasError = false
            }
        }

        // vérifie firstName
        let firstNameInput = document.getElementById('firstName')
        // console.log(firstNameInput.value)
        if ((firstNameInput.value.match(regexInput) == null)) {
            firstNameInput.classList.add('error')
            // je récupère l'élém html précé (= label prénom)
            firstNameInput.previousElementSibling.classList.add('error')
            hasError = true
        }

        // véfifie si txt en train d'être écrit rouge ou pas
        firstNameInput.addEventListener('input', inputVerif)

        // vérifie lastName
        let lastNameInput = document.getElementById('lastName')
        if ((lastNameInput.value.match(regexInput) == null)) {
            lastNameInput.classList.add('error')
            // je récupère l'élém html précé (= label prénom)
            lastNameInput.previousElementSibling.classList.add('error')
            hasError = true
        }

        // véfifie si txt en train d'être écrit rouge ou pas
        lastNameInput.addEventListener('input', inputVerif)

        // vérifie url
        let urlInput = document.getElementById('url')
        if (urlInput.value !== '' &&
            urlInput.value.match(/^(?:http|https|ftp):\/\/[\S]{1,92}$/) == null) {
            urlInput.classList.add('error')
            urlInput.previousElementSibling.classList.add('error')
            hasError = true
        }

        // véfifie si txt en train d'être écrit rouge ou pas
        urlInput.addEventListener('input', function () {
            if (urlInput.value !== '' &&
                urlInput.value.match(/^(?:http|https|ftp):\/\/[\S]{1,92}$/) == null) {
                urlInput.classList.add('error')
                urlInput.previousElementSibling.classList.add('error')
                hasError = true
            } else {
                urlInput.classList.remove('error')
                urlInput.previousElementSibling.classList.remove('error')
                hasError = false
            }
        })

        // vérifie le message
        let messageTextArea = document.getElementById('message')
        // si message vide = erreur
        if (messageTextArea.value == '') {
            messageTextArea.classList.add('error')
            // je récupère l'élém html précé
            messageTextArea.previousElementSibling.classList.add('error')
            hasError = true
        }

        // véfifie si txt en train d'être écrit rouge ou pas
        messageTextArea.addEventListener('input', function () {
            if (this.value == '') {
                this.classList.add('error')
                this.previousElementSibling.classList.add('error')
            }
            else {
                this.classList.remove('error')
                this.previousElementSibling.classList.remove('error')
                hasError = false
            }
        })
        // si tout est juste on envoie
        if (!hasError) {
            // on appelle le formulaire
            document.querySelector('#comments_container form')
                .submit()
        }
    })