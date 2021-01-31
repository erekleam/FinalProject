<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use Validator;
use Redirect;

class AuthorsController extends Controller
{
    //
    public function getAll() {
    	$authors = Author::orderBy('id', 'DESC')->paginate(15);
    	return view("admin.authors.list", compact("authors"));
    }

    public function createAuthor() {
    	return view("admin.authors.create");
    }



    public function createAuthorRecord(Request $request) {

    	$validator = Validator::make($request->all(), [
            'author_name' => 'required',
            'author_last' => 'required',
        ]);

        if ($validator->fails())
            return Redirect::back()->withErrors($validator)->withInput();


        $author = new Author();
        $author->first_name = $request->input("author_name");
        $author->last_name = $request->input("author_last");
        $author->save();

        return Redirect("cms/authors")->with("message", "ავტორი წარმატებით დაემატა");


    }

    public function deleteRecordByRecordId($id) {
      $book = Author::find($id);
      $book->delete();
      return Redirect("cms/authors")->with("message", "წიგნი წარმატებით წაიშალა");
    }



}
