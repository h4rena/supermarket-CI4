<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Caisse::index');
$routes->get('choisir-caisse', 'Caisse::choisirPage');
$routes->post('choisir-caisse', 'Caisse::choisir');
$routes->get('saisie-achats', 'Caisse::saisieAchats');
$routes->post('ajouter-achat', 'Caisse::ajouterAchat');
$routes->post('cloturer', 'Caisse::cloturer');
$routes->get('produits', 'Caisse::produits');
$routes->get('historique', 'Caisse::historique');

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::authenticate');
$routes->get('logout', 'Auth::logout');