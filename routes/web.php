<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */

// Route::get('/', function () {
//     return view('welcome');
// });
// 
Route::get('clear_cache', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
   
    echo 'ok';
    //dd("Cache, view, config and route  are clears");
});


Route::get('/bulk_search', function () {
    return view('domain_search.bulk_domain_search');
});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

// Route::group(['namespace' => 'Admin'], function () {
Route::group(['namespace' => 'Admin', 'middleware' => 'noCache'], function () {
    Route::get('/web88/admin/', 'UsersController@index');
    Route::get('/admin/icons', 'ServicesController@show_icons');
    Route::get('/test', 'CategoriesController@rename_slug');
    Route::post('/auth/login', 'AuthController@doLogin');
    Route::get('/web88/admin/login', 'AuthController@admin_login');
    Route::get('/web88/admin/logout', 'AuthController@admin_logout');
    Route::get('users', 'UsersController@generate_password');
    Route::POST('/admin/get_user_details/', 'UsersController@get_users');
    Route::POST('change_password', 'AuthController@change_password');
    Route::POST('generate_password', 'UsersController@generate_password');
    Route::POST('reset_password', 'AuthController@reset_password');
    Route::get('admin/get_video/{id}', 'IndexPlanController@get_video');
    Route::POST('admin/delete_video', 'IndexPlanController@delete_video');
    Route::POST('admin/save_video', 'IndexPlanController@save_video');
    Route::get('admin/get_video/{id}', 'IndexPlanController@get_video');
    Route::POST('admin/delete_feature_plan', 'ServicesController@delete_feature_plan');
    Route::POST('admin/delete_feature_plan_detail', 'ServicesController@delete_feature_plan_detail');
    Route::POST('admin/save_feature_plan_detail', 'ServicesController@save_feature_plan_detail');
    Route::resource('admin/index-plan', 'IndexPlanController');
    Route::POST('admin/index-plan/{plan_id}/addfeature/{feature_id?}', 'IndexPlanController@saveFeature')->name('admin.index-plan.feature.save');
    Route::POST('admin/index-plan/{plan_id}/deletefeature/{feature_id?}', 'IndexPlanController@deleteFeature')->name('admin.index-plan.feature.delete');
    Route::get('/admin/users', 'UsersController@getUsersByAccountType');

    Route::group(
        [
            'prefix' => 'admin/develop/',
        ],
        function () {
            Route::match(['get', 'post'], 'artisan', 'ArtisanController@index')
                ->name('develop.artisan.commands');
        }
    );

    Route::group(['prefix' => 'admin/index-plan/'], function () {
        Route::POST('/delete', 'IndexPlanController@delete');
        Route::POST('image_update', 'IndexPlanController@image_update');
        Route::POST('get_index_plan_details/', 'IndexPlanController@get_index_plan_details');
        Route::POST('get_testimonial_details/', 'IndexPlanController@get_testimonial_details');
        Route::POST('get_videos_details/', 'IndexPlanController@get_videos_details');
        Route::POST('update_sort/', 'IndexPlanController@update_sort');
        Route::POST('update_sort_offer_services/', 'IndexPlanController@update_sort_offer_services');
        Route::POST('cms_update/', 'IndexPlanController@cms_update');
        Route::POST('new_testimonial/', 'IndexPlanController@new_testimonial');
        Route::POST('delete_testimonial/', 'IndexPlanController@delete_testimonial');
        Route::POST('new_service/', 'IndexPlanController@new_service');
        Route::POST('delete_service/', 'IndexPlanController@delete_service');
        Route::POST('get_service/', 'IndexPlanController@get_service');
        Route::POST('heading_edit/{type?}', 'IndexPlanController@heading_edit');
    });
    Route::group(['prefix' => 'admin/cloud_hosting/'], function () {
        Route::get('/', 'CloudHostingController@index');
        Route::get('/new', 'CloudHostingController@create');
        Route::post('/new', 'CloudHostingController@store');
        Route::post('/new_plan', 'CloudHostingController@cloud_hosting_plan');
        Route::get('/edit/{id}', 'CloudHostingController@edit');
        Route::POST('get_details/', 'CloudHostingController@get_details');
        Route::POST('get_details_hp/', 'CloudHostingController@get_details_hp');
        Route::post('/update', 'CloudHostingController@update');
        Route::post('/update_cloud_hosting_plan/{id}', 'CloudHostingController@update_cloud_hosting_plan');
        Route::POST('/delete', 'CloudHostingController@delete');
        Route::POST('/delete_hp', 'CloudHostingController@delete_hp');
        Route::POST('image_update', 'IndexPlanController@image_update');
        Route::POST('get_index_plan_details/', 'IndexPlanController@get_index_plan_details');
        Route::POST('update_sort/', 'CloudHostingController@update_sort');
        Route::POST('cms_update/', 'IndexPlanController@cms_update');
        Route::POST('/delete_all_plans', 'CloudHostingController@delete_all_plans');
    });

    Route::group(['prefix' => 'admin/services'], function () {
        Route::GET('/domain-main-page', 'ServicesController@getDomainMainPage')->name('edit_domain_main_page');
        Route::POST('/domain-main-page', 'ServicesController@saveDomainMainPage')->name('save_domain_main_page');
        // Added by mrloffel
        Route::POST('/domain-main-page-preview', 'ServicesController@previewDomainMainPage')->name('preview_domain_main_page');
        Route::GET('/single-domain-tranfser-edit', 'ServicesController@getSingleTransferPage')->name('edit_single_domain_transfer_page');
        Route::POST('/single-domain-tranfser-edit', 'ServicesController@saveSingleTransferPage')->name('save_single_domain_transfer_page');
        Route::POST('/single-domain-transfer-add-feature', 'ServicesController@addFeatureSingleTransferPage')->name('add_feature_single_transfer_page');
        Route::POST('/single-domain-transfer-update-feature', 'ServicesController@updateFeatureSingleTransferPage')->name('update_feature_single_transfer_page');
        Route::post('/single-domain-transfer-delete-feature', 'ServicesController@deleteFeatureSingleTransferPage')->name('delete_feature_single_transfer_page');
        // End
        Route::get('/{page}', 'ServicesController@index')->name('service-page');
        Route::POST('/pf_details', 'ServicesController@add_pf_details');
        Route::POST('/delete_pf_detail', 'ServicesController@delete_pf_detail');
        Route::POST('/get_details_pf_detail', 'ServicesController@get_details_pf_detail');
        Route::get('/new/{page}', 'ServicesController@add_hosting_plan');
        Route::post('/new/{page}', 'ServicesController@store');
        Route::post('/new_hosting_plan', 'ServicesController@hosting_plan');
        Route::get('/edit/{id}/{page}', 'ServicesController@edit');
        Route::POST('get_details/', 'ServicesController@get_details');
        Route::POST('get_details_hp/', 'ServicesController@get_details_hp');
        Route::post('/update', 'ServicesController@update');
        Route::post('/update_hosting_plan/{id}', 'ServicesController@update_hosting_plan');
        Route::POST('/feature_plan_delete', 'ServicesController@feature_plan_delete');
        Route::POST('/delete_hp', 'ServicesController@delete_hp');
        Route::POST('image_update', 'IndexPlanController@image_update');
        Route::POST('get_index_plan_details/', 'IndexPlanController@get_index_plan_details');
        Route::POST('update_sort/', 'CloudHostingController@update_sort');
        Route::POST('cms_update/', 'IndexPlanController@cms_update');
        Route::POST('/delete_all_plans', 'CloudHostingController@delete_all_plans');
        Route::POST('/save_service_free_domain', 'ServicesController@save_service_free_domain');
        Route::POST('/new_faq', 'ServicesController@new_faq');
        Route::POST('/get_faq', 'ServicesController@get_faq');
        Route::POST('/delete_faq', 'ServicesController@delete_faq');
        Route::POST('/deletebulkfaqs', 'ServicesController@deleteBulkFaqs');
    });
    Route::group(['prefix' => 'admin/domain_pricing'], function () {
        Route::get('/{per_page?}', 'DomainPricingController@index')->where(['per_page' => '[0-9]+']);
        Route::get('/addons/{per_page?}', 'DomainPricingController@addonsList')->where(['per_page' => '[0-9]+']);
        Route::post('/new/{addons?}', 'DomainPricingController@store');
        Route::POST('get_details/', 'DomainPricingController@get_details');
        Route::POST('/delete', 'DomainPricingController@delete');
        Route::post('/update/{addons?}', 'DomainPricingController@update');
        Route::POST('/delete_all', 'DomainPricingController@delete_all_plans');
    });

    Route::group(['prefix' => 'admin'], function () {
        Route::delete('domain_pricing_list/all', 'DomainPricingListController@destroyAll')
            ->name('domain_pricing_list.destroy_all');
        Route::delete('domain_pricing_list/selected', 'DomainPricingListController@destroySelected')
            ->name('domain_pricing_list.destroy_selected');
        Route::post('domain_pricing_list.import', 'DomainPricingListController@importPricing')
            ->name('domain_pricing_list.import');
        Route::post('domain_pricing_list.markup', 'DomainPricingListController@markUp')
            ->name('domain_pricing_list.mark_up');
        Route::resource('domain_pricing_list', 'DomainPricingListController', ['except' => [
            'index', 'create',
        ]]);
    });

    Route::group(['prefix' => 'admin/services_enquiry'], function () {
        Route::get('/{per_page?}', 'ServicesEnquiryController@index');
        Route::get('/addons/{per_page?}', 'ServicesEnquiryController@index');
        Route::post('/new/{addons?}', 'ServicesEnquiryController@store');
        Route::POST('get_details/', 'ServicesEnquiryController@get_details');
        Route::POST('/delete', 'ServicesEnquiryController@delete');
        Route::post('/update/{addons?}', 'ServicesEnquiryController@update');
        Route::POST('/delete_all', 'ServicesEnquiryController@delete_all_plans');
    });

    Route::group(['prefix' => 'admin/general_features/'], function () {
        Route::get('/', 'DedicatedServersController@index');
        Route::post('/new', 'GeneralFeaturesController@store');
        Route::post('/new_plan', 'DedicatedServersController@hosting_plan');
        Route::get('/edit/{id}', 'GeneralFeaturesController@edit');
        Route::POST('heading_edit/', 'GeneralFeaturesController@heading_edit');
        Route::POST('get_details/', 'GeneralFeaturesController@get_details');
        Route::POST('get_details_hp/', 'DedicatedServersController@get_details_hp');
        Route::post('/update', 'GeneralFeaturesController@update');
        Route::post('/update_cloud_hosting_plan/{id}', 'DedicatedServersController@update_hosting_plan');
        Route::POST('/delete', 'GeneralFeaturesController@delete');
        Route::POST('/delete_icon', 'GeneralFeaturesController@delete_icon');
        Route::POST('/delete_hp', 'DedicatedServersController@delete_hp');
        Route::POST('image_update', 'IndexPlanController@image_update');
        Route::POST('get_index_plan_details/', 'IndexPlanController@get_index_plan_details');
        Route::POST('update_sort/', 'DedicatedServersController@update_sort');
        Route::POST('cms_update/', 'IndexPlanController@cms_update');
        Route::POST('/delete_all_plans', 'DedicatedServersController@delete_all_plans');
    });
    Route::resource('admin/categories', 'CategoriesController');
    Route::group(['prefix' => 'admin/categories/'], function () {
        Route::POST('/update_sort', 'CategoriesController@update_sort');
        Route::POST('/upload_images', 'CategoriesController@upload_images');
        Route::POST('/category_images_delete', 'CategoriesController@category_images_delete');
        Route::get('/category_images/{category_id}', 'CategoriesController@get_category_images');
        Route::POST('/reload_switcher', 'CategoriesController@reloadSwitcher');
    });

    //
    Route::group(['prefix' => 'web88/admin/bulk_domain/'], function () {

        Route::get('/{per_page}', 'BulkDomainController@index')->where(['per_page' => '[0-9]+']);
        Route::get('/pricing/{id}/{per_page}', 'BulkDomainController@pricing')->where(['id' => '[0-9]+', 'per_page' => '[0-9]+']);
        Route::POST('/delete_selected/{per_page?}', 'BulkDomainController@delete_selected');
        Route::POST('/delete_all', 'BulkDomainController@delete_all');
        Route::POST('/update/{page_id}', 'BulkDomainController@update');
        Route::POST('/add', 'BulkDomainController@store');
    });

    Route::resource('web88/admin/bulk_domain', 'BulkDomainController');

    //

    Route::group(['prefix' => 'admin/pages/'], function () {
        Route::POST('/new', 'PagesController@store');
        Route::POST('/update', 'PagesController@update');
    });
    Route::group(['prefix' => 'clients'], function () {
        Route::get('/listing', 'ClientsController@index');
        Route::get('/listing/{page_id}', 'ClientsController@index');
        Route::any('/search_clients', 'ClientsController@search_clients');
        Route::post('/create', 'ClientsController@store');
        Route::post('/delete', 'ClientsController@delete');
        Route::get('/edit/{id}', 'ClientsController@edit');
        Route::get('/invoices/{id}', 'ClientsController@invoices');
        Route::POST('/update', 'ClientsController@update');
        Route::POST('/delete_all_clients', 'ClientsController@delelte_all');
        Route::get('/export', 'ClientsController@export_csv');
    });

    Route::group(['prefix' => 'newsletter'], function () {
        Route::get('/', '\App\Http\Controllers\Admin\NewsletterController@index');
        Route::get('/{page_id}', 'NewsletterController@index');
        Route::Post('/editSubscriber', '\App\Http\Controllers\Admin\NewsletterController@editSubscriber');
        Route::Post('/addesubscriber', '\App\Http\Controllers\Admin\NewsletterController@addSubscriber');
        Route::Post('/updatesubscriber', '\App\Http\Controllers\Admin\NewsletterController@updatesubscriber');
        Route::post('/empty_newsletter', 'NewsletterController@empty_newsletter');
        /*Route::any('/search_clients', 'ClientsController@search_clients');
        Route::post('/create', 'ClientsController@store');
        Route::post('/delete', 'ClientsController@delete');
        Route::get('/edit/{id}', 'ClientsController@edit');
        Route::POST('/update', 'ClientsController@update');
        Route::POST('/delete_all_clients', 'ClientsController@delelte_all');
        */
        Route::get('/subscribers/export', '\App\Http\Controllers\Admin\NewsletterController@generateCsv');
    });

    //New added start
    Route::group(['prefix' => 'admin/web88ir'], function () {
        Route::POST('/new', 'Web88irController@store');
        Route::POST('/update', 'Web88irController@update');
        Route::POST('/heading_edit', 'Web88irController@heading_edit');
        Route::GET('/edit/{id}', 'Web88irController@edit');
        Route::POST('/delete/', 'Web88irController@delete');
    });
    //New added start
    Route::group(['prefix' => 'admin/email88'], function () {
        Route::POST('/new', 'Email88Controller@store');
        Route::POST('/update', 'Email88Controller@update');
        Route::POST('/heading_edit', 'Email88Controller@heading_edit');
        Route::GET('/edit/{id}', 'Email88Controller@edit');
        Route::POST('/delete/', 'Email88Controller@delete');
    });
    Route::group(['prefix' => 'admin/services/enquiry'], function () {
        Route::get('/list/{per_page?}', ['as' => 'enquires-list', 'uses' => 'FreeQuoteEnquiresController@index']);
        Route::get('/export/csv', ['uses' => 'FreeQuoteEnquiresController@exportEnquiry']);
        Route::get('/add', ['uses' => 'FreeQuoteEnquiresController@add', 'as' => 'enquires-add']);
        Route::post('/create', ['uses' => 'FreeQuoteEnquiresController@create', 'as' => 'enquires-create']);
        Route::get('/edit/{id}', ['uses' => 'FreeQuoteEnquiresController@edit', 'as' => 'enquires-edit']);
        Route::put('/update/{id}', ['uses' => 'FreeQuoteEnquiresController@update', 'as' => 'enquires-update']);
        Route::post('/get_enquiry_details', ['uses' => 'FreeQuoteEnquiresController@getEnquiryDetails']);
        Route::post('/delete_by_id', ['uses' => 'FreeQuoteEnquiresController@deleteEnquiryByID']);
        Route::post('/delete_all', ['uses' => 'FreeQuoteEnquiresController@deleteEnquiryAll']);
        Route::DELETE('/enquires/{id}', ['as' => 'enquires-delete', 'uses' => 'FreeQuoteEnquiresController@deleteEnquires']);
    });
    //New added end
    Route::resource('admin/co_cloud_hosting', 'CoCloudHostingController');
    Route::resource('admin/dedicated_servers', 'DedicatedServersController');
    Route::resource('admin/shared_hosting', 'SharedHostingController');
    Route::resource('admin/vps_hosting', 'VpsHostingController');


    // Route group for admin, it's related to controllers inside Controllers/Admin folder
    // Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

        // Route group for blog section
        Route::group(['prefix' => 'blog'], function () {
            Route::get('articles/list/{page?}', 'ArticleController@index')->name('admin.articles.index');
            Route::post('articles', 'ArticleController@store')->name('admin.articles.store');
            Route::get('articles/search/{page?}', 'ArticleController@search')->name('admin.articles.search');
            Route::delete('articles', 'ArticleController@destroy')->name('admin.articles.destroy');
            Route::get('articles/{id}', 'ArticleController@show')->name('admin.articles.show');
            Route::match(['POST', 'PATCH'], 'articles/update', 'ArticleController@update')->name('admin.articles.update');
            Route::post('articles/{id}/comment', 'CommentController@store')->name('admin.articles.comment.store');
            Route::delete('articles/selected-items', 'ArticleController@deleteSelectedItem')->name('admin.articles.destroy.items');
            Route::delete('articles/bulk-delete', 'ArticleController@bulkDelete')->name('admin.articles.destroy.bulk.delete');
            Route::POST('articles/get_details/', 'ArticleController@get_details');
        });
    });


    // Route group for admin, it's related to controllers inside Controllers/Admin folder
    // Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::get('banners', 'BannersController@index')->name('admin.banners.index');
        Route::post('banners/store', 'BannersController@store')->name('admin.banners.store');
        Route::get('banners/edit/{id}', 'BannersController@edit')->name('admin.banners.edit');
        Route::post('banners/update', 'BannersController@update')->name('admin.banners.update');
        Route::post('banners/order/update', 'BannersController@updateOrder')->name('admin.banners.updateOrder');
        Route::get('banners/delete/{id}', 'BannersController@delete')->name('admin.banners.delete');
        Route::post('banners/selected/delete', 'BannersController@deleteSelected')->name('admin.banners.deleteSelected');
        Route::get('banners/destroy', 'BannersController@destroy')->name('admin.banners.destroy');
        Route::get('banners/delete/enlarge-image/{id}', 'BannersController@deleteEnlargeImage')->name('admin.banners.delete.enlarge.image');
        Route::get('banners/delete/enlarge-pdf/{id}', 'BannersController@deleteEnlargePdf')->name('admin.banners.delete.enlarge.pdf');
    });
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::get('promotions/globalDiscounts/', 'PromotionsController@listGlobalDiscounts')->name('discount');
        Route::post('promotions/categoryProducts/', 'PromocodesController@categoryProducts');
        Route::post('promotions/addGlobalDiscount/', 'PromotionsController@addGlobalDiscount')->name('admin.discount.store');
        Route::post('promotions/deleteGlobalDiscounts/', 'PromotionsController@deleteGlobalDiscounts');
        Route::post('promotions/deleteSelected/', 'PromotionsController@deleteSelected');
        Route::post('promotions/deleteAll/', 'PromotionsController@deleteAll');
        Route::post('promotions/updateGlobalDiscount/', 'PromotionsController@updateGlobalDiscount');
        //Add route by aklima
        Route::get('/get_discount/{id}', 'PromotionsController@getDiscount');
    });
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
        // Route::get('promocodes', 'PromocodesController@index')->name('promocode');
        Route::get('promocodes/addNew', 'PromocodesController@addNew');
        Route::post('promocodes/storePromo', 'PromocodesController@storePromo');
        Route::post('promocodes/deleteAllPromocode', 'PromocodesController@deleteAllPromocode');
        Route::get('promocodes/delete/{id}', 'PromocodesController@delete');
        Route::get('promocodes/{limit}', 'PromocodesController@index');
        Route::get('promocodes', 'PromocodesController@index');
        Route::get('promocodes/editPromoCode/{id}', 'PromocodesController@editPromoCode');
        Route::post('promocodes/editPromoCode/{id}', 'PromocodesController@editPromoCode');
        Route::post('promocodes/addPromoCodeCategory/{id}', 'PromocodesController@addPromoCodeCategory');
        Route::post('promocodes/addPromoCodeProduct/{id}', 'PromocodesController@addPromoCodeProduct');
        Route::post('promocodes/deletePromocodeToCategory/{id}', 'PromocodesController@deletePromocodeToCategory');
        Route::get('promocodes/deletePromocodeToCategory/{id}', 'PromocodesController@deletePromocodeToCategory');
        Route::post('promocodes/deletePromocodeToProduct/{id}', 'PromocodesController@deletePromocodeToProduct');
        Route::get('promocodes/deletePromocodeToProduct/{id}', 'PromocodesController@deletePromocodeToProduct');
    });

    Route::get('admin/orders_list', 'OrdersController@orders_list')->name('get_orders_list');
    Route::get('admin/get-order-data-ajax', 'OrdersController@ordersDynamicData')->name('get-order-data-ajax');
    Route::get('admin/orders_list/{per_page}', 'OrdersController@orders_list');
    //ak routes
    //Add route by aklima
    Route::get('admin/billing_invoice_list', 'OrdersController@billing_invoice_list');
    Route::get('admin/billing_invoice_list/{per_page}', 'OrdersController@billing_invoice_list');

    Route::post('admin/billing_invoice_list', 'OrdersController@billing_invoice_list');

    Route::get('admin/billing_invoice_new', 'OrdersController@billing_invoice_new')->name('billing_invoice_new');
    Route::post('admin/new_invoice', 'OrdersController@newinvoice')->name('new_invoice');
    Route::get('admin/billing_invoice_edit/{id}', 'OrdersController@billing_invoice_edit')->name('order_edit');
    Route::post('admin/print_invoice', 'OrdersController@print_invoice')->name('print_invoice');
    Route::get('admin/invoice_pdf/{id}', 'OrdersController@invoice_pdf');
    Route::get('admin/print_pdf/{id}', 'OrdersController@print_pdf');
    Route::post('admin/send_pdf/{id}', 'OrdersController@send_pdf');
    Route::post('admin/generate_receipt', 'OrdersController@generate_receipt');
    Route::get('admin/pdf_file', 'OrdersController@pdf_file');
    Route::get('admin/get_plan_detail/{id}', 'OrdersController@get_plan_detail');
    Route::get('admin/get_invoice/{id}', 'OrdersController@get_invoice_details');
    Route::post('admin/invoice/delete', 'OrdersController@deleteInvoice');
    Route::post('admin/invoice/categoryProducts', 'OrdersController@fetchCategory');
    Route::get('admin/billing_invoice_edit_item/{id}', 'OrdersController@editItems')->name('editItems');
    Route::post('admin/update_invoice_item/{id}', 'OrdersController@updateItems')->name('updateItems');
    //Add discount route By aklima

    Route::get('admin/export/{type}', 'OrdersController@export');


    Route::delete('admin/invoice_item_delete', 'OrdersController@delete_invoice_item')->name('delete_invoice_item');

    Route::post('admin/add_new_invoice/{id}', 'OrdersController@add_new_invoice')->name('add_new_invoice');

    Route::post('admin/orders_list', 'OrdersController@orders_list');
    Route::post('admin/orders/delete', 'OrdersController@delete');
    Route::post('admin/orders/deleteSelected', 'OrdersController@deleteSelected');
    //aklima
    Route::post('admin/orders/deleteSelectedItem', 'OrdersController@deleteSelectedItem');
    Route::post('admin/orders/deleteAllItem', 'OrdersController@deleteAllItem');
    Route::post('admin/orders/deleteAll', 'OrdersController@deleteAll');

    Route::post('admin/order/{order_id}/edit', 'OrdersController@update')->name('update_order');
    Route::get('admin/order/{order_id}/status', 'OrdersController@statusUpdate')->name('order_status_update');
    // aklima
    Route::post('admin/order/{order_id}/update_invoice', 'OrdersController@update_invoice_order')->name('update_invoice_order');
    Route::post('admin/check_domain_availablity', 'OrdersController@check_domain_availablity');

    // Added by Rejohn
    Route::get('admin/receipts_list', 'OrdersController@receipts_list');
    Route::post('admin/receipts_list', 'OrdersController@receipts_list');
    Route::post('admin/receipts_delete', 'OrdersController@receipts_delete');
    Route::post('admin/receipts_selected_delete', 'OrdersController@receipts_selected_delete');
    Route::get('admin/receipt_generate', 'OrdersController@receipt_generate');
    Route::get('/admin/generate_pdf/{id}', 'OrdersController@generate_pdf');
    Route::get('/admin/print_pdf_1/{id}', 'OrdersController@print_pdf_1');
    Route::get('/admin/download_pdf/{id}', 'OrdersController@receipt_generate');

    Route::post('admin/receipts_csv_export', 'OrdersController@receipts_csv_export');
    Route::post('admin/receipts_pdf_send', 'OrdersController@receipts_pdf_send');
    Route::get('admin/meta_name', 'MetaController@index')->name('meta_name');
    Route::post('admin/meta_name_create', 'MetaController@store');
    Route::post('admin/meta_name_update', 'MetaController@update');
    Route::post('admin/meta_name_selected_delete', 'MetaController@meta_name_selected_delete');

    Route::get('admin/gst_rates', 'GstRatesController@index')->name('gst_rates');
    Route::post('/admin/gstrate_create', 'GstRatesController@store');
    Route::post('/admin/gst_rate_update', 'GstRatesController@update');
    Route::post('admin/gst_rate_selected_delete', 'GstRatesController@gst_rate_selected_delete');
});

