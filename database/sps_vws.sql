/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Attique
 * Created: Mar 11, 2020
 */

DROP PROCEDURE `sp_categories`;
DELIMITER $$
CREATE PROCEDURE `sp_categories`(in categoryid int)
BEGIN
    IF categoryid <=> 0 THEN
        SELECT child.id, child.category_id as category_id, 
        child.category_name, parent.id as parent_id, parent.category_id as parent_category_id, 
        parent.category_name as parent_category
        FROM (
          SELECT 
          id, child_id, parent_id 
          FROM tblcategoryassociations
        ) as asso LEFT JOIN(
          SELECT 
          id, category_id, category_name 
          FROM tblcategories
        )as child ON child.id = asso.child_id JOIN (
          SELECT 
          id, category_id, category_name 
          FROM tblcategories
        ) as parent ON parent.id = asso.parent_id ORDER BY child.category_name ASC;
    ELSE
        SELECT child.id, child.category_id as category_id, child.category_description, 
        child.category_name, parent.id as parent_id, 
        parent.category_id as parent_category_id, 
        parent.category_name as parent_category
        FROM (
          SELECT 
          id, child_id, parent_id 
          FROM tblcategoryassociations
        ) as asso JOIN(
          SELECT 
          id, category_id, category_name, category_description 
          FROM tblcategories
        ) as child ON child.id = asso.child_id JOIN (
          SELECT
          id, category_id, category_name 
          FROM tblcategories
        ) as parent ON parent.id = asso.parent_id WHERE child.id = categoryid;
    END IF;
END$$
DELIMITER ;

DROP PROCEDURE `sp_users`;
DELIMITER $$
CREATE PROCEDURE `sp_users`()
BEGIN
    SELECT 
    user.id, user.name, user.email, user.is_verify, user.is_admin, user.created_at,
    company.id as company_id, company.company_name, address.phone_number, address.mobile_number
    FROM (
      SELECT id, name, email, is_verify, is_admin, created_at 
      FROM users
    ) as user LEFT JOIN (
      SELECT id, user_id, company_name 
      FROM tblcompanydetails
    ) as company on company.user_id = user.id LEFT JOIN (
      SELECT 
      user_id, phone_number, mobile_number 
      FROM tbladdresses
    ) as address ON address.user_id = user.id ORDER BY user.name ASC;
END$$
DELIMITER ;

DROP PROCEDURE `sp_companyquery`;
DELIMITER $$
CREATE PROCEDURE `sp_companyquery`(in userid int(11))
BEGIN
    IF userid <=> 0 THEN
        SELECT 
        query.id, query.query_discription, query.status, query.expected_date, query.created_at,
        category.category_id, category.category_name,
        user.id as customer_id, user.name, user.email,
        customer.full_name, 
        address.phone_number, address.mobile_number, address.whatsapp
        FROM (
          SELECT 
          id, category_id, company_id, customer_id, query_discription, status, expected_date, created_at 
          FROM tblcustomerqueries
        ) AS query JOIN (
          SELECT 
          id, user_id
          FROM tblcompanydetails
        ) AS company ON company.id = query.company_id JOIN (
          SELECT 
          id, category_id, category_name 
          FROM  tblcategories
        ) AS category ON category.id = query.category_id JOIN (
          SELECT 
          id, name, email 
          FROM users WHERE is_admin = 2
        ) as user ON user.id = query.customer_id JOIN (
          SELECT 
          user_id, full_name
          FROM tblcustomerdetails
        ) AS customer ON customer.user_id = user.id LEFT JOIN (
          SELECT 
          address, user_id, phone_number, mobile_number, whatsapp 
          FROM tbladdresses
        ) AS address ON address.user_id = user.id;

    ELSE
        SELECT 
        query.id, query.query_discription, query.status, query.expected_date, query.created_at,
        category.category_id, category.category_name,
        user.id as customer_id, user.name, user.email,
        customer.full_name, 
        address.phone_number, address.mobile_number, address.whatsapp
        FROM (
          SELECT 
          id, category_id, company_id, customer_id, query_discription, status, expected_date, created_at 
          FROM tblcustomerqueries
        ) AS query JOIN (
          SELECT 
          id, user_id
          FROM tblcompanydetails WHERE user_id = userid
        ) AS company ON company.id = query.company_id JOIN (
          SELECT 
          id, category_id, category_name 
          FROM  tblcategories
        ) AS category ON category.id = query.category_id JOIN (
          SELECT 
          id, name, email 
          FROM users WHERE is_admin = 2
        ) as user ON user.id = query.customer_id JOIN (
          SELECT 
          user_id, full_name
          FROM tblcustomerdetails
        ) AS customer ON customer.user_id = user.id LEFT JOIN (
          SELECT 
          address, user_id, phone_number, mobile_number, whatsapp 
          FROM tbladdresses
        ) AS address ON address.user_id = user.id;
    END IF;
END$$
DELIMITER ;

DROP PROCEDURE `sp_searchcompanyquery`;
DELIMITER $$
CREATE PROCEDURE `sp_searchcompanyquery`(in qstatus varchar(20), in todate varchar(20), in fromdate varchar(20))
BEGIN

END$$
DELIMITER ;

