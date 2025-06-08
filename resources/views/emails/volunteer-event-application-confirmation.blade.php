<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Volunteer Application Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #2C5F6E;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 8px 8px;
        }
        .tracking-code {
            background-color: #e8f4f8;
            border: 2px solid #2C5F6E;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #2C5F6E;
            margin: 20px 0;
            border-radius: 8px;
            letter-spacing: 2px;
        }
        .event-details {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #2C5F6E;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
        .track-link {
            display: inline-block;
            background-color: #2C5F6E;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Volunteer Application Confirmation</h1>
    </div>
    
    <div class="content">
        <p>Dear {{ $application->full_name }},</p>
        
        <p>Thank you for applying to volunteer for our event! We have received your application and it is currently being reviewed by our team.</p>
        
        <div class="event-details">
            <h3>Event Details:</h3>
            <p><strong>Event:</strong> {{ $application->event->title }}</p>
            <p><strong>Date:</strong> {{ $application->event->start_date->format('F j, Y') }}</p>
            <p><strong>Location:</strong> {{ $application->event->location }}</p>
        </div>
        
        <p>Your application tracking code is:</p>
        
        <div class="tracking-code">{{ $application->tracking_code }}</div>
        
        <p>You can use this code to check the status of your application at any time by visiting our website and entering this code in the tracking form.</p>
        
        <p style="text-align: center;">
            <a href="{{ url('/volunteer/track?code=' . $application->tracking_code) }}" class="track-link">
                Track Your Application Status
            </a>
        </p>
        
        <p><strong>Current Status:</strong> Pending Review</p>
        
        <p>We appreciate your interest in volunteering with us and will notify you of any updates to your application status via email.</p>
        
        <div class="footer">
            <p>Best regards,<br>
            <strong>The Hauz Hayag Team</strong></p>
            
            <p><em>Please keep this email and your tracking code for your records.</em></p>
        </div>
    </div>
</body>
</html>
