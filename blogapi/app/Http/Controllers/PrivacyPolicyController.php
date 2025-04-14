<?php

namespace App\Http\Controllers;

use App\Http\Resources\PrivacyPolicyResource;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;

class PrivacyPolicyController extends Controller
{
    public function kvkk()
    {
        $policy = PrivacyPolicy::where('type', 'kvkk')->firstOrFail();
        return response()->json($policy);
    }

    public function privacyPolicy()
    {
        $policy = PrivacyPolicy::where('type', 'privacy_policy')->firstOrFail();
        return response()->json($policy);
    }
}
