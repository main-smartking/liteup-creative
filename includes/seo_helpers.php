<?php
function getCurrentUrl() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];
    return $protocol . $host . $uri;
}

function generateMetaTitle($page = '') {
    $base = 'Liteup Creative';
    if (!empty($page)) {
        return htmlspecialchars($page . ' - ' . $base);
    }
    return htmlspecialchars($base . ' - Brand Design & Digital Marketing Agency');
}

function generateMetaDescription($content = '') {
    if (empty($content)) {
        return 'Professional Brand Design and Digital Marketing Agency in Nigeria. We specialize in brand identity, digital marketing, and creative solutions.';
    }
    return htmlspecialchars(substr(strip_tags($content), 0, 160));
}