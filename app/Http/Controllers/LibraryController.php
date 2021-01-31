<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Library;
use Validator;
use Redirect;

class LibraryController extends Controller
{
    //

	public function getAll(Request $request) {
		$libraries = Library::orderBy('id', 'DESC')->paginate(10);
		return view("admin.library.list", compact("libraries"));

	}

	public function deleteRecordByRecordId($id) {
			$book = Library::find($id);
			$book->delete();
			return Redirect("cms/libraries")->with("message", "წიგნი წარმატებით წაიშალა");
	}


	public function createLibrary() {
		return view("admin.library.create");
	}

	public function createLibraryRecord(Request $request) {
			$validator = Validator::make($request->all(), [
					'library_name' => 'required',
					'library_location' => 'required',
			]);

			if ($validator->fails())
					return Redirect::back()->withErrors($validator)->withInput();


			$library = new Library();
			$library->title = $request->get("library_name");
			$library->location_title = $request->get("library_location");
			$library->save();


			return Redirect("cms/libraries")->with("message", "ბიბლიოთეკა წარმატებით დაემატა");
	}






}
