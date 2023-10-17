@if (session()->has('SuccessMessage'))
    <div class="alert alert-success border-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="icofont icofont-close-line-circled"></i>
        </button>
        {{ session()->get('SuccessMessage') }}
    </div>
@endif

@if (session()->has('ErrorMessage'))
    <div class="alert alert-danger border-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="icofont icofont-close-line-circled"></i>
        </button>
        {!! html_entity_decode(session()->get('ErrorMessage')) !!}
    </div>
@endif

