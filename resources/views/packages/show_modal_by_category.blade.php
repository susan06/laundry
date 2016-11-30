<div class="modal-body">
<div class="row">
@foreach($packages as $package)
  @if($package->status == 1)
   <div class="col-md-55">
      <div class="thumbnail">
        <div class="image view view-first add-cart" id="{{ $package->id }}">
          <img style="width: 100%; display: block;" src="{{$package->path_image()}}" alt="image" />
          <div class="mask">
            <div class="tools tools-bottom">
              <a href="#"><i class="fa fa-shopping-cart"></i></a> @lang('app.add')
            </div>
          </div>
        </div>
        <div class="caption">
          <p>{{ $package->name }}</p>
        </div>
      </div>
    </div>
  @endif
@endforeach
</div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">@lang('app.close')</button>
</div>