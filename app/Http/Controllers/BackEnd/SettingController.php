<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\PaymentGatewayBD;
use App\Models\Setting;
use App\Models\Smtp;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;

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

    public function websiteIndex()
    {
        $websiteSetting = Setting::first();
        return view('backend.setting.website_index',compact('websiteSetting'));
    }

    public function websiteUpdate(Request $request, $id)
    {
        try {
            $websiteSetting = Setting::findOrFail($id);

            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                @unlink(public_path('upload/setting/' . $websiteSetting->logo));
                $filename = 'Logo_' . date('YmdHi') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/setting'), $filename);
                // Image::make($file)->resize(320,120)->save($path);
                // Image::make($file)->resize(32,32)->save($path);
                $websiteSetting->update([
                    "logo" => $filename,
                ]);
            }

            if ($request->hasFile('favicon')) {
                $file2 = $request->file('favicon');
                @unlink(public_path('upload/setting/' . $websiteSetting->favicon));
                $filename2 = 'IMG_' . date('YmdHi') . '.' . $file2->getClientOriginalExtension();
                $file2->move(public_path('upload/setting'), $filename2);
                $websiteSetting->update([
                    "favicon" => $filename2,
                ]);
            }


            $websiteSetting->update([
                "currency" => $request->currency,
                "phone_one" => $request->phone_one,
                "phone_two" => $request->phone_two,
                "main_email" => $request->main_email,
                "support_email" => $request->support_email,
                "address" => $request->address,
                "facebook" => $request->facebook,
                "twitter" => $request->twitter,
                "instagram" => $request->instagram,
                "linkedin" => $request->linkedin,
                "youtube" => $request->youtube
            ]);


            notify()->success("Setting Updated Successfully.", "Success");
            return back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            notify()->error("Setting Update Failed.", "Error");
            return back();
        }
    }

    public function paymentGateway()
    {
        $aamarpay = PaymentGatewayBD::first();
        $surjopay  = PaymentGatewayBD::skip(1)->first();
        $sslcommerz = PaymentGatewayBD::skip(2)->first();

        return view('backend.payment_gateway.edit',compact('aamarpay','surjopay','sslcommerz'));
    }
}
