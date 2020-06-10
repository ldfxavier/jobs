@include('template.header')

<div class="container">
    <div class="row">
        <form action="<?=route('events.store');?>" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="Nome do evento">
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <input type="text" class="form-control" name="description" placeholder="Descrição do evento">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <div class="row">
        <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Evento</th>
                <th scope="col">Descrição</th>
                <th scope="col">Remover</th>
                </tr>
            </thead>
            <tbody>
@foreach ($events as $r)
                <tr>
                    <th scope="row"><?=$r->id?></th>
                    <td><?=$r->name?></td>
                    <td><?=$r->description?></td>
                    <td>
                        <div class="row">
                            <form action="<?=url('/eventos/' . $r->id)?>" method="post">
                                @method('DELETE')
                                @csrf
                                <button>X</button>
                            </form>
                            <a href="<?=route('events.show', ['events' => $r->id])?>">
                            ver
                            </a>
                        </div>
                    </td>
                </tr>
@endforeach
            </tbody>
        </table>
    </div>
</div>

@include('template.footer')
