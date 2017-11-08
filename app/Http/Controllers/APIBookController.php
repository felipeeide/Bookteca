<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Book;

class APIBookController extends Controller
{

        public function index(){
            try{
              $books = Book::all();
            } catch(\Exception $ex){
              return response()->json(['message'=>'error']);
            }
            return array('data'=>$books);
        }

        public function book($id){

            try{
              $book = Book::findOrFail($id);
            } catch(\Exception $ex){
              return response()->json(['message'=>'error']);
            }

            return $book;

        }

        public function create(BookRequest $request){
            try{
              Book::create($request->all());
            }catch(\Exception $ex){
              return response()->json(['message'=>'error']);
            }
            return response()->json(['message'=>'success']);
        }

        public function update($id, BookRequest $request){

          try{
            $book = Book::find($id);
            $book->title = $request['title'];
            $book->description = $request['description'];
            $book->author = $request['author'];
            $book->save();
          } catch(\Exception $ex){
            return response()->json(['message'=>'error']);
          }
          return response()->json(['message'=>'success']);
        }

        public function delete($id){
           try{
             Book::find($id)->delete();
           } catch(\Exception $ex){
             return response()->json(['message'=>'error']);
           }
           return response()->json(['message'=>'success']);
        }

}
