/*DROP QUERIES*/

DROP TABLE  IF EXISTS Wishlist;
DROP TABLE  IF EXISTS Event_Details;
DROP TABLE  IF EXISTS Category;
DROP TABLE  IF EXISTS Item_Details;
DROP TABLE  IF EXISTS User_Details;

/*CREATE QUERIES*/

CREATE TABLE User_Details (
F_Name VARCHAR(45) NOT NULL,
L_Name VARCHAR(45) NOT NULL,
M_Name VARCHAR(10),
Email_ID VARCHAR(365) NOT NULL,
User_name VARCHAR(45) NOT NULL,
Password VARCHAR(45) NOT NULL,
PRIMARY KEY (User_name),
UNIQUE KEY (User_name),
UNIQUE KEY (Email_ID)
);
CREATE TABLE Item_Details(
Item_ID	VARCHAR(50)	NOT NULL,
Item_Name	VARCHAR(50)	NOT NULL,
User_name VARCHAR(45) NOT NULL,
Cost	DECIMAL	NOT NULL,
Phone_Number	VARCHAR(20),
Address	VARCHAR(100),
Item_Condition	VARCHAR(50)	NOT NULL,
Item_Description	TEXT	NOT NULL,
Item_Image longblob,
PRIMARY KEY (Item_ID),
UNIQUE (Item_ID),
FOREIGN KEY (User_name) REFERENCES User_Details(User_name)
);
CREATE TABLE Category(
Category_Name	VARCHAR(50)	NOT NULL,
Item_ID	VARCHAR(50)	NOT NULL,
PRIMARY KEY (Category_Name, Item_ID),
FOREIGN KEY (Item_ID) REFERENCES Item_Details(Item_ID)
);
CREATE TABLE Event_Details(
Event_ID	VARCHAR(50)	NOT NULL,
User_name VARCHAR(45) NOT NULL,
Event_name VARCHAR(100) NOT NULL,
Event_Description	TEXT	NOT NULL,
Event_Image longblob,
Place	VARCHAR(100),
Event_Flag	tinyint(1)	NOT NULL,
Event_date DATE NOT NULL,
PRIMARY KEY (Event_ID),
UNIQUE (Event_ID),
FOREIGN KEY (User_name) REFERENCES User_Details(User_name)
);
CREATE TABLE Wishlist(
Item_ID	VARCHAR(50)	NOT NULL,
User_name VARCHAR(45) NOT NULL,
PRIMARY KEY (User_name, Item_ID),
FOREIGN KEY (User_name) REFERENCES User_Details(User_name),
FOREIGN KEY (Item_ID) REFERENCES Item_Details(Item_ID)
);

/*INSERT QUERIES*/

INSERT INTO User_Details ( F_Name, L_Name, M_Name, Email_ID, User_name, Password )
                       VALUES
                       ( "Victor", "Vinayak", "P", "vinayakm@gmail.com", "vinayakvictor" ,"jarjar" );
INSERT INTO User_Details ( F_Name, L_Name, M_Name, Email_ID, User_name, Password ) VALUES ( "Rahim", "David", "K", "drahim@yahoo.com", "vdavidrahim" ,"starwars" );                       


INSERT INTO Item_Details ( Item_ID, Item_Name, User_name, Cost, Phone_Number, Address, Item_Condition, Item_Description, Item_Image )
                       VALUES
                       ( "0000", "Lenovo K3 Note", "vdavidrahim", "90" , "2566355022", "Sparkman 1000", "Used", "Working", "");
INSERT INTO Item_Details ( Item_ID, Item_Name, User_name, Cost, Phone_Number, Address, Item_Condition, Item_Description, Item_Image )
                       VALUES
                       ( "0065", "Dining table", "vinayakvictor", "54" , "25569632022", "Wynnman 2000", "New", "Wooden", "");
INSERT INTO Item_Details ( Item_ID, Item_Name, User_name, Cost, Phone_Number, Address, Item_Condition, Item_Description, Item_Image )
                       VALUES
                       ( "5643", "iPhone", "vinayakvictor", "200" , "6569655022", "Rayleigh 3000", "Used", "Light crack on the back side", "");
                       
INSERT INTO Category ( Category_Name, Item_ID)
                       VALUES
                       ( "Phone", "0000");
INSERT INTO Category ( Category_Name, Item_ID)
                       VALUES
                       ( "Electronics", "0000");
INSERT INTO Category ( Category_Name, Item_ID)
                       VALUES
                       ( "Furniture", "0065");
INSERT INTO Category ( Category_Name, Item_ID)
                       VALUES
                       ( "House", "0065");
INSERT INTO Category ( Category_Name, Item_ID)
                       VALUES
                       ( "Decoration", "0065");
INSERT INTO Category ( Category_Name, Item_ID)
                       VALUES
                       ( "Accessories", "5643");                       
 
INSERT INTO Event_Details ( Event_ID, User_name, Event_name, Event_Description, Event_Image, Place, Event_Flag, Start_time, End_time)
                       VALUES
                       ( "5897", "vinayakvictor", "Coldplay Concert" , "The ban is performing for the first time in Alabama", "", "Rayleigh 3000", "1", "2017-12-31 21:00:00", "2018-01-01");

INSERT INTO Wishlist ( Item_ID, User_name)
                       VALUES
                       ( "5643", "vdavidrahim");
INSERT INTO Wishlist ( Item_ID, User_name)
                       VALUES
                       ( "0000", "vinayakvictor");
INSERT INTO Wishlist ( Item_ID, User_name)
                       VALUES
                       ( "0065", "vinayakvictor");
INSERT INTO Wishlist ( Item_ID, User_name)
                       VALUES
                       ( "0065", "vdavidrahim");                    	
			
/*SELECT QUERIES*/

SELECT * FROM User_Details;
SELECT * FROM item_details;
SELECT * FROM Category;
SELECT * FROM Event_Details;
SELECT * FROM Wishlist;

/*DELETE QUERIES*/
DELETE FROM item_details where Item_ID="1899172582";