DROP PROCEDURE `sp_searchcompanyquery`;
DELIMITER $$
CREATE PROCEDURE `sp_searchcompanyquery`(in qstatus varchar(20), in todate varchar(20), in fromdate varchar(20))
BEGIN
    IF qstatus <> '0' AND todate <=> '0' AND fromdate <=> '0' THEN
        SELECT 
        query.id, query.query_discription, query.status, query.expected_date, query.created_at,
        category.category_id, category.category_name,
        user.id as customer_id, user.name, user.email,
        customer.full_name, 
        address.phone_number, address.mobile_number, address.whatsapp
        FROM (
          SELECT 
          id, category_id, company_id, customer_id, query_discription, status, expected_date, created_at 
          FROM tblcustomerqueries WHERE status = qstatus
        ) AS query JOIN (
          SELECT 
          id, user_id
          FROM tblcompanydetails
        ) AS company ON company.id = query.company_id JOIN (
          SELECT 
          id, category_id, category_name 
          FROM  tblcategories
        ) AS category ON category.id = query.category_id JOIN (
          SELECT 
          id, name, email 
          FROM users WHERE is_admin = 2
        ) as user ON user.id = query.customer_id JOIN (
          SELECT 
          user_id, full_name
          FROM tblcustomerdetails
        ) AS customer ON customer.user_id = user.id JOIN (
          SELECT 
          address, user_id, phone_number, mobile_number, whatsapp 
          FROM tbladdresses
        ) AS address ON address.user_id = user.id;
    ELSEIF qstatus <=> '0' AND todate <> '0' AND fromdate <=> '0' THEN
        SELECT 
        query.id, query.query_discription, query.status, query.expected_date, query.created_at,
        category.category_id, category.category_name,
        user.id as customer_id, user.name, user.email,
        customer.full_name, 
        address.phone_number, address.mobile_number, address.whatsapp
        FROM (
        SELECT 
          id, category_id, company_id, customer_id, query_discription, status, expected_date, created_at 
          FROM tblcustomerqueries WHERE date(created_at) = todate
        ) AS query JOIN (
          SELECT 
          id, user_id
          FROM tblcompanydetails
        ) AS company ON company.id = query.company_id JOIN (
          SELECT 
          id, category_id, category_name 
          FROM  tblcategories
        ) AS category ON category.id = query.category_id JOIN (
          SELECT 
          id, name, email 
          FROM users WHERE is_admin = 2
        ) as user ON user.id = query.customer_id JOIN (
          SELECT 
          user_id, full_name
          FROM tblcustomerdetails
        ) AS customer ON customer.user_id = user.id JOIN (
          SELECT 
          address, user_id, phone_number, mobile_number, whatsapp 
          FROM tbladdresses
        ) AS address ON address.user_id = user.id;
    ELSEIF qstatus <> '0' AND todate <> '0' AND fromdate <=> '0' THEN
        SELECT 
        query.id, query.query_discription, query.status, query.expected_date, query.created_at,
        category.category_id, category.category_name,
        user.id as customer_id, user.name, user.email,
        customer.full_name, 
        address.phone_number, address.mobile_number, address.whatsapp
        FROM (
          SELECT 
          id, category_id, company_id, customer_id, query_discription, status, expected_date, created_at 
          FROM tblcustomerqueries WHERE status = qstatus AND date(created_at) = todate
        ) AS query JOIN (
          SELECT 
          id, user_id
          FROM tblcompanydetails
        ) AS company ON company.id = query.company_id JOIN (
          SELECT 
          id, category_id, category_name 
          FROM  tblcategories
        ) AS category ON category.id = query.category_id JOIN (
          SELECT 
          id, name, email 
          FROM users WHERE is_admin = 2
        ) as user ON user.id = query.customer_id JOIN (
          SELECT 
          user_id, full_name
          FROM tblcustomerdetails
        ) AS customer ON customer.user_id = user.id JOIN (
          SELECT 
          address, user_id, phone_number, mobile_number, whatsapp 
          FROM tbladdresses
        ) AS address ON address.user_id = user.id;
    ELSEIF qstatus <> '0' AND todate <> '0' AND fromdate <> '0' THEN
        SELECT 
        query.id, query.query_discription, query.status, query.expected_date, query.created_at,
        category.category_id, category.category_name,
        user.id as customer_id, user.name, user.email,
        customer.full_name, 
        address.phone_number, address.mobile_number, address.whatsapp
        FROM (
          SELECT 
          id, category_id, company_id, customer_id, query_discription, status, expected_date, created_at 
          FROM tblcustomerqueries WHERE status = qstatus AND date(created_at) BETWEEN todate AND fromdate
        ) AS query JOIN (
          SELECT 
          id, user_id
          FROM tblcompanydetails
        ) AS company ON company.id = query.company_id JOIN (
          SELECT 
          id, category_id, category_name 
          FROM  tblcategories
        ) AS category ON category.id = query.category_id JOIN (
          SELECT 
          id, name, email 
          FROM users WHERE is_admin = 2
        ) as user ON user.id = query.customer_id JOIN (
          SELECT 
          user_id, full_name
          FROM tblcustomerdetails
        ) AS customer ON customer.user_id = user.id JOIN (
          SELECT 
          address, user_id, phone_number, mobile_number, whatsapp 
          FROM tbladdresses
        ) AS address ON address.user_id = user.id;
    END IF;
END$$
DELIMITER ;

DROP PROCEDURE `sp_companyfeedback`;
DELIMITER $$
CREATE PROCEDURE `sp_companyfeedback`(in companyid int(11))
BEGIN
    SELECT
    feedback.id, feedback.user_id, feedback.company_id,
    user.email, userd.full_name, feedback.feedback,
    feedback.created_at, feedback.updated_at
    FROM (
      SELECT 
      id, user_id, company_id, feedback, created_at,updated_at 
      FROM tblcustomerfeedbacks WHERE company_id = companyid
    ) AS feedback JOIN (
      SELECT 
      id, name, email 
      FROM users
    ) AS user ON user.id = feedback.user_id JOIN(
      SELECT 
      id, user_id, full_name 
      FROM tblcustomerdetails
    ) AS userd ON userd.user_id = feedback.user_id ORDER BY feedback.id DESC;
END$$
DELIMITER ;

DROP PROCEDURE `sp_getchildcategories`;
DELIMITER $$
CREATE PROCEDURE `sp_getchildcategories`(in parentid int(11))
BEGIN
   SELECT 
    cat.id, asso.parent_id, cat.category_id, cat.category_name, cat.product_category 
    FROM (
      SELECT 
      id, child_id, parent_id 
      FROM tblcategoryassociations 
      WHERE parent_id = parentid
    ) AS asso JOIN (
      SELECT 
      id, category_id, category_name, product_category 
      FROM tblcategories
    ) AS cat ON cat.id = asso.child_id ORDER BY cat.category_name ASC;
END$$
DELIMITER ;

