@extends('admin.layout')

@section('content')

  <div class="row">
    <div class="col-sm-12">
      <h5 class="">Список отзывов</h5>
    </div>

    <div class="col-sm-12">
      <div class="panel panel-default card-view">
        <div class="panel-heading">
          <div class="clearfix"></div>
          <a href="{{route('reviews.create')}}" class="btn  btn-success btn-sm btn-rounded btn-icon left-icon mt-40 ml-20"><i class="fas fa-plus pr-20"></i> <span>Добавить отзыв</span></a>
        </div>


        <div class="panel-wrapper">
          <div class="panel-body">
            <div class="table-wrap">
              <div class="table-responsive">
                <table id="datable_1" class="table table-hover display  pb-30" >
                  <thead>
                  <tr>
                    <th style="width: 6%">ID</th>
                    <th style="width: 25%">Автор</th>
                    <th style="width: 5%">Email</th>
                    <th style="width: 5%">Создан</th>
                    <th style="width: 5%">Редакция</th>
                    <th style="width: 10%">Действие</th>
                  </tr>
                  </thead>
                  <tfoot>
                  <tr>
                    <th style="width: 6%">ID</th>
                    <th style="width: 25%">Автор</th>
                    <th style="width: 5%">Email</th>
                    <th style="width: 5%">Создан</th>
                    <th style="width: 5%">Редакция</th>
                    <th style="width: 10%">Действие</th>
                  </tr>
                  </tfoot>
                  <tbody>
                  @foreach($reviews as $review)
                    <tr>
                      <td>{{$review->id}}</td>
                      <td>{{$review->name}}</td>
                      <td>{{$review->email}}</td>
                      <td>{{$review->created_at->format('d.m.y')}}</td>
                      <td>{{$review->updated_at->format('d.m.y')}}</td>
                      <td style="white-space: nowrap">
                        @if($review->status == 1)
                          <a href="/admin/reviews/toggle/{{$review->id}}" data-toggle="tooltip" data-original-title="Снять с публикации"><button class="btn btn-danger btn-icon-anim btn-square"><i class="fas fa-lock"></i></button></a>
                        @else
                          <a href="/admin/reviews/toggle/{{$review->id}}" data-toggle="tooltip" data-original-title="Опубликовать"><button class="btn btn-success btn-icon-anim btn-square"><i class="fas fa-lock-open"></i></button></a>
                        @endif
                        <a href="{{route('reviews.edit', $review->id)}}" data-toggle="tooltip" data-original-title="Изменить"><button class="btn btn-primary btn-icon-anim btn-square"><i class="fas fa-pencil-alt"></i></button></a>
                        {{Form::open(['route' => ['reviews.destroy', $review->id], 'method' => 'delete', 'style' => 'display:inline-block'])}}
                        <button onclick="return confirm('Вы уверены что хотите удалить отзыв?')" type="submit"  data-toggle="tooltip" data-original-title="Удалить" class=" btn btn-info btn-icon-anim btn-square"><i class="fas fa-trash-alt"></i></button>
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
  <div class="row justify-content-center mt-5">
    <div class="col-auto ">
      {{ $reviews->links() }}
    </div>
  </div>


@endsection