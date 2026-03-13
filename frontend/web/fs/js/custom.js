$(document).ready(function () {
    // ฟังก์ชันคำนวณความสูงรวมทุกระดับ
    function calculateHeight(dropdown) {
        let totalHeight = 0;

        // วนลูป li แต่ละตัวใน ul
        dropdown.children("ul").children("li").each(function () {
            totalHeight += $(this).outerHeight(true); // เพิ่มความสูง li ปกติ

            // ตรวจสอบเมนูย่อยที่เปิดอยู่
            let nestedDropdown = $(this).children(".menu-dropdown");
            if (nestedDropdown.length && $(this).hasClass("show-menu")) {
                totalHeight += calculateHeight(nestedDropdown); // คำนวณเมนูย่อย
            }
        });
        return totalHeight;
    }

    // ฟังก์ชันตั้งค่า height เมื่อหน้าโหลด
    $(".menu-item.collapsed.show-menu").each(function () {
        let dropdown = $(this).children(".menu-dropdown");
        let totalHeight = calculateHeight(dropdown); // คำนวณความสูง
        dropdown.css("height", totalHeight + "px");
    });

    // Event Click เปิด/ปิดเมนู
    $(".menu-item.collapsed > a").click(function (e) {
        e.preventDefault();
        let menuItem = $(this).parent(".menu-item.collapsed"); // เมนูปัจจุบัน
        let dropdown = menuItem.children(".menu-dropdown"); // dropdown ปัจจุบัน

        if (!menuItem.hasClass("show-menu")) {
            // เปิดเมนู
            menuItem.addClass("show-menu");
            let totalHeight = calculateHeight(dropdown); // คำนวณความสูง
            dropdown.css("height", totalHeight + "px");

            // อัปเดตความสูงของเมนูหลักที่ครอบอยู่
            updateParentHeight(menuItem, totalHeight);
        } else {
            // ปิดเมนู
            let totalHeight = calculateHeight(dropdown); // ความสูงที่ต้องปิด
            menuItem.removeClass("show-menu");
            dropdown.css("height", "0");

            // ลดความสูงจากเมนูหลักที่ครอบอยู่
            updateParentHeight(menuItem, -totalHeight);
        }
    });

    // ฟังก์ชันอัปเดตความสูงเมนูหลักที่ครอบอยู่
    function updateParentHeight(menuItem, heightChange) {
        let parentDropdown = menuItem.closest(".menu-dropdown");
        if (parentDropdown.length) {
            let currentHeight = parseInt(parentDropdown.css("height")) || 0;
            parentDropdown.css("height", currentHeight + heightChange + "px");
        }
    }
});