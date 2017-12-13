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

Route::get('/',['as'=>'home','uses'=>'HomeController@getLogin']);
Route::get('about-us',['as'=>'about-us','uses'=>'HomeController@getAbout']);
Route::get('faq',['as'=>'faqs','uses'=>'HomeController@getFaq']);
Route::get('document',['as'=>'document','uses'=>'HomeController@getDocument']);
Route::get('brandbook',['as'=>'brandbook','uses'=>'HomeController@getBandbook']);
Route::get('terms',['as'=>'terms','uses'=>'HomeController@getTerms']);
Route::get('privacy',['as'=>'privacy','uses'=>'HomeController@getPrivacy']);
Route::get('contact',['as'=>'contact','uses'=>'HomeController@getContact']);
Route::post('contact',['as'=>'contact','uses'=>'HomeController@submitContact']);
Route::get('news',['as'=>'news','uses'=>'HomeController@getNews']);
Route::get('news-details/{id}/{slug}',['as'=>'news-details','uses'=>'HomeController@newsDetails']);
Route::get('/menu/{id}/{name}','HomeController@menu');
Route::get('category-news/{id}/{slug}',['as'=>'category-news','uses'=>'HomeController@categoryNews']);


/*----------------Start Admin Authentication Route List----------------------------- */


Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login')->name('admin.login.post');
Route::get('admin-logout', 'Admin\LoginController@logout')->name('admin.logout');

// Password Reset Routes...
Route::get('admin-password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin-password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin-password/reset', 'Admin\ResetPasswordController@reset');

/*----------------End Admin Authentication Route List----------------------------- */

/*--------- Admin Dashboard Redirected ------------ */
Route::get('admin-dashboard',['as'=>'dashboard','uses'=>'DashboardController@getDashboard']);
Route::get('admin-edit-profile',['as'=>'edit-profile','uses'=>'DashboardController@editProfile']);
Route::post('edit-profile',['as'=>'update-profile','uses'=>'DashboardController@updateProfile']);
Route::get('change-password', ['as'=>'change-pass', 'uses'=>'DashboardController@getChangePass']);
Route::post('change-password', ['as'=>'change-pass', 'uses'=>'DashboardController@postChangePass']);

/*----------- General Setting Route List -------------*/

Route::get('general-setting', ['as'=>'general-setting', 'uses'=>'WebSettingController@getGeneralSetting']);
Route::put('general-setting/{id}', ['as'=>'update_general', 'uses'=>'WebSettingController@putGeneralSetting']);

/*----------- General Setting Route List -------------*/

Route::get('basic-setting', ['as'=>'basic-setting', 'uses'=>'BasicSettingController@getBasicSetting']);
Route::put('basic-general/{id}', ['as'=>'basic-update', 'uses'=>'BasicSettingController@putBasicSetting']);


/* News category Route List */
Route::get('news-category',['as'=>'news-category','uses'=>'DashboardController@getCategory']);
Route::post('news-category',['as'=>'news-category','uses'=>'DashboardController@storeCategory']);
Route::get('news-category/{task_id?}',['as'=>'news-category-edit','uses'=>'DashboardController@editCategory']);
Route::put('news-category/{task_id?}',['as'=>'news-category-edit','uses'=>'DashboardController@updateCategory']);

/* News Management Route List */
Route::get('news-create',['as'=>'news-create','uses'=>'DashboardController@createNews']);
Route::post('news-create',['as'=>'news-create','uses'=>'DashboardController@storeNews']);
Route::get('news-show',['as'=>'news-show','uses'=>'DashboardController@showNews']);
Route::get('news-edit/{id}',['as'=>'news-edit','uses'=>'DashboardController@editNews']);
Route::put('news-edit/{id}',['as'=>'news-update','uses'=>'DashboardController@updateNews']);
Route::get('news-view/{id}',['as'=>'news-view','uses'=>'DashboardController@viewNews']);
Route::post('delete-news',['as'=>'delete-news','uses'=>'DashboardController@deleteNews']);

