<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;


class MovieController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     public function getAll() {
         $movies = Movie::join('directors', 'director_id', '=', 'directors.id')->select('movies.id','title','short_description','name')->orderBy('movies.id', 'desc')->get();
         return response()->json($movies);
     }


     public function getOne($id) {
        $movie = Movie::join('directors', 'director_id', '=', 'directors.id')->select('movies.id','title','short_description','poster','name')->where('movies.id', '=', $id)->get();
         return response()->json($movie);
     }


     public function save(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'director_id' => 'required',
            'short_description' => 'required',
            'poster' => 'required'
        ]);
        $movie = Movie::create($request->all());
        return response()->json($movie, 201);
    }



    /* public function save(Request $request) {
         $this->validate($request, [
             'title' => 'required',
             'author_id' => 'required',
             'published_date' => 'required|date',
             'book_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
         ]);

         if ($request->hasFile('book_image')) {
            $file = $request->file('book_image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('images', $filename, 'public');
         } else {
             return response()->json(['error' => 'Image upload failed'], 400);
         }

         $book = Book::create([
             'title' => $request->title,
             'author_id' => $request->author_id,
             'published_date' => $request->published_date,
             'book_image' => $imagePath
         ]);

         return response()->json($book, 201);
     } */
    

    public function update(Request $request, $id) {
        $movie = Movie::findOrFail($id);
    
        $this->validate($request, [
            'title' => 'required',
            'director_id' => 'required',
            'short_description' => 'required',
            'poster' => 'required'
        ]);
        $movie->update($request->all());
        return response()->json($movie);
    }
    
    
    public function delete($id) {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return response()->json(null, 204);
    }
    
}
