# WEBWUT Event
**วิธีการติดตั้งระบบ**
1. Clone Project
    ```git clone https://github.com/Trosalio/webwut.git```
2. สร้าง Database ชื่อ webwutdb
3. import file ชื่อ webwutdb.sql
4. URL เริ่มที่
    ```{project-path}/webwut/index.php```

**อธิบายโครงสร้าง directory**
##### Folder #####
* administrator
    - css - ใช้ตกแต่งหน้าเว็บไซต์
    - js - ใช้ส่งข้อมูลจาก index.phpของ administrator ไปที่php
    - php - ใช้ เพื่อเชื่อมต่อไป database ประกอบด้วย การ ADD, UPDATE, SELECT
        - exportPDF - ใช้ สร้าง PDF ของแต่ละตารางของ attendant,organizer และ event
    - index.php -หน้าหลักของ administrator
* assets - เก็บรูปภาพที่ใช้ภายในเว็บไซต์
    - events
    - images
    - users
    - payment - เก็บรูปภาพหลักฐานการชำระเงิน
    - lib
        - tfpdf - ใช้ในการ export to PDF
* css
* login - จัดการหน้าเว็บการลงทะเบียน
    - add_at.js - ใช้ส่งข้อมูลจาก regis_attendate.php ไปที่ services/create_attendant.php
    - add_org.js - ใช้ส่งข้อมูลจาก regis_attendate.php ไปที่ services/create_organizer.php
    - regis_attendant.php - หน้าลงทะเบียนของ Attendant
    - regis_organizer.php - หน้าลงทะเบียนของ Organizer
* organizer - จัดการ organizer
     - event-form-components - โฟล์เดอร์ที่เก็บส่วนประกอบที่ต้องใช้สำหรับไฟล์ event-form.php
     - event-view-components - โฟล์เดอร์ที่เก็บส่วนประกอบที่ต้องใช้สำหรับไฟล์ event-viewer.php
     - homepage-components - โฟล์เดอร์ที่เก็บส่วนประกอบที่ต้องใช้สำหรับไฟล์ org-homepage.php
     - php-scripts - คลาส และ สคริปท์ php ที่ต้องใช้ร่วมกันในไฟล์หลักของ organizer
* personalMessage - จัดการส่ง และรับ message
    - css - ใช้ตกแต่งหน้าเว็บไซต์
    - js - ใช้ส่งข้อมูลจาก personalMessage.php ไปที่php
    - messageFile - เก็บภาพที่ได้จากการแนบไฟล์ เมื่อส่งข้อความ
    - php - ใช้ เพื่อเชื่อมต่อไป database ประกอบด้วย การแสดงประวัติการส่ง และ ข้อความที่ส่งถึงตนเอง
        - connectDB.php เชื่อมต่อ Database
        - sendMessage.php ใช้ส่งข้อความ/ข้อมูลไปที่ Database
        - inbox.php ใช้ดึงข้อมูลจาก Database ในการแสดงผล ข้อความที่ส่งมาถึงตนเอง
        - sentBox.php ใช้ดึงข้อมูลจาก Database ในการแสดงผล ข้อความที่ส่งไปให้ผู้อื่น
* services - จัดการการเก็บข้อมูลที่ลงทะเบียนไปยัง database
    - create_attendant.php - ใช้ เพื่อเชื่อมต่อไป database เพื่อเก็บข้อมูลการลงทะเบียนของ Attendant
    - create_organizer.php - ใช้ เพื่อเชื่อมต่อไป database เพื่อเก็บข้อมูลการลงทะเบียนของ Organizer
##### นอกโฟลเดอร์ #####
- **index.php** - หน้าแรกของเว็บไซต์
- login.php - หน้า login
- personalMessage.php - หน้าหลักของ Message
- events.php - หน้าแสดงรายการeventต่างๆ หลังจากเลือกfilter หรือ category
- event.php - หน้าแสดงรายละเอียดของ event
- org-homepage.php - หน้าหลักของ Organizer สามารถเลือกดูระหว่างแบบการ์ดกับแบบตารางได้
- event-form.php - หน้าสร้าง/แก้ไขข้อมูล event ของ Organizer
- event-viewer.php - หน้าดูข้อมูลอื่นๆของ event ที่เลือกขึ้นมาของ Organizer และข้อมูลของผู้เข้าร่วม event
- oops.php - แสดงเมื่อไม่เจอหน้า page 
- profile.php - แสดงหน้า profile ของ Attendant
- profile-edit.php - แสดงหน้าแก้ไข profile ของ Attendant
- **webwutdb.sql** - ฐานข้อมูลที่ใช้ในการเก็บข้อมูลในปัจจุบัน  

**หมายเหตุ**
