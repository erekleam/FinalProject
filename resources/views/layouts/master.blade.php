<!DOCTYPE html>
<html>
<head>
	<title>LMS</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/fonts.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/web.css') }}">
</head>
<body>

	<div id="app">
		<header>
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<a href="/" class="logo">
							<img src="{{ asset('/img/logo-2.png') }}">
						</a>
					</div>
					<div class="col-md-6">
						<nav>
							<ul>
								<li>
									<a href="/">მთავარი</a>
								</li>
								<li>
									<a href="/about-us">ჩვენ შესახებ</a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</header>
		<div id="content">
			@yield("content")
		</div>
	</div>
</body>
</html>
