<p>Bonjour {{ $devis->client_name }},</p>

<p>Voici les informations de configuration de votre service :</p>

<pre>
{{ print_r($data, true) }}
</pre>

<p>Cordialement,<br>L'équipe Infortom</p>

