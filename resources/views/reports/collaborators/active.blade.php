<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório de Colaboradores Ativos</title>
    <style>
        #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            font-size: 11px;
            width: 100%;
        }

        #collab {
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
    <h3>Relatório de Colaboradores Ativos</h3>
    @if ($amount == 1)
        <strong id="collab">Foi encontrado o total de {{ $amount }} Colaborador.</strong>
    @else
        <strong id="collab">Foram encontrados o total de {{ $amount }} Colaboradores</strong>
    @endif
    <br />
    <br />
    <table id="customers">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Cargo</th>
            <th style="width: 100px;">Data de Início</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($collaborators as $collaborator)
                <tr>
                    <td>{{ $collaborator->name }}</td>
                    <td style="text-align: center;">{{ $collaborator->description }}</td>
                    <td style="text-align: center;">{{ date('d/m/Y', strtotime($collaborator->start)) }}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
</body>
</html>
