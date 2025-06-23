<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Application Status Update</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8fafc;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        .content {
            padding: 30px;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            margin: 10px 0;
        }
        .status-approved {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .status-declined {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }
        .next-steps {
            background-color: #f8f9ff;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }
        .next-steps h3 {
            margin-top: 0;
            color: #667eea;
        }
        .next-steps ul {
            padding-left: 20px;
        }
        .next-steps li {
            margin: 8px 0;
        }
        .tracking-code {
            background-color: #f1f5f9;
            padding: 15px;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            border: 2px dashed #cbd5e0;
            color: #2d3748;
        }
        .track-link {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 10px 0;
            transition: transform 0.2s;
        }
        .track-link:hover {
            transform: translateY(-2px);
        }
        .footer {
            background-color: #f8fafc;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            color: #64748b;
        }
        .footer p {
            margin: 5px 0;
        }
        .application-details {
            background-color: #f8f9ff;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .application-details h3 {
            margin-top: 0;
            color: #4a5568;
        }
        .application-details p {
            margin: 8px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📚 Scholarship Application Update</h1>
            <p>Hauz Hayag Foundation</p>
        </div>
        
        <div class="content">
            <p>Dear {{ $application->full_name }},</p>
            
            <p>We have an important update regarding your scholarship application.</p>
            
            <div class="application-details">
                <h3>Application Details:</h3>
                <p><strong>Scholarship Type:</strong> {{ ucfirst(str_replace('_', ' ', $application->scholarship_type)) }}</p>
                <p><strong>Application Date:</strong> {{ $application->created_at->format('F j, Y') }}</p>
                <p><strong>Current Status:</strong> 
                    <span class="status-badge status-{{ $application->status }}">
                        {{ ucfirst($application->status) }}
                    </span>
                </p>
            </div>
            
            @if($application->status === 'approved')
                <div class="next-steps">
                    <h3>🎉 Congratulations!</h3>
                    <p>Your scholarship application has been <strong>approved</strong>! We're excited to support your educational journey.</p>

                    @if($user && $temporaryPassword)
                        <div style="background-color: #fef3c7; border: 2px solid #f59e0b; border-radius: 8px; padding: 20px; margin: 20px 0;">
                            <h4 style="color: #92400e; margin-top: 0;">🔐 Student Portal Access</h4>
                            <p style="color: #92400e; margin-bottom: 15px;">A student account has been created for you! Here are your login credentials:</p>

                            <div style="background-color: white; padding: 15px; border-radius: 6px; margin: 15px 0;">
                                <p style="margin: 5px 0;"><strong>Email:</strong> {{ $application->email }}</p>
                                <p style="margin: 5px 0;"><strong>Temporary Password:</strong> <span style="font-family: monospace; font-size: 16px; font-weight: bold; color: #1f2937;">{{ $temporaryPassword }}</span></p>
                            </div>

                            <p style="color: #92400e; font-size: 14px; margin-bottom: 0;">
                                ⚠️ <strong>Important:</strong> Please change your password after your first login for security purposes.
                            </p>
                        </div>

                        <div style="background-color: #dbeafe; border: 2px solid #3b82f6; border-radius: 8px; padding: 20px; margin: 20px 0;">
                            <h4 style="color: #1e40af; margin-top: 0;">📚 How to Access Your Student Dashboard</h4>
                            <ol style="color: #1e40af; padding-left: 20px;">
                                <li>Visit our website and click on "Student Login"</li>
                                <li>Enter your email: <strong>{{ $application->email }}</strong></li>
                                <li>Enter your temporary password: <strong>{{ $temporaryPassword }}</strong></li>
                                <li>Once logged in, click on "View Profile" to change your password</li>
                                <li>Explore your student dashboard to access events, job listings, and more!</li>
                            </ol>
                        </div>
                    @endif

                    <p><strong>Next Steps:</strong></p>
                    <ul>
                        <li>Log in to your student portal using the credentials above</li>
                        <li>Complete your profile information</li>
                        <li>Change your temporary password for security</li>
                        <li>Explore available events and job opportunities</li>
                        <li>You will receive additional information about scholarship benefits and requirements</li>
                        <li>Please keep this email and your tracking code for your records</li>
                        <li>If you have any questions, please don't hesitate to contact us</li>
                    </ul>

                    <p><strong>Important:</strong> Please log in to your student portal to access scholarship resources and updates.</p>
                </div>
            @elseif($application->status === 'declined')
                <div style="background-color: white; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #EF4444;">
                    <h3>Application Update</h3>
                    <p>Thank you for your interest in our scholarship program. Unfortunately, we are unable to approve your application at this time.</p>
                    
                    <p>This decision was made after careful consideration of all applications. We encourage you to:</p>
                    <ul>
                        <li>Continue pursuing your educational goals</li>
                        <li>Apply for future scholarship opportunities</li>
                        <li>Explore other financial aid options available to you</li>
                    </ul>
                    
                    <p>Thank you for your understanding and continued interest in the Hauz Hayag Scholarship and Training Program Inc</p>
                </div>
            @endif
            
            <p>Your tracking code for reference:</p>
            <div class="tracking-code">{{ $application->tracking_code }}</div>
            
            <p style="text-align: center;">
                <a href="{{ url('/scholarship/track/' . $application->tracking_code) }}" class="track-link">
                    View Full Application Details
                </a>
            </p>
            
            <div class="footer">
                <p>Best regards,<br>
                <strong>Hauz Hayag Scholarship and Training Program Inc</strong></p>
                
                <p><em>This is an automated message. Please keep this email and your tracking code for your records.</em></p>
            </div>
        </div>
    </div>
</body>
</html>
