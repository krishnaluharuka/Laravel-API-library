<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class BookController extends Controller
{
    function list(){
        $books= Book::paginate(5);

        $html="<html><head>
        <title>Books List</title>
        <style>
            table { width: 100%; border-collapse: collapse; margin: 20px 0; }
            table, th, td { border: 1px solid black; }
            th, td { padding: 8px 12px; text-align: left; }
            th { background-color: #f2f2f2; }
        </style>
        </head><body>";

        $html .= "<h2>Books List</h2>";
        $html .= "<table><thead><tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author Id</th>
                    <th>Description</th>
                    <th>Published_date</th>
                  </tr></thead><tbody>";

        foreach ($books as $book) {
            $html .= "<tr>
                        <td>{$book->id}</td>
                        <td>{$book->title}</td>
                        <td>{$book->author_id}</td>
                        <td>{$book->description}</td>
                        <td>{$book->published_date}</td>
                      </tr>";
        }

        $html .= "</tbody></table>";

         $html .= "<div class='pagination'>";
        if ($books->onFirstPage()) {
            $html .= "<span class='active'>« </span>";
        } else {
            $html .= "<a href='" . $books->previousPageUrl() . "'> « </a>";
        }

        for ($i = 1; $i <= $books->lastPage(); $i++) {
            $activeClass = ($i == $books->currentPage()) ? 'active' : '';
            $html .= "<a class='{$activeClass}' href='" . $books->url($i) . "'> $i </a>";
        }

        if ($books->hasMorePages()) {
            $html .= "<a href='" . $books->nextPageUrl() . "'> » </a>";
        } else {
            $html .= "<span class='active'> »</span>";
        }
        $html .= "</div>";

        $html .= "</body></html>";

        return new Response($html, 200, ['Content-Type' => 'text/html']);

    
    }

    function addBook(Request $request){
        $rules=array('title'=>'required |min:2 |max:25','author_id'=>'required | numeric','description'=>'required');
        $validation=Validator::make($request->all(),$rules);
        if($validation->fails()){
            return $validation->errors();
        }else{
        $book=new Book();
        $book->title=$request->title;
        $book->author_id=$request->author_id;
        $book->description=$request->description;
        $book->published_date=$request->published_date;
        if($book->save()){
            return "Book added";
        }
        else{
            return "Operation failed";
        }
    }
    }

    function viewBook($book_name){
        $book = Book::where('title','like',"%$book_name%")->get();
        if($book->isNotEmpty()){
            return $book;
        }else{
            return["result"=>"no record found"];
        }
        
    }

    function updateBook(Request $request){
        $book=Book::find($request->id);
        $book->title=$request->title;
        $book->author_id=$request->author_id;
        $book->description=$request->description;
        $book->published_date=$request->published_date;
        if($book->save()){
            return "Book data updated";
        }
        else{
            return "Operation failed";
        }
    }

    function deleteBook($id){
        $book=Book::destroy($id);
        if($book){
            return ['result'=>"Book record deleted"];
        }
        else{
            return ['result'=> "Book record not deleted"];
        }
    }
}
