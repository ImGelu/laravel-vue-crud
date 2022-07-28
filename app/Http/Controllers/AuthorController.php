<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Save to database a newly created Author.
     *
     * @param AuthorRequest $request
     * @return Author
     */
    public function store(AuthorRequest $request)
    {
        return Author::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);
    }

    /**
     * Returns an Author based on its ID, or all Authors if no ID is provided.
     *
     * @param int|null $id
     * @return Author|Author[]
     */
    public function show(int $id = null)
    {
        if ($id === null) {
            return Author::with('books')->get();
        } else {
            return Author::with('books')->findOrFail($id);
        }
    }

    /**
     * Update the specified Author in database.
     *
     * @param AuthorRequest $request
     * @param int $id
     * @return Author
     */
    public function update(AuthorRequest $request, int $id)
    {
        $author = Author::findOrFail($id);

        $author->first_name = $request->first_name;
        $author->last_name = $request->last_name;

        $author->save();

        return $author;
    }

    /**
     * Remove the specified Author from database.
     *
     * @param int $id
     * @return Author
     */
    public function destroy(int $id)
    {
        $author = Author::findOrFail($id);

        $author->books()->each(function($book){
           $book->delete();
        });
        $author->delete();

        return $author;
    }
}
