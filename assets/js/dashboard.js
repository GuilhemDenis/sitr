//****************************************************** */
//*******************VARIABLES GLOBALES*****************/
//******************************************************** */
let tinymce;

//************************************************************* */
//**************************FONCTIONS ************************/
//********************************************************** */

/******************** DASHBOARD ARTISTES **********************/

function showArtistsTable(event, id=null){
    event.preventDefault();
    fetch("index.php?ajax=artists")
    .then(response => response.text())
    .then(response => {
        document.getElementById("dashboard").innerHTML = response;
        document.querySelectorAll('.edit').forEach((artist)=>{
            artist.addEventListener('click', function (){ showArtistsForm(event, artist.dataset.id); });
        });
        document.querySelectorAll('.delete').forEach((artist)=>{
            artist.addEventListener('click', deleteArtist);
        });
        document.getElementById('newEntry').addEventListener('click', showArtistsForm);
    });
}

function showArtistsForm(event, edit=null)
{
    
    if (edit != null)
    {
        fetch(`index.php?ajax=artists&id=${edit}`)
        .then(response => response.text())
        .then(response => {
            document.getElementById("dashboard").innerHTML = response;
            let form = document.getElementById('form');
            form.classList.toggle("hide");
            document.getElementById('newEntry').classList.toggle("hide");
            document.getElementById('formButton').addEventListener('click',editArtist);
            document.getElementById('cancelFormButton').addEventListener('click',showArtistsTable);
            document.getElementById("dashboardTable").classList.toggle("hide");
        });
    }
    else
    {
        let form = document.getElementById('form');
        form.classList.toggle("hide");
        document.getElementById("dashboardTable").classList.toggle("hide");
        document.getElementById('newEntry').classList.toggle("hide");  
        document.getElementById('formButton').addEventListener('click',addArtist);
        document.getElementById('cancelFormButton').addEventListener('click',showArtistsTable);
    }
}

function addArtist(event)
{
    event.preventDefault();
    let form = document.getElementById('form');
    let formData = new FormData(form);
    fetch('index.php?ajax=addArtist',
    {
        method: 'POST',
        body: formData,
    })
    .then(function() 
    {
        showArtistsTable(event); 
        form.classList.toggle("hide");  
        document.getElementById('newEntry').classList.toggle("hide");
        document.getElementById("dashboardTable").classList.toggle("hide");
    });
}

function editArtist(event)
{
    event.preventDefault();
    let form = document.getElementById('form');
    let formData = new FormData(form); 
    fetch('index.php?ajax=editArtist',
    {
        method: 'POST',
        body: formData,
    })
    .then( function() {
        showArtistsTable(event); 
        form.classList.toggle("hide"); 
        document.getElementById('newEntry').classList.toggle("hide");
        document.getElementById("dashboardTable").classList.toggle("hide");
    })
 
}

function deleteArtist(event)
{
    event.preventDefault();
    let confirm = window.confirm("Voulez-vous supprimer cet artiste ? Cette action est irréversible !")
    if(confirm)
	{
        let id = this.dataset.id;
        fetch(`index.php?ajax=deleteArtist&id=${id}`)
        .then( function(){
            showArtistsTable(event);
        }) 
	}
}

/****************************** DASHBOARD ALBUMS **************************/

function showAlbumsTable(event, id=null){
    event.preventDefault();
    fetch("index.php?ajax=albums")
    .then(response => response.text())
    .then(response => {
        document.getElementById("dashboard").innerHTML = response;
        document.querySelectorAll('.edit').forEach((artist)=>{
            artist.addEventListener('click', function (){ showAlbumsForm(event, artist.dataset.id); });
        });
        document.querySelectorAll('.delete').forEach((artist)=>{
            artist.addEventListener('click', deleteAlbum);
        });
        document.getElementById('newEntry').addEventListener('click', showAlbumsForm);
    });
}

function showAlbumsForm(event, edit=null)
{
    
    if (edit != null)
    {
        fetch(`index.php?ajax=albums&id=${edit}`)
        .then(response => response.text())
        .then(response => {
            document.getElementById("dashboard").innerHTML = response;
            let form = document.getElementById('form');
            form.classList.toggle("hide");
            document.getElementById('newEntry').classList.toggle("hide");
            document.getElementById('formButton').addEventListener('click',editAlbum);
            document.getElementById('cancelFormButton').addEventListener('click',showAlbumsTable);
            document.getElementById("dashboardTable").classList.toggle("hide");
        });
    }
    else
    {
        let form = document.getElementById('form');
        form.classList.toggle("hide");
        document.getElementById("dashboardTable").classList.toggle("hide");
        document.getElementById('newEntry').classList.toggle("hide");  
        document.getElementById('formButton').addEventListener('click',addAlbum);
        document.getElementById('cancelFormButton').addEventListener('click',showAlbumsTable);
    }
}

