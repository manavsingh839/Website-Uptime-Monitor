<?php
// -----------------------------------
// Website Uptime Monitor (PHP)
// -----------------------------------
// Add your URLs to monitor in the $websites array below.
// If any site is down, an email alert will be sent.
// -----------------------------------

// 🔗 List of websites to monitor
$websites = [
    // Example: "https://example.com",
];

// 📧 Email alert configuration
$to = "your-email@example.com";
$subject = "Website Down Alert";
$fromEmail = "alert@yourdomain.com"; // Used in email headers

// 📉 Collect down websites
$downWebsites = [];

/**
 * Checks if a given website is down
 */
function isWebsiteDown($url) {
    if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
        return true;
    }

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ($http_code < 200 || $http_code >= 400);
}

// 🔁 Check all websites
foreach ($websites as $website) {
    if (isWebsiteDown($website)) {
        $downWebsites[] = $website;
    }
}

// 📬 Send alert if needed
if (!empty($downWebsites)) {
    $message = "The following websites appear to be down:\n\n" . implode("\n", $downWebsites) . "\n\nPlease investigate.";
    $headers = "From: $fromEmail\r\n";

    mail($to, $subject, $message, $headers);
    echo "🚨 Alert sent: Some websites are down.\n";
} else {
    echo "✅ All websites are up and running.\n";
}
?>
