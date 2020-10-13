<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório de Estoque</title>
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
    <h3>Relatório de Estoque</h3>
    @if ($amount == 1)
        <strong id="collab">Foi encontrado {{ $amount }} Patrimônio/Insumo, totalizando {{ $total }} Iten(s).</strong>
    @else
        <strong id="collab">Foram encontrados o total de {{ $amount }} Patrimônios/Insumos, totalizando {{ $total }} Iten(s).</strong>
    @endif
    <br />
    <br />
    <table id="customers">
        <thead>
          <tr>
            <th style="width: 80px;">Tipo</th>
            <th>Nome</th>
            <th style="width: 80px;">Qtd</th>
            <th>Local/Responsável</th>
            <th style="width: 80px;">Validade</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($equipments as $equipment)
                <tr>
                    <td style="width: 80px; text-align: center;">Patrimônio</td>
                    <td style="text-align: center;">{{ $equipment->name }}</td>
                    <td style="text-align: center;">1</td>
                    @if (is_null($equipment->collaborator))
                        <td style="text-align: center;">Em Estoque</td>
                    @else
                        <td style="text-align: center;">{{ $equipment->collaborator }}</td>
                    @endif
                    <td style="text-align: center; width: 80px;">Não Tem</td>
                </tr>
            @endforeach
            @foreach ($products as $product)
                <tr>
                    <td style="width: 80px; text-align: center;">Insumo</td>
                    <td style="text-align: center;">{{ $product->name }}</td>
                    <td style="text-align: center;">{{ $product->quantity }}</td>
                    <td style="text-align: center;">Em Estoque</td>
                    @if (is_null($product->due))
                        <td style="text-align: center; width: 80px;">Não Tem</td>
                    @else
                        <td style="text-align: center; width: 80px;">{{ date('d/m/Y', strtotime($product->due)) }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
      </table>
</body>
</html>
