@extends('layouts.main')

@section('content')
	<style>
		#basket {
			width: 1200px;
			margin: 0 auto;
        }

		#basket .row {
			display: flex;
			margin-bottom: 10px;
		}

		#basket .row .name,
		#basket .row .price {
			margin-right: 15px;
        }
	</style>
	<div id="basket">
		@foreach($basket?->getProducts() ?? [] as $product)
			<div class="row">
				<div class="name">
					{{ $product->name . "(" . $product->code . ")" }}
				</div>
				<div class="price">
					${{ $product->price }} x {{ $basket->products[$product->id]['qty'] }}
				</div>
				<form action="{{ route('basket.destroy', $product->code) }}"
				      method="POST"
				>
					@method('DELETE')
					@csrf
					<button class="buy-now">
						Remove
					</button>
				</form>
			</div>
		@endforeach
		@if($costs)
			<div class="row">
				Discounts: ${{ sprintf('%.2f', $costs['discount']) }}
			</div>
			<div class="row">
				Delivery: ${{ sprintf('%.2f', $costs['delivery']) }}
			</div>
			<div class="row">
				Total: ${{ sprintf('%.2f', $costs['total']) }}
			</div>
		@endif
		<div class="row">
			<a href="{{ route('basket.index') }}"><= Continue Shopping</a>
		</div>
	</div>
@endsection
