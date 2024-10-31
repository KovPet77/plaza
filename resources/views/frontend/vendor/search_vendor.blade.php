
@if($vendor -> isEmpty())
<h4 class="text-center text-danger">Nincs találat</h4>
@else

<div class="container mt-5">
	<div class="row d-flex justify-content-center">
		<div class="col-md-12">
			<div class="card">
				
				@foreach($vendor as $item)
			
				<a href="{{ url('/vendor/details/'.$item->id)}} ">
				
					<div class="list border-bottom">
						<img src="{{ asset('upload/vendor_images/' . $item->photo) }}" style="width: 60px; height: 60px;">

						<div class="d-flex flex-column ml-5" style="margin-left: 10px; font-size:16px; font-weight: bold;">					
							<span>{{ $item->name }}</span>
							<small>Eladó: {{ $item->vendor_join }} óta.</small>
							
						</div>	
					</div>
				</a>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endif