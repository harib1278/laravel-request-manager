@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>Insert new item</h2>
    <form class="" action="/request" method="post">
      @csrf
      <div class="form-group">
        <label for="text">Text</label>
        <input type="text" class="form-control" name="text" id="text" placeholder="Enter text">
      </div>
      <div class="form-group">
        <label for="body">Body</label>
        <input type="text" class="form-control" name="body" id="body" placeholder="Enter body">
      </div>
      <button type="submit" class="btn btn primary" name="button">Submit</button>
    </form>
  </div>
@endsection
