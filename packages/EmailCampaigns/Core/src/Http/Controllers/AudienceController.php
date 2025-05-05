<?php

// packages/EmailCampaigns/Core/src/Http/Controllers/AudienceController.php

namespace EmailCampaigns\Core\Http\Controllers;

use Illuminate\Http\Request;
use EmailCampaigns\Core\Models\Customer;
use Illuminate\Routing\Controller;
use Carbon\Carbon;

class AudienceController extends Controller
{
    public function filter(Request $request)
    {
        $status = $request->query('status');
        $expiresInDays = (int) $request->query('expires_in_days'); // Cast to integer

        $query = Customer::query();

        if ($status) {
            $query->where('status', $status);
        }

        if ($expiresInDays) {
            $date = Carbon::now()->addDays($expiresInDays);
            $query->whereDate('plan_expiry_date', '<=', $date);
        }

        $customers = $query->get();

        return response()->json($customers);
    }
}


