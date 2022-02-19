let btn = document.querySelector('#btn');
let sidebar = document.querySelector('.sidebar');
let searchBtn = document.querySelector('#isearch');

// document.querySelector('#btn').onclick = function() { 
//     alert('bla bla'); 
// }



btn.onclick = function(){

    sidebar.classList.toggle("active");

    // alert('bla bla'); 
}

searchBtn.onclick = function(){

    sidebar.classList.toggle("active");

    // alert('bla bla'); 
}


