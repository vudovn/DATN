<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact()
    {
        $config = $this->config();
        return view('client.pages.contact.index', compact('config'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'max:12',
            'message' => 'required|string',
        ], [
            'name.required' => 'Vui lòng nhập tên.',
            'name.string' => 'Nhập sai định dạng tên.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',

            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email phải đúng định dạng.',

            'phone.max' => 'Số điện thoại không được dài hơn 12 ký tự.',
            'phone.numeric' => 'Số điện thoại phải là số.',

            'message.required' => 'Vui lòng nhập lời nhắn.',
            'message.string' => 'Tin nhắn phải là một chuỗi ký tự.',
        ]);


        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'company' => $request->company,
            'phone' => $request->phone,
            'contact_message' => $request->message,
        ];

        // Gửi email
        Mail::send('client.pages.contact.send', $data, function ($message) use ($data) {
            $message->to('khanhvi12344321@gmail.com')
                ->subject('Thông tin liên hệ của khách: ' . $data['name']);
        });
        Mail::send('client.pages.contact.user_contact', $data, function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Chúng tôi đã nhận được liên hệ của bạn - TheGioiNoiThat');
        });
        return back()->with('success', 'Gửi liên hệ thành công!');
    }



    private function config()
    {
        return [
            'css' => [
                "client_asset/custom/css/contact.css",
            ],
            'js' => [
                "https://freshcart.codescandy.com/assets/libs/rater-js/index.js",
                "client_asset/custom/js/home.js",
            ],
            'model' => ''
        ];
    }
}
