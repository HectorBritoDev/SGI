<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/seleccionar/proyecto/{id}', 'HomeController@selectProject');

Route::get('/reportar', 'IncidentController@create')->name('report');
Route::post('/reportar', 'IncidentController@store');

//INCIDENT
Route::get('/ver/{id}', 'IncidentController@show')->name('incident.show');
Route::get('/incidencia/{incident}/editar', 'IncidentController@edit')->name('incident.edit');
Route::post('/incidencia/{incident}/editar', 'IncidentController@update');
Route::get('/incidencia/{incident}/atender', 'IncidentController@take')->name('incident.take');
Route::get('/incidencia/{incident}/derivar', 'IncidentController@nextLevel')->name('incident.nextLevel');
Route::get('/incidencia/{incident}/resolver', 'IncidentController@solve')->name('incident.solve');
Route::get('/incidencia/{incident}/abrir', 'IncidentController@open')->name('incident.open');

//MESSAGE
Route::post('/mensajes', 'MessageController@store');

Route::group(['middleware' => 'admin', 'namespace' => 'Admin'], function () {

    //USER
    Route::get('/usuarios', 'AdminController@index')->name('supportUser.create'); //Crear USUARIOS DE SOPORTE
    Route::post('/usuarios', 'AdminController@store');
    Route::get('/usuario/{user}', 'AdminController@edit')->name('supportUser.edit'); //EDITAR USUARIOS DE SOPORTE
    Route::post('/usuario/{user}', 'AdminController@update');
    Route::get('/usuario/{user}/eliminar', 'AdminController@delete'); // ELIMINA USUARIOS DE SOPORTE

    // PROJECT
    Route::get('/proyectos', 'ProjectController@index')->name('project.create'); //CREA PROYECTOS
    Route::post('/proyectos', 'ProjectController@store');
    Route::get('/proyectos/{project}', 'ProjectController@edit')->name('project.edit'); //EDITAR PROYECTOS
    Route::post('/proyectos/{project}', 'ProjectController@update');
    Route::get('/proyectos/{project}/eliminar', 'ProjectController@delete'); // ELIMINA PROYECTOS
    Route::get('/proyectos/{id}/restaurar', 'ProjectController@restore')->name('project.restore'); // RESTAURAR PROYECTOS

    //CATEGORY
    Route::post('/categorias', 'CategoryController@store')->name('category.store');
    Route::post('/categoria/editar', 'CategoryController@update')->name('category.edit');
    Route::get('/categoria/{category}/eliminar', 'CategoryController@delete')->name('category.delete');

    //LEVEL
    Route::post('/niveles', 'LevelController@store')->name('level.store');
    Route::post('/nivel/editar', 'LevelController@update')->name('level.edit');
    Route::get('/nivel/{level}/eliminar', 'LevelController@delete')->name('level.delete');

    //PROJECT-USER
    Route::post('/proyecto-usuario', 'ProjectUserController@store')->name('projectUser.create');
    Route::post('/proyecto-usuario/update', 'ProjectUserController@update')->name('projectUser.update');
    Route::get('/proyecto-usuario/{project_user}/eliminar', 'ProjectUserController@delete')->name('projectUser.delete');

    Route::get('/config', 'ProjectController@index');

});
