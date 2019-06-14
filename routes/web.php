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
/**
 * Admin Panel Routes
 */
 //language route
Route::get('lang/{code}', ['as' => 'lang', 'uses' => 'LocaleController@getLang']);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    /**
     * Authentication routes
     */
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::get('/', 'AuthController@getIndex');
        Route::get('/login', 'AuthController@getIndex');
        Route::post('/login', 'AuthController@postLogin')->name('admin.login');
        Route::get('/logout', 'AuthController@getLogout')->name('admin.logout');
        Route::get('/recover-password', 'AuthController@getRecoverPassword');
        Route::post('/recover-password', 'AuthController@postRecoverPassword');
        Route::get('/change-password/{hash}', 'AuthController@getChangePassword');
        Route::post('/change-password', 'AuthController@postChangePassword');
    });

    /**
     * Private Routes
     */
    Route::group(['middleware' => 'auth.admin'], function() {
        /**
         * Home Routes
         */
        Route::get('/', function() {
            return view('admin.pages.home');
        });

       /**
        * Public Admin Panel Settings
        */
        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', 'SettingsController@getIndex')->name('admin.settings');
            Route::post('/edit', 'SettingsController@postEdit')->name('admin.settings.edit');
        });
          /**
         * Slider Route
         */
        Route::group(['prefix' => 'slider'], function () {
            Route::get('/','SliderController@getIndex')->name('admin.slider');
            Route::post('/','SliderController@postIndex')->name('admin.slider.add');
            Route::get('/edit/{id}','SliderController@getEdit')->name('admin.slider.edit');
            Route::post('/update/{id}', 'SliderController@postUpdate')->name('admin.slider.update');
            Route::get('/delete/{id}','SliderController@getDelete')->name('admin.slider.delete');
        });
        
        /**
        * about
        */
        Route::group(['prefix' => 'about'], function () {
            Route::get('/', 'AboutController@getIndex')->name('admin.about');
            Route::post('info', 'AboutController@postInfo')->name('admin.about.info');
            Route::get('/translate', 'AboutController@getTranslate');
            Route::post('/edit', 'AboutController@postEdit')->name('admin.about.edit');
            Route::post('/trans', 'AboutController@postTranslate')->name('admin.about.translate');
        });

        /**
         * statics Route
         */
        Route::group(['prefix' => 'statics'], function () {
            Route::get('/', 'StaticController@getIndex')->name('admin.static.index');
            Route::get('info/{id}', 'StaticController@getInfo')->name('admin.static.info');
            Route::post('/edit', 'StaticController@postEdit')->name('admin.static.edit');
            Route::get('/translate', 'StaticController@getTranslate');
        });

        /**
         * Abd El-ghany
         */

        /**
         * Admin Features
         */
        Route::group(['prefix' => 'features'], function () {
           Route::get('/',['as'=>'admin.features','uses'=>'FeatureController@getIndex']);
           Route::post('/',['as'=>'admin.addFeature','uses'=>'FeatureController@postIndex']);
           Route::get('/edit/{id}',['as'=>'admin.editFeature','uses'=>'FeatureController@getEdit']);
           Route::post('/update',['as'=>'admin.updateFeature','uses'=>'FeatureController@postUpdate']);
           Route::post('/trans',['as'=>'admin.transFeature','uses'=>'FeatureController@postTrans']);

           Route::get('/delete/{id}',['as'=>'admin.deleteFeature','uses'=>'FeatureController@getDelete']);
        });

        /**
         * Admin Features
         */
        Route::group(['prefix' => 'contact-us'], function () {
            Route::get('/', ['as' => 'admin.contact', 'uses' => 'ContactController@getIndex']);
            Route::post('/', ['as' => 'admin.contact', 'uses' => 'ContactController@postIndex']);
            Route::get('/edit/{id}', ['as' => 'contactEdit', 'uses' => 'ContactController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'contactEdit', 'uses' => 'ContactController@postEdit']);
            Route::post('/trans', ['as' => 'contacttrans', 'uses' => 'ContactController@postTrans']);
            Route::get('/delete/{id}', ['as' => 'contactDelete', 'uses' => 'ContactController@getDelete']);
        });

        //gallery routes
         Route::group(['prefix' => 'gallery'], function () {
            Route::get('/',['as'=>'admin.gallery' ,'uses'=>'GalleryController@getIndex']);
            Route::post('/add',['as'=>'gallery.add' ,'uses'=>'GalleryController@postAdd']);
            Route::get('/edit/{id}',['as'=>'gallery.edit' ,'uses'=>'GalleryController@getEdit']);
            Route::post('/update/{id}', ['as' => 'gallery.update', 'uses' => 'GalleryController@postEdit']);
            Route::post('/upload', 'GalleryController@dropzoneStore')
            ->name('admin.gallery.dropzoneStore');
            Route::get('/delete/{id}', ['as' => 'galleryDelete', 'uses' => 'GalleryController@getDelete']);
        });


        //Messages routes
        Route::group(['prefix' => 'messages'], function () {
            Route::get('/', ['as' => 'admin.messages', 'uses' => 'MessageController@getIndex']);
            Route::get('/search/{q?}', 'MessageController@getSearch');
            Route::post('/action/{action}', 'MessageController@postAction');
            Route::get('/filter/{filter}', 'MessageController@getFilter');
        });

        /**
         * Admin Testmonials
         */
        Route::group(['prefix' => 'testmonials'], function () {
            Route::get('/',['as'=>'admin.testmonials','uses'=>'TestmonialController@getIndex']);
            Route::post('/',['as'=>'admin.addTestmonial','uses'=>'TestmonialController@postIndex']);
            Route::get('/edit/{id}',['as'=>'admin.editTestmonial','uses'=>'TestmonialController@getEdit']);
            Route::post('/update',['as'=>'admin.updateTestmonial','uses'=>'TestmonialController@postUpdate']);
            Route::post('/trans',['as'=>'admin.transTestmonial','uses'=>'TestmonialController@postTrans']);

            Route::get('/delete/{id}',['as'=>'admin.deleteTestmonial','uses'=>'TestmonialController@getDelete']);
        });

         /*
         * tour category trips
         */
        Route::group(['prefix' => 'tours'] ,function (){
            Route::get('/{slug}' , ['as' => 'admin.tours' ,'uses' => 'TourController@getIndex']);
            Route::post('/{slug}' , ['as' => 'admin.tours' ,'uses' => 'TourController@postIndex']);
            Route::post('/tours/trans' ,['as' => 'admin.tourTrip' , 'uses' => 'TourController@postTrans']);
            Route::get('/delete/{id}' ,['as' => 'deleteTourTrip' ,'uses' => 'TourController@getDelete']);
            Route::post('/tours/prices' ,['as' => 'tourPrice' ,'uses' => 'TourController@postPrices']);
            Route::post('tours/edit' ,['as' => 'editTourPrice' ,'uses' => 'TourController@postEditPrice']);
            Route::get('/edit/{id}' ,['as' => 'tourEdit' ,'uses' => 'TourController@getEdit']);
            Route::post('/edit/{id}' ,['as' => 'tourEdit' ,'uses' => 'TourController@postEdit']);
            Route::post('/delete-image/{trip_id}/{image_id}', 'TourController@postDeleteImage')
            ->name('admin.tours.images.delete');
        });


        /*
         * admin trips
         */
        
        Route::group(['prefix' => 'trips'] ,function (){
            Route::get('/{slug}' , ['as' => 'admin.trips' ,'uses' => 'TripController@getIndex']);
            Route::post('/{slug}' , ['as' => 'admin.trips' ,'uses' => 'TripController@postIndex']);
            Route::post('/dayCruiseTrip/trans' ,['as' => 'admin.dayCruiseTrip' , 'uses' => 'TripController@postTrans']);
            Route::get('/delete/{id}' ,['as' => 'deleteDayCruiseTrip' ,'uses' => 'TripController@getDelete']);
            Route::post('/dayCruiseTrip/prices' ,['as' => 'tripPrice' ,'uses' => 'TripController@postPrices']);
            Route::post('prices/edit' ,['as' => 'editTripPrice' ,'uses' => 'TripController@postEditPrice']);
            Route::get('/edit/{id}' ,['as' => 'tripEdit' ,'uses' => 'TripController@getEdit']);
            Route::post('/edit/{id}' ,['as' => 'tripEdit' ,'uses' => 'TripController@postEdit']);
            Route::post('/delete-image/{trip_id}/{image_id}', 'TripController@postDeleteImage')
            ->name('admin.trips.images.delete');
        });

         //Cabines and dropzone routes
        Route::group(['prefix' => 'cars'] ,function (){
            Route::get('/{slug}' ,'CarController@getIndex')->name('admin.cars');
            Route::post('add/{slug}' , 'CarController@postAdd')->name('admin.cars.add');
            Route::get('/edit/{id}','CarController@getEdit');
            Route::post('edit/{id}','CarController@postEdit')->name('admin.cars.edit');
            Route::post('trans','CarController@postTranslate')->name('admin.cars.translate');
            Route::post('cars/prices','CarController@postPrice');
            Route::post('edit-price','CarController@postEditPrice')->name('admin.cars.editPrice');
            Route::get('/delete/{id}','CarController@getDelete')->name('admin.cars.delete');
            Route::post('/delete-image/{trip_id}/{image_id}', 'CarController@postDeleteImage')->name('admin.cars.images.delete');
        });
        //Cabines and dropzone routes
        Route::group(['prefix' => 'cabines'] ,function (){
            Route::get('/{slug}' ,'CabineController@getIndex')->name('admin.cabines');
            Route::get('add/{slug}/' ,'CabineController@getAdd')->name('admin.cabines.add');
            Route::post('add/{slug}' , 'CabineController@postAdd')->name('admin.cabines.add');
            Route::post('trans','CabineController@postTranslate')->name('admin.cabines.translate');
            Route::get('/edit/{id}','CabineController@getEdit');
            Route::post('edit/{id}','CabineController@postEdit')->name('admin.cabines.edit');
            Route::post('cabine/prices','CabineController@postPrice');
            Route::post('edit-price','CabineController@postEditPrice')
            ->name('admin.cabines.editPrice');
            Route::get('/delete/{id}','CabineController@getDelete')->name('admin.cabines.delete');
            Route::post('/delete-image/{trip_id}/{image_id}', 'CabineController@postDeleteImage')->name('admin.cabines.images.delete');
        });
        Route::post('/upload', 'CabineController@dropzoneStore')->name('admin.cabines.dropzoneStore');
        Route::post('/deleteDropzoneImage', 'CabineController@dropzoneDelete')
        ->name('admin.cabines.dropzoneDelete');

        /*
         * Hotel category trips
         * Abd El Ghany
         */
        Route::group(['prefix' => 'hotels'] ,function (){
            Route::get('/{slug}' , ['as' => 'admin.hotels' ,'uses' => 'HotelController@getIndex']);
            Route::post('/{slug}' , ['as' => 'admin.hotels' ,'uses' => 'HotelController@postIndex']);
            Route::post('/{slug}/insertView' , ['as' => 'admin.insertView' ,'uses' => 'HotelController@insertView']);
            Route::post('/hotel/trans' ,['as' => 'admin.hotelTrans' , 'uses' => 'HotelController@postTrans']);
            Route::get('/delete/{id}' ,['as' => 'admin.hotelDelete' ,'uses' => 'HotelController@getDelete']);
            Route::post('/hotel/prices' ,['as' => 'admin.hotelPrice' ,'uses' => 'HotelController@getPrices']);
            Route::post('hotel/update' ,['as' => 'admin.hotelPriceUpdate' ,'uses' => 'HotelController@postPrice']);
            Route::get('/edit/{id}' ,['as' => 'admin.hotelEdit' ,'uses' => 'HotelController@getEdit']);
            Route::post('/update/{id}' ,['as' => 'admin.hotelUpdate' ,'uses' => 'HotelController@postEdit']);
            Route::post('/delete-image/{trip_id}/{image_id}', 'HotelController@postDeleteImage')->name('admin.hotel.images.delete');
        });

        /**
        * places Routes
        */
        Route::group(['prefix' => 'places'], function () {
            Route::get('/', 'PlaceController@getIndex')->name('admin.places');
            Route::post('add', 'PlaceController@postAdd')->name('admin.places.add');
            Route::get('/edit/{id}','PlaceController@getEdit');
            Route::post('/edit/{id}','PlaceController@postEdit')->name('admin.places.edit');
            Route::post('trans','PlaceController@postTranslate')->name('admin.places.translate');
            Route::get('/delete/{id}', 'PlaceController@getDelete')->name('admin.places.delete');
        });

        /**
        * views Routes
        */
        Route::group(['prefix' => 'views'], function () {
            Route::get('/', 'ViewController@getIndex')->name('admin.views');
            Route::post('add', 'ViewController@postAdd')->name('admin.views.add');
            Route::get('/edit/{id}','ViewController@getEdit');
            Route::post('/edit/{id}','ViewController@postEdit')->name('admin.views.edit');
            Route::post('trans','ViewController@postTranslate')->name('admin.views.translate');
            Route::get('/delete/{id}', 'ViewController@getDelete')->name('admin.views.delete');
        });

        /**
        * subscribtions routes
        */
        Route::group(['prefix' => 'subscribtions'], function () {
            Route::get('/', 'SubscribtionController@getIndex')->name('admin.subscribtions.index');
            // Route::get('view/{id}', 'SubscribtionController@getView')
            // ->name('admin.subscribtions.view');
            Route::post('/send','SubscribtionController@postSend')
            ->name('admin.subscribtions.send');
            Route::post('/action/{action}', 'SubscribtionController@postAction');
            Route::get('/filter/{filter}', 'SubscribtionController@getFilter');
            Route::get('/search/{q?}', 'SubscribtionController@getSearch');
            Route::get('/delete/{id}', 'SubscribtionController@getDelete')->name('admin.subscribtions.delete');
            
        });
        
        /**
        * booking routes
        */
        Route::group(['prefix' => 'booking'], function () {
            Route::get('/', 'BookingController@getIndex')->name('admin.booking.index');
            Route::get('/view/{id}', 'BookingController@getView')->name('admin.booking.view');
        });
    });
});
/*
 * site routes
 */
   
