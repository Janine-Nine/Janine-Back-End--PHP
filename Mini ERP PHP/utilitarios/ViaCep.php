<?php
class ViaCep {
    // Função para consultar CEP
}
<?php

namespace App\Helpers;

class ViaCep
{
    public static function buscar($cep)
    {
        $cep = preg_replace('/[^0-9]/', '', $cep);

        if (strlen($cep) !== 8) {
            return [
                'success' => false,
                'message' => 'CEP inválido.'
            ];
        }

        $url = "https://viacep.com.br/ws/{$cep}/json/";

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        if (isset($data['erro'])) {
            return [
                'success' => false,
                'message' => 'CEP não encontrado.'
            ];
        }

        return [
            'success' => true,
            'data' => [
                'cep' => $data['cep'] ?? null,
                'logradouro' => $data['logradouro'] ?? null,
                'bairro' => $data['bairro'] ?? null,
                'cidade' => $data['localidade'] ?? null,
                'estado' => $data['uf'] ?? null,
            ]
        ];
    }
}