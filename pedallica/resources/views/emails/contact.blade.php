<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nieuw Contact Formulier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f97316;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f9fafb;
            padding: 30px;
            border: 1px solid #e5e7eb;
            border-top: none;
            border-radius: 0 0 8px 8px;
        }
        .field {
            margin-bottom: 20px;
        }
        .label {
            font-weight: bold;
            color: #374151;
            display: block;
            margin-bottom: 5px;
        }
        .value {
            color: #1f2937;
            padding: 10px;
            background-color: white;
            border-radius: 4px;
            border: 1px solid #d1d5db;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0;">Nieuw Contact Formulier</h1>
            <p style="margin: 10px 0 0 0;">Pedallica Website</p>
        </div>

        <div class="content">
            <div class="field">
                <span class="label">Naam:</span>
                <div class="value">{{ $contactData['name'] }}</div>
            </div>

            <div class="field">
                <span class="label">Email:</span>
                <div class="value">{{ $contactData['email'] }}</div>
            </div>

            <div class="field">
                <span class="label">Onderwerp:</span>
                <div class="value">{{ $contactData['subject'] }}</div>
            </div>

            <div class="field">
                <span class="label">Bericht:</span>
                <div class="value" style="white-space: pre-line;">{{ $contactData['message'] }}</div>
            </div>

            <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #d1d5db; color: #6b7280; font-size: 14px;">
                Je kan direct antwoorden op deze email om te reageren naar {{ $contactData['name'] }}.
            </p>
        </div>
    </div>
</body>
</html>