DROP PROCEDURE `sp_getcompanycomplaints`;
DELIMITER $$
CREATE PROCEDURE `sp_getcompanycomplaints`()
BEGIN
    SELECT complaint.id, complaint.user_id, complaint.company_id, complaint.complaint, 
    user.name as customer_name, user.email as customer_email,
    company.company_name, complaint.created_at FROM (
     SELECT
      id, user_id, company_id, complaint, created_at 
      FROM tblcomplaints
    ) AS complaint JOIN (
      SELECT 
      id, name, email 
      FROM users
    ) AS user ON user.id = complaint.user_id JOIN (
      SELECT id, company_name
      FROM tblcompanydetails
    ) AS company ON company.id = complaint.company_id ORDER BY complaint.id DESC;
END$$
DELIMITER ;

DROP PROCEDURE `sp_getcompanyrevenue`;
DELIMITER $$
CREATE PROCEDURE `sp_getcompanyrevenue`(in userid int(11))
BEGIN
    SELECT company.company_name,
    SUM(price)
    FROM (
    SELECT company_id, price 
    FROM tblcustomerqueries WHERE status = 'Accept' AND installing_date <> ''
    ) AS query JOIN (
      SELECT id, user_id, company_name 
      FROM tblcompanydetails
    ) AS company ON company.id = query.company_id JOIN (
      SELECT id, name FROM users WHERE id = userid
    ) AS user ON user.id = company.user_id
END$$
DELIMITER ;

DROP PROCEDURE `sp_getcompanyselectedcategories`;
DELIMITER $$
CREATE PROCEDURE `sp_getcompanyselectedcategories`(in companyid int(11))
BEGIN
    SELECT sc.id as selectedcat_id, cat.id, cat.category_id, cat.category_name, sc.created_at FROM (
        SELECT id, category_id, company_id, created_at 
        FROM tblselectedvendorcategories WHERE company_id = companyid
    ) AS sc JOIN (
        SELECT id, category_id, category_name 
        FROM tblcategories
    ) AS cat ON cat.id = sc.category_id;
END$$
DELIMITER ;

DROP PROCEDURE `sp_getcompaniesofcategories`;
DELIMITER $$
CREATE PROCEDURE `sp_getcompaniesofcategories`(in categoryid varchar(30))
BEGIN
        SELECT company.company_id, company.company_name, company.company_logo, company.company_rating, company.company_verified,
        address.address, address.phone_number, address.mobile_number, address.whatsapp,
        category.category_id, category.category_name
        FROM (
          SELECT id, category_id, company_id 
          FROM tblselectedvendorcategories
        ) AS sc JOIN (
          SELECT id, company_id, company_name, company_logo, user_id, company_rating, company_verified
          FROM tblcompanydetails
        ) AS company ON company.id = sc.company_id JOIN (
          SELECT id, category_id, category_name FROM tblcategories
        ) AS category ON category.id = sc.category_id JOIN (
          SELECT id, address, user_id, phone_number, mobile_number, whatsapp 
          FROM tbladdresses
        ) AS address ON address.user_id = company.user_id
        WHERE category.category_id = categoryid;
END$$
DELIMITER ;

DROP PROCEDURE `sp_getchildcategoriesforcustomer`;
DELIMITER $$
CREATE PROCEDURE `sp_getchildcategoriesforcustomer`(in parentid int(11))
BEGIN
   SELECT 
    cat.id, asso.parent_id, cat.category_id, cat.category_name, cat.category_image, cat.measurement,
    parentcat.category_id as parentcatid, parentcat.category_name as parent_category
    FROM (
      SELECT 
      id, child_id, parent_id 
      FROM tblcategoryassociations
    ) AS asso JOIN (
      SELECT 
      id, category_id, category_name, category_image, measurement
      FROM tblcategories
    ) AS cat ON cat.id = asso.child_id JOIN(
      SELECT id, category_id,category_name FROM tblcategories
    ) AS parentcat ON parentcat.id = asso.parent_id WHERE parentcat.category_id = parentid
    ORDER BY cat.category_name ASC;
END$$
DELIMITER ;


DROP PROCEDURE `sp_getcompanyallinformations`;
DELIMITER $$
CREATE PROCEDURE `sp_getcompanyallinformations`(in companyid int(11))
BEGIN
   SELECT company.id, company.company_id, company.company_name, company.office_timing, company.company_logo,
    social.facebook, social.website, social.twitter,
    address.address, address.phone_number, address.mobile_number, address.fax_number, address.whatsapp
    FROM (
      SELECT id, company_id, company_name, user_id, office_timing, company_logo 
      FROM tblcompanydetails WHERE company_id = companyid
    ) AS company JOIN (
      SELECT id, facebook, website, twitter, company_id 
      FROM tblcompanysocials
    ) AS social ON social.company_id = company.id JOIN (
      SELECT id, address, user_id, phone_number, mobile_number, fax_number, whatsapp 
      FROM tbladdresses
    ) AS address ON address.user_id = company.user_id;
END$$
DELIMITER ;

DROP PROCEDURE `sp_getcompanyrating`;
DELIMITER $$
CREATE PROCEDURE `sp_getcompanyrating`(in companyid int(11))
BEGIN
    SELECT company.company_id, company.company_name, company_logo, 
    rating.company_id, rating.rated_value, rating.rated_description 
    FROM (
       SELECT company_id, rated_value, rated_description 
      FROM tblcompanyrates WHERE company_id = companyid
    ) AS rating JOIN (
      SELECT id, company_id, user_id, company_name, company_logo 
      FROM tblcompanydetails
    ) AS company ON company.id = rating.company_id
END$$
DELIMITER ;

DROP PROCEDURE getAccounts;
DELIMITER $$
CREATE PROCEDURE `getAccounts`()
BEGIN  
    SELECT * from (
        SELECT id,AccountId,CategoryName as AccountName,AccountDescription,status from tblaccountcategories where id in(
            SELECT CategoryChildId from tblaccountparentchildassociations
        )
    ) as c
    JOIN (
        select CategoryChildId,CategoryParentId from tblaccountparentchildassociations
    ) as a on  c.id = a.CategoryChildId
    JOIN (
        SELECT id as typeid,CategoryName as acount_type from tblaccountcategories
    ) as p on p.typeid = a.CategoryParentId WHERE c.accountId <> '00000';
