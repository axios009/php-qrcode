<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\Output\QROutputInterface;

require 'vendor/autoload.php';

$app = new \Slim\App;

// Add Routing Middleware
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

// Define app routes
$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
  $name = $args['name'];
  $response->getBody()->write("Hello, $name");
  return $response;
});

$app->post('/generateQrCode', function (Request $request, Response $response, $args) {
  $data = $request->getParsedBody();
  $textToEncode = $data['text'] ?? 'Default Text';

  $options = new QROptions([
    'version' => 5,
    'outputType' => QROutputInterface::GDIMAGE_PNG,
    'eccLevel' => EccLevel::L,
  ]);


  $qrcode = new QRCode($options);
  $qrOutput = $qrcode->render($textToEncode);

  // Encode the image data to base64
  // $base64Image = base64_encode($qrOutput);

  // Format the response as JSON
  $response = $response->withHeader('Content-Type', 'application/json');
  $response->getBody()->write(json_encode(['qrCode' => $qrOutput]));

});


$app->run();
