<?php
/**
 * Plugin Name: Custom Rest API
 * Plugin URI: https://walterkstro.me/
 * Description: Personalizar la Rest API de Wordpress
 * Version: 1.0.0
 * Author: Walter Castro
 * Author URI: http://walterkstro.me/
 * Developer: Walter Castro
 * Developer URI: http://walterkstro.me/
 * Text Domain: wc
 * Requires PHP: 7.2
 * Domain Path: /languages
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

if (!defined("ABSPATH")) {
    exit();
}
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once __DIR__ . "/Responses.php";
require "vendor/autoload.php";

add_filter(
    "rest_prepare_category",
    function ($payload, $category, $request) {
        return [
            "name" => $category->name,
            "slug" => $category->slug,
            "id" => $category->term_id,
        ];
    },
    10,
    3
);

add_filter(
    "rest_prepare_post",
    function ($response, $post, $request) {
        return [
            "title" => $post->post_title,
            "content" => $post->post_content,
            "id" => $post->ID,
            "excerpt" => $post->post_excerpt,
            "slug" => $post->post_name,
            "date" => $post->post_date,
            "image" => get_the_post_thumbnail_url($post->ID),
            "category" => get_the_category($post->ID)[0]->name,
        ];
    },
    10,
    3
);

// create a custom rest route
add_action("rest_api_init", function () {
    register_rest_route("/wp/v2", "authentication", [
        "methods" => WP_REST_Server::EDITABLE,
        "callback" => "authentication",
    ]);
});

/* Callback register rest route */
if (!function_exists("authentication")) {
    function authentication(WP_REST_Request $request)
    {
        $data = $request->get_json_params();

        if (!is_array($data)) {
            return new WP_Error(
                "rest_not_logged_in",
                "Invalid request authentication",
                ["status" => Responses::BAD_REQUEST]
            );
        }

        [$email, $password] = array_values($data);
        $email = sanitize_text_field($email);
        $password = sanitize_text_field($password);
        $data_is_valid = !empty($email) && !empty($password);

        if (!$data_is_valid) {
            return new WP_Error(
                "rest_not_logged_in",
                "Invalid request authentication",
                ["status" => Responses::BAD_REQUEST]
            );
        }

        $exist_user = email_exists($email);

        if (!$exist_user) {
            return new WP_Error(
                "rest_not_logged_in",
                "Invalid request authentication",
                ["status" => Responses::BAD_REQUEST]
            );
        }

        $is_auth = wp_signon(
            [
                "user_login" => $email,
                "user_password" => $password,
                "remember" => true,
            ],
            true
        );

        if (is_wp_error($is_auth)) {
            return new WP_Error(
                "rest_not_logged_in",
                "Invalid request authentication",
                ["status" => Responses::BAD_REQUEST]
            );
        }

        $key = "kstro";
        $payload = [
            "iss" => get_site_url(),
            "aud" => $is_auth->get("ID"),
            "iat" => time(),
            "nbf" => time(),
            "exp" => time() * 3600,
        ];

        return new WP_REST_Response(
            [
                "token" => JWT::encode($payload, $key, "HS256"),
            ],
            Responses::SUCCESS
        );
    }
}

/* Endpoints Rest Authentication*/
add_filter("rest_authentication_errors", function ($result) {
    $request = explode("/", $_SERVER["REQUEST_URI"]);
    $current_endpoint = end($request);
    
    if (!empty($result)) {
        return $result;
    }

    // no proteger la ruta de autenticacion
    if($current_endpoint === "authentication") {
        return $result;
    }
    
    $headers = apache_request_headers()["Authorization"];
    if (empty($headers)) {
        return new WP_Error("rest_not_logged_in", "Unauthorized", [
            "status" => Responses::UNAUTHORIZED,
        ]);
    }

    try {
        $decode = JWT::decode($headers, new Key("kstro", "HS256"));
        return $decode;
    } catch (\Throwable $th) {
        return new WP_Error("rest_not_logged_in", "hello", [
            "status" => Responses::UNAUTHORIZED,
        ]);
    }
});
