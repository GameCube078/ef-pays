(function () {
    console.log("rest API");
    // url2 de l'API REST de WordPress
    let lien_categories2 = document.querySelectorAll(".lien_categories2");
    for (const elm of lien_categories2) {
        console.log(elm.id);
        elm.addEventListener("mousedown", function () {
            const id = elm.id.split("_")[1];
            console.log(id);
            let url2 = `https://gftnth00.mywhc.ca/tim13/wp-json/wp/v2/posts?categories=${id}`;
            mon_fetch2(url2);
        });
    }

    // Effectuer la requête HTTP en utilisant fetch()
    function mon_fetch2(url2) {
        fetch(url2)
            .then(function (response) {
                // Vérifier si la réponse est OK (statut HTTP 200)
                if (!response.ok) {
                    throw new Error("La requête a échoué avec le statut " + response.status);
                }

                // Analyser la réponse JSON
                return response.json();
                console.log(response.json());
            })
            .then(function (data) {
                // La variable "data" contient la réponse JSON
                console.log(data);
                let restapi2 = document.querySelector(".contenu2__restapi22");
                // Maintenant, vous pouvez traiter les données comme vous le souhaitez
                restapi2.innerHTML = "";
                // Par exemple, extraire les titre2s des articles comme dans l'exemple précédent
                data.forEach(function (article) {
                    let titre2 = article.title.rendered;
                    let contenu2 = article.content.rendered;
                    contenu2 = trimWord2(contenu2, 10);
                    console.log(titre2);
                    let carte2 = document.createElement("div");
                    carte2.classList.add("restapi2__carte2");
                    carte2.classList.add("carte2");

                    carte2.innerHTML = `
          <h2>${titre2}</h2>
          <p>${contenu2}</p>
          `;
                    restapi2.appendChild(carte2);
                });
            })
            .catch(function (error) {
                // Gérer les erreurs
                console.error("Erreur lors de la récupération des données :", error);
            });
    }
    function trimWord2(sentence, wordCount) {
        let result2 = sentence.split(" ").splice(0, wordCount).join(" ");
        return result2 + "...";
    }
})();
