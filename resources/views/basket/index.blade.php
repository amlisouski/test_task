@extends('layouts.main')

@section('content')
	<style>
		#products {
			display: flex;
			flex-wrap: wrap;
			width: 1200px;
			margin: 0 auto;
		}

		#products .card {
			flex: 0 0 19%;
			display: flex;
			flex-direction: column;
			margin-right: 1%;
			border: solid 1px #CCC;
		}
	</style>
	<div id="products">
		@foreach($products as $product)
			<div class="card">
				<div class="name">
					{{ $product->name . "(" . $product->code . ")" }}
				</div>
				<div class="price">
					${{ $product->price }}
				</div>
				<form action="{{ route('basket.add', $product->code) }}"
				      method="POST"
				>
					@csrf
					<button class="buy-now">
						BUY NOW
					</button>
				</form>
			</div>
		@endforeach
	</div>
@endsection