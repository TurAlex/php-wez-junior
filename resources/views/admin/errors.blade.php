@if($errors->any())
  @foreach($errors->all() as $error)
    <div class="alert alert-info alert-dismissable mt-20">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <i class="zmdi zmdi-info-outline pr-15 pull-left"></i><p class="pull-left">{{$error}}</p>
      <div class="clearfix"></div>
    </div>
  @endforeach
@endif