<!-- start accordion -->
<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
@foreach ($faqs as $key => $faq)
  @if($faq->status == 'Published')
    <div class="panel">
      <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $faq->id }}" aria-expanded="true" aria-controls="collapseOne">
        <h4 class="panel-title">{{ $faq->question }}</h4>
      </a>
      <div id="collapse-{{ $faq->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-{{ $faq->id }}">
        <div class="panel-body">
          <p>{{ $faq->answer }}</p>
        </div>
      </div>
    </div>
  @endif
@endforeach
</div>
<!-- end of accordion -->
