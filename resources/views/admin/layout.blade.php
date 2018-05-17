@include('admin.core.head')

@include('admin.core.nav-top')



<div class="container-fluid">
  <div class="row">
    @include('admin.core.nav-left')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
      @yield ('content')
    </main>
  </div>
</div>

@include('admin.core.foot')