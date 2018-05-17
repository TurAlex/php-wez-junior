@extends('www.layout')

@section('content')
<main role="main">
  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">News list</h1>
      <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
        @foreach($newses as $news)
          <div class="col-4">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="/uploads/{{$news->image}}" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">{{$news->title}}</h5>
                <p class="card-text">{{$news->intro}}</p>
                <a href="/news/{{$news->slug}}" class="btn btn-primary">Читать</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="row justify-content-center mt-5">
        <div class="col-auto ">
          {{ $newses->links() }}
        </div>
      </div>
    </div>
  </div>
</main>
@endsection

