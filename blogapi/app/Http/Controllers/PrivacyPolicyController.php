<?php

namespace App\Http\Controllers;

use App\Http\Resources\PrivacyPolicyResource;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;

class PrivacyPolicyController extends Controller
{
    public function show()
    {
        $privacy_policy = PrivacyPolicy::first();
        return response()->json($privacy_policy);
    }
}
