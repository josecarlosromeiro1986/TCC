<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório de Clientes</title>
    <style>
        #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            font-size: 11px;
            width: 100%;
        }

        #cli {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            font-size: 13px;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
        }

        h3 {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            text-align: center;
        }
    </style>
</head>
<body>
    <h3>Relatório de Clientes</h3>
    @if ($amount == 1)
        <strong id="cli">Foi encontrado o total de {{ $amount }} Cliente.</strong>
    @else
        <strong id="cli">Foram encontrados o total de {{ $amount }} Clientes</strong>
    @endif
    <br />
    <br />
    <table id="customers">
        <thead>
          <tr>
            <th style="width: 50px;">Ativo</th>
            <th style="width: 50px;">Código</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Data de Nascimento</th>
            <th>Atendimentos</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    @if ($client->active == 'Y')
                        <td style="text-align: center;">Sim</td>
                    @else
                        <td style="text-align: center;">Não</td>
                    @endif
                    <td style="text-align: center;">{{ $client->id }}</td>
                    <td>{{ $client->name }}</td>
                    <td style="text-align: center;">{{ $client->cpf }}</td>
                    <td style="text-align: center;">{{ date('d/m/Y', strtotime($client->birth)) }}</td>
                    <td style="text-align: center;">{{ $client->attendances }} Atendimentos</td>
                </tr>
            @endforeach
        </tbody>
      </table>
</body>
</html>
