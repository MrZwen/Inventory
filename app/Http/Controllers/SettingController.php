<?php

namespace App\Http\Controllers;

use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
       $this->settingService = $settingService; 
    }

    public function edit()
    {
        $threshold = $this->settingService->getLowStockThreshold();
        $roleName = Auth::user()->role->name;
        if ($roleName == 'admin') {
            return view('admins.pages.settings', compact('threshold'));
        } else if($roleName == 'staff') {
            return view('staff.pages.settings', compact('threshold'));
        }
    }

    public function update(Request $request)
    {
        $request->validate(['low_stock_threshold' => 'required|integer']);

        $this->settingService->updateLowStockThreshold($request->low_stock_threshold);
    
        Alert::toast('Low stock updated successfully!', 'success', ['timer' => 3000]);
    
        $roleName = Auth::user()->role->name;
    
        if ($roleName == 'admin') {
            return redirect()->route('settings.edit.admin');
        } else if ($roleName == 'staff') {
            return redirect()->route('settings.edit.staff');
        }
    
    }
}
