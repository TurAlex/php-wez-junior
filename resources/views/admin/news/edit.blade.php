@extends('admin.layout')

@section('content')

  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default card-view">
        <div class="panel-heading">
          <div class="pull-left">
            <h3 class="panel-title txt-dark">Редактирование новости</h3>
            @include('admin.errors')
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="panel-wrapper">
          <div class="panel-body">
            <div class="form-wrap">
              {{Form::open(['route' => ['news.update', $news->id], 'method' => 'put', 'files' => true]) }}
              <div class="form-group ">
                <label class="control-label mb-10 text-left">Название</label>
                <input type="text" class="form-control" name="title" value="{{$news->title}}">
              </div>
              <div class="form-group ">
                <label class="control-label mb-10 text-left">Url</label>
                <input type="text" class="form-control" name="slug" value="{{$news->slug}}">
              </div>
              <div>
                <img src="{{$news->getImage()}}" alt="image" width="100">
              </div>
              <div class="form-group mb-30">
                <input id="image" name="image" type="file" class="file">
              </div>

              <div class="form-group mb-10">
                <input name="status" id="published" type="checkbox" checked class="js-switch js-switch-1"
                       data-color="#469408"/>
                <label class="control-label mb-10 mt-10 mr-10" for="published">Опубликовано</label>
              </div>
              <div class="form-group mb-10">
                <label class="control-label mb-10 text-left">Интро</label>
                <textarea class="form-control" rows="2" name="intro">{{$news->intro}}</textarea>
              </div>
              <div class="form-group mb-10">
                <label class="control-label mb-10 text-left">Полный текст</label>
                <textarea class="form-control" rows="5" name="content">{{$news->content}}</textarea>
              </div>
              <div class="form-group mb-10">
                <a href="{{route('news.index')}}" type="button" class="btn btn-default btn-anim pull-left"><i
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