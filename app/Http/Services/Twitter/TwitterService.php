<?php

namespace App\Http\Services\Twitter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TwitterService extends Controller
{
    public function publishCampaing(Request $request)
    {
        // Validação para garantir que o campo 'text' está presente
        $request->validate([
            'text' => 'required|string',
        ]);

        // Captura o campo 'text' da requisição
        $text = $request->input('text');

        // Define a URL da API do Twitter
        $url = 'https://api.x.com/2/tweets';

        // Busca as credenciais do .env
        $consumerKey = env('TWITTER_CONSUMER_KEY');
        $consumerSecret = env('TWITTER_CONSUMER_SECRET');
        $accessToken = env('TWITTER_ACCESS_TOKEN');
        $accessSecret = env('TWITTER_ACCESS_SECRET');

        // Parâmetros de OAuth 1.0
        $oauth = [
            'oauth_consumer_key'     => $consumerKey,
            'oauth_token'            => $accessToken,
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp'        => time(),
            'oauth_nonce'            => uniqid(),
            'oauth_version'          => '1.0',
        ];

        // Cria a base string para a assinatura
        $baseString = $this->buildBaseString($url, 'POST', $oauth);
        $compositeKey = rawurlencode($consumerSecret) . '&' . rawurlencode($accessSecret);
        $oauth['oauth_signature'] = base64_encode(hash_hmac('sha1', $baseString, $compositeKey, true));

        // Cria o header OAuth
        $oauthHeader = $this->buildAuthorizationHeader($oauth);

        try {
            // Faz a requisição POST para a API do Twitter
            $response = Http::withHeaders([
                'Authorization' => $oauthHeader,
                'Content-Type' => 'application/json',
            ])->post($url, [
                'text' => $text,
            ]);

            // Verifica se a requisição foi bem-sucedida
            if ($response->successful()) {
                return response()->json([
                    'message' => 'Tweet publicado com sucesso',
                    'data' => $response->json(),
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Falha ao publicar o tweet',
                    'error' => $response->body(),
                ], $response->status());
            }
        } catch (\Exception $e) {
            // Trata possíveis exceções durante a requisição
            return response()->json([
                'message' => 'Ocorreu um erro ao tentar publicar o tweet',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Função auxiliar para construir a base string
    private function buildBaseString($baseURI, $method, $params)
    {
        $r = []; // Colocar os parâmetros em ordem alfabética
        ksort($params);
        foreach ($params as $key => $value) {
            $r[] = "$key=" . rawurlencode($value);
        }

        return $method . "&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
    }

    // Função auxiliar para criar o header de autorização OAuth
    private function buildAuthorizationHeader($oauth)
    {
        $r = 'OAuth ';
        $values = [];
        foreach ($oauth as $key => $value) {
            $values[] = "$key=\"" . rawurlencode($value) . "\"";
        }
        $r .= implode(', ', $values);
        return $r;
    }
}
