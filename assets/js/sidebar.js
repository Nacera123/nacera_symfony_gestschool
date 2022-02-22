let btn = document.querySelector('#btn');
let sidebar = document.querySelector('.sidebar');
let searchBtn = document.querySelector('#isearch');

// document.querySelector('#btn').onclick = function() { 
//     alert('bla bla'); 
// }



btn.onclick = function () {

    sidebar.classList.toggle("active");

    // alert('bla bla'); 
}

searchBtn.onclick = function () {

    sidebar.classList.toggle("active");

    // alert('bla bla'); 
}


var myCollapsible = document.getElementById('myCollapsible')
myCollapsible.addEventListener('hidden.bs.collapse', function () {
    // do something...
})


function myFunction() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}