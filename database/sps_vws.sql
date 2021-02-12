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
    cat.id, asso.parent_id, cat.category_id, cat.category_name 
    FROM (
      SELECT 
      id, child_id, parent_id 
      FROM tblcategoryassociations 
      WHERE parent_id = parentid
    ) AS asso JOIN (
      SELECT 
      id, category_id, category_name 
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
CREATE PROCEDURE `getAlldepartment`(in userid int(11))
BEGIN  
    SELECT company.company_name, department.* FROM (
        SELECT id, company_name 
        FROM tblcompanydetails 
        WHERE user_id = userid
    ) AS company JOIN (
      SELECT * FROM tbldepartmens
    ) AS department ON department.company_id = company.id;
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