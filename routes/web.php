<?php

Route::get('/', 'WelcomeController@index');
Route::get('/login','WelcomeController@login')->name('login');
Route::post('/login','AuthenticationController@attemptLogin');
//Registration process frontend
Route::get('/registration','WelcomeController@registration')->name('registration');
Route::post('/search-user','WelcomeController@userSearch')->name('user.search');
Route::get('/search-user','WelcomeController@showUserInformationFrom')->name('user.search');
Route::post('/user-information','WelcomeController@postUserInformation')->name('user.information');
Route::get('/user-information','WelcomeController@showUserScanInformationFrom')->name('user.information');
Route::post('/scan-user','WelcomeController@userScan')->name('user.scan');
Route::post('/registration-submission','WelcomeController@postScan')->name('registration.submission');
Route::get('/logout','AuthenticationController@logout')->name('logout');
Route::get('/about','WelcomeController@about')->name('about');
Route::get('/contact','WelcomeController@contact')->name('contact');
Route::get('/terms','WelcomeController@terms')->name('terms');
Route::get('/privacy','WelcomeController@privacy')->name('privacy');
Route::get('/faq','WelcomeController@faq')->name('faq');
Route::get('/our-services','WelcomeController@services');
Route::get('/flash-zone','UsersController@flashZone')->name('flash.zone');
Route::get('/remitanceCourrency/{id}','WelcomeController@getRemittanceCourrency');
Route::get('/calculate-rem/{id}/{amount}/{country}','WelcomeController@calculateRem');
Route::get('/trans-status/{id}','WelcomeController@getReportStatus');

Route::get('/profile/changeLogin','HomeController@getChangeLogin')->name('change-login');
Route::post('/profile/changeLogin','HomeController@postChangeLogin')->name('change-login');
//profile
Route::prefix('profile')->group(function () {
    Route::get('/','UsersController@getProfile')->name('profile');
    Route::get('change_password','UsersController@getChangePassword')->name('change-password');
    Route::post('change_password','UsersController@postChangePassword')->name('change-password');
    Route::get('change_pin','UsersController@getChangePin')->name('change-pin');
    Route::post('change_pin','UsersController@postChangePin')->name('change-pin');
    Route::get('recipients','UsersController@getProfileRecipient')->name('recipients');
});
//report
Route::prefix('report')->group(function () {
    Route::get('/','ReportController@getReport');
    Route::get('/{id}','ReportController@getReportDetails')  ;
});
//Account Report
Route::prefix('account')->group(function () {
    Route::get('/','ReportController@getAccountReport');
    Route::get('/{id}','ReportController@getAccountReportDetails');
});
//Rate
Route::prefix('rate')->group(function () {
    Route::get('/','ReportController@getCountryRates');
    Route::get('/calculate','CalculatorController@index');
    Route::get('/operators/{id}','CalculatorController@getOperators');
    Route::get('/country/{id}','CalculatorController@getCountry');
    Route::get('/remitanceCountry/{id}','CalculatorController@getRemittanceCountry');
    Route::get('/transferMode/{id}','CalculatorController@getTransferModes');
    Route::post('/calculate','CalculatorController@calculate');
});
// For Services
Route::get('/services','ServiceController@getServices')->name('services');
Route::get('/services/{id}','ServiceController@getServiceDetails')->name('services_details');

// Malaysia Topup
Route::any('my/review','Service\MalaysiaTopupController@review')->name('malaysia.topup.review');
Route::post('my/confirm','Service\MalaysiaTopupController@confirm')->name('malaysia.topup.confirm');
// Bangladesh Reload
Route::any('bangladesh_reload/review','Service\BangladeshTopupController@review')->name('bangladesh.topup.review');
Route::post('bangladesh_reload/confirm','Service\BangladeshTopupController@confirm')->name('bangladesh.topup.confirm');

// Nepal Reload
Route::any('nepal_reload/review','Service\NepalReloadController@review')->name('nepal.reload.review');
Route::post('nepal_reload/confirm','Service\NepalReloadController@confirm')->name('nepal.reload.confirm');
// Indonesia Pulsa
Route::any('indo_pulsa/review','Service\IndoPulsaController@review')->name('indo.reload.review');
Route::post('indo_pulsa/confirm','Service\IndoPulsaController@confirm')->name('indo.reload.confirm');
Route::get('indo_pulsa/{key}','ServiceController@getPulsaPackages')->name('indo.package');

//'Recipient Services
Route::post('recipient/verify','Service\RecipientServicesController@verify')->name('bank.transfer.verify');
Route::post('recipient/review','Service\RecipientServicesController@review')->name('bank.transfer.review');
Route::post('recipient/confirm','Service\RecipientServicesController@confirm')->name('bank.transfer.confirm');
Route::post('recipient/wallet/verify','Service\RecipientServicesController@verifyRecipientWalletServices')->name('recipient.wallet.verify');
Route::post('recipient/wallet/review','Service\RecipientServicesController@reviewRecipientWalletServices')->name('recipient.wallet.review');
Route::post('recipient/wallet/confirm','Service\RecipientServicesController@confirmRecipientWalletServices')->name('recipient.wallet.confirm');
Route::get('/tranglo-rate','ReportController@getTrangloRate');
Route::get('/wallet-tranglo-rate','ReportController@getwalletTrangloRate');
Route::get('/tranglo-status','ReportController@getTrangloStatus')->name('tranglo.status');;
Route::get('/tranglo-tracker','ReportController@tranglotracker');
Route::get('/tranglo-validation','ReportController@getTrangloValidation');
Route::get('/invoice/{id}/{flg}','ReportController@generateInvoicePrint');
Route::get('/calculate-au-point/{id}/{amount}/{country}','Service\RecipientServicesController@calculateAuPoint');
Route::get('/calculate-au-wallet-point/{id}/{amount}/{transferType}','Service\RecipientServicesController@calculateAuWalletPoint');