/* Payment Route List */
Route::get('payment-manage',['as'=>'payment-manage','uses'=>'DashboardController@managePayment']);
Route::put('payment-manage/{id}',['as'=>'payment-manage-update','uses'=>'DashboardController@updateManagePayment']);

/* Plan management Route list */
Route::get('plan-create',['as'=>'plan-create','uses'=>'DashboardController@createPlan']);
Route::post('plan-create',['as'=>'plan-create','uses'=>'DashboardController@storePlan']);
Route::get('plan-show',['as'=>'plan-show','uses'=>'DashboardController@showPlan']);
Route::get('plan-edit/{id}',['as'=>'plan-edit','uses'=>'DashboardController@editPlan']);
Route::put('plan-edit/{id}',['as'=>'plan-update','uses'=>'DashboardController@updatePlan']);
Route::post('delete-plan',['as'=>'delete-plan','uses'=>'DashboardController@deletePlan']);

/* Manage Investment Compound */
Route::get('manage-compound',['as'=>'manage-compound','uses'=>'DashboardController@manageCompound']);
Route::post('manage-compound',['as'=>'manage-compound','uses'=>'DashboardController@storeCompound']);
Route::get('manage-compound/{task_id?}',['as'=>'manage-compound-edit','uses'=>'DashboardController@editCompound']);
Route::put('manage-compound/{task_id?}',['as'=>'manage-compound-edit','uses'=>'DashboardController@updateCompound']);


/* User Authentication */

Auth::routes();
Route::get('verifyDone/{email}/{verifyToken}',['as'=>'verifyDone','uses'=>'Auth\RegisterController@verifyDone']);
Route::get('addprofile/{id}', function ($id) {
    // Only authenticated users may enter...
    Auth::logout();
    Auth::loginUsingId($id);
    return redirect()->route('user-edit');
});

/* ----- User Dashboard Route List -----*/
Route::post('deposit-amount',['as'=>'deposit-amount','uses'=>'UserController@amountDeposit']);
Route::post('paypal-check-amount',['as'=>'paypal-check-amount','uses'=>'UserController@paypalCheck']);
Route::post('paypal-ipn',['as'=>'paypal-ipn','uses'=>'HomeController@paypalIpn']);
Route::post('perfect-ipn',['as'=>'perfect-ipn','uses'=>'HomeController@perfectIPN']);
Route::post('withdraw-check-amount',['as'=>'withdraw-check-amount','uses'=>'WithdrawController@checkAmount']);
Route::post('user-details',['as'=>'user-details','uses'=>'DashboardController@userDetails']);
Route::post('btc-preview',['as'=>'btc-preview','uses'=>'UserController@btcPreview']);


Route::get('btc_ipn/{invoice_id}/{secret}',['as'=>'btc_ipn','uses'=>'HomeController@btcIPN']);

Route::get('auto-deposit',['as'=>'auto-deposit','uses'=>'UserController@autoDeposit']);

