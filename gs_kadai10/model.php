<?php
    function h($str) {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');  
    }

    function loginCheck() {
        if(!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] !== session_id()) {
            exit('LOGIN ERROR');
        } else {
            session_regenerate_id(true);
            $_SESSION['chk_ssid'] = session_id();
        }
    }

    function redirect($file_name) {
        header('Location: ' . $file_name );
        exit();
    }

    function getFlashMessage() {
        $flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : [];
        unset($_SESSION['flash']);

        return $flash;
    }

    function getOriginalMessage() {
        $original = isset($_SESSION['original']) ? $_SESSION['original'] : [];
        unset($_SESSION['original']);

        return $original;
    }

    function unsetTmpSession() {
        unset($_SESSION['flash']);
        unset($_SESSION['original']);
    }

    function escape_nl($str) {
        $new_str = str_replace(["\r\n", "\r", "\n"], "\\r\\n", $str);
        return $new_str;
    }

    function unescape_nl($str) {
        $new_str = str_replace("\\r\\n", "\r\n", $str);
        return $new_str;
    }

    function isSystemAdministrator() {
        if($_SESSION['role'] === 1) {
            return true;
        }
        return false;
    }

    function isUserAdministrator() {
        if($_SESSION['role'] === 2) {
            return true;
        }
        return false;
    }

    function isUserGeneral() {
    if($_SESSION['role'] === 3) {
            return true;
        }
        return false;
    }

    function getNavigationMenu($menuGroup, $menuContent) {
        $navView = '';

        if($menuGroup === 'Dashboard') {
            $navView .= '<li class="menu-item active">';
        } else {
            $navView .= '<li class="menu-item">';
        }
        $navView .= '<a href="http://localhost/gs_code/gs_kadai10/menu.php" class="menu-link">';
        $navView .= '<i class="menu-icon tf-icons bx bx-home-circle"></i>';
        $navView .= '<div data-i18n="Analytics">Dashboard</div>';
        $navView .= '</a>';
        $navView .= '</li>';

        if(isSystemAdministrator() || isUserAdministrator() || isUserGeneral()) {
            $navView .= '<li class="menu-header small text-uppercase">';
            $navView .= '<span class="menu-header-text">Sales Management</span>';
            $navView .= '</li>';
            if($menuGroup === 'SalesManagement') {
                $navView .= '<li class="menu-item active open">';
            } else {
                $navView .= '<li class="menu-item">';
            }
            $navView .= '<a href="javascript:void(0);" class="menu-link menu-toggle">';
            $navView .= '<i class="menu-icon tf-icons bx bx-notepad"></i>';
            $navView .= '<div data-i18n="Account Settings">Daily Reports</div>';
            $navView .= '</a>';
            $navView .= '<ul class="menu-sub">';
            if($menuContent === 'ReportRegist') {
                $navView .= '<li class="menu-item active">';
            } else {
                $navView .= '<li class="menu-item">';
            }
            $navView .= '<a href="http://localhost/gs_code/gs_kadai10/report_regist.php" class="menu-link">';
            $navView .= '<div data-i18n="Account">Write</div>';
            $navView .= '</a>';
            $navView .= '</li>';
            if($menuContent === 'ReportList') {
                $navView .= '<li class="menu-item active">';
            } else {
                $navView .= '<li class="menu-item">';
            }
            $navView .= '<a href="http://localhost/gs_code/gs_kadai10/report_list.php" class="menu-link">';
            $navView .= '<div data-i18n="Notifications">Reference</div>';
            $navView .= '</a>';
            $navView .= '</li>';
            $navView .= '</ul>';
            $navView .= '</li>';
        }

        if(isSystemAdministrator() || isUserAdministrator()) {
            $navView .= '<li class="menu-header small text-uppercase">';
            $navView .= '<span class="menu-header-text">User Management</span>';
            $navView .= '</li>';
            if($menuGroup === 'UserManagement') {
                $navView .= '<li class="menu-item active open">';
            } else {
                $navView .= '<li class="menu-item">';
            }
            $navView .= '<a href="javascript:void(0)" class="menu-link menu-toggle">';
            $navView .= '<i class="menu-icon tf-icons bx bx-user-circle"></i>';
            $navView .= '<div data-i18n="User interface">Users</div>';
            $navView .= '</a>';
            $navView .= '<ul class="menu-sub">';
            if($menuContent === 'UserRegist') {
                $navView .= '<li class="menu-item active">';
            } else {
                $navView .= '<li class="menu-item">';
            }
            $navView .= '<a href="http://localhost/gs_code/gs_kadai10/user_regist.php" class="menu-link">';
            $navView .= '<div data-i18n="Accordion">Regist</div>';
            $navView .= '</a>';
            $navView .= '</li>';
            if($menuContent === 'UserList') {
                $navView .= '<li class="menu-item active">';
            } else {
                $navView .= '<li class="menu-item">';
            }
            $navView .= '<a href="http://localhost/gs_code/gs_kadai10/user_list.php" class="menu-link">';
            $navView .= '<div data-i18n="Alerts">Reference</div>';
            $navView .= '</a>';
            $navView .= '</li>';
            $navView .= '</ul>';
            $navView .= '</li>';
        }

        if(isSystemAdministrator()) {
            $navView .= '<li class="menu-header small text-uppercase"><span class="menu-header-text">Tenant Management</span>';
            $navView .= '</li>';
            if($menuGroup === 'TenantManagement') {
                $navView .= '<li class="menu-item active open">';
            } else {
                $navView .= '<li class="menu-item">';
            }
            $navView .= '<a href="javascript:void(0);" class="menu-link menu-toggle">';
            $navView .= '<i class="menu-icon tf-icons bx bx-buildings"></i>';
            $navView .= '<div data-i18n="Form Elements">Tenants</div>';
            $navView .= '</a>';
            $navView .= '<ul class="menu-sub">';
            if($menuContent === 'TenantRegist') {
                $navView .= '<li class="menu-item active">';
            } else {
                $navView .= '<li class="menu-item">';
            }
            $navView .= '<a href="http://localhost/gs_code/gs_kadai10/tenant_regist.php" class="menu-link">';
            $navView .= '<div data-i18n="Basic Inputs">Regist</div>';
            $navView .= '</a>';
            $navView .= '</li>';
            if($menuContent === 'TenantList') {
                $navView .= '<li class="menu-item active">';
            } else {
                $navView .= '<li class="menu-item">';
            }
            $navView .= '<a href="http://localhost/gs_code/gs_kadai10/tenant_list.php" class="menu-link">';
            $navView .= '<div data-i18n="Basic Inputs">Refenrece</div>';
            $navView .= '</a>';
            $navView .= '</li>';
            $navView .= '</ul>';
            $navView .= '</li>';
        }

        return $navView;
    }

    function db_conn() {
        try {
            $db_name = 'gs_db';
            $db_id   = 'root';
            $db_pw   = '';
            $db_host = 'localhost';
            $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);

            return $pdo;
        } catch (PDOException $e) {
            exit('DB Connection Error: ' . $e->getMessage());
        }
    }

    function get_all_users($pdo) {
        $stmt;
        if(isSystemAdministrator()) {
            $stmt = $pdo->prepare("SELECT users.user_id, users.user_name,
                roles.role_id, roles.role_name, tenants.tenant_id, tenants.tenant_name FROM users 
                JOIN roles ON users.role = roles.role_id
                JOIN tenants ON users.user_tenant = tenants.tenant_id");
        } else if(isUserAdministrator()) {
            $stmt = $pdo->prepare("SELECT users.user_id, users.user_name,
                roles.role_id, roles.role_name, tenants.tenant_id, tenants.tenant_name FROM users 
                JOIN roles ON users.role = roles.role_id
                JOIN tenants ON users.user_tenant = tenants.tenant_id
                WHERE users.user_tenant = :tenantID");
            $stmt->bindValue(':tenantID', $_SESSION['tenantId'], PDO::PARAM_STR);
        }
    
        $status = $stmt->execute();
      
        if($status === false){
          sql_error($stmt);
        } else {
            $view = '';
            $i = 1;
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $view .= "<tr>";
                $view .= "<td>" . $i . "</td>";
                $view .= "<td>" . h($result['user_name']) . "</td>";
                $view .= "<td>" . h($result['role_name']) . "</td>";
                $view .= "<td>" . h($result['tenant_name']) . "</td>";

                $view .= "<td>";
                $view .= "<div class='dropdown'>";
                $view .= "<button type='button' class='btn p-0 dropdown-toggle hide-arrow'";
                $view .= "data-bs-toggle='dropdown'>";
                $view .= "<i class='bx bx-dots-vertical-rounded'></i>";
                $view .= "</button>";

                $view .= "<div class='dropdown-menu'>";

                $view .= "<form action='http://localhost/gs_code/gs_kadai10/user_update.php' method='post'>";
                $view .= "<input type='hidden' name='userId' id='userId' value='" . h($result['user_id']) . "'>";
                $view .= "<input type='hidden' name='userName' id='userName' value='" . h($result['user_name']) . "'>";
                $view .= "<input type='hidden' name='roleId' id='roleId' value='" . h($result['role_id']) . "'>";
                $view .= "<input type='hidden' name='tenantId' id='tenantId' value='" . h($result['tenant_id']) . "'>";
                $view .= "<button type='submit' class='dropdown-item'><i class='bx bx-edit-alt me-1'></i>Edit</button>";
                $view .= "</form>";

                $view .= "<form action='http://localhost/gs_code/gs_kadai10/acts/user_delete_act.php' method='post'>";
                $view .= "<input type='hidden' name='userId' id='userId' value=" . h($result['user_id']) . ">";
                $view .= "<button type='submit' class='dropdown-item'><i class='bx bx-trash me-1'></i>Delete</button>";
                $view .= "</form>";
                $view .= "</div>";
                $view .= "</div>";
                $view .= "</td>";
                $i++;
            }
            return $view;
        }
    }

    function get_role_list_at_user_regist($pdo) {
        $stmt = $pdo->prepare("SELECT roles.role_id, roles.role_name 
            FROM role_grant_privileges INNER JOIN roles ON role_grant_privileges.role_grant_privilege = roles.role_id
            WHERE role_grant_privileges.role = :roleId;");

        $stmt->bindValue(':roleId', $_SESSION['role'], PDO::PARAM_STR);
        
        $status = $stmt->execute();
        
        if($status === false){
            sql_error($stmt);
        } else {
            $roleSelectView = "";

            while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $roleSelectView .= "<option value=" . h($result['role_id']);
                if(!empty($original['userRole']) && $result['role_id'] === $original['userRole']) {
                    $tenantSelectView .= " selected";
                }
                $roleSelectView .= ">";
                $roleSelectView .= h($result['role_name']);
                $roleSelectView .= "</option>";
            }
            return $roleSelectView;
        }
    }

    function get_tenant_list_at_user_regist($pdo) {
        $stmt = $pdo->prepare("SELECT tenant_id, tenant_name FROM tenants");

        $status = $stmt->execute();
        
        if($status === false){
            sql_error($stmt);
        } else {
            $tenantSelectView = "";
    
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $tenantSelectView .= "<option value=" . h($result['tenant_id']);
                if(!empty($original['userTenant']) && $result['tenant_id'] === $original['userTenant']) {
                    $tenantSelectView .= " selected";
                }
                $tenantSelectView .= ">";
                $tenantSelectView .= h($result['tenant_name']);
                $tenantSelectView .= "</option>";
            }
        }
        return $tenantSelectView;
    }

    function get_all_tenants($pdo) {
        $stmt = $pdo->prepare("SELECT tenant_id, tenant_name FROM tenants");
  
        $status = $stmt->execute();
      
        if($status === false){
          sql_error($stmt);
        } else {
            $view = '';
            $i = 1;
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $view .= "<tr>";
                $view .= "<td>" . $i . "</td>";
                $view .= "<td>" . h($result['tenant_id']) . "</td>";
                $view .= "<td>" . h($result['tenant_name']) . "</td>";

                $view .= "<td>";
                $view .= "<div class='dropdown'>";
                $view .= "<button type='button' class='btn p-0 dropdown-toggle hide-arrow'";
                $view .= "data-bs-toggle='dropdown'>";
                $view .= "<i class='bx bx-dots-vertical-rounded'></i>";
                $view .= "</button>";

                $view .= "<div class='dropdown-menu'>";

                $view .= "<form action='http://localhost/gs_code/gs_kadai10/tenant_update.php' method='post'>";
                $view .= "<input type='hidden' name='tenantId' id='tenantId' value='" . h($result['tenant_id']) . "'>";
                $view .= "<input type='hidden' name='tenantName' id='tenantName' value='" . h($result['tenant_name']) . "'>";
                $view .= "<button type='submit' class='dropdown-item'><i class='bx bx-edit-alt me-1'></i>Edit</button>";
                $view .= "</form>";

                $view .= "<form action='http://localhost/gs_code/gs_kadai10/acts/tenant_delete_act.php' method='post'>";
                $view .= "<input type='hidden' name='tenantId' id='tenantId' value='" . h($result['tenant_id']) . "'>";
                $view .= "<input type='hidden' name='tenantName' id='tenantName' value='" . h($result['tenant_name']) . "'>";
                $view .= "<button type='submit' class='dropdown-item'><i class='bx bx-trash me-1'></i>Delete</button>";
                $view .= "</form>";
                $view .= "</div>";
                $view .= "</div>";
                $view .= "</td>";
                $i++;
            }
            return $view;
        }
    }

    function get_all_reports($pdo) {
        $stmt;

        if(isSystemAdministrator()) {
            $stmt = $pdo->prepare("SELECT
                tenants.tenant_id, tenants.tenant_name, 
                users.user_id, users.user_name,
                daily_reports.date, daily_reports.report_content AS report
                FROM daily_reports
                JOIN tenants ON daily_reports.tenant_id = tenants.tenant_id
                JOIN users ON daily_reports.user_id = users.user_id");
        } else {
            $stmt = $pdo->prepare("SELECT
                tenants.tenant_id, tenants.tenant_name, 
                users.user_id, users.user_name,
                daily_reports.date, daily_reports.report_content AS report
                FROM daily_reports
                JOIN tenants ON daily_reports.tenant_id = tenants.tenant_id
                JOIN users ON daily_reports.user_id = users.user_id
                WHERE daily_reports.tenant_id = :tenantId");
            $stmt->bindValue(':tenantId', $_SESSION['tenantId'], PDO::PARAM_STR);
        }
        
        $status = $stmt->execute();
      
        if($status === false){
          sql_error($stmt);
        } else {
            $view = '';
            $i = 1;
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $view .= "<tr>";
                $view .= "<td>" . $i . "</td>";
                $view .= "<td>" . h($result['tenant_name']) . "</td>";
                $view .= "<td>" . h($result['user_name']) . "</td>";
                $view .= "<td>" . h($result['date']) . "</td>";
                $view .= "<td>" . mb_substr(h($result['report']), 0, 12) . "</td>";

                $view .= "<td>";
                $view .= "<div class='dropdown'>";
                $view .= "<button type='button' class='btn p-0 dropdown-toggle hide-arrow'";
                $view .= "data-bs-toggle='dropdown'>";
                $view .= "<i class='bx bx-dots-vertical-rounded'></i>";
                $view .= "</button>";

                $view .= "<div class='dropdown-menu'>";

                $view .= "<form action='http://localhost/gs_code/gs_kadai10/report_update.php' method='post'>";
                $view .= "<input type='hidden' name='tenantId' id='tenantId' value='" . h($result['tenant_id']) . "'>";
                $view .= "<input type='hidden' name='userId' id='userId' value='" . h($result['user_id']) . "'>";
                $view .= "<input type='hidden' name='date' id='date' value='" . h($result['date']) . "'>";
                $view .= "<input type='hidden' name='report' id='report' value='" . h(escape_nl($result['report'])) . "'>";
                $view .= "<button type='submit' class='dropdown-item'><i class='bx bx-edit-alt me-1'></i>Edit</button>";
                $view .= "</form>";

                $view .= "<form action='http://localhost/gs_code/gs_kadai10/acts/report_delete_act.php' method='post'>";
                $view .= "<input type='hidden' name='tenantId' id='tenantId' value='" . h($result['tenant_id']) . "'>";
                $view .= "<input type='hidden' name='userId' id='userId' value='" . h($result['user_id']) . "'>";
                $view .= "<input type='hidden' name='date' id='date' value='" . h($result['date']) . "'>";
                $view .= "<button type='submit' class='dropdown-item'><i class='bx bx-trash me-1'></i>Delete</button>";
                $view .= "</form>";
                $view .= "</div>";
                $view .= "</div>";
                $view .= "</td>";
                
                $i++;
            }
            return $view;
        }
    }

    function sql_error($stmt) {
        $error = $stmt->errorInfo();
        exit('SQL Error: ' . print_r($error, true));
    }