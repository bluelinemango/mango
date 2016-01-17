<?php

namespace App\Http\Controllers;

use App\Models\Audits;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuditsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($entity_type,$entity_id,$data,$audit_type)
    {
        $date_change=date('Y-m-d H:i:s');
        if($audit_type=='add') {
            $audit = new Audits();
            $audit->user_id = Auth::user()->id;
            $audit->entity_type = $entity_type;
            $audit->entity_id = $entity_id;
            $audit->audit_type = 'add';
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
                $audit->date_change = $date_change;
                $audit->save();
            }
        }
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
