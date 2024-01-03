<?php

namespace App\Jobs;

use App\Models\ItemStock;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderStock implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $request;

    /**
     * Create a new job instance.
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->request->purchaseOrderDetails as $detail) {
            $model = ItemStock::where('item_id', $detail->item_id)
                ->where('expired_date', $detail->expired_date)
                ->where('batch_number', $detail->batch_number)
                ->first();

            if ($model) {
                $model->increment('quantity', $detail->quantity);
                $model->save();
            } else {
                $model = new ItemStock();
                $model->fill($detail->toArray());
                $model->save();
            }
        }
    }
}
