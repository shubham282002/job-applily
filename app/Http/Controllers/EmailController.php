<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use App\Models\SentEmail;
use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Gmail;


class EmailController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'template_id' => 'required|exists:email_templates,id',
            'hr_email' => 'required|email',
            'subject' => 'required|string|max:255',
        ]);

        try {
            $user = auth()->user();
            $template = EmailTemplate::find($validated['template_id']);

            // Check if Gmail connected
            if (!$user->gmail_connected) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please connect Gmail first!'
                ], 400);
            }

            // Get valid access token
            $accessToken = $user->getValidAccessToken();

            if (!$accessToken) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to refresh Gmail token. Please reconnect.'
                ], 400);
            }

            // Create Google Client
            $client = new Client();
            $client->setClientId(config('services.google.client_id'));
            $client->setClientSecret(config('services.google.client_secret'));
            $client->setAccessToken($accessToken);

            // Create Gmail service
            $service = new Gmail($client);

            // Prepare email
            $message = new \Google\Service\Gmail\Message();

            $rawMessage = "From: {$user->name} <{$user->google_email}>\r\n";
            $rawMessage .= "To: {$validated['hr_email']}\r\n";
            $rawMessage .= "Subject: {$validated['subject']}\r\n";
            $rawMessage .= "MIME-Version: 1.0\r\n";
            $rawMessage .= "Content-Type: text/html; charset=UTF-8\r\n\r\n";
            $rawMessage .= $template->html_content;

            $message->setRaw(rtrim(strtr(base64_encode($rawMessage), '+/', '-_'), '='));

            // Send email
            $service->users_messages->send('me', $message);

            // Save record
            SentEmail::create([
                'user_id' => $user->id,
                'email_template_id' => $validated['template_id'],
                'hr_email' => $validated['hr_email'],
                'subject' => $validated['subject'],
                'status' => 'sent',
                'sent_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Email sent successfully!'
            ]);

        } catch (\Exception $e) {
            // Save failed record
            SentEmail::create([
                'user_id' => auth()->id(),
                'email_template_id' => $validated['template_id'],
                'hr_email' => $validated['hr_email'],
                'subject' => $validated['subject'],
                'status' => 'failed',
                'error_message' => $e->getMessage(),
                'sent_at' => now(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to send email: ' . $e->getMessage()
            ], 500);
        }
    }
}
