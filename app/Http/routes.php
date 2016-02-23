<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
//    return view('welcome');
});
Route::get('/dashboard','UsersController@GetDashboardView');

Route::post('/user/register/new', ['uses'=>'UsersController@user_create','as'=>'user_create']);
Route::get('/user','UsersController@GetView');
Route::get('/user/register','UsersController@RegisterView');
Route::get('/user/usr{id?}/edit','UsersController@EditView');
Route::get('/user/login','LoginController@LoginView');
Route::put('/user/edit/update', ['uses'=>'UsersController@edit_user','as'=>'user_update']);
Route::get('/user/add-role','UsersController@AddRoleView');
Route::post('/user/add-role/create', ['uses'=>'UsersController@role_create','as'=>'role_create']);
Route::get('/user/assign-permission/edit/{id?}','UsersController@AssignPermissionEditView');
Route::get('/user/role/edit/{id?}','UsersController@RoleEditView');
Route::put('/user/assign-permission/edit/update', ['uses'=>'UsersController@edit_permission_assign','as'=>'edit_permission_assign']);
Route::put('/user/role/edit/update', ['uses'=>'UsersController@edit_role','as'=>'edit_role']);
Route::get('/user/role-permission','UsersController@GetRolePermissionView');
Route::get('/bulk-editing','MangoController@BulkView');


/////////////////////////CLIENT///////////////////////////////////////////
Route::get('/client','ClientController@ListView');
Route::get('/client/add','ClientController@AddClientView');
Route::get('/client/cl{id?}/edit','ClientController@ClientEditView');
Route::post('/client/add/create', ['uses'=>'ClientController@add_client','as'=>'client_create']);
Route::put('/client/edit/update', ['uses'=>'ClientController@edit_client','as'=>'client_update']);
/////////////////////////END CLIENT///////////////////////////////////////////

/////////////////////////Company///////////////////////////////////////////
Route::get('/company','CompanyController@ListView');
Route::get('/company/add','CompanyController@AddCompanyView');
Route::get('/company/{id?}/edit','CompanyController@CompanyEditView');
Route::post('/company/add/create', ['uses'=>'CompanyController@add_company','as'=>'company_create']);
Route::put('/company/edit/update', ['uses'=>'CompanyController@edit_company','as'=>'company_update']);
/////////////////////////END Company///////////////////////////////////////////

/////////////////////////Inventory///////////////////////////////////////////
Route::get('/inventory','InventoryController@ListView');
Route::get('/inventory/add','InventoryController@AddInventoryView');
Route::get('/inventory/{id?}/edit','InventoryController@InventoryEditView');
Route::post('/inventory/add/create', ['uses'=>'InventoryController@add_inventory','as'=>'inventory_create']);
Route::put('/inventory/edit/update', ['uses'=>'InventoryController@edit_inventory','as'=>'inventory_update']);
/////////////////////////END Inventory///////////////////////////////////////////



/////////////////////////ADVERTISER///////////////////////////////////////////
Route::get('/client/cl{clid?}/advertiser/add','AdvertiserController@AddAdvertiserView');
Route::get('/client/cl{clid?}/advertiser/adv{id?}/edit',['uses'=>'AdvertiserController@AdvertiserEditView','as'=>'edit_advertiser']);
Route::get('/advertiser','AdvertiserController@GetView');
//Route::get('/advertiser/delete/{id?}','AdvertiserController@Delete_Advertiser');
Route::put('/advertiser/edit/update', ['uses'=>'AdvertiserController@edit_advertiser','as'=>'advertiser_update']);
Route::post('/advertiser/add/create', ['uses'=>'AdvertiserController@add_advertiser','as'=>'advertiser_create']);
/////////////////////////END ADVERTISER///////////////////////////////////////////

/////////////////////////CAMPAIGN///////////////////////////////////////////
Route::get('/campaign','CampaignController@GetView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/campaign/add','CampaignController@CampaignAddView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/campaign/cmp{cmpid?}/edit','CampaignController@CampaignEditView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/campaign/cmp{cmpid?}/clone/{clone?}','CampaignController@CampaignEditView');
Route::get('/campaign/delete/{id?}','CampaignController@DeleteCampaign');
Route::post('/campaign/add/create', ['uses'=>'CampaignController@add_campaign','as'=>'campaign_create']);
Route::put('/campaign/edit/update', ['uses'=>'CampaignController@edit_campaign','as'=>'campaign_update']);
Route::post('/campaign/upload', ['uses'=>'CampaignController@UploadCampaign','as'=>'campaign_upload']);

/////////////////////////END CAMPAIGN///////////////////////////////////////////


/////////////////////////END Segment///////////////////////////////////////////
Route::get('/segment','SegmentController@GetView');
/////////////////////////END Segment///////////////////////////////////////////


