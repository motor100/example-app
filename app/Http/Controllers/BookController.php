<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$books = Book::all(); // Метод all() без связи через отношения

        // Метод with(['category']) делает "жадную загрузку"
        // Вместо сотен запросов Laravel сделает всего ДВА: один за книгами, второй за всеми нужными категориями сразу!
        // $books = Book::with('category')->get(); // Получить все записи
        //$books = Book::with('category')->paginate(2);

        // Фильтрация

        $perPage = intval($request->query('per_page', 15));
        if ($perPage > 100) { $perPage = 100; }

        // 1. Вместо ->get() или ->paginate() начинаем строить запрос через ::query()
        $query = Book::with(['category']);

        // 2. Фильтр по автору: если в GET-запросе есть ?author=..., применяем условие
        $query->when($request->query('author'), function ($q, $author) {
            return $q->where('author', 'like', "%{$author}%");
        });

        // 3. Поиск по названию: если в GET-запросе есть ?search=..., ищем по title
        $query->when($request->query('search'), function ($q, $search) {
            return $q->where('title', 'like', "%{$search}%");
        });

        // 4. Фильтр по ID категории: если прислали ?category_id=...
        $query->when($request->query('category_id'), function ($q, $categoryId) {
            return $q->where('category_id', $categoryId);
        });

        // 5. В самом конце выполняем пагинацию на основе собранного запроса
        $books = $query->paginate($perPage);

        /*
        return response()->json([
                    'success' => true,
                    'data' => $books
                ], 200);
        */
                
        // Заменяю стандартый ответ на BookResource
        return BookResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * StoreBookRequest при создании поля обычно обязательны
     */
    public function store(StoreBookRequest $request)
    {
        $validated = $request->validated();

        $book = Book::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'image' => $validated['image'],
            'description' => $validated['description'],
        ]);

        /* Конструкция if ($book) после Book::create(...) почти всегда избыточна. 
        Если Eloquent не сможет создать запись (например, упадет база), 
        Laravel выбросит системное исключение (Exception), и до условия if код даже не дойдет. */
        //if ($book) {
            // Ответ через хелпер response() в JSON как обычно
            /*
            return response()->json([
                        'success' => true,
                        //'data' => 'model was created'
                        'data' => $book
                    ], 201); // status 201 Created 
            */
        //}

        // Ответ через BookResource. Recsource это дополнительный слой между контроллером и JSON
        return (new BookResource($book))
                    ->response()
                    ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        // Заменяю стандартый ответ на BookResource
        /*
        return response()->json([
                    'success' => true,
                    'data' => $book
                ], 200);
        */
        return (new BookResource($book));
    }

    /**
     * Update the specified resource in storage.
     * 
     * UpdateBookRequest при обновлении поля обычно необязательны
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $validated = $request->validated();

        $book->update([
            'title' => $validated['title'],
            'image' => $validated['image'],
            'description' => $validated['description'],
        ]);

        // Заменяю стандартый ответ на BookResource
        /*
        return response()->json([
                    'success' => true,
                    //'data' => 'model was updated'
                    'data' => $book
                ], 201); // status 201 Created 
        */
        return (new BookResource($book))
                    ->response()
                    ->setStatusCode(201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(null, 204);
    }
}
