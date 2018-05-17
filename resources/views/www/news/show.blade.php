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

          <div class="col-sm-12">
            <div class="panel panel-default card-view">
              <div class="panel-heading">
                <div class="pull-left">
                  <h3 class="panel-title txt-dark">Добавить комментарий</h3>
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

              <form method="post" action="/add_comment">
                {{csrf_field()}}
                <input type="hidden" name="news_id" value="{{$news->id}}" >
                <div class="form-group">
                  <label for="name">Имя</label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="Введите имя" value="{{old('name')}}">
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" name="email" class="form-control" id="email" placeholder="Введите email" value="{{old('email')}}" >
                </div>

                <div class="form-group ">
                  <label for="comment">Ваш комментарий</label>
                  <textarea name="content" class="form-control" id="comment" rows="4">{{old('content')}}</textarea>
                </div>
                <div class="form-group">
                  <div class="g-recaptcha" data-sitekey="6Lc0nFkUAAAAAFiix2SRJA8JfghbO31lUTvah3no"></div>
                </div>

                <button type="submit" class="btn btn-primary">Оставить комментарий</button>

              </form>

            </div>
          </div>

          <div class="col-12 mt-5">
            <h2>Коментарии</h2>

            @foreach($news->getComments() as $comment)
              <div class="card mb-1">
                <div class="card-header">

                </div>
                <div class="card-body">
                  <blockquote class="blockquote mb-0">
                    <p>{{$comment->content}}</p>
                    <footer class="blockquote-footer">{{$comment->name}}</footer>
                  </blockquote>
                </div>
              </div>
            @endforeach

          </div>



        </div>
      </div>
    </div>
  </main>
@endsection

