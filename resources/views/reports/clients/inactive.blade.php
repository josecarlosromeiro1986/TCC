<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relação de Clientes Inativos</title>
    <style>
        #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
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
    <h3>Relação de Clientes Inativos</h3>
    <table id="customers">
        <thead>
          <tr>
            <th style="width: 50px;">código</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Data de Nascimento</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td style="text-align: center;">{{ $client->id }}</td>
                    <td>{{ $client->name }}</td>
                    <td style="text-align: center;">{{ $client->cpf }}</td>
                    <td style="text-align: center;">{{ date('d/m/Y', strtotime($client->birth)) }}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
</body>
</html>
