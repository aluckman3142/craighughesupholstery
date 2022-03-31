<!DOCTYPE html>
<html>
<head>
    <title>CraigHughesUpholstery.co.uk</title>
</head>
<body>
<table border-spacing="0" style="width: 100%; border: solid 1px #d4d4d4; font-family: 'Nunito', sans-serif;">
    <tr style="color:#FFF; background-color: #000;">
        <td style="text-align: center; padding: 20px">
            <img src="https://www.craighughesupholstery.co.uk/img/CraigHughesUpholstery-Logo.png" width="200px"/>
        </td>
    </tr>
    <tr style="color:#888; background-color: #d4d4d4;">
        <td style="text-align: center; padding: 40px">
            <h2 style="font-weight: lighter;">You have a new Upholstery Class Enquiry from the Craig Hughes Upholstery Website</h2>
            <img src="https://www.craighughesupholstery.co.uk/img/newmail.png" width="120px"/>
        </td>
    </tr>
    <tr style="color:#888; background-color: #FFF;">
        <td style="text-align: left; padding: 15px">
            <p style="font-weight: bold">Message From: {{ $details['name'] }} <span style="font-weight: lighter">({{ $details['email'] }})</span> </p>
            <h2 style="font-weight: normal;">{{ $details['subject'] }}</h2>
            <p>Project Description: {{ $details['project_description'] }}</p>
            <p>Dimensions: {{$details['width']}}w x {{$details['depth']}}d x {{$details['height']}}h</p>
            <p style="margin-bottom: 30px;"><img src="https://www.craighughesupholstery.co.uk/{{ $details['image'] }}"></p>
            <p>Days Required: {{ $details['days_required'] }}</p>
            <p>Requested Start Date: {{ $details['start_date'] }}</p>
            <p>Requested End Date: {{ $details['end_date'] }}</p>
        </td>
    </tr>
    <tr style="color:#888; background-color: #FFF;">
        <td style="text-align: left; padding: 15px">
            <a href="{{'https://www.craighughesupholstery.co.uk/dashboard'}}" target="_blank" style="text-decoration:none; margin-bottom: 30px; border:none; color:#FFF; padding: 15px; background-color: #0dcaf0;">Click here to view this enquiry</a>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>
</body>
</html>

