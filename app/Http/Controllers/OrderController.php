<?php
namespace App\Http\Controllers;

use App\Models\Cart_items;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Order_items;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Place an order for the authenticated user.
     */
    public function index()
    {
        $orders =Order::all();
        return view('admin.orders',['orders'=>$orders]);
    }

     /**
     * View details of a specific order.
     */
    public function showOrder($orderId)
    {
        // Fetch the order by ID
        $order = Order::findOrFail($orderId);
    
        // Fetch the associated order items
        $orderItems = Order_items::where('order_id', $orderId)->get();
    
        // Fetch the associated products based on the retrieved order items
        $productIds = $orderItems->pluck('product_id'); // Assuming there's a 'product_id' field in `Order_items`
        $products = Product::whereIn('id', $productIds)->get(); // Fetch products where their IDs are in the retrieved order items
    
        return view('admin.orders.details', [
            'order' => $order,
            'orderItems' => $orderItems,
            'products' => $products 
        ]);
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
    $shippingCost = 5; // Or calculate based on the user's location, cart weight, etc.
    
    // Total price calculation
    $totalPrice = $subtotal + $shippingCost;

    // Pass data to the view
    return view('checkout', compact('cartItems', 'subtotal', 'shippingCost', 'totalPrice'));
}


public function placeOrder(Request $request)
{
    $user = Auth::user();

    // Fetch the cart
    $cart = Cart::where('user_id', $user->id)->first();
    if (!$cart) {
        return redirect()->route('cart.view')->with('error', 'No cart found.');
    }

    // Fetch cart items
    $cartItems = Cart_items::where('cart_id', $cart->id)->get();
    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
    }

    // Validate input
    $request->validate([
        'phone' => 'required|string|max:15',
        'location' => 'required|string|max:255',
    ]);

    // Calculate total price
    $totalPrice = $cartItems->sum(function ($item) {
        return $item->quantity * $item->product->price;
    });

    // Create a new order instance
    $order = new Order();
    $order->user_id = $user->id;
    $order->phone = $request->phone;
    $order->location = $request->location;
    $order->total_price = $totalPrice;
    $order->status = 'pending'; // Default status
    $order->save();

    // Add items to the order
    foreach ($cartItems as $cartItem) {
        $orderItem = new Order_items();
        $orderItem->order_id = $order->id;
        $orderItem->product_id = $cartItem->product_id;
        $orderItem->quantity = $cartItem->quantity;
        $orderItem->price = $cartItem->product->price;
        $orderItem->save();
    }

    // Clear the cart
    foreach ($cartItems as $cartItem) {
        $cartItem->delete();
    }

    return redirect()->route('cart.view')->with('success', 'Order placed successfully!');
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

   
    
    
}
