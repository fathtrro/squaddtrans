<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PriceInput extends Component
{
    public $value;
    public $name;
    public $label;
    public $placeholder;
    public $required;
    public $min;
    public $helpText;
    public $textRight;
    public $class;
    public $formattedValue;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $value = null,
        $name = 'price',
        $label = null,
        $placeholder = 'Masukkan harga',
        $required = false,
        $min = 0,
        $helpText = null,
        $textRight = false,
        $class = ''
    ) {
        $this->value = $value;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->min = $min;
        $this->helpText = $helpText;
        $this->textRight = $textRight;
        $this->class = $class;
        
        // Format value dengan thousand separators
        $this->formattedValue = $value ? number_format((int)$value, 0, ',', '.') : '';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.price-input');
    }
}
