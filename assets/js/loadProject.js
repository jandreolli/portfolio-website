let page = 0
const loadProjects = async () => {
    const response = await fetch('http://localhost:8000/assets/php/projectServer.php?page=' + page)
    const projects = await response.json()

    const projectsContainer = document.querySelector('main nav')

    projects.forEach(project => {
        const projectElement = document.createElement('article')
        const seeProject = document.querySelector('#seeProject').value;
        projectElement.innerHTML = `
                <header>
                    <img src="${project.img}" alt="Image du résultat du projet informatique ${project.title}"/>
                </header>
                <section>
                    <h2>${project.title}</h2>
                    ${project.prog.map(language => `<h3>${language}</h3>`).join(' ')}
                    <p>${project.content}</p>
                </section>
                <footer>
                <a href="/project.php?id=${project.id}"><span>${seeProject}</span></a>
                </footer>  
        `
        projectsContainer.appendChild(projectElement)
    })
}

loadProjects();
page++;

const response = await fetch('http://localhost:8000/assets/php/projectTableSize.php')
const projectTableSize = await response.json()

document.querySelector('main button')
    .addEventListener('click', async () => {
        await loadProjects()
        page++

        if ((page * 3) >= projectTableSize) {
            document.querySelector('main button')
                .remove()
        }
    })