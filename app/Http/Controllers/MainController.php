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

    public function callback()
    {
        // 1. Задаем исходный массив чисел
        $inputData = [1,2,3,4,5];    
    
        // 2. Вызываем глобальную функцию, передавая в неё замыкание (алгоритм)
        $processedData = processNumbers($inputData, function($num) {
            return $num * 5; // Наша инструкция: умножь каждое число на 5
        });

        // 3. Выводим результат в логи Laravel (storage/logs/laravel.log) для проверки
        info($processedData); 
        // В логе появится массив: [50, 100, 150]


        // Моя функция
        $prices = [100, 200, 300, 400, 500];

        /**
         * Первый параметр это массив $prices
         * Второй параметр это функция которую написал прям тут в момент вызова функции filterPrices()
         */

        $filteredPrice = filterPrices($prices, function($price) {
            return $price < 300 ? true : false;
        });

        info($filteredPrice); 
    }

    public function callback2()
    {
        // Массив с числами
        $numbers = [1, 2, 3, 4, 5];    

        $evenNumbers = filterArray($numbers, function($number) {

            // Для проверки четного числа использую остаток от деления. Если число четное, результат будет равен нулю
            return $number % 2 == 0; // Это сокращенная запись от ($number % 2) ? true : false 
        });

        // Вывожу результат в лог Laravel (storage/logs/laravel.log) для проверки
        info($evenNumbers); 
    }

    public function callback3()
    {   
        /**
         * Это выражение присваивает переменной $sayHello анонимную функцию function($name) { return "$greeting, $name!"; }
         * 
         * Похоже на функциональное выражение, но плюс еще переменная $greeting из родительской функции createGreeter()
         * $sayHello = function($name) { return $name; }
         */ 
        $sayHello = createGreeter("Привет");

        // Laravel dd() показывает что $sayHello это Closure($name)
        echo $sayHello("Алексей"); // VS Code подсказывает параметр $name при вызове функции $sayHello()
    }

    public function callback4()
    {
        $counter = createCounter();

        $counterB = createCounter();

        echo $counter();
        echo $counter();
        echo $counter();

        echo $counterB();
        echo $counterB();
    }
}
