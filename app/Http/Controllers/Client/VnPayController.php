<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Payment\VnPayService;
use App\Services\Order\OrderService;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Order\OrderRepository;
use App\Jobs\SendOrderMail;
use App\Jobs\SendTelegramNotification;

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
        if ($request->has('vnp_SecureHash')) {
            $this->cartRepository->deleteCart(auth()->id());
            $this->orderRepostitory->updateByWhereIn('code', [$request->vnp_TxnRef], ['payment_status' => 'completed']);
            $order = $this->orderRepostitory->getOrderByCode($request->vnp_TxnRef);
            SendOrderMail::dispatch($order);
            $message = "🛍️ *Đơn hàng mới đã được tạo!*\n\n"
                . "📦 *Thông tin đơn hàng:*\n"
                . "🆔 *Mã đơn hàng:* {$order->code}\n"
                . "👤 *Khách hàng:* {$order->user->name}\n"
                . "💰 *Tổng tiền:* " . number_format($order->total) . " VND\n\n"
                . "⏰ *Thời gian đặt:* " . now()->format('H:i:s d/m/Y') . "\n"
                . "🔗 *Chi tiết đơn hàng:* [Xem tại đây](" . route('order.show', $order->id) . ")\n";
            SendTelegramNotification::dispatch($message);
            return view('client.pages.cart.components.checkout.result', ['message' => 'Thanh toán thành công', 'status' => 'success']);
        } else {
            return view('client.pages.cart.components.checkout.result', ['message' => 'Thanh toán thất bại', 'status' => 'error']);
        }
    }
}
