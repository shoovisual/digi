<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form Submission</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            background: linear-gradient(135deg, #EA6911 0%, #f57a28 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(255, 255, 255, 0.05) 10px,
                rgba(255, 255, 255, 0.05) 20px
            );
            animation: move 20s linear infinite;
        }

        @keyframes move {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }
            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .content {
            padding: 40px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .info-card {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 15px;
            padding: 25px;
            margin-top: 30px;
            border-left: 5px solid #EA6911;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .info-card h3 {
            color: #EA6911;
            font-size: 1.3rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-card p {
            color: #4a5568;
            line-height: 1.6;
            font-size: 1rem;
        }

        .message-section {
            background: linear-gradient(135deg, #fff5f5 0%, #fed7d7 100%);
            border-radius: 15px;
            padding: 30px;
            margin-top: 30px;
            border-left: 5px solid #e53e3e;
        }

        .message-section h3 {
            color: #e53e3e;
            font-size: 1.4rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .message-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #fed7d7;
            color: #2d3748;
            line-height: 1.7;
            font-size: 1rem;
            white-space: pre-wrap;
        }

        .footer {
            background: #2d3748;
            color: white;
            padding: 25px;
            text-align: center;
        }

        .footer p {
            margin-bottom: 10px;
            opacity: 0.9;
        }

        .icon {
            width: 20px;
            height: 20px;
            fill: currentColor;
        }

        .badge {
            display: inline-block;
            background: #EA6911;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-left: 10px;
        }

        @media (max-width: 600px) {
            .container {
                margin: 10px;
                border-radius: 15px;
            }

            .header h1 {
                font-size: 2rem;
            }

            .content {
                padding: 25px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎯 New Feedback Received</h1>
            <p>A customer has submitted feedback through your website</p>
        </div>

        <div class="content">
            <div class="info-grid">
                <div class="info-card">
                    <h3>
                        <svg class="icon" viewBox="0 0 20 20">
                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                        </svg>
                        Customer Information
                    </h3>
                    <p><strong>Name:</strong> {{ $data['name'] ?? 'Not provided' }}</p>
                    <p><strong>Email:</strong> {{ $data['email'] ?? 'Not provided' }}</p>
                    <p><strong>Client Status:</strong> {{ $data['is_client'] ?? 'Not specified' }}
                        @if(isset($data['is_client']) && $data['is_client'] === 'Yes')
                            <span class="badge">Existing Client</span>
                        @endif
                    </p>
                </div>

                @if(isset($data['product_model']) && !empty($data['product_model']))
                <div class="info-card">
                    <h3>
                        <svg class="icon" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                        Product Information
                    </h3>
                    <p><strong>Product Model:</strong> {{ $data['product_model'] }}</p>
                </div>
                @endif

                <div class="info-card">
                    <h3>
                        <svg class="icon" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                        Submission Details
                    </h3>
                    <p><strong>Form Type:</strong> Feedback Form</p>
                    <p><strong>Submitted:</strong> {{ now()->format('F j, Y \\a\\t g:i A') }}</p>
                    <p><strong>Source:</strong> DIGI Website</p>
                </div>
            </div>

            @if(isset($data['message']) && !empty($data['message']))
            <div class="message-section">
                <h3>
                    <svg class="icon" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                    </svg>
                    Customer Message
                </h3>
                <div class="message-content">
                    {{ $data['message'] }}
                </div>
            </div>
            @endif
        </div>

        <div class="footer">
            <p><strong>DIGI Customer Feedback System</strong></p>
            <p>This email was automatically generated from your website's feedback form.</p>
            <p style="font-size: 0.9rem; opacity: 0.7;">Please respond to the customer directly if a reply is needed.</p>
        </div>
    </div>
</body>
</html>
