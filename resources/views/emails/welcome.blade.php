Hello {{$user->name}}
Thank you for create an account. Plase verify your email using this link:
{{route('verify', $user->verification_token)}}
