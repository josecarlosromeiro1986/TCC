<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório de todos Atendimentos por Tatuador</title>
    <style>
        #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            font-size: 13px;
            width: 350px;
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
    <h3>Relatório de todos Atendimentos Realizados por<br />{{ $title }}</h3>
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
            <th>Mês</th>
            <th>Ano</th>
            <th>Quantidade</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td style="text-align: center;">{{ utf8_encode(ucwords(strftime("%B", strtotime($attendance->date)))) }}</td>
                    <td style="text-align: center;">{{ date('Y', strtotime($attendance->date)) }}</td>
                    <td style="text-align: center;">{{ $attendance->attendances }}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
</body>
</html>
