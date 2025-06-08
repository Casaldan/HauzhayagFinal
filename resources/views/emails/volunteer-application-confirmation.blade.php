<h1>Volunteer Application Confirmation</h1>

<p>Dear {{ $application->full_name }},</p>

<p>Thank you for applying to volunteer for the event "{{ $application->event->title }}".</p>

<p>Your application has been received and is pending review by our administrators.</p>

<p>Your confirmation code is: <strong>{{ $application->confirmation_code }}</strong>. Please keep this code for your records.</p>

<p>We will notify you via email regarding the status of your application after it has been reviewed.</p>

<p>Sincerely,</p>
<p>The Hauz Hayag Team</p> 