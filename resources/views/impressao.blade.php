<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DESCARMED | IMPRIMIR OS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header-container {
            display: table;
            width: 100%;
        }

        .header-left,
        .header-right {
            display: table-cell;
            vertical-align: top;
        }

        .header-left {
            width: 70%;
        }

        .header-right {
            width: 30%;
            text-align: right;
        }

        .inline-block {
            display: inline-block;
            vertical-align: top;
        }

        .font-bold {
            font-weight: bold;
        }

        .text-2xl {
            font-size: 24px;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .text-center {
            text-align: center;
        }

        .w-32 {
            width: 128px;
        }

        .h-32 {
            height: 128px;
        }

        hr {
            border: none;
            border-top: 1px solid black;
            margin: 10px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table td {
            padding: 4px 8px;
            vertical-align: top;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-container">
            <div class="header-left">
                <div class="inline-block">
                    <img class="w-32 h-32" src="{{ public_path('img/logo.png') }}" alt="">
                </div>
                <div style="margin-left: 5px;" class="inline-block">
                    <h1 class="font-bold text-2xl">DESCARMED HOSPITALAR</h1>
                    <p>Rua Moacir Ferreira, 111 - Sala 03</p>
                    <p>Jardim das Palmeiras - Boituva/SP - 18550-097</p>
                </div>
            </div>
            <div class="header-right">
                <p>(15) 99152-3995</p>
                <p>(15) 3363-1311</p>
                <p>50.293.429/0001-29</p>
            </div>
        </div>
    </header>
    <main>
        <hr>
        <table class="table">
            <tr>
                <td><b>Cliente:</b> <span class="uppercase">{{ $cliente['nome'] }}</span></td>
                <td><b>Razão social:</b> <span class="uppercase">{{ $cliente['razao_social'] }}</span></td>
                <td><b>CNPJ:</b> <span class="uppercase">{{ $cliente['cnpj'] }}</span></td>
            </tr>
            <tr>
                <td><b>Logradouro:</b> <span class="uppercase">{{ $cliente['endereco']['logradouro'] }}</span></td>
                <td><b>Número:</b> <span class="uppercase">{{ $cliente['endereco']['numero'] }}</span></td>
                <td><b>Complemento:</b> <span class="uppercase">{{ $cliente['endereco']['complemento'] }}</span></td>
            </tr>
            <tr>
                <td><b>Bairro:</b> <span class="uppercase">{{ $cliente['endereco']['bairro'] }}</span></td>
                <td><b>Cidade:</b> <span
                        class="uppercase">{{ $cliente['endereco']['cidade'] }}-{{ $cliente['endereco']['estado'] }}</span>
                </td>
                <td><b>CEP:</b> <span class="uppercase">{{ $cliente['endereco']['cep'] }}</span></td>
            </tr>
        </table>
        <hr>
        <table class="table">
            <tr>
                <td><b>Serviço:</b> <span class="uppercase">{{ $titulo }}</span></td>
            </tr>
            <tr>
                <td><b>Data:</b> <span class="uppercase">{{ date_format(date_create($data), 'd/m/Y H:i') }}</span></td>
            </tr>
            <tr>
                <td>
                    <b>Descrição:</b>
                    <span class="uppercase">{{ $descricao }}</span>
                </td>
            </tr>
        </table>
        <hr>
        <table class="table text-center" style="margin-top: 200px;">
            <tr>
                <td>__________________________</td>
                <td>__________________________</td>
            </tr>
            <tr>
                <td>CLIENTE</td>
                <td>TÉCNICO RESPONSÁVEL</td>
            </tr>
        </table>
    </main>
</body>

</html>
