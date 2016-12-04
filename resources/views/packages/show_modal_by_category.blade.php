<div class="modal-body">
<div class="row">
@foreach($packages as $package)
   <div class="col-md-55">
      <div class="thumbnail">
        <div class="image view view-first add-cart" id="{{ $package->id }}">
          <img src="{{$package->path_image()}}" alt="image" />
          <div class="mask">
            <div class="tools tools-bottom">
              <a href="javascript:void(0)" id="cart_add"><i class="fa fa-shopping-cart"></i> @lang('app.add')</a>
            </div>
          </div>
        </div>
        <div class="caption">
          <p>{{ $package->name }}</p>
          @if(isset($time_select))
            @foreach($package->package_price as $price)
              @if($price->delivery_schedule == $time_select)
              <p>{{ trans('app.price').': '.$price->price.' '.Settings::get('coin') }}</p>
              @endif
            @endforeach
          @endif
        </div>
      </div>
    </div>
@endforeach
</div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">@lang('app.close')</button>
</div>