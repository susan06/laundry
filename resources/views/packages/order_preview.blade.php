 <table class="table">
  <thead>
  <tr>
    <th>@lang('app.quant')</th>
    <th>@lang('app.name')</th>
    <th>@lang('app.category')</th>
    <th>@lang('app.price')</th>
    <th>@lang('app.sub_total')</th>
  </tr>
  </thead>
  <tbody class="form-horizontal" id="packages_list">
     @foreach ($packages as $key => $package)
        <tr>
            <td>
            {{ $package['quantity'] }}
            <input type="hidden" name="packages[]" value="{{ $package['name'] }}">
            <input type="hidden" name="quantity[]" value="{{ $package['quantity'] }}">
            <input type="hidden" name="prices[]" value="{{ $package['price'] }}">
            </td>
            <td>
            {{ $package['name'] }}
            
            </td>
            <td>{{ $package['category'] }}</td>
            <td>
            {{ $package['price'] }}
            </td>
            <td class="list_prices">
              <span class="prices-pack">{!! $package['quantity'] * $package['price'] !!}<span>
            </td>
        </tr>
    @endforeach
  </tbody>
</table>