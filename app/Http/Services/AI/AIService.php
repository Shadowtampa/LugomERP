<?php

namespace App\Http\Services\AI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIService extends Controller
{

    public function createCampaing(Request $request)
    {
        $apiKey = env('GEMINI_KEY');

        // Extrair dados do request
        $productService = $request->input('product_service');
        $benefit = $request->input('benefit');
        $audience = $request->input('audience');
        $language = $request->input('language');
        $hashtags = $request->input('hashtags', ''); // Definindo um valor padrão vazio
        $uniqueAspect = $request->input('unique_aspect', '');

        // Formatar a requisição para o modelo
        $payload = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => "Crie um título simples e uma propaganda de até 280 caracteres para o Twitter que promova $productService, destacando $benefit, com uma chamada para ação clara e engajante, usando uma linguagem $language, voltada para $audience. Inclua até dois hashtags relevantes $hashtags e mencione um aspecto único (caso exista): $uniqueAspect. GERE UMA STRING NO MODELO {\"titulo\":\"<texto gerado>\",\"propaganda\":\"<texto gerado>\"} CONTENDO O TÍTULO E A PROPAGANDA."
                        ]
                    ]
                ]
            ]
        ];

        try {
            // Fazer a requisição HTTP para a API da Google
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", $payload);

            // Verificar se a resposta foi bem sucedida
            if ($response->successful()) {
                $data = $response->json();

                // Extrair o texto gerado pela AI
                $generatedText = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Nenhum texto gerado';

                $generatedTextClipped = substr($generatedText, 8, strlen($generatedText) - 12);

                // Decodificar JSON
                $json = json_decode($generatedTextClipped, true);

                // Recupera o título e a propaganda 
                $generatedTitle = $json['titulo'] ?? 'Título não gerado';
                $generatedPropaganda = $json['propaganda'] ?? 'Propaganda não gerada';


                return response()->json([
                    'message' => 'Campanha gerada com sucesso',
                    'generated_text' => $generatedPropaganda,
                    'generated_title' => $generatedTitle
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Falha ao gerar campanha',
                    'error' => $response->body()
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao fazer requisição',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
