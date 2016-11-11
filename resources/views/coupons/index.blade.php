@extends('layouts.app')

@section('page-title', trans('app.coupons'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.coupons')</h3>
            </div>
            <div>
              <div class="col-md-6 col-sm-7 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" id="search" class="form-control" placeholder="@lang('app.write_here')">
                  <span class="input-group-btn">
                    <button class="btn btn-default search" type="button">@lang('app.search')</button>
                  </span>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">
            <p>
            <button type="button" data-href="{{ route('coupon.create') }}" class="btn btn-primary btn-sm create-edit" data-model="modal"title="@lang('app.create_coupon')">@lang('app.create_coupon')</button>
            </p>

            <div id="content-table">
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <th>#</th>
                  <th>@lang('app.percentage')</th>
                  <th>@lang('app.validity')</th>
                  <th>@lang('app.registration_date')</th>
                  <th>@lang('app.status')</th>
                  <th class="text-center">@lang('app.actions')</th>
                </thead>
                <tbody>
                @if (count($coupons))
                    @foreach ($coupons as $key => $coupon)
                        <tr>
                            <td>{{ ($coupons->currentpage()-1) * $coupons->perpage() + $key + 1 }}</td>
                            <td>{{ $coupon->percentage }}</td>
                            <td>{{ $coupon->validity }}</td>
                            <td>{{ $coupon->created_at }}</td>
                            <td>
                              <span class="label label-{{ $coupon->labelClass() }}">{{ trans("app.{$coupon->status}") }}</span>
                            </td>
                            <td class="text-center">
                            @if($coupon->status == 'Valid')
                                <button type="button" data-href="{{ route('coupon.edit', $coupon->id) }}" class="btn btn-round btn-primary btn-xs create-edit-modal"
                                   title="@lang('app.edit_coupon')" data-toggle="tooltip" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                            @endif
                            @if($coupon->status == 'Useless')
                                <button type="button" data-href="{{ route('coupon.destroy', $coupon->id) }}" 
                                  class="btn btn-round btn-danger btn-xs btn-delete" 
                                  data-confirm-text="@lang('app.are_you_sure_delete_coupon')"
                                  data-confirm-delete="@lang('app.yes_delete_him')"
                                  title="@lang('app.delete_coupon')" data-toggle="tooltip" data-placement="top">
                                    <i class="fa fa-trash"></i>
                                </button>
                             @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6"><em>@lang('app.no_records_found')</em></td>
                    </tr>
                @endif
                </tbody>
              </table>
              {{ $coupons->links() }}
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')

@endsection