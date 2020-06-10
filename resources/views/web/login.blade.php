@include('template.header')
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-4 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bem vindo!</h1>
                  </div>
                  <form class="user" action="{{route('web.login')}}" method="post">
                    @csrf
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="email" placeholder="E-mail">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password"placeholder="Senha">
                    </div>
                    <Button class="btn btn-primary btn-user btn-block">
                      Login
                    </Button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="#">Esqueceu a senha?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="{{route('web.register')}}">Criar conta!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
  @include('template.footer')
