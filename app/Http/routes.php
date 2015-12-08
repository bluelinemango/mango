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


/////////////////////////CLIENT///////////////////////////////////////////
Route::get('/client','ClientController@ListView');
Route::get('/client/add','ClientController@AddClientView');
Route::get('/client/cl{id?}/edit','ClientController@ClientEditView');
Route::post('/client/add/create', ['uses'=>'ClientController@add_client','as'=>'client_create']);
Route::put('/client/edit/update', ['uses'=>'ClientController@edit_client','as'=>'client_update']);
/////////////////////////END CLIENT///////////////////////////////////////////



/////////////////////////ADVERTISER///////////////////////////////////////////
Route::get('/client/cl{clid?}/advertiser/add','AdvertiserController@AddAdvertiserView');
Route::get('/client/{clid?}/advertiser/adv{id?}/edit',['uses'=>'AdvertiserController@AdvertiserEditView','as'=>'edit_advertiser']);
Route::get('/advertiser','AdvertiserController@GetView');
//Route::get('/advertiser/delete/{id?}','AdvertiserController@Delete_Advertiser');
Route::put('/advertiser/edit/update', ['uses'=>'AdvertiserController@edit_advertiser','as'=>'advertiser_update']);
Route::post('/advertiser/add/create', ['uses'=>'AdvertiserController@add_advertiser','as'=>'advertiser_create']);
/////////////////////////END ADVERTISER///////////////////////////////////////////

/////////////////////////CAMPAIGN///////////////////////////////////////////
Route::get('/campaign','CampaignController@GetView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/campaign/add','CampaignController@CampaignAddView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/campaign/cmp{cmpid?}/edit','CampaignController@CampaignEditView');
Route::get('/campaign/delete/{id?}','CampaignController@DeleteCampaign');
Route::post('/campaign/add/create', ['uses'=>'CampaignController@add_campaign','as'=>'campaign_create']);
Route::put('/campaign/edit/update', ['uses'=>'CampaignController@edit_campaign','as'=>'campaign_update']);
/////////////////////////END CAMPAIGN///////////////////////////////////////////


/////////////////////////TARGET GROUP///////////////////////////////////////////
Route::get('/targetgroup','TargetgroupController@GetView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/campaign/cmp{cmpid?}/targetgroup/add','TargetgroupController@TargetgroupAddView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/campaign/cmp{cmpid?}/targetgroup/tg{tgid?}/edit','TargetgroupController@TargetgroupEditView');
//Route::get('/targetgroup/delete/{id?}','TargetgroupController@DeleteTargetgroup');
Route::post('/targetgroup/add/create', ['uses'=>'TargetgroupController@add_targetgroup','as'=>'targetgroup_create']);
Route::put('/targetgroup/edit/update', ['uses'=>'TargetgroupController@edit_targetgroup','as'=>'targetgroup_update']);
/////////////////////////END TARGET GROUP///////////////////////////////////////////


/////////////////////////CREATIVE///////////////////////////////////////////
Route::get('/creative','CreativeController@GetView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/creative/add','CreativeController@CreativeAddView');
Route::get('/client/cl{clid?}/advertiser/adv{advid?}/creative/crt{crtid?}/edit','CreativeController@CreativeEditView');
Route::get('/creative/delete/{id?}','CreativeController@DeleteCreative');
Route::post('/creative/add/create', ['uses'=>'CreativeController@add_creative','as'=>'creative_create']);
Route::put('/creative/edit/update', ['uses'=>'CreativeController@edit_creative','as'=>'creative_update']);
/////////////////////////END CREATIVE///////////////////////////////////////////

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

Route::post('/test', 'BWListController@jqgrid');
Route::get('/get_iab_sub_category/{id?}', ['uses'=>'TargetgroupController@Iab_Category','as'=>'get_iab_sub_category']);
