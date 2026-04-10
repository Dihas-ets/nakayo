<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class CompanySettingController extends Controller
{
    public function index()
    {
        $settings = CompanySetting::first();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = CompanySetting::first();
        $settings->update($request->all());

        return redirect()->back()->with('success', 'Informations de l\'entreprise mises à jour !');
    }
}