Route::group(['namespace' => 'Site'], function () {

    Route::get('/login', 'Auth\AuthController@getLogin')->name('site.pages.login');
    Route::post('login', ['as' => 'login', 'uses' => 'Auth\AuthController@postLogin']);
 
    Route::get('/register', 'Auth\AuthController@getRegister')->name('site.pages.register');
    Route::post('/register', 'Auth\AuthController@postRegister');

    Route::get('/logout', 'Auth\AuthController@getLogout')->name('site.pages.logout');

  // Route::get('/{provider}', 'Auth\AuthController@redirectToProvider')
    //->name('site.login.social');
    //Route::get('/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

    Route::get('/recover-password', 'Auth\AuthController@getRecoverPassword')
    ->name('site.pages.forget-password');
    Route::post('recover-password', 'Auth\AuthController@postRecoverPassword')
    ->name('site.pages.recover-password');

    Route::get('/change-password/{hash}', 'Auth\AuthController@getChangePassword')
    ->name('site.pages.change-password');
    Route::post('change-password', 'Auth\AuthController@postChangePassword')
    ->name('site.pages.change-password');
    
    Route::get('/', ['as' => 'site.home', 'uses' => 'HomeController@getIndex']);
    Route::post('/subscribe',['as' => 'site.subscribe','uses' => 'HomeController@postSubscribe']);

    // profile , wishlist , items
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', ['as' => 'site.profile' ,'uses' => 'ProfileController@getIndex']);
        Route::post('/add', ['as' => 'site.profileAdd' ,'uses' => 'ProfileController@postIndex']);
        Route::get('/items', ['as' => 'site.items', 'uses' => 'ProfileController@getItems']);
        Route::get('/wishlist', ['as' =>'site.wishlist', 'uses' => 'ProfileController@getWishlist']);
        Route::post('/wishlist/delete/{id}', ['as' => 'site.wishlistDelete', 'uses' => 'ProfileController@postWishlistDelete']);
    });
    //about us
    Route::group(['prefix' => 'about'], function () {
        Route::get('/', 'AboutController@getIndex')->name('site.about');
    });

    //about us
    Route::group(['prefix' => 'tags'], function () {
        Route::get('/{tag}', 'TagController@getIndex')->name('site.tags');
    });

    //search routes
