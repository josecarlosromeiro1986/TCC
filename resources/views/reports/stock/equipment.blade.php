<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório de Patrimônio</title>
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

        #customers th td {
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
    <h3>Relatório de Patrimônio</h3>
    @if ($amount == 1)
        <strong id="collab">Foi encontrado {{ $amount }} Patrimônio.</strong>
    @else
        <strong id="collab">Foram encontrados o total de {{ $amount }} Patrimônios.</strong>
    @endif
    <br />
    <br />
    <table id="customers">
        <thead>
          <tr>
            <th style="width: 50px;">ID</th>
            <th>Nome</th>
            <th>Local/Responsável</th>
            <th>Descrição</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($equipments as $equipment)
                <tr>
                    <td style="width: 50px; text-align: center;">{{ $equipment->id }}</td>
                    <td style="text-align: center;">{{ $equipment->name }}</td>
                    @if (is_null($equipment->collaborator))
                        <td style="text-align: center;">Em Estoque</td>
                    @else
                        <td style="text-align: center;">{{ $equipment->collaborator }}</td>
                    @endif
                    <td>{{ $equipment->description }}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
</body>
</html>
