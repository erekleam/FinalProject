@extends("layouts.master")


@section("content")


	<div class="container mt-4 about">
		<h2>ძებნის შედეგები</h2>


		<form action="/search" class="search_form">
			<div>
				<input type="text" name="q" value="{{ $keyword }}" placeholder="მოძებნეთ სასურველი წიგნი">
			</div>
		</form>

		<div class="search_result">

			@foreach($books as $book)

				<div>
					<div>
						<a href="#">{{ $book->book_title }}</a>
						<p>{{ $book->libraryTitle }}</p>
					</div>
				</div>

			@endforeach


			@if($books->total() > $books->perPage())
			<div class="p-2">
				{{ $books->links() }}
			</div>
			@endif


			@if (count($books) < 1)
				<h2 class="text-center pt-3 pb-3">წიგნი ვერ მოიძებნა</h2>
			@endif

		</div>
	</div>

@endsection