/////////////////////////TARGET GROUP///////////////////////////////////////////
Route::get('/targetgroup','TargetgroupController@GetView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/campaign/cmp{cmpid?}/targetgroup/add','TargetgroupController@TargetgroupAddView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/campaign/cmp{cmpid?}/targetgroup/tg{tgid?}/edit','TargetgroupController@TargetgroupEditView');
//Route::get('/targetgroup/delete/{id?}','TargetgroupController@DeleteTargetgroup');
Route::post('/targetgroup/add/create', ['uses'=>'TargetgroupController@add_targetgroup','as'=>'targetgroup_create']);
Route::put('/targetgroup/edit/update', ['uses'=>'TargetgroupController@edit_targetgroup','as'=>'targetgroup_update']);
Route::post('/targetgroup/upload', ['uses'=>'TargetgroupController@UploadTargetgroup','as'=>'targetgroup_upload']);

/////////////////////////END TARGET GROUP///////////////////////////////////////////


/////////////////////////CREATIVE///////////////////////////////////////////
Route::get('/creative','CreativeController@GetView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/creative/add','CreativeController@CreativeAddView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/creative/crt{crtid?}/edit','CreativeController@CreativeEditView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/creative/crt{crtid?}/clone/{clone?}','CreativeController@CreativeEditView');
Route::get('/creative/delete/{id?}','CreativeController@DeleteCreative');
Route::post('/creative/add/create', ['uses'=>'CreativeController@add_creative','as'=>'creative_create']);
Route::put('/creative/edit/update', ['uses'=>'CreativeController@edit_creative','as'=>'creative_update']);
Route::post('/creative/upload', ['uses'=>'CreativeController@UploadCreative','as'=>'creative_upload']);

/////////////////////////END CREATIVE///////////////////////////////////////////
/////////////////////////OFFER///////////////////////////////////////////
Route::get('/offer','OfferController@GetView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/offer/add','OfferController@OfferAddView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/offer/ofr{ofrid?}/edit','OfferController@OfferEditView');
Route::post('/offer/add/create', ['uses'=>'OfferController@add_offer','as'=>'offer_create']);
Route::put('/offer/edit/update', ['uses'=>'OfferController@edit_offer','as'=>'offer_update']);
/////////////////////////END OFFER///////////////////////////////////////////
/////////////////////////PIXEL///////////////////////////////////////////
Route::get('/pixel','PixelController@GetView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/pixel/add','PixelController@PixelAddView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/pixel/pxl{pxlid?}/edit','PixelController@PixelEditView');
Route::post('/pixel/add/create', ['uses'=>'PixelController@add_pixel','as'=>'pixel_create']);
Route::put('/pixel/edit/update', ['uses'=>'PixelController@edit_pixel','as'=>'pixel_update']);
/////////////////////////END PIXEL///////////////////////////////////////////

/////////////////////////GeoSegment///////////////////////////////////////////
Route::get('/geosegment','GeoSegmentController@GetView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/geosegment/add','GeoSegmentController@GeosegmentAddView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/geosegment/gsm{gsmid?}/edit','GeoSegmentController@GeosegmentEditView');
//Route::get('/creative/delete/{id?}','CreativeController@DeleteCreative');
Route::post('/geosegment/add/create', ['uses'=>'GeoSegmentController@add_geosegmentlist','as'=>'geosegmentlist_create']);
Route::put('/geosegment/edit/update', ['uses'=>'GeoSegmentController@edit_geosegmentlist','as'=>'geosegmentlist_update']);
Route::post('/geosegment/upload', ['uses'=>'GeoSegmentController@UploadGeosegment','as'=>'geosegment_upload']);

/////////////////////////END GeoSegment///////////////////////////////////////////

/////////////////////////BWLIST///////////////////////////////////////////
Route::get('/bwlist','BWListController@GetView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/bwlist/add','BWListController@BwlistAddView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/bwlist/bwl{crtid?}/edit','BWListController@BwlistEditView');
Route::get('/creative/delete/{id?}','CreativeController@DeleteCreative');
Route::post('/bwlist/add/create', ['uses'=>'BWListController@add_bwlist','as'=>'bwlist_create']);
Route::put('/bwlist/edit/update', ['uses'=>'BWListController@edit_bwlist','as'=>'bwlist_update']);
Route::post('/bwlist/upload', ['uses'=>'BWListController@UploadBwlist','as'=>'bwlist_upload']);
/////////////////////////END BWLIST///////////////////////////////////////////


/////////////////////////Bid Profile///////////////////////////////////////////
Route::get('/bid-profile','BidProfileController@GetView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/bid-profile/add','BidProfileController@BidProfileAddView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/bid-profile/bpf{bpfid?}/edit','BidProfileController@BidProfileEditView');
Route::post('/bid-profile/add/create', ['uses'=>'BidProfileController@add_bidProfile','as'=>'bidProfile_create']);
Route::put('/bid-profile/edit/update', ['uses'=>'BidProfileController@edit_bidProfile','as'=>'bidProfile_update']);
Route::post('/bid-profile/upload', ['uses'=>'BidProfileController@UploadBidProfile','as'=>'bid_profile_upload']);

/////////////////////////END Bid Profile///////////////////////////////////////////

