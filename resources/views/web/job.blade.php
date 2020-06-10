@include('template.header')
  <!-- Page Wrapper -->
  <div id="wrapper">
    @include('template.menu')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        @include('template.top')
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?=$job->title?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$job->description;?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$job->place;?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$job->day;?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$job->hour;?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$<?=$job->pay;?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                            </div>
                        </div>
                    </div>
            </div>

            @foreach($job->apply as $j)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?=$j['user']->name?></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$j['user']->email?></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$j['user']->phone?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
@include('template.footer')
