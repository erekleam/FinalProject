<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ბიბლიოთეკები') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(Session::get("message"))
            <div class="alert alert-success mt-2" role="alert">{{ Session::get("message") }}</div>
            @endif
            <div class="mb-4 mt-3">
                <a href="/cms/libraries/create">ბიბლიოთეკის დამატება</a>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4 p-3">
                @if(count($libraries) < 1)
                    <h2>ბიბლიოთეკა მოიძებნა</h2>
                @else
            	<table class="table table-hover books__list_table">
            		<tr>
            			<th>#</th>
            			<th>სახელი</th>
            			<th>ლოკაცია</th>
                        <th></th>
            		</tr>
            		@foreach($libraries as $library)
            		<tr>
            			<td>{{ $library->id }}</td>
                        <td>{{ $library->title }}</td>
                        <td>{{ $library->location_title }}</td>
                        <td>
                            {{--<a href="/cms/library/edit/{{ $library->id }}" class="badge badge-pill badge-info">რედაქტირება</a>--}}
                            <a href="/cms/libraries/delete/{{ $library->id }}" onclick="return confirm('დარწმუნებული ხართ?')" class="badge badge-pill badge-danger">წაშლა</a>
                        </td>
            		</tr>
	            	@endforeach
            	</table>

                {{ $libraries->appends(request()->query())->links() }}

                @endif
            </div>
        </div>
    </div>
</x-app-layout>
