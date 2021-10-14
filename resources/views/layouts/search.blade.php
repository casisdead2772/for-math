<form method="GET" action="{{ route('exercises.index') }}">
    <div class="input-group mb-3">
        <input type="text" class="form-control" id=search_query" name="search_query" value="{{ request()->get('search_query') }}">
        <button type="submit" class="btn btn-success">Search</button>
    </div>
</form>
