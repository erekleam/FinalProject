<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ბიბლიოთეკის დამატება') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">

                <form method="post" action="/cms/libraries/create">
                    <div class="form-group">
                        <label>შეიყვანეთ ბიბლიოთეკის სახელი</label>
                        <input type="text" name="library_name" class="form-control" value="{{ old('library_name') }}">
                        {!! $errors->first('library_name', '<span style="color: red;font-weight: bold">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label>შეიყვანეთ მისამართი</label>
                        <input type="text" name="library_location" class="form-control" value="{{ old('library_location') }}">
                        {!! $errors->first('library_location', '<span style="color: red;font-weight: bold">:message</span>') !!}
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
