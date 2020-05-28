<?php

use Illuminate\Support\Facades\Route;


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

// ROUTE FOR ADMIN ONLY
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function (){
    Route::get('/','pageController@getDashboard');
    Route::group(['prefix'=>'user'],function(){
        Route::get('list','userController@getList');
        Route::get('add','userController@getAddUser');
        Route::post('add','userController@postAddUser');
        Route::get('edit/id={id}','userController@getupdateUser');
        Route::post('edit/id={id}','userController@postupdateUser');
        Route::get('list/role={id}','userController@returnRole');
        Route::get('delete/id={id}','userController@delete');
        Route::get('find','userController@findUser');
    });
    Route::group(['prefix'=>'recipe'],function(){
        Route::get('list','recipeController@getList');
        Route::get('list/status={id}','recipeController@returnStatus');
        Route::get('add','recipeController@getAddRecipe');
        Route::post('add','recipeController@postAddRecipe');
        Route::get('find','recipeController@findRecipe');
        Route::get('find/category/id={id}','recipeController@findRecipe_Cat');
        Route::get('edit/id={id}','recipeController@getEditRecipe');
        Route::post('edit/id={id}','recipeController@EditRecipe');
        Route::get('delete/id={id}','recipeController@delete');
        Route::group(['prefix'=>'category'],function (){
            Route::get('list','categoryController@getList');
            Route::get('edit/id={id}','categoryController@getUpdateCat');
            Route::post('edit/id={id}','categoryController@updateCat');
            Route::post('list','categoryController@add');
            Route::get('delete/id={id}','categoryController@delete');
            Route::get('find','categoryController@findRecipeCat');
        });
        Route::group(['prefix'=>'tag'],function (){
            Route::get('list','tagController@getList');
            Route::get('edit/id={id}','tagController@getUpdateTag');
            Route::post('edit/id={id}','tagController@updateTag');
            Route::post('list','tagController@add');
            Route::get('delete/id={id}','tagController@delete');
            Route::get('find','tagController@findRecipeTag');
        });
        Route::group(['prefix'=>'comment'],function (){
            Route::get('list','commentController@getList');
            Route::get('edit/id={id}','commentController@getUpdateCmt');
            Route::post('edit/id={id}','commentController@updateCmt');
            Route::get('delete/id={id}','commentController@delete');
            Route::get('find','commentController@findRecipeCmt');
            Route::get('list/topic={id}','commentController@returnTopic');
        });
        Route::group(['prefix'=>'group'],function (){
            Route::get('list','groupController@getList');
            Route::post('list','groupController@add');
            Route::get('edit/id={id}','groupController@getEdit');
            Route::post('edit/id={id}','groupController@addRecipeGroup');
            Route::get('details/id={id}','groupController@groupDetails');
            Route::get('delete/id={id}','groupController@delGroup');
            Route::get('delete/{id1}/{id2}','groupController@delRecipeGroup');
            Route::get('find','groupController@findRecipeGroup');
        });

    });
    Route::group(['prefix'=>'media'],function (){
        Route::get('list','galleryController@getList');
        Route::get('upload','galleryController@getAddMedia');
        Route::post('upload','galleryController@postAddMedia');
        Route::get('edit/id={id}','galleryController@getUpdateMedia');
        Route::post('edit/id={id}','galleryController@updateMedia');
        Route::get('delete/id={id}','galleryController@delete');
        Route::get('find','galleryController@findRecipe');
    });
});
// END ROUTE FOR ADMIN

//INDEX ROUTE
Route::get('/','pageController@getIndex');

// ROUTE FOR PAGE

//LOGIN STATEMENT
Route::get('login','userController@getLogin');
Route::post('login','userController@postLogin');
Route::get('logout','userController@logout');
//END LOGIN STATEMENT

//REGISTER STATEMENT
Route::get('register','userController@getRegister');
Route::post('register','userController@postRegister');
//END REGISTER STATEMENT

//PAGE STATEMENT
Route::group(['prefix'=>'page'],function(){
    //ROUTE RETURN TAG PAGE
    Route::get('tag/{slug}','pageController@getTag');

    //ROUTE RETURN CATEGORY PAGE
    Route::get('category/{slug}','pageController@getCategory');

    //ROUTE RETURN SAVE PAGE
    Route::get('save','pageController@getSaveRecipe');

    //ROUTE RETURN MY RECIPE
    Route::get('myboard','pageController@getMyboard');
    Route::get('myboard/filter=a-z','pageController@getMyboardAlpha');
    Route::get('myboard/filter=review','pageController@getMyboardReview');

    //ROUTE DELETE MY RECIPE
    Route::get('myboard/del/recipe/{slug}','pageController@deleteMyRecipe');

    //ROUTE SAVE RECIPE ACTION
    Route::get('recipe/save/id/{id}','pageController@saveRecipe');
    //ROUTE DELETE FROM SAVE ACTION
    Route::get('save/del/recipe/{slug}','pageController@delSaveRecipe');

    //ROUTE RETURN SEARCH PAGE
    Route::get('search','pageController@getSearch');

    //RECIPE DETAILS PAGE
    Route::get('recipe/{slug}','pageController@showRecipe');

    //SHOW ALL RECIPE
    Route::get('recipe','pageController@showAllRecipe');

    //SHOW ALL COLLECTION
    Route::get('collection','pageController@getCollection');

    //ROUTE ADD RECIPE
    Route::get('upload/recipe','pageController@getUpload');
    Route::post('upload/recipe','pageController@Upload');
    //ROUTE EDIT RECIPE
    Route::get('edit/recipe/{slug}','pageController@getEditRecipe');
    Route::post('edit/recipe/{slug}','pageController@EditRecipe');
    //RETURN MY PROFILE PAGE
    Route::get('profile/{login}','pageController@getProfile');
    Route::post('profile/{login}','pageController@EditProfile');
    /////COMMENT ON RECIPE //////
    //TOPIC IS REVIEW//
    Route::post('comment/{slug}/{id}','pageController@Review');

    Route::get('idea/{slug}','pageController@getGroup');

});


