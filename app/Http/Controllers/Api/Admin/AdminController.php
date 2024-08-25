<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subsecription;
use App\Models\Offers;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Models\Payment;

class AdminController extends Controller
{
    public function index()
    {
        $subscriptions = Subsecription::all();
        $offers = Offers::all();
        $discounts = Discount::all();

        return response()->json(compact($subscriptions, $offers, $discounts));
    }
    // Offers Management
    public function createOffer(Request $request)
    {
        $offer = new Offers();
        $offer->name = $request->input('name');
        $offer->description = $request->input('description');
        $offer->percentage = $request->input('percentage');
        $offer->start_date = $request->input('start_date');
        $offer->end_date = $request->input('end_date');
        $offer->save();

        return response()->json(['message' => 'Offer created successfully!'], 201);
    }
    public function editOffer(Request $request, $id)
    {
        $offer = Offers::find($id);
        $offer->name = $request->input('name');
        $offer->description = $request->input('description');
        $offer->percentage = $request->input('percentage');
        $offer->start_date = $request->input('start_date');
        $offer->end_date = $request->input('end_date');
        $offer->save();

        return response()->json(['message' => 'Offer updated successfully!'], 200);;
    }
    public function deleteOffer($id)
    {
        $offer = Offers::find($id);
        $offer->delete();

        return response()->json(['message' => 'Offer deleted successfully!'], 200);
    }

    // Discounts Management
    public function createDiscount(Request $request)
    {
        $discount = new Discount();
        $discount->name = $request->input('name');
        $discount->description = $request->input('description');
        $discount->amount = $request->input('amount');
        $discount->start_date = $request->input('start_date');
        $discount->end_date = $request->input('end_date');
        $discount->save();

        return response()->json(['message' => 'Discount created successfully!'], 201);
    }

    public function editDiscount(Request $request, $id)
    {
        $discount = Discount::find($id);
        $discount->name = $request->input('name');
        $discount->description = $request->input('description');
        $discount->amount = $request->input('amount');
        $discount->start_date = $request->input('start_date');
        $discount->end_date = $request->input('end_date');
        $discount->save();

        return response()->json(['message' => 'Discount updated successfully!'], 200);
    }

    public function deleteDiscount($id)
    {
        $discount = Discount::find($id);
        $discount->delete();

        return response()->json(['message' => 'Discount deleted successfully!'], 200);;
    }
    // Subscription Management
    public function assignOfferToSubscription(Request $request, $subscription_id)
    {
        $subscription = Subsecription::find($subscription_id);
        $offer = Offers::find($request->input('offer_id'));
        $subscription->offer_id = $offer->id;
        $subscription->save();

        return response()->json(['message' => 'Offers assigned to subsecription successfully!'], 200);
    }

    public function assignDiscountToSubscription(Request $request, $subscription_id)
    {
        $subscription = Subsecription::find($subscription_id);
        $discount = Discount::find($request->input('discount_id'));
        $subscription->discount_id = $discount->id;
        $subscription->save();

        return response()->json(['message' => 'Discount assigned to subscription successfully!'], 200);
    }

    // Payments Management
    public function viewPayments(Request $request)
    {
        $payments = Payment::with('subscription', 'subscription.user')
            ->when($request->input('user_id'), function ($query) use ($request) {
                $query->whereHas('subscription.user', function ($query) use ($request) {
                    $query->where('id', $request->input('user_id'));
                });
            })
            ->when($request->input('start_date'), function ($query) use ($request) {
                $query->whereDate('created_at', '>=', $request->input('start_date'));
            })
            ->when($request->input('end_date'), function ($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->input('end_date'));
            })
            ->paginate(10);

        return response()->json(['payments' => $payments], 200);
    }
    public function filterPayments(Request $request)
    {
        $payments = Payment::with('subscription', 'subscription.user')
            ->when($request->input('user_id'), function ($query) use ($request) {
                $query->whereHas('subscription.user', function ($query) use ($request) {
                    $query->where('id', $request->input('user_id'));
                });
            })
            ->when($request->input('payment_amount'), function ($query) use ($request) {
                $query->where('payment_amount', $request->input('payment_amount'));
            })
            ->paginate(10);

        return response()->json(['payments' => $payments], 200);
    }
}