END$$
DELIMITER ;


DROP PROCEDURE getGLAccount;
DELIMITER $$
CREATE PROCEDURE `getGLAccount`()
BEGIN  
    SELECT category.id, category.CategoryName, parent.ParentCategory FROM (
        SELECT id, CategoryName 
        FROM tblaccountcategories WHERE product_category = 1
    ) AS category JOIN (
        SELECT id, CategoryParentId, CategoryChildId 
        FROM tblaccountparentchildassociations
    ) AS asso ON asso.CategoryChildId = category.id JOIN (
        SELECT id, CategoryName as ParentCategory FROM tblaccountcategories
    ) AS parent on parent.id = asso.CategoryParentId;
END$$
DELIMITER ;


DROP PROCEDURE getAlldepartment;
DELIMITER $$
CREATE PROCEDURE `getAlldepartment`(in userid int(11), in deptid int(11))
BEGIN  
    IF deptid <> 0 THEN
      SELECT company.company_name, company.id as company_id, office.office_name, department.* FROM (
        SELECT * 
        FROM tbldepartmens WHERE id = deptid
      ) AS department JOIN (
        SELECT id, company_id, office_name 
        FROM tblmaintain_offices
      )AS office ON office.id = department.office_id JOIN(
        SELECT id, company_name FROM tblcompanydetails
      ) AS company ON company.id = office.company_id;
    ELSE
      SELECT company.company_name, company.id as company_id, office.office_name, department.* FROM (
          SELECT id, company_name 
          FROM tblcompanydetails 
          WHERE user_id = userid
      ) AS company JOIN (
        SELECT id, company_id, office_name 
        FROM tblmaintain_offices
      )AS office ON office.company_id = company.id JOIN(
        SELECT * FROM tbldepartmens
      ) AS department ON department.office_id = office.id;
    END IF;
END$$
DELIMITER ;

DROP PROCEDURE getAllregistration;
DELIMITER $$
CREATE PROCEDURE `getAllregistration`(in userid int(11))
BEGIN  
    SELECT reg.*, company.company_name FROM(
      SELECT id, company_id, company_name 
      FROM tblcompanydetails WHERE user_id = userid
    ) AS company JOIN(
      SELECT * FROM tblcompany_registrations
    ) AS reg ON reg.company_id = company.id;
END$$
DELIMITER ;

DROP PROCEDURE sp_getAlloffices;
DELIMITER $$
CREATE PROCEDURE `sp_getAlloffices`(in userid int(11))
BEGIN  
    SELECT office.*, company.company_name FROM(
      SELECT id, user_id, company_id, company_name 
      FROM tblcompanydetails WHERE user_id = userid
    ) AS company JOIN(
      SELECT * FROM tblmaintain_offices
    ) AS office ON office.company_id = company.id;
END$$
DELIMITER ;


DROP PROCEDURE sp_getAllcompanyCalendar;
DELIMITER $$
CREATE PROCEDURE `sp_getAllcompanyCalendar`(in userid int(11),in calendar_id int(11))
BEGIN  
    IF calendar_id <> 0 THEN
      SELECT 
      company.company_name, company.id as company_id, 
      office.office_name, office.id as office_id, 
      dept.department_name, calendar.* FROM (
        SELECT id, company_name 
        FROM tblcompanydetails
      ) AS company JOIN (
        SELECT id, company_id, office_name 
        FROM tblmaintain_offices
      )AS office ON office.company_id = company.id JOIN(
        SELECT id, office_id, department_name 
        FROM tbldepartmens
      ) AS dept ON dept.office_id = office.id JOIN (
        SELECT * FROM tblcompany_calenders WHERE id = calendar_id
      ) AS calendar ON calendar.department_id = dept.id;
    ELSE
      SELECT 
      company.company_name, company.id as company_id, 
      office.office_name, office.id as office_id, 
      dept.department_name, calendar.* FROM (
        SELECT id, company_name 
        FROM tblcompanydetails 
        WHERE user_id = userid
      ) AS company JOIN (
        SELECT id, company_id, office_name 
        FROM tblmaintain_offices
      )AS office ON office.company_id = company.id JOIN(
        SELECT id, office_id, department_name 
        FROM tbldepartmens
      ) AS dept ON dept.office_id = office.id JOIN (
        SELECT * FROM tblcompany_calenders
      ) AS calendar ON calendar.department_id = dept.id;
    END IF;

END$$
DELIMITER ;

DROP PROCEDURE sp_getAllcompanyShift;
DELIMITER $$
CREATE PROCEDURE `sp_getAllcompanyShift`(in userid int(11),in shift_id int(11))
BEGIN  
    IF shift_id <> 0 THEN
      SELECT 
      company.company_name, company.id as company_id, 
      office.office_name, office.id as office_id, 
      dept.department_name, shift.* FROM (
        SELECT id, company_name 
        FROM tblcompanydetails
      ) AS company JOIN (
        SELECT id, company_id, office_name 
        FROM tblmaintain_offices
      )AS office ON office.company_id = company.id JOIN(
        SELECT id, office_id, department_name 
        FROM tbldepartmens
      ) AS dept ON dept.office_id = office.id JOIN (
        SELECT * FROM erp_maintain_shifts WHERE id = shift_id
      ) AS shift ON shift.department_id = dept.id;
    ELSE
      SELECT 
      company.company_name, company.id as company_id, 
      office.office_name, office.id as office_id, 
      dept.department_name, shift.* FROM (
        SELECT id, company_name 
        FROM tblcompanydetails 
        WHERE user_id = userid
      ) AS company JOIN (
        SELECT id, company_id, office_name 
        FROM tblmaintain_offices
      )AS office ON office.company_id = company.id JOIN(
        SELECT id, office_id, department_name 
        FROM tbldepartmens
      ) AS dept ON dept.office_id = office.id JOIN (
        SELECT * FROM erp_maintain_shifts
      ) AS shift ON shift.department_id = dept.id;
    END IF;