function addAlbum(event)
{
    event.preventDefault();
    let form = document.getElementById('form');
    let formData = new FormData(form);
    fetch('index.php?ajax=addAlbum',
    {
        method: 'POST',
        body: formData,
    })
    .then(function() 
    {
        showAlbumsTable(event); 
        form.classList.toggle("hide");  
        document.getElementById('newEntry').classList.toggle("hide");
        document.getElementById("dashboardTable").classList.toggle("hide");
    });
}

function editAlbum(event)
{
    event.preventDefault();
    let form = document.getElementById('form');
    let formData = new FormData(form); 
    fetch('index.php?ajax=editAlbum',
    {
        method: 'POST',
        body: formData,
    })
    .then( function() {
        showAlbumsTable(event); 
        form.classList.toggle("hide"); 
        document.getElementById('newEntry').classList.toggle("hide");
        document.getElementById("dashboardTable").classList.toggle("hide");
    })
 
}

function deleteAlbum(event)
{
    event.preventDefault();
    let confirm = window.confirm("Voulez-vous supprimer cet album ? Cette action est irréversible !")
    if(confirm)
	{
        let id = this.dataset.id;
        fetch(`index.php?ajax=deleteAlbum&id=${id}`)
        .then( function(){
            showAlbumsTable(event);
        }) 
	}
}

/***************************** DASHBOARD NEWS *********************************/

function showNewsTable(event, id=null){
    event.preventDefault();
    fetch("index.php?ajax=news")
    .then(response => response.text())
    .then(response => {
        document.getElementById("dashboard").innerHTML = response;
        document.querySelectorAll('.edit').forEach((artist)=>{
            artist.addEventListener('click', function (){ showNewsForm(event, artist.dataset.id); });
        });
        document.querySelectorAll('.delete').forEach((artist)=>{
            artist.addEventListener('click', deleteNews);
        });
        document.getElementById('newEntry').addEventListener('click', showNewsForm);
    });
}

function showNewsForm(event, edit=null)
{
    
    if (edit != null)
    {
        fetch(`index.php?ajax=news&id=${edit}`)
        .then(response => response.text())
        .then(response => {
            document.getElementById("dashboard").innerHTML = response;
            let form = document.getElementById('form');
            form.classList.toggle("hide");
            document.getElementById('newEntry').classList.toggle("hide");
            document.getElementById('formButton').addEventListener('click',editAlbum);
            document.getElementById('cancelFormButton').addEventListener('click',showAlbumsTable);
            document.getElementById("dashboardTable").classList.toggle("hide");
        });
    }
    else
    {
        let form = document.getElementById('form');
        form.classList.toggle("hide");
        document.getElementById("dashboardTable").classList.toggle("hide");
        document.getElementById('newEntry').classList.toggle("hide");  
        document.getElementById('formButton').addEventListener('click',addNews);
        document.getElementById('cancelFormButton').addEventListener('click',showNewsTable);
    }
}

function addNews(event)
{
    event.preventDefault();
    let form = document.getElementById('form');
    let formData = new FormData(form);
    fetch('index.php?ajax=addNews',
    {
        method: 'POST',
        body: formData,
    })
    .then(function() 
    {
        showNewsTable(event); 
        form.classList.toggle("hide");  
        document.getElementById('newEntry').classList.toggle("hide");
        document.getElementById("dashboardTable").classList.toggle("hide");
    });
}

function editNews(event)
{
    event.preventDefault();
    let form = document.getElementById('form');
    let formData = new FormData(form); 
    fetch('index.php?ajax=editNews',
    {
        method: 'POST',
        body: formData,
    })
    .then( function() {
        showNewsTable(event); 
        form.classList.toggle("hide"); 
        document.getElementById('newEntry').classList.toggle("hide");
        document.getElementById("dashboardTable").classList.toggle("hide");
    })
 
}

function deleteNews(event)
{
    event.preventDefault();
    let confirm = window.confirm("Voulez-vous supprimer cette news ? Cette action est irréversible !")
    if(confirm)
	{
        let id = this.dataset.id;
        fetch(`index.php?ajax=deleteNews&id=${id}`)
        .then( function(){
            showNewsTable(event);
        }) 
	}
}

