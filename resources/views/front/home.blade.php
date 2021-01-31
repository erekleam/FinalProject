@extends("layouts.master")


@section("content")

			<div class="home">
				<div class="search__landing_wrapper">
					<div class="container">
						<h1>წიგნის ძებნა</h1>
						<span>ჩაწერეთ წიგნის სახელი ან ავტორი</span>
						<form action="/search" method="get" class="mt-3">
							<div class="input-group">
								<input type="text" name="q" class="form-control">
								<button class="form-control" style="flex: 0.2">ძებნა</button>
							</div>
						</form>
					</div>
				</div>
			</div>

@endsection
