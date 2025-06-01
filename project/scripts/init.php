<?php
require_once __DIR__ . '/db.php';

function init($request = array(), $urlconf = array()) {
    global $conf;
    
    try {
        $db = db_connect();
        if (!$db) {
            throw new Exception('Database connection failed');
        }
    } catch (Exception $e) {
        error_log('Init DB Error: ' . $e->getMessage());
        if ($request['is_ajax'] ?? false) {
            return [
                'headers' => ['Content-Type' => 'application/json'],
                'entity' => ['success' => false, 'error' => 'Database error']
            ];
        }
        return [
            'headers' => ['HTTP/1.1 500 Internal Server Error'],
            'entity' => 'Database connection error'
        ];
    }

    $response = array();
    $template = 'page';
    $c = array();

    $q = $request['url'] ?? '';
    $method = strtolower($request['method'] ?? 'get');

    foreach ($urlconf as $url => $r) {
        $matches = array();

        if ($url == '' || $url[0] != '/') {
            if ($url != $q) continue;
        } else {
            if (!preg_match($url, $q, $matches)) continue;
        }

        if (!empty($r['auth'])) {
            require_once "./modules/{$r['auth']}.php";
            if (function_exists('auth')) {
                $auth_response = auth($request, $r);
                if ($auth_response) return $auth_response;
            }
        }

        if (empty($r['module'])) continue;
        require_once "./modules/{$r['module']}.php";

        $func = "{$r['module']}_{$method}";
        if (!function_exists($func)) continue;

        $params = [$request];
        if (isset($matches[1])) {
            $params[] = $matches[1];
        }

        $result = call_user_func_array($func, $params);

   if (is_array($result)) {
    if ($request['is_ajax'] ?? false) {
        return [
            'headers' => ['Content-Type' => 'application/json'],
            'entity' => $result
        ];
    }

    if (!empty($result['headers'])) {
        return $result;
    }
    $response = array_merge($response, $result);
} else {
    $c['#content'][$r['module']] = $result;
}
    }

    if (!empty($c)) {
        $c['#request'] = $request;
        $response['entity'] = theme($template, $c);
    } else {
        $response = not_found();
    }

    $response['headers']['Content-Type'] = 'text/html; charset=' . conf('charset');
    return $response;
}

function conf($key) {
  global $conf;
  return isset($conf[$key]) ? $conf[$key] : FALSE;
}

function url($addr = '', $params = array()) {
  global $conf;

  if ($addr == '' && isset($_GET['q'])) {
    $addr = strip_tags($_GET['q']);
  }
  $clean = conf('clean_urls');
  $r = $clean ? '/' : '?q=';
  $r = conf('basedir') . ltrim($r . strip_tags($addr), '/'); 

  if (count($params) > 0) {
    $r .= $clean ? '?' : '&';
    $r .= implode('&', $params);
  }
  return $r;
}

function redirect($l = NULL, $statusCode = 302) {
  if (is_null($l)) {
    $location = $_SERVER['REQUEST_URI']; 
  }
  else {
    $location = conf('basedir') . $l; 
  }
    return array('headers' => array('Location' => $location),
                 'statusCode' => $statusCode);
}


function access_denied() {
  return array(
    'headers' => array('HTTP/1.1 403 Forbidden'),
    'entity' => theme('403'),
  );
}

function not_found() {
  return array(
    'headers' => array('HTTP/1.1 404 Not Found'),
    'entity' => theme('404'),
  );
}


function theme($t, $c = array()) {
  $template = conf('theme') . '/' . str_replace('/', '_', $t) . '.tpl.php';
  if (!file_exists($template)) {
    return implode('', $c);
  }
  ob_start();
  extract($c);
  include $template;
  $contents = ob_get_contents();
  ob_end_clean();
  return $contents;
}