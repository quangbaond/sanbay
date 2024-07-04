<?php

namespace App\Console\Commands;

use App\Models\Invest;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TraThuong extends Command
{

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tra-thuong';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $this->info('Tra thuong command is running...');
            $now = now();
            $invests = Invest::where('status', 1)
                ->whereNull('completed_at')
                ->whereNotNull('accept_at')
                ->with(['user', 'product'])->get();
            foreach ($invests as $invest) {
                $completed_at = Carbon::parse($invest->accept_at)->addMinutes($invest->product->time_invest);
                $diff = $now->diffInMinutes($completed_at);
                if ($diff <=0) {
                    $user = $invest->user;
                    // log user
                    Log::info($user);
                    $product = $invest->product;
                    $user->balance += $invest->amount + $invest->product->min_invest;
                    $user->save();
                    $invest->status = 2;
                    $invest->completed_at = $now;
                    $invest->save();
                    // log command
                    Log::info('Thông báo 🏗️ ' . $user->username . ' Đã trả thưởng ' . $invest->amount . 'dự án thành công' . $product->name . 'lúc: ' . $now);
                    $this->info('Thông báo 🏗️ ' . $user->username . ' Đã trả thưởng ' . $invest->amount . 'dự án thành công' . $product->name . 'lúc: ' . $now);
                }
            }
        } catch (\Exception $e){
            $this->error('Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
