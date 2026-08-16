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
    public function index()
    {
        $books = Book::all();

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
