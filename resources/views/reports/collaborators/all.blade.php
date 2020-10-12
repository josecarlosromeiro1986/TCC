<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório de Colaboradores</title>
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
    <h3>Relatório de Colaboradores</h3>
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
            <th style="width: 50px;">Ativo</th>
            <th>Nome</th>
            <th>Cargo</th>
            <th style="width: 100px;">Data de Início</th>
            <th style="width: 100px;">Data de Saída</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($collaborators as $collaborator)
                <tr>
                    @if ($collaborator->active == 'Y')
                        <td style="text-align: center;">Sim</td>
                    @else
                        <td style="text-align: center;">Não</td>
                    @endif
                    <td>{{ $collaborator->name }}</td>
                    <td style="text-align: center;">{{ $collaborator->description }}</td>
                    <td style="text-align: center;">{{ date('d/m/Y', strtotime($collaborator->start)) }}</td>
                    @if (!is_null($collaborator->exit))
                        <td style="text-align: center;">{{ date('d/m/Y', strtotime($collaborator->exit)) }}</td>
                    @else
                        <td style="text-align: center;">__/__/____</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
      </table>
</body>
</html>
