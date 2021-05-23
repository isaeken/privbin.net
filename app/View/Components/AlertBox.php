<?php

namespace App\View\Components;

use App\Enums\AlertType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AlertBox extends Component
{
    /**
     * Create a new component instance.
     *
     * @param AlertType|string|null $type
     */
    public function __construct(public AlertType|string|null $type = null)
    {
        if ($type != null && ! $type instanceof AlertType) {
            $this->type = AlertType::fromValue($type);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        $type = $this->type == null ? AlertType::Alert() : $this->type;
        return view("components.alert-box", compact("type"));
    }
}
