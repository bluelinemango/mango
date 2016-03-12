<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creative extends Model
{
    //
    protected $table = 'creative';

    public static $rule=array(
        'name'=>'required',
        'advertiser_domain_name'=>'required',
        'landing_page_url'=>'required',
        'attributes'=>'required',
        'preview_url'=>'required',
        'ad_tag'=>'required',
        'size_width'=>'required|numeric|min:0',
        'size_height'=>'required|numeric|min:0',
    );

    public function getAdvertiser(){
        return $this->belongsTo('App\Models\Advertiser','advertiser_id');
    }


}
