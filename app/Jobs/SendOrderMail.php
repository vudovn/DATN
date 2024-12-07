<?php

namespace App\Jobs;

use App\Mail\OrderStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Mail\OrderStatusMail;

class SendOrderMail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $orderCode;
    public function __construct($orderCode)
    {
        $this->orderCode = $orderCode;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $order = Order::where('code', $this->orderCode)->with('orderDetails', 'user')->first();
        Mail::to("vudevweb@gmail.com")->send(new OrderStatusMail($order));
    }
}
