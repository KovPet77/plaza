
@if($products -> isEmpty())
<h4 class="text-center text-danger">Nincs találat</h4>
@else

<div class="container mt-5" style="	z-index:1000;
		position: absolute;">
	<div class="row d-flex justify-content-center">
		<div class="col-md-12">
			<div class="card">
			@foreach($products as $item)
    <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">
        <div class="list border-bottom">
            <img src="{{ asset($item->product_thumbnail)}}" style="width: 40px; height: 40px;">
            <div class="d-flex flex-column ml-5" style="margin-left: 10px; font-size: 16px; font-weight: bold;">
                <span>{{ $item->product_name }}</span>
                <small>{{ number_format($item->selling_price, 0, ',', ' ') }} Ft.</small>
            </div>
        </div>
    </a>
     @endforeach

			</div>
		</div>
	</div>
</div>
@endif