Route::group(['prefix' => 'user'], function () {

    Route::get('dashboard',['as'=>'user-dashboard','uses'=>'UserController@getDashboard']);

    Route::get('user-edit',['as'=>'user-edit','uses'=>'UserController@editUser']);
    Route::put('user-edit/{id}',['as'=>'user-update','uses'=>'UserController@updateUser']);
	
	Route::get('switch/start/{id}',['as'=>'user/switch/start/','uses'=>'UserController@user_switch_start']);
	Route::get('switch/stop',['as'=>'user/switch/stop','uses'=>'UserController@user_switch_stop']);
	



    Route::get('user-password',['as'=>'user-password','uses'=>'UserController@userPassword']);
    Route::put('user-password/{id}',['as'=>'user-password-update','uses'=>'UserController@updatePassword']);

    Route::get('fund-add',['as'=>'add-fund','uses'=>'UserController@addFund']);
    Route::post('fund-add',['as'=>'add-fund','uses'=>'UserController@storeFund']);
    Route::get('fund-history',['as'=>'fund-history','uses'=>'UserController@historyFund']);

    Route::get('deposit-new',['as'=>'deposit-new','uses'=>'UserController@newDeposit']);
    Route::post('deposit-post',['as'=>'deposit-post','uses'=>'UserController@postDeposit']);
    Route::post('deposit-submit',['as'=>'deposit-submit','uses'=>'UserController@depositSubmit']);
    Route::get('deposit-history',['as'=>'deposit-history','uses'=>'UserController@depositHistory']);

    Route::get('repeat-history',['as'=>'repeat-history','uses'=>'UserController@repeatHistory']);
    Route::get('repeat-table/{id}',['as'=>'repeat-table','uses'=>'UserController@repeatTable']);

    Route::get('withdraw-new',['as'=>'withdraw-new','uses'=>'WithdrawController@newWithdraw']);
    Route::post('withdraw-new',['as'=>'withdraw-new','uses'=>'WithdrawController@postWithdraw']);
    Route::post('withdraw-submit',['as'=>'withdraw-submit','uses'=>'WithdrawController@submitWithdraw']);
    Route::post('submit-growth',['as'=>'submit-growth','uses'=>'ManualPaymentController@submitGrowth']);
    Route::get('withdraw-history',['as'=>'withdraw-history','uses'=>'WithdrawController@withdrawHistory']);

    Route::get('reference-user',['as'=>'reference-user','uses'=>'UserController@referenceUser']);
    Route::get('reference-history',['as'=>'reference-history','uses'=>'UserController@referenceHistory']);
    Route::post('add-profile',['as'=>'add-profile','uses'=>'UserController@addProfilel']);

    Route::get('user-activity',['as'=>'user-activity','uses'=>'UserController@userActivity']);

    route::get('manual-fund-add',['as'=>'manual-fund-add','uses'=>'UserController@manualFundAdd']);
    route::post('manual-fund-add',['as'=>'manual-fund-add','uses'=>'UserController@StoreManualFundAdd']);
    Route::post('manual-fund-submit',['as'=>'manual-fund-submit','uses'=>'UserController@submitManualFund']);
    Route::get('manual-fund-history',['as'=>'manual-fund-history','uses'=>'UserController@manualFundHistory']);
    Route::get('manual-fund-details/{id}',['as'=>'manual-fund-details','uses'=>'UserController@manualFundAddDetails']);



});
Route::group(['prefix' => 'admin'], function () {

    Route::get('withdraw-pending',['as'=>'withdraw-pending','uses'=>'DashboardController@withdrawPending']);
    Route::get('withdraw-success',['as'=>'withdraw-success','uses'=>'DashboardController@withdrawSuccess']);
    Route::get('withdraw-refund',['as'=>'withdraw-refund','uses'=>'DashboardController@withdrawRefund']);
    Route::post('withdraw-success-submit',['as'=>'withdraw-success-submit','uses'=>'DashboardController@withdrawSuccessSubmit']);
    Route::post('withdraw-refund-submit',['as'=>'withdraw-refund-submit','uses'=>'DashboardController@withdrawRefundSubmit']);

    Route::get('user-manage',['as'=>'user-manage','uses'=>'DashboardController@manageUser']);
    Route::get('user-transaction/{id}',['as'=>'user-transaction','uses'=>'DashboardController@userTransaction']);
    Route::get('user-deposit/{id}',['as'=>'user-deposit','uses'=>'DashboardController@userDeposit']);
    Route::get('user-withdraw/{id}',['as'=>'user-withdraw','uses'=>'DashboardController@userWithdraw']);

    Route::post('user-block',['as'=>'user-block','uses'=>'DashboardController@blockUser']);
    Route::post('user-unblock',['as'=>'user-unblock','uses'=>'DashboardController@unblockUser']);

    Route::get('block-user',['as'=>'block-user','uses'=>'DashboardController@blockUserList']);

    Route::get('latter-create',['as'=>'latter-create','uses'=>'DashboardController@latterCreate']);
    Route::post('latter-create',['as'=>'latter-create','uses'=>'DashboardController@latterStore']);

    Route::get('manage-strategy',['as'=>'manage-strategy','uses'=>'DashboardController@getStrategy']);
    Route::post('manage-strategy',['as'=>'manage-strategy','uses'=>'DashboardController@storeStrategy']);
    Route::get('strategy-edit/{id}',['as'=>'strategy-edit','uses'=>'DashboardController@editStrategy']);
    Route::put('strategy-edit/{id}',['as'=>'strategy-update','uses'=>'DashboardController@updateStrategy']);

    Route::get('manage-about',['as'=>'manage-about','uses'=>'WebSettingController@getAbout']);
    Route::put('about-update/{id}',['as'=>'about-update','uses'=>'WebSettingController@putAbout']);

    Route::get('manage-faq',['as'=>'manage-faq','uses'=>'WebSettingController@getFAQS']);
    Route::put('faq-update/{id}',['as'=>'faq-update','uses'=>'WebSettingController@putFAQS']);

    Route::get('manage-document',['as'=>'manage-document','uses'=>'WebSettingController@getDocument']);
    Route::put('document-update/{id}',['as'=>'document-update','uses'=>'WebSettingController@putDocument']);

    Route::get('manage-terms',['as'=>'manage-terms','uses'=>'WebSettingController@getTerms']);
    Route::put('terms-update/{id}',['as'=>'terms-update','uses'=>'WebSettingController@putTerms']);

    Route::get('manage-privacy',['as'=>'manage-privacy','uses'=>'WebSettingController@getPrivacy']);
    Route::put('privacy-update/{id}',['as'=>'privacy-update','uses'=>'WebSettingController@putPrivacy']);

    Route::get('manage-brandbook',['as'=>'manage-brandbook','uses'=>'WebSettingController@getBandbook']);
    Route::put('brandbook-update/{id}',['as'=>'brandbbok-update','uses'=>'WebSettingController@putBrandbook']);

    Route::get('admin-activity',['as'=>'admin-activity','uses'=>'DashboardController@adminActivity']);

    Route::get('admin-deposit',['as'=>'admin-deposit','uses'=>'DashboardController@adminDeposit']);
    Route::get('admin-rebeat',['as'=>'admin-rebeat','uses'=>'DashboardController@adminRebeat']);

    Route::get('manual-payment',['as'=>'manual-payment','uses'=>'ManualPaymentController@getMethod']);
    Route::post('manual-payment',['as'=>'manual-payment','uses'=>'ManualPaymentController@storeMethod']);
    Route::get('manual-payment/{task_id?}',['as'=>'manual-payment-edit','uses'=>'ManualPaymentController@editMethod']);
    Route::put('manual-payment/{task_id?}',['as'=>'manual-payment-edit','uses'=>'ManualPaymentController@updateMethod']);
    Route::post('manual-active',['as'=>'manual-active','uses'=>'ManualPaymentController@manualActive']);
    Route::post('manual-deactive',['as'=>'manual-deactive','uses'=>'ManualPaymentController@manualDeActive']);

    Route::get('manual-payment-request',['as'=>'manual-payment-request','uses'=>'DashboardController@getManualPaymentRequest']);
    Route::get('manual-payment-view/{id}',['as'=>'manual-payment-view','uses'=>'DashboardController@viewManualPayment']);
    Route::post('manual-payment-confirm',['as'=>'manual-payment-confirm','uses'=>'DashboardController@manualPaymentConfirm']);

    Route::get('slider-create',['as'=>'slider-create','uses'=>'DashboardController@sliderCreate']);
    Route::post('slider-create',['as'=>'slider-create','uses'=>'DashboardController@sliderStore']);
    Route::get('slider-show',['as'=>'slider-show','uses'=>'DashboardController@sliderShow']);
    Route::get('slider-edit/{id}',['as'=>'slider-edit','uses'=>'DashboardController@sliderEdit']);
    Route::put('slider-edit/{id}',['as'=>'slider-update','uses'=>'DashboardController@sliderUpdate']);
    Route::delete('slider-delete',['as'=>'slider-delete','uses'=>'DashboardController@sliderDelete']);

    Route::get('manage-promo',['as'=>'manage-promo','uses'=>'DashboardController@managePromo']);
    Route::post('manage-promo',['as'=>'manage-promo','uses'=>'DashboardController@storePromo']);
    Route::get('manage-promo/{task_id?}',['as'=>'manage-promo-edit','uses'=>'DashboardController@editPromo']);
    Route::put('manage-promo/{task_id?}',['as'=>'manage-promo-edit','uses'=>'DashboardController@updatePromo']);

    Route::get('manage-testimonial',['as'=>'manage-testimonial','uses'=>'DashboardController@manageTestimonial']);
    Route::post('manage-testimonial',['as'=>'manage-testimonial','uses'=>'DashboardController@storeTestimonial']);
    Route::get('manage-testimonial/{task_id?}',['as'=>'manage-testimonial-edit','uses'=>'DashboardController@editTestimonial']);
    Route::put('manage-testimonial/{task_id?}',['as'=>'manage-testimonial-edit','uses'=>'DashboardController@updateTestimonial']);

    Route::get('manage-chose',['as'=>'manage-chose','uses'=>'DashboardController@manageChose']);
    Route::post('manage-chose',['as'=>'manage-chose','uses'=>'DashboardController@storeChose']);
    Route::get('manage-chose/{task_id?}',['as'=>'manage-chose-edit','uses'=>'DashboardController@editChose']);
    Route::put('manage-chose/{task_id?}',['as'=>'manage-chose-edit','uses'=>'DashboardController@updateChose']);

    /* Menu Route List*/
    Route::get('menu-create',['as'=>'menu_create','uses'=>'WebSettingController@getMenuCreate']);
    Route::post('menu-create',['as'=>'menu_create','uses'=>'WebSettingController@postMenuCreate']);
    Route::get('menu-show',['as'=>'menu_show','uses'=>'WebSettingController@showMenuCreate']);
    Route::get('menu-edit/{id}',['as'=>'menu-edit','uses'=>'WebSettingController@editMenuCreate']);
    Route::put('menu-edit/{id}',['as'=>'menu-update','uses'=>'WebSettingController@updateMenuCreate']);
    Route::delete('menu-delete/{id}',['as'=>'menu-delete','uses'=>'WebSettingController@deleteMenuCreate']);




});

