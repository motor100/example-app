<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * В этом случае редирект работает если пользователь прошел аутенификацию
     * 
     * Если нужно сделать редирект без аутенификации, то сообщите мне. Сделаю без нее.
     */
    public function link_redirect(Request $request, \App\Models\Link $model)
    {
        // $model это найденная модель \App\Models\Link. Поиск по id и user_id (global scope)
        // Если модель не найдена, то будет ошибка 404
        // Если пользователь не прошел аутенификацию, то будет ошибка 500

        $redirect = new \App\Classes\RedirectLink($request, $model);

        // Создаю модель с информацией о редиректе
        $redirect->save();

        return redirect($model->long_link);
    }
}
