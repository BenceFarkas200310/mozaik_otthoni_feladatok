const collectionsElement = document.querySelector(".collections");
window.onload = () => {
  fetch("./data.json")
    .then((response) => response.json())
    .then((data) => {
      loadCards(data);
    })
    .catch((err) => alert("Hiba az adatok betöltése közben!"));
};

function loadCards(collections) {
  if (collections.length !== 0) {
    for (collection of collections) {
      collectionsElement.innerHTML += `
            <div class="card" style="width: 18rem">
          <img
            src="./assets/placeholder.jpeg"
            class="card-img-top"
            alt="Thumbnail"
          />
          <div class="card-body">
            <h5 class="card-title">${collection.name}</h5>
            <p class="card-text">
                Témakör: ${collection.theme}
            </p>
            <a href="#" class="btn btn-outline-primary open-btn">Megnyitás</a>
          </div>
        </div>
        `;
    }
  } else {
    collectionsElement.innerHTML = "<h2>Még nincs egy gyűjteményed sem!</h2>";
  }
}
