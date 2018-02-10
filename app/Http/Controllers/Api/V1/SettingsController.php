<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;

class SettingsController extends Controller
{

    /**
     * @param $path
     * @return mixed
     */
    public function show($path)
    {
        return Setting::where('path', $path)->firstOrFail();
    }

    public function update($path)
    {
        return Setting::where('path', $path)->update([
            'value' => request('value')
        ]);
    }

    public function updateValue($path)
    {
        Setting::where('path', $path)->update([
            'value' => request('value')
        ]);
        return Setting::where('path', $path)->firstOrFail();

    }
}
