<?php

namespace App\Http\Controllers;
use App\Models\Setting;
use Illuminate\Http\Request;
use Debugbar;
class SettingController extends Controller
{
    public function index() {

        return view('admin.setting', Setting::getSettings());
    }
    public function store(Request $request){
        Debugbar::info($request->all());
        Debugbar::info(Setting::where('key', '!=', NULL));
        Setting::where('key', '!=', NULL)->delete();
        foreach($request->except('_token') as $key => $value) {
                $setting = new Setting;
                $setting->key = $key;
                $setting->value = $request->$key;
                $setting->save();
        }
        return redirect()->route('admin.setting.index');
    }
}
