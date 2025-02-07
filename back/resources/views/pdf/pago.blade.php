<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #000;
            border-radius: 5px;
            position: relative;
            overflow: hidden;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 80px;
            height: auto;
        }
        .header h2 {
            margin: 5px 0;
        }
        .details, .payment-info {
            width: 100%;
            border-collapse: collapse;
        }
        .details td, .payment-info td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .details td:first-child, .payment-info td:first-child {
            font-weight: bold;
            background: #f0f0f0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
            color: gray;
        }
        /* Marca de agua ANULADO */
        .watermark {
            position: absolute;
            top: 30%;
            left: 10%;
            width: 80%;
            font-size: 60px;
            font-weight: bold;
            color: red;
            opacity: 0.2;
            transform: rotate(-30deg);
            text-align: center;
            z-index: -1;
        }
    </style>
</head>
<body>

<div class="container">
    @if($pago->estado == 'Anulado')
        <div class="watermark">ANULADO</div>
    @endif

    <div class="header">
        <img src="{{ public_path('logo.png') }}" alt="Logo">
        <h2>Recibo de Pago</h2>
        <p><strong>Fecha:</strong> {{ $pago->fecha_pago }} - <strong>Hora:</strong> {{ $pago->hora_pago }}</p>
    </div>

    <table class="details">
        <tr>
            <td>Nombre</td>
            <td>{{ $pago->user->name }}</td>
        </tr>
        <tr>
            <td>Gestión</td>
            <td>{{ $pago->user->gestion }}</td>
        </tr>
        <tr>
            <td>Bloque</td>
            <td>{{ $pago->user->bloque }}</td>
        </tr>
        <tr>
            <td>Código</td>
            <td>{{ $pago->user->codigo }}</td>
        </tr>
    </table>

    <h3>Detalles del Pago</h3>
    <table class="payment-info">
        <tr>
            <td>Concepto</td>
            <td>{{ $pago->descripcion }}</td>
        </tr>
        <tr>
            <td>Monto</td>
            <td><strong>Bs {{ number_format($pago->monto, 2) }}</strong></td>
        </tr>
        <tr>
            <td>Estado</td>
            <td>{{ $pago->estado }}</td>
        </tr>
    </table>

    <div style="margin-top: 30px; text-align: center;">
        <p>_____________________________</p>
        <p>Firma del Responsable</p>
    </div>
</div>

<div class="footer">
    <p>Este es un documento generado automáticamente. No requiere firma física.</p>
</div>

</body>
</html>
