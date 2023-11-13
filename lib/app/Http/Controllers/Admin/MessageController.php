<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VpCustomerCare;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getMessage()
    {
        $messages = VpCustomerCare::paginate(3);

        return view('backend.message', compact('messages'));
    }
    public function getDeleteMessage($id)
    {
        $message = VpCustomerCare::find($id);

        $message->delete();

        return redirect()->intended('admin/message');
    }
}
