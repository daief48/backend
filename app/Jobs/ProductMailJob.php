<?php

namespace App\Jobs;

use App\Models\Product;
use App\Mail\ProductNotificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProductMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Product $product;
    public string $action;

    /**
     * Create a new job instance.
     */
    public function __construct(Product $product, string $action)
    {
        $this->product = $product;
        $this->action = $action;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('daiefsikder425@gmail.com')
            ->send(new ProductNotificationMail($this->product, $this->action));
    }
}
