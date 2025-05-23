const collectionsElement = document.querySelector(".collections");
const newCollectionFormElement = document.querySelector("#newCollectionForm");
const nameInputElement = document.querySelector("#nameInput");
const themeInputElement = document.querySelector("#themeInput");
const dateInputElement = document.querySelector("#dateInput");
let submitDeleteButton = document.getElementById("submit-delete-btn");
const collectionModalTitleElement = document.querySelector(
  "#collectionModalLabel"
);
const collectionModalBodyElement = document.querySelector(
  "#collectionModalBody"
);

const newItemFormElement = document.querySelector("#new-item-form");
const newItemNameInput = document.querySelector("#new-item-name");
let collectionsArray = [];
let itemsToDelete = [];
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
  const newCollectionName = nameInputElement.value;
  const newCollectionTheme = themeInputElement.value;
  const newCollectionDate = dateInputElement.value;

  let newCollection = {
    id: collectionsArray.length
      ? Number(collectionsArray[collectionsArray.length - 1].id) + 1
      : 0,
    name: newCollectionName,
    theme: newCollectionTheme,
    date: newCollectionDate,
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
  itemsToDelete = [];

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
          <span id="item-card-title-${item}">${item}</span>
          <select class="select-action-element" class="form-select-action" aria-label="Válassz műveletet" onchange="handleActionChange(this, '${item}', ${
      collection.id
    })">
            <option value="def"><i class="bi bi-caret-down-square-fill"></i></option>
            <option value="move">Áthelyezés</option>
            <option value="rename">Átnevezés</option>
            <option value="delete">Törlés</option>
          </select>
          <select class="form-select-target hidden" aria-label="Válassz célgyűjteményt" id="target-collection-${item}">
          <option value="">Célgyűjtemény</option>  
          ${collectionsArray
            .filter((col) => col.id != collection.id)
            .map((col) => `<option value="${col.id}">${col.name}</option>`)
            .join("")}
          </select>
        </div>
      </div>
    `;
  }
}

function addNewItem() {
  const collection = collectionsArray.find(
    (col) => col.id == currentCollectionId
  );
  const newItemName = newItemNameInput.value;
  const id = currentCollectionId;
  if (collection) {
    if (collection.content.indexOf(newItemName) === -1) {
      collection.content.push(newItemName);

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
          collectionsArray = data;
          loadCards(collectionsArray);
        })
        .catch((error) => {
          console.error("Hiba:", error);
        });
    } else {
      alert("Már létezik elem ilyen névvel!");
    }
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
          console.error("Hiba:", error);
        });
    }
  } else cancelRename();
}

function handleActionChange(selectElement, itemName, currentCollectionId) {
  const action = selectElement.value;
  const targetSelect = document.querySelector(`#target-collection-${itemName}`);
  const itemCard = document.querySelector("#item-card-title-" + itemName);

  itemCard.innerHTML = itemName;

  if (action === "move") {
    // ÁTHELYEZÉS
    targetSelect.classList.remove("hidden");
    targetSelect.onchange = function () {
      const targetCollectionId = targetSelect.value;
      const confirmMove = confirm(
        `Biztosan át szeretnéd helyezni a(z) "${itemName}" elemet a kiválasztott gyűjteménybe?`
      );
      if (confirmMove) {
        if (checkIfMovable(itemName, targetCollectionId)) {
          moveItemToCollection(
            itemName,
            currentCollectionId,
            targetCollectionId
          );
        } else alert("Már létezik fájl ezzel a névvel a célgyűjteményben!");
      } else {
        targetSelect.value = "";
        targetSelect.classList.add("hidden");
      }
    };

    let index = itemsToDelete.indexOf(itemName);
    index !== -1 ? itemsToDelete.splice(index, 1) : "";
  } else if (action === "rename") {
    // ÁTNEVEZÉS
    itemCard.innerHTML = `
      <form>
        <input type="text" id="new-item-name-${itemName}" placeholder="Új név" required>
        <div class="rename-item-form-btns">
          <button type="button" class="btn btn-primary" onclick="renameItem('${itemName}')">Átnevez</button>
          <button type="button" class="btn btn-outline-primary" onclick="resetSelectElement()">Mégsem</button>
        </div>
        
      </form>
    `;
    targetSelect.classList.add("hidden");
    let index = itemsToDelete.indexOf(itemName);
    index !== -1 ? itemsToDelete.splice(index, 1) : "";
  } else if (action === "delete") {
    // TÖRLÉS
    itemsToDelete.includes(itemName) ? "" : itemsToDelete.push(itemName);
    itemCard.innerHTML = itemCard.innerHTML = itemName;
    targetSelect.classList.add("hidden");
  } else if (action === "def") {
    const itemCard = document.querySelector("#item-card-title-" + itemName);
    itemCard.innerHTML = itemCard.innerHTML = itemName;
    targetSelect.classList.add("hidden");
    let index = itemsToDelete.indexOf(itemName);
    index !== -1 ? itemsToDelete.splice(index, 1) : "";
  } else {
    targetSelect.classList.add("hidden");
  }

  if (itemsToDelete.length == 0) {
    submitDeleteButton.setAttribute("disabled", "disabled");
  } else submitDeleteButton.removeAttribute("disabled");
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
        console.error("Hiba:", error);
      });
  }
}

function renameItem(itemName) {
  const newName = document.querySelector("#new-item-name-" + itemName).value;
  let collection = collectionsArray.find(
    (col) => col.id == currentCollectionId
  );
  let indexToRename = collection.content.indexOf(itemName);
  if (indexToRename !== -1) {
    collection.content[indexToRename] = newName;

    fetch(`http://localhost:3000/collections/${currentCollectionId}`, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(collection),
    })
      .then(() => loadCards(collectionsArray))
      .catch((err) => alert("Hiba:", err));
  }
}

function resetSelectElement() {
  const selectElement = document.querySelector(".select-action-element");
  selectElement.value = "def";
}

function deleteItems() {
  let collection = collectionsArray.find(
    (col) => col.id == currentCollectionId
  );
  itemsToDelete.forEach((item) => {
    let index = collection.content.indexOf(item);
    index !== -1 ? collection.content.splice(index, 1) : "";
  });

  fetch(`http://localhost:3000/collections/${currentCollectionId}`, {
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
      console.error("Hiba:", error);
    });
}

function checkIfMovable(itemName, targetCollectionId) {
  const collection = collectionsArray.find(
    (col) => col.id == targetCollectionId
  );
  if (collection.content.indexOf(itemName) === -1) return true;
  return false;
}
