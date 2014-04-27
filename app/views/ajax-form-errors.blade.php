@if ($errors->has())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissable">
            <i class="fa fa-ban"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <b>Error!</b> {{ $error }}
        </div>
    @endforeach
@endif