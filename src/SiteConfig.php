<?php

namespace Intelrx\Sitesettings;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Intelrx\Sitesettings\Models\SiteSettings;

class SiteConfig extends Controller
{
    /**
     * Handle the incoming request.
     */
    public static function store($key, $value)
    {
        SiteSettings::create([
            'key' => $key,
            'value' => $value
        ]);
    }

    public static function get($key)
    {
        $data = SiteSettings::where('key', $key)->first();
        return $data ? $data->value : null;
    }

    public static function update($key, $value)
    {
        $data = SiteSettings::where('key', $key)->first();
        if ($data) {
            $data->value = $value;
            $data->save();
        }
    }

    public static function delete($key)
    {
        $data = SiteSettings::where('key', $key)->first();
        if ($data) {
            $data->delete();
        }
    }
}
