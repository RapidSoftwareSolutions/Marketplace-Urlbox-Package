<?php

$app->post('/api/Urlbox/getScreenshot', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey','apiSecret','format','url']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $apiKey = $post_data['args']['apiKey'];
    $apiSecret = $post_data['args']['apiSecret'];
    $format = $post_data['args']['format'];
    $options['url'] = $post_data['args']['url'];

    $optionalParam = ['width'=>'width', 'height'=>'height','selector'=>'selector','thumbWidth'=>'thumbWidth','userAgent'=>'user_agent','acceptLang'=>'accept_lang','authorization'=>'authorization','cookie'=>'cookie','delay'=>'delay','waitFor'=>'wait_for','timeout'=>'timeout','fullPage'=>'full_page','flash'=>'flash','force'=>'force','ttl'=>'ttl','quality'=>'quality','disableJs'=>'disable_js','retina'=>'retina','transparent'=>'transparent','click'=>'click','hover'=>'hover','bgColor'=>'bg_color','cropWidth'=>'crop_width','hideSelector'=>'hide_selector','highlight'=>'highlight','highlightfg'=>'highlightfg','highlightbg'=>'highlightbg','useS3'=>'use_s3','s3Path'=>'s3_path'];

    foreach ($post_data['args'] as $key=>$value)
    {
        if(array_key_exists($key, $optionalParam))
        {
            $options[$optionalParam[$key]] = $value;
        }
    }
    $query = http_build_query($options);

    $token = hash_hmac("sha1", $query,$apiSecret);

    $query_str = $settings['api_url'] . "$apiKey/$token/$format?$query";
    $client = $this->httpClient;

    try {

        $resp = $client->get($query_str);
        $responseBody = $resp->getBody();

        if ($resp->getStatusCode() == 200) {
            $size = $resp->getHeader('Content-Length')[0];

            $uploadServiceResponse = $client->post($settings['uploadServiceUrl'], [
                'multipart' => [
                    [
                        'name' => 'length',
                        'contents' => $size
                    ],
                    [
                        "name" => "file",
                        "filename" => md5($options['url']).".$format",
                        "contents" => $responseBody
                    ]
                ]
            ]);
            $uploadServiceResponseBody = $uploadServiceResponse->getBody()->getContents();
            if ($uploadServiceResponse->getStatusCode() == 200) {
                $result['callback'] = 'success';
                $result['contextWrites']['to'] = json_decode($uploadServiceResponse->getBody());
            }
            else {
                $result['callback'] = 'error';
                $result['contextWrites']['to']['status_code'] = 'API_ERROR';
                $result['contextWrites']['to']['status_msg'] = is_array($uploadServiceResponseBody) ? $uploadServiceResponseBody : json_decode($uploadServiceResponseBody);
            }
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
        }
    } catch (\GuzzleHttp\Exception\BadResponseException $exception) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = json_decode($exception->getResponse()->getBody());
    }
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});