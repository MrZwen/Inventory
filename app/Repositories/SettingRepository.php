<?php 
namespace App\Repositories;
use App\Models\Setting;

class SettingRepository
{
    public function get($key)
    {
        return Setting::where('key', $key)->first();
    }

    public function updateByKey($key, $value)
    {
        $setting = Setting::where('key', $key)->first();
        if ($setting) {
            $setting->value = $value;
            $setting->save();
        }
    }
}
?>