<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembrete de Ordens de Serviço</title>
    <style>
        /* Estilos otimizados com a paleta Preto, Vermelho e Branco */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            /* Fundo cinza claro para destacar o e-mail */
        }

        .email-container {
            max-width: 650px;
            margin: 20px auto;
            background-color: #ffffff;
            /* Fundo principal branco */
            border: 1px solid #dddddd;
        }

        .header {
            background-color: #ffffff;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #eeeeee;
        }

        .header img {
            max-width: 180px;
            height: auto;
        }

        .content {
            padding: 25px;
        }

        .greeting {
            font-size: 18px;
            color: #222222;
            /* Texto preto */
            margin-bottom: 20px;
        }

        .os-card {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 25px;
            overflow: hidden;
        }

        .os-header {
            background-color: #cc0000;
            /* Destaque em VERMELHO */
            color: #ffffff;
            /* Texto branco para contraste */
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
        }

        .os-body {
            padding: 20px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #222222;
            /* Título da seção em PRETO */
            margin-top: 20px;
            margin-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 5px;
        }

        .info-block p {
            margin: 5px 0;
            font-size: 15px;
            line-height: 1.6;
            color: #333333;
            /* Texto principal em cinza escuro */
        }

        .info-block strong {
            color: #000000;
            /* Rótulos em PRETO */
        }

        .items-list {
            list-style-type: disc;
            padding-left: 20px;
        }

        .items-list li {
            margin-bottom: 5px;
        }

        .actions {
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            /* Fundo levemente cinza para a área do botão */
        }

        .button {
            display: inline-block;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff !important;
            background-color: #dc3545;
            /* Botão em VERMELHO */
            text-decoration: none;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <img src="{{ public_path('img/logo.png') }}" alt="Logo Descarmed">
        </div>

        <div class="content">
            <p class="greeting">Olá! Estas são as suas Ordens de Serviço agendadas para amanhã,
                <strong>{{ now()->addDay()->format("d/m/Y") }}</strong>.</p>

            @forelse ($data as $os)
                <div class="os-card">
                    <div class="os-header">
                        #{{ $os->id }} - {{ $os->titulo }}
                    </div>
                    <div class="os-body">
                        <h4 class="section-title">Cliente</h4>
                        <div class="info-block">
                            <p><strong>Nome:</strong> {{ $os->cliente->nome }}</p>
                            <p><strong>Endereço:</strong> {{ $os->cliente->enderecoFormated }}</p>
                            <p><strong>Telefone:</strong> {{ $os->cliente->telefone }}</p>
                        </div>

                        @if (!empty($os->items) && count($os->items) > 0)
                            <h4 class="section-title">Itens / Tarefas</h4>
                            <div class="info-block">
                                <ul class="items-list">
                                    @foreach ($os->items as $item)
                                        <li>{{ $item->nome }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (!empty($os->equipamento) && $os->equipamento)
                            <h4 class="section-title">Equipamento</h4>
                            <div class="info-block">
                                <p><strong>ID:</strong> {{ $os->equipamento->id }}</p>
                                <p><strong>Nome:</strong> {{ $os->equipamento->nome }}</p>
                                <p><strong>Nº de Série:</strong> {{ $os->equipamento->numero_serie }}</p>
                                <p><strong>Nº de Patrimônio:</strong> {{ $os->equipamento->numero_patrimonio }}</p>
                            </div>
                        @endif
                        @if (!empty($os->descricao) && $os->descricao)
                        <div class="info-block">
                            <p><strong>Observações:</strong> {{ $os->descricao }}</p>
                        </div>
                        @endif
                    </div>
                    <div class="actions">
                        <a href="descarmed-os://ordem-servico/{{$os->id}}" class="button" target="_blank">Acessar OS no aplicativo</a>
                    </div>
                </div>
            @empty
                <p>Nenhuma Ordem de Serviço agendada para amanhã.</p>
            @endforelse
        </div>

        <div class="footer">
            <p>Este é um e-mail gerado automaticamente. Não responda.</p>
            <p>&copy; {{ date('Y') }} Descarmed</p>
        </div>
    </div>
</body>

</html>
