<?php

namespace App\Http\Controllers;

use App\Models\Invest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($slug)
    {
        $title = 'Product Detail';
        $product = Product::query()->where('slug', $slug)->first();
        if(!$product) abort(404);
        return view('product-detail', compact('title', 'product'));
    }

    public function investPost(Request $request)
    {
        if(!$request->product_id) abort(404);
        $product = Product::find($request->product_id);
        if(!$product) abort(404);
        $amount = $product->min_invest;

        if(auth()->user()->balance < $amount) return redirect()->back()->with('error', 'Số dư không đủ để đầu tư');

        // trừ tiền
        auth()->user()->balance -= $amount;
        auth()->user()->save();
        $completed_at = now()->addMinutes($product->time_invest);

        Invest::query()->create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'amount' => $amount,
            'status' => 0,
            'completed_at' => $completed_at,
        ]);

        return redirect()->route('invest-history')->with('success', 'Đầu tư thành công');
    }
}
