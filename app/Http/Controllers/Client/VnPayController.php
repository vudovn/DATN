<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Payment\VnPayService;
use App\Services\Order\OrderService;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Order\OrderRepository;

class VnPayController extends Controller
{
    protected $vnpayService;
    protected $cartRepository;
    protected $orderRepostitory;
    function __construct(VnPayService $vnpayService, CartRepository $cartRepository, OrderRepository $orderRepostitory)
    {
        $this->vnpayService = $vnpayService;
        $this->cartRepository = $cartRepository;
        $this->orderRepostitory = $orderRepostitory;
    }
    public function pay(Request $request)
    {
        $userId = auth()->id();
        $paymentUrl = $this->vnpayService->createTransaction($request, $userId);
        return redirect($paymentUrl);
    }

    public function return(Request $request)
    {
        $vnp_HashSecret = config('vnp_HashSecret');
        $inputData = $request->except('vnp_SecureHash');
        ksort($inputData);
        $hashData = '';
        foreach ($inputData as $key => $value) {
            $hashData .= $key . '=' . $value . '&';
        }
        $hashData = rtrim($hashData, '&');
        $secureHash = hash_hmac('sha256', $hashData, $vnp_HashSecret);
        if ($request->vnp_SecureHash === $secureHash) {
            $this->orderRepostitory->updateByWhereIn('code', [$request->vnp_TxnRef], ['payment_status' => 'completed']);
            return view('client.pages.cart.components.checkout.result', [
                'message' => 'Thanh toán thành công, chúng tôi sẽ xử lý đơn hàng của bạn',
                'status' => 'success'
            ]);
        } else {
            // Hash không hợp lệ
            return view('client.pages.cart.components.checkout.result', [
                'message' => 'Thanh toán thất bại',
                'status' => 'error'
            ]);
        }
    }

}
