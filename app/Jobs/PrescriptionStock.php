<?php

namespace App\Jobs;

use App\Models\ItemStock;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PrescriptionStock implements ShouldQueue
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
        foreach ($this->request->prescriptionDetails as $detail) {
            $model = ItemStock::where('id', $detail->item_stock_id)->first();

            if ($model) {
                $model->decrement('quantity', $detail->quantity);
                $model->save();
            }
        }
    }
}
