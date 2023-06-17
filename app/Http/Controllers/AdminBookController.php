<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Exception;

class AdminBookController extends Controller
{
    function index(){
        $books = Book::all();
        return view('admin.index', compact('books'));
    }

    function enterBookDetails(){
        return view('admin.enterBookDetails');
    }

    function showBook($id){
        $book = Book::query()->find($id);
        return view('admin.editBook', compact('book'));
    }

    function store(Request $req){
            if(!(ctype_digit($req->edition) && ctype_digit($req->year))){
                return response([
                    'type' => 'error',
                    'message' => 'Year and Edition fields must be a Number!',
                ]);
            }
            else{
                $book = new Book();
                $book['name'] = $req['name'];
                $book['edition'] = $req['edition'];
                $book['year'] = $req['year'];
                $book['author'] = $req['author'];
                $book['category'] = $req['category'];
                $book->save();
                return response([
                    'type' => 'success',
                    'message' => 'Book has been saved successfully!',
                ]);
            }
    }

    function update($id, Request $req){
        if(!(ctype_digit($req->edition) && ctype_digit($req->year))){
            return response([
                'type' => 'error',
                'message' => 'Year and Edition fields must be a Number!',
            ]);
        }
        else{
            $book = Book::find($id);
            $book['name'] = $req['name'];
            $book['edition'] = $req['edition'];
            $book['year'] = $req['year'];
            $book['author'] = $req['author'];
            $book['category'] = $req['category'];
            $book->save();
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