END$$
DELIMITER ;

DROP PROCEDURE sp_getAllEmployeeGroup;
DELIMITER $$
CREATE PROCEDURE `sp_getAllEmployeeGroup`(in userid int(11),in group_id int(11))
BEGIN  
    IF group_id <> 0 THEN
      SELECT 
      company.company_name, company.id as company_id, 
      office.office_name, office.id as office_id, 
      dept.department_name, empgroup.* FROM (
        SELECT id, company_name 
        FROM tblcompanydetails
      ) AS company JOIN (
        SELECT id, company_id, office_name 
        FROM tblmaintain_offices
      )AS office ON office.company_id = company.id JOIN(
        SELECT id, office_id, department_name 
        FROM tbldepartmens
      ) AS dept ON dept.office_id = office.id JOIN (
        SELECT * FROM erp_employee_groups WHERE id = group_id
      ) AS empgroup ON empgroup.department_id = dept.id;
    ELSE
      SELECT 
      company.company_name, company.id as company_id, 
      office.office_name, office.id as office_id, 
      dept.department_name, empgroup.* FROM (
        SELECT id, company_name 
        FROM tblcompanydetails 
        WHERE user_id = userid
      ) AS company JOIN (
        SELECT id, company_id, office_name 
        FROM tblmaintain_offices
      )AS office ON office.company_id = company.id JOIN(
        SELECT id, office_id, department_name 
        FROM tbldepartmens
      ) AS dept ON dept.office_id = office.id JOIN (
        SELECT * FROM erp_employee_groups
      ) AS empgroup ON empgroup.department_id = dept.id;
    END IF;
END$$
DELIMITER ;

DROP PROCEDURE sp_getAllEmployeePayscale;
DELIMITER $$
CREATE PROCEDURE `sp_getAllEmployeePayscale`(in userid int(11),in payscale_id int(11))
BEGIN  
    IF payscale_id <> 0 THEN
      SELECT 
      company.company_name, company.id as company_id, 
      office.office_name, office.id as office_id, 
      dept.department_name, payscale.* FROM (
        SELECT id, company_name 
        FROM tblcompanydetails
      ) AS company JOIN (
        SELECT id, company_id, office_name 
        FROM tblmaintain_offices
      )AS office ON office.company_id = company.id JOIN(
        SELECT id, office_id, department_name 
        FROM tbldepartmens
      ) AS dept ON dept.office_id = office.id JOIN (
        SELECT * FROM erp_employee_payscales WHERE id = payscale_id
      ) AS payscale ON payscale.department_id = dept.id;
    ELSE
      SELECT 
      company.company_name, company.id as company_id, 
      office.office_name, office.id as office_id, 
      dept.department_name, payscale.* FROM (
        SELECT id, company_name 
        FROM tblcompanydetails 
        WHERE user_id = userid
      ) AS company JOIN (
        SELECT id, company_id, office_name 
        FROM tblmaintain_offices
      )AS office ON office.company_id = company.id JOIN(
        SELECT id, office_id, department_name 
        FROM tbldepartmens
      ) AS dept ON dept.office_id = office.id JOIN (
        SELECT * FROM erp_employee_payscales
      ) AS payscale ON payscale.department_id = dept.id;
    END IF;
END$$
DELIMITER ;

DROP PROCEDURE sp_getAllEmployeeJDS;
DELIMITER $$
CREATE PROCEDURE `sp_getAllEmployeeJDS`(in userid int(11),in jd_id int(11))
BEGIN  
    IF jd_id <> 0 THEN
      SELECT 
      company.company_name, company.id as company_id, 
      office.office_name, office.id as office_id, 
      dept.department_name, jds.* FROM (
        SELECT id, company_name 
        FROM tblcompanydetails
      ) AS company JOIN (
        SELECT id, company_id, office_name 
        FROM tblmaintain_offices
      )AS office ON office.company_id = company.id JOIN(
        SELECT id, office_id, department_name 
        FROM tbldepartmens
      ) AS dept ON dept.office_id = office.id JOIN (
        SELECT * FROM erp_employee_jds WHERE id = jd_id
      ) AS jds ON jds.department_id = dept.id;
    ELSE
      SELECT 
      company.company_name, company.id as company_id, 
      office.office_name, office.id as office_id, 
      dept.department_name, jds.* FROM (
        SELECT id, company_name 
        FROM tblcompanydetails 
        WHERE user_id = userid
      ) AS company JOIN (
        SELECT id, company_id, office_name 
        FROM tblmaintain_offices
      )AS office ON office.company_id = company.id JOIN(
        SELECT id, office_id, department_name 
        FROM tbldepartmens
      ) AS dept ON dept.office_id = office.id JOIN (
        SELECT * FROM erp_employee_jds
      ) AS jds ON jds.department_id = dept.id;
    END IF;
END$$
DELIMITER ;

DROP PROCEDURE sp_getAllGazzetedHoliday;
DELIMITER $$
CREATE PROCEDURE `sp_getAllGazzetedHoliday`(in userid int(11),in holiday_id int(11))
BEGIN  
    IF holiday_id <> 0 THEN
      SELECT 
      company.company_name, company.id as company_id, 
      office.office_name, office.id as office_id, 
      dept.department_name, holidays.* FROM (
        SELECT id, company_name 
        FROM tblcompanydetails
      ) AS company JOIN (
        SELECT id, company_id, office_name 
        FROM tblmaintain_offices
      )AS office ON office.company_id = company.id JOIN(
        SELECT id, office_id, department_name 
        FROM tbldepartmens
      ) AS dept ON dept.office_id = office.id JOIN (
        SELECT * FROM erp_gazzeted_holidays WHERE id = holiday_id
      ) AS holidays ON holidays.department_id = dept.id;
    ELSE
      SELECT 
      company.company_name, company.id as company_id, 
      office.office_name, office.id as office_id, 
      dept.department_name, holidays.* FROM (
        SELECT id, company_name 
        FROM tblcompanydetails 
        WHERE user_id = userid
      ) AS company JOIN (
        SELECT id, company_id, office_name 
        FROM tblmaintain_offices
      )AS office ON office.company_id = company.id JOIN(
        SELECT id, office_id, department_name 
        FROM tbldepartmens
      ) AS dept ON dept.office_id = office.id JOIN (
        SELECT * FROM erp_gazzeted_holidays
      ) AS holidays ON holidays.department_id = dept.id;
    END IF;
