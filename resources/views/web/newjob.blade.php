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
        <?php
if (isset($error) && !empty($error)):
    echo $error['message'];
endif;
?>
            <form action="{{route('web.job.store')}}" method="post">
                                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Cargo</label>
                    <input type="text" class="form-control" name="title" placeholder="Cargo">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Descrição</label>
                    <input type="text" class="form-control" name="description" placeholder="Descrição">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Local</label>
                    <input type="text" class="form-control" name="place" placeholder="Local">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Dia</label>
                    <input type="text" class="form-control" name="day" placeholder="Dia">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Hora</label>
                    <input type="text" class="form-control" name="hour" placeholder="Hora">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Pagamento</label>
                    <input type="text" class="form-control" name="pay" placeholder="Pagamento">
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar job</button>
            </form>
        </div>
    </div>
</div>

@include('template.footer')
