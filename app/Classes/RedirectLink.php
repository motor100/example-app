<?php

namespace App\Classes;

use App\Models\Redirect;

class RedirectLink {
    
    private \Illuminate\Http\Request $request;
    private \App\Models\Link $model;

    function __construct(\Illuminate\Http\Request $request, \App\Models\Link $model) {
        $this->request = $request;
        $this->model = $model;
    }

    /**
     * 
     * @return Void
     */
    public function save() : Void
    {
       // Получаю IP
        $ip = $this->request->getClientIp();

        // Создаю новую модель
        Redirect::create([
            'link_id' => $this->model->id,
            'ip' => $ip
        ]);

        return;
    }
    
}