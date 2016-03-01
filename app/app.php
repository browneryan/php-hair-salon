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
	   $cuisine = new Stylist($_POST['name']);
	   $cuisine->save();
	   return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
   });

   $app->post("/delete_stylists", function() use ($app) {//deletes all stylists
	   Stylist::deleteAll();
	   return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
   });

    $app->get("/stylist/{id}", function($id) use ($app){
        $stylist = Stylist::find($id);
        return $app['twig']->render("clients.html.twig", array('stylists' => $stylist));
    });

	// $app->get("/clients", function use ($app) {
	// 	$client = new Client($_POST['name']);
	// 	$client->save();
	// 	return $app['twig']->render()
	// });

	return $app;

?>