/////////////////////////MODELS///////////////////////////////////////////
Route::get('/model','ModelController@GetView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/model/add','ModelController@ModelAddView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/model/mdl{mdlid?}/edit','ModelController@ModelEditView');
Route::get('/model/delete/{id?}','ModelController@DeleteModel');
Route::post('/model/add/create', ['uses'=>'ModelController@add_model','as'=>'model_create']);
Route::put('/model/edit/update', ['uses'=>'ModelController@edit_model','as'=>'model_update']);
/////////////////////////END MODELS///////////////////////////////////////////


Route::post('/user/login/do',['uses'=>'LoginController@postLogin','as'=>'user_login']);
Route::get('/user/logout',['uses'=>'LoginController@getLogout','as'=>'user_logout']);

Route::post('/ajax/client_list', 'ClientController@jqgrid');
Route::post('/bwlist_entries_edit', 'BWListController@jqgrid');
Route::post('/geosegment_edit', 'GeoSegmentController@jqgrid');
Route::get('/get_iab_sub_category/{id?}', ['uses'=>'TargetgroupController@Iab_Category','as'=>'get_iab_sub_category']);

Route::post('/getTableGridTG', 'TargetgroupController@getTableGrid');


Route::group(['prefix' => 'ajax'], function()
{
    ////////////////////BULK EDITING////////////////////////
    Route::get('/getCampaign', 'MangoController@getCampaign');
    Route::get('/getCampaignList/{adv_id?}', 'MangoController@getCampaignList');
    Route::get('/getCreativeList/{adv_id?}', 'MangoController@getCreativeList');
    Route::get('/getTargetgroupList/{cmp_id?}', 'MangoController@getTargetgroupList');
    Route::get('/getAdvertiserSelect/{cln_id?}', 'MangoController@getAdvertiserSelect');
    Route::get('/getCampaignSelect/{adv_id?}', 'MangoController@getCampaignSelect');
    Route::get('/getAssignList/{adv_id?}', 'MangoController@getAssign');
    Route::post('/bulk_campaign', ['uses'=>'MangoController@campaign_bulk','as'=>'campaign_bulk_update']);
    Route::post('/bulk_creative', ['uses'=>'MangoController@creative_bulk','as'=>'creative_bulk_update']);
    Route::get('/getCreative', 'MangoController@getCreative');
    Route::get('/getTargetgroup', 'MangoController@getTargetgroup');
    ////////////////////END BULK EDITING////////////////////////

    Route::get('/getAllAudits', 'AuditsController@getAllAudits');
    Route::get('/getAudit/{id?}/{entity_id?}', 'AuditsController@getAudit');
    Route::group(['prefix' => 'jqgrid'], function() {
        Route::put('/client', 'ClientController@jqgrid');
        Route::put('/advertiser', 'AdvertiserController@jqgrid');
        Route::put('/campaign', 'CampaignController@jqgrid');
        Route::put('/creative', 'CreativeController@jqgrid');
        Route::put('/offer', 'OfferController@jqgrid');
        Route::put('/pixel', 'PixelController@jqgrid');
        Route::put('/targetgroup', 'TargetgroupController@jqgrid');
        Route::put('/model', 'ModelController@jqgrid');
        Route::put('/user', 'UsersController@jqgrid');
        Route::put('/bwlist', 'BWListController@jqgridList');
        Route::put('/bid-profile', 'BidProfileController@jqgridList');
        Route::put('/bid-profile-entry', 'BidProfileController@jqgrid');
        Route::put('/geolist', 'GeoSegmentController@jqgridList');
    });
    Route::group(['prefix' => 'status'], function() {
        Route::get('/advertiser/{id?}', 'AdvertiserController@ChangeStatus');
        Route::get('/campaign/{id?}', 'CampaignController@ChangeStatus');
        Route::get('/creative/{id?}', 'CreativeController@ChangeStatus');
        Route::get('/geosegment/{id?}', 'GeoSegmentController@ChangeStatus');
        Route::get('/bwlist/{id?}', 'BWListController@ChangeStatus');
        Route::get('/bid_profile/{id?}', 'BidProfileController@ChangeStatus');
        Route::get('/targetgroup/{id?}', 'TargetgroupController@ChangeStatus');
        Route::get('/offer/{id?}', 'OfferController@ChangeStatus');
        Route::get('/pixel/{id?}', 'PixelController@ChangeStatus');
        Route::get('/user/{id?}', 'UsersController@ChangeStatus');
    });
//    Route::resource('features','FeatureController');
});

/////////////////////////////////REPORTING///////////////////////////////////////////
Route::get('/reporting',['uses'=>'ReportController@GetView','as'=>'getReportView']);
Route::post('/report/changestate',['uses'=>'ReportController@ChangeState','as'=>'changeState']);
/////////////////////////////////END REPORTING///////////////////////////////////////////

/////////////////////////////////Bid///////////////////////////////////////////
Route::post('/advertiser_publisher/create',['uses'=>'BidController@saveBid']);
Route::post('/report/changestate',['uses'=>'ReportController@ChangeState','as'=>'changeState']);
/////////////////////////////////END Bid///////////////////////////////////////////

