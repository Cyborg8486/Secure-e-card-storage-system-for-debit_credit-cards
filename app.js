const cards= document.querySelector("#main_card");
console.log(cards);
let code=`<div class="m-4 card">
<div class="card-body">
<h8>Card Number: </h8>
<br>
<h8>Card Holder Name: </h8>
<p class="card-text"></p>
<a href="#" class="btn btn-primary">Select Card</a>
</div>
</div>`;
function createCard([number,nme]){
    code=`<div class="m-4 card">
    <div class="card-body">
    <h8>Card Number: ${number}</h8>
    <br>
    <h8>Card Holder Name: ${nme}</h8>
    <p class="card-text"></p>
    <a href="#" class="btn btn-primary">Select Card</a>
  </div>
  </div>`
  cards.innerHTML+=code;
}


const item1= [4567839012717, "Tanuj"];
const item2= [2394628762958, "Arpit"];
const item3= [4567839012717, "Tanuj"];
const item4= [2394628762958, "Arpit"];
const item5= [4567839012717, "Tanuj"];
const item6= [2394628762958, "Arpit"];
const item7= [4567839012717, "Tanuj"];
const item8= [2394628762958, "Arpit"];
const item9= [4567839012717, "Tanuj"];



createCard(item1);
createCard(item2);
createCard(item3);
createCard(item4);
createCard(item5);
createCard(item6);
createCard(item7);
createCard(item8);
createCard(item9);


