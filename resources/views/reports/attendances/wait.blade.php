<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relação de todos Atendimentos</title>
    <style>
        #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            font-size: 11px;
            width: 100%;
        }

        #attendances {
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
            font-size: 13px;
            text-align: center;
        }

        h3 {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            text-align: center;
        }
    </style>
</head>
<body>
    <h3>Relatório de Atendimentos em Espera<br />do dia {{ $date }}</h3>
    @if ($amount == 1)
        <strong id="attendances">Foi encontrado o total de {{ $amount }} atendimento.</strong>
    @else
        <strong id="attendances">Foram encontrados o total de {{ $amount }} atendimentos</strong>
    @endif
    <br />
    <br />
    <table id="customers">
        <thead>
          <tr>
            <th style="width: 50px;">Nº</th>
            <th>Tatuador</th>
            <th>Cliente</th>
            <th style="width: 100px;">Data de Início</th>
            <th style="width: 100px;">Data de Fim</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td style="text-align: center;">{{ $attendance->id }}</td>
                    <td>{{ $attendance->collaborator }}</td>
                    <td>{{ $attendance->client }}</td>
                    <td style="text-align: center;">{{ date('d/m/Y H:m:s', strtotime($attendance->start)) }}</td>
                    <td style="text-align: center;">{{ date('d/m/Y H:m:s', strtotime($attendance->end)) }}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
</body>
</html>
