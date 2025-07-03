<?php
function selectalldepartements($bdd){
    $sql = "SELECT * FROM departments";
    $result = mysqli_query($bdd,$sql);
    return $result;
}

function ManagerOFDepartment($bdd) {
    $sql = "SELECT * FROM departments JOIN v_manager_current ON v_manager_current.dept_no = departments.dept_no";
    // echo $sql;
    $result =  mysqli_query($bdd,$sql);
    return $result;
}

function selectdepartementsForEmployees($bdd , $dept_no) {
    $sql = "SELECT dept_name as Title FROM departments JOIN dept_emp ON dept_emp.dept_no = departments.dept_no JOIN employees ON employees.emp_no = dept_emp.emp_no WHERE departments.dept_no
     ='$dept_no'";
    // echo $sql;
    $result =  mysqli_query($bdd,$sql);
    $return = mysqli_fetch_assoc($result);
    return $return;
}
function EmployeesOFDepartment($bdd , $dept_no){
    $sql = "SELECT * FROM departments JOIN dept_emp ON dept_emp.dept_no = departments.dept_no JOIN employees ON employees.emp_no = dept_emp.emp_no WHERE departments.dept_no
     ='$dept_no' AND dept_emp.to_date = '9999-01-01'";
    // echo $sql;
    $result =  mysqli_query($bdd,$sql);
    return $result;
}

function FicheEmployees($bdd, $emp_no){
    $sql = "SELECT * FROM employees  JOIN dept_emp ON dept_emp.emp_no = employees.emp_no WHERE employees.emp_no ='$emp_no' AND dept_emp.to_date='9999-01-01'";
    // echo $sql;
    $result = mysqli_query($bdd,$sql);
    return $result;
}

function SalaireEmployees($bdd, $emp_no){ 
    $sql = "SELECT * FROM salaries JOIN employees ON employees.emp_no = salaries.emp_no WHERE salaries.emp_no = '$emp_no' AND salaries.to_date='9999-01-01'";
    //echo $sql;
    $result = mysqli_query($bdd,$sql);    
    return $result;
}

function TitleEmployees($bdd,$emp_no){
    $sql = "SELECT * FROM titles JOIN employees ON employees.emp_no = titles.emp_no WHERE titles.emp_no = '$emp_no' AND titles.to_date = '9999-01-01'";
    $sql = "SELECT * FROM employees  JOIN dept_emp ON dept_emp.emp_no = employees.emp_no WHERE employees.emp_no ='$emp_no' AND dept_emp.to_date='9999-01-01'";
    // echo $sql;
    $result = mysqli_query($bdd,$sql);
    return $result;
}


function Historique($bdd, $emp_no){ 
    $sql = "SELECT * FROM salaries JOIN employees ON employees.emp_no = salaries.emp_no  JOIN titles ON titles.emp_no = employees.emp_no WHERE titles.emp_no = '$emp_no' AND salaries.emp_no = '$emp_no' AND titles.to_date != '9999-01-01' AND salaries.to_date != '9999-01-01'";
    //echo $sql;
    $result = mysqli_query($bdd,$sql);    
    return $result;
}

function Recherche($bdd , $department , $Employees_name , $age_min , $age_max , $page) {
    $page = ($page - 1 ) * 20;
    $sql = "SELECT departments.dept_name, employees.first_name, employees.last_name, employees.birth_date, TIMESTAMPDIFF(YEAR, employees.birth_date, CURDATE()) as age
            FROM employees
            JOIN dept_emp ON dept_emp.emp_no = employees.emp_no
            JOIN departments ON departments.dept_no = dept_emp.dept_no
            WHERE 1=1
            AND ((employees.first_name LIKE '%$Employees_name%') OR (employees.last_name LIKE '%$Employees_name%'))
            AND TIMESTAMPDIFF(YEAR, employees.birth_date, CURDATE()) BETWEEN $age_min AND $age_max
            AND departments.dept_no LIKE '%$department%'
            AND dept_emp.to_date = '9999-01-01' LIMIT $page , 20 ";
    // echo $sql;
    $result = mysqli_query($bdd, $sql);
    return $result;
}

?>