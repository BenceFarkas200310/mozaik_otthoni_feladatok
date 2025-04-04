let collectionsData;
window.onload = () => {
  fetch("./data.json")
    .then((response) => response.json())
    .then((data) => {
      collectionsData = data;
      console.log(collectionsData[0].id);
    })
    .catch((err) => alert("Hiba az adatok betöltése közben!"));
};
