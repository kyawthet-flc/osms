<div class="col-md-12 pt-3 pb-3 text-white" style="min-height: 100px;height: auto;background-color: #a62961;">
    <h5 class="text-capitalize mb-3">This is for Technical person.</h5>
    <form action="{{ route('view.as.selected') }}" method="post">
        @csrf
        <select class="form-control" name="viewAs" onchange="this.form.submit()">
            @foreach(App\User::get(['id', 'name', 'user_type']) as $user)
            <option value="{{ $user->id }}"
                @if(auth()->user()->id === $user->id)
                 selected="selected"
                @endif>View as {{ ucwords($user->name) }} ({{ $user->user_type }})</option>
            @endforeach
        </select>
    </form>
</div>