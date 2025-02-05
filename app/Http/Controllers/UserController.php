<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function orders()
    {
        $orders = Order::with(['items.product']) // Load items and their products
        ->where('user_id', auth()->id())
            ->latest()
            ->paginate(12);

        return view('user.orders', compact('orders'));
    }

    public function order_details($order_id)
    {
        $userId = auth()->id();

        // Fetch the requested order along with related items and products
        $order = Order::with(['items.product.category'])
            ->where('user_id', $userId)
            ->findOrFail($order_id);

        // Fetch other orders of the same user, excluding the current one
        $orders = Order::with('items.product')
            ->where('user_id', $userId)
            ->where('id', '!=', $order_id)
            ->latest() // Order by latest created_at
            ->paginate(12);

        return view('user.order-details', compact('order', 'orders'));
    }


    /**
     * Cancel an order.
     */
    public function cancel_order(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);
        $userId = auth()->id();
        $order = Order::where('id', $request->order_id)
            ->where('user_id', $userId) // Ensure the order belongs to the authenticated user
            ->whereNull('canceled_at') // Only cancel if not already canceled
            ->firstOrFail();

        $order->update([
            'canceled_at' => Carbon::now(),
            'status' => 'canceled', // Assuming you have a status field
        ]);

        return redirect()->back()->with('success', 'Order has been canceled successfully.');
    }
}
