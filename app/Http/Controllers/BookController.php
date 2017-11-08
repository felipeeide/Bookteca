<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Book;

class BookController extends Controller
{

        public function index(){
            //Select all records from books table via Book method
    		    $allBooks = Book::all();    //Eloquent ORM method to return all matching results

            //Redirecting to bookList.blade.php with $allBooks
            return View('booklist', compact('allBooks'));
        }

        public function create(){
            return view('addbook');
        }

        public function store(BookRequest $requestData){
            //Insert Query
            $book = new Book;
            $book->title= $requestData['title'];
            $book->description= $requestData['description'];
            $book->author= $requestData['author'];
            $book->save();

            //Send control to index() method where it'll redirect to bookList.blade.php
            return redirect()->route('book.index');

        }

        public function show($id){
            //Get results by targeting id
            $book = Book::find($id);

            //Redirecting to showBook.blade.php with $book variable
            return view('showbook')->with('book',$book);
        }

        public function edit($id){
            //Get Result by targeting id
            $book = Book::find($id);

            //Redirecting to editBook.blade.php with $book variable
            return view('editbook')->with('book',$book);
        }

        public function update($id, BookRequest $requestData){
          $book = Book::find($id);

          //Update Query
          $book->title = $requestData['title'];
          $book->description = $requestData['description'];
          $book->author = $requestData['author'];
          $book->save();

          //Redirecting to index() method of BookController class
          return redirect()->route('book.index');
        }

        public function destroy($id){

           //find result by id and delete
           Book::find($id)->delete();

           //Redirecting to index() method
           return redirect()->route('book.index');

        }

}
