@if (count($errors) <= 0)
    @if (Session::has('status'))
        <div class="flash alert alert-success">
            <p>{{ Session::get('status') }}</p>
        </div>
    @endif                    
@endif
