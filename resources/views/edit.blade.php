@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>Edit item</h2>
    <form class="" action="/request/{{ $item->id }}" method="post">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="text">Text</label>
        <input type="text" class="form-control" name="text" id="text" placeholder="Enter text" value="{{ $item->text }}">
      </div>
      <div class="form-group">
        <label for="body">Body</label>
        <input type="text" class="form-control" name="body" id="body" placeholder="Enter body" value="{{ $item->body }}">
      </div>
      <button type="submit" class="btn btn primary" name="button">Submit</button>
    </form>
  </div>
@endsection
