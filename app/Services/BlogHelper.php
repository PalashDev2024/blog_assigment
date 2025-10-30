<?php

namespace App\Services;

class BlogHelper {
    public function summary($text, $limit = 100) {
        return substr($text, 0, $limit) . '...';
    }
}