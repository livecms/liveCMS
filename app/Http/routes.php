<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
liveCMSRouter($router, function ($router, $adminSlug, $subDomain, $subFolder) {

    // ADMIN AREA

    $router->group(['prefix' => $adminSlug, 'namespace' => 'Backend', 'middleware' => 'auth'], function ($router) {
        
        $articleSlug            = globalParams('slug_article', config('livecms.slugs.article'));
        $categorySlug           = globalParams('slug_category', config('livecms.slugs.category'));
        $tagSlug                = globalParams('slug_tag', config('livecms.slugs.tag'));
        $staticpageSlug         = globalParams('slug_staticpage', config('livecms.slugs.staticpage'));
        $teamSlug               = globalParams('slug_team', config('livecms.slugs.team'));
        $projectSlug            = globalParams('slug_project', config('livecms.slugs.project'));
        $clientSlug             = globalParams('slug_client', config('livecms.slugs.client'));
        $projectCategorySlug    = globalParams('slug_projectcategory', config('livecms.slugs.projectcategory'));
        $gallerySlug            = globalParams('slug_gallery', config('livecms.slugs.gallery'));
        $contactSlug            = globalParams('slug_contact', config('livecms.slugs.contact'));

        $router->resource($categorySlug, 'CategoryController');
        $router->resource($tagSlug, 'TagController');
        $router->resource($articleSlug, 'ArticleController');
        $router->resource($staticpageSlug, 'StaticPageController');
        $router->resource($teamSlug, 'TeamController');
        $router->resource($projectSlug, 'ProjectController');
        $router->resource($projectCategorySlug, 'ProjectCategoryController');
        $router->resource($clientSlug, 'ClientController');
        $router->resource($gallerySlug, 'GalleryController');
        $router->resource($contactSlug, 'ContactController');

    });

    // FRONTEND
    $router->group(['namespace' => 'Frontend'], function ($router) {
        $router->get('{arg0?}/{arg1?}/{arg2?}/{arg3?}/{arg4?}/{arg5?}', 'PageController@routes');
    });

});
