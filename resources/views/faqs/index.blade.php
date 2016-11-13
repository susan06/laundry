@extends('layouts.app')

@section('page-title', trans('app.faqs'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.faqs')</h3>
            </div>
            @include('partials.search')
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">
            <p>
            <button type="button" data-href="{{ route('faq.create') }}" class="btn btn-primary btn-sm create-edit-show" data-model="modal" title="@lang('app.create_faq')">@lang('app.create_faq')</button>
            </p>

            <div id="content-table">
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <th>#</th>
                  <th>@lang('app.question')</th>
                  <th>@lang('app.registration_date')</th>
                  <th>@lang('app.status')</th>
                  <th class="text-center">@lang('app.actions')</th>
                </thead>
                <tbody>
                @if (count($faqs))
                    @foreach ($faqs as $key => $faq)
                        <tr>
                            <td>{{ ($faqs->currentpage()-1) * $faqs->perpage() + $key + 1 }}</td>
                            <td>{{ $faq->question }}</td>
                            <td>{{ $faq->created_at }}</td>
                            <td>
                              <span class="label label-{{ $faq->labelClass() }}">{{ trans("app.{$faq->status}") }}</span>
                            </td>
                            <td class="text-center">
                            <button type="button" data-href="{{ route('faq.show', $faq->id) }}" class="btn btn-round btn-primary btn-xs create-edit-show" data-model="modal"
                                 title="@lang('app.show_faq')" data-toggle="tooltip" data-placement="top">
                                  <i class="fa fa-eye"></i>
                              </button>
                              <button type="button" data-href="{{ route('faq.edit', $faq->id) }}" class="btn btn-round btn-primary btn-xs create-edit-show" data-model="modal"
                                 title="@lang('app.edit_faq')" data-toggle="tooltip" data-placement="top">
                                  <i class="fa fa-edit"></i>
                              </button>
                            @if($faq->status == 'No Published')
                                <button type="button" data-href="{{ route('faq.destroy', $faq->id) }}" 
                                  class="btn btn-round btn-danger btn-xs btn-delete" 
                                  data-confirm-text="@lang('app.are_you_sure_delete_faq')"
                                  data-confirm-delete="@lang('app.yes_delete_him')"
                                  title="@lang('app.delete_faq')" data-toggle="tooltip" data-placement="top">
                                    <i class="fa fa-trash"></i>
                                </button>
                             @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5"><em>@lang('app.no_records_found')</em></td>
                    </tr>
                @endif
                </tbody>
              </table>
              {{ $faqs->links() }}
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