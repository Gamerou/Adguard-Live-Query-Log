<?php
class AdGuardAPI {
    private $baseURL;
    private $authHeader;

    public function __construct($baseURL) {
        $this->baseURL = $baseURL;
        $this->authHeader = 'Basic ' . base64_encode(getenv('AGH_USERNAME') . ':' . getenv('AGH_PASSWORD'));
    }

    public function getQueryLog($params) {
        $url = $this->baseURL . '/querylog?' . http_build_query($params);
        $headers = array('Content-Type: application/json', 'Authorization: ' . $this->authHeader);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
?>
