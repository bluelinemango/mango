<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
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
                }else{
                    $usr_company = User::where('company_id', Auth::user()->company_id)->get(['id'])->toArray();
                    $bwlist = BWList::with(['getEntries' => function ($q) {
                        $q->select(DB::raw('*,count(bwlist_id) as bwlist_count'))->groupBy('bwlist_id');
                    }])->with(['getAdvertiser' => function ($q) use($usr_company) {
                        $q->with(['GetClientID' => function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        }]);
                    }])->get();

                }
                return view('bwlist.list')->with('bwlist_obj',$bwlist);
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
                    $chkUser = Advertiser::with('GetClientID')->find($advid);
                    if (count($chkUser) > 0 and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $advertiser_obj = Advertiser::with('GetClientID')->find($advid);
                        return view('bwlist.add')->with('advertiser_obj', $advertiser_obj);
                    }else{
                        return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
                    }
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
                    $chkUser=BWList::with(['getAdvertiser'=>function($q){$q->with('GetClientID');}])->where('id',$bwlist_id)->get();
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser[0]->getAdvertiser->GetClientID->user_id) {
                        switch ($request->input('oper')) {
                            case 'edit':
                                $bwlist=BWList::find($bwlist_id);
                                if($bwlist){
                                    $bwlist->name=$request->input('name');
                                    $bwlist->save();
                                    return "ok";
                                }
                                return "false";
                                break;
                        }
                    }
                    return "invalid Black/White List  ID";

                }
                //return print_r($validate->messages());
                return Redirect::back()->withErrors(['success'=>false,'msg'=>$validate->messages()->all()])->withInput();
            }
            return "don't have permission";

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
                            switch ($request->input('oper')) {
                                case 'add':
                                    $bwentries = new BWEntries();
                                    $bwentries->domain_name = $request->input('domain_name');
                                    $bwentries->bwlist_id = $request->input('bwlist_id');
                                    $bwentries->save();
                                    $bwentries=BWEntries::where('id',$bwentries->id)->get();
//                                    return dd($result);
                                    return json_encode($bwentries);
                                break;
                                case 'edit':
                                    $bwentries = BWEntries::find($request->input('id'));
                                    $bwentries->domain_name = $request->input('domain_name');
                                    $bwentries->save();
                                    return 'ok';
                                break;
                                case 'del':
                                    BWEntries::delete($request->input('id'));
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
                        $a=explode(',',$request->input('id'));
                        foreach($a as $index){
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
                    $chkUser=Advertiser::with('GetClientID')->find($request->input('advertiser_id'));
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $chk=BWList::where('advertiser_id',$request->input('advertiser_id'))->get();
//                        return dd($chk);
                        $flg=0;
                        foreach($chk as $index){
                            if($index->name == $request->input('name') and $index->list_type == $request->input('list_type')){
                               $flg=1;
                            }
                        }
                        if($flg==0) {
                            $bwlist = new BWList();
                            $bwlist->name = $request->input('name');
                            $bwlist->list_type = $request->input('list_type');
                            $bwlist->advertiser_id = $request->input('advertiser_id');
                            $bwlist->save();
                            $audit= new AuditsController();
                            $audit->store('bwlist',$bwlist->id,null,'add');
                            $entries = explode(',', $request->input('domain_name'));
                            foreach ($entries as $index) {
                                $bwlistentries = new BWEntries();
                                $bwlistentries->domain_name = $index;
                                $bwlistentries->bwlist_id = $bwlist->id;
                                $bwlistentries->save();
                            }
                            return Redirect::to(url('/client/cl' . $chkUser->GetClientID->id . '/advertiser/adv' . $request->input('advertiser_id') . '/bwlist/bwl' . $bwlist->id . '/edit'))->withErrors(['success' => true, 'msg' => "B/W List added successfully"]);
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
                    $chkUser=Advertiser::with('GetClientID')->find($advid);
                    if(!is_null($chkUser) and Auth::user()->id == $chkUser->GetClientID->user_id) {
                        $bwlist_obj = BWList::with(['getAdvertiser' => function ($q) {
                            $q->with('GetClientID');
                        }])->with('getEntries')->find($bwlid);
//                    return dd($bwlist_obj);
                        return view('bwlist.edit')->with('bwlist_obj', $bwlist_obj);
                    }
                    return Redirect::back()->withErrors(['success'=>false,'msg'=>'please Select your Client'])->withInput();
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
                        if($bwlist->name!=$request->input('name')){
                            array_push($data,'name');
                            array_push($data,$bwlist->name);
                            array_push($data,$request->input('name'));
                            $bwlist->name=$request->input('name');
                        }
                        if($bwlist->list_type!=$request->input('list_type')){
                            array_push($data,'list_type');
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

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