// Added by Rejohn
Route::Post('/add-subscriber', '\App\Http\Controllers\Frontend\IndexController@add_subscriber');

//frontend group

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'IndexController@index')->name('frontend.index');
    Route::get('/makeadmin', 'IndexController@makeadmin');
    Route::get('/services/{page}/{preview?}', 'ServicesController@index')->name('frontend.services');
    Route::get('/shared_hosting', 'SharedHostingController@index');
    Route::get('/co_cloud_hosting', 'CoCloudHostingController@index');
    Route::get('/dedicated_servers', 'DedicatedServersController@index');
    Route::get('/register', 'IndexController@client_register');
    Route::get('/dashboard', 'IndexController@client_dashboard')->name('frontend.client_dashboard');
    Route::get('/my_account', 'IndexController@client_update')->name('frontend.client_update_information');
    Route::post('/update_client', 'IndexController@client_account_update');
    Route::post('/get_categories', 'IndexController@get_categories');
    Route::POST('/register', 'IndexController@client_registeration');
    Route::get('get_countries', 'IndexController@get_countries');
    Route::get('get_state/{country_id}', 'IndexController@get_state');
    Route::get('get_city/{state_id}', 'IndexController@get_city');
    Route::POST('/profile_pic_update', 'IndexController@change_profile_pic');
    Route::get('/reset_password', 'IndexController@client_reset_password');
    Route::POST('/unsubscribe_news_letter', 'IndexController@unsubscribe_news_letter');
    Route::POST('/subscribe_news_letter', 'IndexController@subscribe_news_letter');
    Route::get('/enquiry', 'EnquiryController@index');
    Route::get('blog', 'ArticleController@index')->name('frontend.articles.index');
    Route::get('blog/{id}/{slug}', 'ArticleController@show')->name('frontend.articles.show');
    Route::post('blog/{id}/comment', 'CommentController@store')->name('frontend.articles.comment.store');
    Route::GET('domains', 'DomainsController@index')->name('frontend.domain.index');
    Route::get('domain_transfer', 'DomainsController@transferPage')->name('frontend.domain.transfer_page');
    // Route::get('domain_transfer_login', 'DomainsController@transfer_login_search')->name('frontend.domain.transfer_login');

    Route::get('contact', 'ContactController@index')->name('contact');
    Route::post('contact-enquiry', 'ContactController@contactEnquiry')->name('contactEnquiry');
    // Route::resource('contact','ContactController');
    // Route::get('domain_transfer', 'DomainsController@transferPage')->name('frontend.domain.transfer_page');


    //Route::get('/cloud_hosting1', 'OneCloudHostingController@index');
    Route::get('/domain_configuration', 'DomainConfigController@index')->name('frontend.domain.configuration');
    Route::post('/domain_configuration', 'DomainConfigController@postIndex')->name('frontend.domain.configuration_post');
    Route::post('/fetchcategoryProducts', 'DomainConfigController@fetchCategory');

    Route::match(['GET', 'POST'], '/shopping_cart', 'ShoppingCartController@index')->name('frontend.shopping_cart');
    Route::post('/update_cycle', 'ShoppingCartController@update_cycle');
    Route::post('/get_price', 'ShoppingCartController@get_price');
    Route::post('/get_tld_price', 'ShoppingCartController@get_tld_price');
    Route::post('/update_cart', 'ShoppingCartController@update_cart');
    //Route::get('/shopping_cart', 'ShoppingCartController@index')->name('frontend.shopping_cart');
    Route::get('/dedicated_servers_shopping_cart', 'ShoppingCartController@dedicatedServersShoppingCart')->name('frontend.dedicated_servers_shopping_cart');
    //->middleware('auth');
    Route::post('/checkout/add', 'ShoppingCartController@checkoutItems');
    // Route::post('/auth_checkout/add', 'ShoppingCartController@authCheckoutItems');
    Route::post('/checkout_login', 'ShoppingCartController@checkout_login')->name('frontend.checkout_login')->middleware('auth');
    Route::post('/order_confirmation_login', 'ShoppingCartController@order_confirmation_login')->name('frontend.order_confirmation_login')->middleware('auth');

    Route::get('/support', 'SupportController@index');


    Route::get('/domain_search_login', 'DomainsController@searchLogin')->name('frontend.domain.searchLogin');
    Route::get('/bulk_domain_search_login', 'DomainsController@bulkSearchLogin')->name('frontend.domain.bulkSearchLogin');
    Route::get('/domain_transfer_login', 'DomainsController@transferLogin')->name('frontend.domain.transferLogin');
    Route::get('/bulk_domain_transfer_login', 'DomainsController@bulktransferLogin')->name('frontend.domain.bulkTransferLogin');
    Route::get('/domain_register_new_login', 'DomainsController@registerNewLogin')->name('frontend.domain.registerNewLogin');
    Route::get('/domain_domain_renewal', 'DomainsController@domainRenewal')->name('frontend.domain.domainRenewal');
    Route::get('/domain_search', 'DomainsController@search')->name('frontend.domain.search');
    Route::get('/domain-search-ajax', 'DomainsController@ajaxDomainSearch')->name('frontend.domain.ajax_search');
    Route::get('/whois/{domain}', 'DomainsController@whois')->name('frontend.domain.whois');

    Route::get('config_dedicate', 'DedicatedServersController@configDedicate')->name('configDedicate');
    Route::get('domain_config', 'DomainConfigController@domainConfig')->name('domainConfig');
    Route::get('bulk_domain_search', 'DomainsController@bulkSearch')->name('frontend.domain.bulk_search');
    Route::post('/empty_cart', 'ShoppingCartController@empty_cart');
    Route::get('/empty_cart', 'ShoppingCartController@emptyCart');
    Route::get('/test', function () {
        \Artisan::call('config:cache');
        \Artisan::call('view:clear');
        \Artisan::call('route:clear');
        \Artisan::call('cache:clear');
    });
    // Route::post('/newsletter/addSubscriber', 'NewsletterController@addSubscriber');
    Route::post('/newsletter/deleteSubscriber', 'NewsletterController@deleteSubscriber');
    Route::post('/newsletter/deleteSubscriberSelected', 'NewsletterController@deleteSubscriberSelected');
    Route::post('/newsletter/deleteAll', 'NewsletterController@deleteAll');
    Route::get('client_area_home', 'ClientsController@index')->middleware('auth');
    Route::get('order_history_list', 'ClientsController@order_history_list')->middleware('auth');
    Route::get('order-details/{id}', 'ClientsController@orderDetails')->middleware('auth');
    Route::get('billing_my_invoices', 'ClientsController@billing_my_invoices')->middleware('auth');
    Route::get('billing_mass_payment', 'ClientsController@billing_mass_payment')->middleware('auth');
    Route::post('billing_payment_done', 'ClientsController@payment_done')->middleware('auth');
    Route::post('billing_payment_done_other', 'ClientsController@payment_done_other')->middleware('auth');

    //Aklima
    Route::get('/downloadReceipt/{id}', 'ClientsController@receiptDetails');
    Route::get('downloadExcel/{type}', 'ClientsController@downloadExcel');
    Route::get('/downloadpdf', 'ClientsController@pdf');
    Route::get('/pricelist/{domain}', 'ServicesController@pricelist')->middleware('auth')->name('price_list');
});

