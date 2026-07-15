<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $titulo ?? 'Mútua' }}</title>
</head>

<body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;">

    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
        style="background:#f4f6f9;padding:30px 15px;">
        <tr>
            <td align="center">

                <table role="presentation" cellpadding="0" cellspacing="0" width="600"
                    style="max-width:600px;width:100%;background:#ffffff;border-radius:8px;overflow:hidden;">

                    <tr>
                        <td style="background:#1a1a1a;padding:24px;text-align:center;">
                            {{-- <h1 style="margin:0;color:#ffffff;font-size:28px;font-weight:bold;">
                                Mútua
                            </h1> --}}

                            <img src="{{ $message->embed(public_path('img/logo-mutua.png')) }}" alt="Mútua" width="180">

                            <p style="margin:8px 0 0;color:#e8f1ff;font-size:14px;">
                                Plataforma de apoio comunitário
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:30px;color:#333333;font-size:15px;line-height:1.7;">

                            @yield('conteudo')

                        </td>
                    </tr>

                    <tr>
                        <td
                            style="padding:20px;background:#fafafa;border-top:1px solid #eeeeee;text-align:center;color:#777777;font-size:12px;line-height:1.6;">

                            Esta é uma mensagem automática enviada pelo sistema Mútua.<br>

                            Caso não reconheça esta comunicação, desconsidere este e-mail.

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>