<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Settings;

class SettingsController extends Controller
{
    //
    public function __construct()
   {
       $this->middleware('admin');
   }

   public function index()
     {
         return view('admin.settings.settings')->with('settings', Settings::first());
     }
 public function update()
    {
        //dd(request());

        //$this->call(SettingsTableSeeder::class);
        $this->validate(request(), [
            'site_name' => 'required',
            'contact_number' => 'required',
            'contact_email' => 'required',
            'address' => 'required'
        ]);
        $settings = Settings::first();
        $settings->site_name = request()->site_name;
        $settings->address = request()->address;
        $settings->contact_email = request()->contact_email;
        $settings->contact_number = request()->contact_number;
        $settings->save();

        Session::flash('success','Settings updated.');
        return redirect()->back();
    }
}
