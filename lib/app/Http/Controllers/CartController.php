<?php

namespace App\Http\Controllers;

use App\Models\VpOrder;
use App\Models\VpProduct;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function getAddCart($id)
    {
        $product = VpProduct::find($id);
        Cart::add(['id' => $id, 'name' => $product->prod_name, 'qty' => 1,
                    'price' => $product->prod_price, 'weight' => 550, 'options' => ['img' => $product->prod_img]]);

        return redirect('cart/show');
    }
    public function getShowCart()
    {
        $total = Cart::total();
        $products = Cart::content();
        return view('frontend.cart', compact('products', 'total'));
    }
    public function getDeleteCart($id)
    {
        if($id == 'all') {
            Cart::destroy();
        } else {
            Cart::remove($id);
        }

        return back();
    }
    public function getUpdateCart(Request $request)
    {
        $rowId = $request->rowId;
        $quantity = $request->quantity;

        Cart::update($rowId, $quantity);
    }
    public function postPayCart(Request $request)
    {
        // add table order
        $order = new VpOrder;
        $order->name  = $request->name;
        $order->address = $request->add;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->total_price = Cart::total();
        $order->total_products = Cart::content()->pluck('name')->implode('; ');
        $order->placed_order_date = now()->format('d/m/Y');
        $order->user_id = Auth::id();
        $order->save();

        $data['info'] = $request->all();
        $email = $request->email;
        $name = $request->name;
        $data['cart'] = Cart::content();
        $data['total'] = Cart::total();
        Mail::send('frontend.email', $data, function ($message) use ($email, $name) {
            $message->from('dungli1221@gmail.com', 'Mạnh Dũng');

            $message->to($email, $name);

            $message->subject('Xác nhận hóa đơn mua hàng Chiến Đồ Nam');

        });
        Cart::destroy();
        return redirect('complete');
    }
    public function getComplete()
    {
        return view('frontend.complete');
    }
}
