<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP for Registration</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f7fa; padding: 20px; margin: 0;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h2 style="color: #333; text-align: center;">Email Verification</h2>
        <p style="font-size: 1.1em; color: #555;">Dear User,</p>
        <p style="font-size: 1em; color: #555; line-height: 1.5;">
            Your OTP for registration is:
            <strong style="font-size: 1.2em; color: #3498db;">{{ $otp }}</strong>
        </p>
        <p style="font-size: 1em; color: #555; line-height: 1.5;">
            Please enter this code in the OTP verification form to complete your registration. This code will expire shortly for security purposes.
        </p>
        <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">
        <p style="font-size: 0.9em; color: #999; text-align: center;">
            If you did not request this OTP, please ignore this email or contact support if you have any concerns.
        </p>
        <p style="font-size: 0.9em; color: #999; text-align: center;">
            Thank you,<br>
            The Team
        </p>
    </div>
</body>
</html>
