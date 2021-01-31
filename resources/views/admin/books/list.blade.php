<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('წიგნები') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(Session::get("message"))
            <div class="alert alert-success mt-2" role="alert">{{ Session::get("message") }}</div>
            @endif

            <div class="mb-4 mt-3">
                <a href="/cms/books/create">წიგნის დამატება</a>
            </div>
            <form method="get">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="საძიებო სიტყვა" name="keyword" value="{{ $keyword }}">
                    <button class="btn btn-info form-control" style="flex: 0.1">ძებნა</button>
                </div>
            </form>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4 p-3">
                @if(count($books) < 1)
                    <h2>წიგნი ვერ მოიძებნა</h2>
                @else
            	<table class="table table-hover books__list_table">
            		<tr>
            			<th>#</th>
            			<th>წიგნის სახელი</th>
            			<th>ISBN</th>
            			<th>ავტორი</th>
            			<th>ბიბლიოთეკა</th>
                        <th></th>
            		</tr>
            		@foreach($books as $book)
            		<tr>
            			<td>{{ $book->id }}</td>
            			<td>{{ $book->book_title }}</td>
            			<td>{{ $book->book_isbn }}</td>
            			<td>{{ $book->authorFullName }}</td>
            			<td>{{ $book->libraryTitle }}</td>
                        <td>
                            <a href="/cms/books/delete/{{ $book->id }}" class="badge badge-pill badge-danger" onclick="return confirm('დარწმუნებული ხართ?');">წაშლა</a>
                        </td>
            		</tr>
	            	@endforeach
            	</table>
                {{ $books->appends(request()->query())->links() }}                
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
