/****************************************************** */
//*****************VARIABLES GLOBALES*******************/
/******************************************************** */
let nav = document.getElementById('nav');
let burger = document.querySelector('header i');
let shoppingCart = document.querySelector('.panier');
let cartIcon = document.querySelector('.cart');
let i = 0;
let cd = "CD";
let tape = "Cassette";
let vinyl = "Vinyle";
let clothing = "Vêtement";

/********************************************************** */
//**************************FONCTIONS **********************/
/********************************************************** */

/********** Fonction pour afficher la navigation en mode mobile************/
function showNav() {
    if (i%2==0) {
        burger.classList.remove('fa-bars');
        burger.classList.add('fa-times');
        nav.classList.remove('hideTransition');
        nav.classList.add('showTransition');
        burger.style.color ="white"
        i++;
    }
    else {
        burger.classList.remove('fa-times');
        burger.classList.add('fa-bars');
        nav.classList.remove('showTransition');
        nav.classList.add('hideTransition');
        burger.style.color ="black"
        i++;
    }
}

/********** Fonction pour afficher le panier************/
function showCart() {
    if (i%2==0) {
        cartIcon.classList.remove('fa-bars');
        cartIcon.classList.add('fa-times');
        shoppingCart.classList.remove('hideCartTransition');
        shoppingCart.classList.add('showCartTransition');
        cartIcon.style.color ="white"
        i++;
        showShoppingCart();
    }
    else {
        cartIcon.classList.remove('fa-times');
        cartIcon.classList.add('fa-bars');
        shoppingCart.classList.remove('showCartTransition');
        shoppingCart.classList.add('hideCartTransition');
        cartIcon.style.color ="black"
        i++;
    }
}


/********** Fonction pour lancer la recherche sur le site en ajax ************/
function search() {
    let search = document.getElementById('search').value;
	fetch(`index.php?page=search&search=${search}`)
	//analyser la réponse
	.then(response => response.text())
	//utilise la réponse
	.then(response => {
		document.querySelector("main").innerHTML = response;
	});
}

/********** Fonctions pour trier les produits de la page Shop ************/
function sortByCD() {
    sortProducts("CD")
}
function sortByTapes() {
    sortProducts("Cassette")
}
function sortByVinyls() {
    sortProducts("Vinyle")
}
function sortByClothes() {
    sortProducts("Vêtement")
}
function sortByAll() {
    sortProducts()
}

function sortProducts(sort=null){
    fetch(`index.php?page=shop&sort=${sort}`)
	//analyser la réponse
	.then(response => response.text())
	//utilise la réponse
	.then(response => {
		document.querySelector("main").innerHTML = response;
        document.getElementById("sortByAll").addEventListener('click', sortByAll);
        document.getElementById("sortByCD").addEventListener('click', sortByCD);
        document.getElementById("sortByTapes").addEventListener('click', sortByTapes);
        document.getElementById("sortByVinyls").addEventListener('click', sortByVinyls);
        document.getElementById("sortByClothes").addEventListener('click', sortByClothes);
	});

}




/************ Fonction pour ajouter les produits au panier **************/
function addToCart() {
    
    
    let product = {
        id : this.dataset.id,
        name : this.dataset.name,
        price: this.dataset.price,
        nb : 0
    };

    setItems(product);
}

function setItems(product){
    let recupData = window.localStorage.getItem("panier");
    cart = JSON.parse(recupData);
    


    if (cart != null) {
        if (cart[product.id] == undefined) {
            cart = {
                ...cart,
                [product.id]: product
            }          
        }
        cart[product.id].nb++
    }
    else {
        product.nb = 1;
        cart = {
            [product.id]: product
        }
        console.log('else');
    }
    let cartJson = JSON.stringify(cart);
    window.localStorage.setItem("panier",cartJson);
    
}

/************ Fonction pour afficher le panier **************/

function showShoppingCart() {
	let cartJson = window.localStorage.getItem("panier");
    //options
	let options = {
		method : 'POST',
		body : cartJson,
		headers:{'Content-Type':'application/json'}
	}
    fetch(`index.php?page=cart`, options)
    .then(response => response.text())
	.then(response => {
		document.querySelector(".panier").innerHTML = response;
        document.querySelectorAll(".fa-times-circle").forEach((product)=>{
            product.addEventListener('click', removeFromCart);
        document.querySelector(".checkout button").addEventListener('click', showCheckout)
        });
	});
}

/************ Fonction pour retirer des produits du panier **************/

function removeFromCart(){
    let recupData = window.localStorage.getItem("panier");
    cart = JSON.parse(recupData);

    let id = this.dataset.id;
    delete cart[id];
    let cartJson = JSON.stringify(cart);
    window.localStorage.setItem("panier",cartJson);
    showShoppingCart();
}

/************ Fonction pour afficher le checkout **************/


function showCheckout(){
    fetch(`index.php?page=checkout`)
	//analyser la réponse
	.then(response => response.text())
	//utilise la réponse
	.then(response => {
		document.querySelector("panier").innerHTML = response;
	});
}

/******************************************************************** */
//*****************************CODE GENERAL************************/
/******************************************************************* */

document.addEventListener("DOMContentLoaded",function(){
   
    burger.addEventListener('click',showNav);
    cartIcon.addEventListener('click',showCart);
    document.getElementById("search").addEventListener('input', search);
   
    if (document.getElementById("addToCart") != null)
        document.getElementById("addToCart").addEventListener('click', addToCart);
    


    //clicks pour le tri des produits de la page shop
    //console.log(sortProducts);
    document.getElementById("sortByAll").addEventListener('click', sortByAll);
    document.getElementById("sortByCD").addEventListener('click', sortByCD);
    document.getElementById("sortByTapes").addEventListener('click', sortByTapes);
    document.getElementById("sortByVinyls").addEventListener('click', sortByVinyls);
    document.getElementById("sortByClothes").addEventListener('click', sortByClothes);
    
    

    
    




     /* Script pour tinyMCE*/
     tinymce.init({
        selector: '#text',
        plugins: 'autolink lists media table',
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        width : "640",
    });
});