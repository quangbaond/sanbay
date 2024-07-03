<?php

namespace App\Console\Commands;

use App\Models\Invest;
use Carbon\Carbon;
use Illuminate\Console\Command;

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
            $now = Carbon::now();
            $invests = Invest::where('status', 2)
                ->whereNotNull('completed_at')
                ->where('completed_at', '<=', $now)
                ->with(['user', 'product'])->get();
            foreach ($invests as $invest) {
                $created_at = Carbon::parse($invest->created_at);
                // thời gian ban đầu đầu tư + time invest của product nếu >= now thì trả thưởng ( time invest được tính bằng phút)
                if ($created_at->addMinutes($invest->product->time_invest) >= $now) {
                    $user = $invest->user;
                    $product = $invest->product;
                    $user->balance += $invest->amount + $invest->amount;
                    $user->save();
                    $invest->status = 2;
                    $invest->completed_at = $now;
                    $invest->save();
                    // log command
                    $this->info('Thông báo 🏗️ ' . $user->username . ' Đã trả thưởng ' . $invest->amount . 'dự án thành công' . $product->name . 'lúc: ' . $now);
                }
            }
        } catch (\Exception $e){
            $this->error('Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
