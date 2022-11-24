<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Smtp;

class SettingController extends Controller
{
    public function seoIndex()
    {
        $seo_setting = Seo::first();
        return view('backend.setting.seo_index',compact('seo_setting'));
    }

    public function seoUpdate(Request $request, $id)
    {
        try {
            $seoSetting = Seo::findOrFail($id);
            $seoSetting->update([
                'meta_title' => $request->meta_title,
                'meta_author' => $request->meta_author,
                'meta_tag' => $request->meta_tag,
                'meta_description' => $request->meta_description,
                'meta_keyword' => $request->meta_keyword,
                'google_verification' => $request->google_verification,
                'google_analytics' => $request->google_analytics,
                'alexa_verification' => $request->alexa_verification,
                'google_adsense' => $request->google_adsense
            ]);

            notify()->success("SEO Updated Successfully.", "Success");
            return back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("SEO Update Failed.", "Error");
            return back();
        }
    }


    public function smtpIndex()
    {
        $smtpSetting = Smtp::first();
        return view('backend.setting.smtp_index',compact('smtpSetting'));
    }

    public function smtpUpdate(Request $request, $id)
    {
        try {
            $smtpSetting = Smtp::findOrFail($id);
            $smtpSetting->update([
                'mailer' => $request->mailer,
                'host' => $request->host,
                'port' => $request->port,
                'username' => $request->username,
                'password' => $request->password
            ]);


            notify()->success("SMTP Updated Successfully.", "Success");
            return back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("SMTP Update Failed.", "Error");
            return back();
        }
    }
}
