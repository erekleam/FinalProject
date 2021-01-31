<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Library;
use DB;
use Validator;
use Redirect;

class BooksController extends Controller
{
    //
    public function getAll(Request $request) {


        $books = DB::table('books AS t1')
                    ->leftJoin('authors AS t2', 't1.author_id', '=', 't2.id')
                    ->leftJoin('libraries AS t3', 't1.book_institution_id', '=', 't3.id')
                    ->select(
                        't1.id AS id',
                        't1.book_title AS book_title', 't1.book_isbn',
                        DB::raw('CONCAT(t2.first_name, " ", t2.last_name) AS authorFullName'),
                        't3.title AS libraryTitle', 't3.location_title AS libraryLocation'
                    )
                    ->orderBy('id', 'DESC')
                    ->paginate(10);



        $keyword = $request->get("keyword");
        if ($keyword) {
            $books = Book::where("book_title", "LIKE", "%{$keyword}%")
                            ->orWhere("book_isbn", "LIKE", "%{$keyword}%")
                            ->orWhere("author_id", "LIKE", "%{$keyword}%")
                            ->orWhere("book_institution_id", "LIKE", "%{$keyword}%")
                            ->leftJoin('authors AS t2', 'books.author_id', '=', 't2.id')
                            ->leftJoin('libraries AS t3', 'books.book_institution_id', '=', 't3.id')
                            ->select(
                                'books.id AS id', 't3.title AS libraryTitle',
                                'books.book_title AS book_title', 'books.book_isbn',
                                DB::raw('CONCAT(t2.first_name, " ", t2.last_name) AS authorFullName'),
                            )
                            ->orderBy('id', 'DESC')
                            ->paginate(10)->appends(request()->query());
        }


        return view("admin.books.list", compact("books", "keyword"));
    }

    public function createBook(Request $request) {
        $authors = Author::all();
        $libraries = Library::all();
    	return view("admin.books.create", compact("authors", "libraries"));
    }


    public function createBookRecord(Request $request) {

        $validator = Validator::make(
            $request->all(),
            [
                'book_name' => 'required',
                'book_author_id' => 'required',
                'book_institution_id' => 'required',
            ]
        );
        if ($validator->fails())
            return Redirect::back()->withErrors($validator)->withInput();



        $book = new Book();
        $book->book_title = $request->get("book_name");
        $book->book_isbn = $request->get("book_isbn");
        $book->author_id = $request->get("book_author_id");
        $book->book_institution_id = $request->get("book_institution_id");
        $book->save();


        return Redirect("cms/books")->with("message", "წიგნი წარმატებით დაემატა");
    }


    public function editBookInfo($id) {
        $book = Book::find($id);
        return $book;
    }

    public function deleteRecordByRecordId($id) {
        $book = Book::find($id);
        $book->delete();
        return Redirect("cms/books")->with("message", "წიგნი წარმატებით წაიშალა");
    }



    public function exportBooksToCsv() {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];


        $books = DB::table('books AS t1')
                        ->leftJoin('authors AS t2', 't1.author_id', '=', 't2.id')
                        ->leftJoin('libraries AS t3', 't1.book_institution_id', '=', 't3.id')
                        ->select(
                            't1.id AS bookId',
                            't1.book_title AS bookTitle', 't1.book_isbn AS bookISBN',
                            't2.first_name AS authorFirstName', 't2.last_name AS authorLastName',
                            't3.title AS libraryTitle', 't3.location_title AS libraryLocation'
                        )->get();

        $columns = ['წიგნის ID', 'წიგნის სახელი', 'ბიბლიოთეკა', 'ISBN', 'ავტორი'];

        $callback = function() use ($books, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach($books as $book) {
                fputcsv($file, [
                    $book->bookId,
                    $book->bookTitle,
                    $book->libraryTitle,
                    $book->bookISBN,
                    $book->authorFirstName . ' ' . $book->authorLastName
                ]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);



    }

}
