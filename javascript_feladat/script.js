const collectionsElement = document.querySelector(".collections");
const newCollectionFormElement = document.querySelector("#newCollectionForm");
const nameInputElement = document.querySelector("#nameInput");
const themeInputElement = document.querySelector("#themeInput");
const dateInputElement = document.querySelector("#dateInput");
const collectionModalTitleElement = document.querySelector(
  "#collectionModalLabel"
);
const collectionModalBodyElement = document.querySelector(
  "#collectionModalBody"
);

const newItemFormElement = document.querySelector("#new-item-form");
let collectionsArray = [];
let clickCounter = 0;

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
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#collectionModal" onclick="openCollection(${collection.id})">
              Megnyitás
            </button>

          </div>
        </div>
        `;
    }
  } else {
    collectionsElement.innerHTML = "<h2>Még nincs egy gyűjteményed sem!</h2>";
  }
}

function addNewCollection() {
  //TODO: Use date input
  const newCollectionName = nameInputElement.value;
  const newCollectionTheme = themeInputElement.value;
  const newCollectionDate = dateInputElement.value;

  let newCollection = {
    id: collectionsArray.length
      ? collectionsArray[collectionsArray.length - 1].id + 1
      : 0,
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

function openCollection(id) {
  const collection = collectionsArray[id];

  collectionModalTitleElement.innerHTML = collection.name;
  for (item of collection.content) {
    collectionModalBodyElement.innerHTML += `
      <div class="card">
        <div class="card-body">
          ${item}
          <select class="form-select-action" aria-label="Válassz műveletet">
            <option selected>Válassz műveletet</option>
            <option value="move">Áthelyezés</option>
            <option value="rename">Átnevezés</option>
            <option value="delete">Törlés</option>
          </select>
        </div>
      </div>
    `;
  }
}

function closeCollectionModal() {
  collectionModalBodyElement.innerHTML = ``;
}

function toggleVisibility() {
  clickCounter++;
  if (clickCounter % 2 === 0) {
    newItemFormElement.classList.remove("visible");
    newItemFormElement.classList.add("hidden");
  } else {
    newItemFormElement.classList.remove("hidden");
    newItemFormElement.classList.add("visible");
  }
}
