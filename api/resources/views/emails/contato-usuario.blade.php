@extends('emails.layout')

@section('conteudo')

    <strong>Mensagem:</strong>

    <br>

    <div style="padding-left: 20px">
        {{ $mensagem }}
    </div>

    <br>

    <strong>Dados do Usuário:</strong>

    <br>
    
    <div style="padding-left: 20px">
        <span>
            <strong>Nome: </strong>{{ $usuario->name }}
        </span>
        <br>
        <span>
            <strong>Email: </strong>{{ $usuario->email }}
        </span>
        <br>

        @if($usuario->telefone)
            <span>
                <strong>Telefone: </strong>{{ $usuario->telefone->telefone }}
            </span>
            <br>
        @endif
        <span>
            <strong>Cadastrado em: </strong>{{ date('d/m/Y H:i:s', strtotime($usuario->created_at)) }}
        </span>
        <br>
    </div>
    
@endsection