
function onModalClick() {
    modalView.classList.add('hidden');
    modalView.innerHTML = '';
  }
  
function search(event){
    plot.innerHTML = '';
    albumView.innerHTML = '';
    cast.innerHTML = '';
    const form_data = new FormData(document.querySelector("#search form"));
    const search = encodeURIComponent(form_data.get('search'));
    // Mando le specifiche della richiesta alla pagina PHP, che prepara la richiesta e la inoltra
    fetch("search.php?search=" + search).then(onResponse).then(onJson);
    // Evito che la pagina venga ricaricata
    event.preventDefault();
}

function onResponse(response) {
    return response.json();
  }

  function onJson(json) {
    console.log('JSON ricevuto');
    console.log(json);
    jsonResults = json.results;
    const istruzioni = document.createElement('div');
    istruzioni.textContent = 'Clicca sul titolo del film interessato';
    albumView.appendChild(istruzioni);
    const list = document.createElement('ol');
    for (let i = 0; i < jsonResults.length; i++) {
      const title = jsonResults[i].title;
      const listItem = document.createElement('li');
      listItem.textContent = title;
      list.appendChild(listItem);
      listItem.addEventListener ('click', onTitleClick);
    }
    istruzioni.appendChild(list);
  }

  function onTitleClick(event) {
    clickedTitle = event.currentTarget.textContent;
    albumView.innerHTML='';
    let id;
    for (let i = 0; i < jsonResults.length; i++) {
      if (jsonResults[i].title === clickedTitle) {
        id = jsonResults[i].id;
        break; 
      }
    }
    
    fetch ('fetchTitle.php?search='+ encodeURIComponent(id)).then(onResponse).then(onJson_Title);
  }

  function onJson_Title(json) {
    console.log('JSON ricevuto');
    console.log(json);
    const container = document.createElement('div');
    const title = document.createElement('h1');
    const genres = document.createElement('em');  
    const img = document.createElement('img');  
    const regista = document.createElement('div');
    const trailerButton = document.createElement('button');
    const saveButton = document.createElement('button');
    saveButton.dataset.id = json.id;
    saveButton.dataset.title = json.title;
    saveButton.dataset.year = json.year;
    saveButton.dataset.imDbRating = json.imDbRating;
    saveButton.dataset.image = json.image; 
    title.textContent = json.title + ' ' + '(' + json.year + ')';
    genres.textContent = json.genres + '           ' + 'VOTO:' + json.imDbRating;
    img.src = json.image;
    plot.textContent = json.plot;
    regista.textContent = 'Diretto da: ' + json.directors;
    trailerButton.textContent = 'Clicca per visualizzare il trailer';
    saveButton.textContent = 'Clicca per aggiungere alla lista di film preferiti';
    albumView.appendChild(trailerButton);
    albumView.appendChild(container);
    container.appendChild(title);
    container.appendChild(genres);
    container.appendChild(img);
    container.appendChild(regista);
    container.appendChild(saveButton);
    
    for (let i=0; i<8; i++) {
      const nome = document.createElement('p');
      const character = document.createElement('em');
      const foto = document.createElement('img');
      const attore = document.createElement('div');
      nome.textContent = json.actorList[i].name;
      character.textContent = json.actorList[i].asCharacter;
      foto.src = json.actorList[i].image;
      cast.appendChild(attore);
      attore.appendChild(nome);
      attore.appendChild(character);
      attore.appendChild(foto);
      attore.classList.add ('attore');
    }
    trailerButton.addEventListener('click',function () { searchTrailer (json.title);});
    if (json.type === 'Movie'){
        saveButton.addEventListener('click', saveFilm);
    }
    else {
        saveButton.addEventListener('click', saveSeries);
    }
  }
  
  function searchTrailer(string) {
    console.log(string);
    const query = string + ' official trailer';
    fetch('fetch_trailer.php?search='+ query)
      .then(onResponse)
      .then(onJson_Trailer);
  }
  
  function onJson_Trailer (json){
    const videoId = json.items[0].id.videoId;
    const videoPlayer = document.createElement('iframe');
    videoPlayer.setAttribute('src', `https://www.youtube.com/embed/` + videoId);
    modalView.appendChild(videoPlayer);
    modalView.classList.remove('hidden');
    console.log(videoId);
    console.log(json);
  }

  function saveFilm(event) {
    console.log("Salvataggio");
    event.stopPropagation();
    const selected = event.currentTarget;
    
      const formData = new FormData();
      formData.append('id', selected.dataset.id);
      formData.append('title', selected.dataset.title);
      formData.append('year', selected.dataset.year);
      formData.append('imDbRating', selected.dataset.imDbRating);
      formData.append('image', selected.dataset.image);

  
      
      fetch("save_film.php", { method: 'post', body: formData }).then(dispatchResponse, dispatchError);
   

    }

    function saveSeries (event) {
        console.log("Salvataggio");
        event.stopPropagation();
        const selected = event.currentTarget;
        
          const formData = new FormData();
          formData.append('id', selected.dataset.id);
          formData.append('title', selected.dataset.title);
          formData.append('year', selected.dataset.year);
          formData.append('imDbRating', selected.dataset.imDbRating);
          formData.append('image', selected.dataset.image);
    
      
          
          fetch("save_series.php", { method: 'post', body: formData }).then(dispatchResponse, dispatchError);
         
    
        }

        function dispatchResponse(response) {

            console.log(response);
            return response.json().then(databaseResponse); 
          }
          
          function dispatchError(error) { 
            console.log("Errore");
          }
          
          function databaseResponse(json) {
            if (!json.ok) {
                dispatchError();
                return null; 
                
            }
            
        }
   

let jsonResults;
let type;
document.querySelector("#search form").addEventListener("submit", search);
const container = document.getElementById('results');
const plot = document.getElementById('plot');
const albumView = document.getElementById('album-view');
const cast = document.getElementById('cast');

const modalView = document.getElementById('modale');
modalView.addEventListener('click', onModalClick);


