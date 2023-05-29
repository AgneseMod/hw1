document.querySelector("#search form").addEventListener("submit", search);


function search(event){
    // Leggo il tipo e il contenuto da cercare e mando tutto alla pagina PHP
    const form_data = new FormData(document.querySelector("#search form"));
    // Mando le specifiche della richiesta alla pagina PHP, che prepara la richiesta e la inoltra
    fetch("search_content.php?q="+encodeURIComponent(form_data.get('search'))).then(searchResponse).then(jsonSpotify);
    // Evito che la pagina venga ricaricata
    event.preventDefault();
}

function searchResponse(response){
    console.log(response);
    return response.json();
}
