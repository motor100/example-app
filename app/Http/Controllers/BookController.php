<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
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

        return response()->json([
                    'success' => true,
                    'data' => $books
                ], 200);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * Создать StoreBookRequest при создании поля обычно обязательны
     */
    public function store(BookRequest $request)
    {
        $validated = $request->validated();

        $book = Book::create([
            'title' => $validated['title'],
            'image' => $validated['image'],
            'description' => $validated['description'],
        ]);

        /* Конструкция if ($book) после Book::create(...) почти всегда избыточна. 
        Если Eloquent не сможет создать запись (например, упадет база), 
        Laravel выбросит системное исключение (Exception), и до условия if код даже не дойдет. */
        //if ($book) {
            return response()->json([
                        'success' => true,
                        //'data' => 'model was created'
                        'data' => $book
                    ], 201); // status 201 Created 
        //}
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return response()->json([
                    'success' => true,
                    'data' => $book
                ], 200);
    }

    /**
     * Update the specified resource in storage.
     * 
     * Создать UpdateBookRequest при обновлении поля обычно необязательны
     */
    public function update(BookRequest $request, Book $book)
    {
        $validated = $request->validated();

        $book->update([
            'title' => $validated['title'],
            'image' => $validated['image'],
            'description' => $validated['description'],
        ]);

        return response()->json([
                    'success' => true,
                    //'data' => 'model was updated'
                    'data' => $book
                ], 201); // status 201 Created 

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
