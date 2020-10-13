<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório de Insumo</title>
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
    <h3>Relatório de Insumo</h3>
    @if ($amount == 1)
        <strong id="collab">Foi encontrado {{ $amount }} Insumo, totalizando {{ $total }} iten(s).</strong>
    @else
        <strong id="collab">Foram encontrados o total de {{ $amount }} Insumos, totalizando {{ $total }} iten(s).</strong>
    @endif
    <br />
    <br />
    <table id="customers">
        <thead>
          <tr>
            <th style="width: 50px;">ID</th>
            <th>Nome</th>
            <th style="width: 50px;">Total</th>
            <th style="width: 80%;">Validade</th>
            <th>Descrição</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td style="width: 50px; text-align: center;">{{ $product->id }}</td>
                    <td style="text-align: center;">{{ $product->name }}</td>
                    <td style="width: 50px; text-align: center;">{{ $product->quantity }}</td>
                    @if (is_null($product->due))
                        <td style="text-align: center; width: 80px;">Não Tem</td>
                    @else
                        <td style="text-align: center; width: 80px;">{{ date('d/m/Y', strtotime($product->due)) }}</td>
                    @endif
                    <td>{{ $product->description }}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
</body>
</html>
