<?php
namespace App\Http\Controllers;

use App\Models\Cart_items;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Order_items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Place an order for the authenticated user.
     */
    public function index(Request $request)
    {
        $query = Order::with('user');
    
        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
    
        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            })->orWhere('id', 'like', "%{$request->search}%");
        }
    
        $orders = $query->paginate(10);
    
        return view('admin.orders.index', compact('orders'));
    }
    
    public function show(Order $order)
    {
        return view('admin.orders', compact('order'));
    }
    


     public function showCheckout()
{
    $user = Auth::user(); // Get the authenticated user

    // Check if the user has a cart associated with them using user_id
    $cart = Cart::where('user_id', $user->id)->first();

    if (!$cart) {
        return redirect()->route('cart.view')->with('error', 'Cart not found.');
    }

    // Get the user's cart items using the cart_id from the found cart
    $cartItems = Cart_items::where('cart_id', $cart->id)->get(); 

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
    }

    // Calculate subtotal
    $subtotal = $cartItems->sum(function ($item) {
        return $item->quantity * $item->product->price;
    });

    // Assuming you have a fixed shipping cost for simplicity
    $shippingCost = 30; // Or calculate based on the user's location, cart weight, etc.
    
    // Total price calculation
    $totalPrice = $subtotal + $shippingCost;

    // Pass data to the view
    return view('checkout', compact('cartItems', 'subtotal', 'shippingCost', 'totalPrice'));
}


    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        $cartItems = Cart_items::where('cart_id', $user->cart->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Validate phone and location input
        $request->validate([
            'phone' => 'required|string|max:15',
            'location' => 'required|string|max:255',
        ]);

        // Calculate total price
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        // Create the order
        $order = Order::create([
            'user_id' => $user->id,
            'phone' => $request->input('phone'),
            'location' => $request->input('location'),
            'total_price' => $totalPrice,
        ]);

        // Add items to the order
        foreach ($cartItems as $cartItem) {
            Order_items::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);
        }

        // Clear the cart
        $cartItems->each->delete();

        return redirect()->route('profile.orders')->with('success', 'Order placed successfully!');
    }

    /**
     * Display the user's orders.
     */
    public function userOrders()
    {
        $userId = Auth::id(); // Get the authenticated user's ID
        $orders = Order::where('user_id', $userId)->with('items.product')->get();
    
        return view('profile.orders', compact('orders'));
    }
    
    
    

    /**
     * Display all orders for admin.
     */
    public function adminOrders()
    {
        $orders = Order::with('items.product', 'user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Update the status of an order.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:pending,delivered,canceled',
        ]);

        $order->update(['status' => $request->input('status')]);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    /**
     * View details of a specific order.
     */
    public function showOrder($orderId)
    {
        // Fetch the order by ID
        $order = Order::with('items.product')->findOrFail($orderId);
    
        // Check if the authenticated user is the owner of the order
        if (Auth::user()->id !== $order->user_id) {
            return abort(403, 'Unauthorized action.'); // You can change this to any error response you prefer
        }
    
        return view('orders.show', compact('order'));
    }
    
    
}
