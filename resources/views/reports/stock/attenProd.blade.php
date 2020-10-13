<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório de Insumo por Atendimento</title>
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

        h5 {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        }

    </style>
</head>
<body>
    <h3>Relatório de Insumo por Atendimento</h3>
    @foreach ($results as $result)
        <h5>Atendimento Nº: {{ $result['att'] }}<br />Tatuador: {{ $result['coll'] }}</h5>
        <table id="customers">
            <thead>
            <tr>
                <th style="width: 10%;">ID</th>
                <th style="width: 35%;">Nome</th>
                <th style="width: 15%;">Quantidade</th>
                <th style="width: 40%;">Descrição</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($result['prod'] as $product)
                    <tr>
                        <td style="width: 10%; text-align: center;">{{ $product->product_id }}</td>
                        <td style="width: 35%; text-align: center;">{{ $product->name }}</td>
                        <td style="width: 15%; text-align: center;">{{ $product->quantity_product }}</td>
                        <td style="width: 40%;">{{ $product->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br />
        <hr size="1" style="border:1px dashed #9b9b9b;">
    @endforeach
</body>
</html>
