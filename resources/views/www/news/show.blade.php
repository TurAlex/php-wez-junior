@extends('www.layout')

@section('content')
  <main role="main">
    <section class="jumbotron text-center">
      <div class="container">
        <h1 class="jumbotron-heading">Single news</h1>
        <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
      </div>
    </section>

    <div class="album py-5 bg-light">
      <div class="container">

        <div class="row">
          <div class="col-12">
            <h1>{{$news->title}}</h1>
            <img class="" src="/uploads/{{$news->image}}" alt="Card image cap" style="max-height: 200px">
            <p>{{$news->content}}</p>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection

