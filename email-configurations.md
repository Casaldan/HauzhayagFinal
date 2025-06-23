# Email Configuration Options

## Gmail SMTP (Current Setup)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=hauzhayag15@gmail.com
MAIL_PASSWORD=your_gmail_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hauzhayag15@gmail.com"
MAIL_FROM_NAME="Hauz Hayag Foundation"
```

## Outlook/Hotmail SMTP
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp-mail.outlook.com
MAIL_PORT=587
MAIL_USERNAME=your_email@outlook.com
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your_email@outlook.com"
MAIL_FROM_NAME="Hauz Hayag Foundation"
```

## Yahoo SMTP
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mail.yahoo.com
MAIL_PORT=587
MAIL_USERNAME=your_email@yahoo.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your_email@yahoo.com"
MAIL_FROM_NAME="Hauz Hayag Foundation"
```

## Mailtrap (For Testing)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="test@example.com"
MAIL_FROM_NAME="Hauz Hayag Foundation"
```

## SendGrid
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your_sendgrid_api_key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your_verified_email@domain.com"
MAIL_FROM_NAME="Hauz Hayag Foundation"
```

## Important Notes:
1. Always use App Passwords for Gmail (not your regular password)
2. Enable 2FA on your email account
3. Test email functionality after configuration
4. Check spam folders if emails don't arrive
5. For production, consider using dedicated email services like SendGrid, Mailgun, or Amazon SES
