const searchInput = document.getElementById("searchInput");

searchInput.addEventListener("keyup", function(){

let value = this.value.toLowerCase();

let rows = document.querySelectorAll("#absenceTable tbody tr");

rows.forEach(function(row){

let text = row.textContent.toLowerCase();

if(text.indexOf(value)>-1){

row.style.display="";

}else{

row.style.display="none";

}

});

});

const cards=document.querySelectorAll(".stat-card");

cards.forEach((card,index)=>{

card.style.opacity="0";
card.style.transform="translateY(30px)";

setTimeout(()=>{

card.style.transition=".6s";
card.style.opacity="1";
card.style.transform="translateY(0)";

},index*250);

});