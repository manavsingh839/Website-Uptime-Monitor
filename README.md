# 📡 Website Uptime Monitor (PHP)

A lightweight PHP script to monitor the uptime of multiple websites. It checks a list of URLs and sends a single email alert if any site is down. Perfect for basic server-side monitoring using a cron job.

---

## 🔧 Features

- Checks multiple websites for availability
- Sends one email if any site is down
- Skips empty or invalid URLs
- Uses PHP `cURL` and `mail()` function
- Easy to set up via cron job

---

## 🚀 Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/manavsingh839/Website-Uptime-Monitor.git
   cd Website-Uptime-Monitor
Configure the script:

Open index.php

Add your website URLs in the $websites array

Set the $to variable with your email(s)

Test it manually:

bash
php index.php


⏰ Cron Job Setup
To run the script automatically at intervals:

Open your crontab:

bash

crontab -e
Add a line to check every 30 minutes:

bash

*/30 * * * * /usr/bin/php /path/to/your/index.php
Replace /path/to/your/index.php with the full path to your script.

📬 Email Alerts
Sent only if one or more sites are down.

Uses PHP’s native mail() function — ensure your server can send mail (via sendmail, postfix, or SMTP relay).
