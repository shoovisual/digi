<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
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
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .header h2 {
            font-size: 2.2em;
            font-weight: 300;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .header p {
            opacity: 0.9;
            font-size: 1.1em;
            position: relative;
            z-index: 1;
        }

        .content {
            padding: 40px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .form-section {
            background: #f8fafc;
            border-radius: 15px;
            padding: 25px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .form-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            color: #EA6911;
            font-size: 1.3em;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title::before {
            content: '';
            width: 4px;
            height: 20px;
            background: linear-gradient(135deg, #EA6911, #fd7d28);
            border-radius: 2px;
        }

        .field-group {
            margin-bottom: 20px;
        }

        .field-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 0.95em;
        }

        .field-value {
            background: white;
            padding: 12px 16px;
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            color: #1f2937;
            font-size: 1em;
            line-height: 1.5;
            min-height: 45px;
            display: flex;
            align-items: center;
            transition: border-color 0.3s ease;
        }

        .field-value:hover {
            border-color: #EA6911;
        }

        .warranty-badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.9em;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .warranty-yes {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .warranty-no {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .message-section {
            grid-column: 1 / -1;
        }

        .message-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            min-height: 120px;
            line-height: 1.6;
            white-space: pre-wrap;
            color: #374151;
        }

        .contact-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .footer {
            background: #f1f5f9;
            padding: 20px 40px;
            text-align: center;
            color: #64748b;
            font-size: 0.9em;
            border-top: 1px solid #e2e8f0;
        }

        @media (max-width: 528px) {
            .content {
                padding: 20px;
            }

            .form-grid {
                grid-template-columns: 2fr;
                gap: 20px;
            }

            .header {
                padding: 20px;
            }

            .header h2 {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Contact Form Submission</h2>
            <p>Customer inquiry received and processed</p>
        </div>

        <div class="content">
            <div class="form-grid">
                <div class="form-section">
                    <div class="section-title">Contact Information</div>
                    <div class="contact-info">
                        <div class="field-group">
                            <label class="field-label">Full Name</label>
                            <div class="field-value">{{ $data['name'] }}</div>
                        </div>
                        <div class="field-group">
                            <label class="field-label">Phone Number</label>
                            <div class="field-value">{{ $data['phone'] }}</div>
                        </div>
                        <div class="field-group">
                            <label class="field-label">Email Address</label>
                            <div class="field-value">{{ $data['email'] }}</div>
                        </div>
                        <div class="field-group">
                            <label class="field-label">Country</label>
                            <div class="field-value">{{ $data['country'] }}</div>
                        </div>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Address</label>
                        <div class="field-value">{{ $data['address'] }}</div>
                    </div>
                </div>

                <div class="form-section" style="margin-top: 30px">
                    <div class="section-title">Product Details</div>
                    <div class="field-group">
                        <label class="field-label">Inquiry Reason</label>
                        <div class="field-value">{{ $data['reason'] }}</div>
                    </div>
                    @if(isset($data['is_under_warranty']))
                    <div class="field-group">
                        <label class="field-label">Warranty Status</label>
                        <div class="field-value">
                            <span class="warranty-badge {{ $data['is_under_warranty'] === 'Yes' ? 'warranty-yes' : 'warranty-no' }}">
                                {{ $data['is_under_warranty'] === 'Yes' ? '✓ Under Warranty' : '✗ Not Under Warranty' }}
                            </span>
                        </div>
                    </div>
                    @endif
                    <div class="field-group">
                        <label class="field-label">Product Type ID</label>
                        <div class="field-value">{{ $data['product_type'] }}</div>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Product Model ID</label>
                        <div class="field-value">{{ $data['product_model'] }}</div>
                    </div>
                </div>

                <div class="form-section message-section" style="margin-top: 30px">
                    <div class="section-title">Customer Message</div>
                    <div class="message-content">{{ $data['message'] }}</div>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>Form submitted on {{ date('F j, Y \a\t g:i A') }} • Please respond within 24 hours</p>
        </div>
    </div>
</body>
</html>
