<?php

namespace EmailCampaigns\Core\Http\Controllers;

use EmailCampaigns\Core\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use EmailCampaigns\Core\Jobs\SendCampaignEmail;
use EmailCampaigns\Core\Models\Customer;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'nullable|string',
            'body' => 'nullable|string',
            'status' => 'in:draft,scheduled,sent',
            'scheduled_at' => 'nullable|date',
        ]);

        $campaign = Campaign::create($data);

        return response()->json([
            'message' => 'Campaign created successfully.',
            'data' => $campaign
        ], 201);
    }

    public function sendToFilteredAudience(Request $request, $campaignId)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'nullable|string',
            'expires_in_days' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $campaign = Campaign::findOrFail($campaignId);

        $query = Customer::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('expires_in_days')) {
            $query->whereDate('plan_expiry_date', '<=', now()->addDays((int) $request->expires_in_days));
        }

        $customers = $query->get();

        foreach ($customers as $customer) {
            SendCampaignEmail::dispatch(
                $campaign->id,
                $customer->id,
                $customer->email,
                $campaign->subject,
                $campaign->body
            );
        }

        return response()->json([
            'message' => 'Email jobs have been dispatched to the filtered audience.',
            'total_recipients' => $customers->count()
        ]);
    }
}
