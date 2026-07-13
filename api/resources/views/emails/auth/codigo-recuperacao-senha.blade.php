
@extends('emails.layout')

@section('conteudo')
    <div style="text-align: center">
        Olá, {{ $nomeUsuario }}!<br>
        Seu código de recuperação de senha é <strong>{{ $codigoRecuperacao }}</strong>
    </div>
@endsection