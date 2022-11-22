<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function seoIndex()
    {
        return view('backend.setting.seo_index');
    }
}
