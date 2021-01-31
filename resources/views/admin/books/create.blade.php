<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('წიგნის დამატება') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">

                <form method="post" action="/cms/books/create">
                    <div class="form-group">
                        <label>შეიყვანეთ წიგნის სახელი</label>
                        <input type="text" name="book_name" class="form-control" value="{{ old('book_name') }}">
                        {!! $errors->first('book_name', '<span style="color: red;font-weight: bold">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label>შეიყვანეთ წიგნის ISBN (optional)</label>
                        <input type="text" name="book_isbn" class="form-control" value="{{ old('book_isbn') }}">
                    </div>
                    <div class="form-group">
                        <label>აირჩიეთ წიგნის ავტორი</label>
                        <select name="book_author_id" class="form-control">
                            <option value="">-- გთხოვთ აირჩიეთ --</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->first_name }} {{ $author->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>აირჩიეთ ბიბლიოთეკა სადაც წიგნია</label>
                        <select name="book_institution_id" class="form-control">
                            <option value="">-- გთხოვთ აირჩიეთ --</option>
                            @foreach($libraries as $library)
                                <option value="{{ $library->id }}">{{ $library->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="form-control btn btn-info">დამატება</button>
                    </div>
                    @csrf
                </form>
            	   
            </div>
        </div>
    </div>
</x-app-layout>
