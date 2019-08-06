<?php

Route::group(['middleware' => ['web','auth'] ], function() {

    Route::get('/', 'AdminController@index');

    /* ================== Menu Admin ================== */
    Route::resource('menus', MenuController::class);
    Route::delete('/ajax/menu_del/{id}', 'MenuController@ajax_del');
    Route::put('/ajax/menu_edit/{id}', 'MenuController@ajax_edit');

    /* ================== Setting Admin ================== */
    Route::resource('settings', SettingController::class);
    Route::post('settings', 'SettingController@update');

    /* ================== Configs Admin ================== */
    Route::resource('configs', ConfigController::class);

    /* ================== Roles ================== */
    Route::resource('role', RoleController::class);
    Route::delete('/ajax/role_del/{id}', 'RoleController@ajax_del');
    Route::get('/ajax/unique_name', 'RoleController@ajax_check_name');

    /* ================== Menu Groups ================== */
    Route::resource('menugroups', MenugroupController::class);
    Route::delete('/ajax/menugroup_del/{id}', 'MenugroupController@ajax_del');
    Route::get('/ajax/unique_key', 'MenugroupController@ajax_check_key');
    Route::put('/ajax/status_menugroup/{id}', 'MenugroupController@ajax_status');

    /* ================== Menu List ================== */
    Route::resource('menulists', MenulistController::class);
    Route::delete('/ajax/menulist_del/{id}', 'MenulistController@ajax_del');
    Route::get('/ajax/unique_url', 'MenulistController@ajax_check_url');
    Route::put('/ajax/status_menulist/{id}', 'MenulistController@ajax_status');

    /* ================== Page ================== */
    Route::resource('pages', PageController::class);
    Route::delete('/ajax/page_del/{id}', 'PageController@ajax_del');

    /* ================== Contact Admin ================== */
    Route::resource('contacts', ContactController::class);
    Route::put('/ajax/contact_status/{id}', 'ContactController@ajaxStauts');
    Route::delete('/ajax/contact_del/{id}', 'ContactController@ajaxDelContact');

    /* ================== Contact Admin ================== */
    Route::resource('comments', CommentController::class);
    Route::put('/ajax/comments_status/{id}', 'CommentController@ajaxStauts');
    Route::delete('/ajax/comments_del/{id}', 'CommentController@ajaxDelComment');

    /* ================== Slider Admin ================== */
    Route::resource('sliders', SliderController::class);
    Route::get('/ajax/unique_slider_key', 'SliderController@ajaxUniqueKey');
    Route::put('/ajax/slider_status/{id}', 'SliderController@ajaxStauts');
    Route::put('/ajax/slider_del/{id}', 'SliderController@ajaxDelSlider');

    /* ================== SliderImages Admin ================== */
    Route::resource('sliderimages', SliderimageController::class);
    Route::put('/ajax/sliderimages_del/{id}', 'SliderimageController@ajaxDelSliderImages');
    
    /* ================== Categories ================== */
    Route::resource('categories', CategoryController::class);
    Route::delete('/ajax/categories_del/{id}', 'CategoryController@ajaxDel');
    Route::get('/ajax/category_unique_slug', 'CategoryController@ajaxCheckSlug');
    Route::put('/ajax/status_categories/{id}', 'CategoryController@ajaxStatus');

    /* ================== Post ================== */
    Route::resource('listposts', PostController::class);
    Route::delete('/ajax/posts_del/{id}', 'PostController@ajaxDel');
    Route::get('/ajax/posts_unique_slug', 'PostController@ajaxCheckSlug');
    Route::put('/ajax/status_posts/{id}', 'PostController@ajaxStatus');
    Route::get('/ajax/search-posts', 'PostController@ajaxSearch');
    
    /* ================== Users Admin ================== */
    Route::resource('users', UserController::class);
    Route::put('/ajax/user_status/{id}', 'UserController@ajaxStauts');
    Route::get('/ajax/user_unique_email/', 'UserController@ajaxUniqueEmail');
    Route::delete('/ajax/user_del/{id}', 'UserController@ajaxDel');

    // change password
    Route::put('change_password', 'UserController@changePassword')->name('change_password');


//    /* ================== Login Admin ================== */
//    Route::get('/login', 'Auth\LoginController@login')->name('login');
//    Route::post('/login', 'Auth\LoginController@postLogin')->name('admin.login');
//    Route::get('/logout', 'Auth\LoginController@logout');

});