// User Recipient
Route::get('users/{user_id}/recipient/insidecreate','RecipientController@createInsideRecipient')->name('inside.recipient');
Route::post('users/{user_id}/recipient/insidecreate','RecipientController@postInsideRecipient')->name('inside.recipient');
Route::get('users/recipientaddsuccess','RecipientController@recipientaddsuccess');
Route::get('users/{user_id}/recipient/create','RecipientController@createRecipient')->name('recipient');
Route::post('users/{user_id}/recipient/create','RecipientController@postRecipient')->name('recipient');
Route::get('users/{user_id}/recipient/{recip_id}/delete','RecipientController@deleteRecipient');
Route::get('users/{user_id}/recipient/{recip_id}/edit','RecipientController@getRecipient');
Route::post('users/{user_id}/recipient/{recip_id}/edit','RecipientController@updateRecipient');
Route::get('/recipeint-bank-list','RecipientController@getRecipienrBank');
Route::get('/recipeint-bank-branch-list','RecipientController@getRecipienrBankBranch');
// Point Transfer
Route::post('point_transfer/review','Service\PointTransferController@review');
Route::post('point_transfer/confirm','Service\PointTransferController@confirm');

Route::post('account_topup/review','HomeController@reviewAccountTopupServices');
Route::post('account_topup/confirm','HomeController@confirmAccountTopupServices');

Route::get('account/report/{id}','ReportController@accountReportProcess');
Route::post('account/report/{id}','ReportController@accountReportUpdate');
Route::get('account/report/{id}/release','ReportController@accountReportRelease');
Route::get('operator-rates/{keyword}','ServiceController@getRates')->name('operator-rates');

//purchase
Route::get('/purchase','PaymentController@getPayments')->name('purchase');
Route::get('/purchase/{id}','PaymentController@getPayment');
Route::post('/payment/bank/review','PaymentController@reviewBankPayment');
Route::post('/payment/bank','PaymentController@confirmBankPayment');

// Rerpots
Route::get('/payment/reports','ReportController@getPaymentReport');
Route::get('user/reports/sales','ReportController@userSalesReport');
Route::get('user/reports','ReportController@userReportList');
Route::get('user/reports/{id}','ReportController@userReport');

Route::get('bank/reports','ReportController@bankReport');
Route::get('recipient/reports/{id}','ReportController@recipientReportProcess');
Route::post('recipient/reports/{id}','ReportController@recipientReportUpdate');
Route::get('recipient/reports/{id}/release','ReportController@recipientReportRelease');
Route::post('recipient/tag/{id}','ReportController@recipientReportTagUpdate');


Route::get('recipient/wallet/reports','ReportController@recipientWalletReport');
Route::get('recipient/wallet/report/{id}','ReportController@recipientWalletReportProcess');
Route::post('recipient/wallet/report/{id}','ReportController@recipientWalletReportUpdate');
Route::post('recipient/wallet/tag/{id}','ReportController@recipientWalletReportTagUpdate');
Route::get('recipient/wallet/reports/{id}/release','ReportController@recipientWalletReportRelease');

Route::get('cash/reports','ReportController@cashReport');
//MSP
Route::get('msp','ReportController@msp')->name('msp');
Route::post('msp','ReportController@postMsp')->name('msp');
Route::post('msp-status-update','ReportController@mspStatusUpdate')->name('msp.status.update');
Route::post('msp-password-update','ReportController@mspPasswordUpdate')->name('msp.password.update');
Route::post('msp-password-reset','ReportController@mspPasswordReset')->name('msp.password.reset');
Route::post('msp-risk-update','ReportController@mspRiskProfileUpdate')->name('msp.risk.update');
//User
Route::prefix('user')->group(function () {
    Route::get('/','UsersController@index')->name('user');
    Route::get('search','UsersController@userSearchView')->name('user-search');
    Route::post('search','UsersController@userSearch')->name('user-search');
    Route::get('update/{id?}','UsersController@updateProfile')->name('user.update');
    Route::post('update','UsersController@userInformationUpdatePost')->name('user.update');
    Route::get('register','UsersController@userRegister')->name('user.register');
    Route::post('register','UsersController@postRegister')->name('user.register');
    Route::post('informations/update','UsersController@userInformationUpdatePost')->name('user.informations.update');
});
Route::post('new-card', 'UsersController@addCard')->name('new-card');
Route::post('remove-card', 'UsersController@removeCard')->name('remove-card');

Route::get('refresh_captcha', 'WelcomeController@refreshCaptcha')->name('refresh_captcha');


