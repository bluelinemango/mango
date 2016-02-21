<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use App\Models\Audits;
use App\Models\BWEntries;
use App\Models\BWList;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;


class BWListController extends Controller
{
    public function GetView(){
        if(Auth::check()){
            if(in_array('VIEW_BWLIST',$this->permission)) {
                if (User::isSuperAdmin()) {
                    $bwlist = BWList::with(['getEntries' => function ($q) {
                        $q->select(DB::raw('*,count(bwlist_id) as bwlist_count'))->groupBy('bwlist_id');
                    }])->with(['getAdvertiser' => function ($q) {
                        $q->with('GetClientID');
                    }])->get();
                    $audit= Audits::with('getUser')
                        ->where('entity_type','bwlist')
                        ->orWhere('entity_type','bwlistentrie')
                        ->orderBy('created_at','DESC')->get();
                }else{
                    $usr_company = $this->user_company();
                    $bwlist = BWList::with(['getEntries' => function ($q) {
                        $q->select(DB::raw('*,count(bwlist_id) as bwlist_count'))->groupBy('bwlist_id');
                    }])->whereHas('getAdvertiser' , function ($q) use($usr_company) {
                        $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->get();
                    $audit= Audits::with('getUser')
                        ->where('entity_type','bwlist')
                        ->orWhere('entity_type','bwlistentrie')
                        ->whereIn('user_id', $usr_company)
                        ->orderBy('created_at','DESC')->get();
                }
                $audit_obj= array();
                if($audit) {
                    $sub = new AuditsController();
                    $audit_obj = $sub->SubAudit($audit);
                }
                return view('bwlist.list')
                    ->with('audit_obj',$audit_obj)
                    ->with('bwlist_obj',$bwlist);
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to('/user/login');
    }

    public function UploadBwlist(Request $request){
        $pattern= '/(((http|ftp|https):\/{2})?+(([0-9a-z_-]+\.)+(aero|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cu|cv|cx|cy|cz|cz|de|dj|dk|dm|do|dz|ec|ee|eg|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mk|ml|mn|mn|mo|mp|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|nom|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ra|rs|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw|arpa)(:[0-9]+)?((\/([~0-9a-zA-Z\#\+\%@\.\/_-]+))?(\?[0-9a-zA-Z\+\%@\/&\[\];=_-]+)?)?))\b/imuS
';
        if(Auth::check()){
            if(in_array('ADD_EDIT_BWLIST',$this->permission)) {
                if($request->hasFile('upload')) {
                    $chkUser=Advertiser::with('GetClientID')->find($request->input('advertiser_id'));
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $destpath=public_path();
                        $extension = $request->file('upload')->getClientOriginalExtension(); // getting image extension
                        $fileName = str_random(32).'.'.$extension;
                        $request->file('upload')->move($destpath.'/cdn/test/', $fileName);
                        $upload = Excel::load('public/cdn/test/'.$fileName,function($reader){
                            return $reader->all();
                            });
                        $a = array();
                        $flg=0;
                        foreach($upload->parsed as $test) {
                            foreach ($test as $key => $value) {
                                if($flg==0){
                                    array_push($a,$key);
                                }
                                array_push($a, $value);
                                $flg++;
                            }
                        }
                        $first_array=array_slice($a,0,2);
                        $second_array=array_slice($a,2);

                        if((count($first_array) == 2) and ($first_array[1]=='black' or $first_array[1] =='white')) {
                            $flg = 0;
                            $chk = BWList::where('advertiser_id', $request->input('advertiser_id'))->get();

                            foreach ($chk as $index) {
                                if ($index->name == $first_array[0] and $index->list_type == $first_array[1]) {
                                    $flg = 1;
                                }
                            }
                            if ($flg == 0) {
                                $lost= array();
                                $bwlist = new BWList();
                                $bwlist->name = $first_array[0];
                                $bwlist->list_type = $first_array[1];
                                $bwlist->advertiser_id = $request->input('advertiser_id');
                                $bwlist->save();
                                foreach ($second_array as $index) {
                                    if(preg_match($pattern,$index)){
                                        $bwlistentries = new BWEntries();
                                        $bwlistentries->domain_name = $index;
                                        $bwlistentries->bwlist_id = $bwlist->id;
                                        $bwlistentries->save();
                                    }else{
                                        array_push($lost,$index);
                                    }
                                }
                                $msg = "B/W List added successfully";
                                if(count($lost)>0){
                                    $msg.=" exept: ";
                                    foreach($lost as $index){
                                        $msg .=$index.',';
                                    }
                                }
                                return Redirect::back()->withErrors(['success' => false, 'msg' => $msg]);
                            }
                            return Redirect::back()->withErrors(['success'=>false,'msg'=>'this name already existed !!!'])->withInput();
                        }
                        return Redirect::back()->withErrors(['success'=>false,'msg'=>'make sure that youe Upload file is correct'])->withInput();
                    }
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                }
               return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select a file'])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

    public function BwlistAddView($clid,$advid){
        if(!is_null($advid)) {
            if (Auth::check()) {
                if(in_array('ADD_EDIT_BWLIST',$this->permission)) {
                    if (User::isSuperAdmin()) {
                        $advertiser_obj = Advertiser::with('GetClientID')->find($advid);
                    } else {
                        $usr_company = $this->user_company();
                        $advertiser_obj = Advertiser::whereHas('GetClientID', function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        })->find($advid);
                        if (!$advertiser_obj) {
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                        }
                    }
                    return view('bwlist.add')->with('advertiser_obj', $advertiser_obj);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('/user/login'));
        }
    }

    public function jqgridList(Request $request){
//        return dd($request->all());
        if(Auth::check()){
            if(in_array('ADD_EDIT_BWLIST',$this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $bwlist_id=substr($request->input('id'),3);
//                    return dd($model_id);
                    if (User::isSuperAdmin()) {
                        $bwlist=BWList::find($bwlist_id);
                    }else{
                        $usr_company = $this->user_company();
                        $bwlist=BWList::whereHas('getAdvertiser' , function ($q) use ($usr_company){
                            $q->whereHas('GetClientID' ,function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->find($bwlist_id);
                        if (!$bwlist) {
                            return $msg=(['success' => false, 'msg' => "Some things went wrong"]);
                        }
                    }
                    if ($bwlist) {
                        $data = array();
                        $audit = new AuditsController();
                        if ($bwlist->name != $request->input('name')) {
                            array_push($data, 'Name');
                            array_push($data, $bwlist->name);
                            array_push($data, $request->input('name'));
                            $bwlist->name = $request->input('name');
                        }
                        $audit->store('campaign', $bwlist_id, $data, 'edit');
                        $bwlist->save();
                        return $msg=(['success' => true, 'msg' => "your Campaign Saved successfully"]);
                    }

                    return $msg=(['success' => false, 'msg' => "Please Select a Campaign First"]);

                }
                //return print_r($validate->messages());
                return $msg=(['success' => false, 'msg' => "Please Check your field"]);
            }
            return $msg=(['success' => false, 'msg' => "You don't have permission"]);

        }
        return Redirect::to(url('/user/login'));
    }

    public function jqgrid(Request $request){
        $pattern= '/(((http|ftp|https):\/{2})?+(([0-9a-z_-]+\.)+(aero|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cu|cv|cx|cy|cz|cz|de|dj|dk|dm|do|dz|ec|ee|eg|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mk|ml|mn|mn|mo|mp|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|nom|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ra|rs|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw|arpa)(:[0-9]+)?((\/([~0-9a-zA-Z\#\+\%@\.\/_-]+))?(\?[0-9a-zA-Z\+\%@\/&\[\];=_-]+)?)?))\b/imuS
';
//        return dd($request->all());
        if(Auth::check()){
            if(1==1){    //permission goes here
                $validate=\Validator::make($request->all(),['domain_name' => 'required']);
                if($validate->passes()) {
                    $chkUser=BWList::with(['getAdvertiser'=>function($q){$q->with('GetClientID');}])->find($request->input('bwlist_id'));
//                    return dd($chkUser);
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->getAdvertiser->GetClientID->user_id) {
                        if(preg_match($pattern,$request->input('domain_name'))) {
                            $audit= new AuditsController();
                            switch ($request->input('oper')) {
                                case 'add':
                                    $bwentries = new BWEntries();
                                    $bwentries->domain_name = $request->input('domain_name');
                                    $bwentries->bwlist_id = $request->input('bwlist_id');
                                    $bwentries->save();
                                    $audit->store('bwlistentrie',$bwentries->id,$request->input('bwlist_id'),'add');
                                    $bwentries=BWEntries::where('id',$bwentries->id)->get();
//                                    return dd($result);
                                    return json_encode($bwentries);
                                break;
                                case 'edit':
                                    $bwentries = BWEntries::find($request->input('id'));
                                    $data=array();
                                    if($bwentries->domain_name != $request->input('domain_name')){
                                        array_push($data,'domain_name');
                                        array_push($data,$bwentries->domain_name);
                                        array_push($data,$request->input('domain_name'));
                                        $bwentries->domain_name=$request->input('domain_name');
                                    }
                                    $audit->store('bwlistentrie',$request->input('id'),$data,'edit');
                                    $bwentries->save();
                                    return 'ok';
                                break;
                            }
                        }else{
                            return "PLZ enter valid Web site domain";
                        }
                    }

                }
                switch ($request->input('oper')) {
                    case 'del':
                        $audit= new AuditsController();
                        $key= new AuditsController();
                        $key=$key->generateRandomString();

                        $a=explode(',',$request->input('id'));
                        foreach($a as $index){
                            $b=array();
                            $bname=BWEntries::with('getParent')->where('id',$index)->get();
//                            return dd($gname[0]->getParent->id);
                            array_push($b,$bname[0]->name);
                            array_push($b,$bname[0]->getParent->id);
                            $audit->store('bwlistentrie',$request->input('id'),$b,'del',$key);
                            BWEntries::where('id',$index)->delete();
                        }
                        return 'ok';
                    break;
                }
                //return print_r($validate->messages());
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
        }else{
            return Redirect::to('/user/login');
        }
    }

    public function add_bwlist(Request $request){
        if(Auth::check()){
            if(in_array('ADD_EDIT_BWLIST',$this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    if (User::isSuperAdmin()) {
                        $advertiser_obj = Advertiser::with('GetClientID')->find($request->input('advertiser_id'));
                    } else {
                        $usr_company = $this->user_company();
                        $advertiser_obj = Advertiser::whereHas('GetClientID' , function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        })->find($request->input('advertiser_id'));
                        if(!$advertiser_obj){
                            return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                        }
                    }
                    if ($advertiser_obj) {
                        $chk=BWList::where('advertiser_id',$request->input('advertiser_id'))->get();
//                        return dd($chk);
                        $flg=0;
                        foreach($chk as $index){
                            if($index->name == $request->input('name') and $index->list_type == $request->input('list_type')){
                               $flg=1;
                            }
                        }
                        if($flg==0) {
                            $active='Inactive';
                            if($request->input('active')=='on'){
                                $active='Active';
                            }
                            $key= new AuditsController();
                            $key=$key->generateRandomString();
                            $audit= new AuditsController();
                            $bwlist = new BWList();
                            $bwlist->name = $request->input('name');
                            $bwlist->status = $active;
                            $bwlist->list_type = $request->input('list_type');
                            $bwlist->advertiser_id = $request->input('advertiser_id');
                            $bwlist->save();
                            $audit->store('bwlist',$bwlist->id,null,'add',$key);
                            $entries = explode(',', $request->input('domain_name'));
                            foreach ($entries as $index) {
                                $bwlistentries = new BWEntries();
                                $bwlistentries->domain_name = $index;
                                $bwlistentries->bwlist_id = $bwlist->id;
                                $bwlistentries->save();
                                $audit->store('bwlistentrie',$bwlistentries->id,null,'add',$key);
                            }
                            return Redirect::to(url('/client/cl' . $advertiser_obj->GetClientID->id . '/advertiser/adv' . $request->input('advertiser_id') . '/bwlist/bwl' . $bwlist->id . '/edit'))->withErrors(['success' => true, 'msg' => "B/W List added successfully"]);
                        }
                        return Redirect::back()->withErrors(['success'=>false,'msg'=>'this name already existed !!!'])->withInput();
                    }
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

    public function BwlistEditView($clid,$advid,$bwlid){
        if(!is_null($bwlid)){
            if(Auth::check()){
                if(in_array('ADD_EDIT_BWLIST',$this->permission)) {
                    if (User::isSuperAdmin()) {
                        $bwlist_obj = BWList::with(['getAdvertiser' => function ($q) {
                            $q->with('GetClientID');
                        }])->with('getEntries')->find($bwlid);
                    } else {
                        $usr_company = $this->user_company();
                        $bwlist_obj = BWList::whereHas('getAdvertiser' , function ($q) use ($usr_company){
                            $q->whereHas('GetClientID' ,function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->with('getEntries')->find($bwlid);
                        if (!$bwlist_obj) {
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                        }
                    }
                    return view('bwlist.edit')->with('bwlist_obj', $bwlist_obj);
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
            }
            return Redirect::to(url('/user/login'));
        }
    }

    public function edit_bwlist(Request $request){
        if(Auth::check()){
            if(in_array('ADD_EDIT_BWLIST',$this->permission)) {
                $validate=\Validator::make($request->all(),['name' => 'required']);
                if($validate->passes()) {
                    $bwlist_id = $request->input('bwlist_id');
                    $bwlist=BWList::find($bwlist_id);
                    if($bwlist){
                        $data=array();
                        $audit= new AuditsController();
                        $active='Inactive';
                        if($request->input('active')=='on'){
                            $active='Active';
                        }
                        if($bwlist->name!=$request->input('name')){
                            array_push($data,'Name');
                            array_push($data,$bwlist->name);
                            array_push($data,$request->input('name'));
                            $bwlist->name=$request->input('name');
                        }
                        if ($bwlist->status != $active) {
                            array_push($data, 'Status');
                            array_push($data, $bwlist->status);
                            array_push($data, $active);
                            $bwlist->status = $active;
                        }

                        if($bwlist->list_type!=$request->input('list_type')){
                            array_push($data,'List Type');
                            array_push($data,$bwlist->list_type);
                            array_push($data,$request->input('list_type'));
                            $bwlist->list_type=$request->input('list_type');
                        }
                        $bwlist->save();
                        $audit->store('bwlist',$bwlist_id,$data,'edit');
                        return Redirect::back()->withErrors(['success'=>true,'msg'=> 'B/W List Edited Successfully']);
                    }
                }
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success'=>false,'msg'=>"You don't have permission"]);
        }
        return Redirect::to(url('user/login'));
    }

    public function ChangeStatus($id){
        if(Auth::check()){
            if (in_array('ADD_EDIT_BWLIST', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $entity=BWList::find($id);
                } else {
                    $usr_company = $this->user_company();
                    $entity = BWList::whereHas('getAdvertiser' , function ($q) use($usr_company) {
                        $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->find($id);
                    if(!$entity){
                        return 'please Select your Client';
                    }
                }
                if($entity){
                    $data=array();
                    $audit= new AuditsController();
                    if($entity->status=='Active'){
                        array_push($data,'status');
                        array_push($data,$entity->status);
                        array_push($data,'Inactive');
                        $entity->status='Inactive';
                        $msg='disable';
                    }elseif($entity->status=='Inactive'){
                        array_push($data,'status');
                        array_push($data,$entity->status);
                        array_push($data,'Active');
                        $entity->status='Active';
                        $msg='actived';
                    }
                    $audit->store('bwlist',$id,$data,'edit');
                    $entity->save();
                    return $msg;
                }
            }
            return "You don't have permission";
        }
        return Redirect::to(url('user/login'));
    }

}
