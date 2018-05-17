@extends('www.layout')

@section('content')
<main role="main">
  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Reviews list</h1>
      <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
        <div class="col-12 mt-5">
          <h2>Отзывы</h2>
          @foreach($reviews as $review)
            <div class="card mb-1">
              <div class="card-header">

              </div>
              <div class="card-body">
                <blockquote class="blockquote mb-0">
                  <p>{{$review->content}}</p>
                  <footer class="blockquote-footer">{{$review->name}}</footer>
                </blockquote>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <div class="row justify-content-center mt-5">
        <div class="col-auto ">
          {{ $reviews->links() }}
        </div>
      </div>

      <div class="col-sm-12" id="review">
        <div class="panel panel-default card-view">
          <div class="panel-heading">
            <div class="pull-left">
              <h3 class="panel-title txt-dark">Добавить отзыв</h3>
              @include('admin.errors')
            </div>
            <div class="clearfix"></div>
          </div>
          @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>{{session('status')}}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

          @endif

          <form method="post" action="/add_review">
            {{csrf_field()}}
            <div class="form-group">
              <label for="name">Имя</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="Введите имя" value="{{old('name')}}">
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" name="email" class="form-control" id="email" placeholder="Введите email" value="{{old('email')}}" >
            </div>

            <div class="form-group ">
              <label for="comment">Ваш Отзыв</label>
              <textarea name="content" class="form-control" id="comment" rows="4">{{old('content')}}</textarea>
            </div>
            <div class="form-group">
              <div class="g-recaptcha" data-sitekey="6Lc0nFkUAAAAAFiix2SRJA8JfghbO31lUTvah3no"></div>
            </div>

            <button type="submit" class="btn btn-primary">Оставить отзыв</button>

          </form>

        </div>
      </div>
    </div>
  </div>
</main>
@endsection

