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
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function working_hours(Request $request)
    {
        $status = [
            'available' => trans('app.Available'), 
            'notavailable' => trans('app.Not available')
        ];
        if(Settings::get('working_hours')) {
            $working_hours = json_decode(Settings::get('working_hours'), true);
        } else {
            $working_hours = array();
        }
        if(Settings::get('week')) {
            $week = explode(',', Settings::get('week'));
        } else {
            $week = array();
        }
        if ( $request->ajax() ) {

            return response()->json([
                'success' => true,
                'view' => view('setting.working_hours_field', compact('working_hours', 'status', 'week'))->render(),
            ]);
        }

        return view('setting.working_hours', compact('working_hours', 'status', 'week'));
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
     * Handle application settings update.
     *
     * @param Request $request
     * @return mixed
     */
    public function working_hours_update(Request $request)
    {
        $data = array();
        $start = $request->start;
        $end = $request->end;
        $quantity = $request->quantity;
        $status = $request->status;
        $week = $request->week;
        $day_week = [1,2,3,4,5];
        $week_day = '';
        $week_diff = array_diff($day_week, $week);

        foreach ($week_diff as $day) {
            $week_day .= $day.',';
        }

        foreach( $start as $key => $value ) {
            $data[] = [ 
                'id' => $key,
                'start' => $value,
                'end' => $end[$key],           
                'interval' => $value.' - '.$end[$key],
                'quantity' => $quantity[$key],
                'status' => $status[$key]
            ];
        }

        Settings::set('week', substr($week_day, 0, -1));
        Settings::set('time_close', $request->time_close);
        Settings::set('working_hours', json_encode($data));

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
