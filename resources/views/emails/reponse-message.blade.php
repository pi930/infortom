<p>Bonjour {{ $messageOriginal->name }},</p>

<p>{!! nl2br(e($reponse)) !!}</p>

<hr>
<p style="color:#888; font-size:12px;">
    <strong>Votre message initial :</strong><br>
    {!! nl2br(e($messageOriginal->message)) !!}
</p>
