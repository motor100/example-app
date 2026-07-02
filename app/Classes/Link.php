<?php

namespace App\Classes;

class Link {
    
    private string $long_link;

    function __construct(string $long_link) {
        $this->long_link = $long_link;
    }

    /**
     * 
     * @return string
     */
    public function long_to_short() : string
    {
        // URL с протоколом и доменным именем
        $url = url('/');

        // Последняя модель
        $latest_model = \App\Models\Link::latest()->withoutGlobalScopes()->first();

        // Следующий ID
        $next_id = $latest_model ? $latest_model->id + 1 : 1;

        return $url . '/abc' . $next_id;
    }
    
}