END$$
DELIMITER ;

DROP PROCEDURE sp_getAllYearlyLeaves;
DELIMITER $$
CREATE PROCEDURE `sp_getAllYearlyLeaves`(in userid int(11),in leave_id int(11))
BEGIN  
    IF leave_id <> 0 THEN
      SELECT 
      company.company_name, company.id as company_id, 
      office.office_name, office.id as office_id, 
      dept.department_name, leaves.* FROM (
        SELECT id, company_name 
        FROM tblcompanydetails
      ) AS company JOIN (
        SELECT id, company_id, office_name 
        FROM tblmaintain_offices
      )AS office ON office.company_id = company.id JOIN(
        SELECT id, office_id, department_name 
        FROM tbldepartmens
      ) AS dept ON dept.office_id = office.id JOIN (
        SELECT * FROM erp_maintain_leaves WHERE id = leave_id
      ) AS leaves ON leaves.department_id = dept.id;
    ELSE
      SELECT 
      company.company_name, company.id as company_id, 
      office.office_name, office.id as office_id, 
      dept.department_name, leaves.* FROM (
        SELECT id, company_name 
        FROM tblcompanydetails 
        WHERE user_id = userid
      ) AS company JOIN (
        SELECT id, company_id, office_name 
        FROM tblmaintain_offices
      )AS office ON office.company_id = company.id JOIN(
        SELECT id, office_id, department_name 
        FROM tbldepartmens
      ) AS dept ON dept.office_id = office.id JOIN (
        SELECT * FROM erp_maintain_leaves
      ) AS leaves ON leaves.department_id = dept.id;
    END IF;
END$$
DELIMITER ;

DROP PROCEDURE sp_getPayAllowance;
DELIMITER $$
CREATE PROCEDURE `sp_getPayAllowance`(in userid int(11),in pay_id int(11))
BEGIN  
    IF pay_id <> 0 THEN
      SELECT 
      company.company_name, company.id as company_id, 
      office.office_name, office.id as office_id, 
      dept.department_name, pay.* FROM (
        SELECT id, company_name 
        FROM tblcompanydetails
      ) AS company JOIN (
        SELECT id, company_id, office_name 
        FROM tblmaintain_offices
      )AS office ON office.company_id = company.id JOIN(
        SELECT id, office_id, department_name 
        FROM tbldepartmens
      ) AS dept ON dept.office_id = office.id JOIN (
        SELECT * FROM erp_maintain_deductions WHERE id = pay_id
      ) AS pay ON pay.department_id = dept.id;
    ELSE
      SELECT 
      company.company_name, company.id as company_id, 
      office.office_name, office.id as office_id, 
      dept.department_name, pay.* FROM (
        SELECT id, company_name 
        FROM tblcompanydetails 
        WHERE user_id = userid
      ) AS company JOIN (
        SELECT id, company_id, office_name 
        FROM tblmaintain_offices
      )AS office ON office.company_id = company.id JOIN(
        SELECT id, office_id, department_name 
        FROM tbldepartmens
      ) AS dept ON dept.office_id = office.id JOIN (
        SELECT * FROM erp_maintain_deductions
      ) AS pay ON pay.department_id = dept.id;
    END IF;
END$$
DELIMITER ;

DROP PROCEDURE sp_getEmploeeAddress;
DELIMITER $$
CREATE PROCEDURE `sp_getEmploeeAddress`(in addressid int(11), in cid int(11))
BEGIN  
    IF addressid <> 0 THEN
      SELECT empinfo.id as employee_id, empinfo.employee_name, addr.* FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT id, address_id, employee_id 
        FROM erp_employee_addresses
      ) AS emp_addr ON emp_addr.employee_id = empinfo.id JOIN(
        SELECT * FROM tbladdresses WHERE id = addressid
      ) AS addr ON addr.id = emp_addr.address_id;
    ELSE
      SELECT empinfo.id as employee_id, empinfo.employee_name, addr.* FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT id, address_id, employee_id 
        FROM erp_employee_addresses
      ) AS emp_addr ON emp_addr.employee_id = empinfo.id JOIN(
        SELECT * FROM tbladdresses
      ) AS addr ON addr.id = emp_addr.address_id;
    END IF;
END$$
DELIMITER ;

DROP PROCEDURE sp_getEmploeeSpouse;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getEmploeeSpouse`(IN `spouseid` INT(11), in cid INT(11))
    NO SQL
BEGIN  
    IF spouseid <> 0 THEN
      SELECT spouse.*, empinfo.id as employee_id, empinfo.employee_name, contact.mobile_number, contact.email FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT * FROM erp_spouse_details WHERE id = spouseid
      ) AS spouse ON spouse.employee_id = empinfo.id JOIN (
        SELECT id, mobile_number, email
        FROM tblcontacts
      ) AS contact ON contact.id = spouse.contact_id;
    ELSE
      SELECT spouse.*, empinfo.id as employee_id, empinfo.employee_name, employee.first_name, contact.mobile_number, contact.email FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT * FROM erp_spouse_details
      ) AS spouse ON spouse.employee_id = empinfo.id JOIN (
        SELECT id, mobile_number, email
        FROM tblcontacts
      ) AS contact ON contact.id = spouse.contact_id;
    END IF;
END$$
DELIMITER ;

Drop PROCEDURE sp_getEmployeeEducation;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getEmployeeEducation`(IN `educationid` INT(11), in cid INT(11))
    NO SQL
