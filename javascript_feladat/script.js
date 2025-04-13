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
const newItemNameInput = document.querySelector("#new-item-name");
let collectionsArray = [];
let clickCounter = 0;
let currentCollectionId = null;

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
    collectionsElement.innerHTML = ``;
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
      ? Number(collectionsArray[collectionsArray.length - 1].id) + 1
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
      alert("Hiba:", error);
    });
}

function openCollection(id) {
  const collection = collectionsArray.find((col) => col.id == id);
  currentCollectionId = id;
  collectionModalBodyElement.innerHTML = "";

  console.log(id);
  console.log(collection);
  collectionModalTitleElement.innerHTML = `
    <div class="rename-section">
      <span class="collection-name">${collection.name}</span>
      <button class="btn btn-link rename-icon" onclick="showRenameInput(${collection.id})">
        <i class="bi bi-pencil-square"></i>
      </button>
      <form class="rename-input hidden" id="rename-input-${collection.id}">
        <input type="text" class="form-control" placeholder="${collection.name}" id="rename-input-field-${collection.id}" required/>
        <button type="button" class="btn btn-primary" onclick="submitRename(${collection.id})">Átnevez</button>
        <button type="button" class="btn btn-secondary" onclick="cancelRename(${collection.id})">Mégsem</button>
      </form>
    </div>
  `;

  for (item of collection.content) {
    collectionModalBodyElement.innerHTML += `
      <div class="card">
        <div class="card-body" id="item-card-body">
          ${item}
          <select class="form-select-action" aria-label="Válassz műveletet" onchange="handleActionChange(this, '${item}', ${
      collection.id
    })">
            <option selected>Válassz műveletet</option>
            <option value="move">Áthelyezés</option>
            <option value="rename">Átnevezés</option>
            <option value="delete">Törlés</option>
          </select>
          <select class="form-select-target hidden" aria-label="Válassz célgyűjteményt" id="target-collection-${item}">
            ${collectionsArray
              .map((col) => `<option value="${col.id}">${col.name}</option>`)
              .join("")}
          </select>
        </div>
      </div>
    `;
  }
}

function addNewItem() {
  const collection = collectionsArray[currentCollectionId];
  const newItemName = newItemNameInput.value;
  const id = currentCollectionId;
  console.log(id);
  if (collection) {
    collection.content.push(newItemName);
    console.log(collection);

    fetch(`http://localhost:3000/collections/${id}`, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(collection),
    })
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        console.log(data);
        loadCards(collectionsArray);
      })
      .catch((error) => {
        console.error("Error details:", error);
        alert("Hiba történt: " + error.message);
      });
  } else {
    alert("Gyűjtemény nem található");
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
function showRenameInput(collectionId) {
  document
    .getElementById(`rename-input-${collectionId}`)
    .classList.remove("hidden");
}

function cancelRename(collectionId) {
  document
    .getElementById(`rename-input-${collectionId}`)
    .classList.add("hidden");
}

function submitRename(collectionId) {
  const newName = document.getElementById(
    `rename-input-field-${collectionId}`
  ).value;

  if (newName) {
    const collection = collectionsArray.find((col) => col.id == collectionId);
    if (collection) {
      collection.name = newName;

      fetch(`http://localhost:3000/collections/${collectionId}`, {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(collection),
      })
        .then((response) => response.json())
        .then((data) => {
          loadCards(collectionsArray);
        })
        .catch((error) => {
          console.error("Error updating collection:", error);
        });
    }
  } else cancelRename();
}

// -------------------------------

function handleActionChange(selectElement, itemName, currentCollectionId) {
  const action = selectElement.value;
  const targetSelect = document.getElementById(`target-collection-${itemName}`);

  if (action === "move") {
    targetSelect.classList.remove("hidden");
    targetSelect.onchange = function () {
      const targetCollectionId = targetSelect.value;
      const confirmMove = confirm(
        `Biztosan át szeretnéd helyezni a(z) "${itemName}" elemet a kiválasztott gyűjteménybe?ß`
      );
      if (confirmMove) {
        moveItemToCollection(itemName, currentCollectionId, targetCollectionId);
      } else {
        targetSelect.value = "";
        targetSelect.classList.add("hidden");
      }
    };
  } else {
    targetSelect.classList.add("hidden");
  }
}

function moveItemToCollection(itemName, fromCollectionId, toCollectionId) {
  const fromCollection = collectionsArray.find(
    (col) => col.id == fromCollectionId
  );
  const toCollection = collectionsArray.find((col) => col.id == toCollectionId);

  if (fromCollection && toCollection) {
    fromCollection.content = fromCollection.content.filter(
      (item) => item != itemName
    );

    toCollection.content.push(itemName);

    Promise.all([
      fetch(`http://localhost:3000/collections/${fromCollectionId}`, {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(fromCollection),
      }),
      fetch(`http://localhost:3000/collections/${toCollectionId}`, {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(toCollection),
      }),
    ])
      .then(() => {
        loadCards(collectionsArray);
      })
      .catch((error) => {
        console.error("Error moving item:", error);
      });
  }
}