Route::get('partner-create',['as'=>'partner-create','uses'=>'DashboardController@createPartner']);
Route::post('partner-create',['as'=>'partner-create','uses'=>'DashboardController@storePartner']);
Route::get('partner-show',['as'=>'partner-show','uses'=>'DashboardController@showPartner']);
Route::get('partner-edit/{id}',['as'=>'partner-edit','uses'=>'DashboardController@editPartner']);
Route::put('partner-edit/{id}',['as'=>'partner-update','uses'=>'DashboardController@updatePartner']);
Route::post('partner-delete',['as'=>'partner-delete','uses'=>'DashboardController@deletePartner']);


Route::get('perfect-ipn',['as'=>'perfect-ipn','uses'=>'HomeController@perfectIPN']);
Route::post('stripe-preview',['as'=>'stripe-preview','uses'=>'UserController@stripePreview']);
Route::post('stripe-submit',['as'=>'stripe-submit','uses'=>'UserController@submitStripe']);

Route::get('withdraw-payment',['as'=>'withdraw-payment','uses'=>'DashboardController@getManualPayment']);
Route::post('withdraw-payment',['as'=>'withdraw-payment','uses'=>'DashboardController@storeManualPayment']);
Route::get('withdraw-payment/{task_id?}',['as'=>'withdraw-payment-edit','uses'=>'DashboardController@editManualPayment']);
Route::put('withdraw-payment/{task_id?}',['as'=>'withdraw-payment-edit','uses'=>'DashboardController@updateManualPayment']);
Route::post('payment-active',['as'=>'payment-active','uses'=>'DashboardController@paymentActive']);

Route::post('fund-check-amount',['as'=>'fund-check-amount','uses'=>'UserController@fundAddCheck']);

Route::post('withdraw-details',['as'=>'withdraw-details','uses'=>'HomeController@withdrawDetails']);

Route::get('repeat-generator',['as'=>'repeat-generator','uses'=>'HomeController@rebetgen']);