BEGIN  
    IF educationid <> 0 THEN
      SELECT education.*, empinfo.id as employee_id, empinfo.employee_name FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT * FROM erp_employee_educations WHERE id = educationid
      ) AS education ON education.employee_id = empinfo.id;
    ELSE
      SELECT education.*, empinfo.id as employee_id, empinfo.employee_name FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT * FROM erp_employee_educations
      ) AS education ON education.employee_id = empinfo.id;
    END IF;
END$$
DELIMITER ;

Drop PROCEDURE sp_getEmployeeCertification;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getEmployeeCertification`(IN `certificationid` INT(11), in cid INT(11))
    NO SQL
BEGIN  
    IF certificationid <> 0 THEN
      SELECT certification.*, empinfo.id as employee_id, empinfo.employee_name FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT * FROM erp_employee_certifications WHERE id = certificationid
      ) AS certification ON certification.employee_id = empinfo.id;
    ELSE
      SELECT certification.*, empinfo.id as employee_id, empinfo.employee_name FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT * FROM erp_employee_certifications
      ) AS certification ON certification.employee_id = empinfo.id;
    END IF;
END$$
DELIMITER ;

Drop PROCEDURE sp_getEmployeeExperience;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getEmployeeExperience`(IN `expid` INT(11), in cid INT(11))
    NO SQL
BEGIN  
    IF expid <> 0 THEN
      SELECT exp.*, empinfo.id as employee_id, empinfo.employee_name FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT * FROM erp_employee_experiences WHERE id = expid
      ) AS exp ON exp.employee_id = empinfo.id;
    ELSE
      SELECT exp.*, empinfo.id as employee_id, empinfo.employee_name FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT * FROM erp_employee_experiences
      ) AS exp ON exp.employee_id = empinfo.id;
    END IF;
END$$
DELIMITER ;

Drop PROCEDURE sp_getEmployeeOrgAssignment;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getEmployeeOrgAssignment`(IN `orgid` INT(11), in cid INT(11))
    NO SQL
BEGIN  
    IF orgid <> 0 THEN
      SELECT org.*, empinfo.id as employee_id, empinfo.employee_name FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT * FROM erp_employee_assignments WHERE id = orgid
      ) AS org ON org.employee_id = empinfo.id;
    ELSE
      SELECT org.*, empinfo.id as employee_id, empinfo.employee_name FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT * FROM erp_employee_assignments
      ) AS org ON org.employee_id = empinfo.id;
    END IF;
END$$
DELIMITER ;

Drop PROCEDURE sp_getEmployeePayEmolument;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getEmployeePayEmolument`(IN `payid` INT(11), in cid INT(11))
    NO SQL
BEGIN  
    IF payid <> 0 THEN
      SELECT pay.*, empinfo.id as employee_id, empinfo.employee_name FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT * FROM erp_pay_emoluments WHERE id = payid
      ) AS pay ON pay.employee_id = empinfo.id;
    ELSE
      SELECT pay.*, empinfo.id as employee_id, empinfo.employee_name FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT * FROM erp_pay_emoluments
      ) AS pay ON pay.employee_id = empinfo.id;
    END IF;
END$$
DELIMITER ;

Drop PROCEDURE sp_getEmployeeBankDetail;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getEmployeeBankDetail`(IN `bankid` INT(11), in cid INT(11))
    NO SQL
BEGIN  
    IF bankid <> 0 THEN
      SELECT bank.*, empinfo.id as employee_id, empinfo.employee_name FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT * FROM erp_employee_bank_details WHERE id = bankid
      ) AS bank ON bank.employee_id = empinfo.id;
    ELSE
      SELECT bank.*, empinfo.id as employee_id, empinfo.employee_name FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT * FROM erp_employee_bank_details
      ) AS bank ON bank.employee_id = empinfo.id;
    END IF;
END$$
DELIMITER ;

Drop PROCEDURE sp_getEmployeeJobDescription;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getEmployeeJobDescription`(IN `jobid` INT(11), in cid INT(11))
    NO SQL
BEGIN  
    IF jobid <> 0 THEN
      SELECT job.*, empinfo.id as employee_id, empinfo.employee_name FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT * FROM erp_employee_job_descriptions WHERE id = bankid
      ) AS job ON job.employee_id = empinfo.id;
    ELSE
      SELECT job.*, empinfo.id as employee_id, empinfo.employee_name FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT * FROM erp_employee_job_descriptions
      ) AS job ON job.employee_id = empinfo.id;
    END IF;
END$$
DELIMITER ;

