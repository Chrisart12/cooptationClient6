const hamburgerElt = document.getElementById("header-btn-menu");
const navbarMenuElt = document.getElementById("navbar-menu");

const links = document.querySelectorAll('.container-menu .links-menu')


let intervertir;

const showMenu = () => {
 
    intervertir = !intervertir

    if(intervertir) {
        navbarMenuElt.className = "open";
        links.forEach(link => {
            link.classList.add('visu');
        })
       
       } else {
        console.log("On vient d'appuyer", navbarMenuElt);
         navbarMenuElt.className = "nav"; 
         links.forEach(link => {
         link.classList.remove('visu');
         })
        
       }
  
}

hamburgerElt.addEventListener("click", showMenu)

