//    Route::get('/global-search', 'SearchController@getGlobalSearch')->name('site.pages.search');


    Route::group(['prefix' => 'trips'], function () {
        Route::get('/one-trip/{slug}', 'TripController@getTripDetails')->name('site.trips.one-trip');
    });

    Route::group(['prefix' => 'gallery'], function () {
        Route::get('/gallery', ['as' => 'gallery', 'uses' => 'GalleryController@getIndex']);
    });

    Route::group(['prefix' => 'Category'], function (){
       Route::get('/{slug}' ,['as' => 'site.category' ,'uses' => 'SingleCategoryController@getIndex']);
    });

    Route::group(['prefix' => 'Search'], function (){
        Route::get('/' ,['as' => 'globalSearch' ,'uses' => 'SearchController@getGlobalSearch']);
        Route::get('/search', 'SearchController@getPlaceSearch')->name('site.pages.place-search');
    });

    Route::group(['prefix' => 'Contact'], function (){
        Route::get('/' ,['as' => 'site.contact' ,'uses' => 'ContactController@getIndex']);
        Route::post('/' ,['as' => 'site.contact' ,'uses' => 'ContactController@postIndex']);
    });

    Route::post('wishlist', ['as' => 'wishlist', 'uses' => 'TripController@postWishlist']);
    Route::post('postReview' ,['as' => 'postReview' ,'uses' => 'TripController@postReview']);

    Route::group(['prefix' => 'booking'],function (){
        Route::get('/{slug}',['as' => 'booking' ,'uses' => 'BookingController@getIndex']);
        Route::post('/booking/price' ,['as' => 'booking.price' ,'uses' => 'BookingController@postDate']);
//         check Price
        Route::post('/checkPrice/',['as'=>'site.checkPrice','uses'=>'PayPalController@insertData']);        
    });

    Route::group(['prefix' => 'payment'], function (){
        Route::post('/', 'PayPalController@getCheckout')->name('site.payment');
        Route::post('/done',['as'=>'site.getDone','uses'=>'PayPalController@getDone']);
        Route::get('/cancel',['as'=>'site.getCancel','uses'=>'PayPalController@getCancel']);
    });

});
