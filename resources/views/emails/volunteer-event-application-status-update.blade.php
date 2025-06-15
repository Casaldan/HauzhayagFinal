<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Volunteer Application Status Update</title>
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
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .header.approved {
            background-color: #10B981;
        }
        .header.rejected {
            background-color: #EF4444;
        }
        .header.pending {
            background-color: #F59E0B;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 8px 8px;
        }
        .status-badge {
            padding: 15px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin: 20px 0;
            border-radius: 8px;
        }
        .status-badge.approved {
            background-color: #D1FAE5;
            color: #065F46;
            border: 2px solid #10B981;
        }
        .status-badge.rejected {
            background-color: #FEE2E2;
            color: #991B1B;
            border: 2px solid #EF4444;
        }
        .status-badge.pending {
            background-color: #FEF3C7;
            color: #92400E;
            border: 2px solid #F59E0B;
        }
        .tracking-code {
            background-color: #e8f4f8;
            border: 2px solid #2C5F6E;
            padding: 15px;
            text-align: center;
            font-size: 18px;
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
        .next-steps {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #10B981;
        }
    </style>
</head>
<body>
    <div class="header {{ $application->status }}">
        <h1>Application Status Update</h1>
    </div>
    
    <div class="content">
        <p>Dear {{ $application->full_name }},</p>
        
        <p>We have an update regarding your volunteer application for our event.</p>
        
        <div class="event-details">
            <h3>Event Details:</h3>
            <p><strong>Event:</strong> {{ $application->event->title }}</p>
            <p><strong>Date:</strong> {{ $application->event->start_date->format('F j, Y') }}</p>
            <p><strong>Location:</strong> {{ $application->event->location }}</p>
        </div>
        
        <div class="status-badge {{ $application->status }}">
            Application Status: {{ ucfirst($application->status) }}
        </div>
        
        @if($application->status === 'approved')
            <div class="next-steps">
                <h3>🎉 Congratulations!</h3>
                <p>Your volunteer application has been <strong>approved</strong>! We're excited to have you join our team for this event.</p>
                
                <p><strong>Next Steps:</strong></p>
                <ul>
                    <li>You will receive additional information about the event closer to the date</li>
                    <li>Please mark your calendar for {{ $application->event->start_date->format('F j, Y') }}</li>
                    <li>If you have any questions, please don't hesitate to contact us</li>
                </ul>
                
                <p>A volunteer account will be created for you. You can now log in to access volunteer resources and updates.</p>
            </div>
        @elseif($application->status === 'rejected')
            <div style="background-color: white; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #EF4444;">
                <h3>Application Update</h3>
                <p>Thank you for your interest in volunteering for our event. Unfortunately, we are unable to accept your application at this time.</p>
                
                @if($application->admin_notes)
                    <p><strong>Additional Information:</strong></p>
                    <p>{{ $application->admin_notes }}</p>
                @endif
                
                <p>We encourage you to apply for future volunteer opportunities. Thank you for your understanding and continued interest in our organization.</p>
            </div>
        @endif
        
        <p>Your tracking code for reference:</p>
        <div class="tracking-code">{{ $application->tracking_code }}</div>
        
        <p style="text-align: center;">
            <a href="{{ url('/volunteer/track?code=' . $application->tracking_code) }}" class="track-link">
                View Full Application Details
            </a>
        </p>
        
        <div class="footer">
            <p>Best regards,<br>
            <strong>Hauz Hayag Scholarship and Training Program Inc</strong></p>
            
            <p><em>This is an automated message. Please keep this email and your tracking code for your records.</em></p>
        </div>
    </div>
</body>
</html>
