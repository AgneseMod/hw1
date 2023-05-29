function fetchSaved() {
    fetch("saved.php")
      .then(onResponse)
      .then(onJson);
  }
  
  function onResponse(response) {
    if (!response.ok) {return null};
    return response.json();
  }
  
  function onJson(json) {
    
    console.log(json);
    const filmsContainer = document.getElementById("film");
    const seriesContainer = document.getElementById("serie");
    filmsContainer.innerHTML = "";
    seriesContainer.innerHTML = "";
    for (let i = 0; i < json.films.length; i++) {
      console.log (json.films[i]);
      const poster = document.createElement('div');
      const title = document.createElement('h2');
      const img = document.createElement ('img');
     
      title.textContent = json.films[i].titolo;
      img.src = json.films[i].img;

      poster.appendChild (title);
      poster.appendChild (img);
      poster.classList.add ('poster');
      filmsContainer.appendChild(poster);
      

    }
    for (let i = 0; i < json.series.length; i++) {
     
        const poster = document.createElement('div');
        const title = document.createElement('h2');
        const img = document.createElement ('img');
     
        title.textContent = json.series[i].titolo;
        img.src = json.series[i].img;
  
        poster.appendChild (title);
        poster.appendChild (img);
        poster.classList.add ('poster');
        seriesContainer.appendChild(poster);
      }
  }
  
  fetchSaved();
  