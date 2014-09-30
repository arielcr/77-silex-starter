<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * Home
 * 
 */
$app->get('/', function () use ($app) {

	$params = array(
			'dato' => 'data'
		);

	return $app['twig']->render('index.html', $params);  

})->bind('home');


/**
 * EJEMPLO POST 
 */
$app->post('/datos/insertar', function (Request $request) use ($app) {

	// Obtener datos del formulario
	$titulo = $request->get('nombre');

	// Obtener varios valores de la DB
	$datos = $app['db']->fetchAll("SELECT * FROM datos");

	// Obtener un valor de la DB
	$dato = $app['db']->fetchAssoc("SELECT * FROM datos WHERE id = ? AND estado = ?",array($id,'activo'));

	// Insertar en DB
	$app['db']->executeUpdate("INSERT INTO datos (titulo) VALUES (?)", array($titulo));

	// Redireccionar a ruta
	return $app->redirect($app["url_generator"]->generate("home"));

});


/**
 * EJEMPLO UPDATE
 */
$app->get('/datos/editar/{id}', function($id) use($app) { 

	$valor = $app['db']->fetchAssoc("SELECT * FROM datos WHERE id = ?",array($id));

	return $app['twig']->render('editar_dato.html', array('valor' => $valor));
    
});





