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

        .table-itens,
        .table-itens td {
            border: 1px solid #000;
        }

        .table-itens td {
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

        .absolute-center {
            left: 50%;
        }

        .assinatura-container {
            width: 300px;
            height: 150px;
            text-align: center;
        }

        .assinatura-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
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
            @if (isset($checkboxes['cnpj_cliente']) && $checkboxes['cnpj_cliente'])
                <tr>
                    <td><b>CNPJ:</b> <span class="uppercase">{{ $cliente['cnpj'] }}</span></td>
                </tr>
            @endif
            @if (isset($checkboxes['telefone_cliente']) || isset($checkboxes['email_cliente']))
                <tr>
                    @if (isset($checkboxes['telefone_cliente']) && $checkboxes['telefone_cliente'])
                        <td><b>Telefone:</b> <span class="uppercase">{{ $cliente['telefone'] }}</span>
                        </td>
                    @endif
                    @if (isset($checkboxes['email_cliente']) && $checkboxes['email_cliente'])
                        <td><b>Email:</b> <span>{{ $cliente['email'] }}</span></td>
                    @endif
                </tr>
            @endif
            @if (isset($checkboxes['endereco_cliente']) && $checkboxes['endereco_cliente'])
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
            @if (isset($equipamento) && $equipamento)
                <tr>
                    @if (isset($checkboxes['nome_equipamento']) && $checkboxes['nome_equipamento'])
                        <td><b>Equipamento:</b> <span class="uppercase">{{ $equipamento['nome'] }}</span></td>
                    @endif
                </tr>
                <tr>
                    @if (isset($checkboxes['id_equipamento']) && $checkboxes['id_equipamento'])
                        <td><b>Cód. Descarmed:</b> <span class="uppercase">{{ $equipamento['id'] }}</span></td>
                    @endif
                    @if (isset($checkboxes['numero_serie']) && $checkboxes['numero_serie'])
                        <td><b>Nº de Série:</b> <span class="uppercase">{{ $equipamento['numero_serie'] }}</span></td>
                    @endif
                    @if (isset($checkboxes['numero_patrimonio']) && $checkboxes['numero_patrimonio'])
                        <td><b>Nº de Patrimônio:</b> <span
                                class="uppercase">{{ $equipamento['numero_patrimonio'] }}</span>
                        </td>
                    @endif
                </tr>
            @endif
            <tr>
                @if (isset($checkboxes['data_inicio']) && $checkboxes['data_inicio'])
                    <td><b>Data de Início:</b> <span
                            class="uppercase">{{ date_format(date_create($data_inicio), 'd/m/Y') }}</span></td>
                @endif
                @if (isset($checkboxes['data_conclusao']) && isset($data_conclusao) && $checkboxes['data_conclusao'])
                    <td><b>Data de Conclusão:</b> <span
                            class="uppercase">{{ date_format(date_create($data_conclusao), 'd/m/Y') }}</span></td>
                @endif
            </tr>
            <tr>
                @if (isset($checkboxes['codigo_compra']) && isset($codigo_compra) && $checkboxes['codigo_compra'])
                    <td><b>Código de Compra:</b> <span class="uppercase">{{ $codigo_compra }}</span></td>
                @endif
                @if (isset($checkboxes['nota_fiscal']) && isset($nota_fiscal) && $checkboxes['nota_fiscal'])
                    <td><b>Nota Fiscal:</b> <span class="uppercase">{{ $nota_fiscal }}</span></td>
                @endif
            </tr>
            <tr>
                <td><b>Serviço:</b> <span class="uppercase">{{ $titulo }}</span></td>
            </tr>
            @if (isset($checkboxes['descricao']) && $checkboxes['descricao'])
                <tr>
                    <td>
                        <b>Observação:</b>
                        <span class="uppercase">{{ $descricao }}</span>
                    </td>
                </tr>
            @endif

        </table>
        @if (isset($items) && isset($checkboxes['items']) && count($items) > 0 && $checkboxes['items'])
            <hr>
            <table class="table-itens" style="width: 100%">
                <tr>
                    <td><b>Qtd.</b></td>
                    <td><b>Und.</b></td>
                    <td><b>Nome</b></td>
                    @if (isset($valor_total) && isset($checkboxes['valor']) && $checkboxes['valor'])
                        <td><b>Valor Un.</b></td>
                    @endif
                </tr>
                @foreach ($items as $item)
                    <tr>
                        <td>
                            {{ $item['quantidade'] }}
                        </td>
                        <td>
                            {{ $item['unidade']['descricao'] ?? 'N/A' }}
                        </td>
                        <td>
                            {{ $item['nome'] }}
                        </td>
                        @if (isset($valor_total) && isset($checkboxes['valor']) && $valor_total > 0 && $checkboxes['valor'])
                            <td>
                                R$ {{ number_format($item['valor_unitario'], 2, ',', '.') }}
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>
        @endif
        @if (isset($valor_total) && isset($checkboxes['valor']) && $valor_total > 0 && $checkboxes['valor'])
            <hr>
            <table>
                <tr>
                    <td>
                        <b>VALOR TOTAL:</b>
                        <span class="uppercase">R$ {{ number_format($valor_total, 2, ',', '.') }}</span>
                    </td>
                </tr>
            </table>
        @endif
        <hr>
        <div style="position: relative; margin-top: 200px;">
            @php
                $temTecnico = isset($checkboxes['assinatura_tecnico']) && $checkboxes['assinatura_tecnico'];
                $temCliente = isset($checkboxes['assinatura_cliente']) && $checkboxes['assinatura_cliente'];
            @endphp

            @if ($temTecnico && $temCliente)
                {{-- Ambos: técnico à esquerda, cliente à direita --}}
                <div style="position: absolute; left: 10%; text-align:center;">
                    @if (isset($checkboxes['assinatura_tecnico_img']) && $checkboxes['assinatura_tecnico_img'])
                        <div class="assinatura-container">
                            <img src="{{ $checkboxes['assinatura_tecnico_img'] }}" alt="">
                        </div>
                    @endif
                    <p>_________________________________</p>
                    <p>TÉCNICO RESPONSÁVEL</p>
                </div>
                <div style="position: absolute; right: 10%; text-align:center;">
                    @if (isset($checkboxes['assinatura_cliente_img']) && $checkboxes['assinatura_cliente_img'])
                        <div class="assinatura-container">
                            <img src="{{ $checkboxes['assinatura_cliente_img'] }}" alt="">
                        </div>
                    @endif
                    <p>_________________________________</p>
                    <p>CLIENTE</p>
                </div>
            @elseif ($temTecnico)
                {{-- Só técnico: centralizado --}}
                <div style="text-align: center;">
                    @if (isset($checkboxes['assinatura_tecnico_img']) && $checkboxes['assinatura_tecnico_img'])
                        <div class="assinatura-container">
                            <img style="margin-left: 400px;" src="{{ $checkboxes['assinatura_tecnico_img'] }}" alt="">
                        </div>
                    @endif
                    <p>_________________________________</p>
                    <p>TÉCNICO RESPONSÁVEL</p>
                </div>
            @elseif ($temCliente)
                {{-- Só cliente: centralizado --}}
                <div style="text-align: center;">
                    @if (isset($checkboxes['assinatura_cliente_img']) && $checkboxes['assinatura_cliente_img'])
                        <div class="assinatura-container">
                            <img style="margin-left: 400px;" src="{{ $checkboxes['assinatura_cliente_img'] }}" alt="">
                        </div>
                    @endif
                    <p>_________________________________</p>
                    <p>CLIENTE</p>
                </div>
            @endif
        </div>

    </main>
</body>

</html>
