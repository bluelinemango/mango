<?php

namespace App\Http\Controllers;

use App\Models\Segment;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SegmentController extends Controller
{
    public function GetView()
    {
        if (Auth::check()) {
            if (in_array('VIEW_SEGMENT', $this->permission)) {
                if (User::isSuperAdmin()) {
                    $segment = Segment::with('getAdvertiser','getModel')->get();
                } else {
                    $usr_company = $this->user_company();
                    $segment = Segment::whereHas('getAdvertiser' , function ($q) use($usr_company) {
                        $q->whereHas('GetClientID' , function ($p) use ($usr_company) {
                            $p->whereIn('user_id', $usr_company);
                        });
                    })->with('getModel')->get();

                }
                return view('segment.list')->with('segment_obj', $segment);
            }
            return Redirect::back()->withErrors(['success' => false, 'msg' => "You don't have permission"]);
        }
        return Redirect::to(url('/user/login'));
    }
}