Drop PROCEDURE sp_getEmployeeTasks;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getEmployeeTasks`(IN `taskid` INT(11), in cid INT(11))
    NO SQL
BEGIN  
    IF taskid <> 0 THEN
      SELECT task.*, empinfo.id as employee_id, empinfo.employee_name FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT * FROM erp_employee_tasks WHERE id = taskid
      ) AS task ON task.employee_id = empinfo.id;
    ELSE
      SELECT task.*, empinfo.id as employee_id, empinfo.employee_name FROM (
        SELECT id, company_id, 
        concat(first_name, ' ', middle_name, ' ', last_name) AS employee_name
        FROM tblemployeeinformations WHERE company_id = cid
      )AS empinfo JOIN(
        SELECT * FROM erp_employee_tasks
      ) AS task ON task.employee_id = empinfo.id;
    END IF;
END$$
DELIMITER ;

DROP PROCEDURE sp_getVendorContact;
DELIMITER $$
CREATE PROCEDURE `sp_getVendorContact`(in userid int(11))
BEGIN  
    SELECT vendor.organization_name, contact.id, contact.contact_id, contact.social_id,  con.email, soc.website, soc.facebook, con.mobile_number FROM(
      SELECT id, organization_name, user_id 
      FROM erp_vendor_informations WHERE user_id = userid
    ) AS vendor JOIN (
      SELECT id, vendor_id, contact_id, social_id 
      FROM erp_vendor_contacts
    ) AS contact ON contact.vendor_id = vendor.id JOIN(
      SELECT id, phone_number, mobile_number, fax_number, email, whatsapp FROM tblcontacts
    ) AS con ON  con.id = contact.contact_id JOIN(
      SELECT id, website, twitter, instagram, facebook, linkedin, pinterest FROM tblsocialmedias
    )AS soc ON soc.id = contact.social_id
END$$
DELIMITER ;

DROP PROCEDURE `sp_getinventoryinfo`;
DELIMITER $$
CREATE PROCEDURE `sp_getinventoryinfo`(IN `userid` INT(11))
BEGIN
    SELECT inventory.id, cats.category_name,  inventory.product_name, 
    vend.organization_name, date(inventory.created_at) AS created_date
    FROM (
       SELECT id, category_id, product_name, user_id, created_at 
      FROM tblproduct_informations WHERE user_id = userid
    ) AS inventory JOIN (
      SELECT id, vendor_name, product_id
      FROM tblproduct_vendors
    ) AS vendor ON inventory.id = vendor.product_id JOIN(
      SELECT id, category_name FROM tblcategories
    )AS cats ON cats.id = inventory.category_id JOIN(
      SELECT id, organization_name FROM erp_vendor_informations
    ) AS vend ON vend.id = vendor.vendor_name;
END$$
DELIMITER ;



SELECT vendor.organization_name, contactperson.id, contactperson.contact_id, contactperson.social_id, contactperson.title, contactperson.first_name, contact_person.last_name, contactperson.picture, con.email, soc.website, soc.facebook, con.mobile_number, address.address_line_1, address.city, address.country, address.state FROM(
      SELECT id, organization_name, user_id 
      FROM erp_vendor_informations WHERE user_id = user_id
    ) AS vendor JOIN (
      SELECT id, vendor_id, contact_id, social_id, address_id, title, first_name, last_name, picture
      FROM erp_vendor_contactpersons
    ) AS contactperson ON contactperson.vendor_id = vendor.id JOIN(
      SELECT id, phone_number, mobile_number, fax_number, email, whatsapp FROM tblcontacts
    ) AS con ON  con.id = contactperson.contact_id JOIN(
      SELECT id, website, twitter, instagram, facebook, linkedin, pinterest FROM tblsocialmedias
    )AS soc ON soc.id = contactperson.social_id JOIN(
    SELECT id, address_lin


BEGIN  
       SELECT * from (SELECT id,AccountId,CategoryName as AccountName,AccountDescription,status from tblaccountcategories where id in(
        SELECT CategoryChildId from tblaccountparentchildassociations WHERE CategoryParentId in (
        SELECT CategoryChildId from tblaccountparentchildassociations WHERE CategoryParentId in (2,3)))) as c
JOIN (select CategoryChildId,CategoryParentId from tblaccountparentchildassociations WHERE CategoryParentId in (
        SELECT CategoryChildId from tblaccountparentchildassociations WHERE CategoryParentId in (2,3))) as a on  c.id = a.CategoryChildId
JOIN (SELECT id as typeid,CategoryName as acount_type from tblaccountcategories where id in( 
        SELECT CategoryChildId from tblaccountparentchildassociations WHERE CategoryParentId in (2,3))) as p on p.typeid = a.CategoryParentId;
    END



select * from (
    select id,CategoryName from tblaccountcategories where id in(
        select  productlineid from categoriesproductline where categoryid = 18
    )
) x join (
    select account_Id,IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) as Total 
    from tblgeneralentries where date >= '$fromdate' AND date <='$todate' group by account_Id
) a on x.id = a.account_Id




BEGIN
    DECLARE n INT DEFAULT 0;
    DECLARE i INT DEFAULT 1;
    DECLARE total_childs_categories INT DEFAULT 0;
    DECLARE selectedcategoryid INT;
    DECLARE productcategory INT;
    SELECT COUNT(*) FROM tblaccountcategories INTO n;
    truncate table categoriesproductline;
    WHILE i<n DO 
        SELECT id,product_category INTO selectedcategoryid,productcategory FROM tblaccountcategories LIMIT i,1;
        if productcategory <=> 0 THEN
            create TEMPORARY table IF NOT EXISTS temp_table1(CategoryChildId int(11));
            truncate table temp_table1;
            insert into temp_table1 SELECT CategoryChildId FROM tblaccountparentchildassociations WHERE CategoryParentId=selectedcategoryid;
            SELECT count(CategoryChildId) into total_childs_categories from temp_table1;
             create TEMPORARY  table IF NOT EXISTS temp_table (CategoryChildId int(11));
             truncate table temp_table;
            create TEMPORARY table IF NOT EXISTS temp_table2(CategoryChildId int(11));
            insert into temp_table select id from tblaccountcategories where product_category = 1 and id = selectedcategoryid;
             WHILE total_childs_categories <> 0 DO
                insert into temp_table select id from tblaccountcategories where product_category = 1 and id in (SELECT CategoryChildId FROM temp_table1);
                delete from temp_table2 where 1=1;
                insert into temp_table2 select id from tblaccountcategories where product_category = 0 and id in (SELECT CategoryChildId FROM temp_table1);
                delete from temp_table1 where 1=1; 
                insert into temp_table1 select CategoryChildId from tblaccountparentchildassociations where CategoryParentId in (SELECT CategoryChildId FROM temp_table2);
                SELECT count(*) into total_childs_categories from temp_table1;
             END WHILE;
            INSERT INTO categoriesproductline SELECT selectedcategoryid, CategoryChildId FROM temp_table;
        end if;
      SET i = i + 1;
    END WHILE;
           
END


select * from (
    select id,CategoryName from tblaccountcategories where id 26
) x join (
    select account_Id,IFNULL(sum(debit), 0) - IFNULL(sum(credit), 0) as Total 
    from tblgeneralentries where date >= '2020-07-01' AND date <='2020-10-22' group by account_Id
) a on x.id = a.account_Id


select dc.debitTotal, dc.CreditTotal, ac.CategoryName from (
    select account_id, IFNULL(sum(debit), 0) as debitTotal, IFNULL(sum(credit), 0) as CreditTotal 
    from tblgeneralentries where date >= '$fromdate' AND date <='$todate' AND account_Id = '" . $v->id . "'
) as dc join (
    select id, CategoryName 
    from tblaccountcategories
) as ac on ac.id = dc.account_id