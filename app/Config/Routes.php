<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//Home page
$routes->get('/', 'Home::index');

//Inventario
$routes->get('inventario', 'Adm\inventario::index');
$routes->post('inventario/adicionar', 'Adm\inventario::adicionar');
$routes->get('inventario/excluir/(:num)', 'Adm\inventario::excluir/$1');
$routes->post('inventario/editar/(:num)', 'Adm\inventario::editar/$1');
$routes->get('inventario/salvar', 'Adm\inventario::salvar');

//Produtos
$routes->get('produtos', 'Adm\Produto::index');
$routes->post('produtos/adicionar', 'Adm\Produto::adicionar');
$routes->get('produtos/excluir/(:num)', 'Adm\Produto::excluir/$1');
$routes->get('produtos/editar/(:num)', 'Adm\Produto::editar/$1');

//Unidades
$routes->get('unidades', 'Adm\Unidade::index');
$routes->post('unidades/adicionar', 'Adm\Unidade::adicionar');
$routes->get('unidades/excluir/(:num)', 'Adm\Unidade::excluir/$1');

//Setor
$routes->get('setor', 'Adm\Setor::index');
$routes->post('setor/adicionar', 'Adm\Setor::adicionar');
$routes->get('setor/excluir/(:num)', 'Adm\Setor::excluir/$1');

//Categorias
$routes->get('categorias', 'Adm\Categoria::index');
$routes->post('categorias/adicionar', 'Adm\Categoria::adicionar');
$routes->get('categorias/excluir/(:num)', 'Adm\Categoria::excluir/$1');

//Entrada
$routes->get('entrada', 'Adm\Entrada::index');
$routes->post('entrada/buscar', 'Adm\Entrada::buscar');

//Saida
$routes->get('saida', 'Adm\Saida::index');
$routes->get('saida/gerar', 'Adm\Saida::gerar');
$routes->post('saida/buscar', 'Adm\Saida::buscar');
$routes->get('saida/visualizar/(:num)', 'Adm\Saida::visualiza/$1');
$routes->get('saida/pdf/(:num)', 'Adm\Saida::geraPdf/$1');
$routes->post('saida/adicionar', 'Adm\Saida::adicionar');
$routes->post('saida/editar', 'Adm\Saida::editar');
$routes->get('saida/excluir/(:num)', 'Adm\Saida::excluir/$1');
$routes->get('saida/salvar', 'Adm\Saida::salvar');

//Estoque
$routes->get('estoque', 'Adm\Estoque::index');
$routes->get('estoque/pdf', 'Adm\Estoque::geraPdf');

//Ordem de Compra
$routes->get('ordem', 'Adm\Ordem::index');
$routes->get('ordem/excluir/(:num)', 'Adm\Ordem::excluir/$1');
$routes->get('ordem/editar/(:num)', 'Adm\Ordem::editar/$1');
//Gerar Ordem
$routes->get('ordem/gerar', 'Adm\Ordem::gerar');
$routes->post('ordem/adicionar/(:num)', 'Adm\Ordem::adicionar/$1');
$routes->post('ordem/adicionar', 'Adm\Ordem::adicionar');
$routes->post('ordem/salvar', 'Adm\Ordem::salvar');
$routes->get('ordem/excluiritem/(:num)', 'Adm\Ordem::excluir_item/$1');
$routes->post('ordem/editaritem/(:num)', 'Adm\Ordem::editar_item/$1');
$routes->get('ordem/emitir/(:num)', 'Adm\Ordem::emitir/$1');
//Itens da Ordem
$routes->get('item/(:num)', 'Adm\Ordem::itens/$1');
//pdf
$routes->get('item/pdf/(:num)', 'Adm\Ordem::geraPdf/$1');