@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>Items</h2>
    @if (count($items) > 0)
      <div class="list-group">
        @foreach($items as $item)
          <a href="/request/{{$item->id}}/edit" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">{{$item->text}}</h5>
              <small>{{$item->created_at}}</small>
            </div>
            <p class="mb-1">{{$item->body}}</p>
            <form class="" action="/request/{{$item->id}}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger float-right" name="button">Delete</button>
            </form>
          </a>
        @endforeach
      </div>
    @else
      <p>No items added yet...</p>
    @endif
  </div>

@endsection
