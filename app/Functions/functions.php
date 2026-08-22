<?php

/**
 * Изучение темы с замыканиями callback/closure
 */


// На всякий случай проверяем, чтобы имя функции не пересекалось с другими
if (! function_exists('processNumbers')) {

    function processNumbers(array $numbers, Closure $callback) {
        $result = [];
        foreach ($numbers as $number) {
            $result[] = $callback($number); 
        }
        return $result;
    }

}

// На всякий случай проверяем, чтобы имя функции не пересекалось с другими
if (! function_exists('filterPrices')) {

    /**
     * Передаю в качестве параметра безымянную функцию, которую объявлю при вызове этой функции filterPrices()
     * Эта функция filterPrices() ничего не знает про новую безымянную функцию. 
     * Знает только тип данных - это функция callback/closure
     * 
     * @param array $prices,
     * @param Closure $callback
     */

    function filterPrices(array $prices, Closure $callback): array {

        // Массив с отфильтрованными ценами
        $filtered = [];

        foreach ($prices as $price) {
            if ($callback($price)) {
                $filtered[] = $price;
            };
        }

        return $filtered;
    }

    /*
     1. callable (Псевдотип)Это самый широкий тип в PHP для работы с функциями. Если аргумент функции помечен как callable, туда можно передать всё, что в принципе можно вызвать: A Обычную строку с именем функции ('strlen'). B Массив с именем класса/объекта и метода ([$object, 'methodName']). CАнонимную функцию (замыкание).

     2. Closure (Класс)Это встроенный в PHP класс. Любая анонимная функция (например, $func = function() {};) автоматически становится объектом класса Closure.Если ты укажешь тип Closure, функция примет только анонимную функцию.Обычную строку 'strlen' туда передать уже не получится (будет ошибка).
    */

    function filterArray(array $numbers, callable $callback) {
        
        $newArray = [];

        foreach($numbers as $number) {
            if($callback($number)) {
                $newArray[] = $number;
            }
        }

        return $newArray;
    }

    function createGreeter(string $greeting) {

        // Возвращаем анонимную функцию и передаем в нее переменную через use $greeting. Без use внутри анонимной функции $greeting не доступно
        return function($name) use ($greeting) {
            // Теперь внутри доступны и $name, и $greeting
            return "$greeting, $name!";
        };
    }


    function createCounter() {
        $count = 0;

        // use ($count) - это копия (надеюсь не китайская) переменной $count
        /*
        return function() use ($count) {
            $count++; // увеличиваю на 1 копию переменной. А сама переменная $count не меняется.
            return $count;
        };
        */

        // use (&$count) - это единственный и неповторимый оригинал переменной $count
        return function() use (&$count) {
            $count++; // увеличиваю на 1 оригинал переменной
            return $count;
        };
    }

}





?>