<?php

namespace App\Http\Controllers;
use App\Models\Author;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;


class AuthorController extends Controller
{
    function list(){
        $authors= Author::paginate(5);

        $html="<html><head>
        <title>Authors List</title>
        <style>
            table { width: 100%; border-collapse: collapse; margin: 20px 0; }
            table, th, td { border: 1px solid black; }
            th, td { padding: 8px 12px; text-align: left; }
            th { background-color: #f2f2f2; }
        </style>
        </head><body>";

        $html .= "<h2>Authors List</h2>";
        $html .= "<table><thead><tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Bio</th>
                  </tr></thead><tbody>";

        foreach ($authors as $author) {
            $html .= "<tr>
                        <td>{$author->id}</td>
                        <td>{$author->author_name}</td>
                        <td>{$author->bio}</td>
                      </tr>";
        }

        $html .= "</tbody></table>";

         $html .= "<div class='pagination'>";
        if ($authors->onFirstPage()) {
            $html .= "<span class='active'>« </span>";
        } else {
            $html .= "<a href='" . $authors->previousPageUrl() . "'> « </a>";
        }

        for ($i = 1; $i <= $authors->lastPage(); $i++) {
            $activeClass = ($i == $authors->currentPage()) ? 'active' : '';
            $html .= "<a class='{$activeClass}' href='" . $authors->url($i) . "'> $i </a>";
        }

        if ($authors->hasMorePages()) {
            $html .= "<a href='" . $authors->nextPageUrl() . "'> » </a>";
        } else {
            $html .= "<span class='active'> »</span>";
        }
        $html .= "</div>";

        $html .= "</body></html>";

        return new Response($html, 200, ['Content-Type' => 'text/html']);

    }

    function addAuthor(Request $request){
        $rules=array('author_name'=>'required |min:2 |max:25','bio'=>'required');
        $validation=Validator::make($request->all(),$rules);
        if($validation->fails()){
            return $validation->errors();
        }else{
        $author=new Author();
        $author->author_name=$request->author_name;
        $author->bio=$request->bio;
        if($author->save()){
            return "Author added";
        }
        else{
            return "Operation failed";
        }
    }
    }

    function viewAuthor($author_name){
        $author = Author::where('author_name','like',"%$author_name%")->get();
        if($author->isNotEmpty()){
            return $author;
        }else{
            return["result"=>"no record found"];
        }
        
    }

    function updateAuthor(Request $request){
        $author=Author::find($request->id);
        $author->author_name=$request->author_name;
        $author->bio=$request->bio;
        if($author->save()){
            return "Author data updated";
        }
        else{
            return "Operation failed";
        }
    }

    function deleteAuthor($id){
        $author=Author::destroy($id);
        if($author){
            return ['result'=>"author record deleted"];
        }
        else{
            return ['result'=> "Author record not deleted"];
        }
    }
}
