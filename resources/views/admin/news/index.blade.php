@extends('admin.layout')

@section('content')

  <!-- Row -->
  <div class="row">
    <div class="col-sm-12">
      <h5 class="">Список новостей</h5>
    </div>

    <div class="col-sm-12">
      <div class="panel panel-default card-view">
        <div class="panel-heading">
          <div class="clearfix"></div>
          <a href="{{route('news.create')}}" class="btn  btn-success btn-sm btn-rounded btn-icon left-icon mt-40 ml-20"><i class="fas fa-plus pr-20"></i> <span>Добавить</span></a>
        </div>


        <div class="panel-wrapper">
          <div class="panel-body">
            <div class="table-wrap">
              <div class="table-responsive">
                <table id="datable_1" class="table table-hover display  pb-30" >
                  <thead>
                  <tr>
                    <th style="width: 6%">ID</th>
                    <th style="width: 25%">Название</th>
                    <th style="width: 5%">Картинка</th>
                    <th style="width: 5%">Создан</th>
                    <th style="width: 5%">Редакция</th>
                    <th style="width: 10%">Действие</th>
                  </tr>
                  </thead>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Картинка</th>
                    <th>Создан</th>
                    <th>Редакция</th>
                    <th>Действие</th>
                  </tr>
                  </tfoot>
                  <tbody>
                  {{--{{dd($newses)}}--}}
                  @foreach($newses as $news)
                    <tr>
                      <td>{{$news->id}}</td>
                      <td>{{$news->title}}</td>
                      <td><img src="{{$news->getImage()}}" alt="" class="post-auth-img img-circle" style="width: 40px;height: auto"></td>
                      <td>{{$news->created_at->format('d.m.y')}}</td>
                      <td>{{$news->updated_at->format('d.m.y')}}</td>
                      <td style="white-space: nowrap">
                        @if($news->status == 1)
                          <a href="/admin/news/toggle/{{$news->id}}" data-toggle="tooltip" data-original-title="Снять с публикации"><button class="btn btn-danger btn-icon-anim btn-square"><i class="fas fa-lock"></i></button></a>
                        @else
                          <a href="/admin/news/toggle/{{$news->id}}" data-toggle="tooltip" data-original-title="Опубликовать"><button class="btn btn-success btn-icon-anim btn-square"><i class="fas fa-lock-open"></i></button></a>
                        @endif
                        <a href="{{route('news.edit', $news->id)}}" data-toggle="tooltip" data-original-title="Изменить"><button class="btn btn-primary btn-icon-anim btn-square"><i class="fas fa-pencil-alt"></i></button></a>
                        {{Form::open(['route' => ['news.destroy', $news->id], 'method' => 'delete', 'style' => 'display:inline-block'])}}
                        <button onclick="return confirm('Вы уверены что хотите удалить пост?')" type="submit"  data-toggle="tooltip" data-original-title="Удалить" class=" btn btn-info btn-icon-anim btn-square"><i class="fas fa-trash-alt"></i></button>
                        {{Form::close()}}
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Row -->
  <div class="row justify-content-center mt-5">
    <div class="col-auto ">
      {{ $newses->links() }}
    </div>
  </div>
@endsection