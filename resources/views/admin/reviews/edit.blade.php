@extends('admin.layout')

@section('content')

  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default card-view">
        <div class="panel-heading">
          <div class="pull-left">
            <h3 class="panel-title txt-dark">Редактирование комментария</h3>
            @include('admin.errors')
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="panel-wrapper">
          <div class="panel-body">
            <div class="form-wrap">
              {{Form::open(['route' => ['reviews.update', $review->id], 'method' => 'put']) }}
              <div class="form-group ">
                <label class="control-label mb-10 text-left">Имя</label>
                <input type="text" class="form-control" name="name" value="{{$review->name}}">
              </div>
              <div class="form-group ">
                <label class="control-label mb-10 text-left">Email</label>
                <input type="text" class="form-control" name="email" value="{{$review->email}}">
              </div>
              <div class="form-group mb-10">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="customCheck1" name="status" <?= $review->status ? 'checked':''?>>
                  <label class="custom-control-label" for="customCheck1">Опубликовать</label>
                </div>
              </div>


              <div class="form-group mb-10">
                <label class="control-label mb-10 text-left">Комментарий</label>
                <textarea class="form-control" rows="5" name="content">{{$review->content}}</textarea>
              </div>
              <div class="form-group mb-10">
                <a href="{{route('reviews.index')}}" type="button" class="btn btn-default btn-anim pull-left"><i
                      class="fas fa-arrow-left pt-10"></i><span class="btn-text">Назад</span></a>
                <button type="submit" class="btn btn-success btn-anim pull-right"><i class="icon-rocket"></i><span
                      class="btn-text">Изменить</span></button>
              </div>
              {{ Form::close() }}</div>

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection