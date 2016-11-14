<?php

namespace App\Http\Controllers;

use Settings;
use CountryState;
use App;
use Config;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function administration(Request $request)
    {
        $countries = CountryState::getCountries();
        $languages = [
            'es' => trans('app.spanish'),
            'en' => trans('app.english')
        ]; 
        $timezones = config('timezone');
        if ( $request->ajax() ) {

            return response()->json([
                'success' => true,
                'view' => view('setting.administration_field', compact('countries', 'languages', 'timezones'))->render(),
            ]);
        }

        return view('setting.administration', compact('countries', 'languages', 'timezones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function conditions_and_privacy(Request $request)
    {
        if ( $request->ajax() ) {

            return response()->json([
                'success' => true,
                'view' => view('setting.conditions_privacy_field')->render(),
            ]);
        }

        return view('setting.conditions_and_privacy');
    }

    /**
     * Handle application settings update.
     *
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
        $this->updateSettings($request->except("_token"));

        return back()->withSuccess(trans('app.settings_updated'));
    }

    /**
     * Update settings and fire appropriate event.
     *
     * @param $input
     */
    private function updateSettings($input)
    {
        foreach($input as $key => $value) {
            Settings::set($key, $value);
            if ($key == 'language_default') {
                Config::set('app.locale', $value);
                App::setLocale($value);
            }
            if ($key == 'timezone') {
                Config::set('app.timezone', $value);
            }           
        }
    }
}
