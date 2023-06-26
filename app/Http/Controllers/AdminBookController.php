<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Edition;
use App\Models\Genre;
use App\Models\Tag;
use App\Models\User;

class AdminBookController extends Controller
{
    function index(){
        $books = Book::all();
        return view('admin.index', compact('books'));
    }

    function showEverything() {
        $categories = Category::all();
        $authors = Author::all();
        $editions = Edition::all();
        $genres = Genre::all();
        $tags = Tag::all();
        return view('admin.everything', ['authors' => $authors, 'categories' => $categories, 'editions' => $editions, 'genres' => $genres, 'tags' => $tags]);
    }

    function enterBookDetails(){
        $genres = Genre::all();
        $tags = Tag::all();
        $editions = Edition::all();
        $authors = Author::all();
        return view('admin.enterBookDetails', compact('genres', 'tags', 'editions', 'authors'));
    }

    function editBookDetails($id){
        $book = Book::find($id);
        $genres = Genre::all();
        $tags = Tag::all();
        $editions = Edition::all();
        $authors = Author::all();
        return view('admin.editBook', compact('book', 'genres', 'tags', 'editions', 'authors'));
    }

    function store(Request $req){
            if(!(ctype_digit($req->edition) && ctype_digit($req->publishingYear) && ctype_digit($req->isbn))){
                return response([
                    'type' => 'error',
                    'message' => 'Year, Edition and ISBN fields must be a Number!',
                ]);
            }
            else{
                $book = new Book();
                $user = User::find($req['userid']);
                $author = Author::firstOrCreate(['name' => $req['author']]);
                $edition = Edition::firstOrCreate(['number' => $req['edition']]);
                $book['title'] = $req['title'];
                $book['isbn'] = $req['isbn'];
                $book['publish_date'] = $req['publishingYear'];
                $book['summary'] = $req['summary'];
                $book->user()->associate($user);
                $book->author()->associate($author);
                $book->edition()->associate($edition);
                $book->save();
                
                foreach($req['categories'] as $categoryId){
                    $category = Category::find($categoryId);
                    $book->categories()->attach($category);
                }

                foreach($req['tags'] as $tagId){
                    $tag = Tag::find($tagId);
                    $book->tags()->attach($tag);
                }
                
                return response([
                    'type' => 'success',
                    'message' => 'Book has been saved successfully!',
                ]);
            }
    }

    function update($id, Request $req){
        if(!(ctype_digit($req->edition) && ctype_digit($req->publishingYear) && ctype_digit($req->isbn))){
            return response([
                'type' => 'error',
                'message' => 'Year, Edition and ISBN fields must be a Number!',
            ]);
        }
        else{
            $book = Book::find($id);
            $author = Author::firstOrCreate(['name' => $req['author']]);
            $edition = Edition::firstOrCreate(['number' => $req['edition']]);
            $book['title'] = $req['title'];
            $book['isbn'] = $req['isbn'];
            $book['publish_date'] = $req['publishingYear'];
            $book['summary'] = $req['summary'];
            $book->author()->associate($author);
            $book->edition()->associate($edition);
            $book->save();
            
            foreach($req['categories'] as $categoryId){
                $category = Category::find($categoryId);
                $book->categories()->attach($category);
            }

            foreach($req['tags'] as $tagId){
                $tag = Tag::find($tagId);
                $book->tags()->attach($tag);
            }
            
            return response([
                'type' => 'success',
                'message' => 'Book has been updated successfully!',
            ]);
        }
    }

    function destroy($id){
        try
        {
            Book::query()->find($id)->delete();
            return response('The book has been deleted successfully!');
        }

        catch(\Exception $e){
            return response('Some error occured, try again!');
        }
    }
}
