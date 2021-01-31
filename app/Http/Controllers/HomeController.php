<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use DB;

class HomeController extends Controller
{
    //
    public function home() {
    	return view("front.home");
    }


    public function about() {
    	return view("front.content.about");
    }


    public function search(Request $request) {

    	$keyword = $request->get("q");

    	if ($keyword) {
    		$books = Book::where("book_title", "LIKE", "%{$keyword}%")
                        ->orWhere("book_isbn", "LIKE", "%{$keyword}%")
                        ->orWhere("t2.first_name", "LIKE", "%{$keyword}%")
                        ->orWhere("t2.last_name", "LIKE", "%{$keyword}%")
                        ->orWhere("t3.title", "LIKE", "%{$keyword}%")
                        ->orWhere(
                        	DB::raw('CONCAT(t2.first_name, " ", t2.last_name)'),
                        	"LIKE",
                        	"%{$keyword}%"
                        )
                        ->leftJoin('authors AS t2', 'books.author_id', '=', 't2.id')
                        ->leftJoin('libraries AS t3', 'books.book_institution_id', '=', 't3.id')
                        ->select(
                            'books.id AS id', 't3.title AS libraryTitle',
                            'books.book_title AS book_title', 'books.book_isbn',
                            DB::raw('CONCAT(t2.first_name, " ", t2.last_name) AS authorFullName'),
                        )
                        ->orderBy('id', 'DESC')
                        ->paginate(15)->appends(request()->query());
    	} else {
    		$books = Book::paginate(15);
    	}

    	return view("front.search", compact("books", "keyword"));
    }


}
