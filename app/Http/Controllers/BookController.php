<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;

class BookController extends Controller
{

    /**
     * Save to database a newly created Book.
     *
     * @param BookRequest $request
     * @return Book
     */
    public function store(BookRequest $request)
    {
        $book = Book::create([
            'name' => $request->name,
            'pages' => $request->pages,
            'language' => $request->language,
            'price' => $request->price
        ]);

        $book->authors()->attach($request->authors);

        return $book;
    }

    /**
     * Returns a Book based on its ID, or all Books if no ID is provided.
     *
     * @param int|null $id
     * @return Book|Book[]
     */
    public function show(int $id = null)
    {
        if ($id === null) {
            return Book::with('authors')->get();
        } else {
            return Book::with('authors')->findOrFail($id);
        }
    }

    /**
     * Update the specified Book in database.
     *
     * @param BookRequest $request
     * @param int $id
     * @return Book
     */
    public function update(BookRequest $request, int $id)
    {
        $book = Book::findOrFail($id);

        $book->name = $request->name;
        $book->pages = $request->pages;
        $book->language = $request->language;
        $book->price = $request->price;

        $book->authors()->sync($request->authors);

        $book->save();

        return $book;
    }

    /**
     * Remove the specified Book from database.
     *
     * @param int $id
     * @return Book
     */
    public function destroy(int $id)
    {
        $book = Book::findOrFail($id);
        $book->authors()->sync([]);
        $book->delete();

        return $book;
    }
}
