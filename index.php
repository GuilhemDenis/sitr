<?php
declare(strict_types=1);
spl_autoload_register(function ($class_name) {
    $file = lcfirst(str_replace('\\', '/', $class_name));
    include $file.".php";
});

session_start();


if (isset($_GET['page']) && !isset($_GET['ajax']))
{
	switch($_GET['page'])
	{
		case 'home':
			$controller = new Controllers\HomeController();
			$controller -> display();
			break;

		case 'admin':
			$controller = new Controllers\AdminController();
			$controller -> display();
			break;

		case 'dashboard':
			$controller = new Controllers\DashboardController();
			$controller -> display();
			break;

		case 'catalogue':
			$controller = new Controllers\CatalogueController();
			$controller -> display();
			break;

		case 'artists':
			$controller = new Controllers\ArtistsController();
			$controller -> display();
			break;

		case 'news':
			$controller = new Controllers\NewsController();
			$controller -> display();
			break;

		case 'album':
			$controller = new Controllers\AlbumPageController();
			$controller -> display();
			break;

		case 'artist':
			$controller = new Controllers\ArtistPageController();
			$controller -> display();
			break;
	

		case 'search':
			$controller = new Controllers\SearchController();
			$controller -> display();
			break;

		case 'contact':
			$controller = new Controllers\ContactController();
			$controller -> display();
			break;
		
		//envoi d'un message de contact
		case 'newMessage':
			$controller = new Controllers\ContactController();
			$controller -> newMessage();
			break;


		case 'shop':
			$controller = new Controllers\ShopController();
			$controller -> display();
			break;

		case 'product':
			$controller = new Controllers\ProductPageController();
			$controller -> display();
			break;

		case 'cart':
			$controller = new Controllers\CartController();
			$controller -> display();
			break;
	}
}
else if (isset($_GET['ajax']))
{
	switch($_GET['ajax'])
	{
		//dashboard artistes
		case 'artists':
			$controller = new Controllers\DashboardArtistsController();
			$controller -> display();
			break;
		case 'addArtist':
			$controller = new Controllers\DashboardArtistsController();
			$controller -> add();
			break;
		case 'deleteArtist':
			$controller = new Controllers\DashboardArtistsController();
			$controller -> delete();
			break;
		case 'editArtist':
			$controller = new Controllers\DashboardArtistsController();
			$controller -> edit();
			break;

		//dasboard albums
		case 'albums':
			$controller = new Controllers\DashboardAlbumsController();
			$controller -> display();
			break;
		case 'addAlbum':
			$controller = new Controllers\DashboardAlbumsController();
			$controller -> add();
			break;
		case 'deleteAlbum':
			$controller = new Controllers\DashboardAlbumsController();
			$controller -> delete();
			break;
		case 'editAlbum':
			$controller = new Controllers\DashboardAlbumsController();
			$controller -> edit();
			break;

		//dasboard news
		case 'news':
			$controller = new Controllers\DashboardNewsController();
			$controller -> display();
			break;
		case 'addNews':
			$controller = new Controllers\DashboardNewsController();
			$controller -> add();
			break;
		case 'deleteNews':
			$controller = new Controllers\DashboardNewsController();
			$controller -> delete();
			break;
		case 'editNews':
			$controller = new Controllers\DashboardNewsController();
			$controller -> edit();
			break;

		//dasboard shop
		case 'products':
			$controller = new Controllers\DashboardShopController();
			$controller -> display();
			break;
		case 'addProduct':
			$controller = new Controllers\DashboardShopController();
			$controller -> add();
			break;
		case 'deleteProduct':
			$controller = new Controllers\DashboardShopController();
			$controller -> delete();
			break;
		case 'editProduct':
			$controller = new Controllers\DashboardShopController();
			$controller -> edit();
			break;

		//dasboard contact
		case 'contact':
			$controller = new Controllers\DashboardContactController();
			$controller -> display();
			break;
		case 'deleteMessage':
			$controller = new Controllers\DashboardContactController();
			$controller -> delete();
			break;
		
	}
}
else
{
	$controller = new Controllers\HomeController();
	$controller -> display();
}