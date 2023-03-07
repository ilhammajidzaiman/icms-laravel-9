<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ config('app.name') }}</title>
	<link rel="shortcut icon" href="{{ url('assets/images/'.config('app.logo')) }}" type="image/x-icon">
	<link rel="stylesheet" href="{{ url('/') }}/plugins/fontawesome5/css/all.css">
	<link href="{{ url('/') }}/plugins/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">

	<style>
		.hero {
			min-height: 250px;
			padding: 0;
			margin: 0;
			background-repeat: no-repeat;
			background-color: #B9DFF5;
			border-radius: 0 0 50px 50px;
		}
	</style>
</head>

<body class="bg-light">
	<section class="wrapper bg-primaryy hero">
		<div class="container-xxl p-5">
		</div>
	</section>

	<section class="wrapper" style="margin-top: -100px;">
		<div class="container-xxl">


			<div class="row">
				<div class="col">
					<div class="card border-0 shadow" style="min-height:400px;">
						<div class="card-body">
							<h1>Hello world</h1>
						</div>
					</div>
				</div>
			</div>


		</div>
	</section>

	<footer class="fa-w-1 pt-4">
		<div class="wrapper">
			<div class="container">
				<div class="text-center py-5">
					<div>
						Copyright &copy;
						<?= date('Y') ;?>
						<a class="text-decoration-none" href="{{ url('/') }}">{{ config('app.name') }}</a>.
					</div>
					<small class="text-secondary">
						{{ config('app.copyright') }}
					</small>
				</div>
			</div>
		</div>
	</footer>

	<script src="{{ url('/') }}/plugins/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>