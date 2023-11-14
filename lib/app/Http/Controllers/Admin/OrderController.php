<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VpOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\FuncCall;

class OrderController extends Controller
{
    public function getOrder()
    {
        $orders = VpOrder::paginate(3);

        return view('backend.order', compact('orders'));
    }
    public function getDeleteOrder($id)
    {
        $order = VpOrder::find($id);

        $order->delete();

        return redirect()->intended('admin/order');
    }
    public function UpdateOrderStatus(Request $request, $id)
    {
        $order = VpOrder::find($id);
        $order->order_status = 'Đã xác nhận';
        $email = $order->email;
        $name = $order->name;
        $data =[
            'Đơn hàng của bạn đã được xác nhận vào đang trong quá trình vận chuyển'
        ];
        $order->save();
        Mail::send('frontend.email_confirm_order',$data, function ($message) use ($email, $name) {
            $message->from('dungli1221@gmail.com', 'Mạnh Dũng');

            $message->to($email, $name);

            $message->subject('Thông báo đơn hàng của bạn đã được xác nhận tại shop Chiến Đồ Nam');

        });
        return redirect()->intended('admin/order');
    }
}
