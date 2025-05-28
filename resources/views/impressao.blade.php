<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DESCARMED | Imprimir OS</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 15px;
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

        .table-itens, .table-itens td{
            border: 1px solid #000;
        }

        .table-itens td{
            padding: 4px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .table td {
            padding: 4px;
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
                <div style="margin-left: 5px; font-size: 15px; padding-top: 20px;" class="inline-block">
                    <h1 class="font-bold text-2xl">DESCARMED HOSPITALAR</h1>
                    <p>Rua Moacir Ferreira, 111 - Sala 03</p>
                    <p>Jardim das Palmeiras - Boituva/SP - 18550-097</p>
                    <p>50.293.429/0001-29</p>
                </div>
            </div>
            <div class="header-right" style="font-size: 15px; padding-top: 20px;">
                <p>(15) 99152-3995</p>
                <p>(15) 3363-1311</p>
                <p>suporte@descarmed.com.br</p>
            </div>
        </div>
    </header>
    <main>
        <h1 class="font-bold text-2xl uppercase" style="margin-top: 10px;">{{ $id }} -
            {{ $classificacao['descricao'] }}</h1>
        <hr>
        <table class="table">
            <tr style="column-span: 2;">
                <td><b>Cliente:</b> <span class="uppercase">{{ $cliente['nome'] }}</span></td>
                <td><b>Razão social:</b> <span class="uppercase">{{ $cliente['razao_social'] }}</span>
                </td>
            </tr>
            @if (isset($checkboxes['cnpj_cliente']))
                <tr>
                    <td><b>CNPJ:</b> <span class="uppercase">{{ $cliente['cnpj'] }}</span></td>
                </tr>
            @endif
            @if (isset($checkboxes['telefone_cliente']) || isset($checkboxes['email_cliente']))
                <tr>
                    @if (isset($checkboxes['telefone_cliente']))
                        <td><b>Telefone:</b> <span class="uppercase">{{ $cliente['telefone'] }}</span>
                        </td>
                    @endif
                    @if (isset($checkboxes['email_cliente']))
                        <td><b>Email:</b> <span>{{ $cliente['email'] }}</span></td>
                    @endif
                </tr>
            @endif
            @if (isset($checkboxes['endereco_cliente']))
                <tr>
                    <td><b>Logradouro:</b> <span class="uppercase">{{ $cliente['endereco']['logradouro'] }}</span></td>
                    <td><b>Número:</b> <span class="uppercase">{{ $cliente['endereco']['numero'] }}</span></td>
                    <td><b>Complemento:</b> <span class="uppercase">{{ $cliente['endereco']['complemento'] }}</span>
                    </td>
                </tr>
                <tr>
                    <td><b>Bairro:</b> <span class="uppercase">{{ $cliente['endereco']['bairro'] }}</span></td>
                    <td><b>Cidade:</b> <span
                            class="uppercase">{{ $cliente['endereco']['cidade'] }}-{{ $cliente['endereco']['estado'] }}</span>
                    </td>
                    <td><b>CEP:</b> <span class="uppercase">{{ $cliente['endereco']['cep'] }}</span>
                    </td>
                </tr>
            @endif
        </table>
        <hr>
        <table class="table">
            <tr>
                @if (isset($checkboxes['nome_equipamento']) && isset($equipamento))
                    <td><b>Equipamento:</b> <span class="uppercase">{{ $equipamento['nome'] }}</span></td>
                @endif
            </tr>
            <tr>
                @if (isset($checkboxes['id_equipamento']) && isset($equipamento))
                    <td><b>Cód. Descarmed:</b> <span class="uppercase">{{ $equipamento['id'] }}</span></td>
                @endif
                @if (isset($checkboxes['numero_serie']) && isset($equipamento))
                    <td><b>Nº de Série:</b> <span class="uppercase">{{ $equipamento['numero_serie'] }}</span></td>
                @endif
                @if (isset($checkboxes['numero_patrimonio']) && isset($equipamento))
                    <td><b>Nº de Patrimônio:</b> <span class="uppercase">{{ $equipamento['numero_patrimonio'] }}</span>
                    </td>
                @endif
            </tr>
            <tr>
                @if (isset($checkboxes['data_inicio']))
                    <td><b>Data de Início:</b> <span
                            class="uppercase">{{ date_format(date_create($data_inicio), 'd/m/Y') }}</span></td>
                @endif
                @if (isset($checkboxes['data_conclusao']) && isset($data_conclusao))
                    <td><b>Data de Conclusão:</b> <span
                            class="uppercase">{{ date_format(date_create($data_conclusao), 'd/m/Y') }}</span></td>
                @endif
            </tr>
            <tr>
                @if (isset($checkboxes['codigo_compra']) && isset($codigo_compra))
                    <td><b>Código de Compra:</b> <span class="uppercase">{{ $codigo_compra }}</span></td>
                @endif
                @if (isset($checkboxes['nota_fiscal']) && isset($nota_fiscal))
                    <td><b>Nota Fiscal:</b> <span class="uppercase">{{ $nota_fiscal }}</span></td>
                @endif
            </tr>
            <tr>
                <td><b>Serviço:</b> <span class="uppercase">{{ $titulo }}</span></td>
            </tr>
            @if (isset($checkboxes['descricao']))
                <tr>
                    <td>
                        <b>Descrição:</b>
                        <span class="uppercase">{{ $descricao }}</span>
                    </td>
                </tr>
            @endif

        </table>
        @if (isset($items) && isset($checkboxes['items']) && count($items) > 0)
            <hr>
            <table class="table-itens" style="width: 100%">
                <tr>
                    <td><b>Qtd.</b></td>
                    <td><b>Nome</b></td>
                    <td><b>Valor Un.</b></td>
                </tr>
                @foreach ($items as $item)
                    <tr>
                        <td>
                            {{ $item['quantidade'] }}
                        </td>
                        <td>
                            {{ $item['nome'] }}
                        </td>
                        <td>
                            R$ {{ number_format($item['valor_unitario'], 2, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
        @if (isset($preco) && isset($checkboxes['valor']) && $preco > 0)
            <hr>
            <table>
                <tr>
                    <td>
                        <b>VALOR TOTAL:</b>
                        <span class="uppercase">R$ {{ number_format($preco, 2, ',', '.') }}</span>
                    </td>
                </tr>
            </table>
        @endif
        <hr>
        <table class="table text-center" style="margin-top: 200px;">
            <tr>
                <td>__________________________</td>
            </tr>
            <tr>
                <td>TÉCNICO RESPONSÁVEL</td>
            </tr>
        </table>
    </main>
</body>

</html>
