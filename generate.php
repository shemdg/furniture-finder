<?php

// uy philippinesss
date_default_timezone_set('Asia/Manila');

// get form data
$furniture_type = $_POST['furniture_type'] ?? '';
$budget = $_POST['budget'] ?? '';
$style = $_POST['style'] ?? '';

// empty validate inputs
if (empty($furniture_type) || empty($budget) || empty($style)) {
    header('Location: index.php');
    exit();
}

$n8n_webhook_url = 'https://shanlu.app.n8n.cloud/webhook/furniture-ai';

// prepare data to send to n8n
$data = array(
        'furniture_type' => $furniture_type,
        'budget' => $budget,
        'style' => $style,
        'timestamp' => date('Y-m-d H:i:s')
);

// initialize curl
$ch = curl_init($n8n_webhook_url);

// set curl options
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen(json_encode($data))
));
curl_setopt($ch, CURLOPT_TIMEOUT, 60); // 60 second timeout

// execute request
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_error = curl_error($ch);
curl_close($ch);

// handle errors
if ($curl_error) {
    die('<html><body style="font-family: Arial; padding: 40px; text-align: center;">
    <h2>⚠️ Connection Error</h2>
    <p>Could not connect to AI service. Please try again.</p>
    <p><a href="index.php" style="color: #667eea;">Go Back</a></p>
    <p style="color: #999; font-size: 12px;">Error: ' . htmlspecialchars($curl_error) . '</p>
    </body></html>');
}

if ($http_code !== 200) {
    die('<html><body style="font-family: Arial; padding: 40px; text-align: center;">
    <h2>⚠️ Service Error</h2>
    <p>AI service returned an error (HTTP ' . $http_code . '). Please try again.</p>
    <p><a href="index.php" style="color: #667eea;">Go Back</a></p>
    </body></html>');
}

// decode response
$ai_response = json_decode($response, true);

// debug: show raw response if json parsing fails
if ($ai_response === null) {
    die('<html><body style="font-family: Arial; padding: 40px;">
    <h2>⚠️ Response Parsing Error</h2>
    <p>Could not parse AI response. Raw response:</p>
    <pre style="background: #f5f5f5; padding: 20px; overflow: auto;">' . htmlspecialchars($response) . '</pre>
    <p><a href="index.php" style="color: #667eea;">Go Back</a></p>
    </body></html>');
}

// Extract generated content
// Handle if response is wrapped in an array (common with n8n)
if (isset($ai_response[0])) {
    $ai_response = $ai_response[0];
}

$page_title = $ai_response['title'] ?? '';
$description = $ai_response['description'] ?? '';
$products = $ai_response['products'] ?? array();
$generated_html = $ai_response['html'] ?? '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <link rel="icon" href="https://www.svgrepo.com/show/424304/furniture-house-living-17.svg" type="image/svg+xml">
    <link rel="stylesheet" href="css/generate.css">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --color-clifford: #da373d;
            --font-sans: InterVariable, sans-serif;
            --font-sans--font-feature-settings: 'cv02', 'cv03', 'cv04', 'cv11';
        }
    </style>
</head>
<body>
<div class="header">
    <h1><?php echo htmlspecialchars($page_title); ?></h1>
    <p>AI-Curated Just For You</p>
</div>

<div class="user-preferences">
    <div class="preference-item">
        <strong>Furniture Type</strong>
        <span><?php echo htmlspecialchars($furniture_type); ?></span>
    </div>
    <div class="preference-item">
        <strong>Budget</strong>
        <span><?php echo htmlspecialchars($budget); ?></span>
    </div>
    <div class="preference-item">
        <strong>Style</strong>
        <span><?php echo htmlspecialchars($style); ?></span>
    </div>
</div>

<div class="container">
    <?php if (!empty($description)): ?>
        <div class="description">
            <?php echo htmlspecialchars($description); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($products)): ?>
        <div class="products-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-image">
                        🛋️
                    </div>
                    <div class="product-info">
                        <div class="product-name"><?php echo htmlspecialchars($product['name'] ?? 'Product'); ?></div>
                        <div class="product-description"><?php echo htmlspecialchars($product['description'] ?? ''); ?></div>
                        <div class="product-price"><?php echo htmlspecialchars($product['price'] ?? ''); ?></div>
                        <?php if (!empty($product['features'])): ?>
                            <ul class="product-features">
                                <?php foreach ($product['features'] as $feature): ?>
                                    <li><?php echo htmlspecialchars($feature); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div style="text-align: center; padding: 40px; background: white; border-radius: 10px;">
            <p style="font-size: 18px; color: #999;">No products were generated. Please try again.</p>
        </div>
    <?php endif; ?>

    <?php if (!empty($generated_html)): ?>
        <div class="ai-generated-content">
            <?php echo $generated_html; ?>
        </div>
    <?php endif; ?>

    <div class="cta-section">
        <h2>Want to explore more options?</h2>
        <p style="margin-bottom: 25px; color: #666;">Try different styles, budgets, or furniture types</p>
        <a href="index.php" class="cta-button">Start New Search</a>
    </div>
</div>

<div class="footer">
    <p>Powered by Google Gemini • Created with n8n Automation</p>
    <p style="margin-top: 10px;">Created by Shem • Generated on <?php echo date('F j, Y \a\t g:i A'); ?></p>
</div>
</body>
</html>