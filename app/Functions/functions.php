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

}





?>