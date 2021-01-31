<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ავტორის დამატება') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">

                <form method="post" action="/cms/authors/create">
                    <div class="form-group">
                        <label>შეიყვანეთ ავტორის სახელი</label>
                        <input type="text" name="author_name" class="form-control" value="{{ old('author_name') }}">
                        {!! $errors->first('author_name', '<span style="color: red;font-weight: bold">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label>შეიყვანეთ ავტორის გვარი</label>
                        <input type="text" name="author_last" class="form-control" value="{{ old('author_last') }}">
                        {!! $errors->first('author_last', '<span style="color: red;font-weight: bold">:message</span>') !!}
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
