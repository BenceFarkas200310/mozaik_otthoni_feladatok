const collectionsElement = document.querySelector(".collections");
const newCollectionFormElement = document.querySelector("#newCollectionForm");
const nameInputElement = document.querySelector("#nameInput");
const themeInputElement = document.querySelector("#themeInput");
const dateInputElement = document.querySelector("#dateInput");

let collectionsArray = [];

newCollectionFormElement.addEventListener("submit", function (event) {
  event.preventDefault();
  addNewCollection();

  const modalElement = document.getElementById("formModal");
  const modalInstance = bootstrap.Modal.getInstance(modalElement);
  modalInstance.hide();
});

window.onload = () => {
  fetch("http://localhost:3000/collections")
    .then((response) => response.json())
    .then((data) => {
      loadCards(data);
      collectionsArray = data;
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

function addNewCollection() {
  const newCollectionName = nameInputElement.value;
  const newCollectionTheme = themeInputElement.value;
  const newCollectionDate = dateInputElement.value;

  let newCollection = {
    id: collectionsArray[collectionsArray.length - 1].id + 1,
    name: newCollectionName,
    theme: newCollectionTheme,
    content: [],
  };

  fetch("http://localhost:3000/collections", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(newCollection),
  })
    .then((response) => response.json())
    .then((data) => {
      collectionsArray.push(newCollection);
      loadCards(collectionsArray);
    })
    .catch((error) => {
      console.error("Hiba:", error);
    });
}
