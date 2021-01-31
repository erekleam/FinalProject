<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ავტორები') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(Session::get("message"))
            <div class="alert alert-success mt-2" role="alert">{{ Session::get("message") }}</div>
            @endif

            <div class="mb-4 mt-2">
                <a href="/cms/authors/create">ავტორის დამატება</a>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
            	<table class="table books__list_table">
            		<tr>
            			<th>#</th>
            			<th>სახელი</th>
            			<th>გვარი</th>
                        <th></th>
            		</tr>
            		@foreach($authors as $author)
            		<tr>
            			<td>{{ $author->id }}</td>
            			<td>{{ $author->first_name }}</td>
            			<td>{{ $author->last_name }}</td>
                        <td>
                            <!--<a href="/cms/authors/edit/{{ $author->id }}" class="badge badge-pill badge-info">რედაქტირება</a>-->
                            <a href="/cms/authors/delete/{{ $author->id }}" class="badge badge-pill badge-danger" onclick="return confirm('დარწმუნებული ხართ?');">წაშლა</a>
                        </td>
            		</tr>
	            	@endforeach
            	</table>
                {{ $authors->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
