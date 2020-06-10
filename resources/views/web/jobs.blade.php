@include('template.header')
  <!-- Page Wrapper -->
  <div id="wrapper">
    @include('template.menu')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        @include('template.top')

    <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                @foreach($jobs as $r)
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?=$r->title?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$<?=$r->pay;?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                        </div>
                        <a href="<?=route('web.job.show', ['id' => $r->id])?>" class="btn btn-facebook btn-block">Ver job</a>
                    </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@include('template.footer')
