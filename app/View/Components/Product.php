<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class Product extends Component
{
    /**
     * Create a new component instance.
     */

    public string $title;
    public Model $product;
    public function __construct($title, Model $product)
    {
        $this->title = $title;
        $this->product = $product;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product', [
            'title' => $this->title,
            'product' => $this->product,
        ]);
    }
}