/******************** DASHBOARD SHOP **********************/

function showProductsTable(event, id=null){
    event.preventDefault();
    fetch("index.php?ajax=products")
    .then(response => response.text())
    .then(response => {
        document.getElementById("dashboard").innerHTML = response;
        document.querySelectorAll('.edit').forEach((product)=>{
            product.addEventListener('click', function (){ showProductsForm(event, product.dataset.id); });
        });
        document.querySelectorAll('.delete').forEach((product)=>{
            product.addEventListener('click', deleteProduct);
        });
        document.getElementById('newEntry').addEventListener('click', showProductsForm);
    });
}

function showProductsForm(event, edit=null)
{
    if (edit != null)
    {
        fetch(`index.php?ajax=products&id=${edit}`)
        .then(response => response.text())
        .then(response => {
            document.getElementById("dashboard").innerHTML = response;
            let form = document.getElementById('form');
            form.classList.toggle("hide");
            document.getElementById('newEntry').classList.toggle("hide");
            document.getElementById('formButton').addEventListener('click',editProduct);
            document.getElementById('cancelFormButton').addEventListener('click',showProductsTable);
            document.getElementById("dashboardTable").classList.toggle("hide");
            document.getElementById('displaySelector').addEventListener('click',displayPhotoSelector);
        });
    }
    else
    {
        let form = document.getElementById('form');
        form.classList.remove("hide");
        document.getElementById("dashboardTable").classList.add("hide");
        document.getElementById('newEntry').classList.add("hide");
        document.getElementById('formButton').addEventListener('click',addProduct);
        document.getElementById('cancelFormButton').addEventListener('click',showProductsTable);
        document.getElementById('displaySelector').addEventListener('click',displayPhotoSelector);
    }
}

function addProduct(event)
{
    event.preventDefault();
    let form = document.getElementById('form');
    let formData = new FormData(form);
    fetch(`index.php?ajax=addProduct`,
    {
        method: 'POST',
        body: formData,
    })
    .then(function() 
    {
        showProductsTable(event); 
        form.classList.toggle("hide");  
        document.getElementById('newEntry').classList.toggle("hide");
        document.getElementById("dashboardTable").classList.toggle("hide");
    });
}

function editProduct(event)
{
    event.preventDefault();
    let form = document.getElementById('form');
    let formData = new FormData(form); 
    fetch('index.php?ajax=editProduct',
    {
        method: 'POST',
        body: formData,
    })
    .then( function() {
        showProductsTable(event); 
        form.classList.toggle("hide"); 
        document.getElementById('newEntry').classList.toggle("hide");
        document.getElementById("dashboardTable").classList.toggle("hide");
    })
 
}

function deleteProduct(event)
{
    event.preventDefault();
    let confirm = window.confirm("Voulez-vous supprimer ce produit ? Cette action est irréversible !")
    if(confirm)
	{
        let id = this.dataset.id;
        fetch(`index.php?ajax=deleteProduct&id=${id}`)
        .then( function(){
            showProductsTable(event);
        }) 
	}
}

/******************** DASHBOARD CONTACT **********************/

function showContactTable(event, id=null){
    event.preventDefault();
    fetch("index.php?ajax=contact")
    .then(response => response.text())
    .then(response => {
        document.getElementById("dashboard").innerHTML = response;
        document.querySelectorAll('.delete').forEach((product)=>{
            product.addEventListener('click', deleteContact);
        });
    });
}

function deleteContact(event)
{
    event.preventDefault();
    let confirm = window.confirm("Voulez-vous supprimer ce message ? Cette action est irréversible !")
    if(confirm)
	{
        let id = this.dataset.id;
        fetch(`index.php?ajax=deleteMessage&id=${id}`)
        .then( function(){
            showContactTable(event);
        }) 
	}
}








/********************************************************/
/*                      DOM
/********************************************************/

document.addEventListener("DOMContentLoaded",function(){
       
    document.getElementById('dashboardArtists').addEventListener('click',showArtistsTable);
    document.getElementById('dashboardAlbums').addEventListener('click',showAlbumsTable);
    document.getElementById('dashboardNews').addEventListener('click',showNewsTable);
    document.getElementById('dashboardShop').addEventListener('click',showProductsTable);
    document.getElementById('dashboardContact').addEventListener('click',showContactTable);


    /* Script pour tinyMCE*/
    tinymce.init({
        selector: 'textarea',
        
     });
    
    
});
