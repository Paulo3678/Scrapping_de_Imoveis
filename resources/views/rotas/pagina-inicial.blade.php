@extends('layout')

@section('conteudo')


    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h2>Página Inicial</h2>

                @if (session()->has('message'))
                    <div class="alert alert-danger">
                        {{ session('message') }}
                    </div>
                @endif
                <form action="{{ route('busca') }}" method="post">
                    @csrf
                    <div class="d-flex justify-content-between align-item-center">
                        <input type="text" name="municipio" id="municipio" class="form-control" style="width: 70%"
                            placeholder="Digite o nome da cidade">
                        <button class="btn btn-block ml-3"
                            style="width: 30%;background-color: #BBD38B; color: #F7F6E7; font-size: 1.1rem; font-weight: bold">Enviar</button>
                    </div>
            </div>
            </form>



            @if (session('dadosPesquisa') !== null)
                @foreach (session('dadosPesquisa') as $dados)

                    <div class="col-4 mt-4 d-flex justify-content-between">
                        <div class="card" style="">
                            <img class="card-img-top h-50" src="{{ $dados['imagems'][0] }}" alt="Card image cap">

                            <div class="card-body">
                                <h5 class="card-title">Local: {{ $dados['local'] }}</h5>
                                <p class="card-text">
                                <h5>Preço: {{ $dados['preco'] }}</h5>
                                <strong>Descricão:{{ $dados['descricao'] }}</strong>
                                </p>
                                <a href="{{ $dados['paginaImovel'] }}" class="btn btn-block"
                                    style="background-color: #BBD38B; color: #F7F6E7; font-size: 1.1rem; font-weight: bold">Veja
                                    no site</a>
                            </div>
                        </div>
                    </div>


                @endforeach
            @endif
        </div>
    </div>


@endsection
