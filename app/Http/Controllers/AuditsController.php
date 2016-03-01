<?php

namespace App\Http\Controllers;

use App\Models\Audits;
use App\Models\Bid_Profile;
use App\Models\Bid_Profile_Entry;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\BWEntries;
use App\Models\BWList;
use App\Models\Campaign;
use App\Models\Client;
use App\Models\Creative;
use App\Models\GeoSegment;
use App\Models\GeoSegmentList;
use App\Models\ModelTable;
use App\Models\Offer;
use App\Models\Targetgroup;
use App\Models\Pixel;
use App\Models\Advertiser;


class AuditsController extends Controller
{
    public function generateRandomString($length = 80) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $randomString.=date('Y-m-d H:i:s');
        $randomString=Hash::make($randomString);
        return $randomString;
    }

    public function randomStr($length = 80) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getAllAudits(){
        if(Auth::check()){
            if(User::isSuperAdmin()){
                $audit= Audits::with('getUser')->orderBy('created_at','DESC')->get();
            }else {
                $usr_comp = $this->user_company();
                $audit= Audits::with('getUser')->whereIn('user_id', $usr_comp)->orderBy('created_at','DESC')->get();
            }
            $audit_obj= array();
            if($audit) {
                $sub = new AuditsController();
                $audit_obj = $sub->SubAudit($audit);
            }
            return view('audit.template.all_audits')
                ->with('audit_obj',$audit_obj);
        }
        return 'check ur login';
    }

    public function getAudit($id,$entity_id=null){
        if(Auth::check()){
            $query = '1';
            switch ($id){
                case 'client':
                    if(!is_null($entity_id)) {
                        $query .= " and (entity_type = 'client' and entity_id = '".$entity_id."')";
                    }else{
                        $query .= " and (entity_type = 'client')";
                    }
                    break;
                case 'advertiser':
                    if(!is_null($entity_id)) {
                        $query .= " and ((entity_type = 'advertiser' and entity_id = '".$entity_id."') or (entity_type = 'advertiser_model_map' and after_value = '".$entity_id."')) ";
                    }else{
                        $query .= " and (entity_type = 'advertiser' or entity_type = 'advertiser_model_map')";
                    }
                    break;
                case 'campaign':
                    if(!is_null($entity_id)) {
                        $query .= " and (entity_type = 'campaign' and entity_id = '".$entity_id."')";
                    }else{
                        $query .= " and (entity_type = 'campaign')";
                    }
                    break;
                case 'creative':
                    if(!is_null($entity_id)){
                        $query.=" and (entity_type = 'creative' and entity_id = '".$entity_id."')";
                    }else{
                        $query.=" and (entity_type = 'creative')";
                    }
                    break;
                case 'offer':
                    if(!is_null($entity_id)) {
                        $query .= " and ((entity_type = 'offer' and entity_id = '".$entity_id."') or (entity_type = 'offer_pixel_map' and after_value = '".$entity_id."')) ";
                    }else{
                        $query .= " and (entity_type = 'offer' or entity_type = 'offer_pixel_map')";
                    }
                    break;
                case 'pixel':
                    if(!is_null($entity_id)) {
                        $query .= " and (entity_type = 'pixel' and entity_id = '".$entity_id."')";
                    }else{
                        $query .= " and (entity_type = 'pixel')";
                    }
                    break;
                case 'targetgroup':
                    if(!is_null($entity_id)) {
                        $query .= " and (entity_type = 'targetgroup' and entity_id = '".$entity_id."')";
                    }else{
                        $query .= " and (entity_type = 'targetgroup')";
                    }
                    break;
                case 'geosegment':
                    if(!is_null($entity_id)) {
                        $query .= " and (entity_type = 'geosegment' and entity_id = '".$entity_id."')";
                    }else{
                        $query .= " and (entity_type = 'geosegment')";
                    }
                    break;
                case 'bwlist':
                    if(!is_null($entity_id)) {
                        $query .= " and ((entity_type = 'bwlist' and entity_id = '".$entity_id."') or (entity_type = 'bwlistentrie' and after_value = '".$entity_id."')) ";
                    }else{
                        $query .= " and (entity_type = 'bwlist' or entity_type = 'bwlistentrie')";
                    }
                    break;
                case 'bid_profile':
                    if(!is_null($entity_id)) {
                        $query .= " and ((entity_type = 'bid_profile' and entity_id = '".$entity_id."') or (entity_type = 'bid_profile_entry' and after_value = '".$entity_id."')) ";
                    }else{
                        $query .= " and (entity_type = 'bid_profile' or entity_type = 'bid_profile_entry')";
                    }
                    break;
                case 'model':
                    if(!is_null($entity_id)) {
                        $query .= " and ((entity_type = 'modelTable' and entity_id = '".$entity_id."') or (entity_type = 'negative_offer_model' and after_value = '".$entity_id."') or (entity_type = 'positive_offer_model' and after_value = '".$entity_id."')) ";
                    }else{
                        $query .= " and (entity_type = 'modelTable' or entity_type = 'negative_offer_model' or entity_type = 'positive_offer_model')";
                    }
                    break;
                case 'user_id':
                    $user_id=Auth::user()->id;
                    $query.=" and (user_id = '".$user_id."')";
                    break;

            }
            if(User::isSuperAdmin()){
                $audit= Audits::with('getUser')->whereRaw($query)->orderBy('created_at','DESC')->get();
            }else {
                $usr_comp = $this->user_company();
                $audit= Audits::with('getUser')->whereRaw($query)->whereIn('user_id', $usr_comp)->orderBy('created_at','DESC')->get();
            }
            $audit_obj= array();
            if($audit) {
                $sub = new AuditsController();
                $audit_obj = $sub->SubAudit($audit);
            }
            return view('audit.template.all_audits')
                ->with('audit_obj',$audit_obj);
        }
        return 'check ur login';
    }

    public function store($entity_type,$entity_id,$data='',$audit_type,$key='')
    {
        $date_change=date('Y-m-d H:i:s');
        if($key=='') {
            $key = $this->generateRandomString(80);
        }
        if($audit_type=='add') {
            $audit = new Audits();
            $audit->user_id = Auth::user()->id;
            $audit->entity_type = $entity_type;
            $audit->entity_id = $entity_id;
            if(!is_null($data)) {
                $audit->after_value = $data;
            }
            $audit->audit_type = 'add';
            $audit->change_key = $key;
            $audit->date_change = $date_change;
            $audit->save();
        }
        if($audit_type=='bulk_add') {
            $audit = new Audits();
            $audit->user_id = Auth::user()->id;
            $audit->entity_type = $entity_type;
            $audit->entity_id = $entity_id;
            $audit->after_value = $data;
            $audit->audit_type = 'bulk_add';
            $audit->change_key = $key;
            $audit->date_change = $date_change;
            $audit->save();
        }
        if($audit_type=='del') {
            $audit = new Audits();
            $audit->user_id = Auth::user()->id;
            $audit->entity_type = $entity_type;
            $audit->entity_id = $entity_id;
            $audit->before_value = $data[0];
            $audit->after_value = $data[1];
            $audit->audit_type = 'del';
            $audit->change_key = $key;
            $audit->date_change = $date_change;
            $audit->save();
        }
        if($audit_type=='remove') {
            $audit = new Audits();
            $audit->user_id = Auth::user()->id;
            $audit->entity_type = $entity_type;
            $audit->entity_id = $entity_id;
            if(!is_null($data))
                $audit->after_value = $data;
            $audit->audit_type = 'del';
            $audit->change_key = $key;
            $audit->date_change = $date_change;
            $audit->save();
        }
        if($audit_type=='edit') {
            $len=count($data);
            for($i=2;$i<$len;$i=$i+3) {
                $audit = new Audits();
                $audit->user_id = Auth::user()->id;
                $audit->entity_type = $entity_type;
                $audit->entity_id = $entity_id;
                $audit->field = $data[$i-2];
                $audit->before_value = $data[$i-1];
                $audit->after_value = $data[$i];
                $audit->audit_type = 'edit';
                $audit->change_key = $key;
                $audit->date_change = $date_change;
                $audit->save();
            }
        }
        if($audit_type=='bulk_edit') {
            $len=count($data);
            for($i=1;$i<$len;$i=$i+2) {
                $audit = new Audits();
                $audit->user_id = Auth::user()->id;
                $audit->entity_type = $entity_type;
                $audit->entity_id = $entity_id;
                $audit->field = $data[$i-1];
                $audit->after_value = $data[$i];
                $audit->audit_type = 'bulk_edit';
                $audit->change_key = $key;
                $audit->date_change = $date_change;
                $audit->save();
            }
        }
    }

    public function SubAudit($audit){
        $audit_obj = array();
        foreach($audit as $index){
            $entity_obj=null;
            switch ($index->entity_type){
                case 'client':
                    if(in_array('VIEW_CLIENT',$this->permission)) {
                        $entity_obj=Client::where('id',$index->entity_id)->get(['id','name']);
                    }
                    break;
                case 'advertiser':
                    if(in_array('VIEW_ADVERTISER',$this->permission)) {
                        $entity_obj=Advertiser::with('GetClientID')->where('id',$index->entity_id)->get();
                    }
                    break;
                case 'creative':
                    if(in_array('VIEW_CREATIVE',$this->permission)) {
                        $entity_obj = Creative::with(['getAdvertiser'=>function($q){
                            $q->with('GetClientID');
                        }])
                            ->where('id', $index->entity_id)->get();
                    }
                    break;
                case 'campaign':
                    if(in_array('VIEW_CAMPAIGN',$this->permission)) {
                        $entity_obj = Campaign::with(['getAdvertiser'=>function($q){
                            $q->with('GetClientID');
                        }])
                            ->where('id', $index->entity_id)->get();
                    }
                    break;
                case 'offer':
                    if(in_array('VIEW_OFFER',$this->permission)) {
                        $entity_obj = Offer::with(['getAdvertiser'=>function($q){
                            $q->with('GetClientID');
                        }])->where('id', $index->entity_id)->get();
                    }
                    break;
                case 'pixel':
                    if(in_array('VIEW_PIXEL',$this->permission)) {
                        $entity_obj = Pixel::with(['getAdvertiser'=>function($q){
                            $q->with('GetClientID');
                        }])->where('id', $index->entity_id)->get();
                    }
                    break;
                case 'targetgroup':
                    if(in_array('VIEW_TARGETGROUP',$this->permission)) {
                        $entity_obj = Targetgroup::where('id', $index->entity_id)->get(['id', 'name']);
                    }
                    break;
                case 'geosegment':
                    if(in_array('VIEW_GEOSEGMENTLIST',$this->permission)) {
                        $entity_obj = GeoSegmentList::with(['getAdvertiser'=>function($q){
                            $q->with('GetClientID');
                        }])
                            ->where('id', $index->entity_id)->get();
                    }
                    break;
                case 'geosegmententrie':
                    if(in_array('VIEW_GEOSEGMENTLIST',$this->permission)) {
                        if($index->audit_type=='del') {
                            $entity_obj = GeoSegmentList::where('id', $index->after_value)->get();
                        }else{
                            $entity_obj = GeoSegmentList::where('id', $index->after_value)->get();
                        }
                    }
                    break;
                case 'bwlist':
                    if(in_array('VIEW_BWLIST',$this->permission)) {
                        $entity_obj = BWList::with(['getAdvertiser'=>function($q){
                            $q->with('GetClientID');
                        }])
                            ->where('id', $index->entity_id)->get();
                    }
                    break;
                case 'bwlistentrie':
                    if(in_array('VIEW_BWLIST',$this->permission)) {
                        if($index->audit_type=='del') {
                            $entity_obj = BWList::where('id', $index->after_value)->get();

                        }else {
                            $entity_obj = BWList::where('id', $index->after_value)->get();
                        }
                    }
                    break;
                case 'bid_profile':
                    if(in_array('VIEW_BIDPROFILE',$this->permission)) {
                        $entity_obj = Bid_Profile::with(['getAdvertiser'=>function($q){
                            $q->with('GetClientID');
                        }])
                            ->where('id', $index->entity_id)->get();
                    }
                    break;
                case 'bid_profile_entry':
                    if(in_array('VIEW_BIDPROFILE',$this->permission)) {
                        if($index->audit_type=='del') {
                            $entity_obj = Bid_Profile::where('id', $index->after_value)->get();

                        }else {
                            $entity_obj = Bid_Profile_Entry::with('getParent')->where('id', $index->entity_id)->get();
                        }
                    }
                    break;
                case 'modelTable':
                    if(in_array('VIEW_MODEL',$this->permission)) {
                        if($index->audit_type=='del') {
                            $entity_obj = BWList::where('id', $index->after_value)->get();

                        }else{
                            $entity_obj = ModelTable::with(['getAdvertiser'=>function($q){
                                $q->with('GetClientID');
                            }])->where('id', $index->entity_id)->get();
                        }
                    }
                    break;
                case 'offer_pixel_map':
                    if(in_array('VIEW_OFFER',$this->permission)) {
                        $entity_obj = Pixel::with(['getAdvertiser'=>function($q){
                            $q->with('GetClientID');
                        }])->where('id', $index->entity_id)->get();
                    }
                    break;
                case 'advertiser_model_map':
                    if(in_array('VIEW_ADVERTISER',$this->permission)) {
                        $entity_obj = ModelTable::with(['getAdvertiser'=>function($q){
                            $q->with('GetClientID');
                        }])->where('id', $index->entity_id)->get();
                    }
                    break;
                case 'positive_offer_model':
                    if(in_array('VIEW_MODEL',$this->permission)) {
                        $entity_obj = Offer::with(['getAdvertiser'=>function($q){
                            $q->with('GetClientID');
                        }])->where('id', $index->entity_id)->get();
                    }
                    break;
                case 'negative_offer_model':
                    if(in_array('VIEW_MODEL',$this->permission)) {
                        $entity_obj = Offer::with(['getAdvertiser'=>function($q){
                            $q->with('GetClientID');
                        }])->where('id', $index->entity_id)->get();
                    }
                    break;
            }
            if(!is_null($entity_obj)) {
                array_push($audit_obj, $index);
                array_push($audit_obj, $entity_obj);
            }
        }

        return $audit_obj;
    }
}
