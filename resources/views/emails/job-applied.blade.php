<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TheJobOpportunites Job Application</title>
</head>
<body>
    <p>There has been a new job application to your TheJobOpportunites listing</p>
   <p><strong>Job Title: </strong>{{$job->title}}</p>
   <p><strong>Application Details: </strong></p>
   <p><strong>Full Name:</strong> {{$application->full_name}}</p>
   <p><strong>Contact Phone:</strong> {{$application->contact_phone}}</p>
   <p><strong>Contact Email:</strong> {{$application->contact_email}}</p>
   <p><strong>Message:</strong> {{$application->message}}</p>
   <p><strong>Location:</strong> {{$application->location}}</p>
    <p>Login in to your TheJobOpportunites account to view the application</p>
</body>
</html>