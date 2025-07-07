CREATE OR REPLACE view v_employees_current AS
SELECT employees.emp_no , employees.birth_date , 
employees.first_name , employees.last_name ,
employees.gender , employees.hire_date, dept_emp.dept_no FROM employees  JOIN dept_emp 
ON dept_emp.emp_no = employees.emp_no 
WHERE dept_emp.to_date = '9999-01-01'

CREATE OR REPLACE view v_manager_current AS
SELECT employees.emp_no , employees.birth_date , 
employees.first_name , employees.last_name , dept_manager.dept_no ,
employees.gender , employees.hire_date FROM employees  JOIN dept_manager
ON dept_manager.emp_no = employees.emp_no
WHERE dept_manager.to_date = '9999-01-01'

CREATE OR REPLACE view v_salaries_current AS
SELECT v_employees_current.emp_no, salaries.salary , salaries.from_date , salaries.to_date FROM v_employees_current JOIN salaries
ON salaries.emp_no = v_employees_current.emp_no
WHERE salaries.to_date = '9999-01-01';

CREATE OR REPLACE view v_info_departments AS
SELECT departments.dept_no , departments.dept_name ,  count(v_employees_current.emp_no) as nb_employees , manager.last_name , manager.first_name FROM departments JOIN v_employees_current ON departments.dept_no = v_employees_current.dept_no JOIN v_manager_current as manager ON manager
.dept_no = departments.dept_no GROUP BY departments.dept_name;


CREATE OR REPLACE view v_salaries_per_persons AS
SELECT v_employees_current.emp_no , v_employees_current.first_name , v_employees_current.last_name ,
v_employees_current.gender , salary , title FROM v_employees_current JOIN v_salaries_current ON v_employees_current.emp_no = v_salaries_current.emp_no 
JOIN titles ON titles.emp_no = v_employees_current.emp_no;

CREATE OR REPLACE view v_ManEmployees AS
SELECT  v_employees_current.emp_no ,  titles.title , count(v_employees_current.emp_no) as man_count FROM v_employees_current JOIN titles ON titles.emp_no = 
v_employees_current.emp_no WHERE v_employees_current.gender = 'M' GROUP
BY titles.title;

CREATE OR REPLACE  view v_WomanEmployees AS
SELECT   v_employees_current.emp_no , titles.title , count(v_employees_current.emp_no) as woman_count FROM v_employees_current JOIN titles ON titles.emp_no = 
v_employees_current.emp_no WHERE v_employees_current.gender = 'F' GROUP
BY titles.title;

SELECT * FROM v_salaries_per_persons WHERE title = 'Assistant Engineer';
