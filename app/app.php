<?php

	require_once __DIR__.'/../vendor/autoload.php';
	require_once __DIR__.'/../src/Client.php';
	require_once __DIR__.'/../src/Stylist.php';

	$app = new Silex\Application();

	$server = 'mysql:host=localhost;dbname=hair_salon';
	$username = 'root';
	$password = 'root';
	$DB = new PDO($server, $username, $password);

	$app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

	use Symfony\Component\HttpFoundation\Request;
	Request::enableHttpMethodParameterOverride();

	$app->get('/', function() use ($app) {
		return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
	});

	$app->post("/stylists", function() use ($app) {//displays stylists on index
	   $new_stylist = new Stylist($_POST['name']);
	   $new_stylist->save();
	   return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
   });

   $app->post("/delete_stylists", function() use ($app) {//deletes all stylists
	   Stylist::deleteAll();
	   return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
   });

    $app->get("/stylist/{id}", function($id) use ($app){
        $stylist = Stylist::find($id);
        return $app['twig']->render("clients.html.twig", array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

	$app->post("/clients", function() use ($app) {
        $name = $_POST['name'];
		$stylist_id = $_POST['stylist_id'];
        $client = new Client($name, $id = null, $stylist_id);
        $client->save();
		$stylist = Stylist::find($stylist_id);
        return $app['twig']->render('clients.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

	$app->get("/clients/{id}/edit", function($id) use ($app) {
        $client = Client::find($id);
        return $app['twig']->render('client_edit.html.twig', array('client' => $client));
    });

	$app->patch("/clients/{id}/client_name", function($id) use ($app) {
        $new_name = $_POST['client_name'];
        $client = Client::find($id);
        $client->update($new_name);
        $stylist_id = $client->getStylistId();
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render('clients.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
        });

	$app->get("/stylists/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist_edit.html.twig', array('stylist' => $stylist));
    });

	$app->patch("/stylists/{id}/stylist_name", function($id) use ($app) {
        $new_name = $_POST['stylist_name'];
        $stylist = Stylist::find($id);
        $stylist->update($new_name);
        return $app['twig']->render('clients.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
        });

	$app->delete("/stylist/{id}/delete", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()
        ));
    });

	return $app;

?>
