<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Advertiser;
use App\Models\Bid_Profile;
use App\Models\Bid_Profile_Entry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;


class BidProfileController extends Controller
{
    private $pattern = '/(((http|ftp|https):\/{2})?+(([0-9a-z_-]+\.)+(aero|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cu|cv|cx|cy|cz|cz|de|dj|dk|dm|do|dz|ec|ee|eg|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mk|ml|mn|mn|mo|mp|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|nom|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ra|rs|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw|arpa)(:[0-9]+)?((\/([~0-9a-zA-Z\#\+\%@\.\/_-]+))?(\?[0-9a-zA-Z\+\%@\/&\[\];=_-]+)?)?))\b/imuS
';

    public function LoadJson($parent_id)
    {
//        return dd($request->all());
        if (Auth::check()) {
            if (User::isSuperAdmin()) {
                $bid_profile_obj = Bid_Profile::with('getEntries')->find($parent_id);
            } else {
                $usr_company = $this->user_company();
                $bid_profile_obj = Bid_Profile::whereHas('getAdvertiser', function ($q) use ($usr_company) {
                    $q->whereHas('GetClientID', function ($p) use ($usr_company) {
                        $p->whereIn('user_id', $usr_company);
                    });
                })->with('getEntries')->find($parent_id);
            }
            if ($bid_profile_obj) {
                foreach ($bid_profile_obj->getEntries as $index) {
                    $index->setAttribute('parent_id', $parent_id);
                    ($index->bid_strategy == 'Absolute') ? $index->bid_strategy = 1 : $index->bid_strategy = 2;
                }
                return json_encode($bid_profile_obj->getEntries);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "select correct Bid Profile!"]);
        }
        return Redirect::to(url('/user/login'));
    }


    public function GetView()
    {
        if (Auth::check()) {
            if (in_array('VIEW_BIDPROFILE', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $bid_profile = Bid_Profile::with(['getEntries' => function ($q) {
                        $q->select(DB::raw('*,count(bid_profile_id) as bid_profile_count'))->groupBy('bid_profile_id');
                    }])->with(['getAdvertiser' => function ($q) {
                        $q->with('GetClientID');
                    }])->get();
                } else {
                    $usr_company = $this->user_company();
                    $bid_profile = Bid_Profile::with(['getEntries' => function ($q) {
                        $q->select(DB::raw('*,count(bid_profile_id) as bid_profile_count'))->groupBy('bid_profile_id');
                    }])->whereHas('getAdvertiser', function ($q) use ($usr_company) {
                        $q->whereHas('GetClientID', function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->get();
                }
                return view('bid_profile.list')
                    ->with('bid_profile_obj', $bid_profile);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

    public function BidProfileAddView($clid, $advid)
    {
        if (!is_null($advid)) {
            if (Auth::check()) {
                if (in_array('ADD_EDIT_BIDPROFILE', $this->permission)) {
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
                    return view('bid_profile.add')->with('advertiser_obj', $advertiser_obj);
                }
                return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
            }
            return Redirect::to(url('/user/login'));
        }
    }

    public function add_bidProfile(Request $request)
    {
        if (Auth::check()) {
            if (in_array('ADD_EDIT_BIDPROFILE', $this->permission)) {
                $validate = \Validator::make($request->all(), ['name' => 'required']);
                if ($validate->passes()) {
                    if (User::isSuperAdmin()) {
                        $advertiser_obj = Advertiser::with('GetClientID')->find($request->input('advertiser_id'));
                    } else {
                        $usr_company = $this->user_company();
                        $advertiser_obj = Advertiser::whereHas('GetClientID', function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        })->find($request->input('advertiser_id'));
                        if (!$advertiser_obj) {
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                        }
                    }
                    if ($advertiser_obj) {
                        $chk = Bid_Profile::where('advertiser_id', $request->input('advertiser_id'))->get();
                        foreach ($chk as $index) {
                            if ($index->name == $request->input('name')) {
                                return Redirect::back()->withErrors(['success' => false, 'msg' => 'this name already existed !!!'])->withInput();
                            }
                        }
                        $active = 'Inactive';
                        if ($request->input('active') == 'on') {
                            $active = 'Active';
                        }
                        $key = new AuditsController();
                        $key = $key->generateRandomString();
                        $audit = new AuditsController();
                        $bid_profile = new Bid_Profile();
                        $bid_profile->name = $request->input('name');
                        $bid_profile->status = $active;
                        $bid_profile->advertiser_id = $request->input('advertiser_id');
                        $bid_profile->save();
                        $audit->store('bid_profile', $bid_profile->id, null, 'add', $key);


//                        $entries = explode(',', $request->input('domain_name'));
//                        foreach ($entries as $index) {
//                            $bwlistentries = new BWEntries();
//                            $bwlistentries->domain_name = $index;
//                            $bwlistentries->bwlist_id = $bwlist->id;
//                            $bwlistentries->save();
//                            $audit->store('bwlistentrie',$bwlistentries->id,null,'add',$key);
//                        }
                        return Redirect::to(url('/client/cl' . $advertiser_obj->GetClientID->id . '/advertiser/adv' . $request->input('advertiser_id') . '/bid-profile/bpf' . $bid_profile->id . '/edit'))->withErrors(['success' => true, 'msg' => "Bid Profile added successfully"]);
                    }

                }
                return Redirect::back()->withErrors(['success' => false, 'msg' => $validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

    public function BidProfileEditView($clid, $advid, $bpfid)
    {
        if (!is_null($bpfid)) {
            if (Auth::check()) {
                if (in_array('ADD_EDIT_BIDPROFILE', $this->permission)) {
                    if (User::isSuperAdmin()) {
                        $bid_profile_obj = Bid_Profile::with(['getAdvertiser' => function ($q) {
                            $q->with('GetClientID');
                        }])->with('getEntries')->find($bpfid);
                    } else {
                        $usr_company = $this->user_company();
                        $bid_profile_obj = Bid_Profile::whereHas('getAdvertiser', function ($q) use ($usr_company) {
                            $q->whereHas('GetClientID', function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->with('getEntries')->find($bpfid);
                        if (!$bid_profile_obj) {
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                        }
                    }
                    return view('bid_profile.edit')->with('bid_profile_obj', $bid_profile_obj);
                }
                return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
            }
            return Redirect::to(url('/user/login'));
        }
    }

    public function edit_bidProfile(Request $request)
    {
        if (Auth::check()) {
            if (in_array('ADD_EDIT_BIDPROFILE', $this->permission)) {
                $validate = \Validator::make($request->all(), ['name' => 'required']);
                if ($validate->passes()) {
                    $bidProfile_id = $request->input('bidProfile_id');

                    if (User::isSuperAdmin()) {
                        $Bid_profile = Bid_Profile::find($bidProfile_id);
                    } else {
                        $usr_company = $this->user_company();
                        $Bid_profile = Bid_Profile::whereHas('getAdvertiser', function ($q) use ($usr_company) {
                            $q->whereHas('GetClientID', function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->find($bidProfile_id);
                        if (!$Bid_profile) {
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                        }
                    }
                    if ($Bid_profile) {
                        $data = array();
                        $audit = new AuditsController();
                        $active = 'Inactive';
                        if ($request->input('active') == 'on') {
                            $active = 'Active';
                        }
                        if ($Bid_profile->name != $request->input('name')) {
                            array_push($data, 'Name');
                            array_push($data, $Bid_profile->name);
                            array_push($data, $request->input('name'));
                            $Bid_profile->name = $request->input('name');
                        }
                        if ($Bid_profile->status != $active) {
                            array_push($data, 'Status');
                            array_push($data, $Bid_profile->status);
                            array_push($data, $active);
                            $Bid_profile->status = $active;
                        }

                        $Bid_profile->save();
                        $audit->store('bid_profile', $bidProfile_id, $data, 'edit');
                        return Redirect::back()->withErrors(['success' => true, 'msg' => 'Bid Profile Edited Successfully']);
                    }
                    return Redirect::back()->withErrors(['success' => false, 'msg' => "Please Select Bid Profile First"]);
                }
                return Redirect::back()->withErrors(['success' => false, 'msg' => $validate->messages()->all()])->withInput();
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
        return Redirect::to(url('user/login'));
    }

    public function ChangeStatus($id)
    {
        if (Auth::check()) {
            if (in_array('ADD_EDIT_BIDPROFILE', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $entity = Bid_Profile::find($id);
                } else {
                    $usr_company = $this->user_company();
                    $entity = Bid_Profile::whereHas('getAdvertiser', function ($q) use ($usr_company) {
                        $q->whereHas('GetClientID', function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->find($id);
                    if (!$entity) {
                        return 'please Select your Client';
                    }
                }
                if ($entity) {
                    $data = array();
                    $audit = new AuditsController();
                    if ($entity->status == 'Active') {
                        array_push($data, 'status');
                        array_push($data, $entity->status);
                        array_push($data, 'Inactive');
                        $entity->status = 'Inactive';
                        $msg = 'disable';
                    } elseif ($entity->status == 'Inactive') {
                        array_push($data, 'status');
                        array_push($data, $entity->status);
                        array_push($data, 'Active');
                        $entity->status = 'Active';
                        $msg = 'actived';
                    }
                    $audit->store('bid_profile', $id, $data, 'edit');
                    $entity->save();
                    return $msg;
                }
            }
            return "You don't have permission";
        }
        return Redirect::to(url('user/login'));
    }

    public function jqgridList(Request $request)
    {
//        return dd($request->all());
        if (Auth::check()) {
            if (in_array('ADD_EDIT_BIDPROFILE', $this->permission)) {
                $validate = \Validator::make($request->all(), ['name' => 'required']);
                if ($validate->passes()) {
                    $bid_profile_id = substr($request->input('id'), 3);
                    if (User::isSuperAdmin()) {
                        $bid_profile = Bid_Profile::find($bid_profile_id);
                    } else {
                        $usr_company = $this->user_company();
                        $bid_profile = Bid_Profile::whereHas('getAdvertiser', function ($q) use ($usr_company) {
                            $q->whereHas('GetClientID', function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->find($bid_profile_id);
                    }
                    if ($bid_profile) {
                        $data = array();
                        $audit = new AuditsController();
                        if ($bid_profile->name != $request->input('name')) {
                            array_push($data, 'Name');
                            array_push($data, $bid_profile->name);
                            array_push($data, $request->input('name'));
                            $bid_profile->name = $request->input('name');
                        }
                        $audit->store('bid_profile', $bid_profile_id, $data, 'edit');
                        $bid_profile->save();
                        return $msg = (['success' => true, 'msg' => "your Bid Profile Saved successfully"]);
                    }
                    return $msg = (['success' => false, 'msg' => "Please Select a Bid Profile First"]);
                }
                return $msg = (['success' => false, 'msg' => "Please fill all Fields"]);
            }
            return $msg = (['success' => false, 'msg' => "You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }

    public function jqgrid(Request $request)
    {  // TODO: must be in inventory
//        return dd($request->all());
        if (Auth::check()) {
            if (in_array('ADD_EDIT_BIDPROFILE', $this->permission)) {    //permission goes here
                $rules = array('domain' => 'required', 'bid_strategy' => 'required');
                if($request->input('oper')=='edit'){
                    $rules['bid_value'] = 'required';
                }else {
                    if ($request->input('bid_strategy') == 'Absolute' or $request->input('bid_strategy') == 1) {
                        $rules['bid_value'] = 'required';
                    } else {
                        $rules["bid_value1"] = 'required';
                    }
                }
                $validate = \Validator::make($request->all(), $rules);
                if ($validate->passes()) {
//                    return dd($request->input('parent_id'));
                    if (User::isSuperAdmin()) {
                        $bid_profile_obj = Bid_Profile::find($request->input('parent_id'));

                    } else {
                        $usr_company = $this->user_company();
                        $bid_profile_obj = Bid_Profile::whereHas('getAdvertiser', function ($q) use ($usr_company) {
                            $q->whereHas('GetClientID', function ($p) use ($usr_company) {
                                $p->whereIn('user_id', $usr_company);
                            });
                        })->find($request->input('parent_id'));
                        if (!$bid_profile_obj) {
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                        }
                    }
                    if ($bid_profile_obj) {
                        if (preg_match($this->pattern, $request->input('domain'))) {
//                            return dd($request->all());
                            $audit = new AuditsController();
                            switch ($request->input('oper')) {
                                case 'add':
                                    $chk = Bid_Profile_Entry::where('bid_profile_id', $request->input('parent_id'))->get();
                                    foreach ($chk as $index) {
                                        if ($index->domain == $request->input('domain')) {
                                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'this name already existed !!!'])->withInput();
                                        }
                                    }
                                    $bid_profile_entry = new Bid_Profile_Entry();
                                    $bid_profile_entry->domain = $request->input('domain');
                                    $bid_profile_entry->bid_strategy = $request->input('bid_strategy');
                                    $bid_profile_entry->bid_profile_id = $request->input('parent_id');
                                    $bid_profile_entry->bid_value = ($request->has('bid_value')) ? $request->input('bid_value') : $request->input('bid_value1');
                                    $bid_profile_entry->save();
                                    $audit->store('bid_profile_entry', $bid_profile_entry->id, $request->input('parent_id'), 'add');
                                    return $msg = (['success' => true, 'msg' => "your Entry has been Added"]);
                                    break;
                                case 'edit':
                                    $bid_profile_entry = Bid_Profile_Entry::where('bid_profile_id', $request->input('parent_id'))->where('id', $request->input('id'))->first();
                                    if ($bid_profile_entry) {
                                        $data = array();
                                        if ($bid_profile_entry->domain != $request->input('domain')) {
                                            array_push($data, 'Domain');
                                            array_push($data, $bid_profile_entry->domain);
                                            array_push($data, $request->input('domain'));
                                            $bid_profile_entry->domain = $request->input('domain');
                                        }
                                        $bid_strategy = ($request->input('bid_strategy') == 1) ? 'Absolute' : 'Percentage';
//                                        return dd($bid_strategy);
                                        if ($bid_profile_entry->bid_strategy != $bid_strategy) {
                                            array_push($data, 'Bid Strategy');
                                            array_push($data, $bid_profile_entry->bid_strategy);
                                            array_push($data, $bid_strategy);
                                            $bid_profile_entry->bid_strategy = $bid_strategy;
                                        }
                                        if ($bid_profile_entry->bid_value != $request->input('bid_value')) {
                                            array_push($data, 'Bid Value');
                                            array_push($data, $bid_profile_entry->bid_value);
                                            array_push($data, $request->input('bid_value'));
                                            $bid_profile_entry->bid_value = $request->input('bid_value');
                                        }
                                        $audit->store('bid_profile_entry', $request->input('id'), $data, 'edit');
                                        $bid_profile_entry->save();
                                        return $msg = (['success' => true, 'msg' => "your Entry has been Edited"]);
                                    }
                                    return 'some things went wrong!';
                                    break;
                                case 'del':
                                    $audit= new AuditsController();
                                    $d=array($request->input('id'),$request->input('parent_id'));
                                    $audit->store('bid_profile_entry',$request->input('id'),$d,'del');
                                    Bid_Profile_Entry::where('id',$request->input('id'))->where('bid_profile_id',$request->input('parent_id'))->delete();
                                    return $msg=(['success' => true, 'msg' => "your Entry has been Deleted"]);
                                    break;
                            }
                        }
                        return $msg = (['success' => false, 'msg' => "PLZ enter valid Web site domain"]);
                    }
                    return $msg = (['success' => false, 'msg' => "please select correct Bid Profile!"]);
                }
                //return print_r($validate->messages());
                return $msg = (['success' => false, 'msg' => "please Check your fields"]);
            }
        }
        return Redirect::to(url('/user/login'));
    }

    public function UploadBidProfile(Request $request)
    {
//        return dd($request->all());
        if (Auth::check()) {
            if (in_array('ADD_EDIT_BIDPROFILE', $this->permission)) {
                $validate = \Validator::make($request->all(), ['name' => 'required']);
                if ($request->hasFile('upload_bid_profile') and $validate->passes()) {
                    if (User::isSuperAdmin()) {
                        $advertiser_obj = Advertiser::with('GetClientID')->find($request->input('advertiser_id'));
                    } else {
                        $usr_company = $this->user_company();
                        $advertiser_obj = Advertiser::whereHas('GetClientID', function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        })->find($request->input('advertiser_id'));
                        if (!$advertiser_obj) {
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                        }
                    }
                    if ($advertiser_obj) {
                        $destpath = public_path();
                        $extension = $request->file('upload_bid_profile')->getClientOriginalExtension(); // getting image extension
                        $fileName = str_random(32) . '.' . $extension;
                        $request->file('upload_bid_profile')->move($destpath . '/cdn/test/', $fileName);
                        $upload = Excel::load('public/cdn/test/' . $fileName, function ($reader) {
                        })->get();
//                        return dd($upload);
                        $t = array();
                        foreach ($upload[0] as $key => $value) {
                            array_push($t, $key);
                        }
                        if ($t[0] != 'domain' or $t[1] != 'bid_strategy' or $t[2] != 'bid_value') {
                            File::delete($destpath . '/cdn/test/' . $fileName);
                            return Redirect::back()->withErrors(['success' => false, 'msg' => 'please be sure that file is correct'])->withInput();
                        }
                        $chk = Bid_Profile::where('advertiser_id', $request->input('advertiser_id'))->get();
                        foreach ($chk as $index) {
                            if ($index->name == $request->input('name')) {
                                File::delete($destpath . '/cdn/test/' . $fileName);
                                return Redirect::back()->withErrors(['success' => false, 'msg' => 'this name already existed !!!'])->withInput();

                            }
                        }
                        $bid_profile = new Bid_Profile();
                        $bid_profile->name = $request->input('name');
                        $bid_profile->advertiser_id = $request->input('advertiser_id');
                        $bid_profile->status = 'Active';
                        $bid_profile->save();
                        foreach ($upload as $test) {
                            $flg = 0;
                            if ($test['bid_strategy'] == 'Absolute') {
                                if ($test['bid_value'] < 0 and $test['bid_value'] > 10) {
                                    $flg = 1;
                                }
                            } elseif ($test['bid_strategy'] == 'Percentage') {
                                if ($test['bid_value'] < 0 and $test['bid_value'] > 100) {
                                    $flg = 1;
                                }
                            } elseif (!preg_match($this->pattern, $test['domain'])) {
                                $flg = 1;
                            }
                            if ($flg == 0) {
                                $bid_profile_entry = new Bid_Profile_Entry();
                                $bid_profile_entry->domain = $test['domain'];
                                $bid_profile_entry->bid_strategy = $test['bid_strategy'];
                                $bid_profile_entry->bid_value = $test['bid_value'];
                                $bid_profile_entry->bid_profile_id = $bid_profile->id;
                                $bid_profile_entry->save();
                            }
                        }
                        $msg = "Bid Profile added successfully";
                        return Redirect::back()->withErrors(['success' => true, 'msg' => $msg]);
                    }
                    return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select your Client'])->withInput();
                }
                return Redirect::back()->withErrors(['success' => false, 'msg' => 'please Select a file or fill name '])->withInput();
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }


}