//frontend group - end
/**@av**/

Route::match(['get', 'post'], 'domain_configuration_hosting', 'Frontend\DomainConfigurationControllers@index');
//Route::get('domain_configuration_hosting', 'Frontend\DomainConfigurationControllers@index');
Route::get('check_domain_availablity', 'Frontend\DomainConfigurationControllers@check_domain_availablity');
//support ticket
Route::get('/support_tickets', 'Frontend\SupportTicketControllers@index');
Route::get('/support_tickets/create', 'Frontend\SupportTicketControllers@create');
Route::post('/support_tickets/store', 'Frontend\SupportTicketControllers@store');
Route::post('/support_tickets/reply_store', 'Frontend\SupportTicketControllers@reply_store');
Route::get('/support_tickets/reply', 'Frontend\SupportTicketControllers@reply');
Route::get('/support_tickets/close_this', 'Frontend\SupportTicketControllers@close_this');
Route::get('/support_tickets/success', 'Frontend\SupportTicketControllers@success');

//support_admin

Route::get('admin/support_tickets', 'Admin\SupportTicketControllers@index');
Route::get('/admin/create', 'Admin\SupportTicketControllers@create');
Route::post('/admin/store', 'Admin\SupportTicketControllers@store');
Route::post('/admin/reply_store', 'Admin\SupportTicketControllers@reply_store');
Route::get('/admin/reply', 'Admin\SupportTicketControllers@reply');
Route::get('/admin/close_this', 'Admin\SupportTicketControllers@close_this');
Route::get('/admin/success', 'Admin\SupportTicketControllers@success');
Route::get('/admin/deleteThis', 'Admin\SupportTicketControllers@deleteThis');
Route::get('/admin/update_reply', 'Admin\SupportTicketControllers@update_reply');
Route::get('/admin/delete_reply', 'Admin\SupportTicketControllers@delete_reply');
Route::get('/admin/fetch_acct_type', 'Admin\SupportTicketControllers@fetch_acct_type');
Route::get('/admin/dele_service', 'Admin\SupportTicketControllers@dele_service');
Route::get('/admin/multi_delete', 'Admin\SupportTicketControllers@multi_delete');

Route::post('/add_to_cart', 'Frontend\ShoppingCartController@add_to_cart');
Route::post('/save_before_payment', 'Frontend\ShoppingCartController@save_before_payment')->middleware('auth');
Route::post('/payment_done', 'Frontend\ShoppingCartController@payment_done')->middleware('auth');

Route::get('/order_confirmation_login', 'Frontend\ShoppingCartController@order_confirmation_login');


Route::get('/test', function () {
    echo "test";
});
